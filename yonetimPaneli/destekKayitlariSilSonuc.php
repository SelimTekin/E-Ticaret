<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }


    if (($gelenId != "")) {

        $icerikSilmeSorgusu = $db->prepare("DELETE FROM sorular WHERE id = ? LIMIT 1");
        $icerikSilmeSorgusu->execute([$gelenId]);
        $icerikSilmeSayisi  = $icerikSilmeSorgusu->rowCount();
        $icerikSilmeKaydi   = $icerikSilmeSorgusu->fetch(PDO::FETCH_ASSOC);

        if ($icerikSilmeSayisi > 0) {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=55");
            exit();
        } else {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=56");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=56");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
