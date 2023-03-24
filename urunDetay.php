<?php
if (isset($_GET["id"])) {
    $gelenId     = sayiIcerenIcerikleriFiltrele(guvenlik($_GET["id"]));

    $urunHitiGuncellemeSorgusu = $db->prepare("UPDATE urunler SET goruntulenmeSayisi=goruntulenmeSayisi+1 WHERE id = ? AND durumu = ? LIMIT 1");
    $urunHitiGuncellemeSorgusu->execute([$gelenId, 1]);

    $urunSorgusu = $db->prepare("SELECT * FROM urunler WHERE id = ? AND durumu = ? LIMIT 1");
    $urunSorgusu->execute([$gelenId, 1]);
    $urunSayisi = $urunSorgusu->rowCount();
    $urunSorgusuKaydi = $urunSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($urunSayisi > 0) {
        $urunTuru = $urunSorgusuKaydi["urunTuru"];
        if ($urunTuru == "Erkek Ayakkabısı") {
            $resimKlasoru = "Erkek";
        } elseif ($urunTuru == "Kadın Ayakkabısı") {
            $resimKlasoru = "Kadin";
        } elseif ($urunTuru == "Çocuk Ayakkabısı") {
            $resimKlasoru = "Cocuk";
        }

        $urunFiyati     = donusumleriGeriDondur($urunSorgusuKaydi["urunFiyati"]);
        $urunParaBirimi = donusumleriGeriDondur($urunSorgusuKaydi["paraBirimi"]);

        if ($urunParaBirimi == "USD") {
            $urunFiyatiHesapla = $urunFiyati * $dolarKuru;
        } elseif ($urunParaBirimi == "EUR") {
            $urunFiyatiHesapla = $urunFiyati * $euroKuru;
        } else {
            $urunFiyatiHesapla = $urunFiyati;
        }

?>
        <table width="1065" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="350" valign="top">
                    <table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="border: 1px solid #CCC;" align="center"><img id="buyukResim" src="resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo donusumleriGeriDondur($urunSorgusuKaydi["urunResmiBir"]); ?>" width="330" height="440" alt="Ürün Resmi" border="0"></td>
                        </tr>
                        <tr height="5">
                            <td style="font-size: 5px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="78" style="border: 1px solid #CCC;"><img src="resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo donusumleriGeriDondur($urunSorgusuKaydi["urunResmiBir"]); ?>" width="78" height="104" alt="Ürün Resmi" border="0" onclick="$.urunDetayResmiDegistir('<?php echo $resimKlasoru; ?>', '<?php echo donusumleriGeriDondur($urunSorgusuKaydi['urunResmiBir']) ?>')"></td>
                                        <td width="10">&nbsp;</td>

                                        <?php if ($urunSorgusuKaydi["urunResmiIki"] != "") { ?>
                                            <td width="78" style="border: 1px solid #CCC;"><img src="resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo donusumleriGeriDondur($urunSorgusuKaydi["urunResmiIki"]); ?>" width="78" height="104" alt="Ürün Resmi" border="0" onclick="$.urunDetayResmiDegistir('<?php echo $resimKlasoru; ?>', '<?php echo donusumleriGeriDondur($urunSorgusuKaydi['urunResmiIki']) ?>')"></td>
                                        <?php } else { ?>
                                            <td width="78">&nbsp;</td>
                                        <?php } ?>
                                        <td width="10">&nbsp;</td>

                                        <?php if ($urunSorgusuKaydi["urunResmiUc"] != "") { ?>
                                            <td width="78" style="border: 1px solid #CCC;"><img src="resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo donusumleriGeriDondur($urunSorgusuKaydi["urunResmiUc"]); ?>" width="78" height="104" alt="Ürün Resmi" border="0" onclick="$.urunDetayResmiDegistir('<?php echo $resimKlasoru; ?>', '<?php echo donusumleriGeriDondur($urunSorgusuKaydi['urunResmiUc']) ?>')"></td>
                                        <?php } else { ?>
                                            <td width="78">&nbsp;</td>
                                        <?php } ?>
                                        <td width="10">&nbsp;</td>

                                        <?php if ($urunSorgusuKaydi["urunResmiDort"] != "") { ?>
                                            <td width="78" style="border: 1px solid #CCC;"><img src="resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo donusumleriGeriDondur($urunSorgusuKaydi["urunResmiDort"]); ?>" width="78" height="104" alt="Ürün Resmi" border="0" onclick="$.urunDetayResmiDegistir('<?php echo $resimKlasoru; ?>', '<?php echo donusumleriGeriDondur($urunSorgusuKaydi['urunResmiIki']) ?>')"></td>
                                        <?php } else { ?>
                                            <td width="78">&nbsp;</td>
                                        <?php } ?>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="350" align="center" border="0" cellpadding="0" cellspacing="0">

                                    <tr height="50">
                                        <td bgcolor="#F1F1F1"><b>&nbsp;REKLAMLAR</b></td>
                                    </tr>
                                    <?php
                                    $bannerSorgusu  = $db->prepare("SELECT * FROM bannerlar WHERE bannerAlani = 'Ürün Detay' ORDER BY gosterimSayisi ASC LIMIT 1");
                                    $bannerSorgusu->execute();
                                    $bannerSayisi   = $bannerSorgusu->rowCount();
                                    $bannerKaydi    = $bannerSorgusu->fetch(PDO::FETCH_ASSOC);
                                    ?>

                                    <tr height="350">
                                        <td><img src="resimler/<?php echo donusumleriGeriDondur($bannerKaydi["bannerResmi"]); ?>" alt="Banner Resmi" border="0" width="350" height="350"></td>
                                    </tr>
                                    <?php
                                    $bannerGuncelle  = $db->prepare("UPDATE bannerlar SET gosterimSayisi=gosterimSayisi+1 WHERE id = ?");
                                    $bannerGuncelle->execute([donusumleriGeriDondur($bannerKaydi["id"])]);
                                    ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="10" valign="top">&nbsp;</td>
                <td width="705" valign="top">
                    <table width="705" align="center" border="0" cellpadding="0" cellspacing="0">

                        <tr height="50" bgcolor="#F1F1F1">
                            <td style="text-align: left; font-size: 18px; font-weight: bold;">&nbsp;<?php echo donusumleriGeriDondur($urunSorgusuKaydi["urunAdi"]); ?></td>
                        </tr>

                        <tr>
                            <td>
                                <form action="index.php?sayfaKodu=91&id=<?php echo donusumleriGeriDondur($urunSorgusuKaydi["id"]); ?>" method="post">
                                    <table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
                                        <tr height="45">
                                            <td width="30"><a href="<?php echo donusumleriGeriDondur($facebook); ?>" target="_blank "><img src="resimler/Facebook24x24.png" alt="facebook" border="0" style="margin-top: 5px;"></a></td>
                                            <td width="30"><a href="<?php echo donusumleriGeriDondur($twitter); ?>" target="_blank "><img src="resimler/Twitter24x24.png" alt="twitter" border="0" style="margin-top: 5px;"></a></td>
                                            <td width="30">
                                                <?php if (isset($_SESSION["kullanici"])) { ?>
                                                    <a href="index.php?sayfaKodu=87&id=<?php echo $urunSorgusuKaydi["id"]; ?>"><img src="resimler/KalpKirmiziDaireliBeyaz24x24.png" alt="Favorilere Ekle" border="0" style="margin-top: 5px;"></a>
                                                <?php } else { ?>
                                                    <a href="index.php?sayfaKodu=31"><img src="resimler/KalpKirmiziDaireliBeyaz24x24.png" alt="Favorilere Ekle" border="0"></a>
                                                <?php } ?>
                                            </td>
                                            <td width="30">&nbsp;</td>
                                            <td width="605">
                                                <input type="submit" value="SEPETE EKLE" class="sepeteEkleButonu">
                                            </td>
                                        </tr>

                                        <tr height="45">
                                            <td colspan="5">
                                                <table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
                                                    <tr height="45">
                                                        <td width="500" align="left">
                                                            <select name="varyant" id="varyant" class="selectAlanlari">
                                                                <option value="">Lütfen <?php echo donusumleriGeriDondur($urunSorgusuKaydi["varyantBasligi"]); ?> Seçiniz</option>
                                                                <?php
                                                                $varyantSorgusu = $db->prepare("SELECT * FROM urunvaryantlari WHERE urunId = ? AND stokAdedi > ? ORDER BY varyantAdi ASC");
                                                                $varyantSorgusu->execute([donusumleriGeriDondur($urunSorgusuKaydi["id"]), 0]);
                                                                $varyantSayisi = $varyantSorgusu->rowCount();
                                                                $varyantKayitlari = $varyantSorgusu->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($varyantKayitlari as $varyant){
                                                                ?>
                                                                <option value="<?php echo $varyant["id"] ?>"><?php echo donusumleriGeriDondur($varyant["varyantAdi"]); ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td width="205" align="right" style="font-size: 24px; color: black; font-weight: bold;"><?php echo fiyatBicimlendir($urunFiyatiHesapla); ?> TL</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </td>
                        </tr>

                        <tr>
                            <td><hr /></td>
                        </tr>

                        <tr>
                            <td>
                                <table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr height="30">
                                        <td><img src="resimler/SaatEsnetikGri20x20.png" alt="Kargo" border="0" style="margin-top: 5px;"></td>
                                        <td>Siparişiniz <?php echo ucGunIleriTarihBul(); ?> tarihine kadar kargoya verilecektir.</td>
                                    </tr>
                                    <tr height="30">
                                    <td>
                                        <img src="resimler/SaatHizCizgiliLacivert20x20.png" alt="Kargo" border="0" style="margin-top: 5px;"></td>
                                        <td>İlgili ürün süper hızlı gönderi kapsamındadır. Aynı gün teslimat yapılabilir.</td>
                                    </tr>
                                    <td>
                                        <img src="resimler/KrediKarti20x20.png" alt="Kargo" border="0" style="margin-top: 5px;"></td>
                                        <td>Tüm bankaların kredi kartları ile peşin veya taksitli ödeme seçeneği.</td>
                                    </tr>
                                    <td>
                                        <img src="resimler/Banka20x20.png" alt="Kargo" border="0" style="margin-top: 5px;"></td>
                                        <td>Tüm bankalardan havale veya EFT ile ödeme seçeneği.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><hr /></td>
                        </tr>
                        <tr height="30">
                            <td style="background: #FF9900; color: white;">&nbsp;Ürün Açıklaması</td>
                        </tr>
                        <tr>
                            <td><?php echo donusumleriGeriDondur($urunSorgusuKaydi["urunAciklamasi"]); ?></td>
                        </tr>
                        <tr>
                            <td><hr /></td>
                        </tr>
                        <tr height="30">
                            <td style="background: #FF9900; color: white;">&nbsp;Ürün Yorumları</td>
                        </tr>
                        <tr>
                            <td>
                                <div style="width: 705px; max-width: 705px; height: 300px; max-height: 300px; overflow-y: scroll;">
                                    <table width="685" align="left" border="0" cellpadding="0" cellspacing="0">
                                        <?php
                                        $yorumSorgusu   = $db->prepare("SELECT * FROM yorumlar WHERE urunId = ? ORDER BY yorumTarihi DESC");
                                        $yorumSorgusu->execute([donusumleriGeriDondur($urunSorgusuKaydi["id"])]);
                                        $yorumSayisi    = $yorumSorgusu->rowCount();
                                        $yorumKayitlari = $yorumSorgusu->fetchAll(PDO::FETCH_ASSOC);

                                        if($yorumSayisi > 0){
                                            foreach($yorumKayitlari as $yorum){
                                                $yorumPuani = donusumleriGeriDondur($yorum["puan"]);

                                                if($yorumPuani == 1){
                                                    $yorumPuanResmi = "YildizBirDolu.png";
                                                }
                                                elseif($yorumPuani == 2){
                                                    $yorumPuanResmi = "YildizIkiDolu.png";
                                                }
                                                elseif($yorumPuani == 3){
                                                    $yorumPuanResmi = "YildizUcDolu.png";
                                                }
                                                elseif($yorumPuani == 4){
                                                    $yorumPuanResmi = "YildizDortDolu.png";
                                                }
                                                elseif($yorumPuani == 5){
                                                    $yorumPuanResmi = "YildizBesDolu.png";
                                                }

                                                $yorumIcinUyeSorgusu   = $db->prepare("SELECT * FROM uyeler WHERE id = ? LIMIT 1");
                                                $yorumIcinUyeSorgusu->execute([donusumleriGeriDondur($yorum["uyeId"])]);
                                                $yorumIcinUyeKaydi = $yorumIcinUyeSorgusu->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                            <tr height="30">
                                                <td width="64"><img src="resimler/<?php echo $yorumPuanResmi; ?>" alt="Yorum Puanı"></td>
                                                <td width="10">&nbsp;</td>
                                                <td width="451"><?php echo donusumleriGeriDondur($yorumIcinUyeKaydi["isimSoyisim"]); ?></td>
                                                <td width="10">&nbsp;</td>
                                                <td width="150" align="right"><?php echo tarihCevir(donusumleriGeriDondur($yorum["yorumTarihi"])); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="border-bottom: 1px dashed #CCC;"><?php echo donusumleriGeriDondur($yorum["yorumMetni"]); ?></td>
                                            </tr>

                                        <?php
                                            }
                                        }else{
                                        ?>
                                        <tr height="30">
                                            <td>Ürün İçin Henüz Yorum Eklenmemiş.</td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
<?php
    } else {
        header("index.php");
        exit();
    }
} else {
    header("index.php");
    exit();
}
?>