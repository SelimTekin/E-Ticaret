<?php
if (isset($_SESSION["yonetici"])) {
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                <h3>&nbsp;SİPARİŞLER (BEKLEYEN)</h3>
            </td>
            <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=108" style="color: #FFF; text-decoration: none;">Tamamlanan Siparişler&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <?php
        // yönetici onayladı mı ve kargo durumu kontrolü
        $siparisNumaralariSorgusu = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler WHERE onayDurumu = ? AND kargoDurumu = ? ORDER BY id DESC");
        $siparisNumaralariSorgusu->execute([0, 0]);
        $siparisNumaralariSayisi     = $siparisNumaralariSorgusu->rowCount();
        $siparisNumaralariKayitlari  = $siparisNumaralariSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($siparisNumaralariSayisi > 0) {
            foreach ($siparisNumaralariKayitlari as $siparisNumarasi) {

                $siparislerSorgusu            = $db->prepare("SELECT * FROM siparisler WHERE siparisNumarasi = ? AND onayDurumu = ? AND kargoDurumu = ?");
                $siparislerSorgusu->execute([$siparisNumarasi["siparisNumarasi"], 0, 0]);
                $siparisSayisi                = $siparislerSorgusu->rowCount();
                $siparisKayitlari             = $siparislerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                if ($siparisSayisi > 0) {
                    $toplamFiyat = 0;
                    foreach ($siparisKayitlari as $siparis) {
                        $urunToplamFiyati = $siparis["toplamUrunFiyati"];
                        $siparisTarihi    = tarihCevir($siparis["siparisTarihi"]);

                        $toplamFiyat      += $urunToplamFiyati;
                    }
        ?>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px dashed #CCC;" valign="top">
                            <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="left" width="120"><b>Sipariş Tarihi</b></td>
                                    <td align="left" width="20"><b>:</b></td>
                                    <td align="left" width="200"><?php echo $siparisTarihi; ?></td>
                                    <td align="left" width="120"><b>Sipariş Tutarı</b></td>
                                    <td align="left" width="20"><b>:</b></td>
                                    <td align="left" width="140"><?php echo fiyatBicimlendir($toplamFiyat); ?> TL</td>
                                    <td align="left" width="130">
                                        <table width="130" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=113&siparisNo=<?php echo donusumleriGeriDondur($siparisNumarasi["siparisNumarasi"]) ?>"><img src="../resimler/Sil20x20.png" border="0" alt="Sil Butonu"></a></td>
                                                <td width="30" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=113&siparisNo=<?php echo donusumleriGeriDondur($siparisNumarasi["siparisNumarasi"]) ?>" style="color: #FF0000; text-decoration: none;">Sil</a></td>
                                                <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=107&siparisNo=<?php echo donusumleriGeriDondur($siparisNumarasi["siparisNumarasi"]) ?>"><img src="../resimler/DokumanKirmiziKalemli20x20.png" border="0" alt="Güncelle Butonu"></a></td>
                                                <td width="50" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=107&siparisNo=<?php echo donusumleriGeriDondur($siparisNumarasi["siparisNumarasi"]) ?>" style="color: #0000FF; text-decoration: none;">Detay</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
            <?php
                } else {
                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=0");
                    exit();
                }
            }
        } else {
            ?>
            <tr>
                <td colspan="2">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="750">Kayıtlı yeni sipariş bulunmamaktadır.</td>
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