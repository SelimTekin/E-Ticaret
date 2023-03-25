<?php
if(isset($_SESSION["kullanici"])){ // üye girişi yapılmışsa hesabım sayfasına yönlendirir. Giriş yapmadan url üzerinden bu sayfaya erişilmesini engeller.
?>

<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="500"  valign="top">
            <form action="index.php?sayfaKodu=52" method="post">
                <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color: #FF9900;"><h3>Hesabım > Üyelik Bilgilerim</h3></td>
                    </tr>
                    <tr height="40">
                        <td valign="30" style="border-bottom: 1px dashed #CCC;">Aşağıdan üyelik bilgilerini görüntüleyebilir veya güncelleyebilirsin.</td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">E-Mail Adresi (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="mail" name="emailAdresi" class="inputAlanlari" value="<?php echo $emailAdresi; ?>"></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">Şifre (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="password" name="sifre" class="inputAlanlari" value="eskiSifre"></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">Şifre Tekrar (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="password" name="sifreTekrar" class="inputAlanlari" value="eskiSifre"></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">İsim Soyisim (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="isimSoyisim" class="inputAlanlari" value="<?php echo $isimSoyisim; ?>"></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">Telefon Numarası (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="telefonNumarasi" class="inputAlanlari" value="<?php echo $telefonNumarasi; ?>" maxlength="11"></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">Cinsiyet (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><select name="cinsiyet" id="cinsiyet" class="selectAlanlari">
                            <option value="erkek" <?php if($cinsiyet=="erkek"){ ?> selected="selected" <?php } ?>>Erkek</option>
                            <option value="kadin" <?php if($cinsiyet=="kadin"){ ?> selected="selected" <?php } ?>>Kadın</option>
                        </select></td>
                    </tr>

                    <tr height="40">
                        <td colspan="2" align="center"><input type="submit" value="Bilgilerimi Güncelle" class="maviButon"></td>
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