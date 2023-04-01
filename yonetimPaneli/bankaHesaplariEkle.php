<?php
if (isset($_SESSION["yonetici"])) {
?>
    <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=11" method="post" enctype="multipart/form-data">
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
                            <td width="500"><input type="text" name="bankaAdi" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Banka Şube Adı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="subeAdi" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Banka Şube Kodu</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="subeKodu" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Bankanın Bulunuduğu Şehir</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="konumSehir" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Bankanın Bulunduğu Ülke</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="konumUlke" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Hesabın Para Birimi</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="paraBirimi" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Hesap Sahibi</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="hesapSahibi" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Hesap Numarası</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="hesapNumarasi" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">IBAN</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="ibanNumarasi" class="inputAlanlari"></td>
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
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>