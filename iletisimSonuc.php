<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'frameworks/PHPMailer/src/Exception.php';
require 'frameworks/PHPMailer/src/PHPMailer.php';
require 'frameworks/PHPMailer/src/SMTP.php';


if(isset($_POST["isimSoyisim"])){
    $gelenIsimSoyisim = guvenlik($_POST["isimSoyisim"]);
}
else{
    $gelenIsimSoyisim = "";
}

if(isset($_POST["emailAdresi"])){
    $gelenEmailAdresi = guvenlik($_POST["emailAdresi"]);
}
else{
    $gelenEmailAdresi = "";
}

if(isset($_POST["telefonNumarasi"])){
    $gelenTelefonNumarasi = guvenlik($_POST["telefonNumarasi"]);
}
else{
    $gelenTelefonNumarasi = "";
}

if(isset($_POST["mesaj"])){
    $gelenMesaj = guvenlik($_POST["mesaj"]);
}
else{
    $gelenMesaj = "";
}

if( ($gelenIsimSoyisim!="") and ($gelenEmailAdresi!="") and ($gelenTelefonNumarasi!="") and ($gelenMesaj!="") ){

    $mailIcerigiHazirla = "İsim Soyisim : " . $gelenIsimSoyisim . "<br />E-mail Adresi : " . $gelenEmailAdresi . "<br />Telefon Numarası : " . $gelenTelefonNumarasi . "<br />Mesajı : " . $gelenMesaj;
    
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
        $mailGonder->addAddress(donusumleriGeriDondur($siteEmailAdresi), donusumleriGeriDondur($siteAdi));     //Add a recipient
        $mailGonder->addReplyTo($gelenEmailAdresi, $gelenIsimSoyisim);

        //Content
        $mailGonder->isHTML(true);                                  //Set email format to HTML
        $mailGonder->Subject = donusumleriGeriDondur($siteAdi) . ' İletişim Formu Mesajı';
        $mailGonder->msgHTML($mailIcerigiHazirla);
        $mailGonder->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mailGonder->send();
        
        header("Location:index.php?sayfaKodu=18");
        exit();

    } catch (Exception $e) {
        header("Location:index.php?sayfaKodu=19");
        exit();
    }

}
else{
    header("Location:index.php?sayfaKodu=20");
    exit();
}
?>