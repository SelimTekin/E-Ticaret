<?php
if (isset($_SESSION["yonetici"])) {
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                <h3>&nbsp;KARGO AYARLARI</h3>
            </td>
            <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=22" style="color: #FFF; text-decoration: none;">Yeni Kargo Firması Ekle&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <?php
        $kargolarSorgusu            = $db->prepare("SELECT * FROM kargofirmalari ORDER BY kargoFirmasiAdi ASC");
        $kargolarSorgusu->execute();
        $kargolarSayisi             = $kargolarSorgusu->rowCount();
        $kargolarKayitlari          = $kargolarSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($kargolarSayisi > 0) {
            foreach ($kargolarKayitlari as $kargolar) {
        ?>
                <tr height="50">
                    <td colspan="2" style="border-bottom: 1px dashed #CCC;" valign="top">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr height="50">
                                <td width="200" align="left"><img src="../resimler/<?php echo donusumleriGeriDondur($kargolar["kargoFirmasiLogosu"]) ?>"></td>
                                <td width="10" align="left">&nbsp;</td>
                                <td width="150"><b>Kargo Firması Adı</b></td>
                                <td width="20"><b>:</b></td>
                                <td width="210"><?php echo donusumleriGeriDondur($kargolar["kargoFirmasiAdi"]) ?></td>
                                <td width="10" align="left">&nbsp;</td>
                                <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=26&id=<?php echo donusumleriGeriDondur($kargolar["id"]) ?>"><img src="../resimler/Guncelleme20x20.png" border="0" alt="Güncelle Butonu"></a></td>
                                <td width="70" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=26&id=<?php echo donusumleriGeriDondur($kargolar["id"]) ?>" style="color: #0000FF; text-decoration: none;">Güncelle</a></td>
                                <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=30&id=<?php echo donusumleriGeriDondur($kargolar["id"]) ?>"><img src="../resimler/Sil20x20.png" border="0" alt="Sil Butonu"></a></td>
                                <td width="30" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=30&id=<?php echo donusumleriGeriDondur($kargolar["id"]) ?>" style="color: #FF0000; text-decoration: none;">Sil</a></td>
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
                            <td width="750">Kayıtlı kargo firması bulunmamaktadır.</td>
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