<?php

if (isset($_SESSION["kullanici"])) {

    if (isset($_POST["odemeTuruSecimi"])) {
        $gelenOdemeTuruSecimi = guvenlik($_POST["odemeTuruSecimi"]);
    } else {
        $gelenOdemeTuruSecimi = "";
    }
    if (isset($_POST["taksitSecimi"])) {
        $gelenTaksitSecimi = guvenlik($_POST["taksitSecimi"]);
    } else {
        $gelenTaksitSecimi = "";
    }

    if($gelenOdemeTuruSecimi != ""){

        if($gelenOdemeTuruSecimi == "Banka Havalesi"){ // Banka Havalesi ile işlem yapılacaksa burası çalışır.

            $alisverisSepetiSorgusu = $db->prepare("SELECT * FROM sepet WHERE uyeId = ?");
            $alisverisSepetiSorgusu->execute([$kullaniciId]);
            $sepetSayisi            = $alisverisSepetiSorgusu->rowCount();
            $sepetUrunleri          = $alisverisSepetiSorgusu->fetchAll(PDO::FETCH_ASSOC);

            if($sepetSayisi > 0){

                foreach($sepetUrunleri as $sepetSatirlari){
                    $sepetIdsi             = $sepetSatirlari["id"];
                    $sepetNumarasi         = $sepetSatirlari["sepetNumarasi"];
                    $sepettekiUyeId        = $sepetSatirlari["uyeId"];
                    $sepettekiUrunId       = $sepetSatirlari["urunId"];
                    $sepettekiAdresId      = $sepetSatirlari["adresId"];
                    $sepettekiVaryantId    = $sepetSatirlari["varyantId"];
                    $sepettekiKargoId      = $sepetSatirlari["kargoId"];
                    $sepettekiUrunAdedi    = $sepetSatirlari["urunAdedi"];
                    $sepettekiUrununId     = $sepetSatirlari["odemeSecimi"];
                    $sepettekiTaksitSecimi = $sepetSatirlari["taksitSecimi"];
    
                    $urunBilgileriSorgusu = $db->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
                    $urunBilgileriSorgusu->execute([$sepettekiUrunId]);
                    $urunKaydi            = $urunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
    
                    $urununTuru           = $urunKaydi["urunTuru"];
                    $urununResmi          = $urunKaydi["urunResmiBir"];
                    $urununAdi            = $urunKaydi["urunAdi"];
                    $urununFiyati         = $urunKaydi["urunFiyati"];
                    $urununKdvOrani       = $urunKaydi["kdvOrani"];
                    $urununKargoUcreti       = $urunKaydi["kargoUcreti"];
                    $urununParaBirimi     = $urunKaydi["paraBirimi"];
                    $urununVaryantBasligi = $urunKaydi["varyantBasligi"];
    
                    $urunVaryantBilgileriSorgusu = $db->prepare("SELECT * FROM urunvaryantlari WHERE id = ? LIMIT 1");
                    $urunVaryantBilgileriSorgusu->execute([$sepettekiVaryantId]);
                    $varyantKaydi                = $urunVaryantBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
    
                    $varyantAdi                  = $varyantKaydi["varyantAdi"];
    
                    $kargoBilgileriSorgusu = $db->prepare("SELECT * FROM kargofirmalari WHERE id = ? LIMIT 1");
                    $kargoBilgileriSorgusu->execute([$sepettekiKargoId]);
                    $kargoKaydi            = $kargoBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
    
                    $kargonunAdi           = $kargoKaydi["kargoFirmasiAdi"];
                    
                    $adresBilgileriSorgusu = $db->prepare("SELECT * FROM adresler WHERE id = ? LIMIT 1");
                    $adresBilgileriSorgusu->execute([$sepettekiAdresId]);
                    $adresKaydi            = $adresBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
    
                    $adresAdiSoyadi       = $adresKaydi["adiSoyadi"];
                    $adres                = $adresKaydi["adres"];
                    $adresIlce            = $adresKaydi["ilce"];
                    $adresSehir           = $adresKaydi["sehir"];
                    $adresToparla         = $adres . " " . $adresIlce . " " . $adresSehir;
                    $adresTelefonNumarasi = $adresKaydi["telefonNumarasi"];
                    
                    if($urununParaBirimi == "USD"){
                        $urunFiyatiHesapla           = ($urununFiyati * $dolarKuru);
                    }
                    elseif($urununParaBirimi == "EUR"){
                        $urunFiyatiHesapla     = ($urununFiyati * $euroKuru);
                    }
                    else{
                        $urunFiyatiHesapla     = $urununFiyati;
                    }

                    $urununToplamFiyati      = ($urunFiyatiHesapla * $sepettekiUrunAdedi);

                    $urununToplamKargoFiyati = ($urununKargoUcreti * $sepettekiUrunAdedi);

                    $siparisEkle = $db->prepare("INSERT INTO siparisler (uyeId, siparisNumarasi, urunId, urunTuru, urunAdi, urunFiyati, kdvOrani, urunAdedi, toplamUrunFiyati, kargoFirmasiSecimi, kargoUcreti, urunResmiBir, varyantBasligi, varyantSecimi, adresAdiSoyadi, adresDetay, adresTelefon, odemeSecimi, taksitSecimi, siparisTarihi, siparisIpAdresi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $siparisEkle->execute([$sepettekiUyeId, $sepetNumarasi, $sepettekiUrunId, $urununTuru, $urununAdi, $urunFiyatiHesapla, $urununKdvOrani, $sepettekiUrunAdedi, $urununToplamFiyati, $kargonunAdi, $urununToplamKargoFiyati, $urununResmi, $urununVaryantBasligi, $varyantAdi, $adresAdiSoyadi, $adresToparla, $adresTelefonNumarasi, $gelenOdemeTuruSecimi, 0, $zamanDamgasi, $IPAdresi]);
                    $eklemeKontrol = $siparisEkle->rowCount();

                    if($eklemeKontrol > 0){
                        $sepettenSilmeSorgusu = $db->prepare("DELETE FROM sepet WHERE id = ? AND uyeId = ? LIMIT 1");
                        $sepettenSilmeSorgusu->execute([$sepetIdsi, $sepettekiUyeId]);
                    }
                    else{
                        header("Location:index.php?sayfaKodu=102");
                        exit();
                    }
    
                }

                $kargoFiyatiIcinSiparislerSorgusu = $db->prepare("SELECT SUM(toplamUrunFiyati) AS toplamUcret FROM siparisler WHERE uyeId = ? AND siparisNumarasi = ?");
                $kargoFiyatiIcinSiparislerSorgusu->execute([$kullaniciId, $sepetNumarasi]);
                $kargoFiyatiKaydi                 = $kargoFiyatiIcinSiparislerSorgusu->fetch(PDO::FETCH_ASSOC);

                $toplamKargoUcretimiz             = $kargoFiyatiKaydi["toplamUcret"];

                if($toplamKargoUcretimiz >= $ucretsizKargoBaraji){
                    $siparisiGuncelle = $db->prepare("UPDATE siparisler SET kargoUcreti = ? WHERE uyeId = ? AND siparisNumarasi = ?");
                    $siparisiGuncelle->execute([0, $kullaniciId, $sepetNumarasi]);

                }

                header("Location:index.php?sayfaKodu=101");
                exit();
            }
            else{
                header("Location:index.php");
                exit();
            }

        }
        else{ // Kredi Kartı işlem yapılacaksa burası çalışır.
            if($gelenTaksitSecimi != ""){

            }
            else{
                header("Location:index.php");
                exit();
            }
        }

    }
    else{
        header("Location:index.php");
        exit();
    }

} else {
    header("Location:index.php");
    exit();
}
