<?php

if (isset($_GET["aktivasyonKodu"])) {
    $gelenAktivasyonKodu = guvenlik($_GET["aktivasyonKodu"]);
} else {
    $gelenAktivasyonKodu = "";
}

if (isset($_GET["email"])) {
    $gelenEmail = guvenlik($_GET["email"]);
} else {
    $gelenEmail = "";
}


if (($gelenAktivasyonKodu != "") and ($gelenEmail != "")) {

    $kontrolSorgusu  = $db->prepare("SELECT * FROM uyeler WHERE emailAdresi = ? AND aktivasyonKodu = ?");
    $kontrolSorgusu->execute([$gelenEmailAdresi, $MD5liSifre]);
    $kullaniciSayisi = $kontrolSorgusu->rowCount();
    $kullanicKaydi   = $kontrolSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($kullaniciSayisi > 0) {
?>

<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="500"  valign="top">
            <form action="index.php?sayfaKodu=44&emailAdresi=<?php echo $gelenEmail; ?>&aktivasyonKodu=<?php echo $gelenAktivasyonKodu; ?>" method="post">
                <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td colspan="2" style="color: #FF9900;"><h3>Şifre Sıfırlama</h3></td>
                    </tr>
                    <tr height="40">
                        <td colspan="2" valign="30" style="border-bottom: 1px dashed #CCC;">Aşağıdan Hesabına Giriş Şifreni Değiştirebilirsin.</td>
                    </tr>

                    <tr height="30">
                        <td colspan="2" valign="bottom" align="left">Yeni Şifre (*)</td>
                    </tr>
                    <tr height="30">
                        <td colspan="2" valign="top" align="left"><input type="password" name="sifre" class="inputAlanlari"></td>
                    </tr>

                    <tr height="30">
                        <td colspan="2" valign="bottom" align="left">Yeni Şifre Tekrar (*)</td>
                    </tr>
                    <tr height="30">
                        <td colspan="2" valign="top" align="left"><input type="password" name="sifreTekrar" class="inputAlanlari"></td>
                    </tr>

                    <tr height="40">
                        <td colspan="2" align="center"><input type="submit" value="Şifremi Güncelle" class="maviButon"></td>
                    </tr>

                </table>
            </form>
        </td>

        <td width="20">&nbsp;</td>

        <td width="545" valign="top">
            <table width="545" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="40">
                    <td colspan="2" style="color: #FF9900;"><h3>Yeni Şifre Oluşturma</h3></td>
                </tr>
                <tr height="40">
                    <td colspan="2" valign="30" style="border-bottom: 1px dashed #CCC;">Çalışma ve işleyiş Açıklaması.</td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size: 5px;">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td align="left" width="30"><img src="resimler/CarklarSiyah20x20.png" alt="bankaIcon" border="0" style="margin-top: 3px;"></td>
                    <td align="left"><b>Bilgi Kontrolü</b></td>
                </tr>
                <tr height="30">
                    <td colspan="2" align="left">Kullanıcının form alanına girmiş olduğu değer veya değerler veritabanımızda tam detaylı olarak filtrelenerek kontrol edilir.</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td align="left" width="30"><img src="resimler/CarklarSiyah20x20.png" alt="bankaIcon" border="0" style="margin-top: 3px;"></td>
                    <td align="left"><b>E-mail Gönderimi & İçerik</b></td>
                </tr>
                <tr height="30">
                    <td colspan="2" align="left">Bilgi kontrolü başarılı olur ise, kullanıcının veritabanımızda kayıtlı olan e-mail adresine yeni şifreoluşturma içerikli bir mail gönderilir.</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td align="left" width="30"><img src="resimler/CarklarSiyah20x20.png" alt="bankaIcon" border="0" style="margin-top: 3px;"></td>
                    <td align="left"><b>Şİfre Sıfırlama & Oluşturma</b></td>
                </tr>
                <tr height="30">
                    <td colspan="2" align="left">Kullanıcı kendisine iletilen mail içerisindeki "Yeni Şifre Oluştur" metnine tıklayacak olur ise, site yeni şifre oluşturma sayfası açılır ve kullanıcıdan, yeni hesap şifresini oluşturması istenir.</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td align="left" width="30"><img src="resimler/CarklarSiyah20x20.png" alt="bankaIcon" border="0" style="margin-top: 3px;"></td>
                    <td align="left"><b>Sonuç</b></td>
                </tr>
                <tr height="30">
                    <td colspan="2" align="left">Kullanıcı yeni oluşturmuş olduğu hesap şifresi ile siteye giriş yapmaya hazırdır.</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php } else {
            header("Location: index.php");
            exit();
        } 
}
else {
    header("Location: index.php");
    exit();
} 
?>