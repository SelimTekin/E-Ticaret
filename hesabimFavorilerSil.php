<?php
if(isset($_SESSION["kullanici"])){
    if(isset($_GET["id"])){
        $gelenId = $_GET["id"];
    }
    else{
        $gelenId = "";
    }

    if($gelenId != ""){

        $favoriSilmeSorgusu = $db->prepare("DELETE FROM favoriler WHERE id = ? AND uyeId = ? LIMIT 1");
        $favoriSilmeSorgusu->execute([$gelenId, $kullaniciId]);
        $favoriSilmeSayisi = $favoriSilmeSorgusu->rowCount();

        if($favoriSilmeSayisi > 0){
            header("Location: index.php?sayfaKodu=59");
            exit();
        }
        else{
            header("Location: index.php?sayfaKodu=82");
            exit();
        }
    }
    else{
        header("Location: index.php?sayfaKodu=82");
        exit();
    }
}
else{
    header("Location: index.php");
    exit();
}
?>