<?php
if (isset($_SESSION["yonetici"])) {

    $sayfalamaIcinSolveSagButonSayisi   = 2;
    $sayfaBasinaGosterilecekKayitSayisi = 10;

    $toplamKayitSayisiSorgusu           = $db->prepare("SELECT * FROM yorumlar ORDER BY id DESC");
    $toplamKayitSayisiSorgusu->execute();
    $toplamKayitSayisi                  = $toplamKayitSayisiSorgusu->rowCount();
    $toplamKayitSayisiKayitlari         = $toplamKayitSayisiSorgusu->fetchAll(PDO::FETCH_ASSOC);

    $sayfalamayaBaslanacakKayitSayisi   = ($sayfalama * $sayfaBasinaGosterilecekKayitSayisi) - $sayfaBasinaGosterilecekKayitSayisi;
    $bulunanSayfaSayisi                 = ceil($toplamKayitSayisi / $sayfaBasinaGosterilecekKayitSayisi);

?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                <h3>&nbsp;YORUMLAR</h3>
            </td>
        </tr>
        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>

        <?php
        $yorumlarSorgusu            = $db->prepare("SELECT * FROM yorumlar ORDER BY id DESC LIMIT $sayfalamayaBaslanacakKayitSayisi, $sayfaBasinaGosterilecekKayitSayisi");
        $yorumlarSorgusu->execute();
        $yorumlarSayisi             = $yorumlarSorgusu->rowCount();
        $yorumlarKayitlari          = $yorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($yorumlarSayisi > 0) {
            foreach ($yorumlarKayitlari as $yorumlar) {

                if (donusumleriGeriDondur($yorumlar["puan"]) == "1") {
                    $puanResmi = "YildizBirDolu.png";
                } elseif (donusumleriGeriDondur($yorumlar["puan"]) == "2") {
                    $puanResmi = "YildizIkiDolu.png";
                } elseif (donusumleriGeriDondur($yorumlar["puan"]) == "3") {
                    $puanResmi = "YildizUcDolu.png";
                } elseif (donusumleriGeriDondur($yorumlar["puan"]) == "4") {
                    $puanResmi = "YildizDortDolu.png";
                } elseif (donusumleriGeriDondur($yorumlar["puan"]) == "5") {
                    $puanResmi = "YildizBesDolu.png";
                }
        ?>
                <tr>
                    <td style="border-bottom: 1px dashed #CCC;" valign="top">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="3"><?php echo donusumleriGeriDondur($yorumlar["yorumMetni"]); ?></td>
                            </tr>
                            <tr>
                                <td width="685"><img src="../resimler/<?php echo $puanResmi; ?>" alt="Puan Resmi" border="0"></td>
                                <td width="10">&nbsp;</td>
                                <td width="55">
                                    <table width="55" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="40">&nbsp;</td>
                                            <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=91&id=<?php echo donusumleriGeriDondur($yorumlar["id"]) ?>"><img src="../resimler/Sil20x20.png" border="0" alt="Sil Butonu"></a></td>
                                            <td width="42" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=91&id=<?php echo donusumleriGeriDondur($yorumlar["id"]) ?>" style="color: #FF0000; text-decoration: none;">Sil</a></td>
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
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=90&sayfalama=1'><<</a></span>";
                                    $sayfalamaIcinSayfaDegeriBirGeriAl = $sayfalama - 1;
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=90&sayfalama=" . $sayfalamaIcinSayfaDegeriBirGeriAl . "'><</a></span>";
                                }

                                for ($sayfalamaIcinSayfaIndexDegeri = $sayfalama - $sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri <= $sayfalama + $sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri++) {
                                    if (($sayfalamaIcinSayfaIndexDegeri > 0) and ($sayfalamaIcinSayfaIndexDegeri <= $bulunanSayfaSayisi)) {
                                        if ($sayfalama == $sayfalamaIcinSayfaIndexDegeri) {
                                            echo "<span class='sayfalamaAktif'>" . $sayfalamaIcinSayfaIndexDegeri . "</span>";
                                        } else {
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=90&sayfalama=" . $sayfalamaIcinSayfaIndexDegeri . "'>$sayfalamaIcinSayfaIndexDegeri</a></span>";
                                        }
                                    }
                                }

                                if ($sayfalama != $bulunanSayfaSayisi) {
                                    $sayfalamaIcinSayfaDegeriBirIleriAl = $sayfalama + 1;
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=90&sayfalama=" . $sayfalamaIcinSayfaDegeriBirIleriAl . "'>></a></span>";
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=90&sayfalama=" . $bulunanSayfaSayisi . "'>>></a></span>";
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
                <td>
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="750">Kayıtlı yorum bulunmamaktadır.</td>
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