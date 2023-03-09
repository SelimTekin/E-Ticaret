<?php
if(isset($_POST["isimSoyisim"])){
    $gelenIsimSoyisim = guvenlik($_POST["isimSoyisim"]);
}
else{
    $gelenIsimSoyisim = "";
}

if(isset($_POST["emailAdresi"])){
    $gelenEmailAdresi = guvenlik($_POST["emailAdresi"]);
}
else{
    $gelenEmailAdresi = "";
}

if(isset($_POST["telefonNumarasi"])){
    $gelenTelefonNumarasi = guvenlik($_POST["telefonNumarasi"]);
}
else{
    $gelenTelefonNumarasi = "";
}

if(isset($_POST["bankaSecimi"])){
    $gelenBankaSecimi = guvenlik($_POST["bankaSecimi"]);
}
else{
    $gelenBankaSecimi = "";
}

if(isset($_POST["aciklama"])){
    $gelenAciklama = guvenlik($_POST["aciklama"]);
}
else{
    $gelenAciklama = "";
}

if( ($gelenIsimSoyisim!="") and ($gelenEmailAdresi!="") and ($gelenTelefonNumarasi!="") and ($gelenBankaSecimi!="") ){
    $havaleBildirimiKaydet       = $db->prepare("INSERT INTO havalebildirimleri (bankaId, adiSoyadi, emailAdresi, telefonNumarasi, aciklama, islemTarihi, durum) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $havaleBildirimiKaydet->execute([$gelenBankaSecimi, $gelenIsimSoyisim, $gelenEmailAdresi, $gelenTelefonNumarasi, $gelenAciklama, $zamanDamgasi, 0]);
    $havaleBildirimiKayitKontrol = $havaleBildirimiKaydet->rowCount();

    if($havaleBildirimiKayitKontrol > 0){
        header("Location:index.php?sayfaKodu=11");
        exit();
    }
    else{
        header("Location:index.php?sayfaKodu=12");
        exit();
    }

}
else{
    header("Location:index.php?sayfaKodu=13");
    exit();
}
?>