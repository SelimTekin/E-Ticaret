<?php
if (isset($_SESSION["kullanici"])) { // üye girişi yapılmışsa hesabım sayfasına yönlendirir. Giriş yapmadan url üzerinden bu sayfaya erişilmesini engeller.
?>

    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">

        <tr>
            <td colspan="3"><hr /></td>
        </tr>

        <tr>
            <td colspan="3">
                <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="203" style="border:1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?sayfaKodu=50" style="text-decoration: none; color: black;">Üyelik Bilgilerim</a></td>
                        <td width="10">&nbsp;</td>
                        <td width="203" style="border:1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?sayfaKodu=58" style="text-decoration: none; color: black;">Adresler</a></td>
                        <td width="10">&nbsp;</td>
                        <td width="203" style="border:1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?sayfaKodu=59" style="text-decoration: none; color: black;">Favoriler</a></td>
                        <td width="10">&nbsp;</td>
                        <td width="203" style="border:1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?sayfaKodu=60" style="text-decoration: none; color: black;">Yorumlar</a></td>
                        <td width="10">&nbsp;</td>
                        <td width="203" style="border:1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?sayfaKodu=61" style="text-decoration: none; color: black;">Siparişler</a></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="3"><hr /></td>
        </tr>

        <tr>
            <td width="500" valign="top">
                <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color: #FF9900;">
                            <h3>Hesabım > Üyelik Bilgilerim</h3>
                        </td>
                    </tr>
                    <tr height="40">
                        <td valign="30" style="border-bottom: 1px dashed #CCC;">Aşağıdan üyelik bilgilerini görüntüleyebilir veya güncelleyebilirsin.</td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left"><b>İsim Soyisim</b></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><?php echo $isimSoyisim; ?></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left"><b>Cinsiyet</b></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><?php echo $cinsiyet; ?></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left"><b>E-Mail Adresi</b></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><?php echo $emailAdresi; ?></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left"><b>Telefon Numarası</b></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><?php echo $telefonNumarasi; ?></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left"><b>Kayıt Tarihi</b></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><?php echo tarihCevir($kayitTarihi); ?></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left"><b>Kayıt IP Adresi</b></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><?php echo $kayitIpAdresi; ?></td>
                    </tr>

                    <tr height="30">
                        <td align="center"><a href="index.php?sayfaKodu=51" class="bilgilerimiGuncelleButonu">Bilgilerimi Güncellemek İstiyorum</a></td>
                    </tr>

                </table>
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
    header("Location: index.php");
    exit();
}
?>