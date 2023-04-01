<?php
if (isset($_SESSION["yonetici"])) {
    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }

    $hesaplarSorgusu            = $db->prepare("SELECT * FROM bankahesaplarimiz WHERE id = ? LIMIT 1");
    $hesaplarSorgusu->execute([$gelenId]);
    $hesaplarSayisi             = $hesaplarSorgusu->rowCount();
    $hesapBilgisi          = $hesaplarSorgusu->fetch(PDO::FETCH_ASSOC);

    if($hesaplarSayisi > 0){
?>
    <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=15&id=<?php echo donusumleriGeriDondur($gelenId); ?>" method="post" enctype="multipart/form-data">
        <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="70">
                <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                    <h3>&nbsp;BANKA HESAP AYARLARI</h3>
                </td>
                <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=10" style="color: #FFF; text-decoration: none;">Yeni Banka Hesabı Ekle&nbsp;</a></td>
            </tr>
            <tr height="10">
                <td colspan="2" style="font-size: 10px;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">

                        <tr height="40">
                            <td width="230">Banka Logosu</td>
                            <td width="20">:</td>
                            <td width="500"><input type="file" name="bankaLogosu"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Banka Adı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="bankaAdi" value="<?php echo $hesapBilgisi["bankaAdi"]; ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Banka Şube Adı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="subeAdi" value="<?php echo $hesapBilgisi["subeAdi"]; ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Banka Şube Kodu</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="subeKodu" value="<?php echo $hesapBilgisi["subeKodu"]; ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Bankanın Bulunuduğu Şehir</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="konumSehir" value="<?php echo $hesapBilgisi["konumSehir"]; ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Bankanın Bulunduğu Ülke</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="konumUlke" value="<?php echo $hesapBilgisi["konumUlke"]; ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Hesabın Para Birimi</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="paraBirimi" value="<?php echo $hesapBilgisi["paraBirimi"]; ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Hesap Sahibi</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="hesapSahibi" value="<?php echo $hesapBilgisi["hesapSahibi"]; ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Hesap Numarası</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="hesapNumarasi" value="<?php echo $hesapBilgisi["hesapNumarasi"]; ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">IBAN</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="ibanNumarasi" value="<?php echo $hesapBilgisi["ibanNumarasi"]; ?>" class="inputAlanlari"></td>
                        </tr>
                        
                        <tr height="40">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td width="500"><input type="submit" value="Banka Hesabı Kaydet" class="maviButon"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
<?php
    }else{
        header("Location: index.php?sayfaKoduDis=17");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>