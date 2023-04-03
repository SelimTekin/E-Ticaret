<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }


    if (($gelenId != "")) {

        $bannerSorgusu = $db->prepare("SELECT * FROM bannerlar WHERE id = ?");
        $bannerSorgusu->execute([$gelenId]);
        $bannerSayisi  = $bannerSorgusu->rowCount();
        $bannerKaydi   = $bannerSorgusu->fetch(PDO::FETCH_ASSOC);

        $silinecekDosyaYolu = "../resimler/" . $bannerKaydi["bannerResmi"];

        $bannerSilmeSorgusu = $db->prepare("DELETE FROM bannerlar WHERE id = ? LIMIT 1");
        $bannerSilmeSorgusu->execute([$gelenId]);
        $bannerSilmeSayisi  = $bannerSilmeSorgusu->rowCount();
        $bannerSilmeKaydi   = $bannerSilmeSorgusu->fetch(PDO::FETCH_ASSOC);

        if ($bannerSilmeSayisi > 0) {
            unlink($silinecekDosyaYolu); // banner resmini klasörden sildik

            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=43");
            exit();
        } else {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=44");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=44");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
