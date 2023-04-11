<?php
if (isset($_SESSION["yonetici"])) {

    $bekleyenSiparislerSorgusu = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler WHERE onayDurumu = ? AND kargoDurumu = ?");
    $bekleyenSiparislerSorgusu->execute([0, 0]);
    $bekleyenSiparislerSayisi  = $bekleyenSiparislerSorgusu->rowCount();

    $tamamlananSiparislerSorgusu = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler WHERE onayDurumu = ? AND kargoDurumu = ?");
    $tamamlananSiparislerSorgusu->execute([1, 1]);
    $tamamlananSiparislerSayisi  = $tamamlananSiparislerSorgusu->rowCount();

    $tumSiparislerSorgusu = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler");
    $tumSiparislerSorgusu->execute();
    $tumSiparislerSayisi  = $tumSiparislerSorgusu->rowCount();
    
    $havaleBildirimSorgusu = $db->prepare("SELECT * FROM havalebildirimleri");
    $havaleBildirimSorgusu->execute();
    $havaleBildirimSayisi  = $havaleBildirimSorgusu->rowCount();

    $banakalarSorgusu = $db->prepare("SELECT * FROM bankahesaplarimiz");
    $banakalarSorgusu->execute();
    $banakalarSayisi  = $banakalarSorgusu->rowCount();

    $menulerSorgusu = $db->prepare("SELECT * FROM menuler");
    $menulerSorgusu->execute();
    $menulerSayisi  = $menulerSorgusu->rowCount();

    $urunlerSorgusu = $db->prepare("SELECT * FROM urunler");
    $urunlerSorgusu->execute();
    $urunlerSayisi  = $urunlerSorgusu->rowCount();

    $uyelerSorgusu = $db->prepare("SELECT * FROM uyeler");
    $uyelerSorgusu->execute();
    $uyelerSayisi  = $uyelerSorgusu->rowCount();

    $yoneticilerSorgusu = $db->prepare("SELECT * FROM yoneticiler");
    $yoneticilerSorgusu->execute();
    $yoneticilerSayisi  = $yoneticilerSorgusu->rowCount();

    $kargolarSorgusu = $db->prepare("SELECT * FROM kargofirmalari");
    $kargolarSorgusu->execute();
    $kargolarSayisi  = $kargolarSorgusu->rowCount();

    $bannerlarSorgusu = $db->prepare("SELECT * FROM bannerlar");
    $bannerlarSorgusu->execute();
    $bannerlarSayisi  = $bannerlarSorgusu->rowCount();

    $yorumlarSorgusu = $db->prepare("SELECT * FROM yorumlar");
    $yorumlarSorgusu->execute();
    $yorumlarSayisi  = $yorumlarSorgusu->rowCount();

    $sorularSorgusu = $db->prepare("SELECT * FROM sorular");
    $sorularSorgusu->execute();
    $sorularSayisi  = $sorularSorgusu->rowCount();
    
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">

        <tr height="70">
            <td bgcolor="#FF9900" style="color: #FFF" align="left">
                <h3>&nbsp;PANO</h3>
            </td>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td>
                <table width="749" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="243" style="border: 1px solid #CCC;">
                            <table width="243" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Bekleyen Siparişler</td>
                                </tr>
                                <tr height="40">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $bekleyenSiparislerSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCC;">
                            <table width="243" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Tamamlanan Siparişler</td>
                                </tr>
                                <tr height="40">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $tamamlananSiparislerSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCC;">
                            <table width="243" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Tüm Siparişler</td>
                                </tr>
                                <tr height="40">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $tumSiparislerSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>

        <tr>
            <td>
                <table width="749" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="243" style="border: 1px solid #CCC;">
                            <table width="243" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Havale Bildirimleri</td>
                                </tr>
                                <tr height="40">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $havaleBildirimSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCC;">
                            <table width="243" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Banka Hesapları</td>
                                </tr>
                                <tr height="40">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $banakalarSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCC;">
                            <table width="243" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Menü Sayısı</td>
                                </tr>
                                <tr height="40">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $menulerSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>

        <tr>
            <td>
                <table width="749" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="243" style="border: 1px solid #CCC;">
                            <table width="243" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Ürünler</td>
                                </tr>
                                <tr height="40">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $urunlerSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCC;">
                            <table width="243" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Üyeler</td>
                                </tr>
                                <tr height="40">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $uyelerSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCC;">
                            <table width="243" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Yöneticiler</td>
                                </tr>
                                <tr height="40">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $yoneticilerSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>

        <tr>
            <td>
                <table width="749" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="243" style="border: 1px solid #CCC;">
                            <table width="243" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Kargolar</td>
                                </tr>
                                <tr height="40">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $kargolarSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCC;">
                            <table width="243" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Bannerlar</td>
                                </tr>
                                <tr height="40">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $bannerlarSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCC;">
                            <table width="243" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Yorumlar</td>
                                </tr>
                                <tr height="40">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $yorumlarSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>

        <tr>
            <td>
                <table width="749" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="243" style="border: 1px solid #CCC;">
                            <table width="243" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Destek İçerikleri</td>
                                </tr>
                                <tr height="40">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $sorularSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243">&nbsp;</td>
                        <td width="10">&nbsp;</td>
                        <td width="243">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
<?php
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>