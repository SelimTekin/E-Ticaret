<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }
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

    if (($gelenId != "") and ($gelenBannerAlani != "") and ($gelenBannerAdi != "")) {

        $bannerResmiSorgusu = $db->prepare("SELECT * FROM bannerlar WHERE id = ? LIMIT 1");
        $bannerResmiSorgusu->execute([$gelenId]);
        $bannerKontrol      = $bannerResmiSorgusu->rowCount();
        $bannerBilgisi      = $bannerResmiSorgusu->fetch(PDO::FETCH_ASSOC);

        if ($gelenBannerAlani == $bannerBilgisi["bannerAlani"]) {
            $bannerGuncellemeSorgusu = $db->prepare("UPDATE bannerlar SET bannerAlani = ?, bannerAdi = ? WHERE id = ? LIMIT 1");
            $bannerGuncellemeSorgusu->execute([$gelenBannerAlani, $gelenBannerAdi, $gelenId]);
            $bannerGuncellemeKontrol = $bannerGuncellemeSorgusu->rowCount();

            if (($gelenBannerResmi["name"] != "") and ($gelenBannerResmi["full_path"] != "") and ($gelenBannerResmi["type"] != "") and ($gelenBannerResmi["error"] == 0) and ($gelenBannerResmi["size"] > 0)) {

                $silinecekDosyaYolu = "../resimler/" . $bannerBilgisi["bannerResmi"];
                unlink($silinecekDosyaYolu);

                $resimIcinDosyaAdi = resimAdiOlustur();
                $gelenResminUzantisi = substr($gelenBannerResmi["name"], -4);
                if ($gelenResminUzantisi == "jpeg") {
                    $gelenResminUzantisi = "." . $gelenResminUzantisi;
                }
                $resimIcinYeniDosyaAdi = $resimIcinDosyaAdi . $gelenResminUzantisi;

                if ($gelenBannerAlani == "Ana Sayfa") {
                    $resimGenislikOlcusu = 1065;
                    $resimYukseklikOlcusu = 140;
                } elseif ($gelenBannerAlani == "Menu Altı") {
                    $resimGenislikOlcusu = 250;
                    $resimYukseklikOlcusu = 500;
                } elseif ($gelenBannerAlani == "Ürün Detay") {
                    $resimGenislikOlcusu = 250;
                    $resimYukseklikOlcusu = 500;
                }

                // $foo = new Upload($_FILES['form_field']); Upload undefined hatası veriyor o yüzden alt satırdakini kullandık.
                $bannerYukle = new \Verot\Upload\Upload($gelenBannerResmi, "tr-TR"); // Türkçe karakter sorunu yaşamamak için "tr-TR" yazdık
                if ($bannerYukle->uploaded) { // sınıfın uploaded özelliğini çağırdık ve yükleme yapılabilir mi kontrolü yaptık.
                    // save uploaded image with no changes

                    // $bannerYukle->image_convert  = 'jpeg';                 // dosya türü ne gelirse gelsin(jpg, pdf, tif, zip...) jpeg yapar. Varsayılan jpg. BU KODU YAZMAZSAN PNG OLARAK KAYDEDER.
                    // $bannerYukle->jpeg_quality = 100;                      // resmin kalitesini %100 yaptık(png olmuyor)
                    $bannerYukle->image_resize = true;                        // boyutlandırma yaptık. belirttiğimiz değerin üzerinde boyuta ulaşırsa istediğimiz değere kırpar.
                    $bannerYukle->image_x = $resimGenislikOlcusu;             // resim genişliği
                    $bannerYukle->image_y = $resimYukseklikOlcusu;            // resim yüksekliği
                    $bannerYukle->file_new_name_body = $resimIcinDosyaAdi;    // resim dosyası logo olarak isimlendirildi
                    $bannerYukle->mime_check = true;                          // mime türünü kontrol ettik ettik. (Biz alt satırda image olmasını istedik mime türünün. Ama pdf, gif felan gelirse hata döndürür.)
                    $bannerYukle->allowed = array('image/*');                 // Bütün resim dosyalarını kabul edebileceğini belirttik. image türünde her şey gelebilir (png, jpg, jpeg...)
                    $bannerYukle->file_overwrite = true;                      // Yüklenecek dosya var olan dosyayla aynı ise üstüne yazar. (Yani yine de yenisini eskisiyle değiştirir.)
                    $bannerYukle->image_background_color = "#FFFFFF";         // png transparan gelirse arka planı beyaz olsun
                    // $bannerYukle->image_ratio_y = true;                    // if true, resize image, calculating image_y from image_x and conserving the original sizes ratio (default: false)

                    $bannerYukle->process($verotIcinKlasorYolu);

                    if ($bannerYukle->processed) {

                        $bannerResmiGuncellemeSorgusu = $db->prepare("UPDATE bannerlar SET bannerResmi = ? WHERE id = ? LIMIT 1");
                        $bannerResmiGuncellemeSorgusu->execute([$resimIcinYeniDosyaAdi, $gelenId]);
                        $bannerResmiGuncellemeKontrol      = $bannerResmiGuncellemeSorgusu->rowCount();

                        if ($bannerResmiGuncellemeKontrol < 1) {
                            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=41");
                            exit();
                        }

                        $bannerYukle->clean();
                    } else {
                        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=41");
                        exit();
                    }
                }
            }

            if (($bannerGuncellemeKontrol > 0) or $bannerResmiGuncellemeKontrol > 0) {
                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=40");
                exit();
            } else {
                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=41");
                exit();
            }
        } else {
            if (($gelenBannerResmi["name"] != "") and ($gelenBannerResmi["full_path"] != "") and ($gelenBannerResmi["type"] != "") and ($gelenBannerResmi["error"] == 0) and ($gelenBannerResmi["size"] > 0)) {

                $silinecekDosyaYolu = "../resimler/" . $bannerBilgisi["bannerResmi"];
                unlink($silinecekDosyaYolu);

                $resimIcinDosyaAdi = resimAdiOlustur();
                $gelenResminUzantisi = substr($gelenBannerResmi["name"], -4);
                if ($gelenResminUzantisi == "jpeg") {
                    $gelenResminUzantisi = "." . $gelenResminUzantisi;
                }
                $resimIcinYeniDosyaAdi = $resimIcinDosyaAdi . $gelenResminUzantisi;

                if ($gelenBannerAlani == "Ana Sayfa") {
                    $resimGenislikOlcusu = 1065;
                    $resimYukseklikOlcusu = 140;
                } elseif ($gelenBannerAlani == "Menu Altı") {
                    $resimGenislikOlcusu = 250;
                    $resimYukseklikOlcusu = 500;
                } elseif ($gelenBannerAlani == "Ürün Detay") {
                    $resimGenislikOlcusu = 250;
                    $resimYukseklikOlcusu = 500;
                }

                // $foo = new Upload($_FILES['form_field']); Upload undefined hatası veriyor o yüzden alt satırdakini kullandık.
                $bannerYukle = new \Verot\Upload\Upload($gelenBannerResmi, "tr-TR"); // Türkçe karakter sorunu yaşamamak için "tr-TR" yazdık
                if ($bannerYukle->uploaded) { // sınıfın uploaded özelliğini çağırdık ve yükleme yapılabilir mi kontrolü yaptık.
                    // save uploaded image with no changes

                    // $bannerYukle->image_convert  = 'jpeg';                 // dosya türü ne gelirse gelsin(jpg, pdf, tif, zip...) jpeg yapar. Varsayılan jpg. BU KODU YAZMAZSAN PNG OLARAK KAYDEDER.
                    // $bannerYukle->jpeg_quality = 100;                      // resmin kalitesini %100 yaptık(png olmuyor)
                    $bannerYukle->image_resize = true;                        // boyutlandırma yaptık. belirttiğimiz değerin üzerinde boyuta ulaşırsa istediğimiz değere kırpar.
                    $bannerYukle->image_x = $resimGenislikOlcusu;             // resim genişliği
                    $bannerYukle->image_y = $resimYukseklikOlcusu;            // resim yüksekliği
                    $bannerYukle->file_new_name_body = $resimIcinDosyaAdi;    // resim dosyası logo olarak isimlendirildi
                    $bannerYukle->mime_check = true;                          // mime türünü kontrol ettik ettik. (Biz alt satırda image olmasını istedik mime türünün. Ama pdf, gif felan gelirse hata döndürür.)
                    $bannerYukle->allowed = array('image/*');                 // Bütün resim dosyalarını kabul edebileceğini belirttik. image türünde her şey gelebilir (png, jpg, jpeg...)
                    $bannerYukle->file_overwrite = true;                      // Yüklenecek dosya var olan dosyayla aynı ise üstüne yazar. (Yani yine de yenisini eskisiyle değiştirir.)
                    $bannerYukle->image_background_color = "#FFFFFF";         // png transparan gelirse arka planı beyaz olsun
                    // $bannerYukle->image_ratio_y = true;                    // if true, resize image, calculating image_y from image_x and conserving the original sizes ratio (default: false)

                    $bannerYukle->process($verotIcinKlasorYolu);

                    if ($bannerYukle->processed) {

                        $bannerResmiGuncellemeSorgusu = $db->prepare("UPDATE bannerlar SET bannerAlani = ?, bannerAdi = ?, bannerResmi = ? WHERE id = ? LIMIT 1");
                        $bannerResmiGuncellemeSorgusu->execute([$gelenBannerAlani, $gelenBannerAdi, $resimIcinYeniDosyaAdi, $gelenId]);
                        $bannerResmiGuncellemeKontrol      = $bannerResmiGuncellemeSorgusu->rowCount();

                        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=40");
                        exit();

                        if ($bannerResmiGuncellemeKontrol < 1) {
                            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=41");
                            exit();
                        }

                        $bannerYukle->clean();
                    } else {
                        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=41");
                        exit();
                    }
                }

            } else {
                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=41");
                exit();
            }
        }
    } else {
        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=41");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
