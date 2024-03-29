<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=eticaret;charset=UTF8", "root", "");
} catch (PDOException $hata) {
    // echo "Bağlantı Hatası<br />" . $hata->getMessage(); // Bu alan kapalı kalsın çünkü hata olursa kullanıcı hatayı görmesin
    die();
}

$ayarlarSorgusu = $db->prepare("SELECT * FROM ayarlar LIMIT 1");
$ayarlarSorgusu->execute();
$ayarSayisi     = $ayarlarSorgusu->rowCount();
$ayarlar        = $ayarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if ($ayarSayisi > 0) {
    $siteAdi            = $ayarlar["siteAdi"];
    $siteTitle          = $ayarlar["siteTitle"];
    $siteDescription    = $ayarlar["siteDescription"];
    $siteKeywords       = $ayarlar["siteKeywords"];
    $siteCopyrightMetni = $ayarlar["siteCopyrightMetni"];
    $siteLogosu         = $ayarlar["siteLogosu"];
    $siteLinki          = $ayarlar["siteLinki"];
    $siteEmailAdresi    = $ayarlar["siteEmailAdresi"];
    $siteEmailSifresi   = $ayarlar["siteEmailSifresi"];
    $siteEmailHostAdresi = $ayarlar["siteEmailHostAdresi"];
    $facebook           = $ayarlar["facebook"];
    $twitter            = $ayarlar["twitter"];
    $linkedin           = $ayarlar["linkedin"];
    $instagram          = $ayarlar["instagram"];
    $pinterest          = $ayarlar["pinterest"];
    $youtube            = $ayarlar["youtube"];
    $dolarKuru          = $ayarlar["dolarKuru"];
    $euroKuru           = $ayarlar["euroKuru"];
    $ucretsizKargoBaraji = $ayarlar["ucretsizKargoBaraji"];
    $clientId           = $ayarlar["clientId"];
    $storeKey           = $ayarlar["storeKey"];
    $apiKullanicisi     = $ayarlar["apiKullanicisi"];
    $apiSifresi         = $ayarlar["apiSifresi"];
} else {
    // echo "Site Ayar Sorgusu Hatalı"; // Bu alan kapalı kalsın çünkü hata olursa kullanıcı hatayı görmesin
    die();
}


$metinlerSorgusu = $db->prepare("SELECT * FROM sozlesmelervemetinler LIMIT 1");
$metinlerSorgusu->execute();
$metinSayisi     = $metinlerSorgusu->rowCount();
$metinler        = $metinlerSorgusu->fetch(PDO::FETCH_ASSOC);
if ($metinSayisi > 0) {
    $hakkimizdaMetni              = $metinler["hakkimizdaMetni"];
    $uyelikSozlesmesiMetni        = $metinler["uyelikSozlesmesiMetni"];
    $kullanimKosullariMetni       = $metinler["kullanimKosullariMetni"];
    $gizlilikSozlesmesiMetni      = $metinler["gizlilikSozlesmesiMetni"];
    $mesafeliSatisSozlesmesiMetni = $metinler["mesafeliSatisSozlesmesiMetni"];
    $teslimatMetni                = $metinler["teslimatMetni"];
    $iptalIadeDegisimMetni        = $metinler["iptalIadeDegisimMetni"];
} else {
    // echo "Metinler Sorgusu Hatalı"; // Bu alan kapalı kalsın çünkü hata olursa kullanıcı hatayı görmesin
    die();
}



if (isset($_SESSION["kullanici"])) {
    $kullaniciSorgusu    = $db->prepare("SELECT * FROM uyeler WHERE emailAdresi = ? LIMIT 1");
    $kullaniciSorgusu->execute([$_SESSION["kullanici"]]);
    $kullaniciSayisi     = $kullaniciSorgusu->rowCount();
    $kullanici        = $kullaniciSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($kullaniciSayisi > 0) {
        $kullaniciId     = $kullanici["id"];
        $emailAdresi     = $kullanici["emailAdresi"];
        $sifre           = $kullanici["sifre"];
        $isimSoyisim     = $kullanici["isimSoyisim"];
        $telefonNumarasi = $kullanici["telefonNumarasi"];
        $cinsiyet        = $kullanici["cinsiyet"];
        $durumu          = $kullanici["durumu"];
        $kayitTarihi     = $kullanici["kayitTarihi"];
        $kayitIpAdresi   = $kullanici["kayitIpAdresi"];
        $aktivasyonKodu   = $kullanici["aktivasyonKodu"];
    } else {
        // echo "Kullanıcı Sorgusu Hatalı"; // Bu alan kapalı kalsın çünkü hata olursa kullanıcı hatayı görmesin
        die();
    }
}

if (isset($_SESSION["yonetici"])) {
    $yoneticiSorgusu    = $db->prepare("SELECT * FROM yoneticiler WHERE kullaniciAdi = ? LIMIT 1");
    $yoneticiSorgusu->execute([$_SESSION["yonetici"]]);
    $yoneticiSayisi     = $yoneticiSorgusu->rowCount();
    $yonetici           = $yoneticiSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($yoneticiSayisi > 0) {
        $yoneticiId              = $yonetici["id"];
        $yoneticiKullaniciAdi    = $yonetici["kullaniciAdi"];
        $yoneticiSifre           = $yonetici["sifre"];
        $yoneticiIsimSoyisim     = $yonetici["isimSoyisim"];
        $yoneticiEmailAdresi     = $yonetici["emailAdresi"];
        $yoneticiTelefonNumarasi = $yonetici["telefonNumarasi"];
    } else {
        // echo "Yönetici Sorgusu Hatalı"; // Bu alan kapalı kalsın çünkü hata olursa kullanıcı hatayı görmesin
        die();
    }
}
