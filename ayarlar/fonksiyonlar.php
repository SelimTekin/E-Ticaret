<?php

$IPAdresi            = $_SERVER["REMOTE_ADDR"];
$zamanDamgasi        = time();
$tarihSaat           = date("d.m.Y H:i:s", $zamanDamgasi);
$siteKokDizini       = $_SERVER["DOCUMENT_ROOT"];
$resimKlasoruYolu    = "/E-Ticaret/resimler/";
$verotIcinKlasorYolu = $siteKokDizini.$resimKlasoruYolu;

function tarihCevir($deger){
    $cevir = date("d.m.Y H:i:s", $deger);
    $sonuc = $cevir;

    return $sonuc;
}

function ucGunIleriTarihBul(){
    global $zamanDamgasi;
    $birGun  = 86400;
    $hesapla = $zamanDamgasi + (3 * $birGun);
    $cevir   = date("d.m.Y", $hesapla);
    $sonuc   = $cevir;

    return $sonuc;
}

function guvenlik($deger){
    $boslukSil      = trim($deger);
    $taglariTemizle = strip_tags($boslukSil);
    $etkisizTirnak  = htmlspecialchars($taglariTemizle, ENT_QUOTES); // Tırnakları da dönüştürür
    $sonuc          = $etkisizTirnak;

    return $sonuc;
}

function rakamlarHaricTumKarakterleriSil($deger){
    $islem = preg_replace("/[^0-9]/", "", $deger); // degerde rakamlar hariç bütün her şeyi sil
    $sonuc = $islem;

    return $sonuc;
}

function tumBosluklariSil($deger){
    $islem = preg_replace("/\s|&nbsp;/", "", $deger);
    $sonuc = $islem;

    return $sonuc;
}

function sayiIcerenIcerikleriFiltrele($deger){
    $boslukSil      = trim($deger);
    $taglariTemizle = strip_tags($boslukSil);
    $etkisizTirnak  = htmlspecialchars($taglariTemizle, ENT_QUOTES);
    $temizle = rakamlarHaricTumKarakterleriSil($etkisizTirnak);
    $sonuc          = $temizle;

    return $sonuc;
}

function donusumleriGeriDondur($deger){
    $geriDondur = htmlspecialchars_decode($deger, ENT_QUOTES); // dönüştürdüğümüz html taglarını geri eski haline getirdik
    $sonuc = $geriDondur;

    return $sonuc;
}

function IBANBicimlendir($deger){
    $boslukSil    = trim($deger);
    $tumBoslukSil = tumBosluklariSil($boslukSil);
    $birinciBlok  = substr($tumBoslukSil, 0, 4);
    $ikinciBlok   = substr($tumBoslukSil, 4, 4);
    $ucuncuBlok   = substr($tumBoslukSil, 8, 4);
    $dorduncuBlok = substr($tumBoslukSil, 12, 4);
    $besinciBlok  = substr($tumBoslukSil, 16, 4);
    $altinciBlok  = substr($tumBoslukSil, 20, 4);
    $yedinciBlok  = substr($tumBoslukSil, 24, 4);
    $duzenle      = $birinciBlok . " " . $ikinciBlok . " " . $ucuncuBlok . " " . $dorduncuBlok . " " . $besinciBlok . " " . $altinciBlok . " " . $yedinciBlok;
    $sonuc        = $duzenle;

    return $sonuc;
}

function aktivasyonKoduUret(){
    $ilkBesli      = rand(10000, 99999);
    $ikinciBesli   = rand(10000, 99999);
    $ucuncuBesli   = rand(10000, 99999);
    $dorduncuBesli = rand(10000, 99999);
    $kod           = $ilkBesli . "-" . $ikinciBesli . "-" . $ucuncuBesli . "-" . $dorduncuBesli;
    $sonuc         = $kod;
    
    return $sonuc;
}

function fiyatBicimlendir($deger){
    $bicimlendir = number_format($deger, "2", ",", "."); // 2 tane ondalık hane olacak, bu ondalık haneler virgülle ayrılacak, binlik hane gelirse nokta (.) ile ayrılır.
    $sonuc = $bicimlendir;

    return $sonuc;
}

?>