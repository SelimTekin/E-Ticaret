<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'frameworks/PHPMailer/src/Exception.php';
require 'frameworks/PHPMailer/src/PHPMailer.php';
require 'frameworks/PHPMailer/src/SMTP.php';

if (isset($_POST["emailAdresi"])) {
    $gelenEmailAdresi = guvenlik($_POST["emailAdresi"]);
} else {
    $gelenEmailAdresi = "";
}

if (isset($_POST["sifre"])) {
    $gelenSifre = guvenlik($_POST["sifre"]);
} else {
    $gelenSifre = "";
}

$MD5liSifre     = md5($gelenSifre);

if (($gelenEmailAdresi != "") and ($gelenSifre != "")) {

    $kontrolSorgusu  = $db->prepare("SELECT * FROM uyeler WHERE emailAdresi = ? AND sifre = ?");
    $kontrolSorgusu->execute([$gelenEmailAdresi, $MD5liSifre]);
    $kullaniciSayisi = $kontrolSorgusu->rowCount();
    $kullanicKaydi   = $kontrolSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($kullaniciSayisi > 0) {
        if ($kullanicKaydi["durumu"] == 1) {
            $_SESSION["kullanici"] = $gelenEmailAdresi;

            if ($_SESSION["kullanici"] == $gelenEmailAdresi) {
                header("Location:index.php?sayfaKodu=49");
                exit();
            } else {
                header("Location:index.php?sayfaKodu=33");
                exit();
            }
        } else {

            $mailIcerigiHazirla = "Merhaba Sayın " . $kullanicKaydi["isimSoyisim"] . "<br /><br />";
            $mailIcerigiHazirla .= "Sitemize yapmış olduğunuz üyelik kaydını tamamlamak için lütfen <a href='" . $siteLinki . "/aktivasyon.php?aktivasyonKodu=" . $kullanicKaydi["aktivasyonKodu"] . "&email=" . $kullanicKaydi["emailAdresi"] . ">BURAYA TIKLAYINIZ</a>.<br /><br />";
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
                $mailGonder->addAddress(donusumleriGeriDondur($kullanicKaydi["emailAdresi"]), donusumleriGeriDondur($kullanicKaydi["isimSoyisim"]));     //Add a recipient
                $mailGonder->addReplyTo($siteEmailAdresi, $siteAdi);

                //Content
                $mailGonder->isHTML(true);                                  //Set email format to HTML
                $mailGonder->Subject = donusumleriGeriDondur($siteAdi) . ' Yeni Üyelik Aktivasyonu';
                $mailGonder->msgHTML($mailIcerigiHazirla);

                $mailGonder->send();

                header("Location:index.php?sayfaKodu=36");
                exit();
            } catch (Exception $e) {
                header("Location:index.php?sayfaKodu=33");
                exit();
            }
        }
    } else {
        header("Location:index.php?sayfaKodu=34");
        exit();
    }
} else {
    header("Location:index.php?sayfaKodu=35");
    exit();
}
