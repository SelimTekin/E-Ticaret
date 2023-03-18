<?php
if ($_SESSION["kullanici"]) { // üye girişi yapılmışsa hesabım sayfasına yönlendirir. Giriş yapmadan url üzerinden bu sayfaya erişilmesini engeller.

    $sayfalamaIcinSolveSagButonSayisi   = 2;
    $sayfaBasinaGosterilecekKayitSayisi = 10;

    $toplamKayitSayisiSorgusu           = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler WHERE uyeId = ? ORDER BY siparisNumarasi DESC");
    $toplamKayitSayisiSorgusu->execute([$kullaniciId]);
    $toplamKayitSayisi                  = $toplamKayitSayisiSorgusu->rowCount();
    $toplamKayitSayisiKayitlari         = $toplamKayitSayisiSorgusu->fetchAll(PDO::FETCH_ASSOC);

    $sayfalamayaBaslanacakKayitSayisi   = ($sayfalama * $sayfaBasinaGosterilecekKayitSayisi) - $sayfaBasinaGosterilecekKayitSayisi;
    $bulunanSayfaSayisi                 = ceil($toplamKayitSayisi / $sayfaBasinaGosterilecekKayitSayisi); // 6.1 olursa yukarı yuvarlar ve 7 sayfa olur
?>

    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">

        <tr>
            <td>
                <hr />
            </td>
        </tr>

        <tr>
            <td>
                <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="203" style="border:1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?sayfaKodu=50" style="text-decoration: none; color: black;">Üyelik Bilgilerim</a></td>
                        <td width="10">&nbsp;</td>
                        <td width="203" style="border:1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?sayfaKodu=58" style="text-decoration: none; color: black;">Adresler</a></td>
                        <td width="10">&nbsp;</td>
                        <td width="203" style="border:1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?sayfaKodu=59" style="text-decoration: none; color: black;">Favoriler</a></td>
                        <td width="10">&nbsp;</td>
                        <td width="203" style="border:1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?sayfaKodu=60" style="text-decoration: none; color: black;">Yorumlar</a></td>
                        <td width="10">&nbsp;</td>
                        <td width="203" style="border:1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?sayfaKodu=61" style="text-decoration: none; color: black;">Siparişler</a></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <hr />
            </td>
        </tr>

        <tr>
            <td width="1065" valign="top">
                <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td  colspan="8" style="color: #FF9900;">
                            <h3>Hesabım > Siparişler</h3>
                        </td>
                    </tr>

                    <tr height="40">
                        <td  colspan="8" valign="30" style="border-bottom: 1px dashed #CCC;">Tüm Siparişlerinizi Bu Alandan Görüntüleyebilirsiniz.</td>
                    </tr>

                    <tr height="50">
                        <td width="125" align="left" style="background: #f8ffa7; color: black;">&nbsp;Sipariş Numarası</td>
                        <td width="75" align="left" style="background: #f8ffa7; color: black;">Resim</td>
                        <td width="50" align="left" style="background: #f8ffa7; color: black;">Yorum</td>
                        <td width="415" align="left" style="background: #f8ffa7; color: black;">Adı</td>
                        <td width="100" align="left" style="background: #f8ffa7; color: black;">Fiyatı</td>
                        <td width="50" align="left" style="background: #f8ffa7; color: black;">Adet</td>
                        <td width="100" align="left" style="background: #f8ffa7; color: black;">Toplam Fiyat</td>
                        <td width="150" align="left" style="background: #f8ffa7; color: black;">Kargo Durumu / Takip</td>
                    </tr>

                    <?php
                    // Bir kullanıcı birden fazla siparişi olabilir. O yüzden ilk önce DISTINCT ile kullanıcının bir veya birden verdiği siparişlerin numarası'nın bir tanesini aldık.
                    // Sonradan bu sipariş numarasına ait bütün siparişleri alacağız.
                    $siparisNumaralariSorgusu = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler WHERE uyeId = ? ORDER BY siparisNumarasi DESC LIMIT $sayfalamayaBaslanacakKayitSayisi, $sayfaBasinaGosterilecekKayitSayisi");
                    $siparisNumaralariSorgusu->execute([$kullaniciId]);
                    $siparisNumaralariSayisi     = $siparisNumaralariSorgusu->rowCount();
                    $siparisNumaralariKayitlari  = $siparisNumaralariSorgusu->fetchAll(PDO::FETCH_ASSOC);
                    
                    if ($siparisNumaralariSayisi > 0) {
                        foreach ($siparisNumaralariKayitlari as $siparisNumarasi) {
                            $siparisNo = $siparisNumarasi["siparisNumarasi"];

                            $siparisSorgusu = $db->prepare("SELECT * FROM siparisler WHERE uyeId = ? AND siparisNumarasi = ? ORDER BY id ASC"); // LIMIT ve SAYFALAMA
                            $siparisSorgusu->execute([$kullaniciId, $siparisNo]);
                            $siparisKayitlari  = $siparisSorgusu->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($siparisKayitlari as $siparis) {

                                $urunTuru = donusumleriGeriDondur($siparis["urunTuru"]);
                                if($urunTuru == "Erkek Ayakkabısı"){
                                    $resimKlasoruAdi = "Erkek";
                                }
                                elseif($urunTuru == "Kadın Ayakkabısı"){
                                    $resimKlasoruAdi = "Kadin";
                                }
                                else{
                                    $resimKlasoruAdi = "Cocuk";
                                }

                                $kargoDurumu = donusumleriGeriDondur($siparis["kargoDurumu"]);
                                if($kargoDurumu == 0){
                                    $kargoDurumuYazdir = "Beklemede";
                                }
                                else{
                                    $kargoDurumuYazdir = donusumleriGeriDondur($siparis["kargoGonderiKodu"]);
                                }

                    ?>
                                <tr height="50">
                                    <td width="125" align="left">&nbsp;#<?php echo donusumleriGeriDondur($siparis["siparisNumarasi"]); ?></td>
                                    <td width="75" align="left"><img src="resimler/UrunResimleri/<?php echo $resimKlasoruAdi; ?>/<?php echo donusumleriGeriDondur($siparis["urunResmiBir"]); ?>" border="0" width="60" height="80" alt="Ürün Resmi"></td>
                                    <td width="50" align="left"><a href="index.php?sayfaKodu=75&urunId=<?php echo donusumleriGeriDondur($siparis["urunId"]); ?>"><img src="resimler/DokumanKirmiziKalemli20x20.png" border="0" alt="Yorum İkonu"></a></td>
                                    <td width="415" align="left"><?php echo donusumleriGeriDondur($siparis["urunAdi"]); ?></td>
                                    <td width="100" align="left"><?php echo fiyatBicimlendir(donusumleriGeriDondur($siparis["urunFiyati"])); ?> TL</td>
                                    <td width="50" align="left"><?php echo donusumleriGeriDondur($siparis["urunAdedi"]); ?></td>
                                    <td width="100" align="left"><?php echo fiyatBicimlendir(donusumleriGeriDondur($siparis["toplamUrunFiyati"])); ?> TL</td>
                                    <td width="150" align="left"><?php echo $kargoDurumuYazdir; ?></td>
                                </tr>
                    <?php
                            }
                    ?>

                                <tr height="30">
                                    <td colspan="8"><hr /></td>
                                </tr>

                    <?php
                        }

                        if($bulunanSayfaSayisi > 1){

                    ?>

                        <tr height="50">
                            <td colspan="8" align="center">
                                <div class="sayfalamaAlaniKapsayicisi">
                                    <div class="sayfalamaAlaniIciMetinAlaniKapsayicisi">
                                        Toplam <?php echo $bulunanSayfaSayisi; ?> sayfada, <?php echo $toplamKayitSayisi; ?> adet kayıt bulunmaktadır.
                                    </div>
                                    <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
                                        <?php
                                        if($sayfalama > 1){
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=61&sayfalama=1'><<</a></span>";
                                            $sayfalamaIcinSayfaDegeriBirGeriAl = $sayfalama - 1;
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=61&sayfalama=" . $sayfalamaIcinSayfaDegeriBirGeriAl . "'><</a></span>";
                                        }

                                        for($sayfalamaIcinSayfaIndexDegeri=$sayfalama-$sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri<=$sayfalama+$sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri++){
                                            if(($sayfalamaIcinSayfaIndexDegeri>0) and ($sayfalamaIcinSayfaIndexDegeri<=$bulunanSayfaSayisi)){
                                                if($sayfalama == $sayfalamaIcinSayfaIndexDegeri){
                                                    echo "<span class='sayfalamaAktif'>" . $sayfalamaIcinSayfaIndexDegeri . "</span>";
                                                }
                                                else{
                                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=61&sayfalama=" . $sayfalamaIcinSayfaIndexDegeri . "'>$sayfalamaIcinSayfaIndexDegeri</a></span>";
                                                }
                                            }
                                        }

                                        if($sayfalama != $bulunanSayfaSayisi){
                                            $sayfalamaIcinSayfaDegeriBirIleriAl = $sayfalama + 1;
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=61&sayfalama=" . $sayfalamaIcinSayfaDegeriBirIleriAl . "'>></a></span>";
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=61&sayfalama=" . $bulunanSayfaSayisi . "'>>></a></span>";
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

                        <tr height="50">
                            <td colspan="8" align="left">Sisiteme Kayıtlı Siparişiniz Bulunmamaktadır.</td>
                        </tr>

                    <?php
                    }
                    ?>

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