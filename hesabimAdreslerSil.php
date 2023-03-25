<?php
if(isset($_SESSION["kullanici"])){
    if(isset($_GET["id"])){
        $gelenId = $_GET["id"];
    }
    else{
        $gelenId = "";
    }

    if($gelenId != ""){

        $adresSilmeSorgusu = $db->prepare("DELETE FROM adresler WHERE id = ? LIMIT 1");
        $adresSilmeSorgusu->execute([$gelenId]);
        $adresSilmeSayisi = $adresSilmeSorgusu->rowCount();

        if($adresSilmeSayisi > 0){
            header("Location: index.php?sayfaKodu=68");
            exit();
        }
        else{
            header("Location: index.php?sayfaKodu=69");
            exit();
        }
    }
    else{
        header("Location: index.php?sayfaKodu=69");
        exit();
    }
}
else{
    header("Location: index.php");
    exit();
}
?>