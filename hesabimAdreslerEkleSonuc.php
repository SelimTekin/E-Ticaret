<?php

if (isset($_SESSION["kullanici"])) {

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


    if (($gelenIsimSoyisim != "") and ($gelenAdres != "") and ($gelenIlce != "") and ($gelenSehir != "") and ($gelenTelefonNumarasi != "")) {

        $adresEklemeSorgusu = $db->prepare("INSERT INTO adresler (uyeId, adiSoyadi, adres, ilce, sehir, telefonNumarasi) VALUES (?, ?, ?, ?, ?, ?)");
        $adresEklemeSorgusu->execute([$kullaniciId, $gelenIsimSoyisim, $gelenAdres, $gelenIlce, $gelenSehir, $gelenTelefonNumarasi]);
        $EklemeKontrol      = $adresEklemeSorgusu->rowCount();

        if($EklemeKontrol > 0){
            header("Location:index.php?sayfaKodu=72");
            exit();
        }
        else{
            header("Location:index.php?sayfaKodu=73");
            exit();
        }
    } else {
        header("Location:index.php?sayfaKodu=74");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
