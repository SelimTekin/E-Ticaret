<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }
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

    if (($gelenUrunMenusu != "") and ($gelenUrunAdi != "") and ($gelenUrunFiyati != "") and ($gelenParaBirimi != "") and ($gelenKdvOrani != "") and ($gelenKargoUcreti != "") and ($gelenUrunAciklamasi != "") and ($gelenVaryantBasligi != "") and ($gelenvaryantAdi1 != "") and ($gelenstokAdedi1 != "")) {

        $urunSorgusu = $db->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
        $urunSorgusu->execute([$gelenId]);
        $urunKontrol      = $urunSorgusu->rowCount();
        $urunBilgisi      = $urunSorgusu->fetch(PDO::FETCH_ASSOC);

        if ($urunKontrol > 0) {

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

                $urunGuncellemeSorgusu = $db->prepare("UPDATE urunler SET menuId = ?, urunAdi = ?, urunFiyati = ?, paraBirimi = ?, kdvOrani = ?, urunAciklamasi = ?, varyantBasligi = ?, kargoUcreti = ? WHERE id = ? LIMIT 1");
                $urunGuncellemeSorgusu->execute([$gelenUrunMenusu, $gelenUrunAdi, $gelenUrunFiyati, $gelenParaBirimi, $gelenKdvOrani, $gelenUrunAciklamasi, $gelenVaryantBasligi, $gelenKargoUcreti, $gelenId]);
                $urunGuncellemeKontrol = $urunGuncellemeSorgusu->rowCount();


                    if (($gelenResim1["name"] != "") and ($gelenResim1["full_path"] != "") and ($gelenResim1["type"] != "") and ($gelenResim1["error"] == 0) and ($gelenResim1["size"] > 0)) {

                        $birinciResimIcinDosyaAdi = resimAdiOlustur();
                        $gelenBirinciResminUzantisi = substr($gelenResim1["name"], -4);
                        if ($gelenBirinciResminUzantisi == "jpeg") {
                            $gelenBirinciResminUzantisi = "." . $gelenBirinciResminUzantisi;
                        }
                        $birinciResimIcinYeniDosyaAdi = $birinciResimIcinDosyaAdi . $gelenBirinciResminUzantisi;

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

                            if ($birinciResimYukle->processed) {

                                $silinecekBirinciResimYolu = "../resimler/" . $resimKlasoru . $urunBilgisi["urunResmiBir"];
                                unlink($silinecekBirinciResimYolu);

                                $birinciResimGuncellemeSorgusu = $db->prepare("UPDATE urunler SET urunResmiBir = ? WHERE id = ? LIMIT 1");
                                $birinciResimGuncellemeSorgusu->execute([$birinciResimYukle->file_dst_name, $gelenId]);
                                $birinciResimGuncellemeKontrol = $birinciResimGuncellemeSorgusu->rowCount();

                                if ($birinciResimGuncellemeKontrol < 1) {
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                    exit();
                                }

                                $birinciResimYukle->clean();
                            } else {
                                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                exit();
                            }
                        }
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

                                $silinecekIkinciResimYolu = "../resimler/" . $resimKlasoru . $urunBilgisi["urunResmiIki"];
                                unlink($silinecekIkinciResimYolu);

                                $ikinciResimGuncellemeSorgusu = $db->prepare("UPDATE urunler SET urunResmiIki = ? WHERE id = ? LIMIT 1");
                                $ikinciResimGuncellemeSorgusu->execute([$ikinciResimYukle->file_dst_name, $gelenId]);
                                $ikinciResimGuncellemeKontrol = $ikinciResimGuncellemeSorgusu->rowCount();

                                if ($ikinciResimGuncellemeKontrol < 1) {
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                    exit();
                                }

                                $ikinciResimYukle->clean();
                            } else {
                                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
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

                                $silinecekUcuncuResimYolu = "../resimler/" . $resimKlasoru . $urunBilgisi["urunResmiUc"];
                                unlink($silinecekUcuncuResimYolu);

                                $ucuncuResimGuncellemeSorgusu = $db->prepare("UPDATE urunler SET urunResmiUc = ? WHERE id = ? LIMIT 1");
                                $ucuncuResimGuncellemeSorgusu->execute([$ucuncuResimYukle->file_dst_name, $gelenId]);
                                $ucuncuResimGuncellemeKontrol = $ucuncuResimGuncellemeSorgusu->rowCount();

                                if ($ucuncuResimGuncellemeKontrol < 1) {
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                    exit();
                                }

                                $ucuncuResimYukle->clean();
                            } else {
                                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
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

                                $silinecekDorduncuResimYolu = "../resimler/" . $resimKlasoru . $urunBilgisi["urunResmiDort"];
                                unlink($silinecekDorduncuResimYolu);

                                $dorduncuResimGuncellemeSorgusu = $db->prepare("UPDATE urunler SET urunResmiDort = ? WHERE id = ? LIMIT 1");
                                $dorduncuResimGuncellemeSorgusu->execute([$dorduncuResimYukle->file_dst_name, $gelenId]);
                                $dorduncuResimGuncellemeKontrol = $dorduncuResimGuncellemeSorgusu->rowCount();

                                if ($dorduncuResimGuncellemeKontrol < 1) {
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                    exit();
                                }

                                $dorduncuResimYukle->clean();
                            } else {
                                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                exit();
                            }
                        }
                    }

                    $varyantlarSorgusu            = $db->prepare("SELECT * FROM urunvaryantlari WHERE urunId = ?");
                    $varyantlarSorgusu->execute([$gelenId]);
                    $varyantSayisi             = $varyantlarSorgusu->rowCount();
                    $varyantBilgisi               = $varyantlarSorgusu->fetchAll(PDO::FETCH_ASSOC);

                    $varyantIsimDizisi = array();

                    foreach($varyantBilgisi as $varyant){
                        $varyantIsimDizisi[] = $varyant["varyantAdi"];
                    }

                    if(array_key_exists(0, $varyantIsimDizisi)){
                        if(($gelenvaryantAdi1 != "") and ($gelenstokAdedi1 != "")){
                            $birinciVaryantGuncellemeSorgusu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi = ?, stokAdedi = ? WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $birinciVaryantGuncellemeSorgusu->execute([$gelenvaryantAdi1, $gelenstokAdedi1, $gelenId, $varyantIsimDizisi[0]]);
                            $birinciVaryantGuncellemeKontrol = $birinciVaryantGuncellemeSorgusu->rowCount();
                        }
                    }

                    if(array_key_exists(1, $varyantIsimDizisi)){
                        if(($gelenvaryantAdi2 != "") and ($gelenstokAdedi2 != "")){
                            $ikinciVaryantGuncellemeSorgusu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi = ?, stokAdedi = ? WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $ikinciVaryantGuncellemeSorgusu->execute([$gelenvaryantAdi1, $gelenstokAdedi1, $gelenId, $varyantIsimDizisi[1]]);
                            $ikinciVaryantGuncellemeKontrol = $ikinciVaryantGuncellemeSorgusu->rowCount();
                        }
                        else{
                            $ikinciVaryantSilmeSorgusu = $db->prepare("DELETE FROM urunvaryantlari WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $ikinciVaryantSilmeSorgusu->execute([$gelenId, $varyantIsimDizisi[1]]);
                            $ikinciVaryantSilmeKontrol = $ikinciVaryantSilmeSorgusu->rowCount();

                            if($ikinciVaryantSilmeKontrol < 1){
                                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                exit();
                            }
                        }
                    }
                    else{
                        if (($gelenvaryantAdi2 != "") and ($gelenstokAdedi2 != "")) {
                                $ikinciVaryantEklemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                                $ikinciVaryantEklemeSorgusu->execute([$gelenId, $gelenvaryantAdi2, $gelenstokAdedi2]);
                                $ikinciVaryantEklemeKontrol = $ikinciVaryantEklemeSorgusu->rowCount();

                                if($ikinciVaryantEklemeKontrol < 1){
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                    exit();
                                }

                        }
                    }

                    if(array_key_exists(2, $varyantIsimDizisi)){
                        if(($gelenvaryantAdi3 != "") and ($gelenstokAdedi3 != "")){
                            $ucuncuVaryantGuncellemeSorgusu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi = ?, stokAdedi = ? WHERE urunId = ? AND varyantAdi = ? LIMIT 2");
                            $ucuncuVaryantGuncellemeSorgusu->execute([$gelenvaryantAdi3, $gelenstokAdedi3, $gelenId, $varyantIsimDizisi[2]]);
                            $ucuncuVaryantGuncellemeKontrol = $ucuncuVaryantGuncellemeSorgusu->rowCount();
                        }
                        else{
                            $ucuncuVaryantSilmeSorgusu = $db->prepare("DELETE FROM urunvaryantlari WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $ucuncuVaryantSilmeSorgusu->execute([$gelenId, $varyantIsimDizisi[2]]);
                            $ucuncuVaryantSilmeKontrol = $ucuncuVaryantSilmeSorgusu->rowCount();

                            if($ucuncuVaryantSilmeKontrol < 1){
                                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                exit();
                            }
                        }
                    }
                    else{
                        if (($gelenvaryantAdi3 != "") and ($gelenstokAdedi3 != "")) {
                                $ucuncuVaryantEklemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                                $ucuncuVaryantEklemeSorgusu->execute([$gelenId, $gelenvaryantAdi3, $gelenstokAdedi3]);
                                $ucuncuVaryantEklemeKontrol = $ucuncuVaryantEklemeSorgusu->rowCount();

                                if($ucuncuVaryantEklemeKontrol < 1){
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                    exit();
                                }

                        }
                    }

                    if(array_key_exists(3, $varyantIsimDizisi)){
                        if(($gelenvaryantAdi4 != "") and ($gelenstokAdedi4 != "")){
                            $dorduncuVaryantGuncellemeSorgusu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi = ?, stokAdedi = ? WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $dorduncuVaryantGuncellemeSorgusu->execute([$gelenvaryantAdi4, $gelenstokAdedi4, $gelenId, $varyantIsimDizisi[3]]);
                            $dorduncuVaryantGuncellemeKontrol = $dorduncuVaryantGuncellemeSorgusu->rowCount();
                        }
                        else{
                            $dorduncuVaryantSilmeSorgusu = $db->prepare("DELETE FROM urunvaryantlari WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $dorduncuVaryantSilmeSorgusu->execute([$gelenId, $varyantIsimDizisi[3]]);
                            $dorduncuVaryantSilmeKontrol = $dorduncuVaryantSilmeSorgusu->rowCount();

                            if($dorduncuVaryantSilmeKontrol < 1){
                                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                exit();
                            }
                        }
                    }
                    else{
                        if (($gelenvaryantAdi4 != "") and ($gelenstokAdedi4 != "")) {
                                $dorduncuVaryantEklemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                                $dorduncuVaryantEklemeSorgusu->execute([$gelenId, $gelenvaryantAdi4, $gelenstokAdedi4]);
                                $dorduncuVaryantEklemeKontrol = $dorduncuVaryantEklemeSorgusu->rowCount();

                                if($dorduncuVaryantEklemeKontrol < 1){
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                    exit();
                                }

                        }
                    }

                    if(array_key_exists(4, $varyantIsimDizisi)){
                        if(($gelenvaryantAdi5 != "") and ($gelenstokAdedi5 != "")){
                            $besinciVaryantGuncellemeSorgusu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi = ?, stokAdedi = ? WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $besinciVaryantGuncellemeSorgusu->execute([$gelenvaryantAdi5, $gelenstokAdedi5, $gelenId, $varyantIsimDizisi[4]]);
                            $besinciVaryantGuncellemeKontrol = $besinciVaryantGuncellemeSorgusu->rowCount();
                        }
                        else{
                            $besinciVaryantSilmeSorgusu = $db->prepare("DELETE FROM urunvaryantlari WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $besinciVaryantSilmeSorgusu->execute([$gelenId, $varyantIsimDizisi[4]]);
                            $besinciVaryantSilmeKontrol = $besinciVaryantSilmeSorgusu->rowCount();

                            if($besinciVaryantSilmeKontrol < 1){
                                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                exit();
                            }
                        }
                    }
                    else{
                        if (($gelenvaryantAdi5 != "") and ($gelenstokAdedi5 != "")) {
                                $besinciVaryantEklemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                                $besinciVaryantEklemeSorgusu->execute([$gelenId, $gelenvaryantAdi5, $gelenstokAdedi5]);
                                $besinciVaryantEklemeKontrol = $besinciVaryantEklemeSorgusu->rowCount();

                                if($besinciVaryantEklemeKontrol < 1){
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                    exit();
                                }

                        }
                    }

                    if(array_key_exists(5, $varyantIsimDizisi)){
                        if(($gelenvaryantAdi6 != "") and ($gelenstokAdedi6 != "")){
                            $altinciVaryantGuncellemeSorgusu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi = ?, stokAdedi = ? WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $altinciVaryantGuncellemeSorgusu->execute([$gelenvaryantAdi4, $gelenstokAdedi4, $gelenId, $varyantIsimDizisi[5]]);
                            $altinciVaryantGuncellemeKontrol = $altinciVaryantGuncellemeSorgusu->rowCount();
                        }
                        else{
                            $altinciVaryantSilmeSorgusu = $db->prepare("DELETE FROM urunvaryantlari WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $altinciVaryantSilmeSorgusu->execute([$gelenId, $varyantIsimDizisi[5]]);
                            $altinciVaryantSilmeKontrol = $altinciVaryantSilmeSorgusu->rowCount();

                            if($altinciVaryantSilmeKontrol < 1){
                                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                exit();
                            }
                        }
                    }
                    else{
                        if (($gelenvaryantAdi6 != "") and ($gelenstokAdedi6 != "")) {
                                $altinciVaryantEklemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                                $altinciVaryantEklemeSorgusu->execute([$gelenId, $gelenvaryantAdi6, $gelenstokAdedi6]);
                                $altinciVaryantEklemeKontrol = $altinciVaryantEklemeSorgusu->rowCount();

                                if($altinciVaryantEklemeKontrol < 1){
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                    exit();
                                }

                        }
                    }

                    if(array_key_exists(6, $varyantIsimDizisi)){
                        if(($gelenvaryantAdi7 != "") and ($gelenstokAdedi7 != "")){
                            $yedinciVaryantGuncellemeSorgusu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi = ?, stokAdedi = ? WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $yedinciVaryantGuncellemeSorgusu->execute([$gelenvaryantAdi7, $gelenstokAdedi7, $gelenId, $varyantIsimDizisi[6]]);
                            $yedinciVaryantGuncellemeKontrol = $yedinciVaryantGuncellemeSorgusu->rowCount();
                        }
                        else{
                            $yedinciVaryantSilmeSorgusu = $db->prepare("DELETE FROM urunvaryantlari WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $yedinciVaryantSilmeSorgusu->execute([$gelenId, $varyantIsimDizisi[6]]);
                            $yedinciVaryantSilmeKontrol = $yedinciVaryantSilmeSorgusu->rowCount();

                            if($yedinciVaryantSilmeKontrol < 1){
                                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                exit();
                            }
                        }
                    }
                    else{
                        if (($gelenvaryantAdi7 != "") and ($gelenstokAdedi7 != "")) {
                                $yedinciVaryantEklemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                                $yedinciVaryantEklemeSorgusu->execute([$gelenId, $gelenvaryantAdi7, $gelenstokAdedi7]);
                                $yedinciVaryantEklemeKontrol = $yedinciVaryantEklemeSorgusu->rowCount();

                                if($yedinciVaryantEklemeKontrol < 1){
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                    exit();
                                }

                        }
                    }

                    if(array_key_exists(7, $varyantIsimDizisi)){
                        if(($gelenvaryantAdi8 != "") and ($gelenstokAdedi8 != "")){
                            $sekizinciVaryantGuncellemeSorgusu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi = ?, stokAdedi = ? WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $sekizinciVaryantGuncellemeSorgusu->execute([$gelenvaryantAdi8, $gelenstokAdedi8, $gelenId, $varyantIsimDizisi[7]]);
                            $sekizinciVaryantGuncellemeKontrol = $sekizinciVaryantGuncellemeSorgusu->rowCount();
                        }
                        else{
                            $sekizinciVaryantSilmeSorgusu = $db->prepare("DELETE FROM urunvaryantlari WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $sekizinciVaryantSilmeSorgusu->execute([$gelenId, $varyantIsimDizisi[7]]);
                            $sekizinciVaryantSilmeKontrol = $sekizinciVaryantSilmeSorgusu->rowCount();

                            if($sekizinciVaryantSilmeKontrol < 1){
                                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                exit();
                            }
                        }
                    }
                    else{
                        if (($gelenvaryantAdi8 != "") and ($gelenstokAdedi8 != "")) {
                                $sekizinciVaryantEklemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                                $sekizinciVaryantEklemeSorgusu->execute([$gelenId, $gelenvaryantAdi8, $gelenstokAdedi8]);
                                $sekizinciVaryantEklemeKontrol = $sekizinciVaryantEklemeSorgusu->rowCount();

                                if($sekizinciVaryantEklemeKontrol < 1){
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                    exit();
                                }

                        }
                    }

                    if(array_key_exists(8, $varyantIsimDizisi)){
                        if(($gelenvaryantAdi9 != "") and ($gelenstokAdedi9 != "")){
                            $dokuzuncuVaryantGuncellemeSorgusu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi = ?, stokAdedi = ? WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $dokuzuncuVaryantGuncellemeSorgusu->execute([$gelenvaryantAdi9, $gelenstokAdedi9, $gelenId, $varyantIsimDizisi[8]]);
                            $dokuzuncuVaryantGuncellemeKontrol = $dokuzuncuVaryantGuncellemeSorgusu->rowCount();
                        }
                        else{
                            $dokuzuncuVaryantSilmeSorgusu = $db->prepare("DELETE FROM urunvaryantlari WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $dokuzuncuVaryantSilmeSorgusu->execute([$gelenId, $varyantIsimDizisi[8]]);
                            $dokuzuncuVaryantSilmeKontrol = $dokuzuncuVaryantSilmeSorgusu->rowCount();

                            if($dokuzuncuVaryantSilmeKontrol < 1){
                                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                exit();
                            }
                        }
                    }
                    else{
                        if (($gelenvaryantAdi9 != "") and ($gelenstokAdedi9 != "")) {
                                $dokuzuncuVaryantEklemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                                $dokuzuncuVaryantEklemeSorgusu->execute([$gelenId, $gelenvaryantAdi9, $gelenstokAdedi9]);
                                $dokuzuncuVaryantEklemeKontrol = $dokuzuncuVaryantEklemeSorgusu->rowCount();

                                if($dokuzuncuVaryantEklemeKontrol < 1){
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                    exit();
                                }

                        }
                    }

                    if(array_key_exists(9, $varyantIsimDizisi)){
                        if(($gelenvaryantAdi10 != "") and ($gelenstokAdedi10 != "")){
                            $onuncuVaryantGuncellemeSorgusu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi = ?, stokAdedi = ? WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $onuncuVaryantGuncellemeSorgusu->execute([$gelenvaryantAdi10, $gelenstokAdedi10, $gelenId, $varyantIsimDizisi[9]]);
                            $onuncuVaryantGuncellemeKontrol = $onuncuVaryantGuncellemeSorgusu->rowCount();
                        }
                        else{
                            $onuncuVaryantSilmeSorgusu = $db->prepare("DELETE FROM urunvaryantlari WHERE urunId = ? AND varyantAdi = ? LIMIT 1");
                            $onuncuVaryantSilmeSorgusu->execute([$gelenId, $varyantIsimDizisi[9]]);
                            $onuncuVaryantSilmeKontrol = $onuncuVaryantSilmeSorgusu->rowCount();

                            if($onuncuVaryantSilmeKontrol < 1){
                                echo "1";die();
                                header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                exit();
                            }
                        }
                    }
                    else{
                        if (($gelenvaryantAdi10 != "") and ($gelenstokAdedi10 != "")) {
                                $onuncuVaryantEklemeSorgusu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, stokAdedi) VALUES (?, ?, ?)");
                                $onuncuVaryantEklemeSorgusu->execute([$gelenId, $gelenvaryantAdi10, $gelenstokAdedi10]);
                                $onuncuVaryantEklemeKontrol = $onuncuVaryantEklemeSorgusu->rowCount();

                                if($onuncuVaryantEklemeKontrol < 1){
                                    echo "4";die();
                                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
                                    exit();
                                }

                        }
                    }

                    header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=101");
                    exit();
                    
            } else {
                echo "2";die();
                header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=102");
                exit();
            }
        } else {
            echo "5";die();
            header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=102");
            exit();
        }
    } else {
        echo "6";die();
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=102");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
