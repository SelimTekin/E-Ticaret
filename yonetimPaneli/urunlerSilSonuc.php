<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }


    if (($gelenId != "")) {

        $urunlerSorgusu        = $db->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
        $urunlerSorgusu->execute([$gelenId]);
        $urunlerSorgusuKontrol = $urunlerSorgusu->rowCount();
        $urunlerSorgusuKaydi   = $urunlerSorgusu->fetch(PDO::FETCH_ASSOC);

        if ($urunlerSorgusuKontrol > 0) {

            $silinecekUrununMenuIdsi = $urunlerSorgusuKaydi["menuId"];

            $urunSilmeSorgusu = $db->prepare("UPDATE urunler SET durumu = ? WHERE id = ? LIMIT 1");
            $urunSilmeSorgusu->execute([0, $gelenId]);
            $urunSilmeKontrol = $urunSilmeSorgusu->rowCount();

            if ($urunSilmeKontrol > 0) {

                $sepetSilmeSorgusu        = $db->prepare("DELETE FROM sepet WHERE urunId = ?");
                $sepetSilmeSorgusu->execute([$gelenId]);

                $favorilerSilmeSorgusu        = $db->prepare("DELETE FROM favoriler WHERE urunId = ?");
                $favorilerSilmeSorgusu->execute([$gelenId]);

                $menuGuncellemeSorgusu        = $db->prepare("UPDATE menuler SET urunSayisi = urunSayisi - 1 WHERE id = ?");
                $menuGuncellemeSorgusu->execute([$silinecekUrununMenuIdsi]);

                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=104");
                exit();
            } else {
                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=105");
                exit();
            }
        } else {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=105");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=105");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
