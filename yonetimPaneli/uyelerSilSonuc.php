<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }


    if (($gelenId != "")) {

        $uyeSilmeSorgusu = $db->prepare("UPDATE uyeler SET silinmeDurumu = ? WHERE id = ? LIMIT 1");
        $uyeSilmeSorgusu->execute([1, $gelenId]);
        $uyeSilmeKontrol = $uyeSilmeSorgusu->rowCount();

        if ($uyeSilmeKontrol > 0) {

            $sepetSilmeSorgusu        = $db->prepare("DELETE FROM sepet WHERE uyeId = ? LIMIT 1");
            $sepetSilmeSorgusu->execute([$gelenId]);

            $yorumlarSorgusu        = $db->prepare("SELECT * FROM yorumlar WHERE uyeId = ? LIMIT 1");
            $yorumlarSorgusu->execute([$gelenId]);
            $yorumlarSayisi         = $yorumlarSorgusu->rowCount();
            $yorumlarKayitlari      = $yorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);

            if ($yorumlarSayisi > 0) {

                foreach ($yorumlarKayitlari as $yorum) {

                    $yorumId                           = $yorum["id"];
                    $guncellenecekUrununIdsi           = $yorum["urunId"];
                    $guncellenecekUrununDusulecekPuani = $yorum["puan"];

                    $urunGuncellemeSorgusu = $db->prepare("UPDATE urunler SET yorumSayisi = yorumSayisi - 1, toplamYorumPuani = toplamYorumPuani - ? WHERE id = ? LIMIT 1");
                    $urunGuncellemeSorgusu->execute([$guncellenecekUrununDusulecekPuani, $guncellenecekUrununIdsi]);
                    $urunGuncellemeKontrol = $urunGuncellemeSorgusu->rowCount();

                    if ($urunGuncellemeKontrol < 1) {
                        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=86");
                        exit();
                    }

                    $yorumSilmeSorgusu        = $db->prepare("DELETE FROM yorumlar WHERE id = ? LIMIT 1");
                    $yorumSilmeSorgusu->execute([$yorumId]);
                    $yorumSilmeKontrol        = $yorumSilmeSorgusu->rowCount();

                    if ($yorumSilmeKontrol < 1) {
                        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=86");
                        exit();
                    }
                }
            }

            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=85");
            exit();
        } else {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=86");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=86");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
