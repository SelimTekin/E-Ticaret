<?php
if (isset($_SESSION["yonetici"])) {
?>
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
        <?php
        $bannerlarSorgusu            = $db->prepare("SELECT * FROM bannerlar ORDER BY id DESC");
        $bannerlarSorgusu->execute();
        $bannerlarSayisi             = $bannerlarSorgusu->rowCount();
        $bannerlarKayitlari          = $bannerlarSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($bannerlarSayisi > 0) {
            foreach ($bannerlarKayitlari as $bannerlar) {
        ?>
                <tr height="40">
                    <td colspan="2" style="border-bottom: 1px dashed #CCC;" valign="top">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr height="40">
                                <td width="175" align="left"><img src="../resimler/<?php echo donusumleriGeriDondur($bannerlar["bannerResmi"]) ?>" height="30"></td>

                                <td width="575" align="left">
                                    <table width="575" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr height="20">
                                            <td width="50" align="left"><b>Adı</b></td>
                                            <td width="10" align="left"><b>:</b></td>
                                            <td width="150" align="left"><?php echo donusumleriGeriDondur($bannerlar["bannerAdi"]) ?></td>
                                            <td width="50" align="left"><b>Yeri</b></td>
                                            <td width="10" align="left"><b>:</b></td>
                                            <td width="125" align="left"><?php echo donusumleriGeriDondur($bannerlar["bannerAlani"]) ?></td>
                                            <td width="50" align="left"><b>Hit</b></td>
                                            <td width="10" align="left"><b>:</b></td>
                                            <td width="50" align="left"><?php echo donusumleriGeriDondur($bannerlar["gosterimSayisi"]) ?></td>
                                        </tr>
                                        <tr height="20">
                                            <td colspan="9">
                                                <table width="575" align="right" border="0" cellpadding="0" cellspacing="0">
                                                    <tr height="20">
                                                        <td width="425">&nbsp;</td>
                                                        <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=38&id=<?php echo donusumleriGeriDondur($bannerlar["id"]) ?>"><img src="../resimler/Guncelleme20x20.png" border="0" alt="Güncelle Butonu"></a></td>
                                                        <td width="70" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=38&id=<?php echo donusumleriGeriDondur($bannerlar["id"]) ?>" style="color: #0000FF; text-decoration: none;">Güncelle</a></td>
                                                        <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=42&id=<?php echo donusumleriGeriDondur($bannerlar["id"]) ?>"><img src="../resimler/Sil20x20.png" border="0" alt="Sil Butonu"></a></td>
                                                        <td width="42" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=42&id=<?php echo donusumleriGeriDondur($bannerlar["id"]) ?>" style="color: #FF0000; text-decoration: none;">Sil</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="2">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="750">Kayıtlı banner bulunmamaktadır.</td>
                        </tr>
                    </table>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>