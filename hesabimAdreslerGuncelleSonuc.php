<?php

if ($_SESSION["kullanici"]) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }

    if (isset($_POST["isimSoyisim"])) {
        $gelenIsimSoyisim = guvenlik($_POST["isimSoyisim"]);
    } else {
        $gelenIsimSoyisim = "";
    }

    if (isset($_POST["adres"])) {
        $gelenAdres = guvenlik($_POST["adres"]);
    } else {
        $gelenAdres = "";
    }

    if (isset($_POST["ilce"])) {
        $gelenIlce = guvenlik($_POST["ilce"]);
    } else {
        $gelenIlce = "";
    }

    if (isset($_POST["sehir"])) {
        $gelenSehir = guvenlik($_POST["sehir"]);
    } else {
        $gelenSehir = "";
    }

    if (isset($_POST["telefonNumarasi"])) {
        $gelenTelefonNumarasi = guvenlik($_POST["telefonNumarasi"]);
    } else {
        $gelenTelefonNumarasi = "";
    }


    if (($gelenId != "") and ($gelenIsimSoyisim != "") and ($gelenAdres != "") and ($gelenIlce != "") and ($gelenSehir != "") and ($gelenTelefonNumarasi != "")) {

        $adresGuncellemeSorgusu = $db->prepare("UPDATE adresler SET adiSoyadi = ?, adres = ?, ilce = ?, sehir = ?, telefonNumarasi = ? WHERE id = ? AND uyeId = ? LIMIT 1");
        $adresGuncellemeSorgusu->execute([$gelenIsimSoyisim, $gelenAdres, $gelenIlce, $gelenSehir, $gelenTelefonNumarasi, $gelenId, $kullaniciId]);
        $guncellemeKontrol      = $adresGuncellemeSorgusu->rowCount();

        if($guncellemeKontrol > 0){
            header("Location:index.php?sayfaKodu=64");
            exit();
        }
        else{
            header("Location:index.php?sayfaKodu=65");
            exit();
        }
    } else {
        header("Location:index.php?sayfaKodu=66");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
