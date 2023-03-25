<?php
if (isset($_SESSION["kullanici"])) { // üye girişi yapılmışsa hesabım sayfasına yönlendirir. Giriş yapmadan url üzerinden bu sayfaya erişilmesini engeller.
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
                        <td  colspan="5" style="color: #FF9900;">
                            <h3>Hesabım > Adresler</h3>
                        </td>
                    </tr>

                    <tr height="40">
                        <td  colspan="5" valign="30" style="border-bottom: 1px dashed #CCC;">Tüm adreslerini görüntüleyebilir veya güncelleyebilirsin.</td>
                    </tr>

                    <tr height="50">
                        <td colspan="1" align="center" style="background: #f8ffa7; color: black; font-weight: bold;">ADRESLER</td>
                        <td colspan="4" align="right" style="background: #f8ffa7; color: black; font-weight: bold;"><a href="index.php?sayfaKodu=70" style="text-decoration: none; color: #000;">+ Yeni Adres Ekle</a>&nbsp;</td>
                    </tr>

                    <?php
                    $adreslerSorgusu = $db->prepare("SELECT * FROM adresler WHERE uyeId = ?");
                    $adreslerSorgusu->execute([$kullaniciId]);
                    $adresSayisi     = $adreslerSorgusu->rowCount();
                    $adresKayitlari  = $adreslerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                    $birinciRenk = "#F1F1F1";
                    $ikinciRenk  = "#FFFFFF";
                    $renkSayisi  = 1;
                    
                    if ($adresSayisi > 0) {
                        foreach ($adresKayitlari as $adres) {
                            if($renkSayisi % 2){
                                $arkaPlanRengi = $birinciRenk;
                            }
                            else{
                                $arkaPlanRengi = $ikinciRenk;
                            }
                    ?>
                            <tr height="50" bgcolor="<?php echo $arkaPlanRengi; ?>">
                                <td align="left"><?php echo $adres["adiSoyadi"]; ?> - <?php echo $adres["adres"]; ?> <?php echo $adres["ilce"]; ?> / <?php echo $adres["sehir"]; ?> - <?php echo $adres["telefonNumarasi"]; ?></td>
                                <td width="25"><img src="resimler/Guncelleme20x20.png" alt="guncelle" style="margin-top: 5px;"></td>
                                <td width="70"><a href="index.php?sayfaKodu=62&id=<?php echo $adres["id"]; ?>" style="text-decoration: none; color: #646464;">Güncelle</a></td>
                                <td width="25"><img src="resimler/Sil20x20.png" alt="sil" style="margin-top: 5px;"></td>
                                <td width="25"><a href="index.php?sayfaKodu=67&id=<?php echo $adres["id"]; ?>" style="text-decoration: none; color: #646464;">Sil</a></td>
                            </tr>
                    <?php
                            $renkSayisi ++;
                        }
                    } else {
                        ?>

                        <tr height="50">
                            <td colspan="5" align="left">Sisiteme Kayıtlı Adresiniz Bulunmamaktadır.</td>
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