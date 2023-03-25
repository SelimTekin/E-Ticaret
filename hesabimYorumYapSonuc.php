<?php

if (isset($_SESSION["kullanici"])) {

    if (isset($_GET["urunId"])) {
        $gelenUrunId = guvenlik($_GET["urunId"]);
    } else {
        $gelenUrunId = "";
    }

    if (isset($_POST["puan"])) {
        $gelenPuan = guvenlik($_POST["puan"]);
    } else {
        $gelenPuan = "";
    }

    if (isset($_POST["yorum"])) {
        $gelenYorum = guvenlik($_POST["yorum"]);
    } else {
        $gelenYorum = "";
    }

    if (($gelenUrunId != "") and ($gelenPuan != "") and ($gelenYorum != "")) {

        $yorumKayitSorgusu = $db->prepare("INSERT INTO yorumlar (urunId, uyeId, puan, yorumMetni, yorumTarihi, yorumIpAdresi) VALUES (?, ?, ?, ?, ?, ?)");
        $yorumKayitSorgusu->execute([$gelenUrunId, $kullaniciId, $gelenPuan, $gelenYorum, $zamanDamgasi, $IPAdresi]);
        $yorumKayitKontrol      = $yorumKayitSorgusu->rowCount();

        if($yorumKayitKontrol > 0){

            $urunGuncellemeSorgusu = $db->prepare("UPDATE urunler SET yorumSayisi=yorumSayisi+1, toplamYorumPuani=toplamYorumPuani+? WHERE id = ? LIMIT 1");
            $urunGuncellemeSorgusu->execute([$gelenPuan, $gelenUrunId]);
            $urunGuncellemeKontrol      = $urunGuncellemeSorgusu->rowCount();

            if($urunGuncellemeKontrol > 0){
                header("Location:index.php?sayfaKodu=77");
                exit();
            }
            else{
                header("Location:index.php?sayfaKodu=78");
                exit();
            }

        }
        else{
            header("Location:index.php?sayfaKodu=78");
            exit();
        }
    } else {
        header("Location:index.php?sayfaKodu=79");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
