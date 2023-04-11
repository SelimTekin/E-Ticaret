<?php
if (isset($_SESSION["yonetici"])) {
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td bgcolor="#FF9900" style="color: #FFF" align="left">
                <h3>&nbsp;HAVALE BİLDİRİMLERİ</h3>
            </td>
        </tr>
        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>
        <?php
        $bildirimSorgusu            = $db->prepare("SELECT * FROM havalebildirimleri ORDER BY islemTarihi ASC");
        $bildirimSorgusu->execute();
        $bildirimSayisi             = $bildirimSorgusu->rowCount();
        $bildirimKayitlari          = $bildirimSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($bildirimSayisi > 0) {
            foreach ($bildirimKayitlari as $bildirim) {

                $bankaSorgusu            = $db->prepare("SELECT * FROM bankahesaplarimiz WHERE id = ? LIMIT 1");
                $bankaSorgusu->execute([$bildirim["bankaId"]]);
                $bankaKayitlari          = $bankaSorgusu->fetch(PDO::FETCH_ASSOC);
        ?>
                <tr>
                    <td style="border-bottom: 1px dashed #CCC;" valign="top">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr height="30">
                                <td colspan="2" align="left" width="400"><b><?php echo donusumleriGeriDondur($bildirim["adiSoyadi"]); ?></b></td>
                                <td align="right" width="350"><?php echo tarihCevir(donusumleriGeriDondur($bildirim["islemTarihi"])); ?></td>
                            </tr>
                            <tr>
                                <td align="left" width="200">Banka : <?php echo donusumleriGeriDondur($bankaKayitlari["bankaAdi"]); ?></td>
                                <td align="left" width="200">Telefon : <?php echo donusumleriGeriDondur($bildirim["telefonNumarasi"]); ?></td>
                                <td align="left" width="350">E-Mail : <?php echo donusumleriGeriDondur($bildirim["emailAdresi"]); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="left">Açıklama Notu : <?php echo donusumleriGeriDondur($bildirim["aciklama"]); ?></td>
                            </tr>
                            <tr height="20">
                                <td colspan="3" align="left">
                                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr height="20">
                                            <td width="695">&nbsp;</td>
                                            <td width="25" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=117&id=<?php echo donusumleriGeriDondur($bildirim["id"]) ?>"><img src="../resimler/Sil20x20.png" border="0" alt="Sil Butonu"></a></td>
                                            <td width="42" valign="top"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=117&id=<?php echo donusumleriGeriDondur($bildirim["id"]) ?>" style="color: #FF0000; text-decoration: none;">Sil</a></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td>
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="750">Kayıtlı havale bildirimi bulunmamaktadır.</td>
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