<?php
if(isset($_SESSION["kullanici"])){ // üye girişi yapılmışsa hesabım sayfasına yönlendirir. Giriş yapmadan url üzerinden bu sayfaya erişilmesini engeller.
    if (isset($_GET["urunId"])) {
        $gelenUrunId = guvenlik($_GET["urunId"]);
    } else {
        $gelenUrunId = "";
    }

    if($gelenUrunId != ""){
?>

<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="500"  valign="top">
            <form action="index.php?sayfaKodu=76&urunId=<?php echo $gelenUrunId; ?>" method="post">
                <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color: #FF9900;"><h3>Hesabım > Yorum Yap</h3></td>
                    </tr>
                    <tr height="40">
                        <td valign="30" style="border-bottom: 1px dashed #CCC;">Satın Almış Olduğunuz Ürün İle Alakalı Yorumunuzu Aşağıdan Belirtebilirsiniz.</td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">Puanlama (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left">
                            <table width="360" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="64"><img src="resimler/YildizBirDolu.png" alt="Puanlama ikonları" border="0"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64"><img src="resimler/YildizIkiDolu.png" alt="Puanlama ikonları" border="0"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64"><img src="resimler/YildizUcDolu.png" alt="Puanlama ikonları" border="0"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64"><img src="resimler/YildizDortDolu.png" alt="Puanlama ikonları" border="0"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64"><img src="resimler/YildizBesDolu.png" alt="Puanlama ikonları" border="0"></td>
                                </tr>
                                <tr>
                                    <td width="64" align="center"><input type="radio" name="puan" value="1"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64" align="center"><input type="radio" name="puan" value="2"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64" align="center"><input type="radio" name="puan" value="3"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64" align="center"><input type="radio" name="puan" value="4"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64" align="center"><input type="radio" name="puan" value="5"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">Yorum Metni (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><textarea name="yorum" id="yorum" class="yorumIcinTextAreaAlanlari" cols="30" rows="10"></textarea></td>
                    </tr>

                    <tr height="40">
                        <td colspan="2" align="center"><input type="submit" value="Yorumu Gönder" class="maviButon"></td>
                    </tr>

                </table>
            </form>
        </td>

        <td width="20">&nbsp;</td>

        <td width="545" valign="top">
            <table width="545" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="40">
                    <td style="color: #FF9900;"><h3>Reklam</h3></td>
                </tr>
                <tr height="40">
                    <td valign="30" style="border-bottom: 1px dashed #CCC;">demo.net Reklamları</td>
                </tr>
                <tr>
                    <td style="font-size: 5px;">&nbsp;</td>
                </tr>
                <tr>
                    <td><img src="#" alt="reklam" title="reklam" border="0"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<?php
    }
    else{
        header("Location: index.php?sayfaKodu=78");
        exit();
    }
}
else{
    header("Location: index.php");
    exit();
}
?>