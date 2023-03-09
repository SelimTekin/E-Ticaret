<?php
if(isset($_POST["kargoTakipNosu"])){
    $gelenKargoTakipNosu = sayiIcerenIcerikleriFiltrele(guvenlik($_POST["kargoTakipNosu"]));
}
else{
    $gelenKargoTakipNosu = "";
}

if($gelenKargoTakipNosu != ""){
    header("Location:https://www.yurticikargo.com/tr/online-servisler/gonderi-sorgula?code=" . $gelenKargoTakipNosu);
    exit();
}
else{
    header("Location:index.php?sayfaKodu=14");
    exit();
}
?>