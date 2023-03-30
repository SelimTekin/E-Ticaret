<?php
if (empty($_SESSION["yonetici"])) {
?>
<form action="index.php?sayfaKoduDis=2" method="post">
<table width="500" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #000; padding: 20px;">
        <tr height="40">
            <td align="left" width="150">Yönetici Kullanıcı Adı</td>
            <td align="left" width="50">:</td>
            <td align="left" width="240"><input type="text" name="YKullanici" class="inputAlanlari"></td>
            <td align="left" width="20">&nbsp;</td>
        </tr>
        <tr height="40">
            <td align="left">Yönetici Şifresi</td>
            <td align="left">:</td>
            <td align="left"><input type="password" name="YSifre" class="inputAlanlari"></td>
            <td align="left">&nbsp;</td>
        </tr>
        <tr height="40">
            <td align="left">&nbsp;</td>
            <td align="left">&nbsp;</td>
            <td align="left"><input type="submit" value="Giriş Yap" class="maviButon"></td>
            <td align="left">&nbsp;</td>
        </tr>
    </table>
</form>
<?php } ?>