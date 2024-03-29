<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }


    if (($gelenId != "")) {

        $menuSilmeSorgusu = $db->prepare("DELETE FROM menuler WHERE id = ? LIMIT 1");
        $menuSilmeSorgusu->execute([$gelenId]);
        $menuSilmeKontrol = $menuSilmeSorgusu->rowCount();

        if ($menuSilmeKontrol > 0) {

            $urunlerSorgusu        = $db->prepare("SELECT * FROM urunler WHERE menuId = ? LIMIT 1");
            $urunlerSorgusu->execute([$gelenId]);
            $urunlerSorgusuKontrol = $urunlerSorgusu->rowCount();
            $urunlerKayitlari      = $urunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

            if($urunlerSorgusuKontrol > 0){

                foreach($urunlerKayitlari as $urunKaydi){

                    $silinecekUrununIdsi = $urunKaydi["id"];

                    $urunlerGuncellemeSorgusu = $db->prepare("UPDATE urunler SET durumu = ? WHERE id = ? AND menuId = ? LIMIT 1");
                    $urunlerGuncellemeSorgusu->execute([0, $silinecekUrununIdsi, $gelenId]);
    
                    $sepetSilmeSorgusu        = $db->prepare("DELETE FROM sepet WHERE urunId = ?");
                    $sepetSilmeSorgusu->execute([$silinecekUrununIdsi]);
    
                    $favorilerSilmeSorgusu        = $db->prepare("DELETE FROM favoriler WHERE urunId = ?");
                    $favorilerSilmeSorgusu->execute([$silinecekUrununIdsi]);
                }

            }

            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=67");
            exit();
        } else {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=68");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=68");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
