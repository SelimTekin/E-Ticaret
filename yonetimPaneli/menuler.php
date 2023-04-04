<?php
if (isset($_SESSION["yonetici"])) {
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                <h3>&nbsp;MENÜLER</h3>
            </td>
            <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=58" style="color: #FFF; text-decoration: none;">Yeni Menü Ekle&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <?php
        $menulerSorgusu            = $db->prepare("SELECT * FROM menuler ORDER BY urunTuru ASC");
        $menulerSorgusu->execute();
        $menulerSayisi             = $menulerSorgusu->rowCount();
        $menulerKayitlari          = $menulerSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($menulerSayisi > 0) {
            foreach ($menulerKayitlari as $menu) {
        ?>
                <tr>
                    <td colspan="2" style="border-bottom: 1px dashed #CCC;" valign="top">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr height="30">
                                <td align="left" width="200"><b><?php echo donusumleriGeriDondur($menu["urunTuru"]); ?></b></td>
                                <td align="left" width="400"><?php echo donusumleriGeriDondur($menu["menuAdi"]); ?> (<?php echo donusumleriGeriDondur($menu["urunSayisi"]); ?>)</td>
                                <td align="left" width="150">
                                    <table width="150" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=62&id=<?php echo donusumleriGeriDondur($menu["id"]) ?>"><img src="../resimler/Guncelleme20x20.png" border="0" alt="Güncelle Butonu"></a></td>
                                            <td width="70" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=62&id=<?php echo donusumleriGeriDondur($menu["id"]) ?>" style="color: #0000FF; text-decoration: none;">Güncelle</a></td>
                                            <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=66&id=<?php echo donusumleriGeriDondur($menu["id"]) ?>"><img src="../resimler/Sil20x20.png" border="0" alt="Sil Butonu"></a></td>
                                            <td width="42" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=66&id=<?php echo donusumleriGeriDondur($menu["id"]) ?>" style="color: #FF0000; text-decoration: none;">Sil</a></td>
                                        </tr>
                                    </table>
                                </td>
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
                            <td width="750">Kayıtlı menü bulunmamaktadır.</td>
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