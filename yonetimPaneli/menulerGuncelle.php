<?php
if (isset($_SESSION["yonetici"])) {
    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }

    $menulerSorgusu            = $db->prepare("SELECT * FROM menuler WHERE id = ? LIMIT 1");
    $menulerSorgusu->execute([$gelenId]);
    $menuSayisi             = $menulerSorgusu->rowCount();
    $menuBilgisi               = $menulerSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($menuSayisi > 0) {
?>
        <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=63&id=<?php echo donusumleriGeriDondur($gelenId); ?>" method="post">
            <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="70">
                    <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                        <h3>&nbsp;MENÜLER</h3>
                    </td>
                    <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=58" style="color: #FFF; text-decoration: none;">Yeni Menü Ekle&nbsp;</a></td>
                </tr>
                <tr height="10">
                    <td colspan="2" style="font-size: 10px;">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">

                            <tr height="40">
                                <td width="230">Menü İçin Ürün Türü</td>
                                <td width="20">:</td>
                                <td width="500"><?php echo donusumleriGeriDondur($menuBilgisi["urunTuru"]); ?></td>
                            </tr>
                            <tr height="40">
                                <td width="230">Menü Adı</td>
                                <td width="20">:</td>
                                <td width="500"><input type="text" name="menuAdi" class="inputAlanlari" value="<?php echo $menuBilgisi["menuAdi"]; ?>"></td>
                            </tr>
                            <tr height="40">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td width="500"><input type="submit" value="Menü Güncelle" class="maviButon"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tr>
            </table>
        </form>
<?php
    } else {
        header("Location: index.php?sayfaKoduDis=41");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>