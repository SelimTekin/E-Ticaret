<?php
if (isset($_SESSION["yonetici"])) {
    if (isset($_REQUEST["aramaIcerigi"])) {
        $gelenAramaIcerigi = guvenlik($_REQUEST["aramaIcerigi"]);
        $aramaKosulu       = " AND urunAdi LIKE '%" . $gelenAramaIcerigi . "%' ";
        $sayfalamaKosulu   = "&aramaIcerigi=" . $gelenAramaIcerigi;
    } else {
        $aramaKosulu       = "";
        $sayfalamaKosulu   = "";
    }

    $sayfalamaIcinSolveSagButonSayisi   = 2;
    $sayfaBasinaGosterilecekKayitSayisi = 10;

    $toplamKayitSayisiSorgusu           = $db->prepare("SELECT * FROM urunler WHERE durumu = ? $aramaKosulu ORDER BY id DESC");
    $toplamKayitSayisiSorgusu->execute([1]);
    $toplamKayitSayisi                  = $toplamKayitSayisiSorgusu->rowCount();
    $toplamKayitSayisiKayitlari         = $toplamKayitSayisiSorgusu->fetchAll(PDO::FETCH_ASSOC);

    $sayfalamayaBaslanacakKayitSayisi   = ($sayfalama * $sayfaBasinaGosterilecekKayitSayisi) - $sayfaBasinaGosterilecekKayitSayisi;
    $bulunanSayfaSayisi                 = ceil($toplamKayitSayisi / $sayfaBasinaGosterilecekKayitSayisi);
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                <h3>&nbsp;ÜRÜNLER</h3>
            </td>
            <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=95" style="color: #FFF; text-decoration: none;">Yeni Ürün Ekle&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2">
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <div class="aramaAlani">
                                <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=94" method="post">
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
                </table>
            </td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>

        <?php
        $urunlerSorgusu            = $db->prepare("SELECT * FROM urunler WHERE durumu = ? $aramaKosulu ORDER BY id DESC LIMIT $sayfalamayaBaslanacakKayitSayisi, $sayfaBasinaGosterilecekKayitSayisi");
        $urunlerSorgusu->execute([1]);
        $urunlerSayisi             = $urunlerSorgusu->rowCount();
        $urunlerKayitlari          = $urunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);
        

        if ($urunlerSayisi > 0) {
            foreach ($urunlerKayitlari as $urunler) {
                $urununMenuSorgusu            = $db->prepare("SELECT * FROM menuler WHERE id = ? LIMIT 1");
                $urununMenuSorgusu->execute([donusumleriGeriDondur($urunler["menuId"])]);
                $urununMenuKaydi              = $urununMenuSorgusu->fetch(PDO::FETCH_ASSOC);

                if($urunler["urunTuru"] == "Erkek Ayakkabısı"){
                    $resimKlasoru = "Erkek";
                }elseif($urunler["urunTuru"] == "Kadın Ayakkabısı"){
                    $resimKlasoru = "Kadin";
                }elseif($urunler["urunTuru"] == "Çocuk Ayakkabısı"){
                    $resimKlasoru = "Cocuk";
                }

        ?>
                <tr height="80">
                    <td colspan="2" style="border-bottom: 1px dashed #CCC;" valign="top">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="60" valign="top"><img src="../resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo donusumleriGeriDondur($urunler["urunResmiBir"]); ?>" width="60" height="80">
                                </td>
                                <td width="10">&nbsp;</td>
                                <td width="680" valign="top">
                                    <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr height="25">
                                            <td colspan="2"><?php echo donusumleriGeriDondur($urunler["urunTuru"]); ?> -> <?php echo donusumleriGeriDondur($urununMenuKaydi["menuAdi"]); ?></td>
                                        </tr>
                                        <tr height="25">
                                            <td width="580"><?php echo donusumleriGeriDondur($urunler["urunAdi"]); ?></td>
                                            <td width="100" align="right"><?php echo fiyatBicimlendir(donusumleriGeriDondur($urunler["urunFiyati"])); ?> <?php echo donusumleriGeriDondur($urunler["paraBirimi"]); ?></td>
                                        </tr>
                                        <tr height="25">
                                            <td width="540"><?php echo donusumleriGeriDondur($urunler["toplamSatisSayisi"]); ?> adet satıldı. <?php echo donusumleriGeriDondur($urunler["yorumSayisi"]); ?> adet yorumda <?php echo donusumleriGeriDondur($urunler["toplamYorumPuani"]); ?> puan aldı. <?php echo donusumleriGeriDondur($urunler["goruntulenmeSayisi"]); ?> defa görüntülendi.</td>
                                            <td width="140" align="right">
                                                <table width="140" align="right" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=99&id=<?php echo donusumleriGeriDondur($urunler["id"]) ?>"><img src="../resimler/Guncelleme20x20.png" border="0" alt="Güncelle Butonu"></a></td>
                                                        <td width="70" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=99&id=<?php echo donusumleriGeriDondur($urunler["id"]) ?>" style="color: #0000FF; text-decoration: none;">Güncelle</a></td>
                                                        <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=103&id=<?php echo donusumleriGeriDondur($urunler["id"]) ?>"><img src="../resimler/Sil20x20.png" border="0" alt="Sil Butonu"></a></td>
                                                        <td width="20" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=103&id=<?php echo donusumleriGeriDondur($urunler["id"]) ?>" style="color: #FF0000; text-decoration: none;">Sil</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php
            }

            if ($bulunanSayfaSayisi > 1) { ?>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>

                <tr>
                    <td>
                <tr colspan="2" height="50">
                    <td align="center">
                        <div class="sayfalamaAlaniKapsayicisi">
                            <div class="sayfalamaAlaniIciMetinAlaniKapsayicisi">
                                Toplam <?php echo $bulunanSayfaSayisi; ?> sayfada, <?php echo $toplamKayitSayisi; ?> adet kayıt bulunmaktadır.
                            </div>
                            <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
                                <?php
                                if ($sayfalama > 1) {
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=94" . $sayfalamaKosulu . "&sayfalama=1'><<</a></span>";
                                    $sayfalamaIcinSayfaDegeriBirGeriAl = $sayfalama - 1;
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=94" . $sayfalamaKosulu . "&sayfalama=" . $sayfalamaIcinSayfaDegeriBirGeriAl . "'><</a></span>";
                                }

                                for ($sayfalamaIcinSayfaIndexDegeri = $sayfalama - $sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri <= $sayfalama + $sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri++) {
                                    if (($sayfalamaIcinSayfaIndexDegeri > 0) and ($sayfalamaIcinSayfaIndexDegeri <= $bulunanSayfaSayisi)) {
                                        if ($sayfalama == $sayfalamaIcinSayfaIndexDegeri) {
                                            echo "<span class='sayfalamaAktif'>" . $sayfalamaIcinSayfaIndexDegeri . "</span>";
                                        } else {
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=94" . $sayfalamaKosulu . "&sayfalama=" . $sayfalamaIcinSayfaIndexDegeri . "'>$sayfalamaIcinSayfaIndexDegeri</a></span>";
                                        }
                                    }
                                }

                                if ($sayfalama != $bulunanSayfaSayisi) {
                                    $sayfalamaIcinSayfaDegeriBirIleriAl = $sayfalama + 1;
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=94" . $sayfalamaKosulu . "&sayfalama=" . $sayfalamaIcinSayfaDegeriBirIleriAl . "'>></a></span>";
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=94" . $sayfalamaKosulu . "&sayfalama=" . $bulunanSayfaSayisi . "'>>></a></span>";
                                }
                                ?>
                            </div>
                        </div>
                    </td>
                </tr>
                </td>
                </tr>
            <?php }
        } else {
            ?>
            <tr>
                <td colspan="2">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="750">Kayıtlı ürün bulunmamaktadır.</td>
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