<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }


    if (($gelenId != "")) {

        $kargoSorgusu = $db->prepare("SELECT * FROM kargofirmalari WHERE id = ?");
        $kargoSorgusu->execute([$gelenId]);
        $kargoSayisi  = $kargoSorgusu->rowCount();
        $kargoKaydi   = $kargoSorgusu->fetch(PDO::FETCH_ASSOC);

        $silinecekDosyaYolu = "../resimler/" . $kargoKaydi["bankaLogosu"];

        $kargoSilmeSorgusu = $db->prepare("DELETE FROM kargofirmalari WHERE id = ? LIMIT 1");
        $kargoSilmeSorgusu->execute([$gelenId]);
        $kargoSilmeSayisi  = $kargoSilmeSorgusu->rowCount();
        $kargoSilmeKaydi   = $kargoSilmeSorgusu->fetch(PDO::FETCH_ASSOC);

        if ($kargoSilmeSayisi > 0) {
            unlink($silinecekDosyaYolu); // banka logosunu klasörden sildik

            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=31");
            exit();
        } else {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=32");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=32");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
