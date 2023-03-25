<?php
if(isset($_SESSION["kullanici"])){
    if(isset($_GET["id"])){
        $gelenId = $_GET["id"];
    }
    else{
        $gelenId = "";
    }

    if($gelenId != ""){

        $sepetGuncellemeSorgusu = $db->prepare("UPDATE sepet SET urunAdedi=urunAdedi+1 WHERE id = ? AND uyeId = ? LIMIT 1");
        $sepetGuncellemeSorgusu->execute([$gelenId, $kullaniciId]);
        $sepetGuncellemeSayisi = $sepetGuncellemeSorgusu->rowCount();

        if($sepetGuncellemeSayisi > 0){
            header("Location: index.php?sayfaKodu=94");
            exit();
        }
        else{
            header("Location: index.php?sayfaKodu=94");
            exit();
        }
    }
    else{
        header("Location: index.php?sayfaKodu=94");
        exit();
    }
}
else{
    header("Location: index.php");
    exit();
}
?>