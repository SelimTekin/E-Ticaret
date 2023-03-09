<?php

try{
    $db = new PDO("mysql:host=localhost;dbname=eticaret;charset=UTF8", "root", "");
}catch(PDOException $hata){
    // echo "Bağlantı Hatası<br />" . $hata->getMessage(); // Bu alan kapalı kalsın çünkü hata olursa kullanıcı hatayı görmesin
    die();
}

$ayarlarSorgusu = $db->prepare("SELECT * FROM ayarlar LIMIT 1");
$ayarlarSorgusu->execute();
$ayarSayisi     = $ayarlarSorgusu->rowCount();
$ayarlar        = $ayarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if($ayarSayisi > 0){
    $siteAdi            = $ayarlar["siteAdi"];
    $siteTitle          = $ayarlar["siteTitle"];
    $siteDescription    = $ayarlar["siteDescription"];
    $siteKeywords       = $ayarlar["siteKeywords"];
    $siteCopyrightMetni = $ayarlar["siteCopyrightMetni"];
    $siteLogosu         = $ayarlar["siteLogosu"];
    $siteEmailAdresi    = $ayarlar["siteEmailAdresi"];
    $siteEmailSifresi   = $ayarlar["siteEmailSifresi"];
    $siteEmailHostAdresi= $ayarlar["siteEmailHostAdresi"];
    $facebook           = $ayarlar["facebook"];
    $twitter            = $ayarlar["twitter"];
    $linkedin           = $ayarlar["linkedin"];
    $instagram          = $ayarlar["instagram"];
    $pinterest          = $ayarlar["pinterest"];
    $youtube            = $ayarlar["youtube"];
}
else{
    // echo "Site Ayar Sorgusu Hatalı"; // Bu alan kapalı kalsın çünkü hata olursa kullanıcı hatayı görmesin
    die();
}


$metinlerSorgusu = $db->prepare("SELECT * FROM sozlesmelervemetinler LIMIT 1");
$metinlerSorgusu->execute();
$ayarSayisi     = $metinlerSorgusu->rowCount();
$metinler        = $metinlerSorgusu->fetch(PDO::FETCH_ASSOC);

if($ayarSayisi > 0){
    $hakkimizdaMetni              = $metinler["hakkimizdaMetni"];
    $uyelikSozlesmesiMetni        = $metinler["uyelikSozlesmesiMetni"];
    $kullanimKosullariMetni       = $metinler["kullanimKosullariMetni"];
    $gizlilikSozlesmesiMetni      = $metinler["gizlilikSozlesmesiMetni"];
    $mesafeliSatisSozlesmesiMetni = $metinler["mesafeliSatisSozlesmesiMetni"];
    $teslimatMetni                = $metinler["teslimatMetni"];
    $iptalIadeDegisimMetni        = $metinler["iptalIadeDegisimMetni"];
}
else{
    // echo "Metinler Sorgusu Hatalı"; // Bu alan kapalı kalsın çünkü hata olursa kullanıcı hatayı görmesin
    die();
}
?>