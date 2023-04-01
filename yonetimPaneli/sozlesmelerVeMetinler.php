<?php
if (isset($_SESSION["yonetici"])) {
?>
    <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=6" method="post">
        <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="70">
                <td bgcolor="#FF9900" style="color: #FFF">
                    <h3>&nbsp;SÖZLEŞMELER ve METİNLER</h3>
                </td>
            </tr>
            <tr height="10">
                <td style="font-size: 10px;">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="230" valign="top">Hakkımızda Metni</td>
                            <td width="20" valign="top">:</td>
                            <td width="500" valign="top"><textarea name="hakkimizdaMetni" class="textAreaAlanlari"><?php echo donusumleriGeriDondur($hakkimizdaMetni); ?></textarea></td>
                        </tr>
                        <tr>
                            <td width="230" valign="top">Üyelik Sözleşmesi Metni</td>
                            <td width="20" valign="top">:</td>
                            <td width="500" valign="top"><textarea name="uyelikSozlesmesiMetni" class="textAreaAlanlari"><?php echo donusumleriGeriDondur($uyelikSozlesmesiMetni); ?></textarea></td>
                        </tr>
                        <tr>
                            <td width="230" valign="top">Kullanım Koşulları Metni</td>
                            <td width="20" valign="top">:</td>
                            <td width="500" valign="top"><textarea name="kullanimKosullariMetni" class="textAreaAlanlari"><?php echo donusumleriGeriDondur($kullanimKosullariMetni); ?></textarea></td>
                        </tr>
                        <tr>
                            <td width="230" valign="top">Gizlilik Sözleşmesi Metni</td>
                            <td width="20" valign="top">:</td>
                            <td width="500" valign="top"><textarea name="gizlilikSozlesmesiMetni" class="textAreaAlanlari"><?php echo donusumleriGeriDondur($gizlilikSozlesmesiMetni); ?></textarea></td>
                        </tr>
                        <tr>
                            <td width="230" valign="top">Mesafeli Satış Sözleşmesi Metni</td>
                            <td width="20" valign="top">:</td>
                            <td width="500" valign="top"><textarea name="mesafeliSatisSozlesmesiMetni" class="textAreaAlanlari"><?php echo donusumleriGeriDondur($mesafeliSatisSozlesmesiMetni); ?></textarea></td>
                        </tr>
                        <tr>
                            <td width="230" valign="top">Teslimat Metni</td>
                            <td width="20" valign="top">:</td>
                            <td width="500" valign="top"><textarea name="teslimatMetni" class="textAreaAlanlari"><?php echo donusumleriGeriDondur($teslimatMetni); ?></textarea></td>
                        </tr>
                        <tr>
                            <td width="230" valign="top">İptal & İade & Değişim Metni</td>
                            <td width="20" valign="top">:</td>
                            <td width="500" valign="top"><textarea name="iptalIadeDegisimMetni" class="textAreaAlanlari"><?php echo donusumleriGeriDondur($iptalIadeDegisimMetni); ?></textarea></td>
                        </tr>
                        <tr height="40">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td width="500"><input type="submit" value="Metinleri Kaydet" class="maviButon"></td>
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