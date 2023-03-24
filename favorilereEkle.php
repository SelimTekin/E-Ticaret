<?php
if($_SESSION["kullanici"]){
    if(isset($_GET["id"])){
        $gelenId = $_GET["id"];
    }
    else{
        $gelenId = "";
    }

    if($gelenId != ""){

        $favoriKontrolSorgusu = $db->prepare("SELECT * FROM favoriler WHERE urunId = ? AND uyeId = ? LIMIT 1");
        $favoriKontrolSorgusu->execute([$gelenId, $kullaniciId]);
        $favoriKontrolSayisi  = $favoriKontrolSorgusu->rowCount();

        if($favoriKontrolSayisi > 0){
            header("Location: index.php?sayfaKodu=90");
            exit();
        }
        else{
            $favoriEklemeSorgusu = $db->prepare("INSERT INTO favoriler (urunId, uyeId) VALUES (?, ?)");
            $favoriEklemeSorgusu->execute([$gelenId, $kullaniciId]);
            $favoriEklemeSayisi  = $favoriEklemeSorgusu->rowCount();
    
            if($favoriEklemeSayisi > 0){
                header("Location: index.php?sayfaKodu=88");
                exit();
            }
            else{
                header("Location: index.php?sayfaKodu=89");
                exit();
            }
        }

    }
    else{
        header("Location: index.php");
        exit();
    }
}
else{
    header("Location: index.php");
    exit();
}
?>