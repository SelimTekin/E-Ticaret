<?php
session_start();
ob_start(); // çıktı tamponları (Birtakım değerleri alıp depolayacağız. Bunları yeri geldiğinde kullanacağız. ob_start() bu işe yarar.)
// ob_end_flush() çıktı tamponlarını hem boşaltır hem kapatır. (Sayfanın altında)
// ob_end_clean() silip kapatır.
require_once("../ayarlar/ayar.php");
require_once("../ayarlar/fonksiyonlar.php");
require_once("../ayarlar/yonetimSayfalariDis.php");
require_once("../ayarlar/yonetimSayfalariIc.php");

if(isset($_REQUEST["sayfaKoduIc"])){
    $icSayfaKoduDegeri =  sayiIcerenIcerikleriFiltrele($_REQUEST["sayfaKoduIc"]);
}
else{
    $icSayfaKoduDegeri = 0;
}

if(isset($_REQUEST["sayfaKoduDis"])){
    $disSayfaKoduDegeri =  sayiIcerenIcerikleriFiltrele($_REQUEST["sayfaKoduDis"]);
}
else{
    $disSayfaKoduDegeri = 0;
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
    <meta name="robots" content="noindex, nofollow, noarchive"> <!-- noindex, nofollow ve noarchive -> Bu sayfayı indeksleME, takip etME ve arşive alma  -->
    <meta name="googlebot" content="noindex, nofollow, noarchive"> <!-- ikisi aynı -->
    <meta name="revisit-after" content="7 Days"> <!-- Arama motoru bu siteyi bir daha ne zaman ziyaret etsin. 7 gün yaptık. İçerik sürekli değişmiyorsa arama motorunu her gün çağırmak sitemize eksi değer verir -->
    <title><?php echo donusumleriGeriDondur($siteTitle); ?></title>
    <link type="image/png" rel="icon" href="../resimler/logo.png">
    <script type="text/javascript" src="../Frameworks/jquery/jquery-3.6.3.min.js" language="javascript"></script>
    <link type="text/css" rel="stylesheet" href="../Ayarlar/stilYonetim.css">
    <script type="text/javascript" src="../Ayarlar/fonksiyonlar.js" language="javascript"></script>
</head>

<body>
    <table width="1065" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="100%">
            <td align="center">
                <?php
                if(empty($_SESSION["yonetici"])){
                    if((!$disSayfaKoduDegeri) or ($disSayfaKoduDegeri == "") or ($disSayfaKoduDegeri == 0)){
                        include($sayfaDis[1]);
                    }
                    else{
                        include($sayfaDis[$disSayfaKoduDegeri]);
                    }
                }
                else{
                    if((!$disSayfaKoduDegeri) or ($disSayfaKoduDegeri == "") or ($disSayfaKoduDegeri == 0)){
                        include($sayfaDis[0]);
                    }
                    else{
                        include($sayfaDis[$disSayfaKoduDegeri]);
                    }
                }
                ?>
            </td>
        </tr>
    </table>
</body>

</html>
<?php
$db = null;
ob_end_flush(); // Çıktı tamponlarını boşaltıp kapattık
?>