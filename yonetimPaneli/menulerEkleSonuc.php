<?php
if (isset($_SESSION["yonetici"])) {
    
    if (isset($_POST["urunTuru"])) {
        $gelenUrunTuru = guvenlik($_POST["urunTuru"]);
    } else {
        $gelenUrunTuru = "";
    }

    if (isset($_POST["menuAdi"])) {
        $gelenMenuAdi = guvenlik($_POST["menuAdi"]);
    } else {
        $gelenMenuAdi = "";
    }

    if (($gelenUrunTuru != "") and ($gelenMenuAdi != "")) {

        $menuEklemeSorgusu = $db->prepare("INSERT INTO menuler (urunTuru, menuAdi) VALUES (?, ?)");
        $menuEklemeSorgusu->execute([$gelenUrunTuru, $gelenMenuAdi]);
        $menuEklemeKontrol = $menuEklemeSorgusu->rowCount();

        if($menuEklemeKontrol > 0){
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=60");
            exit();
        }
        else{
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=61");
            exit();
        }

    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=61");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>