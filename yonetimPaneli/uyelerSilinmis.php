<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_REQUEST["aramaIcerigi"])) {
        $gelenAramaIcerigi = guvenlik($_REQUEST["aramaIcerigi"]);
        $aramaKosulu       = " AND (emailAdresi LIKE '%" . $gelenAramaIcerigi . "%' OR isimSoyisim LIKE '%" . $gelenAramaIcerigi . "%' OR telefonNumarasi LIKE '%" . $gelenAramaIcerigi . "%') ";
        $sayfalamaKosulu   = "&aramaIcerigi=" . $gelenAramaIcerigi;
    } else {
        $aramaKosulu       = "";
        $sayfalamaKosulu   = "";
    }

    $sayfalamaIcinSolveSagButonSayisi   = 2;
    $sayfaBasinaGosterilecekKayitSayisi = 10;

    $toplamKayitSayisiSorgusu           = $db->prepare("SELECT * FROM uyeler WHERE silinmeDurumu = ? $aramaKosulu ORDER BY id DESC");
    $toplamKayitSayisiSorgusu->execute([1]);
    $toplamKayitSayisi                  = $toplamKayitSayisiSorgusu->rowCount();
    $toplamKayitSayisiKayitlari         = $toplamKayitSayisiSorgusu->fetchAll(PDO::FETCH_ASSOC);

    $sayfalamayaBaslanacakKayitSayisi   = ($sayfalama * $sayfaBasinaGosterilecekKayitSayisi) - $sayfaBasinaGosterilecekKayitSayisi;
    $bulunanSayfaSayisi                 = ceil($toplamKayitSayisi / $sayfaBasinaGosterilecekKayitSayisi);

?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                <h3>&nbsp;ÜYELER</h3>
            </td>
            <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=82" style="color: #FFF; text-decoration: none;">Aktif Üyeler&nbsp;</a></td>
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
                                <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=83" method="post">
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
        $uyelerSorgusu            = $db->prepare("SELECT * FROM uyeler WHERE silinmeDurumu = ? $aramaKosulu ORDER BY id DESC LIMIT $sayfalamayaBaslanacakKayitSayisi, $sayfaBasinaGosterilecekKayitSayisi");
        $uyelerSorgusu->execute([1]);
        $uyelerSayisi             = $uyelerSorgusu->rowCount();
        $uyelerKayitlari          = $uyelerSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($uyelerSayisi > 0) {
            foreach ($uyelerKayitlari as $uyeler) {
        ?>
                <tr height="80">
                    <td colspan="2" style="border-bottom: 1px dashed #CCC;" valign="top">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr height="30">
                                <td width="85"><b>Adı Soyadı</b></td>
                                <td width="10"><b>:</b></td>
                                <td width="150"><?php echo donusumleriGeriDondur($uyeler["isimSoyisim"]); ?></td>
                                <td width="90"><b>E-Mail</b></td>
                                <td width="10"><b>:</b></td>
                                <td width="200"><?php echo donusumleriGeriDondur($uyeler["emailAdresi"]); ?></td>
                                <td width="70"><b>Telefon</b></td>
                                <td width="10"><b>:</b></td>
                                <td width="95"><?php echo donusumleriGeriDondur($uyeler["telefonNumarasi"]); ?></td>
                            </tr>
                            <tr height="30">
                                <td width="85"><b>Cinsiyet</b></td>
                                <td width="10"><b>:</b></td>
                                <td width="150"><?php echo donusumleriGeriDondur($uyeler["cinsiyet"]); ?></td>
                                <td width="90"><b>Kayıt Tarihi</b></td>
                                <td width="10"><b>:</b></td>
                                <td width="200"><?php echo tarihCevir(donusumleriGeriDondur($uyeler["kayitTarihi"])); ?></td>
                                <td width="70"><b>Kayıt IP</b></td>
                                <td width="10"><b>:</b></td>
                                <td width="95"><?php echo donusumleriGeriDondur($uyeler["kayitIpAdresi"]); ?></td>
                            </tr>
                            <tr>
                                <td colspan="9" align="right">
                                    <table width="95" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="20">&nbsp;</td>
                                            <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=87&id=<?php echo donusumleriGeriDondur($uyeler["id"]) ?>"><img src="../resimler/Guncelleme20x20.png" border="0" alt="Sil Butonu"></a></td>
                                            <td width="50" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=87&id=<?php echo donusumleriGeriDondur($uyeler["id"]) ?>" style="color: #009900; text-decoration: none;">Geri Aç</a></td>
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
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=83" . $sayfalamaKosulu . "&sayfalama=1'><<</a></span>";
                                    $sayfalamaIcinSayfaDegeriBirGeriAl = $sayfalama - 1;
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=83" . $sayfalamaKosulu . "&sayfalama=" . $sayfalamaIcinSayfaDegeriBirGeriAl . "'><</a></span>";
                                }

                                for ($sayfalamaIcinSayfaIndexDegeri = $sayfalama - $sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri <= $sayfalama + $sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri++) {
                                    if (($sayfalamaIcinSayfaIndexDegeri > 0) and ($sayfalamaIcinSayfaIndexDegeri <= $bulunanSayfaSayisi)) {
                                        if ($sayfalama == $sayfalamaIcinSayfaIndexDegeri) {
                                            echo "<span class='sayfalamaAktif'>" . $sayfalamaIcinSayfaIndexDegeri . "</span>";
                                        } else {
                                            echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=83" . $sayfalamaKosulu . "&sayfalama=" . $sayfalamaIcinSayfaIndexDegeri . "'>$sayfalamaIcinSayfaIndexDegeri</a></span>";
                                        }
                                    }
                                }

                                if ($sayfalama != $bulunanSayfaSayisi) {
                                    $sayfalamaIcinSayfaDegeriBirIleriAl = $sayfalama + 1;
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=83" . $sayfalamaKosulu . "&sayfalama=" . $sayfalamaIcinSayfaDegeriBirIleriAl . "'>></a></span>";
                                    echo "<span class='sayfalamaPasif'><a href='index.php?sayfaKoduDis=0&sayfaKoduIc=83" . $sayfalamaKosulu . "&sayfalama=" . $bulunanSayfaSayisi . "'>>></a></span>";
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
                            <td width="750">Silinmiş üye bulunmamaktadır.</td>
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