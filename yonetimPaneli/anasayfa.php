<?php
if (isset($_SESSION["yonetici"])) {
?>
    <table width="1065" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="100%">
            <td width="300" align="center" bgcolor="#001d26" valign="top">
                <table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="70">
                        <td align="center"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=0"><img src="../resimler/logo.png" alt="Site Logosu" border="0"></a></td>
                    </tr>
                    <tr height="2">
                        <td align="center" bgcolor="#FF0000" style="line-height: 2px; font-size: 2px;">&nbsp;</td>
                    </tr>
                    <tr height="50">
                        <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="anaMenuler"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=xxxxx">&nbsp;SİPARİŞLER</a></td>
                    </tr>
                    <tr height="50">
                        <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="anaMenuler"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=xxxxx">&nbsp;HAVALE BİLDİRİMLERİ</a></td>
                    </tr>
                    <tr height="50">
                        <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="anaMenuler"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=xxxxx">&nbsp;ÜRÜNLER</a></td>
                    </tr>
                    <tr height="50">
                        <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="anaMenuler"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=xxxxx">&nbsp;ÜYELER</a></td>
                    </tr>
                    <tr height="50">
                        <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="anaMenuler"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=xxxxx">&nbsp;YORUMLAR</a></td>
                    </tr>
                    <tr height="50">
                        <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="anaMenuler"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=xxxxx">&nbsp;SİTE AYARLARI</a></td>
                    </tr>
                    <tr height="50">
                        <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="anaMenuler"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=xxxxx">&nbsp;MENÜLER</a></td>
                    </tr>
                    <tr height="50">
                        <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="anaMenuler"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=xxxxx">&nbsp;BANKA HESAP AYARLARI</a></td>
                    </tr>
                    <tr height="50">
                        <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="anaMenuler"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=xxxxx">&nbsp;SÖZLEŞMELER ve METİNLER</a></td>
                    </tr>
                    <tr height="50">
                        <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="anaMenuler"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=xxxxx">&nbsp;KARGO AYARLARI</a></td>
                    </tr>
                    <tr height="50">
                        <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="anaMenuler"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=xxxxx">&nbsp;BANNER AYARLARI</a></td>
                    </tr>
                    <tr height="50">
                        <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="anaMenuler"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=xxxxx">&nbsp;DESTEK İÇERİKLERİ</a></td>
                    </tr>
                    <tr height="50">
                        <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="anaMenuler"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=xxxxx">&nbsp;YÖNETİCİLER</a></td>
                    </tr>
                </table>
            </td>
            <td width="5" align="center" bgcolor="#FF0000" valign="top"></td>
            <td width="760" align="center" valign="top">
                <?php
                    if ((!$icSayfaKoduDegeri) or ($icSayfaKoduDegeri == "") or ($icSayfaKoduDegeri == 0)) {
                        include($sayfaIc[0]);
                    } else {
                        include($sayfaIc[$icSayfaKoduDegeri]);
                    }
                ?>
            </td>
        </tr>
    </table>
<?php
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>