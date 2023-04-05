<?php
if (isset($_SESSION["yonetici"])) {
    
    if (isset($_POST["kullaniciAdi"])) {
        $gelenKullaniciAdi = guvenlik($_POST["kullaniciAdi"]);
    } else {
        $gelenKullaniciAdi = "";
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

    $MD5liSifre = md5($gelenSifre);

    if (($gelenKullaniciAdi != "") and ($gelenSifre != "") and ($gelenIsimSoyisim != "") and ($gelenEmailAdresi != "") and ($gelenTelefonNumarasi != "")) {

        $yoneticiKontrolSorgusu = $db->prepare("SELECT * FROM yoneticiler WHERE kullaniciAdi = ? OR emailAdresi = ?");
        $yoneticiKontrolSorgusu->execute([$gelenKullaniciAdi, $gelenEmailAdresi]);
        $yoneticiKontrolKontrol = $yoneticiKontrolSorgusu->rowCount();

        if($yoneticiKontrolKontrol > 0){
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=81");
            exit();
        }
        else{

            $yoneticiEklemeSorgusu = $db->prepare("INSERT INTO yoneticiler (kullaniciAdi, sifre, isimSoyisim, emailAdresi, telefonNumarasi) VALUES (?, ?, ?, ?, ?)");
            $yoneticiEklemeSorgusu->execute([$gelenKullaniciAdi, $MD5liSifre, $gelenIsimSoyisim, $gelenEmailAdresi, $gelenTelefonNumarasi]);
            $yoneticiEklemeKontrol = $yoneticiEklemeSorgusu->rowCount();
    
            if($yoneticiEklemeKontrol > 0){
                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=72");
                exit();
            }
            else{
                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=73");
                exit();
            }

        }

    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=73");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>