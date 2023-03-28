<?php
if (isset($_SESSION["kullanici"])) {
    $stokIcinSepettekiUrunlerSorgusu = $db->prepare("SELECT * FROM sepet WHERE uyeId = ?");
    $stokIcinSepettekiUrunlerSorgusu->execute([$kullaniciId]);
    $stokIcinSepettekiUrunSayisi     = $stokIcinSepettekiUrunlerSorgusu->rowCount();
    $stokIcinSepettekiKayitlar       = $stokIcinSepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

    if($stokIcinSepettekiUrunSayisi > 0){
        foreach($stokIcinSepettekiKayitlar as $stokIcinSepettekiSatirlar){
            $stokIcinSepetIdsi                  = $stokIcinSepettekiSatirlar["id"];
            $stokIcinSepettekiUrununVaryantIdsi = $stokIcinSepettekiSatirlar["varyantId"];
            $stokIcinSepettekiUrununAdedi       = $stokIcinSepettekiSatirlar["urunAdedi"];

            $stokIcinUrunVaryantBilgileriSorgusu = $db->prepare("SELECT * FROM urunVaryantlari WHERE id = ? LIMIT 1");
            $stokIcinUrunVaryantBilgileriSorgusu->execute([$stokIcinSepettekiUrununVaryantIdsi]);
            $stokIcinVaryantKaydi                = $stokIcinUrunVaryantBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

            $stokIcinUrununStokAdedi = $stokIcinVaryantKaydi["stokAdedi"];

            if($stokIcinUrununStokAdedi == 0){
                $sepetSilSorgusu = $db->prepare("DELETE FROM sepet WHERE id = ? AND uyeId = ? LIMIT 1");
                $sepetSilSorgusu->execute([$stokIcinSepetIdsi, $kullaniciId]);
            }
            elseif($stokIcinSepettekiUrununAdedi > $stokIcinUrununStokAdedi){
                $sepetGuncellemeSorgusu = $db->prepare("UPDATE sepet SET urunAdedi = ? WHERE id = ? AND uyeId = ? LIMIT 1");
                $sepetGuncellemeSorgusu->execute([$stokIcinUrununStokAdedi, $stokIcinSepetIdsi, $kullaniciId]);
            }
        }
    }
?>

    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="500" valign="top">
                <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color: #FF9900;">
                            <h3>Alışveriş Sepeti</h3>
                        </td>
                    </tr>
                    <tr height="40">
                        <td valign="30" style="border-bottom: 1px dashed #CCC;">Alışveriş Sepetine Eklemiş Olduğunuz Ürünler Aşağıdadır.</td>
                    </tr>
                    <?php 
                        $sepettekiUrunlerSorgusu = $db->prepare("SELECT * FROM sepet WHERE uyeId = ? ORDER BY id DESC");
                        $sepettekiUrunlerSorgusu->execute([$kullaniciId]);
                        $sepettekiUrunSayisi  = $sepettekiUrunlerSorgusu->rowCount();
                        $sepettekiKayitlar       = $sepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);
                
                        if($sepettekiUrunSayisi > 0){
                            $sepettekiToplamUrunSayisi = 0;
                            $sepettekiToplamFiyat      = 0;
                            foreach($sepettekiKayitlar as $sepetSatirlari){
                                $sepetIdsi                  = $sepetSatirlari["id"];
                                $sepettekiUrununIdsi        = $sepetSatirlari["urunId"];
                                $sepettekiUrununVaryantIdsi = $sepetSatirlari["varyantId"];
                                $sepettekiUrununAdedi       = $sepetSatirlari["urunAdedi"];

                                $urunBilgileriSorgusu = $db->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
                                $urunBilgileriSorgusu->execute([$sepettekiUrununIdsi]);
                                $urunKaydi            = $urunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                                $urununTuru           = $urunKaydi["urunTuru"];
                                $urununResmi          = $urunKaydi["urunResmiBir"];
                                $urununAdi            = $urunKaydi["urunAdi"];
                                $urununFiyati         = $urunKaydi["urunFiyati"];
                                $urununParaBirimi     = $urunKaydi["paraBirimi"];
                                $urununVaryantBasligi = $urunKaydi["varyantBasligi"];

                                $urunVaryantBilgileriSorgusu = $db->prepare("SELECT * FROM urunvaryantlari WHERE id = ? LIMIT 1");
                                $urunVaryantBilgileriSorgusu->execute([$sepettekiUrununVaryantIdsi]);
                                $varyantKaydi                = $urunVaryantBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                                $urununVaryantAdi = $varyantKaydi["varyantAdi"];
                                $urununStokAdedi  = $varyantKaydi["stokAdedi"];

                                if($urununTuru == "Erkek Ayakkabısı"){
                                    $urunResimleriKlasoru = "Erkek";
                                }
                                elseif($urununTuru == "Kadın Ayakkabısı"){
                                    $urunResimleriKlasoru = "Kadin";
                                }
                                elseif($urununTuru == "Çocuk Ayakkabısı"){
                                    $urunResimleriKlasoru = "Cocuk";
                                }

                                if($urununParaBirimi == "USD"){
                                    $urunFiyatiHesapla           = ($urununFiyati * $dolarKuru);
                                    $urunFiyatiBicimlendir       = fiyatBicimlendir($urunFiyatiHesapla);
                                }
                                elseif($urununParaBirimi == "EUR"){
                                    $urunFiyatiHesapla     = ($urununFiyati * $euroKuru);
                                    $urunFiyatiBicimlendir = fiyatBicimlendir($urunFiyatiHesapla);
                                }
                                else{
                                    $urunFiyatiHesapla     = $urununFiyati;
                                    $urunFiyatiBicimlendir = fiyatBicimlendir($urunFiyatiHesapla);
                                }

                                $urunToplamFiyatiHesapla     = ($urunFiyatiHesapla * $sepettekiUrununAdedi);
                                $urunToplamFiyatiBicimlendir = fiyatBicimlendir($urunToplamFiyatiHesapla);
                                
                                $sepettekiToplamUrunSayisi += $sepettekiUrununAdedi;
                                $sepettekiToplamFiyat      += $urunFiyatiHesapla * $sepettekiUrununAdedi;

                    ?>

                    <tr height="100">
                        <td valign="bottom" align="left">
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="border-bottom: 1px dashed #CCC;" width="80" align="left"><img src="resimler/UrunResimleri/<?php echo $urunResimleriKlasoru; ?>/<?php echo donusumleriGeriDondur($urununResmi); ?>" border="0" width="60" height="80" alt="Ürün Resmi"></td>
                                    <td style="border-bottom: 1px dashed #CCC;" width="40" align="left"><a href="index.php?sayfaKodu=95&id=<?php echo donusumleriGeriDondur($sepetIdsi); ?>"><img src="resimler/SilDaireli20x20.png" alt="Sil Butonu"></a></td>
                                    <td style="border-bottom: 1px dashed #CCC;" width="530" align="left"><?php echo donusumleriGeriDondur($urununAdi); ?><br /><?php echo donusumleriGeriDondur($urununVaryantBasligi); ?> : <?php echo donusumleriGeriDondur($urununVaryantAdi); ?></td>
                                    <td style="border-bottom: 1px dashed #CCC;" width="90" align="left">
                                        <table width="90" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="30" align="center"><?php if($sepettekiUrununAdedi > 1){ ?><a href="index.php?sayfaKodu=96&id=<?php echo donusumleriGeriDondur($sepetIdsi); ?>" style="text-decoration: none;"><img src="resimler/AzaltDaireli20x20.png" alt="Azalt Butonu" style="margin-top: 5px;"></a><?php }else{ ?>&nbsp;<?php } ?></td>
                                                <td width="30" align="center" style="line-height: 20px;"><?php echo donusumleriGeriDondur($sepettekiUrununAdedi); ?></td>
                                                <td width="30" align="center"><a href="index.php?sayfaKodu=97&id=<?php echo donusumleriGeriDondur($sepetIdsi); ?>"><img src="resimler/ArttirDaireli20x20.png" alt="Arttır Butonu" style="margin-top: 5px;"></a></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="border-bottom: 1px dashed #CCC;" width="150" align="right">Adet: <?php echo $urunFiyatiBicimlendir; ?> TL<br /><?php echo $urunToplamFiyatiBicimlendir; ?> TL</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <?php
                            }
                        }else{

                            $sepettekiToplamUrunSayisi = 0;
                            $sepettekiToplamFiyat      = 0;
                    ?>

                    <tr height="30">
                        <td valign="bottom" align="left">Alışveriş sepetinizde ürün bulunmamaktadır.</td>
                    </tr>

                    <?php
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
                        <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo fiyatBicimlendir($sepettekiToplamFiyat); ?> TL</td>
                    </tr>
                    <tr>
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right"><div class="sepetIciDevamEtVeAlisverisiTamamlaButonu"><a href="index.php?sayfaKodu=98"><img src="resimler/SepetBeyaz21x20.png" border="0" alt="Devam Et"> <div>DEVAM ET</div></a></div></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

<?php
} else {
    header("Location: index.php");
    exit();
}
?>