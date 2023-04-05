<?php
if (isset($_SESSION["yonetici"])) {
?>
    <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=71" method="post" enctype="multipart/form-data">
        <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="70">
                <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                    <h3>&nbsp;YÖNETİCİLER</h3>
                </td>
                <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=70" style="color: #FFF; text-decoration: none;">Yeni Yönetici Ekle&nbsp;</a></td>
            </tr>
            <tr height="10">
                <td colspan="2" style="font-size: 10px;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">

                        <tr height="40">
                            <td width="230">Kullanıcı Adı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="kullaniciAdi" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Şifre</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="sifre" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">İsim Soyisim</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="isimSoyisim" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">E-Mail Adresi</td>
                            <td width="20">:</td>
                            <td width="500"><input type="email" name="emailAdresi" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Telefon Numarası</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="telefonNumarasi" class="inputAlanlari" maxlength="11"></td>
                        </tr>
                        <tr height="40">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td width="500"><input type="submit" value="Yönetici Kaydet" class="maviButon"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
<?php
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>