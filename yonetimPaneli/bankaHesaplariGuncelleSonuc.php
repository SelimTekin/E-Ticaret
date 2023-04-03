<?php
if (isset($_SESSION["yonetici"])) {

    $gelenBankaLogosu = $_FILES["bankaLogosu"];

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }
    if (isset($_POST["bankaAdi"])) {
        $gelenBankaAdi = guvenlik($_POST["bankaAdi"]);
    } else {
        $gelenBankaAdi = "";
    }
    if (isset($_POST["subeAdi"])) {
        $gelenSubeAdi = guvenlik($_POST["subeAdi"]);
    } else {
        $gelenSubeAdi = "";
    }
    if (isset($_POST["subeKodu"])) {
        $gelenSubekodu = guvenlik($_POST["subeKodu"]);
    } else {
        $gelenSubekodu = "";
    }
    if (isset($_POST["konumSehir"])) {
        $gelenKonumSehir = guvenlik($_POST["konumSehir"]);
    } else {
        $gelenKonumSehir = "";
    }
    if (isset($_POST["konumUlke"])) {
        $gelenKonumUlke = guvenlik($_POST["konumUlke"]);
    } else {
        $gelenKonumUlke = "";
    }
    if (isset($_POST["paraBirimi"])) {
        $gelenParaBirimi = guvenlik($_POST["paraBirimi"]);
    } else {
        $gelenParaBirimi = "";
    }
    if (isset($_POST["hesapSahibi"])) {
        $gelenHesapSahibi = guvenlik($_POST["hesapSahibi"]);
    } else {
        $gelenHesapSahibi = "";
    }
    if (isset($_POST["hesapNumarasi"])) {
        $gelenHesapNumarasi = guvenlik($_POST["hesapNumarasi"]);
    } else {
        $gelenHesapNumarasi = "";
    }
    if (isset($_POST["ibanNumarasi"])) {
        $gelenIbanNumarasi = guvenlik($_POST["ibanNumarasi"]);
    } else {
        $gelenIbanNumarasi = "";
    }
    

    if (($gelenBankaAdi != "") and ($gelenSubeAdi != "") and ($gelenSubekodu != "") and ($gelenKonumSehir != "") and ($gelenKonumUlke != "") and ($gelenParaBirimi != "") and ($gelenHesapSahibi != "") and ($gelenHesapNumarasi != "") and ($gelenIbanNumarasi != "")) {

        $hesapGuncellemeSorgusu = $db->prepare("UPDATE bankahesaplarimiz SET bankaAdi = ?, konumSehir = ?, konumUlke = ?, subeAdi = ?, subeKodu = ?, paraBirimi = ?, hesapSahibi = ?, hesapNumarasi = ?, ibanNumarasi = ? WHERE id = ? LIMIT 1");
        $hesapGuncellemeSorgusu->execute([$gelenBankaAdi, $gelenKonumSehir, $gelenKonumUlke, $gelenSubeAdi, $gelenSubekodu, $gelenParaBirimi, $gelenHesapSahibi, $gelenHesapNumarasi, $gelenIbanNumarasi, $gelenId]);
        $hesapGuncellemeKontrol = $hesapGuncellemeSorgusu->rowCount();

        if(($gelenBankaLogosu["name"] != "") and ($gelenBankaLogosu["full_path"] != "") and ($gelenBankaLogosu["type"] != "") and ($gelenBankaLogosu["error"] == 0) and ($gelenBankaLogosu["size"] > 0)){
            $bankaResmiSorgusu = $db->prepare("SELECT * FROM bankahesaplarimiz WHERE id = ? LIMIT 1");
            $bankaResmiSorgusu->execute([$gelenId]);
            $resimKontrol      = $bankaResmiSorgusu->rowCount();
            $resimBilgisi      = $bankaResmiSorgusu->fetch(PDO::FETCH_ASSOC);

            $silinecekDosyaYolu = "../resimler/" . $resimBilgisi["bankaLogosu"];
            unlink($silinecekDosyaYolu);

            $resimIcinDosyaAdi = resimAdiOlustur();
            $gelenResminUzantisi = substr($gelenBankaLogosu["name"], -4);
            if($gelenResminUzantisi == "jpeg"){
                $gelenResminUzantisi = "." . $gelenResminUzantisi;
            }
            $resimIcinYeniDosyaAdi = $resimIcinDosyaAdi . $gelenResminUzantisi;

            // $foo = new Upload($_FILES['form_field']); Upload undefined hatası veriyor o yüzden alt satırdakini kullandık.
            $bankaLogosuYukle = new \Verot\Upload\Upload($gelenBankaLogosu, "tr-TR"); // Türkçe karakter sorunu yaşamamak için "tr-TR" yazdık
            if ($bankaLogosuYukle->uploaded) { // sınıfın uploaded özelliğini çağırdık ve yükleme yapılabilir mi kontrolü yaptık.
                // save uploaded image with no changes

                // $bankaLogosuYukle->image_convert  = 'png'; // dosya türü ne gelirse gelsin(jpg, pdf, tif, zip...) png yapar
                // $bankaLogosuYukle->jpeg_quality = 100; // resmin kalitesini %100 yaptık(png olmuyor)
                $bankaLogosuYukle->image_resize = true; // boyutlandırma yaptık. belirttiğimiz değerin üzerinde boyuta ulaşırsa istediğimiz değere kırpar.
                $bankaLogosuYukle->image_ratio  = true; // resmin ölçülerini koru demek oluyor.
                $bankaLogosuYukle->image_y = 30;                // resim yüksekliği
                $bankaLogosuYukle->file_new_name_body = $resimIcinDosyaAdi; // resim dosyası logo olarak isimlendirildi
                $bankaLogosuYukle->mime_check = true;         // mime türünü kontrol ettik ettik. (Biz alt satırda image olmasını istedik mime türünün. Ama pdf, gif felan gelirse hata döndürür.)
                $bankaLogosuYukle->allowed = array('image/*');// Bütün resim dosyalarını kabul edebileceğini belirttik. image türünde her şey gelebilir (png, jpg, jpeg...)
                $bankaLogosuYukle->file_overwrite = true; // Yüklenecek dosya var olan dosyayla aynı ise üstüne yazar. (Yani yine de yenisini eskisiyle değiştirir.)
                $bankaLogosuYukle->image_background_color = "#FFFFFF"; // png transparan gelirse arka planı beyaz olsun
                // $bankaLogosuYukle->image_ratio_y = true; // if true, resize image, calculating image_y from image_x and conserving the original sizes ratio (default: false)

                $bankaLogosuYukle->process($verotIcinKlasorYolu);

                if ($bankaLogosuYukle->processed) {
                    
                    $hesapResmiGuncellemeSorgusu = $db->prepare("UPDATE bankahesaplarimiz SET bankaLogosu = ? WHERE id = ? LIMIT 1");
                    $hesapResmiGuncellemeSorgusu->execute([$resimIcinYeniDosyaAdi, $gelenId]);
                    $hesapResmiGuncellemeKontrol      = $hesapResmiGuncellemeSorgusu->rowCount();

                    if($hesapResmiGuncellemeKontrol < 1){
                        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=17");
                        exit();
                    }

                    $bankaLogosuYukle->clean();
                } else {
                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=17");
                    exit();
                }
            }

        }

        if(($hesapGuncellemeKontrol > 0) or $hesapResmiGuncellemeKontrol > 0){
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=16");
            exit();
        }
        else{
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=17");
            exit();
        }


    } else {
        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=17");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>