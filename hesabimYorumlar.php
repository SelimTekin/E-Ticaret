<?php
if ($_SESSION["kullanici"]) { // üye girişi yapılmışsa hesabım sayfasına yönlendirir. Giriş yapmadan url üzerinden bu sayfaya erişilmesini engeller.

    $sayfalamaIcinSolveSagButonSayisi   = 2;
    $sayfaBasinaGosterilecekKayitSayisi = 10;

    $toplamKayitSayisiSorgusu           = $db->prepare("SELECT * FROM yorumlar WHERE uyeId = ? ORDER BY yorumTarihi DESC");
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
                        <td  colspan="2" style="color: #FF9900;">
                            <h3>Hesabım > Yorumlar</h3>
                        </td>
                    </tr>

                    <tr height="40">
                        <td  colspan="2" valign="30" style="border-bottom: 1px dashed #CCC;">Tüm Yorumlarınızı Bu Alandan Görüntüleyebilirsiniz.</td>
                    </tr>

                    <tr height="50">
                        <td width="125" align="left" style="background: #f8ffa7; color: black;">&nbsp;Puan</td>
                        <td width="75" align="left" style="background: #f8ffa7; color: black;">Yorum&nbsp;</td>
                    </tr>

                    <?php

                    $yorumlarSorgusu = $db->prepare("SELECT * FROM yorumlar WHERE uyeId = ? ORDER BY yorumTarihi DESC LIMIT $sayfalamayaBaslanacakKayitSayisi, $sayfaBasinaGosterilecekKayitSayisi");
                    $yorumlarSorgusu->execute([$kullaniciId]);
                    $yorumlarSayisi     = $yorumlarSorgusu->rowCount();
                    $yorumlarKayitlari  = $yorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);
                    
                    if ($yorumlarSayisi > 0) {
                        foreach ($yorumlarKayitlari as $yorum) {
                            $verilenPuan = $yorum["puan"];

                            if($verilenPuan == 1){
                                $resimDosyasi = "yildizBirDolu.png";
                            }
                            elseif($verilenPuan == 2){
                                $resimDosyasi = "yildizIkiDolu.png";
                            }
                            elseif($verilenPuan == 3){
                                $resimDosyasi = "yildizUcDolu.png";
                            }
                            elseif($verilenPuan == 4){
                                $resimDosyasi = "yildizDortDolu.png";
                            }
                            elseif($verilenPuan == 5){
                                $resimDosyasi = "yildizBesDolu.png";
                            }

                    ?>
                                <tr>
                                    <td width="85" align="left" style="border-bottom: 1px dashed #CCC; padding: 15px 0px;" valign="top"><img src="resimler/<?php echo $resimDosyasi; ?>" border="0" alt="Ürün Resmi"></td>
                                    <td width="980" align="left" style="border-bottom: 1px dashed #CCC; padding: 15px 0px;" valign="top"><?php echo donusumleriGeriDondur($yorum["yorumMetni"]); ?></td>
                                </tr>
                    <?php
                            }

                        if($bulunanSayfaSayisi > 1){

                    ?>

                        <tr height="50">
                            <td colspan="2" align="center">
                                <div class="sayfalamaAlaniKapsayicisi">
                                    <div class="sayfalamaAlaniIciMetinAlaniKapsayicisi">
                                        Toplam <?php echo $bulunanSayfaSayisi; ?> sayfada, <?php echo $toplamKayitSayisi; ?> adet kayıt bulunmaktadır.
                                    </div>
                                    <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
                                        <?php
                                        if($sayfalama > 1){
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=60&sayfalama=1'><<</a></span>";
                                            $sayfalamaIcinSayfaDegeriBirGeriAl = $sayfalama - 1;
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=60&sayfalama=" . $sayfalamaIcinSayfaDegeriBirGeriAl . "'><</a></span>";
                                        }

                                        for($sayfalamaIcinSayfaIndexDegeri=$sayfalama-$sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri<=$sayfalama+$sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri++){
                                            if(($sayfalamaIcinSayfaIndexDegeri>0) and ($sayfalamaIcinSayfaIndexDegeri<=$bulunanSayfaSayisi)){
                                                if($sayfalama == $sayfalamaIcinSayfaIndexDegeri){
                                                    echo "<span class='sayfalamaAktif'>" . $sayfalamaIcinSayfaIndexDegeri . "</span>";
                                                }
                                                else{
                                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=60&sayfalama=" . $sayfalamaIcinSayfaIndexDegeri . "'>$sayfalamaIcinSayfaIndexDegeri</a></span>";
                                                }
                                            }
                                        }

                                        if($sayfalama != $bulunanSayfaSayisi){
                                            $sayfalamaIcinSayfaDegeriBirIleriAl = $sayfalama + 1;
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=60&sayfalama=" . $sayfalamaIcinSayfaDegeriBirIleriAl . "'>></a></span>";
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKodu=60&sayfalama=" . $bulunanSayfaSayisi . "'>>></a></span>";
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
                            <td colspan="2" align="left">Sisiteme Kayıtlı Yorum Bulunmamaktadır.</td>
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