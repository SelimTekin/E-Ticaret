<?php
if (isset($_SESSION["yonetici"])) {
    
    if (isset($_POST["bannerAlani"])) {
        $gelenBannerAlani = guvenlik($_POST["bannerAlani"]);
    } else {
        $gelenBannerAlani = "";
    }

    $gelenBannerResmi = $_FILES["bannerResmi"];

    if (isset($_POST["bannerAdi"])) {
        $gelenBannerAdi = guvenlik($_POST["bannerAdi"]);
    } else {
        $gelenBannerAdi = "";
    }

    if (($gelenBannerAlani != "") and ($gelenBannerResmi["name"] != "") and ($gelenBannerResmi["full_path"] != "") and ($gelenBannerResmi["type"] != "") and ($gelenBannerResmi["error"] == 0) and ($gelenBannerResmi["size"] > 0) and ($gelenBannerAdi != "")) {

        $resimIcinDosyaAdi = resimAdiOlustur();
        $gelenResminUzantisi = substr($gelenBannerResmi["name"], -4);
        if($gelenResminUzantisi == "jpeg"){
            $gelenResminUzantisi = "." . $gelenResminUzantisi;
        }
        $resimIcinYeniDosyaAdi = $resimIcinDosyaAdi . $gelenResminUzantisi;

        $bannerEklemeSorgusu = $db->prepare("INSERT INTO bannerlar (bannerAlani, bannerAdi, bannerResmi) VALUES (?, ?, ?)");
        $bannerEklemeSorgusu->execute([$gelenBannerAlani, $gelenBannerAdi, $resimIcinYeniDosyaAdi]);
        $bannerEklemeKontrol = $bannerEklemeSorgusu->rowCount();

        if($bannerEklemeKontrol > 0){
            if($gelenBannerAlani == "Ana Sayfa"){
                $resimGenislikOlcusu = 1065;
                $resimYukseklikOlcusu = 140;
            }elseif($gelenBannerAlani == "Menu Altı"){
                $resimGenislikOlcusu = 250;
                $resimYukseklikOlcusu = 500;
            }elseif($gelenBannerAlani == "Ürün Detay"){
                $resimGenislikOlcusu = 250;
                $resimYukseklikOlcusu = 500;
            }
            $bannerLogosuYukle = new \Verot\Upload\Upload($gelenBannerResmi, "tr-TR");
            if ($bannerLogosuYukle->uploaded) {

                // $bannerLogosuYukle->image_convert  = 'jpeg'; // dosya türü ne gelirse gelsin(jpg, pdf, tif, zip...) jpeg yapar. Varsayılan jpg. BU KODU YAZMAZSAN PNG OLARAK KAYDEDER.
                $bannerLogosuYukle->image_resize = true; // çalışmıyor
                $bannerLogosuYukle->image_y = $resimYukseklikOlcusu; // çalışmıyor
                $bannerLogosuYukle->image_x = $resimGenislikOlcusu; // çalışmıyor
                $bannerLogosuYukle->file_new_name_body = $resimIcinDosyaAdi;
                $bannerLogosuYukle->mime_check = true;
                $bannerLogosuYukle->allowed = array('image/*');
                $bannerLogosuYukle->file_overwrite = true;
                $bannerLogosuYukle->image_background_color = "#FFFFFF";

                $bannerLogosuYukle->process($verotIcinKlasorYolu);

                if ($bannerLogosuYukle->processed) { // yükleme işlemi gerçekleştiyse clean ile işlemi temizliyor
                    $bannerLogosuYukle->clean();
                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=36");
                    exit();
                } else {
                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=37");
                    exit();
                }
            }
        }
        else{
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=37");
            exit();
        }

    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=37");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>