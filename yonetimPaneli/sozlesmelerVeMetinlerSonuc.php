<?php
if (isset($_SESSION["yonetici"])) {

    if (isset($_POST["hakkimizdaMetni"])) {
        $gelenHakkimizdaMetni = guvenlik($_POST["hakkimizdaMetni"]);
    } else {
        $gelenHakkimizdaMetni = "";
    }
    if (isset($_POST["uyelikSozlesmesiMetni"])) {
        $gelenUyelikSozlesmesiMetni = guvenlik($_POST["uyelikSozlesmesiMetni"]);
    } else {
        $gelenUyelikSozlesmesiMetni = "";
    }
    if (isset($_POST["kullanimKosullariMetni"])) {
        $gelenKullanimKosullariMetni = guvenlik($_POST["kullanimKosullariMetni"]);
    } else {
        $gelenKullanimKosullariMetni = "";
    }
    if (isset($_POST["gizlilikSozlesmesiMetni"])) {
        $gelenGizlilikSozlesmesiMetni = guvenlik($_POST["gizlilikSozlesmesiMetni"]);
    } else {
        $gelenGizlilikSozlesmesiMetni = "";
    }
    if (isset($_POST["mesafeliSatisSozlesmesiMetni"])) {
        $gelenMesafeliSatisSozlesmesiMetni = guvenlik($_POST["mesafeliSatisSozlesmesiMetni"]);
    } else {
        $gelenMesafeliSatisSozlesmesiMetni = "";
    }
    if (isset($_POST["teslimatMetni"])) {
        $gelenTeslimatMetni = guvenlik($_POST["teslimatMetni"]);
    } else {
        $gelenTeslimatMetni = "";
    }
    if (isset($_POST["iptalIadeDegisimMetni"])) {
        $gelenIptalIadeDegisimMetni = guvenlik($_POST["iptalIadeDegisimMetni"]);
    } else {
        $gelenIptalIadeDegisimMetni = "";
    }


    if (($gelenHakkimizdaMetni!="") and ($gelenUyelikSozlesmesiMetni!="") and ($gelenKullanimKosullariMetni!="") and ($gelenGizlilikSozlesmesiMetni!="") and ($gelenMesafeliSatisSozlesmesiMetni!="") and ($gelenTeslimatMetni!="") and ($gelenIptalIadeDegisimMetni!="")) {

        $metinleriGuncelle            = $db->prepare("UPDATE sozlesmelervemetinler SET hakkimizdaMetni = ?, uyelikSozlesmesiMetni = ?, kullanimKosullariMetni = ?, gizlilikSozlesmesiMetni = ?, mesafeliSatisSozlesmesiMetni = ?, teslimatMetni = ?, iptalIadeDegisimMetni = ?");
        $metinleriGuncelle->execute([$gelenHakkimizdaMetni, $gelenUyelikSozlesmesiMetni, $gelenKullanimKosullariMetni, $gelenGizlilikSozlesmesiMetni, $gelenMesafeliSatisSozlesmesiMetni, $gelenTeslimatMetni, $gelenIptalIadeDegisimMetni]);

        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=7");
        exit();

    } else {
        header("Location: index.php?sayfaKoduDis=1&sayfaKoduIc=8");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>