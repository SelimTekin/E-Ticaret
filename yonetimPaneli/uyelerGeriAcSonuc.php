<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }


    if (($gelenId != "")) {

        $uyeGeriAcSorgusu = $db->prepare("UPDATE uyeler SET silinmeDurumu = ? WHERE id = ? LIMIT 1");
        $uyeGeriAcSorgusu->execute([0, $gelenId]);
        $uyeGeriAcKontrol = $uyeGeriAcSorgusu->rowCount();

        if ($uyeGeriAcKontrol > 0) {

            

            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=88");
            exit();
        } else {
            // header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=89");
            echo "a";
            exit();
        }
    } else {
        // header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=89");
        echo "b";
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
