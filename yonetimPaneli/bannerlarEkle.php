<?php
if (isset($_SESSION["yonetici"])) {
?>
    <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=35" method="post" enctype="multipart/form-data">
        <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="70">
                <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                    <h3>&nbsp;BANNER AYARLARI</h3>
                </td>
                <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=34" style="color: #FFF; text-decoration: none;">Yeni Banner Ekle&nbsp;</a></td>
            </tr>
            <tr height="10">
                <td colspan="2" style="font-size: 10px;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">

                        <tr height="40">
                            <td width="230">Banner Alanı</td>
                            <td width="20">:</td>
                            <td width="500"><select name="bannerAlani" id="bannerAlani" class="selectAlanlari">
                                <option value="">Lütfen Seçiniz</option>
                                <option value="Ana Sayfa">Ana Sayfa</option>
                                <option value="Menu Altı">Menu Altı</option>
                                <option value="Ürün Detay">Ürün Detay</option>
                            </select></td>
                        </tr>

                        <tr height="40">
                            <td width="230">Banner Resmi</td>
                            <td width="20">:</td>
                            <td width="500"><input type="file" name="bannerResmi"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Banner Adı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="bannerAdi" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td width="500"><input type="submit" value="Banner Kaydet" class="maviButon"></td>
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