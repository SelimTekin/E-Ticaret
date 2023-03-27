<?php
if (isset($_SESSION["kullanici"])) {
    $stokIcinSepettekiUrunlerSorgusu = $db->prepare("SELECT * FROM sepet WHERE uyeId = ?");
    $stokIcinSepettekiUrunlerSorgusu->execute([$kullaniciId]);
    $stokIcinSepettekiUrunSayisi     = $stokIcinSepettekiUrunlerSorgusu->rowCount();
    $stokIcinSepettekiKayitlar       = $stokIcinSepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

    if ($stokIcinSepettekiUrunSayisi > 0) {
        foreach ($stokIcinSepettekiKayitlar as $stokIcinSepettekiSatirlar) {
            $stokIcinSepetIdsi                  = $stokIcinSepettekiSatirlar["id"];
            $stokIcinSepettekiUrununVaryantIdsi = $stokIcinSepettekiSatirlar["varyantId"];
            $stokIcinSepettekiUrununAdedi       = $stokIcinSepettekiSatirlar["urunAdedi"];

            $stokIcinUrunVaryantBilgileriSorgusu = $db->prepare("SELECT * FROM urunVaryantlari WHERE id = ? LIMIT 1");
            $stokIcinUrunVaryantBilgileriSorgusu->execute([$stokIcinSepettekiUrununVaryantIdsi]);
            $stokIcinVaryantKaydi                = $stokIcinUrunVaryantBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

            $stokIcinUrununStokAdedi = $stokIcinVaryantKaydi["stokAdedi"];

            if ($stokIcinUrununStokAdedi == 0) {
                $sepetSilSorgusu = $db->prepare("DELETE FROM sepet WHERE id = ? AND uyeId = ? LIMIT 1");
                $sepetSilSorgusu->execute([$stokIcinSepetIdsi, $kullaniciId]);
            } elseif ($stokIcinSepettekiUrununAdedi > $stokIcinUrununStokAdedi) {
                $sepetGuncellemeSorgusu = $db->prepare("UPDATE sepet SET urunAdedi = ? WHERE id = ? AND uyeId = ? LIMIT 1");
                $sepetGuncellemeSorgusu->execute([$stokIcinUrununStokAdedi, $stokIcinSepetIdsi, $kullaniciId]);
            }
        }
    }
?>
    <form action="index.php?sayfaKodu=99" method="post">
        <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="500" valign="top">
                    <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr height="40">
                            <td colspan="2" style="color: #FF9900;">
                                <h3>Alışveriş Sepeti</h3>
                            </td>
                        </tr>
                        <tr height="40">
                            <td colspan="2" valign="30" style="border-bottom: 1px dashed #CCC;">Adres ve Kargo Seçimini Aşağıdan Belirtebilirsin.</td>
                        </tr>
                        <tr height="10">
                            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
                        </tr>
                        <tr height="40">
                            <td align="left" style="background: #CCC; font-weight: bold;">&nbsp;Adres Seçimi</td>
                            <td align="right" style="background: #CCC; font-weight: bold;"><a href="index.php?sayfaKodu=70" style="color: #646464; text-decoration: none; font-weight: bold;">+ Yeni Adres Ekle&nbsp;</a></td>
                        </tr>
                        <?php
                        $sepettekiUrunlerSorgusu = $db->prepare("SELECT * FROM sepet WHERE uyeId = ? ORDER BY id DESC");
                        $sepettekiUrunlerSorgusu->execute([$kullaniciId]);
                        $sepettekiUrunSayisi  = $sepettekiUrunlerSorgusu->rowCount();
                        $sepettekiKayitlar       = $sepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                        if ($sepettekiUrunSayisi > 0) {
                            $sepettekiToplamUrunSayisi         = 0;
                            $sepettekiToplamFiyat              = 0;
                            $sepettekiToplamKargoFiyati        = 0;
                            $sepettekiToplamKargoFiyatiHesapla = 0;
                            $odenecekToplamTutariHesapla       = 0;

                            foreach ($sepettekiKayitlar as $sepetSatirlari) {
                                $sepetIdsi                  = $sepetSatirlari["id"];
                                $sepettekiUrununIdsi        = $sepetSatirlari["urunId"];
                                $sepettekiUrununVaryantIdsi = $sepetSatirlari["varyantId"];
                                $sepettekiUrununAdedi       = $sepetSatirlari["urunAdedi"];

                                $urunBilgileriSorgusu = $db->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
                                $urunBilgileriSorgusu->execute([$sepettekiUrununIdsi]);
                                $urunKaydi            = $urunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                                $urununFiyati         = $urunKaydi["urunFiyati"];
                                $urununParaBirimi     = $urunKaydi["paraBirimi"];
                                $urununKargoUcreti    = $urunKaydi["kargoUcreti"];

                                if ($urununParaBirimi == "USD") {
                                    $urunFiyatiHesapla           = ($urununFiyati * $dolarKuru);
                                    $urunFiyatiBicimlendir       = fiyatBicimlendir($urunFiyatiHesapla);
                                } elseif ($urununParaBirimi == "EUR") {
                                    $urunFiyatiHesapla     = ($urununFiyati * $euroKuru);
                                    $urunFiyatiBicimlendir = fiyatBicimlendir($urunFiyatiHesapla);
                                } else {
                                    $urunFiyatiHesapla     = $urununFiyati;
                                    $urunFiyatiBicimlendir = fiyatBicimlendir($urunFiyatiHesapla);
                                }

                                $urunToplamFiyatiHesapla     = ($urunFiyatiHesapla * $sepettekiUrununAdedi);
                                $urunToplamFiyatiBicimlendir = fiyatBicimlendir($urunToplamFiyatiHesapla);

                                $sepettekiToplamUrunSayisi += $sepettekiUrununAdedi;
                                $sepettekiToplamFiyat      += $urunFiyatiHesapla * $sepettekiUrununAdedi;

                                $sepettekiToplamKargoFiyatiHesapla     += ($urununKargoUcreti * $sepettekiUrununAdedi);
                                $sepettekiToplamKargoFiyatiBicimlendir = fiyatBicimlendir($sepettekiToplamKargoFiyatiHesapla);
                            }

                            if($sepettekiToplamFiyat >= $ucretsizKargoBaraji){
                                $sepettekiToplamKargoFiyatiHesapla     = 0;
                                $sepettekiToplamKargoFiyatiBicimlendir = fiyatBicimlendir($sepettekiToplamKargoFiyatiHesapla);

                                $odenecekToplamTutariBicimlendir = fiyatBicimlendir($sepettekiToplamFiyat);
                            }
                            else{
                                $odenecekToplamTutariHesapla     += ($sepettekiToplamFiyat + $sepettekiToplamKargoFiyatiHesapla);
                                $odenecekToplamTutariBicimlendir = fiyatBicimlendir($odenecekToplamTutariHesapla);
                            }

                            $adreslerSorgusu = $db->prepare("SELECT * FROM adresler WHERE uyeId = ? ORDER BY id DESC");
                            $adreslerSorgusu->execute([$kullaniciId]);
                            $adresSayisi     = $adreslerSorgusu->rowCount();
                            $adresKayitlari  = $adreslerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                            if ($adresSayisi > 0) {
                                foreach ($adresKayitlari as $adres) {

                        ?>

                                    <tr>
                                        <td  colspan="2" align="left">
                                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                                <tr height="50">
                                                    <td style="border-bottom: 1px dashed #CCC;" width="25" align="left"><input type="radio" name="adresSecimi" checked="checked" value="<?php echo donusumleriGeriDondur($adres["id"]); ?>"></td>
                                                    <td style="border-bottom: 1px dashed #CCC;" width="775" align="left"><?php echo $adres["adiSoyadi"]; ?> - <?php echo $adres["adres"]; ?> <?php echo $adres["ilce"]; ?> / <?php echo $adres["sehir"]; ?> - <?php echo $adres["telefonNumarasi"]; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                <?php
                                }
                            } else {
                                ?>

                                <tr height="30">
                                    <td  colspan="2" align="left">Sisteme kayıtlı adresiniz bulunmamaktadır. Adres eklemek için lütfen <a href="index.php?sayfaKodu=70" style="color: #646464; text-decoration: none; font-weight: bold;">buraya tıklayınız</a>.</td>
                                </tr>
                            <?php } ?>


                            <tr height="10">
                                <td colspan="2" style="font-size: 10px;">&nbsp;</td>
                            </tr>
                            <tr height="40">
                                <td colspan="2" align="left" style="background: #CCC; font-weight: bold;">&nbsp;Kargo Firması Seçimi</td>
                            </tr>
                            <tr height="10">
                                <td colspan="2" style="font-size: 10px;">&nbsp;</td>
                            </tr>
                            <tr height="40">
                                <td colspan="2" align="left">

                                    <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <?php

                                            $kargolarSorgusu = $db->prepare("SELECT * FROM kargofirmalari");
                                            $kargolarSorgusu->execute();
                                            $kargoSayisi     = $kargolarSorgusu->rowCount();
                                            $kargoKayitlari  = $kargolarSorgusu->fetchAll(PDO::FETCH_ASSOC);

                                            $donguSayisi = 1;
                                            $sutunAdetSayisi = 3;
                                            $secimIcinSayi = 1;

                                            foreach ($kargoKayitlari as $kargo) {
                                            ?>
                                                <td width="260">
                                                    <table width="260" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCC; margin-bottom: 10px;">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><img src="resimler/<?php echo donusumleriGeriDondur($kargo["kargoFirmasiLogosu"]); ?>" alt="Kargo Firması Logosu"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><input type="radio" name="kargoSecimi" <?php if($secimIcinSayi==1){ ?> checked="chedcked" <?php } ?> value="<?php echo donusumleriGeriDondur($kargo["id"]); ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <?php
                                                $secimIcinSayi++;
                                                if ($donguSayisi < $sutunAdetSayisi) {
                                                ?>
                                                    <td width="10">&nbsp;</td>
                                            <?php
                                                }
                                                $donguSayisi++;
                                                if ($donguSayisi > $sutunAdetSayisi) {
                                                    echo "<tr></tr>";
                                                    $donguSayisi = 1;
                                                }
                                            }
                                            ?>

                                        </tr>
                                    </table>
                                </td>
                            </tr>

                        <?php
                        } else {
                            header("index.php?sayfaKodu=94");
                            exit();
                        }
                        ?>
                    </table>
                </td>

                <td width="15">&nbsp;</td>

                <td width="250" valign="top">
                    <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr height="40">
                            <td style="color: #FF9900;" align="center">
                                <h3>Sipariş Özeti</h3>
                            </td>
                        </tr>
                        <tr height="40">
                            <td valign="30" style="border-bottom: 1px dashed #CCC;" align="center">Toplam <b style="color: red;"><?php echo $sepettekiToplamUrunSayisi; ?></b> Adet Ürün</td>
                        </tr>
                        <tr height="5">
                            <td height="5" style="font-size: 5px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="right">Ödenecek Tutar (KDV Dahil)</td>
                        </tr>
                        <tr>
                            <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $odenecekToplamTutariBicimlendir; ?> TL</td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px;">&nbsp;</td>
                        </tr>

                        <tr>
                            <td align="right">Ürünler Toplam Tutarı (KDV Dahil)</td>
                        </tr>
                        <tr>
                            <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo fiyatBicimlendir($sepettekiToplamFiyat); ?> TL</td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px;">&nbsp;</td>
                        </tr>

                        <tr>
                            <td align="right">Kargo Tutarı (KDV Dahil)</td>
                        </tr>
                        <tr>
                            <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $sepettekiToplamKargoFiyatiBicimlendir; ?> TL</td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px;">&nbsp;</td>
                        </tr>

                        <tr>
                            <td align="right">
                                <input type="submit" value="ÖDEME SEÇİMİ" class="alisverisiTamamlaButonu">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>

<?php
} else {
    header("Location: index.php");
    exit();
}
?>