<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'frameworks/PHPMailer/src/Exception.php';
require 'frameworks/PHPMailer/src/PHPMailer.php';
require 'frameworks/PHPMailer/src/SMTP.php';

if(isset($_POST["emailAdresi"])){
    $gelenEmailAdresi = guvenlik($_POST["emailAdresi"]);
}
else{
    $gelenEmailAdresi = "";
}

if(isset($_POST["sifre"])){
    $gelenSifre = guvenlik($_POST["sifre"]);
}
else{
    $gelenSifre = "";
}

if(isset($_POST["sifreTekrar"])){
    $gelenSifreTekrar = guvenlik($_POST["sifreTekrar"]);
}
else{
    $gelenSifreTekrar = "";
}

if(isset($_POST["isimSoyisim"])){
    $gelenIsimSoyisim = guvenlik($_POST["isimSoyisim"]);
}
else{
    $gelenIsimSoyisim = "";
}

if(isset($_POST["telefonNumarasi"])){
    $gelenTelefonNumarasi = guvenlik($_POST["telefonNumarasi"]);
}
else{
    $gelenTelefonNumarasi = "";
}

if(isset($_POST["cinsiyet"])){
    $gelenCinsiyet = guvenlik($_POST["cinsiyet"]);
}
else{
    $gelenCinsiyet = "";
}

if(isset($_POST["sozlesmeOnay"])){
    $gelenSozlesmeOnay = guvenlik($_POST["sozlesmeOnay"]);
}
else{
    $gelenSozlesmeOnay = "";
}

$aktivasyonKodu = aktivasyonKoduUret();
$MD5liSifre     = md5($gelenSifre);

if( ($gelenIsimSoyisim!="") and ($gelenEmailAdresi!="") and ($gelenTelefonNumarasi!="") and ($gelenSifre!="") and ($gelenSifreTekrar!="") and ($gelenCinsiyet!="") and ($gelenSozlesmeOnay!="") ){

    if($gelenSozlesmeOnay == 0){
        header("Location:index.php?sayfaKodu=29");
        exit();
    }
    else{
        if($gelenSifre!=$gelenSifreTekrar){
            header("Location:index.php?sayfaKodu=28");
            exit();
        }
        else{
            $kontrolSorgusu       = $db->prepare("SELECT * FROM uyeler WHERE emailAdresi = ?");
            $kontrolSorgusu->execute([$gelenEmailAdresi]);
            $kullaniciSayisi = $kontrolSorgusu->rowCount();
        
            if($kullaniciSayisi > 0){
                header("Location:index.php?sayfaKodu=27");
                exit();
            }
            else{
                $uyeEklemeSorgusu = $db->prepare("INSERT INTO uyeler (emailAdresi, sifre, isimSoyisim, telefonNumarasi, cinsiyet, durumu, kayitTarihi, kayitIpAdresi, aktivasyonKodu) VALUES (?,?,?,?,?,?,?,?,?)");
                $uyeEklemeSorgusu->execute([$gelenEmailAdresi, $MD5liSifre, $gelenIsimSoyisim, $gelenTelefonNumarasi, $gelenCinsiyet, 0, $zamanDamgasi, $IPAdresi, $aktivasyonKodu]);
                $kayitKontrol     = $uyeEklemeSorgusu->rowCount();

                if($kayitKontrol > 0){

                    $mailIcerigiHazirla = "Merhaba Sayın " . $gelenIsimSoyisim . "<br /><br />";
                    $mailIcerigiHazirla .= "Sitemize yapmış olduğunuz üyelik kaydını tamamlamak için lütfen <a href='" . $siteLinki . "/aktivasyon.php?aktivasyonKodu=" . $aktivasyonKodu . "&email=" . $gelenEmailAdresi . ">BURAYA TIKLAYINIZ</a>.<br /><br />";
                    $mailIcerigiHazirla .= "Saygılarımızla...<br />";
                    $mailIcerigiHazirla .= $siteAdi;

                    $mailGonder = new PHPMailer(true);

                    try {
                        //Server settings
                        $mailGonder->SMTPDebug  = 0;                      //Enable verbose debug output
                        $mailGonder->isSMTP();                                            //Send using SMTP
                        $mailGonder->Host       = donusumleriGeriDondur($siteEmailHostAdresi);                     //Set the SMTP server to send through
                        $mailGonder->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mailGonder->CharSet    = "UTF-8";                                   //Enable SMTP authentication
                        $mailGonder->Username   = donusumleriGeriDondur($siteEmailAdresi);                  //SMTP username
                        $mailGonder->Password   = donusumleriGeriDondur($siteEmailSifresi);                               //SMTP password
                        $mailGonder->SMTPSecure = 'tls';           //Enable implicit TLS encryption
                        $mailGonder->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                        $mailGonder->SMTPOptions = array(
                            "ssl" => array(
                                "verify_peer"       => false,
                                "verify_peer_name"  => false,
                                "allow_self_signed" => true
                            )
                        );
                        //Recipients
                        $mailGonder->setFrom(donusumleriGeriDondur($siteEmailAdresi), donusumleriGeriDondur($siteAdi));
                        $mailGonder->addAddress(donusumleriGeriDondur($gelenEmailAdresi), donusumleriGeriDondur($gelenIsimSoyisim));     //Add a recipient
                        $mailGonder->addReplyTo($siteEmailAdresi, $siteAdi);

                        //Content
                        $mailGonder->isHTML(true);                                  //Set email format to HTML
                        $mailGonder->Subject = donusumleriGeriDondur($siteAdi) . ' Yeni Üyelik Aktivasyonu';
                        $mailGonder->msgHTML($mailIcerigiHazirla);
                        $mailGonder->AltBody = 'This is the body in plain text for non-HTML mail clients';

                        $mailGonder->send();

                        header("Location:index.php?sayfaKodu=24");
                        exit();
                    }
                    catch (Exception $e) {
                        header("Location:index.php?sayfaKodu=25");
                        exit();
                    }
                }
                else{
                    header("Location:index.php?sayfaKodu=25");
                    exit();
                }
            }
        }
    }

}
else{
    header("Location:index.php?sayfaKodu=26");
    exit();
}
?>