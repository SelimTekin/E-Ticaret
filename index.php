<?php
session_start();
ob_start(); // çıktı tamponları (Birtakım değerleri alıp depolayacağız. Bunları yeri geldiğinde kullanacağız. ob_start() bu işe yarar.)
// ob_end_flush() çıktı tamponlarını hem boşaltır hem kapatır. (Sayfanın altında)
// ob_end_clean() silip kapatır.
require_once("ayarlar/ayar.php");
require_once("ayarlar/fonksiyonlar.php");
require_once("ayarlar/siteSayfalari.php");

if(isset($_REQUEST["sayfaKodu"])){
    $sayfaKoduDegeri =  sayiIcerenIcerikleriFiltrele($_REQUEST["sayfaKodu"]);
}
else{
    $sayfaKoduDegeri = 0;
}

if(isset($_REQUEST["sayfalama"])){
    $sayfalama =  sayiIcerenIcerikleriFiltrele($_REQUEST["sayfalama"]);
}
else{
    $sayfalama = 1;
}

?>
<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="robots" content="index, follow"> <!-- indexlemek ve follow etmek -> Bu sayfa arama motoru indexine girecek, follow da sayfada bulunan url'ler linkler aram motoru tarafından takip edilecek demektir  -->
    <meta name="googlebot" content="index, follow"> <!-- ikisi aynı -->
    <meta name="revisit-after" content="7 Days"> <!-- Arama motoru bu siteyi bir daha ne zaman ziyaret etsin. 7 gün yaptık. İçerik sürekli değişmiyorsa arama motorunu her gün çağırmak sitemize eksi değer verir -->
    <title><?php echo donusumleriGeriDondur($siteTitle); ?></title>
    <link type="image/png" rel="icon" href="resimler/logo.png">
    <meta name="description" content="<?php echo donusumleriGeriDondur($siteDescription) ?>">
    <meta name="keywords" content="<?php echo donusumleriGeriDondur($siteKeywords) ?>">
    <script type="text/javascript" src="Frameworks/jquery/jquery-3.6.3.min.js" language="javascript"></script>
    <link type="text/css" rel="stylesheet" href="Ayarlar/stil.css">
    <script type="text/javascript" src="Ayarlar/fonksiyonlar.js" language="javascript"></script>
</head>

<body>
    <table width="1065" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="100" bgcolor="#646464">
            <td align="center"><img src="resimler/headerManset.jpeg" width="700" height="100" alt="resim" border="0"></td>
        </tr>
        <tr height="110">
            <td>
                <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr bgcolor="#0088CC">
                        <td>&nbsp;</td>
                        <?php
                        if(isset($_SESSION["kullanici"])){
                        ?>
                        <td width="20"><a href="index.php?sayfaKodu=50"><img src="resimler/KullaniciBeyaz16x16.png" alt="sepet" border="0" style="margin-top: 5px;"></a></td>
                        <td width="70" class="maviAlanMenusu"><a href="index.php?sayfaKodu=50">Hesabım</a></td>
                        <td width="20"><a href="index.php?sayfaKodu=49"><img src="resimler/CikisBeyaz16x16.png" alt="sepet" border="0" style="margin-top: 5px;"></a></td>
                        <td width="85" class="maviAlanMenusu"><a href="index.php?sayfaKodu=49">Çıkış Yap</a></td>
                        <?php
                        }
                        else{
                        ?>
                        <td width="20"><a href="index.php?sayfaKodu=31"><img src="resimler/KullaniciBeyaz16x16.png" alt="sepet" border="0" style="margin-top: 5px;"></a></td>
                        <td width="70" class="maviAlanMenusu"><a href="index.php?sayfaKodu=31">Giriş Yap</a></td>
                        <td width="20"><a href="index.php?sayfaKodu=22"><img src="resimler/KullaniciEkleBeyaz16x16.png" alt="sepet" border="0" style="margin-top: 5px;"></a></td>
                        <td width="85" class="maviAlanMenusu"><a href="index.php?sayfaKodu=22">Yeni Üye Ol</a></td>
                        <?php
                        }
                        ?>
                        <td width="20"><a href="xxxxx"><img src="resimler/SepetBeyaz16x16.png" alt="sepet" border="0" style="margin-top: 5px;"></a></td>
                        <td width="103" class="maviAlanMenusu"><a href="xxxxx">Alışveriş Sepeti</a></td>
                    </tr>
                </table>
                <table width="1065" height="80" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="360"><a href="index.php"><img src="resimler/<?php echo donusumleriGeriDondur($siteLogosu); ?>" alt="logo"></a></td>
                        <td>
                            <table width="915" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="474" class="anaMenu">&nbsp;</td>
                                    <td width="95" class="anaMenu"><a href="index.php?sayfaKodu=0">Ana Sayfa</a></td>
                                    <td width="148" class="anaMenu"><a href="index.php?sayfaKodu=84">Erkek Ayakkabıları</a></td>
                                    <td width="148" class="anaMenu"><a href="index.php?sayfaKodu=85">Kadın Ayakkabıları</a></td>
                                    <td width="145" class="anaMenu"><a href="index.php?sayfaKodu=86">Çocuk Ayakkabıları</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td valign="top">
                <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center">
                            <?php
                            
                            if((!$sayfaKoduDegeri) or ($sayfaKoduDegeri == "") or ($sayfaKoduDegeri == 0)){
                                include($sayfa[0]);
                            }
                            else{
                                include($sayfa[$sayfaKoduDegeri]);
                            }

                            ?><br />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr height="210">
            <td>
                <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#F9F9F9">
                    <tr height="30">
                        <td width="250" style="border-bottom: 1px dashed #CCC;">&nbsp;<b>Kurumsal</b></td>
                        <td width="22">&nbsp;</td>
                        <td width="250" style="border-bottom: 1px dashed #CCC;"><b>Üyelik & Hizmetler</b></td>
                        <td width="22">&nbsp;</td>
                        <td width="250" style="border-bottom: 1px dashed #CCC;"><b>Sözleşmeler</b></td>
                        <td width="21">&nbsp;</td>
                        <td width="250" style="border-bottom: 1px dashed #CCC;"><b>Bizi Takip Edin</b></td>
                    </tr>
                    <tr height="30">
                        <td class="altMenu">&nbsp;<a href="index.php?sayfaKodu=1">Hakkımızda</a></td>
                        <td>&nbsp;</td>
                        <?php
                        if(isset($_SESSION["kullanici"])){
                        ?>
                        <td class="altMenu"><a href="index.php?sayfaKodu=50">Hesabım</a></td>
                        <?php
                        }
                        else{
                        ?>
                        <td class="altMenu"><a href="index.php?sayfaKodu=31">Giriş Yap</a></td>
                        <?php
                        }
                        ?>
                        <td>&nbsp;</td>
                        <td class="altMenu"><a href="index.php?sayfaKodu=2">Üyelik Sözleşmesi</a></td>
                        <td>&nbsp;</td>
                        <td>
                            <table width="250" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="20" class="altMenu"><a href="xxxxx"><img src="resimler/Facebook16x16.png" alt="facebook" border="0" style="margin-top: 5px;"></a></td>
                                    <td width="230" class="altMenu"><a href="<?php echo donusumleriGeriDondur($facebook); ?>" target="_blank ">Facebook</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td class="altMenu">&nbsp;<a href="index.php?sayfaKodu=8">Banka Hesaplarımız</a></td>
                        <td>&nbsp;</td>
                        <?php
                        if(isset($_SESSION["kullanici"])){
                        ?>
                        <td class="altMenu"><a href="index.php?sayfaKodu=49">Çıkış Yap</a></td>
                        <?php
                        }
                        else{
                        ?>
                        <td class="altMenu"><a href="index.php?sayfaKodu=22">Yeni Üye Ol</a></td>
                        <?php
                        }
                        ?>
                        <td>&nbsp;</td>
                        <td class="altMenu"><a href="index.php?sayfaKodu=3">Kullanım Koşulları</a></td>
                        <td>&nbsp;</td>
                        <td>
                            <table width="250" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="20" class="altMenu"><a href="xxxxx"><img src="resimler/Twitter16x16.png" alt="Twitter" border="0" style="margin-top: 5px;"></a></td>
                                    <td width="230" class="altMenu"><a href="<?php echo donusumleriGeriDondur($twitter); ?>" target="_bla">Twitter</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td class="altMenu">&nbsp;<a href="index.php?sayfaKodu=9">Havale Bildirim Formu</a></td>
                        <td>&nbsp;</td>
                        <td class="altMenu"><a href="index.php?sayfaKodu=21">Sık Sorulan Sorular</a></td>
                        <td>&nbsp;</td>
                        <td class="altMenu"><a href="index.php?sayfaKodu=4">Gizlilik Sözleşmesi</a></td>
                        <td>&nbsp;</td>
                        <td>
                            <table width="250" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="20" class="altMenu"><a href="xxxxx"><img src="resimler/LinkedIn16x16.png" alt="LinkedIn" border="0" style="margin-top: 5px;"></a></td>
                                    <td width="230" class="altMenu"><a href="<?php echo donusumleriGeriDondur($linkedin); ?>" target="_blank ">LinkedIn</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td class="altMenu">&nbsp;<a href="index.php?sayfaKodu=14">Kargo Nerede?</a></td>
                        <td>&nbsp;</td>
                        <td></td>
                        <td>&nbsp;</td>
                        <td class="altMenu"><a href="index.php?sayfaKodu=5">Mesafeli Satış Sözleşmesi</a></td>
                        <td>&nbsp;</td>
                        <td>
                            <table width="250" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="20" class="altMenu"><a href="xxxxx"><img src="resimler/Instagram16x16.png" alt="Instagram" border="0" style="margin-top: 5px;"></a></td>
                                    <td width="230" class="altMenu"><a href="<?php echo donusumleriGeriDondur($instagram); ?>" target="_blank">Instagram</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td class="altMenu">&nbsp;<a href="index.php?sayfaKodu=16">İletişim</a></td>
                        <td>&nbsp;</td>
                        <td></td>
                        <td>&nbsp;</td>
                        <td class="altMenu"><a href="index.php?sayfaKodu=6">Teslimat</a></td>
                        <td>&nbsp;</td>
                        <td>
                            <table width="250" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="20" class="altMenu"><a href="xxxxx"><img src="resimler/YouTube16x16.png" alt="YouTube" border="0" style="margin-top: 5px;"></a></td>
                                    <td width="230" class="altMenu"><a href="<?php echo donusumleriGeriDondur($youtube); ?>" target="_bla">YouTube</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td></td>
                        <td>&nbsp;</td>
                        <td class="altMenu"><a href="index.php?sayfaKodu=7">İptal & İade & Değişim</a></td>
                        <td>&nbsp;</td>
                        <td>
                            <table width="250" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="20" class="altMenu"><a href="xxxxx"><img src="resimler/Pinterest16x16.png" alt="Pinterest" border="0" style="margin-top: 5px;"></a></td>
                                    <td width="230" class="altMenu"><a href="<?php echo donusumleriGeriDondur($pinterest); ?>" target="_blank">Pinterest</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr height="30">
            <td>
                <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center"><?php echo donusumleriGeriDondur($siteCopyrightMetni); ?></td>
                    </tr>
            </td>
        </tr>
        <tr height="30">
            <td>
                <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center"><img src="resimler/RapidSSL32x12.png" alt="ssl" border="0" style="margin-right: 5px;">
                        <img src="resimler/InternetteGuvenliAlisveris28x12.png" alt="guvenliAlisveris" border="0" style="margin-right: 5px;">
                        <img src="resimler/3DSecure14x12.png" alt="ssl" border="0" style="margin-right: 5px;">
                        <img src="resimler/BonusCard41x12.png" alt="bonusCard" border="0" style="margin-right: 5px;">
                        <img src="resimler/MaximumCard46x12.png" alt="maximumCard" border="0" style="margin-right: 5px;">
                        <img src="resimler/WorldCard48x12.png" alt="worldCard" border="0" style="margin-right: 5px;">
                        <img src="resimler/CardFinans78x12.png" alt="cardFinans" border="0" style="margin-right: 5px;">
                        <img src="resimler/AxessCard46x12.png" alt="axessCard" border="0" style="margin-right: 5px;">
                        <img src="resimler/ParafCard19x12.png" alt="axessCard" border="0" style="margin-right: 5px;">
                        <img src="resimler/VisaCard37x12.png" alt="axessCard" border="0" style="margin-right: 5px;">
                        <img src="resimler/MasterCard21x12.png" alt="axessCard" border="0" style="margin-right: 5px;">
                        <img src="resimler/AmericanExpiress20x12.png" alt="axessCard" border="0" style="margin-right: 5px;">
                    </td>
                    </tr>
            </td>
        </tr>
    </table>
</body>

</html>
<?php
$db = null;
ob_end_flush(); // Çıktı tamponlarını boşaltıp kapattık
?>