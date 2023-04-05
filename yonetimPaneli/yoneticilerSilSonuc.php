<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }


    if (($gelenId != "")) {

        $yoneticiSilmeSorgusu = $db->prepare("DELETE FROM yoneticiler WHERE id = ? AND kullaniciAdi != ? AND silinemeyecekYoneticiDurumu = ? LIMIT 1");
        $yoneticiSilmeSorgusu->execute([$gelenId, $yoneticiKullaniciAdi, 0]);
        $yoneticiSilmeSayisi  = $yoneticiSilmeSorgusu->rowCount();
        $yoneticiSilmeKaydi   = $yoneticiSilmeSorgusu->fetch(PDO::FETCH_ASSOC);

        if ($yoneticiSilmeSayisi > 0) {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=79");
            exit();
        } else {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=80");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=80");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
