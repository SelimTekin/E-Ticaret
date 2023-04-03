<?php
if (isset($_SESSION["yonetici"])) {

    $gelenKargoFirmasiLogosu = $_FILES["kargoFirmasiLogosu"];

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }
    if (isset($_POST["kargoFirmasiAdi"])) {
        $gelenKargoFirmasiAdi = guvenlik($_POST["kargoFirmasiAdi"]);
    } else {
        $gelenKargoFirmasiAdi = "";
    }

    if (($gelenId != "") and ($gelenKargoFirmasiAdi != "")) {

        $kargoGuncellemeSorgusu = $db->prepare("UPDATE kargofirmalari SET kargoFirmasiAdi = ? WHERE id = ? LIMIT 1");
        $kargoGuncellemeSorgusu->execute([$gelenKargoFirmasiAdi, $gelenId]);
        $kargoGuncellemeKontrol = $kargoGuncellemeSorgusu->rowCount();

        if(($gelenKargoFirmasiLogosu["name"] != "") and ($gelenKargoFirmasiLogosu["full_path"] != "") and ($gelenKargoFirmasiLogosu["type"] != "") and ($gelenKargoFirmasiLogosu["error"] == 0) and ($gelenKargoFirmasiLogosu["size"] > 0)){
            $kargoResmiSorgusu = $db->prepare("SELECT * FROM kargofirmalari WHERE id = ? LIMIT 1");
            $kargoResmiSorgusu->execute([$gelenId]);
            $resimKontrol      = $kargoResmiSorgusu->rowCount();
            $resimBilgisi      = $kargoResmiSorgusu->fetch(PDO::FETCH_ASSOC);

            $silinecekDosyaYolu = "../resimler/" . $resimBilgisi["kargoFirmasiLogosu"];
            unlink($silinecekDosyaYolu);

            $resimIcinDosyaAdi = resimAdiOlustur();
            $gelenResminUzantisi = substr($gelenKargoFirmasiLogosu["name"], -4);
            if($gelenResminUzantisi == "jpeg"){
                $gelenResminUzantisi = "." . $gelenResminUzantisi;
            }
            $resimIcinYeniDosyaAdi = $resimIcinDosyaAdi . $gelenResminUzantisi;

            // $foo = new Upload($_FILES['form_field']); Upload undefined hatası veriyor o yüzden alt satırdakini kullandık.
            $kargoLogosuYukle = new \Verot\Upload\Upload($gelenKargoFirmasiLogosu, "tr-TR"); // Türkçe karakter sorunu yaşamamak için "tr-TR" yazdık
            if ($kargoLogosuYukle->uploaded) { // sınıfın uploaded özelliğini çağırdık ve yükleme yapılabilir mi kontrolü yaptık.
                // save uploaded image with no changes

                // $kargoLogosuYukle->image_convert  = 'jpeg'; // dosya türü ne gelirse gelsin(jpg, pdf, tif, zip...) jpeg yapar. Varsayılan jpg. BU KODU YAZMAZSAN PNG OLARAK KAYDEDER.
                // $kargoLogosuYukle->jpeg_quality = 100; // resmin kalitesini %100 yaptık(png olmuyor)
                $kargoLogosuYukle->image_resize = true; // boyutlandırma yaptık. belirttiğimiz değerin üzerinde boyuta ulaşırsa istediğimiz değere kırpar.
                $kargoLogosuYukle->image_ratio  = true; // resmin ölçülerini koru demek oluyor.
                $kargoLogosuYukle->image_y = 30;                // resim yüksekliği
                $kargoLogosuYukle->file_new_name_body = $resimIcinDosyaAdi; // resim dosyası logo olarak isimlendirildi
                $kargoLogosuYukle->mime_check = true;         // mime türünü kontrol ettik ettik. (Biz alt satırda image olmasını istedik mime türünün. Ama pdf, gif felan gelirse hata döndürür.)
                $kargoLogosuYukle->allowed = array('image/*');// Bütün resim dosyalarını kabul edebileceğini belirttik. image türünde her şey gelebilir (png, jpg, jpeg...)
                $kargoLogosuYukle->file_overwrite = true; // Yüklenecek dosya var olan dosyayla aynı ise üstüne yazar. (Yani yine de yenisini eskisiyle değiştirir.)
                $kargoLogosuYukle->image_background_color = "#FFFFFF"; // png transparan gelirse arka planı beyaz olsun
                // $kargoLogosuYukle->image_ratio_y = true; // if true, resize image, calculating image_y from image_x and conserving the original sizes ratio (default: false)

                $kargoLogosuYukle->process($verotIcinKlasorYolu);

                if ($kargoLogosuYukle->processed) {
                    
                    $kargoResmiGuncellemeSorgusu = $db->prepare("UPDATE kargofirmalari SET kargoFirmasiLogosu = ? WHERE id = ? LIMIT 1");
                    $kargoResmiGuncellemeSorgusu->execute([$resimIcinYeniDosyaAdi, $gelenId]);
                    $kargoResmiGuncellemeKontrol      = $kargoResmiGuncellemeSorgusu->rowCount();

                    if($kargoResmiGuncellemeKontrol < 1){
                        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=29");
                        exit();
                    }

                    $kargoLogosuYukle->clean();
                } else {
                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=29");
                    exit();
                }
            }

        }

        if(($kargoGuncellemeKontrol > 0) or $kargoResmiGuncellemeKontrol > 0){
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=28");
            exit();
        }
        else{
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=29");
            exit();
        }


    } else {
        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=29");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>