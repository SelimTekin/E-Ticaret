<?php
if (isset($_SESSION["yonetici"])) {
    if (isset($_GET["id"])) {
        $gelenId = guvenlik($_GET["id"]);
    } else {
        $gelenId = "";
    }

    $urunlerSorgusu            = $db->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
    $urunlerSorgusu->execute([$gelenId]);
    $urunSayisi             = $urunlerSorgusu->rowCount();
    $urunBilgisi               = $urunlerSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($urunSayisi > 0) {
?>
        <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=100&id=<?php echo donusumleriGeriDondur($gelenId); ?>" method="post" enctype="multipart/form-data">
            <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="70">
                    <td width="560" bgcolor="#FF9900" style="color: #FFF" align="left">
                        <h3>&nbsp;ÜRÜNLER</h3>
                    </td>
                    <td width="200" colspan="2" bgcolor="#FF9900" align="right"><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=95" style="color: #FFF; text-decoration: none;">Yeni Ürün Ekle&nbsp;</a></td>
                </tr>
                <tr height="10">
                    <td colspan="2" style="font-size: 10px;">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">

                            <tr height="40">
                                <td width="230">Ürün Menüsü</td>
                                <td width="20">:</td>
                                <td width="500"><select name="urunMenusu" id="urunMenusu" class="selectAlanlari">
                                        <?php
                                        $menulerSorgusu = $db->prepare("SELECT * FROM menuler WHERE urunTuru = ? ORDER BY urunTuru ASC, menuAdi ASC");
                                        $menulerSorgusu->execute([donusumleriGeriDondur($urunBilgisi["urunTuru"])]);
                                        $menuSayisi     = $menulerSorgusu->rowCount();
                                        $menuKayitlari  = $menulerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($menuKayitlari as $menuKaydi) {
                                        ?>
                                            <option value="<?php echo donusumleriGeriDondur($menuKaydi["id"]); ?>" <?php if(donusumleriGeriDondur($urunBilgisi["menuId"]) == donusumleriGeriDondur($menuKaydi["id"])){ ?> selected="selected" <?php } ?>>(<?php echo donusumleriGeriDondur($menuKaydi["urunTuru"]); ?>) <?php echo donusumleriGeriDondur($menuKaydi["menuAdi"]); ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select></td>
                            </tr>

                            <tr height="40">
                                <td width="230">Ürün Adı</td>
                                <td width="20">:</td>
                                <td width="500"><input type="text" name="urunAdi" class="inputAlanlari" value="<?php echo donusumleriGeriDondur($urunBilgisi["urunTuru"]); ?>"></td>
                            </tr>

                            <tr height="40">
                                <td width="230">Ürün Fiyatı</td>
                                <td width="20">:</td>
                                <td width="500"><input type="text" name="urunFiyati" class="inputAlanlari" value="<?php echo donusumleriGeriDondur($urunBilgisi["urunFiyati"]); ?>"></td>
                            </tr>

                            <tr height="40">
                                <td width="230">Para Birimi</td>
                                <td width="20">:</td>
                                <td width="500"><select name="paraBirimi" id="paraBirimi" class="selectAlanlari">
                                        <option value="TRY" <?php if(donusumleriGeriDondur($urunBilgisi["paraBirimi"]) == "TRY"){ ?> selected="selected" <?php } ?>>Türk Lirası</option>
                                        <option value="USD" <?php if(donusumleriGeriDondur($urunBilgisi["paraBirimi"]) == "USD"){ ?> selected="selected" <?php } ?>>Amerikan Doları</option>
                                        <option value="EUR" <?php if(donusumleriGeriDondur($urunBilgisi["paraBirimi"]) == "EUR"){ ?> selected="selected" <?php } ?>>Euro</option>
                                    </select></td>
                            </tr>

                            <tr height="40">
                                <td width="230">KDV Oranı</td>
                                <td width="20">:</td>
                                <td width="500"><input type="text" name="kdvOrani" class="inputAlanlari" value="<?php echo donusumleriGeriDondur($urunBilgisi["kdvOrani"]); ?>"></td>
                            </tr>

                            <tr height="40">
                                <td width="230">Kargo Ücreti</td>
                                <td width="20">:</td>
                                <td width="500"><input type="text" name="kargoUcreti" class="inputAlanlari" value="<?php echo donusumleriGeriDondur($urunBilgisi["kargoUcreti"]); ?>"></td>
                            </tr>

                            <tr>
                                <td width="230" valign="top">Ürün Açıklaması</td>
                                <td width="20" valign="top">:</td>
                                <td width="500"><textarea name="urunAciklamasi" id="urunAciklamasi" cols="30" rows="10" class="textAreaAlanlari"><?php echo donusumleriGeriDondur($urunBilgisi["urunAciklamasi"]); ?></textarea></td>
                            </tr>

                            <tr height="40">
                                <td width="230">Ürün Resmi 1</td>
                                <td width="20">:</td>
                                <td width="500"><input type="file" name="resim1"></td>
                            </tr>
                            <tr height="40">
                                <td width="230">Ürün Resmi 2</td>
                                <td width="20">:</td>
                                <td width="500"><input type="file" name="resim2"></td>
                            </tr>
                            <tr height="40">
                                <td width="230">Ürün Resmi 3</td>
                                <td width="20">:</td>
                                <td width="500"><input type="file" name="resim3"></td>
                            </tr>
                            <tr height="40">
                                <td width="230">Ürün Resmi 4</td>
                                <td width="20">:</td>
                                <td width="500"><input type="file" name="resim4"></td>
                            </tr>

                            <tr height="40">
                                <td width="230">Varyant Başlığı</td>
                                <td width="20">:</td>
                                <td width="500"><input type="text" name="varyantBasligi" class="inputAlanlari" value="<?php echo donusumleriGeriDondur($urunBilgisi["varyantBasligi"]); ?>"></td>
                            </tr>

                            <?php
                                $varyantlarSorgusu            = $db->prepare("SELECT * FROM urunvaryantlari WHERE urunId = ?");
                                $varyantlarSorgusu->execute([$gelenId]);
                                $varyantSayisi             = $varyantlarSorgusu->rowCount();
                                $varyantBilgisi               = $varyantlarSorgusu->fetchAll(PDO::FETCH_ASSOC);

                                $varyantIsimDizisi = array();
                                $varyantStokDizisi = array();

                                foreach($varyantBilgisi as $varyant){
                                    $varyantIsimDizisi[] = $varyant["varyantAdi"];
                                    $varyantStokDizisi[] = $varyant["stokAdedi"];
                                }

                                if(array_key_exists(1, $varyantIsimDizisi)){
                                    $ikinciVaryantAdi = donusumleriGeriDondur($varyantIsimDizisi[1]);
                                    $ikinciVaryantStok = donusumleriGeriDondur($varyantStokDizisi[1]);
                                }else{
                                    $ikinciVaryantAdi = "";
                                    $ikinciVaryantStok = "";
                                }

                                if(array_key_exists(2, $varyantIsimDizisi)){
                                    $ucuncuVaryantAdi = donusumleriGeriDondur($varyantIsimDizisi[2]);
                                    $ucuncuVaryantStok = donusumleriGeriDondur($varyantStokDizisi[2]);
                                }else{
                                    $ucuncuVaryantAdi = "";
                                    $ucuncuVaryantStok = "";
                                }

                                if(array_key_exists(3, $varyantIsimDizisi)){
                                    $dorduncuVaryantAdi = donusumleriGeriDondur($varyantIsimDizisi[3]);
                                    $dorduncuVaryantStok = donusumleriGeriDondur($varyantStokDizisi[3]);
                                }else{
                                    $dorduncuVaryantAdi = "";
                                    $dorduncuVaryantStok = "";
                                }

                                if(array_key_exists(4, $varyantIsimDizisi)){
                                    $besinciVaryantAdi = donusumleriGeriDondur($varyantIsimDizisi[4]);
                                    $besinciVaryantStok = donusumleriGeriDondur($varyantStokDizisi[4]);
                                }else{
                                    $besinciVaryantAdi = "";
                                    $besinciVaryantStok = "";
                                }

                                if(array_key_exists(5, $varyantIsimDizisi)){
                                    $altinciVaryantAdi = donusumleriGeriDondur($varyantIsimDizisi[5]);
                                    $altinciVaryantStok = donusumleriGeriDondur($varyantStokDizisi[5]);
                                }else{
                                    $altinciVaryantAdi = "";
                                    $altinciVaryantStok = "";
                                }

                                if(array_key_exists(6, $varyantIsimDizisi)){
                                    $yedinciVaryantAdi = donusumleriGeriDondur($varyantIsimDizisi[6]);
                                    $yedinciVaryantStok = donusumleriGeriDondur($varyantStokDizisi[6]);
                                }else{
                                    $yedinciVaryantAdi = "";
                                    $yedinciVaryantStok = "";
                                }

                                if(array_key_exists(7, $varyantIsimDizisi)){
                                    $sekizinciVaryantAdi = donusumleriGeriDondur($varyantIsimDizisi[7]);
                                    $sekizinciVaryantStok = donusumleriGeriDondur($varyantStokDizisi[7]);
                                }else{
                                    $sekizinciVaryantAdi = "";
                                    $sekizinciVaryantStok = "";
                                }

                                if(array_key_exists(8, $varyantIsimDizisi)){
                                    $dokuzuncuVaryantAdi = donusumleriGeriDondur($varyantIsimDizisi[8]);
                                    $dokuzuncuVaryantStok = donusumleriGeriDondur($varyantStokDizisi[8]);
                                }else{
                                    $dokuzuncuVaryantAdi = "";
                                    $dokuzuncuVaryantStok = "";
                                }

                                if(array_key_exists(9, $varyantIsimDizisi)){
                                    $onuncuVaryantAdi = donusumleriGeriDondur($varyantIsimDizisi[9]);
                                    $onuncuVaryantStok = donusumleriGeriDondur($varyantStokDizisi[9]);
                                }else{
                                    $onuncuVaryantAdi = "";
                                    $onuncuVaryantStok = "";
                                }

                            ?>

                            <tr height="40">
                                <td colspan="3" align="left">
                                    <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="230">1. Varyant Adı</td>
                                            <td width="20">:</td>
                                            <td width="200"><input type="text" name="varyantAdi1" class="inputAlanlari" value="<?php echo donusumleriGeriDondur($varyantIsimDizisi[0]); ?>"></td>
                                            <td width="20">&nbsp;</td>
                                            <td width="178">1. Varyant Stok Adedi</td>
                                            <td width="20">:</td>
                                            <td width="60"><input type="text" name="stokAdedi1" class="inputAlanlari" value="<?php echo donusumleriGeriDondur($varyantStokDizisi[0]); ?>"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr height="40">
                                <td colspan="3" align="left">
                                    <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="230">2. Varyant Adı</td>
                                            <td width="20">:</td>
                                            <td width="200"><input type="text" name="varyantAdi2" class="inputAlanlari" value="<?php echo $ikinciVaryantAdi; ?>"></td>
                                            <td width="20">&nbsp;</td>
                                            <td width="178">2. Varyant Stok Adedi</td>
                                            <td width="20">:</td>
                                            <td width="60"><input type="text" name="stokAdedi2" class="inputAlanlari" value="<?php echo $ikinciVaryantStok; ?>"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr height="40">
                                <td colspan="3" align="left">
                                    <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="230">3. Varyant Adı</td>
                                            <td width="20">:</td>
                                            <td width="200"><input type="text" name="varyantAdi3" class="inputAlanlari" value="<?php echo $ucuncuVaryantAdi; ?>"></td>
                                            <td width="20">&nbsp;</td>
                                            <td width="178">3. Varyant Stok Adedi</td>
                                            <td width="20">:</td>
                                            <td width="60"><input type="text" name="stokAdedi3" class="inputAlanlari" value="<?php echo $ucuncuVaryantStok; ?>"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr height="40">
                                <td colspan="3" align="left">
                                    <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="230">4. Varyant Adı</td>
                                            <td width="20">:</td>
                                            <td width="200"><input type="text" name="varyantAdi4" class="inputAlanlari" value="<?php echo $dorduncuVaryantAdi; ?>"></td>
                                            <td width="20">&nbsp;</td>
                                            <td width="178">4. Varyant Stok Adedi</td>
                                            <td width="20">:</td>
                                            <td width="60"><input type="text" name="stokAdedi4" class="inputAlanlari" value="<?php echo $dorduncuVaryantStok; ?>"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr height="40">
                                <td colspan="3" align="left">
                                    <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="230">5. Varyant Adı</td>
                                            <td width="20">:</td>
                                            <td width="200"><input type="text" name="varyantAdi5" class="inputAlanlari" value="<?php echo $besinciVaryantAdi; ?>"></td>
                                            <td width="20">&nbsp;</td>
                                            <td width="178">5. Varyant Stok Adedi</td>
                                            <td width="20">:</td>
                                            <td width="60"><input type="text" name="stokAdedi5" class="inputAlanlari" value="<?php echo $besinciVaryantStok; ?>"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr height="40">
                                <td colspan="3" align="left">
                                    <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="230">6. Varyant Adı</td>
                                            <td width="20">:</td>
                                            <td width="200"><input type="text" name="varyantAdi6" class="inputAlanlari" value="<?php echo $altinciVaryantAdi; ?>"></td>
                                            <td width="20">&nbsp;</td>
                                            <td width="178">6. Varyant Stok Adedi</td>
                                            <td width="20">:</td>
                                            <td width="60"><input type="text" name="stokAdedi6" class="inputAlanlari" value="<?php echo $altinciVaryantStok; ?>"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr height="40">
                                <td colspan="3" align="left">
                                    <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="230">7. Varyant Adı</td>
                                            <td width="20">:</td>
                                            <td width="200"><input type="text" name="varyantAdi7" class="inputAlanlari" value="<?php echo $yedinciVaryantAdi; ?>"></td>
                                            <td width="20">&nbsp;</td>
                                            <td width="178">7. Varyant Stok Adedi</td>
                                            <td width="20">:</td>
                                            <td width="60"><input type="text" name="stokAdedi7" class="inputAlanlari" value="<?php echo $yedinciVaryantStok; ?>"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr height="40">
                                <td colspan="3" align="left">
                                    <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="230">8. Varyant Adı</td>
                                            <td width="20">:</td>
                                            <td width="200"><input type="text" name="varyantAdi8" class="inputAlanlari" value="<?php echo $sekizinciVaryantAdi; ?>"></td>
                                            <td width="20">&nbsp;</td>
                                            <td width="178">8. Varyant Stok Adedi</td>
                                            <td width="20">:</td>
                                            <td width="60"><input type="text" name="stokAdedi8" class="inputAlanlari" value="<?php echo $sekizinciVaryantStok; ?>"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr height="40">
                                <td colspan="3" align="left">
                                    <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="230">9. Varyant Adı</td>
                                            <td width="20">:</td>
                                            <td width="200"><input type="text" name="varyantAdi9" class="inputAlanlari" value="<?php echo $dokuzuncuVaryantAdi; ?>"></td>
                                            <td width="20">&nbsp;</td>
                                            <td width="178">9. Varyant Stok Adedi</td>
                                            <td width="20">:</td>
                                            <td width="60"><input type="text" name="stokAdedi9" class="inputAlanlari" value="<?php echo $dokuzuncuVaryantStok; ?>"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr height="40">
                                <td colspan="3" align="left">
                                    <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="230">10. Varyant Adı</td>
                                            <td width="20">:</td>
                                            <td width="200"><input type="text" name="varyantAdi10" class="inputAlanlari" value="<?php echo $onuncuVaryantAdi; ?>"></td>
                                            <td width="20">&nbsp;</td>
                                            <td width="178">10. Varyant Stok Adedi</td>
                                            <td width="20">:</td>
                                            <td width="60"><input type="text" name="stokAdedi10" class="inputAlanlari" value="<?php echo $onuncuVaryantStok; ?>"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr height="40">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td width="500"><input type="submit" value="Ürün Kaydet" class="maviButon"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
<?php
    } else {
        header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=102");
        exit();
    }
} else {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>