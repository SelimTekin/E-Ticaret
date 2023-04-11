<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["siparisNo"])) {
        $gelenSiparisNo = guvenlik($_GET["siparisNo"]);
    } else {
        $gelenSiparisNo = "";
    }
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                <h3>&nbsp;SİPARİŞ DETAY</h3>
            </td>
            <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=108" style="color: #FFF; text-decoration: none;">Tamamlanan Siparişlere Dön&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>

        <?php
        $siparislerSorgusu            = $db->prepare("SELECT * FROM siparisler WHERE siparisNumarasi = ?");
        $siparislerSorgusu->execute([$gelenSiparisNo]);
        $siparislerSayisi             = $siparislerSorgusu->rowCount();
        $siparislerKayitlari          = $siparislerSorgusu->fetchAll(PDO::FETCH_ASSOC);


        if ($siparislerSayisi > 0) {
            $donguSayisi = 0;
            foreach ($siparislerKayitlari as $siparisler) {

                if ($siparisler["urunTuru"] == "Erkek Ayakkabısı") {
                    $resimKlasoru = "Erkek";
                } elseif ($siparisler["urunTuru"] == "Kadın Ayakkabısı") {
                    $resimKlasoru = "Kadin";
                } elseif ($siparisler["urunTuru"] == "Çocuk Ayakkabısı") {
                    $resimKlasoru = "Cocuk";
                }

        ?>
                <tr>
                    <td colspan="2" style="border-bottom: 1px dashed #CCC;" valign="top">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <?php
                            if ($donguSayisi == 0) {
                            ?>
                                <tr>
                                    <td colspan="3">
                                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="100"><b>Adı Soyadı</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="540"><?php echo donusumleriGeriDondur($siparisler["adresAdiSoyadi"]); ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">
                                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="100"><b>Telefon</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="540"><?php echo donusumleriGeriDondur($siparisler["adresTelefon"]); ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">
                                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="100"><b>Adres</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="540"><?php echo donusumleriGeriDondur($siparisler["adresDetay"]); ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">
                                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="100"><b>Gönderi Kodu</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="540"><?php echo donusumleriGeriDondur($siparisler["kargoGonderiKodu"]); ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td width="60" valign="top"><img src="../resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo donusumleriGeriDondur($siparisler["urunResmiBir"]); ?>" width="60" height="80">
                                </td>
                                <td width="10">&nbsp;</td>
                                <td width="680" valign="top">
                                    <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr height="25">
                                            <td width="680">
                                                <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="450" align="left"><?php echo donusumleriGeriDondur($siparisler["urunAdi"]); ?></td>
                                                        <td width="230" align="right"><?php echo donusumleriGeriDondur($siparisler["varyantBasligi"]); ?> : <?php echo donusumleriGeriDondur($siparisler["varyantSecimi"]); ?></td>
                                                    </tr>
                                                </table>
                                        </tr>

                                        <tr height="25">
                                            <td width="680">
                                                <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="50"><b>Fiyat</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="138"><?php echo fiyatBicimlendir(donusumleriGeriDondur($siparisler["urunFiyati"])); ?> TL</td>
                                                        <td width="50"><b>Adet</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="50"><?php echo donusumleriGeriDondur($siparisler["urunAdedi"]); ?></td>
                                                        <td width="115"><b>Toplam Fiyat</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="125"><?php echo fiyatBicimlendir(donusumleriGeriDondur($siparisler["toplamUrunFiyati"])); ?> TL</td>
                                                        <td width="85"><b>KDV Oranı</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="27">%<?php echo donusumleriGeriDondur($siparisler["kdvOrani"]); ?></td>
                                                    </tr>
                                                </table>
                                        </tr>

                                        <tr height="25">
                                            <td width="680">
                                                <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="50"><b>Ödeme</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="135"><?php echo donusumleriGeriDondur($siparisler["odemeSecimi"]); ?> TL</td>
                                                        <td width="50"><b>Taksit</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="50"><?php echo donusumleriGeriDondur($siparisler["taksitSecimi"]); ?></td>
                                                        <td width="65"><b>Karg</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="125"><?php echo donusumleriGeriDondur($siparisler["kargoFirmasiSecimi"]); ?> TL</td>
                                                        <td width="105"><b>Kargo Ücreti</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="65">%<?php echo fiyatBicimlendir(donusumleriGeriDondur($siparisler["kargoUcreti"])); ?> TL</td>
                                                    </tr>
                                                </table>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php
                $donguSayisi++;
            }
            ?>

        <?php
        } else {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=0");
            exit();
        }
        ?>
    </table>
<?php
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>