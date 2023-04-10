<?php
if (isset($_SESSION["yonetici"])) {
?>
    <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=96" method="post" enctype="multipart/form-data">
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
                                    <option value="">Lütfen Seçiniz</option>

                                    <?php
                                    $menulerSorgusu = $db->prepare("SELECT * FROM menuler ORDER BY urunTuru ASC, menuAdi ASC");
                                    $menulerSorgusu->execute();
                                    $menuSayisi     = $menulerSorgusu->rowCount();
                                    $menuKayitlari  = $menulerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($menuKayitlari as $menuKaydi) {
                                    ?>
                                        <option value="<?php echo donusumleriGeriDondur($menuKaydi["id"]); ?>">(<?php echo donusumleriGeriDondur($menuKaydi["urunTuru"]); ?>) <?php echo donusumleriGeriDondur($menuKaydi["menuAdi"]); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select></td>
                        </tr>

                        <tr height="40">
                            <td width="230">Ürün Adı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="urunAdi" class="inputAlanlari"></td>
                        </tr>

                        <tr height="40">
                            <td width="230">Ürün Fiyatı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="urunFiyati" class="inputAlanlari"></td>
                        </tr>

                        <tr height="40">
                            <td width="230">Para Birimi</td>
                            <td width="20">:</td>
                            <td width="500"><select name="paraBirimi" id="paraBirimi" class="selectAlanlari">
                                    <option value="">Lütfen Seçiniz</option>
                                    <option value="TRY">Türk Lirası</option>
                                    <option value="USD">Amerikan Doları</option>
                                    <option value="EUR">Euro</option>
                                </select></td>
                        </tr>

                        <tr height="40">
                            <td width="230">KDV Oranı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="kdvOrani" class="inputAlanlari"></td>
                        </tr>

                        <tr height="40">
                            <td width="230">Kargo Ücreti</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="kargoUcreti" class="inputAlanlari"></td>
                        </tr>

                        <tr>
                            <td width="230" valign="top">Ürün Açıklaması</td>
                            <td width="20" valign="top">:</td>
                            <td width="500"><textarea name="urunAciklamasi" id="urunAciklamasi" cols="30" rows="10" class="textAreaAlanlari"></textarea></td>
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
                            <td width="500"><input type="text" name="varyantBasligi" class="inputAlanlari"></td>
                        </tr>

                        <tr height="40">
                            <td colspan="3" align="left">
                                <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="230">1. Varyant Adı</td>
                                        <td width="20">:</td>
                                        <td width="200"><input type="text" name="varyantAdi1" class="inputAlanlari"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">1. Varyant Stok Adedi</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="stokAdedi1" class="inputAlanlari"></td>
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
                                        <td width="200"><input type="text" name="varyantAdi2" class="inputAlanlari"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">2. Varyant Stok Adedi</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="stokAdedi2" class="inputAlanlari"></td>
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
                                        <td width="200"><input type="text" name="varyantAdi3" class="inputAlanlari"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">3. Varyant Stok Adedi</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="stokAdedi3" class="inputAlanlari"></td>
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
                                        <td width="200"><input type="text" name="varyantAdi4" class="inputAlanlari"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">4. Varyant Stok Adedi</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="stokAdedi4" class="inputAlanlari"></td>
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
                                        <td width="200"><input type="text" name="varyantAdi5" class="inputAlanlari"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">5. Varyant Stok Adedi</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="stokAdedi5" class="inputAlanlari"></td>
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
                                        <td width="200"><input type="text" name="varyantAdi6" class="inputAlanlari"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">6. Varyant Stok Adedi</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="stokAdedi6" class="inputAlanlari"></td>
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
                                        <td width="200"><input type="text" name="varyantAdi7" class="inputAlanlari"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">7. Varyant Stok Adedi</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="stokAdedi7" class="inputAlanlari"></td>
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
                                        <td width="200"><input type="text" name="varyantAdi8" class="inputAlanlari"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">8. Varyant Stok Adedi</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="stokAdedi8" class="inputAlanlari"></td>
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
                                        <td width="200"><input type="text" name="varyantAdi9" class="inputAlanlari"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">9. Varyant Stok Adedi</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="stokAdedi9" class="inputAlanlari"></td>
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
                                        <td width="200"><input type="text" name="varyantAdi10" class="inputAlanlari"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">10. Varyant Stok Adedi</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="stokAdedi10" class="inputAlanlari"></td>
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
    header("Location: index.php?sayfaKoduDis=1");
    exit();
}
?>