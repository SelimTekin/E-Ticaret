<?php
require_once("ayarlar/ayar.php");
require_once("ayarlar/fonksiyonlar.php");

if(isset($_GET["aktivasyonKodu"])){
    $gelenAktivasyonKodu = guvenlik($_GET["aktivasyonKodu"]);
}
else{
    $gelenAktivasyonKodu = "";
}

if(isset($_GET["emailAdresi"])){
    $gelenEmailAdresi = guvenlik($_GET["emailAdresi"]);
}
else{
    $gelenEmailAdresi = "";
}


if( ($gelenAktivasyonKodu!="") and ($gelenEmailAdresi!="")){

    $kontrolSorgusu       = $db->prepare("SELECT * FROM uyeler WHERE emailAdresi = ? AND aktivasyonKodu = ? AND durumu = ?");
    $kontrolSorgusu->execute([$gelenEmailAdresi, $gelenAktivasyonKodu, 0]);
    $kullaniciSayisi = $kontrolSorgusu->rowCount();

    if($kullaniciSayisi > 0){
        $uyeGuncellemeSorgusu = $db->prepare("UPDATE uyeler SET durumu = 1");
        $uyeGuncellemeSorgusu->execute();
        $kontrol     = $uyeGuncellemeSorgusu->rowCount();

        if($kontrol > 0){
            header("Location: index.php?sayfaKodu=30");
            exit();
        }
        else{
            header("Location:" . $siteLinki);
            exit();
        }
    }
    else{
        header("Location:" . $siteLinki);
        exit();
    }

}
else{
    header("Location:" . $siteLinki);
    exit();
}

?>

<?php
$db = null;
?>