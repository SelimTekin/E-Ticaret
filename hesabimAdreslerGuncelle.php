<?php
if ($_SESSION["kullanici"]) { // üye girişi yapılmışsa hesabım sayfasına yönlendirir. Giriş yapmadan url üzerinden bu sayfaya erişilmesini engeller.
    if (isset($_GET["id"])) {
        $gelenId = $_GET["id"];
    } else {
        $gelenId = "";
    }

    if ($gelenId != "") {
        $adresSorgusu = $db->prepare("SELECT * FROM adresler WHERE id = ? AND uyeId = ? LIMIT 1");
        $adresSorgusu->execute([$gelenId, $kullaniciId]);
        $adresSayisi  = $adresSorgusu->rowCount();
        $kayitBilgisi = $adresSorgusu->fetch(PDO::FETCH_ASSOC);

        if ($adresSayisi > 0) {

?>

            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="500" valign="top">
                        <form action="index.php?sayfaKodu=63&id=<?php echo $gelenId; ?>" method="post">
                            <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="40">
                                    <td style="color: #FF9900;">
                                        <h3>Hesabım > Adresler</h3>
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td valign="30" style="border-bottom: 1px dashed #CCC;">Tüm adreslerini görüntüleyebilir veya güncelleyebilirsin.</td>
                                </tr>

                                <tr height="30">
                                    <td valign="bottom" align="left">İsim Soyisim (*)</td>
                                </tr>
                                <tr height="30">
                                    <td valign="top" align="left"><input type="text" name="isimSoyisim" class="inputAlanlari" value="<?php echo $kayitBilgisi["adiSoyadi"] ?>"></td>
                                </tr>

                                <tr height="30">
                                    <td valign="bottom" align="left">Adres (*)</td>
                                </tr>
                                <tr height="30">
                                    <td valign="top" align="left"><input type="text" name="adres" class="inputAlanlari" value="<?php echo $kayitBilgisi["adres"] ?>"></td>
                                </tr>

                                <tr height="30">
                                    <td valign="bottom" align="left">İlçe (*)</td>
                                </tr>
                                <tr height="30">
                                    <td valign="top" align="left"><input type="text" name="ilce" class="inputAlanlari" value="<?php echo $kayitBilgisi["ilce"] ?>"></td>
                                </tr>

                                <tr height="30">
                                    <td valign="bottom" align="left">Şehir (*)</td>
                                </tr>
                                <tr height="30">
                                    <td valign="top" align="left"><input type="text" name="sehir" class="inputAlanlari" value="<?php echo $kayitBilgisi["sehir"] ?>"></td>
                                </tr>

                                <tr height="30">
                                    <td valign="bottom" align="left">Telefon Numarası (*)</td>
                                </tr>
                                <tr height="30">
                                    <td valign="top" align="left"><input type="text" name="telefonNumarasi" class="inputAlanlari" value="<?php echo $kayitBilgisi["telefonNumarasi"] ?>" maxlength="11"></td>
                                </tr>


                                <tr height="40">
                                    <td colspan="2" align="center"><input type="submit" value="Adresi Güncelle" class="maviButon"></td>
                                </tr>

                            </table>
                        </form>
                    </td>

                    <td width="20">&nbsp;</td>

                    <td width="545" valign="top">
                        <table width="545" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr height="40">
                                <td style="color: #FF9900;">
                                    <h3>Reklam</h3>
                                </td>
                            </tr>
                            <tr height="40">
                                <td valign="30" style="border-bottom: 1px dashed #CCC;">demo.net Reklamları</td>
                            </tr>
                            <tr>
                                <td style="font-size: 5px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><img src="#" alt="reklam" title="reklam" border="0"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

<?php

        } else {
            header("Location: index.php?sayfaKodu=65");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKodu=65");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>