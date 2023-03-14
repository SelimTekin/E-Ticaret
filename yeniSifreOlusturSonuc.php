<?php

if (isset($_GET["emailAdresi"])) {
    $gelenEmailAdresi = guvenlik($_GET["emailAdresi"]);
} else {
    $gelenEmailAdresi = "";
}

if (isset($_GET["aktivasyonKodu"])) {
    $gelenAktivasyonKodu = guvenlik($_GET["aktivasyonKodu"]);
} else {
    $gelenAktivasyonKodu = "";
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

$MD5liSifre     = md5($gelenSifre);

if (($gelenSifre != "") and ($gelenSifreTekrar != "") and ($gelenEmailAdresi != "") and ($gelenAktivasyonKodu != "")) {

    if ($gelenSifre != $gelenSifreTekrar) {
        header("Location:index.php?sayfaKodu=47");
        exit();
    } else {
        $uyeGuncellemeSorgusu = $db->prepare("UPDATE uyeler SET sifre = ? WHERE emailAdresi = ? AND aktivasyonKodu = ?");
        $uyeGuncellemeSorgusu->execute([$MD5liSifre, $gelenEmailAdresi, $gelenAktivasyonKodu]);
        $kontrol     = $uyeGuncellemeSorgusu->rowCount();

        if ($kontrol > 0) {
            header("Location: index.php?sayfaKodu=45");
            exit();
        } else {
            header("Location: index.php?sayfaKodu=46");
            exit();
        }
    }
} else {
    header("Location:index.php?sayfaKodu=48");
    exit();
}
