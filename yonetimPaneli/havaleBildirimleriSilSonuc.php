<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }


    if (($gelenId != "")) {

        $bildirimSilmeSorgusu = $db->prepare("DELETE FROM havalebildirimleri WHERE id = ? LIMIT 1");
        $bildirimSilmeSorgusu->execute([$gelenId]);
        $bildirimSilmeSayisi  = $bildirimSilmeSorgusu->rowCount();

        if ($bildirimSilmeSayisi > 0) {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=118");
            exit();
        } else {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=119");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=119");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
