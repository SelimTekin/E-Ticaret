<?php
if (isset($_SESSION["yonetici"])) {
    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }

    $yoneticilerSorgusu            = $db->prepare("SELECT * FROM yoneticiler WHERE id = ? LIMIT 1");
    $yoneticilerSorgusu->execute([$gelenId]);
    $yoneticilerSayisi             = $yoneticilerSorgusu->rowCount();
    $yoneticilerBilgisi               = $yoneticilerSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($yoneticilerSayisi > 0) {
?>
        <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=75&id=<?php echo donusumleriGeriDondur($gelenId); ?>" method="post">
            <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="70">
                    <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                        <h3>&nbsp;YÖNETİCİLER</h3>
                    </td>
                    <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=70" style="color: #FFF; text-decoration: none;">Yeni Yönetici Ekle&nbsp;</a></td>
                <tr height="10">
                    <td colspan="2" style="font-size: 10px;">&nbsp;</td>
                </tr>
                <tr>
                <td colspan="2">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">

                        <tr height="40">
                            <td width="230">Kullanıcı Adı</td>
                            <td width="20">:</td>
                            <td width="500"><?php echo donusumleriGeriDondur($yoneticilerBilgisi["kullaniciAdi"]); ?></td> <!-- Kullanıcı adı değiştirilemez. Sadece ekrana yazdırdık. -->
                        </tr>
                        <tr height="40">
                            <td width="230">Şifre</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="sifre" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td colspan="3">Yöneticinin Şifresini Güncellemek İstemiyorsanız Lütfen Şifre Alanını Boş Geçiniz.</td>
                        </tr>
                        <tr height="40">
                            <td width="230">İsim Soyisim</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="isimSoyisim" class="inputAlanlari" value="<?php echo donusumleriGeriDondur($yoneticilerBilgisi["isimSoyisim"]); ?>"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">E-Mail Adresi</td>
                            <td width="20">:</td>
                            <td width="500"><input type="email" name="emailAdresi" class="inputAlanlari" value="<?php echo donusumleriGeriDondur($yoneticilerBilgisi["emailAdresi"]); ?>"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Telefon Numarası</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="telefonNumarasi" class="inputAlanlari" maxlength="11" value="<?php echo donusumleriGeriDondur($yoneticilerBilgisi["telefonNumarasi"]); ?>"></td>
                        </tr>
                        <tr height="40">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td width="500"><input type="submit" value="Yönetici Güncelle" class="maviButon"></td>
                        </tr>
                    </table>
                </td>
                </tr>
            </table>
        </form>
<?php
    } else {
        header("Location: index.php?sayfaKoduDis=77");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>