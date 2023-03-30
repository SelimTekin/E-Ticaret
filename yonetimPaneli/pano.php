<?php
if (isset($_SESSION["yonetici"])) {
?>
DASHBOARD / PANO SAYFASI
<?php
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>