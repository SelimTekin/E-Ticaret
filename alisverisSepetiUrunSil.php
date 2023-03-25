<?php
if(isset($_SESSION["kullanici"])){
    if(isset($_GET["id"])){
        $gelenId = $_GET["id"];
    }
    else{
        $gelenId = "";
    }

    if($gelenId != ""){

        $sepetSilSorgusu = $db->prepare("DELETE FROM sepet WHERE id = ? AND uyeId = ? LIMIT 1");
        $sepetSilSorgusu->execute([$gelenId, $kullaniciId]);
        $sepetSilSayisi = $sepetSilSorgusu->rowCount();

        if($sepetSilSayisi > 0){
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