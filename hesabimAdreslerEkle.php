<?php
if(isset($_SESSION["kullanici"])){ // üye girişi yapılmışsa hesabım sayfasına yönlendirir. Giriş yapmadan url üzerinden bu sayfaya erişilmesini engeller.
?>

<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="500"  valign="top">
            <form action="index.php?sayfaKodu=71" method="post">
                <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color: #FF9900;"><h3>Hesabım > Adresler</h3></td>
                    </tr>
                    <tr height="40">
                        <td valign="30" style="border-bottom: 1px dashed #CCC;">Tüm adreslerini görüntüleyebilir veya güncelleyebilirsin.</td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">İsim Soyisim (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="isimSoyisim" class="inputAlanlari"></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">Adres (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="adres" class="inputAlanlari"></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">İlçe (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="ilce" class="inputAlanlari"></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">Şehir (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="sehir" class="inputAlanlari"></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">Telefon Numarası (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="telefonNumarasi" class="inputAlanlari" maxlength="11"></td>
                    </tr>


                    <tr height="40">
                        <td colspan="2" align="center"><input type="submit" value="Adresi Kaydet" class="maviButon"></td>
                    </tr>

                </table>
            </form>
        </td>

        <td width="20">&nbsp;</td>

        <td width="545" valign="top">
            <table width="545" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="40">
                    <td style="color: #FF9900;"><h3>Reklam</h3></td>
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
}
else{
    header("Location: index.php");
    exit();
}
?>