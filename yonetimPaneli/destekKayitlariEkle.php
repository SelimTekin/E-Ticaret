<?php
if (isset($_SESSION["yonetici"])) {
?>
    <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=47" method="post" enctype="multipart/form-data">
        <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="70">
                <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                    <h3>&nbsp;DESTEK İÇERİKLERİ</h3>
                </td>
                <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=46" style="color: #FFF; text-decoration: none;">Yeni Destek İçeriği Ekle&nbsp;</a></td>
            </tr>
            <tr height="10">
                <td colspan="2" style="font-size: 10px;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">

                        <tr height="40">
                            <td width="230">Soru</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="soru" class="inputAlanlari"></td>
                        </tr>
                        <tr>
                            <td width="230" valign="top">Cevap</td>
                            <td width="20" valign="top">:</td>
                            <td width="500"><textarea name="cevap" id="cevap" cols="30" rows="10" class="textAreaAlanlari"></textarea></td>
                        </tr>
                        <tr height="40">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td width="500"><input type="submit" value="Destek İçeriği Kaydet" class="maviButon"></td>
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