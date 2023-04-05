<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }
    if (isset($_POST["sifre"])) {
        $gelenSifre = guvenlik($_POST["sifre"]);
    } else {
        $gelenSifre = "";
    }
    if (isset($_POST["isimSoyisim"])) {
        $gelenIsimSoyisim = guvenlik($_POST["isimSoyisim"]);
    } else {
        $gelenIsimSoyisim = "";
    }
    if (isset($_POST["emailAdresi"])) {
        $gelenEmailAdresi = guvenlik($_POST["emailAdresi"]);
    } else {
        $gelenEmailAdresi = "";
    }
    if (isset($_POST["telefonNumarasi"])) {
        $gelenTelefonNumarasi = guvenlik($_POST["telefonNumarasi"]);
    } else {
        $gelenTelefonNumarasi = "";
    }

    if (($gelenId != "") and ($gelenIsimSoyisim != "") and ($gelenEmailAdresi != "") and ($gelenTelefonNumarasi != "")) {

        $yoneticininMevcutSifreSorgusu = $db->prepare("SELECT * FROM yoneticiler WHERE id = ? LIMIT 1");
        $yoneticininMevcutSifreSorgusu->execute([$gelenId]);
        $yoneticininMevcutSifreKaydi   = $yoneticininMevcutSifreSorgusu->fetch(PDO::FETCH_ASSOC);
        $yoneticininMevcutSifreKontrol = $yoneticininMevcutSifreSorgusu->rowCount();

        if ($yoneticininMevcutSifreKontrol > 0) {
            $yoneticininMevcutSifresi = $yoneticininMevcutSifreKaydi["sifre"];

            if ($gelenSifre == "") {
                $yoneticiIcinKaydedilecekSifre  = $yoneticininMevcutSifresi;
            } else {
                $yoneticiIcinKaydedilecekSifre = md5($gelenSifre);
            }

            $yoneticiGuncellemeSorgusu = $db->prepare("UPDATE yoneticiler SET isimSoyisim = ?, sifre = ?, emailAdresi = ?, telefonNumarasi = ? WHERE id = ? LIMIT 1");
            $yoneticiGuncellemeSorgusu->execute([$gelenIsimSoyisim, $yoneticiIcinKaydedilecekSifre, $gelenEmailAdresi, $gelenTelefonNumarasi, $gelenId]);
            $yoneticiGuncellemeKontrol = $yoneticiGuncellemeSorgusu->rowCount();

            if ($yoneticiGuncellemeKontrol > 0) {
                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=76");
                exit();
            } else {
                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=77");
                exit();
            }

        } else {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=77");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=77");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
