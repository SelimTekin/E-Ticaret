<?php
if (isset($_SESSION["yonetici"])) {
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                <h3>&nbsp;YÖNETİCİLER</h3>
            </td>
            <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=70" style="color: #FFF; text-decoration: none;">Yeni Yönetici Ekle&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <?php
        $yoneticilerSorgusu            = $db->prepare("SELECT * FROM yoneticiler ORDER BY isimSoyisim ASC");
        $yoneticilerSorgusu->execute();
        $yoneticilerSayisi             = $yoneticilerSorgusu->rowCount();
        $yoneticilerKayitlari          = $yoneticilerSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($yoneticilerSayisi > 0) {
            foreach ($yoneticilerKayitlari as $yonetici) {
        ?>
                <tr>
                    <td colspan="2" style="border-bottom: 1px dashed #CCC;" valign="top">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr height="30">
                                <td align="left" width="150"><b><?php echo donusumleriGeriDondur($yonetici["kullaniciAdi"]); ?></b></td>
                                <td align="left" width="150"><?php echo donusumleriGeriDondur($yonetici["isimSoyisim"]); ?></td>
                                <td align="left" width="200"><?php echo donusumleriGeriDondur($yonetici["emailAdresi"]); ?></td>
                                <td align="left" width="100"><?php echo donusumleriGeriDondur($yonetici["telefonNumarasi"]); ?></td>
                                <td align="left" width="150">
                                    <table width="150" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=74&id=<?php echo donusumleriGeriDondur($yonetici["id"]) ?>"><img src="../resimler/Guncelleme20x20.png" border="0" alt="Güncelle Butonu"></a></td>
                                            <td width="70" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=74&id=<?php echo donusumleriGeriDondur($yonetici["id"]) ?>" style="color: #0000FF; text-decoration: none;">Güncelle</a></td>
                                            <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=78&id=<?php echo donusumleriGeriDondur($yonetici["id"]) ?>"><img src="../resimler/Sil20x20.png" border="0" alt="Sil Butonu"></a></td>
                                            <td width="42" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=78&id=<?php echo donusumleriGeriDondur($yonetici["id"]) ?>" style="color: #FF0000; text-decoration: none;">Sil</a></td>
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
                            <td width="750">Kayıtlı yönetici bulunmamaktadır.</td>
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