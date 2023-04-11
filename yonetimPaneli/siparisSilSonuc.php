<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["siparisNo"])) {
        $gelenSiparisNo = guvenlik($_GET["siparisNo"]);
    } else {
        $gelenSiparisNo = "";
    }

    if ($gelenSiparisNo != "") {

        $siparislerSorgusu   = $db->prepare("SELECT * FROM siparisler WHERE siparisNumarasi = ?");
        $siparislerSorgusu->execute([$gelenSiparisNo]);
        $siparislerKayitlari = $siparislerSorgusu->fetchAll(PDO::FETCH_ASSOC);
        $siparislerKontrol   = $siparislerSorgusu->rowCount();

        if ($siparislerKontrol > 0) {

            foreach ($siparislerKayitlari as $siparisler) {
                $siparistekiId             = $siparisler["id"];
                $siparistekiUrununIdsi     = $siparisler["urunId"];
                $siparistekiUrununAdedi    = $siparisler["urunAdedi"];
                $siparistekiUrununVaryanti = $siparisler["varyantSecimi"];

                $siparisSilmeSorgusu = $db->prepare("DELETE FROM siparisler WHERE id = ? LIMIT 1");
                $siparisSilmeSorgusu->execute([$siparistekiId]);
                $siparisSilmeKontrol = $siparisSilmeSorgusu->rowCount();

                if ($siparisSilmeKontrol > 0) {

                    $urunGuncellemeSorgusu = $db->prepare("UPDATE urunler SET toplamSatisSayisi = toplamSatisSayisi + ? WHERE id = ? LIMIT 1");
                    $urunGuncellemeSorgusu->execute([$siparistekiUrununAdedi, $siparistekiUrununIdsi]);
                    $urunGuncellemeKontrol = $urunGuncellemeSorgusu->rowCount();

                    if ($urunGuncellemeKontrol > 0) {
                        $varyantGuncellemeSorgusu = $db->prepare("UPDATE urunvaryantlari SET stokAdedi = stokAdedi - ? WHERE varyantAdi = ? AND urunId = ? LIMIT 1");
                        $varyantGuncellemeSorgusu->execute([$siparistekiUrununAdedi, donusumleriGeriDondur($siparistekiUrununVaryanti), $siparistekiUrununIdsi]);
                        $varyantGuncellemeKontrol = $varyantGuncellemeSorgusu->rowCount();

                        if ($varyantGuncellemeKontrol < 1) {
                            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=115");
                            exit();
                        }
                    } else {
                        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=115");
                        exit();
                    }
                } else {
                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=115");
                    exit();
                }
            }

            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=114");
            exit();
        } else {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=115");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=115");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
