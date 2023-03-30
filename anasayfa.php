<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <?php
                $bannerSorgusu  = $db->prepare("SELECT * FROM bannerlar WHERE bannerAlani = 'Ana Sayfa' ORDER BY gosterimSayisi ASC LIMIT 1");
                $bannerSorgusu->execute();
                $bannerSayisi   = $bannerSorgusu->rowCount();
                $bannerKaydi    = $bannerSorgusu->fetch(PDO::FETCH_ASSOC);
                ?>

                <tr height="140">
                    <td><img src="resimler/<?php echo $bannerKaydi["bannerResmi"]; ?>" alt="Banner Resmi" border="0"></td>
                </tr>
                <?php
                $bannerGuncelle  = $db->prepare("UPDATE bannerlar SET gosterimSayisi=gosterimSayisi+1 WHERE id = ?");
                $bannerGuncelle->execute([$bannerKaydi["id"]]);
                ?>
            </table>
        </td>
    </tr>

    <tr height="35">
        <td bgcolor="#FF9900" style="color: #FFF; font-weight: bold; ">&nbsp;En Yeni Ürünler</td>
    </tr>

    <tr>
        <td height="20">&nbsp;</td>
    </tr>

    <tr>
        <td>

            <table width="1065" align="left" border="0" cellpadding="0" cellspacing="0">
                <tr>

                    <?php

                    $enYeniUrunlerSorgusu = $db->prepare("SELECT * FROM urunler WHERE durumu = '1' ORDER BY id DESC LIMIT 5");
                    $enYeniUrunlerSorgusu->execute();
                    $enYeniUrunSayisi     = $enYeniUrunlerSorgusu->rowCount();
                    $enYeniUrunKayitlari  = $enYeniUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                    $enYeniDonguSayisi = 1;

                    foreach ($enYeniUrunKayitlari as $enYeniUrunSatirlari) {

                        $enYeniUrununTuru     = donusumleriGeriDondur($enYeniUrunSatirlari["urunTuru"]);
                        $enYeniUrunFiyati     = donusumleriGeriDondur($enYeniUrunSatirlari["urunFiyati"]);
                        $enYeniUrunParaBirimi = donusumleriGeriDondur($enYeniUrunSatirlari["paraBirimi"]);

                        if ($enYeniUrunParaBirimi == "USD") {
                            $enYeniUrunFiyatiHesapla = $enYeniUrunFiyati * $dolarKuru;
                        } elseif ($enYeniUrunParaBirimi == "EUR") {
                            $enYeniUrunFiyatiHesapla = $enYeniUrunFiyati * $euroKuru;
                        } else {
                            $enYeniUrunFiyatiHesapla = $enYeniUrunFiyati;
                        }

                        if ($enYeniUrununTuru == "Erkek Ayakkabısı") {
                            $enYeniUrunResmiKlasoru = "Erkek";
                        } elseif ($enYeniUrununTuru == "Kadın Ayakkabısı") {
                            $enYeniUrunResmiKlasoru = "Kadin";
                        } elseif ($enYeniUrununTuru == "Çocuk Ayakkabısı") {
                            $enYeniUrunResmiKlasoru = "Cocuk";
                        }

                        $enYeniUrununToplamYorumSayisi = donusumleriGeriDondur($enYeniUrunSatirlari["yorumSayisi"]);
                        $enYeniUrununToplamYorumPuani  = donusumleriGeriDondur($enYeniUrunSatirlari["toplamYorumPuani"]);

                        if ($enYeniUrununToplamYorumSayisi > 0) {
                            $enYeniPuanHesapla             = number_format($enYeniUrununToplamYorumPuani / $enYeniUrununToplamYorumSayisi, 2, ".", "");
                        } else {
                            $enYeniPuanHesapla             = 0;
                        }

                        if ($enYeniPuanHesapla == 0) {
                            $enYeniPuanResmi = "YildizCizgiliBos.png";
                        } elseif (($enYeniPuanHesapla > 0) and ($enYeniPuanHesapla <= 1)) {
                            $enYeniPuanResmi = "YildizCizgiliBirDolu.png";
                        } elseif (($enYeniPuanHesapla > 1) and ($enYeniPuanHesapla <= 2)) {
                            $enYeniPuanResmi = "YildizCizgiliIkiDolu.png";
                        } elseif (($enYeniPuanHesapla > 2) and ($enYeniPuanHesapla <= 3)) {
                            $enYeniPuanResmi = "YildizCizgiliUcDolu.png";
                        } elseif (($enYeniPuanHesapla > 3) and ($enYeniPuanHesapla <= 4)) {
                            $enYeniPuanResmi = "YildizCizgiliDortDolu.png";
                        } elseif ($enYeniPuanHesapla > 4) {
                            $enYeniPuanResmi = "YildizCizgiliBesDolu.png";
                        }
                    ?>
                        <td width="205" valign="top">
                            <table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;"> <!-- style="border: 1px solid #CCC; margin-bottom: 10px;" -->
                                <tr height="40">
                                    <td align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($enYeniUrunSatirlari["id"]); ?>"><img src="resimler/urunResimleri/<?php echo $enYeniUrunResmiKlasoru; ?>/<?php echo donusumleriGeriDondur($enYeniUrunSatirlari["urunResmiBir"]); ?>" alt="Ürün Resmi" border="0" width="185" height="247"></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($enYeniUrunSatirlari["id"]); ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;"><?php echo donusumleriGeriDondur($enYeniUrununTuru); ?></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($enYeniUrunSatirlari["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;">
                                            <div style="width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo donusumleriGeriDondur($enYeniUrunSatirlari["urunAdi"]); ?></div>
                                        </a></td>
                                </tr>
                                <tr height="25">
                                    <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($enYeniUrunSatirlari["id"]); ?>"><img src="resimler/<?php echo donusumleriGeriDondur($enYeniPuanResmi); ?>" alt="Ürün Puanı"></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($urun["id"]); ?>" style="color: #0000FF; font-weight: bold; text-decoration: none;"><?php echo fiyatBicimlendir($enYeniUrunFiyatiHesapla); ?> TL</a></td>
                                </tr>
                            </table>
                        </td>
                        <?php
                        if ($enYeniDonguSayisi < 4) {
                        ?>
                            <td width="10">&nbsp;</td>
                    <?php
                        }
                        $enYeniDonguSayisi++;
                    }
                    ?>
                </tr>
            </table>
        </td>
    </tr>

    <tr height="35">
        <td bgcolor="#FF9900" style="color: #FFF; font-weight: bold; ">&nbsp;En Popüler Ürünler</td>
    </tr>

    <tr>
        <td height="20">&nbsp;</td>
    </tr>

    <tr>
        <td>

            <table width="1065" align="left" border="0" cellpadding="0" cellspacing="0">
                <tr>

                    <?php

                    $enPopulerUrunlerSorgusu = $db->prepare("SELECT * FROM urunler WHERE durumu = '1' ORDER BY goruntulenmeSayisi DESC LIMIT 5");
                    $enPopulerUrunlerSorgusu->execute();
                    $enPopulerUrunSayisi     = $enPopulerUrunlerSorgusu->rowCount();
                    $enPopulerUrunKayitlari  = $enPopulerUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                    $enPopulerDonguSayisi = 1;

                    foreach ($enPopulerUrunKayitlari as $enPopulerUrunSatirlari) {

                        $enPopulerUrununTuru     = donusumleriGeriDondur($enPopulerUrunSatirlari["urunTuru"]);
                        $enPopulerUrunFiyati     = donusumleriGeriDondur($enPopulerUrunSatirlari["urunFiyati"]);
                        $enPopulerUrunParaBirimi = donusumleriGeriDondur($enPopulerUrunSatirlari["paraBirimi"]);

                        if ($enPopulerUrunParaBirimi == "USD") {
                            $enPopulerUrunFiyatiHesapla = $enPopulerUrunFiyati * $dolarKuru;
                        } elseif ($enPopulerUrunParaBirimi == "EUR") {
                            $enPopulerUrunFiyatiHesapla = $enPopulerUrunFiyati * $euroKuru;
                        } else {
                            $enPopulerUrunFiyatiHesapla = $enPopulerUrunFiyati;
                        }

                        if ($enPopulerUrununTuru == "Erkek Ayakkabısı") {
                            $enPopulerUrunResmiKlasoru = "Erkek";
                        } elseif ($enPopulerUrununTuru == "Kadın Ayakkabısı") {
                            $enPopulerUrunResmiKlasoru = "Kadin";
                        } elseif ($enPopulerUrununTuru == "Çocuk Ayakkabısı") {
                            $enPopulerUrunResmiKlasoru = "Cocuk";
                        }

                        $enPopulerUrununToplamYorumSayisi = donusumleriGeriDondur($enPopulerUrunSatirlari["yorumSayisi"]);
                        $enPopulerUrununToplamYorumPuani  = donusumleriGeriDondur($enPopulerUrunSatirlari["toplamYorumPuani"]);

                        if ($enPopulerUrununToplamYorumSayisi > 0) {
                            $enPopulerPuanHesapla             = number_format($enPopulerUrununToplamYorumPuani / $enPopulerUrununToplamYorumSayisi, 2, ".", "");
                        } else {
                            $enPopulerPuanHesapla             = 0;
                        }

                        if ($enPopulerPuanHesapla == 0) {
                            $enPopulerPuanResmi = "YildizCizgiliBos.png";
                        } elseif (($enPopulerPuanHesapla > 0) and ($enPopulerPuanHesapla <= 1)) {
                            $enPopulerPuanResmi = "YildizCizgiliBirDolu.png";
                        } elseif (($enPopulerPuanHesapla > 1) and ($enPopulerPuanHesapla <= 2)) {
                            $enPopulerPuanResmi = "YildizCizgiliIkiDolu.png";
                        } elseif (($enPopulerPuanHesapla > 2) and ($enPopulerPuanHesapla <= 3)) {
                            $enPopulerPuanResmi = "YildizCizgiliUcDolu.png";
                        } elseif (($enPopulerPuanHesapla > 3) and ($enPopulerPuanHesapla <= 4)) {
                            $enPopulerPuanResmi = "YildizCizgiliDortDolu.png";
                        } elseif ($enPopulerPuanHesapla > 4) {
                            $enPopulerPuanResmi = "YildizCizgiliBesDolu.png";
                        }
                    ?>
                        <td width="205" valign="top">
                            <table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;"> <!-- style="border: 1px solid #CCC; margin-bottom: 10px;" -->
                                <tr height="40">
                                    <td align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($enPopulerUrunSatirlari["id"]); ?>"><img src="resimler/urunResimleri/<?php echo $enPopulerUrunResmiKlasoru; ?>/<?php echo donusumleriGeriDondur($enPopulerUrunSatirlari["urunResmiBir"]); ?>" alt="Ürün Resmi" border="0" width="185" height="247"></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($enPopulerUrunSatirlari["id"]); ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;"><?php echo donusumleriGeriDondur($enPopulerUrununTuru); ?></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($enPopulerUrunSatirlari["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;">
                                            <div style="width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo donusumleriGeriDondur($enPopulerUrunSatirlari["urunAdi"]); ?></div>
                                        </a></td>
                                </tr>
                                <tr height="25">
                                    <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($enPopulerUrunSatirlari["id"]); ?>"><img src="resimler/<?php echo donusumleriGeriDondur($enPopulerPuanResmi); ?>" alt="Ürün Puanı"></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($urun["id"]); ?>" style="color: #0000FF; font-weight: bold; text-decoration: none;"><?php echo fiyatBicimlendir($enPopulerUrunFiyatiHesapla); ?> TL</a></td>
                                </tr>
                            </table>
                        </td>
                        <?php
                        if ($enPopulerDonguSayisi < 4) {
                        ?>
                            <td width="10">&nbsp;</td>
                    <?php
                        }
                        $enPopulerDonguSayisi++;
                    }
                    ?>
                </tr>
            </table>
        </td>
    </tr>

    <tr height="35">
        <td bgcolor="#FF9900" style="color: #FFF; font-weight: bold; ">&nbsp;En Çok Satan Ürünler</td>
    </tr>

    <tr>
        <td height="20">&nbsp;</td>
    </tr>

    <tr>
        <td>

            <table width="1065" align="left" border="0" cellpadding="0" cellspacing="0">
                <tr>

                    <?php

                    $enCokSatanUrunlerSorgusu = $db->prepare("SELECT * FROM urunler WHERE durumu = '1' ORDER BY toplamSatisSayisi DESC LIMIT 5");
                    $enCokSatanUrunlerSorgusu->execute();
                    $enCokSatanUrunSayisi     = $enCokSatanUrunlerSorgusu->rowCount();
                    $enCokSatanUrunKayitlari  = $enCokSatanUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                    $enCokSatanDonguSayisi = 1;

                    foreach ($enCokSatanUrunKayitlari as $enCokSatanUrunSatirlari) {

                        $enCokSatanUrununTuru     = donusumleriGeriDondur($enCokSatanUrunSatirlari["urunTuru"]);
                        $enCokSatanUrunFiyati     = donusumleriGeriDondur($enCokSatanUrunSatirlari["urunFiyati"]);
                        $enCokSatanUrunParaBirimi = donusumleriGeriDondur($enCokSatanUrunSatirlari["paraBirimi"]);

                        if ($enCokSatanUrunParaBirimi == "USD") {
                            $enCokSatanUrunFiyatiHesapla = $enCokSatanUrunFiyati * $dolarKuru;
                        } elseif ($enCokSatanUrunParaBirimi == "EUR") {
                            $enCokSatanUrunFiyatiHesapla = $enCokSatanUrunFiyati * $euroKuru;
                        } else {
                            $enCokSatanUrunFiyatiHesapla = $enCokSatanUrunFiyati;
                        }

                        if ($enCokSatanUrununTuru == "Erkek Ayakkabısı") {
                            $enCokSatanUrunResmiKlasoru = "Erkek";
                        } elseif ($enCokSatanUrununTuru == "Kadın Ayakkabısı") {
                            $enCokSatanUrunResmiKlasoru = "Kadin";
                        } elseif ($enCokSatanUrununTuru == "Çocuk Ayakkabısı") {
                            $enCokSatanUrunResmiKlasoru = "Cocuk";
                        }

                        $enCokSatanUrununToplamYorumSayisi = donusumleriGeriDondur($enCokSatanUrunSatirlari["yorumSayisi"]);
                        $enCokSatanUrununToplamYorumPuani  = donusumleriGeriDondur($enCokSatanUrunSatirlari["toplamYorumPuani"]);

                        if ($enCokSatanUrununToplamYorumSayisi > 0) {
                            $enCokSatanPuanHesapla             = number_format($enCokSatanUrununToplamYorumPuani / $enCokSatanUrununToplamYorumSayisi, 2, ".", "");
                        } else {
                            $enCokSatanPuanHesapla             = 0;
                        }

                        if ($enCokSatanPuanHesapla == 0) {
                            $enCokSatanPuanResmi = "YildizCizgiliBos.png";
                        } elseif (($enCokSatanPuanHesapla > 0) and ($enCokSatanPuanHesapla <= 1)) {
                            $enCokSatanPuanResmi = "YildizCizgiliBirDolu.png";
                        } elseif (($enCokSatanPuanHesapla > 1) and ($enCokSatanPuanHesapla <= 2)) {
                            $enCokSatanPuanResmi = "YildizCizgiliIkiDolu.png";
                        } elseif (($enCokSatanPuanHesapla > 2) and ($enCokSatanPuanHesapla <= 3)) {
                            $enCokSatanPuanResmi = "YildizCizgiliUcDolu.png";
                        } elseif (($enCokSatanPuanHesapla > 3) and ($enCokSatanPuanHesapla <= 4)) {
                            $enCokSatanPuanResmi = "YildizCizgiliDortDolu.png";
                        } elseif ($enCokSatanPuanHesapla > 4) {
                            $enCokSatanPuanResmi = "YildizCizgiliBesDolu.png";
                        }
                    ?>
                        <td width="205" valign="top">
                            <table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;"> <!-- style="border: 1px solid #CCC; margin-bottom: 10px;" -->
                                <tr height="40">
                                    <td align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($enCokSatanUrunSatirlari["id"]); ?>"><img src="resimler/urunResimleri/<?php echo $enCokSatanUrunResmiKlasoru; ?>/<?php echo donusumleriGeriDondur($enCokSatanUrunSatirlari["urunResmiBir"]); ?>" alt="Ürün Resmi" border="0" width="185" height="247"></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($enCokSatanUrunSatirlari["id"]); ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;"><?php echo donusumleriGeriDondur($enCokSatanUrununTuru); ?></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($enCokSatanUrunSatirlari["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;">
                                            <div style="width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo donusumleriGeriDondur($enCokSatanUrunSatirlari["urunAdi"]); ?></div>
                                        </a></td>
                                </tr>
                                <tr height="25">
                                    <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($enCokSatanUrunSatirlari["id"]); ?>"><img src="resimler/<?php echo donusumleriGeriDondur($enCokSatanPuanResmi); ?>" alt="Ürün Puanı"></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($urun["id"]); ?>" style="color: #0000FF; font-weight: bold; text-decoration: none;"><?php echo fiyatBicimlendir($enCokSatanUrunFiyatiHesapla); ?> TL</a></td>
                                </tr>
                            </table>
                        </td>
                        <?php
                        if ($enCokSatanDonguSayisi < 4) {
                        ?>
                            <td width="10">&nbsp;</td>
                    <?php
                        }
                        $enCokSatanDonguSayisi++;
                    }
                    ?>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td>
            <table width="1065" align="left" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="258">
                        <table width="258" align="left" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center"><img src="resimler/HizliTeslimat.png" alt="Hızlı Teslimat" border="0"></td>
                            </tr>
                            <tr>
                                <td align="center"><b>Bugün Teslimat</b></td>
                            </tr>
                            <tr>
                                <td align="center">Saat 14:00'a kadar verdiğiniz siparişler aynı gün kapınızda.</td>
                            </tr>
                        </table>
                    </td>
                    <td width="11">&nbsp;</td>
                    <td width="258">
                        <table width="258" align="left" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center"><img src="resimler/GuvenliAlisveris.png" alt="Güvenli Alışveriş" border="0"></td>
                            </tr>
                            <tr>
                                <td align="center"><b>Tek Tıkla Güvenli Alışveriş</b></td>
                            </tr>
                            <tr>
                                <td align="center">Ödeme ve adres bilgilerinizi kaydedin, güvenli alışveriş yapın.</td>
                            </tr>
                        </table>
                    </td>
                    <td width="11">&nbsp;</td>
                    <td width="258">
                        <table width="258" align="left" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center"><img src="resimler/MobilErisim.png" alt="Mobil Erişim" border="0"></td>
                            </tr>
                            <tr>
                                <td align="center"><b>Mobil Erişim</b></td>
                            </tr>
                            <tr>
                                <td align="center">Dilediğiniz her cihazdan sitemize erişebilir ve alışveriş yapabilirsiniz.</td>
                            </tr>
                        </table>
                    </td>
                    <td width="11">&nbsp;</td>
                    <td width="258">
                        <table width="258" align="left" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center"><img src="resimler/IadeGarantisi.png" alt="İade Garantisi" border="0"></td>
                            </tr>
                            <tr>
                                <td align="center"><b>Kolay İade</b></td>
                            </tr>
                            <tr>
                                <td align="center">Aldığınız herhangi bir ürünü 14 gün içerisinde kolaylıkla iade edebilirsiniz.</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

</table>