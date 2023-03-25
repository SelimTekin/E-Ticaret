<?php
if (isset($_REQUEST["menuId"])) {
    $gelenMenuId     = sayiIcerenIcerikleriFiltrele(guvenlik($_REQUEST["menuId"]));
    $menuKosulu      = " AND menuId = '" . $gelenMenuId . "' ";
    $sayfalamaKosulu = "&menuId=" . $gelenMenuId;
} else {
    $gelenMenuId     = "";
    $menuKosulu      = "";
    $sayfalamaKosulu = "";
}

if (isset($_REQUEST["aramaIcerigi"])) {
    $gelenAramaIcerigi = guvenlik($_REQUEST["aramaIcerigi"]);
    $aramaKosulu       = " AND urunAdi LIKE '%" . $gelenAramaIcerigi . "%' ";
    $sayfalamaKosulu   .= "&aramaIcerigi=" . $gelenAramaIcerigi;
} else {
    $aramaKosulu       = "";
    $sayfalamaKosulu   .= "";
}

$sayfalamaIcinSolveSagButonSayisi   = 2;
$sayfaBasinaGosterilecekKayitSayisi = 10;

$toplamKayitSayisiSorgusu           = $db->prepare("SELECT * FROM urunler WHERE urunTuru = 'Çocuk Ayakkabısı' AND durumu = '1' $menuKosulu $aramaKosulu ORDER BY id DESC");
$toplamKayitSayisiSorgusu->execute();
$toplamKayitSayisi                  = $toplamKayitSayisiSorgusu->rowCount();
$toplamKayitSayisiKayitlari         = $toplamKayitSayisiSorgusu->fetchAll(PDO::FETCH_ASSOC);

$sayfalamayaBaslanacakKayitSayisi   = ($sayfalama * $sayfaBasinaGosterilecekKayitSayisi) - $sayfaBasinaGosterilecekKayitSayisi;
$bulunanSayfaSayisi                 = ceil($toplamKayitSayisi / $sayfaBasinaGosterilecekKayitSayisi);

$anaMenununTumUrunSayiSorgusu = $db->prepare("SELECT SUM(urunSayisi) AS menununToplamUrunu FROM menuler WHERE urunTuru = 'Çocuk Ayakkabısı'");
$anaMenununTumUrunSayiSorgusu->execute();
$anaMenununTumUrunSayiSorgusu = $anaMenununTumUrunSayiSorgusu->fetch(PDO::FETCH_ASSOC);

?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr height="100">
        <td width="250" align="left" valign="top">
            <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">

                            <tr height="50">
                                <td bgcolor="#F1F1F1"><b>&nbsp;MENÜLER</b></td>
                            </tr>
                            <tr height="30">
                                <td><a href="index.php?sayfaKodu=86" style="text-decoration: none; <?php if ($gelenMenuId == "") { ?> color: #FF9900; <?php } else { ?> color: #646464; <?php } ?> font-weight: bold;">&nbsp;Tüm Ürünler (<?php echo $anaMenununTumUrunSayiSorgusu["menununToplamUrunu"]; ?>)</a></td>
                            </tr>
                            <?php
                            $menulerSorgusu  = $db->prepare("SELECT * FROM menuler WHERE urunTuru = 'Çocuk Ayakkabısı' ORDER BY menuAdi ASC");
                            $menulerSorgusu->execute();
                            $menuKayitSayisi = $menulerSorgusu->rowCount();
                            $menuKayitlari   = $menulerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($menuKayitlari as $menu) {
                            ?>

                                <tr height="30">
                                    <td><a href="index.php?sayfaKodu=86&menuId=<?php echo $menu["id"]; ?>" style="text-decoration: none; <?php if ($gelenMenuId == $menu['id']) { ?> color: #FF9900; <?php } else { ?> color: #646464; <?php } ?> font-weight: bold;">&nbsp;<?php echo donusumleriGeriDondur($menu["menuAdi"]); ?> (<?php echo donusumleriGeriDondur($menu["urunSayisi"]); ?>)</a></td>
                                </tr>

                            <?php } ?>
                        </table>

                    </td>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">

                            <tr height="50">
                                <td bgcolor="#F1F1F1"><b>&nbsp;REKLAMLAR</b></td>
                            </tr>
                            <?php
                            $bannerSorgusu  = $db->prepare("SELECT * FROM bannerlar WHERE bannerAlani = 'Menu Altı' ORDER BY gosterimSayisi ASC LIMIT 1");
                            $bannerSorgusu->execute();
                            $bannerSayisi   = $bannerSorgusu->rowCount();
                            $bannerKaydi    = $bannerSorgusu->fetch(PDO::FETCH_ASSOC);
                            ?>

                            <tr height="30">
                                <td><img src="resimler/<?php echo $bannerKaydi["bannerResmi"]; ?>" alt="Banner Resmi" border="0"></td>
                            </tr>
                            <?php
                            $bannerGuncelle  = $db->prepare("UPDATE bannerlar SET gosterimSayisi=gosterimSayisi+1 WHERE id = ?");
                            $bannerGuncelle->execute([$bannerKaydi["id"]]);
                            ?>
                        </table>
                    </td>
                </tr>
            </table>

        </td>
        <td width="10" align="left">&nbsp;</td>
        <td width="805" align="left" valign="top">
            <table width="805" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <div class="aramaAlani">
                            <form action="index.php?sayfaKodu=86" method="post">
                                <?php if($gelenMenuId != ""){ ?>
                                <input type="hidden" name="menuId" value="<?php echo $gelenMenuId; ?>">
                                <?php } ?>
                                <div class="aramaAlaniButonKapsamaAlani">
                                    <input type="submit" value="" class="aramaAlaniButonu">
                                </div>
                                <div class="aramaAlaniInputKapsamaAlani">
                                    <input type="text" name="aramaIcerigi" class="aramaAlaniInputu">
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td>

                        <table align="left" border="0" cellpadding="0" cellspacing="0">
                            <tr>

                                <?php

                                $urunlerSorgusu = $db->prepare("SELECT * FROM urunler WHERE urunTuru = 'Çocuk Ayakkabısı' AND durumu = '1' $menuKosulu $aramaKosulu ORDER BY id DESC LIMIT $sayfalamayaBaslanacakKayitSayisi, $sayfaBasinaGosterilecekKayitSayisi");
                                $urunlerSorgusu->execute();
                                $urunSayisi     = $urunlerSorgusu->rowCount();
                                $urunKayitlari  = $urunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                                $donguSayisi = 1;
                                $sutunAdetSayisi = 4;

                                foreach ($urunKayitlari as $urun) {

                                    $urunFiyati     = donusumleriGeriDondur($urun["urunFiyati"]);
                                    $urunParaBirimi = donusumleriGeriDondur($urun["paraBirimi"]);

                                    if($urunParaBirimi == "USD"){
                                        $urunFiyatiHesapla = $urunFiyati * $dolarKuru;
                                    }
                                    elseif($urunParaBirimi == "EUR"){
                                        $urunFiyatiHesapla = $urunFiyati * $euroKuru;
                                    }
                                    else{
                                        $urunFiyatiHesapla = $urunFiyati;
                                    }

                                    $urununToplamYorumSayisi = donusumleriGeriDondur($urun["yorumSayisi"]);
                                    $urununToplamYorumPuani  = donusumleriGeriDondur($urun["toplamYorumPuani"]);

                                    if($urununToplamYorumSayisi > 0){
                                        $puanHesapla             = number_format($urununToplamYorumPuani / $urununToplamYorumSayisi, 2, ".", "");
                                    }
                                    else{
                                        $puanHesapla             = 0;
                                    }

                                    if($puanHesapla == 0){
                                        $puanResmi = "YildizCizgiliBos.png";
                                    }
                                    elseif(($puanHesapla > 0) and ($puanHesapla <= 1)){
                                        $puanResmi = "YildizCizgiliBirDolu.png";
                                    }
                                    elseif(($puanHesapla > 1) and ($puanHesapla <= 2)){
                                        $puanResmi = "YildizCizgiliIkiDolu.png";
                                    }
                                    elseif(($puanHesapla > 2) and ($puanHesapla <= 3)){
                                        $puanResmi = "YildizCizgiliUcDolu.png";
                                    }
                                    elseif(($puanHesapla > 3) and ($puanHesapla <= 4)){
                                        $puanResmi = "YildizCizgiliDortDolu.png";
                                    }
                                    elseif($puanHesapla > 4){
                                        $puanResmi = "YildizCizgiliBesDolu.png";
                                    }
                                ?>
                                    <td width="193" valign="top">
                                        <table width="193" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;"> <!-- style="border: 1px solid #CCC; margin-bottom: 10px;" -->
                                            <tr height="40">
                                                <td align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($urun["id"]); ?>"><img src="resimler/urunResimleri/Cocuk/<?php echo donusumleriGeriDondur($urun["urunResmiBir"]); ?>" alt="Ürün Resmi" border="0" width="185" height="247"></a></td>
                                            </tr>
                                            <tr height="25">
                                                <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($urun["id"]); ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Çocuk Ayakkabısı</a></td>
                                            </tr>
                                            <tr height="25">
                                                <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($urun["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;"><div style="width: 193px; max-width: 193px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo donusumleriGeriDondur($urun["urunAdi"]); ?></div></a></td>
                                            </tr>
                                            <tr height="25">
                                                <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($urun["id"]); ?>"><img src="resimler/<?php echo $puanResmi; ?>" alt="Ürün Puanı"></a></td>
                                            </tr>
                                            <tr height="25">
                                                <td width="253" align="center"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($urun["id"]); ?>" style="color: #0000FF; font-weight: bold; text-decoration: none;"><?php echo fiyatBicimlendir($urunFiyatiHesapla); ?> TL</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php
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

                <?php if ($bulunanSayfaSayisi > 1) { ?>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td>
                    <tr height="50">
                        <td align="center">
                            <div class="sayfalamaAlaniKapsayicisi">
                                <div class="sayfalamaAlaniIciMetinAlaniKapsayicisi">
                                    Toplam <?php echo $bulunanSayfaSayisi; ?> sayfada, <?php echo $toplamKayitSayisi; ?> adet kayıt bulunmaktadır.
                                </div>
                                <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
                                    <?php
                                    if ($sayfalama > 1) {
                                        echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=86" . $sayfalamaKosulu . "&sayfalama=1'><<</a></span>";
                                        $sayfalamaIcinSayfaDegeriBirGeriAl = $sayfalama - 1;
                                        echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=86" . $sayfalamaKosulu . "&sayfalama=" . $sayfalamaIcinSayfaDegeriBirGeriAl . "'><</a></span>";
                                    }

                                    for ($sayfalamaIcinSayfaIndexDegeri = $sayfalama - $sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri <= $sayfalama + $sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri++) {
                                        if (($sayfalamaIcinSayfaIndexDegeri > 0) and ($sayfalamaIcinSayfaIndexDegeri <= $bulunanSayfaSayisi)) {
                                            if ($sayfalama == $sayfalamaIcinSayfaIndexDegeri) {
                                                echo "<span class='sayfalamaAktif'>" . $sayfalamaIcinSayfaIndexDegeri . "</span>";
                                            } else {
                                                echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=86" . $sayfalamaKosulu . "&sayfalama=" . $sayfalamaIcinSayfaIndexDegeri . "'>$sayfalamaIcinSayfaIndexDegeri</a></span>";
                                            }
                                        }
                                    }

                                    if ($sayfalama != $bulunanSayfaSayisi) {
                                        $sayfalamaIcinSayfaDegeriBirIleriAl = $sayfalama + 1;
                                        echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=86" . $sayfalamaKosulu . "&sayfalama=" . $sayfalamaIcinSayfaDegeriBirIleriAl . "'>></a></span>";
                                        echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=86" . $sayfalamaKosulu . "&sayfalama=" . $bulunanSayfaSayisi . "'>>></a></span>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </td>
                    </tr>
        </td>
    </tr>
<?php } ?>
</table>

</td>
</tr>
</table>