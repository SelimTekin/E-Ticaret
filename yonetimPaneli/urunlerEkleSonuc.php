<?php
if (isset($_SESSION["yonetici"])) {

    // gelen veriler

    if (isset($_POST["urunMenusu"])) {
        $gelenUrunMenusu = guvenlik($_POST["urunMenusu"]);
    } else {
        $gelenUrunMenusu = "";
    }

    if (isset($_POST["urunAdi"])) {
        $gelenUrunAdi = guvenlik($_POST["urunAdi"]);
    } else {
        $gelenUrunAdi = "";
    }

    if (isset($_POST["urunFiyati"])) {
        $gelenUrunFiyati = guvenlik($_POST["urunFiyati"]);
    } else {
        $gelenUrunFiyati = "";
    }

    if (isset($_POST["paraBirimi"])) {
        $gelenParaBirimi = guvenlik($_POST["paraBirimi"]);
    } else {
        $gelenParaBirimi = "";
    }

    if (isset($_POST["kdvOrani"])) {
        $gelenKdvOrani = guvenlik($_POST["kdvOrani"]);
    } else {
        $gelenKdvOrani = "";
    }

    if (isset($_POST["kargoUcreti"])) {
        $gelenKargoUcreti = guvenlik($_POST["kargoUcreti"]);
    } else {
        $gelenKargoUcreti = "";
    }

    if (isset($_POST["urunAciklamasi"])) {
        $gelenUrunAciklamasi = guvenlik($_POST["urunAciklamasi"]);
    } else {
        $gelenUrunAciklamasi = "";
    }

    if (isset($_POST["varyantBasligi"])) {
        $gelenVaryantBasligi = guvenlik($_POST["varyantBasligi"]);
    } else {
        $gelenVaryantBasligi = "";
    }

    if (isset($_POST["varyantAdi1"])) {
        $gelenvaryantAdi1 = guvenlik($_POST["varyantAdi1"]);
    } else {
        $gelenvaryantAdi1 = "";
    }

    if (isset($_POST["stokAdedi1"])) {
        $gelenstokAdedi1 = guvenlik($_POST["stokAdedi1"]);
    } else {
        $gelenstokAdedi1 = "";
    }

    if (isset($_POST["varyantAdi2"])) {
        $gelenvaryantAdi2 = guvenlik($_POST["varyantAdi2"]);
    } else {
        $gelenvaryantAdi2 = "";
    }

    if (isset($_POST["stokAdedi2"])) {
        $gelenstokAdedi2 = guvenlik($_POST["stokAdedi2"]);
    } else {
        $gelenstokAdedi2 = "";
    }

    if (isset($_POST["varyantAdi3"])) {
        $gelenvaryantAdi3 = guvenlik($_POST["varyantAdi3"]);
    } else {
        $gelenvaryantAdi3 = "";
    }

    if (isset($_POST["stokAdedi3"])) {
        $gelenstokAdedi3 = guvenlik($_POST["stokAdedi3"]);
    } else {
        $gelenstokAdedi3 = "";
    }

    if (isset($_POST["varyantAdi4"])) {
        $gelenvaryantAdi4 = guvenlik($_POST["varyantAdi4"]);
    } else {
        $gelenvaryantAdi4 = "";
    }

    if (isset($_POST["stokAdedi4"])) {
        $gelenstokAdedi4 = guvenlik($_POST["stokAdedi4"]);
    } else {
        $gelenstokAdedi4 = "";
    }

    if (isset($_POST["varyantAdi5"])) {
        $gelenvaryantAdi5 = guvenlik($_POST["varyantAdi5"]);
    } else {
        $gelenvaryantAdi5 = "";
    }

    if (isset($_POST["stokAdedi5"])) {
        $gelenstokAdedi5 = guvenlik($_POST["stokAdedi5"]);
    } else {
        $gelenstokAdedi5 = "";
    }

    if (isset($_POST["varyantAdi6"])) {
        $gelenvaryantAdi6 = guvenlik($_POST["varyantAdi6"]);
    } else {
        $gelenvaryantAdi6 = "";
    }

    if (isset($_POST["stokAdedi6"])) {
        $gelenstokAdedi6 = guvenlik($_POST["stokAdedi6"]);
    } else {
        $gelenstokAdedi6 = "";
    }

    if (isset($_POST["varyantAdi7"])) {
        $gelenvaryantAdi7 = guvenlik($_POST["varyantAdi7"]);
    } else {
        $gelenvaryantAdi7 = "";
    }

    if (isset($_POST["stokAdedi7"])) {
        $gelenstokAdedi7 = guvenlik($_POST["stokAdedi7"]);
    } else {
        $gelenstokAdedi7 = "";
    }

    if (isset($_POST["varyantAdi8"])) {
        $gelenvaryantAdi8 = guvenlik($_POST["varyantAdi8"]);
    } else {
        $gelenvaryantAdi8 = "";
    }

    if (isset($_POST["stokAdedi8"])) {
        $gelenstokAdedi8 = guvenlik($_POST["stokAdedi8"]);
    } else {
        $gelenstokAdedi8 = "";
    }

    if (isset($_POST["varyantAdi9"])) {
        $gelenvaryantAdi9 = guvenlik($_POST["varyantAdi9"]);
    } else {
        $gelenvaryantAdi9 = "";
    }

    if (isset($_POST["stokAdedi9"])) {
        $gelenstokAdedi9 = guvenlik($_POST["stokAdedi9"]);
    } else {
        $gelenstokAdedi9 = "";
    }

    if (isset($_POST["varyantAdi10"])) {
        $gelenvaryantAdi10 = guvenlik($_POST["varyantAdi10"]);
    } else {
        $gelenvaryantAdi10 = "";
    }

    if (isset($_POST["stokAdedi10"])) {
        $gelenstokAdedi10 = guvenlik($_POST["stokAdedi10"]);
    } else {
        $gelenstokAdedi10 = "";
    }

    $gelenResim1 = $_FILES["resim1"];
    $gelenResim2 = $_FILES["resim2"];
    $gelenResim3 = $_FILES["resim3"];
    $gelenResim4 = $_FILES["resim4"];

    if (($gelenResim1["name"] != "") and ($gelenResim1["full_path"] != "") and ($gelenResim1["type"] != "") and ($gelenResim1["error"] == 0) and ($gelenResim1["size"] > 0) and ($gelenUrunMenusu != "") and ($gelenUrunAdi != "") and ($gelenUrunFiyati != "") and ($gelenParaBirimi != "") and ($gelenKdvOrani != "") and ($gelenKargoUcreti != "") and ($gelenUrunAciklamasi != "") and ($gelenVaryantBasligi != "") and ($gelenvaryantAdi1 != "") and ($gelenstokAdedi1 != "")) {

        $menuTuruSorgusu = $db->prepare("SELECT * FROM menuler WHERE id = ? LIMIT 1");
        $menuTuruSorgusu->execute([$gelenUrunMenusu]);
        $menuTuruKontrol   = $menuTuruSorgusu->rowCount();
        $menuTuruKaydi     = $menuTuruSorgusu->fetch(PDO::FETCH_ASSOC);

        if ($menuTuruKaydi["urunTuru"] == "Erkek Ayakkabısı") {
            $resimKlasoru = "UrunResimleri/Erkek/";
        } elseif ($menuTuruKaydi["urunTuru"] == "Kadın Ayakkabısı") {
            $resimKlasoru = "UrunResimleri/Kadin/";
        } elseif ($menuTuruKaydi["urunTuru"] == "Çocuk Ayakkabısı") {
            $resimKlasoru = "UrunResimleri/Cocuk/";
        }

        if ($menuTuruKontrol > 0) {

            $birinciResimIcinDosyaAdi = resimAdiOlustur();
            $gelenBirinciResminUzantisi = substr($gelenResim1["name"], -4);
            if ($gelenBirinciResminUzantisi == "jpeg") {
                $gelenBirinciResminUzantisi = "." . $gelenBirinciResminUzantisi;
            }
            $birinciResimIcinYeniDosyaAdi = $birinciResimIcinDosyaAdi . $gelenBirinciResminUzantisi;

            $urunEklemeSorgusu = $db->prepare("INSERT INTO urunler (menuId, urunTuru, urunAdi, urunFiyati, paraBirimi, kdvOrani, urunAciklamasi, urunResmiBir, varyantBasligi, kargoUcreti, durumu) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $urunEklemeSorgusu->execute([$gelenUrunMenusu, $menuTuruKaydi["urunTuru"], $gelenUrunAdi, $gelenUrunFiyati, $gelenParaBirimi, $gelenKdvOrani, $gelenUrunAciklamasi, $birinciResimIcinYeniDosyaAdi, $gelenVaryantBasligi, $gelenKargoUcreti, 1]);
            $urunEklemeKontrol = $urunEklemeSorgusu->rowCount();

            if ($urunEklemeKontrol > 0) {

                $sonEklenenUrununIdsi = $db->lastInsertId();

                $birinciResimYukle = new \Verot\Upload\Upload($gelenResim1, "tr-TR");
                if ($birinciResimYukle->uploaded) {

                    // $birinciResimYukle->image_convert  = ''; // dosya türü ne gelirse gelsin(jpg, pdf, tif, zip...) jpeg yapar. Varsayılan jpg. BU KODU YAZMAZSAN PNG OLARAK KAYDEDER.
                    // $birinciResimYukle->jpeg_quality = 100; // resmin kalitesini %100 yaptık(png olmuyor)
                    $birinciResimYukle->image_resize = true; // boyutlandırma yaptık. belirttiğimiz değerin üzerinde boyuta ulaşırsa istediğimiz değere kırpar.
                    $birinciResimYukle->image_x = 350; // resmin ölçülerini koru demek oluyor.
                    $birinciResimYukle->image_y = 450;        // resim yüksekliği
                    $birinciResimYukle->file_new_name_body = $birinciResimIcinDosyaAdi; // resim dosyası logo olarak isimlendirildi
                    $birinciResimYukle->mime_check = true; // mime türünü kontrol ettik ettik. (Biz alt satırda image olmasını istedik mime türünün. Ama pdf, gif felan gelirse hata döndürür.)
                    $birinciResimYukle->allowed = array('image/*'); // Bütün resim dosyalarını kabul edebileceğini belirttik. image türünde her şey gelebilir (png, jpg, jpeg...)
                    $birinciResimYukle->file_overwrite = true; // Yüklenecek dosya var olan dosyayla aynı ise üstüne yazar. (Yani yine de yenisini eskisiyle değiştirir.)
                    $birinciResimYukle->image_background_color = "#FFFFFF"; // png transparan gelirse arka planı beyaz olsun
                    // $birinciResimYukle->image_ratio_y = true; // if true, resize image, calculating image_y from image_x and conserving the original sizes ratio (default: false)

                    $birinciResimYukle->process($verotIcinKlasorYolu . $resimKlasoru);

                    if ($birinciResimYukle->processed) { // yükleme işlemi gerçekleştiyse clean ile işlemi temizliyor
                        $birinciResimYukle->clean();
                    } else {
                        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=98");
                        exit();
                    }
                }

                $menuUrunSayisiGuncellemeSorgusu = $db->prepare("UPDATE menuler SET urunSayisi = urunSayisi + 1 WHERE id = ? LIMIT 1");
                $menuUrunSayisiGuncellemeSorgusu->execute([$gelenUrunMenusu]);
                $menuUrunSayisiGuncellemeKontrol = $menuUrunSayisiGuncellemeSorgusu->rowCount();

                if ($menuUrunSayisiGuncellemeKontrol > 0) {

                    $birinciVaryantGuncellemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                    $birinciVaryantGuncellemeSorgusu->execute([$sonEklenenUrununIdsi, $gelenvaryantAdi1, $gelenstokAdedi1]);
                    $birinciVaryantGuncellemeKontrol = $birinciVaryantGuncellemeSorgusu->rowCount();

                    if ($birinciVaryantGuncellemeKontrol > 0) {
                        if (($gelenvaryantAdi2 != "") and ($gelenstokAdedi2 != "")) {
                            $ikinciVaryantGuncellemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                            $ikinciVaryantGuncellemeSorgusu->execute([$sonEklenenUrununIdsi, $gelenvaryantAdi2, $gelenstokAdedi2]);
                        }
                        if (($gelenvaryantAdi3 != "") and ($gelenstokAdedi3 != "")) {
                            $ucuncuVaryantGuncellemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                            $ucuncuVaryantGuncellemeSorgusu->execute([$sonEklenenUrununIdsi, $gelenvaryantAdi3, $gelenstokAdedi3]);
                        }
                        if (($gelenvaryantAdi4 != "") and ($gelenstokAdedi4 != "")) {
                            $dorduncuVaryantGuncellemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                            $dorduncuVaryantGuncellemeSorgusu->execute([$sonEklenenUrununIdsi, $gelenvaryantAdi4, $gelenstokAdedi4]);
                        }
                        if (($gelenvaryantAdi5 != "") and ($gelenstokAdedi5 != "")) {
                            $besinciVaryantGuncellemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                            $besinciVaryantGuncellemeSorgusu->execute([$sonEklenenUrununIdsi, $gelenvaryantAdi5, $gelenstokAdedi5]);
                        }
                        if (($gelenvaryantAdi6 != "") and ($gelenstokAdedi6 != "")) {
                            $altinciVaryantGuncellemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                            $altinciVaryantGuncellemeSorgusu->execute([$sonEklenenUrununIdsi, $gelenvaryantAdi6, $gelenstokAdedi6]);
                        }
                        if (($gelenvaryantAdi7 != "") and ($gelenstokAdedi7 != "")) {
                            $yedinciVaryantGuncellemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                            $yedinciVaryantGuncellemeSorgusu->execute([$sonEklenenUrununIdsi, $gelenvaryantAdi7, $gelenstokAdedi7]);
                        }
                        if (($gelenvaryantAdi8 != "") and ($gelenstokAdedi8 != "")) {
                            $sekizinciVaryantGuncellemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                            $sekizinciVaryantGuncellemeSorgusu->execute([$sonEklenenUrununIdsi, $gelenvaryantAdi8, $gelenstokAdedi8]);
                        }
                        if (($gelenvaryantAdi9 != "") and ($gelenstokAdedi9 != "")) {
                            $dokuzuncuVaryantGuncellemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                            $dokuzuncuVaryantGuncellemeSorgusu->execute([$sonEklenenUrununIdsi, $gelenvaryantAdi9, $gelenstokAdedi9]);
                        }
                        if (($gelenvaryantAdi10 != "") and ($gelenstokAdedi10 != "")) {
                            $onuncuVaryantGuncellemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                            $onuncuVaryantGuncellemeSorgusu->execute([$sonEklenenUrununIdsi, $gelenvaryantAdi10, $gelenstokAdedi10]);
                        }

                        if (($gelenResim2["name"] != "") and ($gelenResim2["full_path"] != "") and ($gelenResim2["type"] != "") and ($gelenResim2["error"] == 0) and ($gelenResim2["size"] > 0)) {

                            $ikinciResimIcinDosyaAdi = resimAdiOlustur();
                            $gelenIkinciResminUzantisi = substr($gelenResim2["name"], -4);
                            if ($gelenIkinciResminUzantisi == "jpeg") {
                                $gelenIkinciResminUzantisi = "." . $gelenIkinciResminUzantisi;
                            }
                            $ikinciResimIcinYeniDosyaAdi = $ikinciResimIcinDosyaAdi . $gelenIkinciResminUzantisi;

                            $ikinciResimYukle = new \Verot\Upload\Upload($gelenResim2, "tr-TR");
                            if ($ikinciResimYukle->uploaded) {

                                // $ikinciResimYukle->image_convert  = ''; // dosya türü ne gelirse gelsin(jpg, pdf, tif, zip...) jpeg yapar. Varsayılan jpg. BU KODU YAZMAZSAN PNG OLARAK KAYDEDER.
                                // $ikinciResimYukle->jpeg_quality = 100; // resmin kalitesini %100 yaptık(png olmuyor)
                                $ikinciResimYukle->image_resize = true; // boyutlandırma yaptık. belirttiğimiz değerin üzerinde boyuta ulaşırsa istediğimiz değere kırpar.
                                $ikinciResimYukle->image_x = 350; // resmin ölçülerini koru demek oluyor.
                                $ikinciResimYukle->image_y = 450;        // resim yüksekliği
                                $ikinciResimYukle->file_new_name_body = $ikinciResimIcinDosyaAdi; // resim dosyası logo olarak isimlendirildi
                                $ikinciResimYukle->mime_check = true; // mime türünü kontrol ettik ettik. (Biz alt satırda image olmasını istedik mime türünün. Ama pdf, gif felan gelirse hata döndürür.)
                                $ikinciResimYukle->allowed = array('image/*'); // Bütün resim dosyalarını kabul edebileceğini belirttik. image türünde her şey gelebilir (png, jpg, jpeg...)
                                $ikinciResimYukle->file_overwrite = true; // Yüklenecek dosya var olan dosyayla aynı ise üstüne yazar. (Yani yine de yenisini eskisiyle değiştirir.)
                                $ikinciResimYukle->image_background_color = "#FFFFFF"; // png transparan gelirse arka planı beyaz olsun
                                // $ikinciResimYukle->image_ratio_y = true; // if true, resize image, calculating image_y from image_x and conserving the original sizes ratio (default: false)

                                $ikinciResimYukle->process($verotIcinKlasorYolu . $resimKlasoru);

                                if ($ikinciResimYukle->processed) {

                                    $ikinciResimGuncellemeSorgusu = $db->prepare("UPDATE urunler SET urunResmiIki = ? WHERE id = ? LIMIT 1");
                                    $ikinciResimGuncellemeSorgusu->execute([$ikinciResimYukle->file_dst_name, $sonEklenenUrununIdsi]);
                                    $ikinciResimGuncellemeKontrol = $ikinciResimGuncellemeSorgusu->rowCount();

                                    if($ikinciResimGuncellemeKontrol < 1){
                                        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=98");
                                        exit();
                                    }

                                    $ikinciResimYukle->clean();
                                } else {
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=98");
                                    exit();
                                }
                            }
                        }

                        if (($gelenResim3["name"] != "") and ($gelenResim3["full_path"] != "") and ($gelenResim3["type"] != "") and ($gelenResim3["error"] == 0) and ($gelenResim3["size"] > 0)) {

                            $ucuncuResimIcinDosyaAdi = resimAdiOlustur();
                            $gelenUcuncuResminUzantisi = substr($gelenResim3["name"], -4);
                            if ($gelenUcuncuResminUzantisi == "jpeg") {
                                $gelenUcuncuResminUzantisi = "." . $gelenUcuncuResminUzantisi;
                            }
                            $ucuncuResimIcinYeniDosyaAdi = $ucuncuResimIcinDosyaAdi . $gelenUcuncuResminUzantisi;

                            $ucuncuResimYukle = new \Verot\Upload\Upload($gelenResim3, "tr-TR");
                            if ($ucuncuResimYukle->uploaded) {

                                // $ucuncuResimYukle->image_convert  = ''; // dosya türü ne gelirse gelsin(jpg, pdf, tif, zip...) jpeg yapar. Varsayılan jpg. BU KODU YAZMAZSAN PNG OLARAK KAYDEDER.
                                // $ucuncuResimYukle->jpeg_quality = 100; // resmin kalitesini %100 yaptık(png olmuyor)
                                $ucuncuResimYukle->image_resize = true; // boyutlandırma yaptık. belirttiğimiz değerin üzerinde boyuta ulaşırsa istediğimiz değere kırpar.
                                $ucuncuResimYukle->image_x = 350; // resmin ölçülerini koru demek oluyor.
                                $ucuncuResimYukle->image_y = 450;        // resim yüksekliği
                                $ucuncuResimYukle->file_new_name_body = $ucuncuResimIcinDosyaAdi; // resim dosyası logo olarak isimlendirildi
                                $ucuncuResimYukle->mime_check = true; // mime türünü kontrol ettik ettik. (Biz alt satırda image olmasını istedik mime türünün. Ama pdf, gif felan gelirse hata döndürür.)
                                $ucuncuResimYukle->allowed = array('image/*'); // Bütün resim dosyalarını kabul edebileceğini belirttik. image türünde her şey gelebilir (png, jpg, jpeg...)
                                $ucuncuResimYukle->file_overwrite = true; // Yüklenecek dosya var olan dosyayla aynı ise üstüne yazar. (Yani yine de yenisini eskisiyle değiştirir.)
                                $ucuncuResimYukle->image_background_color = "#FFFFFF"; // png transparan gelirse arka planı beyaz olsun
                                // $ucuncuResimYukle->image_ratio_y = true; // if true, resize image, calculating image_y from image_x and conserving the original sizes ratio (default: false)

                                $ucuncuResimYukle->process($verotIcinKlasorYolu . $resimKlasoru);

                                if ($ucuncuResimYukle->processed) {

                                    $ucuncuResimGuncellemeSorgusu = $db->prepare("UPDATE urunler SET urunResmiUc = ? WHERE id = ? LIMIT 1");
                                    $ucuncuResimGuncellemeSorgusu->execute([$ucuncuResimYukle->file_dst_name, $sonEklenenUrununIdsi]);
                                    $ucuncuResimGuncellemeKontrol = $ucuncuResimGuncellemeSorgusu->rowCount();

                                    if($ucuncuResimGuncellemeKontrol < 1){
                                        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=98");
                                        exit();
                                    }

                                    $ucuncuResimYukle->clean();
                                } else {
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=98");
                                    exit();
                                }
                            }
                        }

                        if (($gelenResim4["name"] != "") and ($gelenResim4["full_path"] != "") and ($gelenResim4["type"] != "") and ($gelenResim4["error"] == 0) and ($gelenResim4["size"] > 0)) {

                            $dorduncuResimIcinDosyaAdi = resimAdiOlustur();
                            $gelenDorduncuResminUzantisi = substr($gelenResim4["name"], -4);
                            if ($gelenDorduncuResminUzantisi == "jpeg") {
                                $gelenDorduncuResminUzantisi = "." . $gelenDorduncuResminUzantisi;
                            }
                            $dorduncuResimIcinYeniDosyaAdi = $dorduncuResimIcinDosyaAdi . $gelenDorduncuResminUzantisi;

                            $dorduncuResimYukle = new \Verot\Upload\Upload($gelenResim4, "tr-TR");
                            if ($dorduncuResimYukle->uploaded) {

                                // $dorduncuResimYukle->image_convert  = ''; // dosya türü ne gelirse gelsin(jpg, pdf, tif, zip...) jpeg yapar. Varsayılan jpg. BU KODU YAZMAZSAN PNG OLARAK KAYDEDER.
                                // $dorduncuResimYukle->jpeg_quality = 100; // resmin kalitesini %100 yaptık(png olmuyor)
                                $dorduncuResimYukle->image_resize = true; // boyutlandırma yaptık. belirttiğimiz değerin üzerinde boyuta ulaşırsa istediğimiz değere kırpar.
                                $dorduncuResimYukle->image_x = 350; // resmin ölçülerini koru demek oluyor.
                                $dorduncuResimYukle->image_y = 450;        // resim yüksekliği
                                $dorduncuResimYukle->file_new_name_body = $dorduncuResimIcinDosyaAdi; // resim dosyası logo olarak isimlendirildi
                                $dorduncuResimYukle->mime_check = true; // mime türünü kontrol ettik ettik. (Biz alt satırda image olmasını istedik mime türünün. Ama pdf, gif felan gelirse hata döndürür.)
                                $dorduncuResimYukle->allowed = array('image/*'); // Bütün resim dosyalarını kabul edebileceğini belirttik. image türünde her şey gelebilir (png, jpg, jpeg...)
                                $dorduncuResimYukle->file_overwrite = true; // Yüklenecek dosya var olan dosyayla aynı ise üstüne yazar. (Yani yine de yenisini eskisiyle değiştirir.)
                                $dorduncuResimYukle->image_background_color = "#FFFFFF"; // png transparan gelirse arka planı beyaz olsun
                                // $dorduncuResimYukle->image_ratio_y = true; // if true, resize image, calculating image_y from image_x and conserving the original sizes ratio (default: false)

                                $dorduncuResimYukle->process($verotIcinKlasorYolu . $resimKlasoru);

                                if ($dorduncuResimYukle->processed) {

                                    $dorduncuResimGuncellemeSorgusu = $db->prepare("UPDATE urunler SET urunResmiDort = ? WHERE id = ? LIMIT 1");
                                    $dorduncuResimGuncellemeSorgusu->execute([$dorduncuResimYukle->file_dst_name, $sonEklenenUrununIdsi]);
                                    $dorduncuResimGuncellemeKontrol = $dorduncuResimGuncellemeSorgusu->rowCount();

                                    if($dorduncuResimGuncellemeKontrol < 1){
                                        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=98");
                                        exit();
                                    }

                                    $dorduncuResimYukle->clean();
                                } else {
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=98");
                                    exit();
                                }
                            }
                        }

                        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=97");
                        exit();

                    } else {
                        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=98");
                        exit();
                    }
                } else {
                    header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=98");
                    exit();
                }
            } else {
                header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=98");
                exit();
            }
        } else {
            header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=98");
            exit();
        }
    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=98");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
