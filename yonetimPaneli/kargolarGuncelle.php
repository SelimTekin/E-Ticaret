<?php
if (isset($_SESSION["yonetici"])) {
    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }

    $kargolarSorgusu            = $db->prepare("SELECT * FROM kargofirmalari WHERE id = ? LIMIT 1");
    $kargolarSorgusu->execute([$gelenId]);
    $kargolarSayisi             = $kargolarSorgusu->rowCount();
    $kargoBilgisi               = $kargolarSorgusu->fetch(PDO::FETCH_ASSOC);

    if($kargolarSayisi > 0){
?>
    <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=27&id=<?php echo donusumleriGeriDondur($gelenId); ?>" method="post" enctype="multipart/form-data">
        <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="70">
                <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                    <h3>&nbsp;BANKA HESAP AYARLARI</h3>
                </td>
                <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=22" style="color: #FFF; text-decoration: none;">Yeni Banka Hesabı Ekle&nbsp;</a></td>
            </tr>
            <tr height="10">
                <td colspan="2" style="font-size: 10px;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">

                        <tr height="40">
                            <td width="230">Kargo Firması Logosu</td>
                            <td width="20">:</td>
                            <td width="500"><input type="file" name="kargoFirmasiLogosu"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Kargo Firması Adı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="kargoFirmasiAdi" value="<?php echo $kargoBilgisi["kargoFirmasiAdi"]; ?>" class="inputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td width="500"><input type="submit" value="Kargo Firması Hesabı Kaydet" class="maviButon"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
<?php
    }else{
        header("Location: index.php?sayfaKoduDis=29");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>