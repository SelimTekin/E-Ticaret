<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }
    if (isset($_POST["menuAdi"])) {
        $gelenMenuAdi = guvenlik($_POST["menuAdi"]);
    } else {
        $gelenMenuAdi = "";
    }

    if (($gelenId != "") and ($gelenMenuAdi != "")) {

        $menuGuncellemeSorgusu = $db->prepare("UPDATE menuler SET menuAdi = ? WHERE id = ? LIMIT 1");
        $menuGuncellemeSorgusu->execute([$gelenMenuAdi, $gelenId]);
        $menuGuncellemeKontrol = $menuGuncellemeSorgusu->rowCount();

        if($menuGuncellemeKontrol > 0){
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=64");
            exit();
        }
        else{
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=65");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=65");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
