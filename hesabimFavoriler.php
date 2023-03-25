<?php
if (isset($_SESSION["kullanici"])) { // üye girişi yapılmışsa hesabım sayfasına yönlendirir. Giriş yapmadan url üzerinden bu sayfaya erişilmesini engeller.

    $sayfalamaIcinSolveSagButonSayisi   = 2;
    $sayfaBasinaGosterilecekKayitSayisi = 10;

    $toplamKayitSayisiSorgusu           = $db->prepare("SELECT * FROM favoriler WHERE uyeId = ? ORDER BY id ASC");
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
                        <td  colspan="4" style="color: #FF9900;">
                            <h3>Hesabım > Favoriler</h3>
                        </td>
                    </tr>

                    <tr height="40">
                        <td  colspan="4" valign="30" style="border-bottom: 1px dashed #CCC;">Favorilerinize Eklediğiniz Tüm Ürünleri Bu Alandan Görüntüleyebilirsiniz.</td>
                    </tr>

                    <tr height="50">
                        <td width="75" align="left" style="background: #f8ffa7; color: black;">&nbsp;Resim</td>
                        <td width="25" align="left" style="background: #f8ffa7; color: black;">Sil</td>
                        <td width="865" align="left" style="background: #f8ffa7; color: black;">Adı</td>
                        <td width="100" align="left" style="background: #f8ffa7; color: black;">Fiyatı</td>
                    </tr>

                    <?php
                    $favorilerSorgusu = $db->prepare("SELECT * FROM favoriler WHERE uyeId = ? ORDER BY id DESC LIMIT $sayfalamayaBaslanacakKayitSayisi, $sayfaBasinaGosterilecekKayitSayisi");
                    $favorilerSorgusu->execute([$kullaniciId]);
                    $favorilerSayisi     = $favorilerSorgusu->rowCount();
                    $favorilerKayitlari  = $favorilerSorgusu->fetchAll(PDO::FETCH_ASSOC);
                    
                    if ($favorilerSayisi > 0) {
                        foreach ($favorilerKayitlari as $favori) {

                            $urunlerSorgusu = $db->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
                            $urunlerSorgusu->execute([$favori["urunId"]]);
                            $urunKaydi  = $urunlerSorgusu->fetch(PDO::FETCH_ASSOC);

                            $urunAdi    = $urunKaydi["urunAdi"];
                            $urunTuru   = $urunKaydi["urunTuru"];
                            $urunResmi  = $urunKaydi["urunResmiBir"];
                            $urunFiyati = $urunKaydi["urunFiyati"];
                            $paraBirimi = $urunKaydi["paraBirimi"];


                                if($urunTuru == "Erkek Ayakkabısı"){
                                    $resimKlasoruAdi = "Erkek";
                                }
                                elseif($urunTuru == "Kadın Ayakkabısı"){
                                    $resimKlasoruAdi = "Kadin";
                                }
                                else{
                                    $resimKlasoruAdi = "Cocuk";
                                }

                    ?>
                                <tr height="50">
                                    <td width="75" align="left" style="border-bottom: 1px dashed #CCC"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($urunKaydi["id"]); ?>" style="color: #646464; text-decoration: none;"><img src="resimler/UrunResimleri/<?php echo $resimKlasoruAdi; ?>/<?php echo donusumleriGeriDondur($urunResmi); ?>" border="0" width="60" height="80" alt="Ürün Resmi"></a></td>
                                    <td width="50" align="left" style="border-bottom: 1px dashed #CCC"><a href="index.php?sayfaKodu=81&id=<?php echo donusumleriGeriDondur($favori["id"]); ?>"><img src="resimler/Sil20x20.png" alt="Sil Butonu"></a></td>
                                    <td width="415" align="left" style="border-bottom: 1px dashed #CCC"><a href="index.php?sayfaKodu=83&id=<?php echo donusumleriGeriDondur($urunKaydi["id"]); ?>" style="color: #646464; text-decoration: none;"><?php echo donusumleriGeriDondur($urunAdi); ?></a></td>
                                    <td width="100" align="left" style="border-bottom: 1px dashed #CCC"><?php echo fiyatBicimlendir(donusumleriGeriDondur($urunFiyati)); ?> <?php echo donusumleriGeriDondur($paraBirimi); ?></td>
                                </tr>

                    <?php
                        }

                        if($bulunanSayfaSayisi > 1){

                    ?>

                        <tr height="50">
                            <td colspan="4" align="center">
                                <div class="sayfalamaAlaniKapsayicisi">
                                    <div class="sayfalamaAlaniIciMetinAlaniKapsayicisi">
                                        Toplam <?php echo $bulunanSayfaSayisi; ?> sayfada, <?php echo $toplamKayitSayisi; ?> adet kayıt bulunmaktadır.
                                    </div>
                                    <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
                                        <?php
                                        if($sayfalama > 1){
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=59&sayfalama=1'><<</a></span>";
                                            $sayfalamaIcinSayfaDegeriBirGeriAl = $sayfalama - 1;
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=59&sayfalama=" . $sayfalamaIcinSayfaDegeriBirGeriAl . "'><</a></span>";
                                        }

                                        for($sayfalamaIcinSayfaIndexDegeri=$sayfalama-$sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri<=$sayfalama+$sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri++){
                                            if(($sayfalamaIcinSayfaIndexDegeri>0) and ($sayfalamaIcinSayfaIndexDegeri<=$bulunanSayfaSayisi)){
                                                if($sayfalama == $sayfalamaIcinSayfaIndexDegeri){
                                                    echo "<span class='sayfalamaAktif'>" . $sayfalamaIcinSayfaIndexDegeri . "</span>";
                                                }
                                                else{
                                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=59&sayfalama=" . $sayfalamaIcinSayfaIndexDegeri . "'>$sayfalamaIcinSayfaIndexDegeri</a></span>";
                                                }
                                            }
                                        }

                                        if($sayfalama != $bulunanSayfaSayisi){
                                            $sayfalamaIcinSayfaDegeriBirIleriAl = $sayfalama + 1;
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=59&sayfalama=" . $sayfalamaIcinSayfaDegeriBirIleriAl . "'>></a></span>";
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=59&sayfalama=" . $bulunanSayfaSayisi . "'>>></a></span>";
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
                            <td colspan="4" align="left">Sisiteme Kayıtlı Favori Ürününüz Bulunmamaktadır.</td>
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