<?php

if (isset($_SESSION["kullanici"])) {

    if (isset($_POST["emailAdresi"])) {
        $gelenEmailAdresi = guvenlik($_POST["emailAdresi"]);
    } else {
        $gelenEmailAdresi = "";
    }

    if (isset($_POST["sifre"])) {
        $gelenSifre = guvenlik($_POST["sifre"]);
    } else {
        $gelenSifre = "";
    }

    if (isset($_POST["sifreTekrar"])) {
        $gelenSifreTekrar = guvenlik($_POST["sifreTekrar"]);
    } else {
        $gelenSifreTekrar = "";
    }

    if (isset($_POST["isimSoyisim"])) {
        $gelenIsimSoyisim = guvenlik($_POST["isimSoyisim"]);
    } else {
        $gelenIsimSoyisim = "";
    }

    if (isset($_POST["telefonNumarasi"])) {
        $gelenTelefonNumarasi = guvenlik($_POST["telefonNumarasi"]);
    } else {
        $gelenTelefonNumarasi = "";
    }

    if (isset($_POST["cinsiyet"])) {
        $gelenCinsiyet = guvenlik($_POST["cinsiyet"]);
    } else {
        $gelenCinsiyet = "";
    }

    $MD5liSifre     = md5($gelenSifre);

    if (($gelenIsimSoyisim != "") and ($gelenEmailAdresi != "") and ($gelenTelefonNumarasi != "") and ($gelenSifre != "") and ($gelenSifreTekrar != "") and ($gelenCinsiyet != "")) {

        if ($gelenSifre != $gelenSifreTekrar) {
            header("Location:index.php?sayfaKodu=57");
            exit();
        } else {

            if ($gelenSifre == "eskiSifre") {
                $sifreDegistirmeDurumu = 0;
            } else {
                $sifreDegistirmeDurumu = 1;
            }

            if ($emailAdresi != $gelenEmailAdresi) {
                $kontrolSorgusu       = $db->prepare("SELECT * FROM uyeler WHERE emailAdresi = ?");
                $kontrolSorgusu->execute([$gelenEmailAdresi]);
                $kullaniciSayisi = $kontrolSorgusu->rowCount();

                if ($kullaniciSayisi > 0) {
                    header("Location:index.php?sayfaKodu=55");
                    exit();
                }
            }

            if($sifreDegistirmeDurumu == 1){
                $kullaniciGuncellemeSorgusu = $db->prepare("UPDATE uyeler SET emailAdresi = ?, sifre = ?, isimSoyisim = ?, telefonNumarasi = ?, cinsiyet = ? WHERE id = ? LIMIT 1");
                $kullaniciGuncellemeSorgusu->execute([$gelenEmailAdresi, $MD5liSifre, $gelenIsimSoyisim, $gelenTelefonNumarasi, $gelenCinsiyet, $kullaniciId]);    
            }
            else{
                $kullaniciGuncellemeSorgusu = $db->prepare("UPDATE uyeler SET emailAdresi = ?, isimSoyisim = ?, telefonNumarasi = ?, cinsiyet = ? WHERE id = ? LIMIT 1");
                $kullaniciGuncellemeSorgusu->execute([$gelenEmailAdresi, $gelenIsimSoyisim, $gelenTelefonNumarasi, $gelenCinsiyet, $kullaniciId]);
            }

            $kayitKontrol     = $kullaniciGuncellemeSorgusu->rowCount();

            if ($kayitKontrol > 0) {
                $_SESSION["kullanici"] = $gelenEmailAdresi;
                header("Location:index.php?sayfaKodu=53");
                exit();
            } else {
                header("Location:index.php?sayfaKodu=54");
                exit();
            }
        }
    } else {
        header("Location:index.php?sayfaKodu=56");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
