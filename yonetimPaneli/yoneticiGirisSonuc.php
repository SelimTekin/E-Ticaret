<?php
if (empty($_SESSION["yonetici"])) {
    if (isset($_POST["YKullanici"])) {
        $gelenYKullanici = guvenlik($_POST["YKullanici"]);
    } else {
        $gelenYKullanici = "";
    }

    if (isset($_POST["YSifre"])) {
        $gelenYSifre = guvenlik($_POST["YSifre"]);
    } else {
        $gelenYSifre = "";
    }

    $MD5liSifre     = md5($gelenYSifre);

    if (($gelenYKullanici != "") and ($gelenYSifre != "")) {

        $kontrolSorgusu  = $db->prepare("SELECT * FROM yoneticiler WHERE kullaniciAdi = ? AND sifre = ?");
        $kontrolSorgusu->execute([$gelenYKullanici, $MD5liSifre]);
        $kullaniciSayisi = $kontrolSorgusu->rowCount();
        $kullanicKaydi   = $kontrolSorgusu->fetch(PDO::FETCH_ASSOC);

        if ($kullaniciSayisi > 0) {

                $_SESSION["yonetici"] = $gelenYKullanici;

                header("Location:index.php?sayfaKoduDis=0");
                exit();
        } else {
            header("Location:index.php?sayfaKoduDis=3");
            exit();
        }
    } else {
        header("Location:index.php?sayfaKoduDis=1");
        exit();
    }
}
else{
    header("Location:index.php?sayfaKoduDis=0");
    exit();
}
