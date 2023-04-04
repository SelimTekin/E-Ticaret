<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }
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

    if (($gelenId != "") and ($gelenSoru != "") and ($gelenCevap != "")) {

        $icerikGuncellemeSorgusu = $db->prepare("UPDATE sorular SET soru = ?, cevap = ? WHERE id = ? LIMIT 1");
        $icerikGuncellemeSorgusu->execute([$gelenSoru, $gelenCevap, $gelenId]);
        $icerikGuncellemeKontrol = $icerikGuncellemeSorgusu->rowCount();

        if($icerikGuncellemeKontrol > 0){
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=52");
            exit();
        }
        else{
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=53");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=53");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
