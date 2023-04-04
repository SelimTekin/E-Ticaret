<?php
if (isset($_SESSION["yonetici"])) {
    
    if (isset($_POST["soru"])) {
        $gelenSoru = guvenlik($_POST["soru"]);
    } else {
        $gelenSoru = "";
    }

    if (isset($_POST["cevap"])) {
        $gelenCevap = guvenlik($_POST["cevap"]);
    } else {
        $gelenCevap = "";
    }

    if (($gelenSoru != "") and ($gelenCevap != "")) {

        $icerikEklemeSorgusu = $db->prepare("INSERT INTO sorular (soru, cevap) VALUES (?, ?)");
        $icerikEklemeSorgusu->execute([$gelenSoru, $gelenCevap]);
        $icerikEklemeKontrol = $icerikEklemeSorgusu->rowCount();

        if($icerikEklemeKontrol > 0){
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=48");
            exit();
        }
        else{
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=49");
            exit();
        }

    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=49");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>