<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_POST["siteAdi"])) {
        $gelenSiteAdi = guvenlik($_POST["siteAdi"]);
    } else {
        $gelenSiteAdi = "";
    }
    if (isset($_POST["siteTitle"])) {
        $gelenSiteTitle = guvenlik($_POST["siteTitle"]);
    } else {
        $gelenSiteTitle = "";
    }
    if (isset($_POST["siteDescription"])) {
        $gelenSiteDescription = guvenlik($_POST["siteDescription"]);
    } else {
        $gelenSiteDescription = "";
    }
    if (isset($_POST["siteKeywords"])) {
        $gelenSiteKeywords = guvenlik($_POST["siteKeywords"]);
    } else {
        $gelenSiteKeywords = "";
    }
    if (isset($_POST["siteKeywords"])) {
        $gelenSiteKeywords = guvenlik($_POST["siteKeywords"]);
    } else {
        $gelenSiteKeywords = "";
    }
    if (isset($_POST["siteCopyrightMetni"])) {
        $gelenSiteCopyrightMetni = guvenlik($_POST["siteCopyrightMetni"]);
    } else {
        $gelenSiteCopyrightMetni = "";
    }
    if (isset($_POST["siteLinki"])) {
        $gelenSiteLinki = guvenlik($_POST["siteLinki"]);
    } else {
        $gelenSiteLinki = "";
    }
    if (isset($_POST["siteEmailAdresi"])) {
        $gelenSiteEmailAdresi = guvenlik($_POST["siteEmailAdresi"]);
    } else {
        $gelenSiteEmailAdresi = "";
    }
    if (isset($_POST["siteEmailSifresi"])) {
        $gelenSiteEmailSifresi = guvenlik($_POST["siteEmailSifresi"]);
    } else {
        $gelenSiteEmailSifresi = "";
    }
    if (isset($_POST["siteEmailHostAdresi"])) {
        $gelenSiteEmailHostAdresi = guvenlik($_POST["siteEmailHostAdresi"]);
    } else {
        $gelenSiteEmailHostAdresi = "";
    }
    if (isset($_POST["facebook"])) {
        $gelenFacebook = guvenlik($_POST["facebook"]);
    } else {
        $gelenFacebook = "";
    }
    if (isset($_POST["twitter"])) {
        $gelenTwitter = guvenlik($_POST["twitter"]);
    } else {
        $gelenTwitter = "";
    }
    if (isset($_POST["linkedin"])) {
        $gelenLinkedin = guvenlik($_POST["linkedin"]);
    } else {
        $gelenLinkedin = "";
    }
    if (isset($_POST["instagram"])) {
        $gelenInstagram = guvenlik($_POST["instagram"]);
    } else {
        $gelenInstagram = "";
    }
    if (isset($_POST["pinterest"])) {
        $gelenPinterest = guvenlik($_POST["pinterest"]);
    } else {
        $gelenPinterest = "";
    }
    if (isset($_POST["youtube"])) {
        $gelenYoutube = guvenlik($_POST["youtube"]);
    } else {
        $gelenYoutube = "";
    }
    if (isset($_POST["dolarKuru"])) {
        $gelenDolarKuru = guvenlik($_POST["dolarKuru"]);
    } else {
        $gelenDolarKuru = "";
    }
    if (isset($_POST["euroKuru"])) {
        $gelenEuroKuru = guvenlik($_POST["euroKuru"]);
    } else {
        $gelenEuroKuru = "";
    }
    if (isset($_POST["ucretsizKargoBaraji"])) {
        $gelenUcretsizKargoBaraji = guvenlik($_POST["ucretsizKargoBaraji"]);
    } else {
        $gelenUcretsizKargoBaraji = "";
    }
    if (isset($_POST["clientId"])) {
        $gelenClientId = guvenlik($_POST["clientId"]);
    } else {
        $gelenClientId = "";
    }
    if (isset($_POST["storeKey"])) {
        $gelenStoreKey = guvenlik($_POST["storeKey"]);
    } else {
        $gelenStoreKey = "";
    }
    if (isset($_POST["apiKullanicisi"])) {
        $gelenApiKullanicisi = guvenlik($_POST["apiKullanicisi"]);
    } else {
        $gelenApiKullanicisi = "";
    }
    if (isset($_POST["apiSifresi"])) {
        $gelenApiSifresi = guvenlik($_POST["apiSifresi"]);
    } else {
        $gelenApiSifresi = "";
    }

    $gelenSiteLogosu = $_FILES["siteLogosu"];

    if (($gelenSiteAdi != "") and ($gelenSiteTitle != "") and ($gelenSiteDescription != "") and ($gelenSiteKeywords != "") and ($gelenSiteCopyrightMetni != "") and ($gelenSiteLinki != "") and ($gelenLinkedin != "") and ($gelenSiteEmailSifresi != "") and ($gelenSiteEmailHostAdresi != "") and ($gelenFacebook != "") and ($gelenTwitter != "") and ($gelenInstagram != "") and ($gelenPinterest != "") and ($gelenYoutube != "") and ($gelenDolarKuru != "") and ($gelenEuroKuru != "") and ($gelenUcretsizKargoBaraji != "") and ($gelenClientId != "") and ($gelenStoreKey != "") and ($gelenApiKullanicisi != "") and ($gelenApiSifresi != "") and ($gelenSiteLogosu != "")) {

        $ayarlariGuncelle            = $db->prepare("UPDATE ayarlar SET siteAdi = ?, siteTitle = ?, siteDescription = ?, siteKeywords = ?, siteCopyrightMetni = ?, siteLinki = ?, siteEmailAdresi = ?, siteEmailSifresi = ?, siteEmailHostAdresi = ?, facebook = ?, twitter = ?, instagram = ?, pinterest = ?, youtube = ?, dolarKuru = ?, euroKuru = ?, ucretsizKargoBaraji = ?, clientId = ?, storeKey = ?, apiKullanicisi = ?, apiSifresi = ?");
        $ayarlariGuncelle->execute([$gelenSiteAdi, $gelenSiteTitle, $gelenSiteDescription, $gelenSiteKeywords, $gelenSiteCopyrightMetni, $gelenSiteLinki, $gelenLinkedin, $gelenSiteEmailSifresi, $gelenSiteEmailHostAdresi, $gelenFacebook, $gelenTwitter, $gelenInstagram, $gelenPinterest, $gelenYoutube, $gelenDolarKuru, $gelenEuroKuru, $gelenUcretsizKargoBaraji, $gelenClientId, $gelenStoreKey, $gelenApiKullanicisi, $gelenApiSifresi]);
        $guncellemeKontrolSayisi     = $ayarlariGuncelle->rowCount();

        if (($gelenSiteLogosu["name"] != "") and ($gelenSiteLogosu["full_path"] != "") and ($gelenSiteLogosu["type"] != "") and ($gelenSiteLogosu["error"] == 0) and ($gelenSiteLogosu["size"] > 0)) {

            // $foo = new Upload($_FILES['form_field']); Upload undefined hatası veriyor o yüzden alt satırdakini kullandık.
            $siteLogosuYukle = new \Verot\Upload\Upload($gelenSiteLogosu, "tr-TR"); // Türkçe karakter sorunu yaşamamak için "tr-TR" yazdık
            if ($siteLogosuYukle->uploaded) { // sınıfın uploaded özelliğini çağırdık ve yükleme yapılabilir mi kontrolü yaptık.
                // save uploaded image with no changes

                $siteLogosuYukle->image_convert  = 'png'; // dosya türü ne gelirse gelsin(jpg, pdf, tif, zip...) png yapar
                // $siteLogosuYukle->jpeg_quality = 100; // resmin kalitesini %100 yaptık(png olmuyor)
                $siteLogosuYukle->image_resize = true; // boyutlandırma yaptık. belirttiğimiz değerin üzerinde boyuta ulaşırsa istediğimiz değere kırpar.
                $siteLogosuYukle->image_x = 81;                // resim genişliği
                $siteLogosuYukle->image_y = 66;                // resim yüksekliği
                $siteLogosuYukle->file_new_name_body = 'logo'; // resim dosyası logo olarak isimlendirildi
                $siteLogosuYukle->mime_check = true;         // mime türünü kontrol ettik ettik. (Biz alt satırda image olmasını istedik mime türünün. Ama pdf, gif felan gelirse hata döndürür.)
                $siteLogosuYukle->allowed = array('image/*');// Bütün resim dosyalarını kabul edebileceğini belirttik. image türünde her şey gelebilir (png, jpg, jpeg...)
                $siteLogosuYukle->file_overwrite = true; // Yüklenecek dosya var olan dosyayla aynı ise üstüne yazar. (Yani yine de yenisini eskisiyle değiştirir.)
                $siteLogosuYukle->image_background_color = null; // png transparan gelirse arka planı boyamasın
                // $siteLogosuYukle->image_ratio_y = true; // if true, resize image, calculating image_y from image_x and conserving the original sizes ratio (default: false)

                $siteLogosuYukle->process($verotIcinKlasorYolu);

                if ($siteLogosuYukle->processed) { // yükleme işlemi gerçekleştiyse clean ile işlemi temizliyor
                    $siteLogosuYukle->clean();
                } else {
                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=4");
                    exit();
                }
            }
        }

        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=3");
        exit();

    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=4");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>