<?php
if (isset($_SESSION["yonetici"])) {
?>
    <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=2" method="post" enctype="multipart/form-data">
        <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="70">
                <td bgcolor="#FF9900" style="color: #FFF">
                    <h3>&nbsp;SİTE AYARLARI</h3>
                </td>
            </tr>
            <tr height="10">
                <td style="font-size: 10px;">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr height="40">
                            <td width="230">Site Adı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="siteAdi" value="<?php echo donusumleriGeriDondur($siteAdi); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Site Title</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="siteTitle" value="<?php echo donusumleriGeriDondur($siteTitle); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Site Description</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="siteDescription" value="<?php echo donusumleriGeriDondur($siteDescription); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Site Keywords</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="siteKeywords" value="<?php echo donusumleriGeriDondur($siteKeywords); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Site Copyright Metni</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="siteCopyrightMetni" value="<?php echo donusumleriGeriDondur($siteCopyrightMetni); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Site Logosu</td>
                            <td width="20">:</td>
                            <td width="500"><input type="file" name="siteLogosu"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Site Linki</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="siteLinki" value="<?php echo donusumleriGeriDondur($siteLinki); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Site Email Adresi</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="siteEmailAdresi" value="<?php echo donusumleriGeriDondur($siteEmailAdresi); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Site Email Şifresi</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="siteEmailSifresi" value="<?php echo donusumleriGeriDondur($siteEmailSifresi); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Site Email Host Adresi</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="siteEmailHostAdresi" value="<?php echo donusumleriGeriDondur($siteEmailHostAdresi); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Facebook Linki</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="facebook" value="<?php echo donusumleriGeriDondur($facebook); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Twitter Linki</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="twitter" value="<?php echo donusumleriGeriDondur($twitter); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">LinkedIn Linki</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="linkedin" value="<?php echo donusumleriGeriDondur($linkedin); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Instagram Linki</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="instagram" value="<?php echo donusumleriGeriDondur($instagram); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Pinterest Linki</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="pinterest" value="<?php echo donusumleriGeriDondur($pinterest); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Youtube Linki</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="youtube" value="<?php echo donusumleriGeriDondur($youtube); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Dolar Kuru</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="dolarKuru" value="<?php echo donusumleriGeriDondur($dolarKuru); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Euro Kuru</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="euroKuru" value="<?php echo donusumleriGeriDondur($euroKuru); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Ücretsiz Kargo Barajı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="ucretsizKargoBaraji" value="<?php echo donusumleriGeriDondur($ucretsizKargoBaraji); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Sanal Pos ClientID</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="clientId" value="<?php echo donusumleriGeriDondur($clientId); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Sanal Pos StoreKey</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="storeKey" value="<?php echo donusumleriGeriDondur($storeKey); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Sanal Pos API Adı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="apiKullanicisi" value="<?php echo donusumleriGeriDondur($apiKullanicisi); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Sanal Pos API Şifresi</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="apiSifresi" value="<?php echo donusumleriGeriDondur($apiSifresi); ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td width="500"><input type="submit" value="Ayarları Kaydet" class="maviButon"></td>
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