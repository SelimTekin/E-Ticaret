<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["siparisNo"])) {
        $gelenSiparisNo = guvenlik($_GET["siparisNo"]);
    } else {
        $gelenSiparisNo = "";
    }
    if (isset($_POST["gonderiKodu"])) {
        $gelenGonderiKodu = guvenlik($_POST["gonderiKodu"]);
    } else {
        $gelenGonderiKodu = "";
    }

    if (($gelenSiparisNo != "") and ($gelenGonderiKodu != "")) {

        $siparisGuncellemeSorgusu = $db->prepare("UPDATE siparisler SET onayDurumu = ?, kargoDurumu = ?, kargoGonderiKodu = ? WHERE siparisNumarasi = ?");
        $siparisGuncellemeSorgusu->execute([1, 1, $gelenGonderiKodu, $gelenSiparisNo]);
        $siparisGuncellemeKontrol = $siparisGuncellemeSorgusu->rowCount();

        if($siparisGuncellemeKontrol > 0){
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=111");
            exit();
        }
        else{
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=112");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=112");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
