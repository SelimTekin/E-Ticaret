<?php
if (isset($_SESSION["yonetici"])) {
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                <h3>&nbsp;BANKA HESAP AYARLARI</h3>
            </td>
            <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=10" style="color: #FFF; text-decoration: none;">Yeni Banka Hesabı Ekle&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <?php
        $hesaplarSorgusu            = $db->prepare("SELECT * FROM bankahesaplarimiz ORDER BY bankaAdi ASC");
        $hesaplarSorgusu->execute();
        $hesaplarSayisi             = $hesaplarSorgusu->rowCount();
        $hesaplarKayitlari          = $hesaplarSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($hesaplarSayisi > 0) {
            foreach ($hesaplarKayitlari as $hesaplar) {
        ?>
                <tr height="105">
                    <td colspan="2" style="border-bottom: 1px dashed #CCC;" valign="top">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="200">
                                    <table width="200" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr height="75">
                                            <td align="center">
                                                <img src="../resimler/<?php echo donusumleriGeriDondur($hesaplar["bankaLogosu"]) ?>">
                                            </td>
                                        </tr height="30">
                                        <tr>
                                            <td align="center">
                                                <table width="200" align="right" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=14&id=<?php echo donusumleriGeriDondur($hesaplar["id"]) ?>"><img src="../resimler/Guncelleme20x20.png" border="0" alt="Güncelle Butonu"></a></td>
                                                        <td width="70" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=14&id=<?php echo donusumleriGeriDondur($hesaplar["id"]) ?>" style="color: #0000FF; text-decoration: none;">Güncelle</a></td>
                                                        <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=18&id=<?php echo donusumleriGeriDondur($hesaplar["id"]) ?>"><img src="../resimler/Sil20x20.png" border="0" alt="Sil Butonu"></a></td>
                                                        <td width="80" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=18&id=<?php echo donusumleriGeriDondur($hesaplar["id"]) ?>" style="color: #FF0000; text-decoration: none;">Sil</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="10">&nbsp;</td>
                                <td width="540">
                                    <table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr height="90">
                                            <td>
                                                <table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
                                                    <tr height="35">
                                                        <td>
                                                            <table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td width="100"><b>Banka Adı</b></td>
                                                                    <td width="20"><b>:</b></td>
                                                                    <td width="140"><?php echo donusumleriGeriDondur($hesaplar["bankaAdi"]) ?></td>
                                                                    <td width="115"><b>Hesap Sahibi</b></td>
                                                                    <td width="20"><b>:</b></td>
                                                                    <td width="145"><?php echo donusumleriGeriDondur($hesaplar["hesapSahibi"]) ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr height="35">
                                                        <td>
                                                            <table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td width="180"><b>Şube ve Konum Bilgileri</b></td>
                                                                    <td width="20"><b>:</b></td>
                                                                    <td width="340"><?php echo donusumleriGeriDondur($hesaplar["subeAdi"]) ?> (<?php echo donusumleriGeriDondur($hesaplar["subeKodu"]) ?>) - <?php echo donusumleriGeriDondur($hesaplar["konumSehir"]) ?> / <?php echo donusumleriGeriDondur($hesaplar["konumUlke"]) ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr height="35">
                                                        <td>
                                                            <table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td width="110"><b>Hesap Bilgileri</b></td>
                                                                    <td width="20"><b>:</b></td>
                                                                    <td width="410"><?php echo donusumleriGeriDondur($hesaplar["paraBirimi"]) ?> / <?php echo donusumleriGeriDondur($hesaplar["hesapNumarasi"]) ?> / <?php echo donusumleriGeriDondur($hesaplar["ibanNumarasi"]) ?></td>
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
                <td width="750">Kayıtlı banka hesabı bulunmamaktadır.</td>
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