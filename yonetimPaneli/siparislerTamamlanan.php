<?php
if (isset($_SESSION["yonetici"])) {
    $sayfalamaIcinSolveSagButonSayisi   = 2;
    $sayfaBasinaGosterilecekKayitSayisi = 1 ;

    $toplamKayitSayisiSorgusu           = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler WHERE onayDurumu = ? AND kargoDurumu = ? ORDER BY id DESC");
    $toplamKayitSayisiSorgusu->execute([1, 1]);
    $toplamKayitSayisi                  = $toplamKayitSayisiSorgusu->rowCount();
    $toplamKayitSayisiKayitlari         = $toplamKayitSayisiSorgusu->fetchAll(PDO::FETCH_ASSOC);

    $sayfalamayaBaslanacakKayitSayisi   = ($sayfalama * $sayfaBasinaGosterilecekKayitSayisi) - $sayfaBasinaGosterilecekKayitSayisi;
    $bulunanSayfaSayisi                 = ceil($toplamKayitSayisi / $sayfaBasinaGosterilecekKayitSayisi); // 6.1 olursa yukarı yuvarlar ve 7 sayfa olur
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                <h3>&nbsp;SİPARİŞLER (TAMAMLANAN)</h3>
            </td>
            <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=106" style="color: #FFF; text-decoration: none;">Bekleyen Siparişler&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <?php
        // yönetici onayladı mı ve kargo durumu kontrolü
        $siparisNumaralariSorgusu = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler WHERE onayDurumu = ? AND kargoDurumu = ? ORDER BY id DESC LIMIT $sayfalamayaBaslanacakKayitSayisi, $sayfaBasinaGosterilecekKayitSayisi");
        $siparisNumaralariSorgusu->execute([1, 1]);
        $siparisNumaralariSayisi     = $siparisNumaralariSorgusu->rowCount();
        $siparisNumaralariKayitlari  = $siparisNumaralariSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($siparisNumaralariSayisi > 0) {
            foreach ($siparisNumaralariKayitlari as $siparisNumarasi) {

                $siparislerSorgusu            = $db->prepare("SELECT * FROM siparisler WHERE siparisNumarasi = ? AND onayDurumu = ? AND kargoDurumu = ?");
                $siparislerSorgusu->execute([$siparisNumarasi["siparisNumarasi"], 1, 1]);
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
                                    <td align="left" width="225"><?php echo $siparisTarihi; ?></td>
                                    <td align="left" width="120"><b>Sipariş Tutarı</b></td>
                                    <td align="left" width="20"><b>:</b></td>
                                    <td align="left" width="170"><?php echo fiyatBicimlendir($toplamFiyat); ?> TL</td>
                                    <td align="left" width="75">
                                        <table width="75" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=109&siparisNo=<?php echo donusumleriGeriDondur($siparisNumarasi["siparisNumarasi"]) ?>"><img src="../resimler/DokumanKirmiziKalemli20x20.png" border="0" alt="Güncelle Butonu"></a></td>
                                                <td width="50" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=109&siparisNo=<?php echo donusumleriGeriDondur($siparisNumarasi["siparisNumarasi"]) ?>" style="color: #0000FF; text-decoration: none;">Detay</a></td>
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

            if ($bulunanSayfaSayisi > 1) {

                ?>

                <tr height="50">
                    <td colspan="8" align="center">
                        <div class="sayfalamaAlaniKapsayicisi">
                            <div class="sayfalamaAlaniIciMetinAlaniKapsayicisi">
                                Toplam <?php echo $bulunanSayfaSayisi; ?> sayfada, <?php echo $toplamKayitSayisi; ?> adet kayıt bulunmaktadır.
                            </div>
                            <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
                                <?php
                                if ($sayfalama > 1) {
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=108&sayfalama=1'><<</a></span>";
                                    $sayfalamaIcinSayfaDegeriBirGeriAl = $sayfalama - 1;
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=108&sayfalama=" . $sayfalamaIcinSayfaDegeriBirGeriAl . "'><</a></span>";
                                }

                                for ($sayfalamaIcinSayfaIndexDegeri = $sayfalama - $sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri <= $sayfalama + $sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri++) {
                                    if (($sayfalamaIcinSayfaIndexDegeri > 0) and ($sayfalamaIcinSayfaIndexDegeri <= $bulunanSayfaSayisi)) {
                                        if ($sayfalama == $sayfalamaIcinSayfaIndexDegeri) {
                                            echo "<span class='sayfalamaAktif'>" . $sayfalamaIcinSayfaIndexDegeri . "</span>";
                                        } else {
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=108&sayfalama=" . $sayfalamaIcinSayfaIndexDegeri . "'>$sayfalamaIcinSayfaIndexDegeri</a></span>";
                                        }
                                    }
                                }

                                if ($sayfalama != $bulunanSayfaSayisi) {
                                    $sayfalamaIcinSayfaDegeriBirIleriAl = $sayfalama + 1;
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=108&sayfalama=" . $sayfalamaIcinSayfaDegeriBirIleriAl . "'>></a></span>";
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=108&sayfalama=" . $bulunanSayfaSayisi . "'>>></a></span>";
                                }
                                ?>
                            </div>
                        </div>
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
                            <td width="750">Kayıtlı tamamlanan sipariş bulunmamaktadır.</td>
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