<?php
if (isset($_SESSION["kullanici"])) {
    if (isset($_GET["id"])) {
        $gelenId = $_GET["id"];
    } else {
        $gelenId = "";
    }

    if (isset($_POST["varyant"])) {
        $gelenVaryantId = $_POST["varyant"];
    } else {
        $gelenVaryantId = "";
    }

    if (($gelenId != "") and ($gelenVaryantId != "")) {


        $kullanicininSepetKontrolSorgusu = $db->prepare("SELECT * FROM sepet WHERE uyeId = ? ORDER BY id DESC LIMIT 1");
        $kullanicininSepetKontrolSorgusu->execute([$kullaniciId]);
        $kullanicininSepetSayisi  = $kullanicininSepetKontrolSorgusu->rowCount();

        if ($kullanicininSepetSayisi  > 0) {

            $urunSepetKontrolSorgusu = $db->prepare("SELECT * FROM sepet WHERE uyeId = ? AND urunId = ? AND varyantId = ? LIMIT 1");
            $urunSepetKontrolSorgusu->execute([$kullaniciId, $gelenId, $gelenVaryantId]);
            $urunSepeteSayisi        = $urunSepetKontrolSorgusu->rowCount();
            $urunSepetKaydi          = $urunSepetKontrolSorgusu->fetch(PDO::FETCH_ASSOC);

            if ($urunSepeteSayisi > 0) {
                $urununIdsi                 = $urunSepetKaydi["id"];
                $urununSepettekiMevcutAdedi = $urunSepetKaydi["urunAdedi"];
                $urununYeniAdedi            = $urununSepettekiMevcutAdedi + 1;

                $urunGuncellemeSorgusu = $db->prepare("UPDATE sepet SET urunAdedi = ? WHERE id = ? AND uyeId = ? AND urunId = ? LIMIT 1");
                $urunGuncellemeSorgusu->execute([$urununYeniAdedi, $urununIdsi, $kullaniciId, $gelenId]);
                $urunGuncellemeSayisi  = $urunGuncellemeSorgusu->rowCount();

                if ($urunGuncellemeSayisi > 0) {
                    header("Location: index.php?sayfaKodu=94");
                    exit();
                } else {
                    header("Location: index.php?sayfaKodu=92");
                    exit();
                }
            } else {
                $urunEklemeSorgusu = $db->prepare("INSERT INTO sepet (uyeId, urunId, varyantId, urunAdedi) VALUES (?, ?, ?, ?)");
                $urunEklemeSorgusu->execute([$kullaniciId, $gelenId, $gelenVaryantId, 1]);
                $urunEklemeSayisi = $urunEklemeSorgusu->rowCount();
                $sonIdDegeri      = $db->lastInsertId();

                if ($urunEklemeSayisi > 0) {
                    $siparisNumarasiniGuncelleSorgusu = $db->prepare("UPDATE sepet SET sepetNumarasi = ? WHERE uyeId = ?");
                    $siparisNumarasiniGuncelleSorgusu->execute([$sonIdDegeri, $kullaniciId]);
                    $siparisNumarasiniGuncelleSayisi  = $siparisNumarasiniGuncelleSorgusu->rowCount();

                    if ($siparisNumarasiniGuncelleSayisi > 0) {
                        header("Location: index.php?sayfaKodu=94");
                        exit();
                    } else {
                        header("Location: index.php?sayfaKodu=92");
                        exit();
                    }
                } else {
                    header("Location: index.php?sayfaKodu=92");
                    exit();
                }
            }
        } else {
            $urunEklemeSorgusu = $db->prepare("INSERT INTO sepet (uyeId, urunId, varyantId, urunAdedi) VALUES (?, ?, ?, ?)");
            $urunEklemeSorgusu->execute([$kullaniciId, $gelenId, $gelenVaryantId, 1]);
            $urunEklemeSayisi = $urunEklemeSorgusu->rowCount();
            $sonIdDegeri      = $db->lastInsertId();

            if ($urunEklemeSayisi > 0) {
                $siparisNumarasiniGuncelleSorgusu = $db->prepare("UPDATE sepet SET sepetNumarasi = ? WHERE uyeId = ?");
                $siparisNumarasiniGuncelleSorgusu->execute([$sonIdDegeri, $kullaniciId]);
                $siparisNumarasiniGuncelleSayisi  = $siparisNumarasiniGuncelleSorgusu->rowCount();

                if ($siparisNumarasiniGuncelleSayisi > 0) {
                    header("Location: index.php?sayfaKodu=94");
                    exit();
                } else {
                    header("Location: index.php?sayfaKodu=92");
                    exit();
                }
            } else {
                header("Location: index.php?sayfaKodu=92");
                exit();
            }
        }
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php?sayfaKodu=93");
    exit();
}
