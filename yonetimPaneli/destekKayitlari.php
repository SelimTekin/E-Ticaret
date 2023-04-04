<?php
if (isset($_SESSION["yonetici"])) {
?>
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
        <?php
        $destekSorgusu            = $db->prepare("SELECT * FROM sorular ORDER BY soru ASC");
        $destekSorgusu->execute();
        $destekSayisi             = $destekSorgusu->rowCount();
        $destekKayitlari          = $destekSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($destekSayisi > 0) {
            foreach ($destekKayitlari as $destek) {
        ?>
                <tr>
                    <td colspan="2" style="border-bottom: 1px dashed #CCC;" valign="top">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr height="30">
                                <td align="left"><b><?php echo donusumleriGeriDondur($destek["soru"]); ?></b></td>
                            </tr>
                            <tr>
                                <td align="left"><?php echo donusumleriGeriDondur($destek["cevap"]); ?></td>
                            </tr>
                            <tr height="20">
                                <td align="left">
                                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr height="20">
                                            <td width="600">&nbsp;</td>
                                            <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=50&id=<?php echo donusumleriGeriDondur($destek["id"]) ?>"><img src="../resimler/Guncelleme20x20.png" border="0" alt="Güncelle Butonu"></a></td>
                                            <td width="70" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=50&id=<?php echo donusumleriGeriDondur($destek["id"]) ?>" style="color: #0000FF; text-decoration: none;">Güncelle</a></td>
                                            <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=54&id=<?php echo donusumleriGeriDondur($destek["id"]) ?>"><img src="../resimler/Sil20x20.png" border="0" alt="Sil Butonu"></a></td>
                                            <td width="42" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=54&id=<?php echo donusumleriGeriDondur($destek["id"]) ?>" style="color: #FF0000; text-decoration: none;">Sil</a></td>
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
                            <td width="750">Kayıtlı destek içeriği bulunmamaktadır.</td>
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