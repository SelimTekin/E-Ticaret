<?php
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

        $silinecekdorduncuResimYolu = "../resimler/" . $resimKlasoru . $urunBilgisi["urunResmiDort"];
        unlink($silinecekdorduncuResimYolu);

        $dorduncuResimGuncellemeSorgusu = $db->prepare("UPDATE urunler SET urunResmDortc = ? WHERE id = ? LIMIT 1");
        $dorduncuResimGuncellemeSorgusu->execute([$dorduncuResimYukle->file_dst_name, $gelenId]);
        $dorduncuResimGuncellemeKontrol = $dorduncuResimGuncellemeSorgusu->rowCount();

        if($dorduncuResimGuncellemeKontrol > 0){
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