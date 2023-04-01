<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }
    

    if (($gelenId != "")) {

        $havaleBildirimleriSorgusu = $db->prepare("SELECT * FROM havalebildirimleri WHERE bankaId = ?");
        $havaleBildirimleriSorgusu->execute([$gelenId]);
        $bildirimSayisi            = $havaleBildirimleriSorgusu->rowCount();

        if($bildirimSayisi > 0){  // Havale bilidirimi varsa banka kaydı silinmesin hata sayfasına yönlendirsin ki kontrol edelim havale bildirimlerini
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=20");
            exit();
        }
        else{
            $hesapSorgusu = $db->prepare("SELECT * FROM bankahesaplarimiz WHERE id = ?");
            $hesapSorgusu->execute([$gelenId]);
            $hesapSayisi  = $hesapSorgusu->rowCount();
            $hesapKaydi   = $hesapSorgusu->fetch(PDO::FETCH_ASSOC);
    
            $silinecekDosyaYolu = "../resimler/".$hesapKaydi["bankaLogosu"];
    
            $hesapSilmeSorgusu = $db->prepare("DELETE FROM bankahesaplarimiz WHERE id = ? LIMIT 1");
            $hesapSilmeSorgusu->execute([$gelenId]);
            $hesapSilmeSayisi  = $hesapSilmeSorgusu->rowCount();
            $hesapSilmeKaydi   = $hesapSilmeSorgusu->fetch(PDO::FETCH_ASSOC);
    
            if($hesapSilmeSayisi > 0){
                unlink($silinecekDosyaYolu); // banka logosunu klasörden sildik
    
                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=19");
                exit();
            }
            else{
                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=20");
                exit();
            }
        }

    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=20");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>