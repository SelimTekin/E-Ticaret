<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }


    if (($gelenId != "")) {

        $yorumlarSorgusu        = $db->prepare("SELECT * FROM yorumlar WHERE id = ? LIMIT 1");
        $yorumlarSorgusu->execute([$gelenId]);
        $yorumlarSayisi         = $yorumlarSorgusu->rowCount();
        $yorumlarKaydi          = $yorumlarSorgusu->fetch(PDO::FETCH_ASSOC);

        if($yorumlarSayisi > 0){
            $guncellenecekUrununIdsi           = $yorumlarKaydi["urunId"];
            $guncellenecekUrununDusulecekPuani = $yorumlarKaydi["puan"];

            $yorumSilmeSorgusu        = $db->prepare("DELETE FROM yorumlar WHERE id = ? LIMIT 1");
            $yorumSilmeSorgusu->execute([$gelenId]);
            $yorumSilmeKontrol        = $yorumSilmeSorgusu->rowCount();

            if ($yorumSilmeKontrol > 0) {

                $urunGuncellemeSorgusu = $db->prepare("UPDATE urunler SET yorumSayisi = yorumSayisi - 1, toplamYorumPuani = toplamYorumPuani - ? WHERE id = ? LIMIT 1");
                $urunGuncellemeSorgusu->execute([$guncellenecekUrununDusulecekPuani, $guncellenecekUrununIdsi]);
                $urunGuncellemeKontrol = $urunGuncellemeSorgusu->rowCount();

                if($urunGuncellemeKontrol > 0){
                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=92");
                    exit();
                }
                else{
                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=93");
                    exit();
                }

            }
            else{
                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=93");
                exit();
            }
        }
        else{
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=93");
            exit();
        }

    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=93");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
