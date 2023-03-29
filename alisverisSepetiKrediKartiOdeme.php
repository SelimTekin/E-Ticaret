<?php
if (isset($_SESSION["kullanici"])) {

    $sepettekiUrunlerSorgusu = $db->prepare("SELECT * FROM sepet WHERE uyeId = ? ORDER BY id DESC");
    $sepettekiUrunlerSorgusu->execute([$kullaniciId]);
    $sepettekiUrunSayisi  = $sepettekiUrunlerSorgusu->rowCount();
    $sepettekiKayitlar       = $sepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

    if ($sepettekiUrunSayisi > 0) {
        $sepettekiToplamUrunSayisi         = 0;
        $sepettekiToplamFiyat              = 0;
        $sepettekiToplamKargoFiyati        = 0;
        $sepettekiToplamKargoFiyatiHesapla = 0;
        $odenecekToplamTutariHesapla       = 0;

        foreach ($sepettekiKayitlar as $sepetSatirlari) {
            $sepetIdsi                  = $sepetSatirlari["id"];
            $sepetNumarasi              = $sepetSatirlari["sepetNumarasi"];
            $sepettekiUrununIdsi        = $sepetSatirlari["urunId"];
            $sepettekiUrununVaryantIdsi = $sepetSatirlari["varyantId"];
            $sepettekiUrununAdedi       = $sepetSatirlari["urunAdedi"];

            $urunBilgileriSorgusu = $db->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
            $urunBilgileriSorgusu->execute([$sepettekiUrununIdsi]);
            $urunKaydi            = $urunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

            $urununFiyati         = $urunKaydi["urunFiyati"];
            $urununParaBirimi     = $urunKaydi["paraBirimi"];
            $urununKargoUcreti    = $urunKaydi["kargoUcreti"];

            if ($urununParaBirimi == "USD") {
                $urunFiyatiHesapla           = ($urununFiyati * $dolarKuru);
                $urunFiyatiBicimlendir       = fiyatBicimlendir($urunFiyatiHesapla);
            } elseif ($urununParaBirimi == "EUR") {
                $urunFiyatiHesapla     = ($urununFiyati * $euroKuru);
                $urunFiyatiBicimlendir = fiyatBicimlendir($urunFiyatiHesapla);
            } else {
                $urunFiyatiHesapla     = $urununFiyati;
                $urunFiyatiBicimlendir = fiyatBicimlendir($urunFiyatiHesapla);
            }

            $urunToplamFiyatiHesapla     = ($urunFiyatiHesapla * $sepettekiUrununAdedi);
            $urunToplamFiyatiBicimlendir = fiyatBicimlendir($urunToplamFiyatiHesapla);

            $sepettekiToplamUrunSayisi += $sepettekiUrununAdedi;
            $sepettekiToplamFiyat      += $urunFiyatiHesapla * $sepettekiUrununAdedi;

            $sepettekiToplamKargoFiyatiHesapla     += ($urununKargoUcreti * $sepettekiUrununAdedi);
            $sepettekiToplamKargoFiyatiBicimlendir = fiyatBicimlendir($sepettekiToplamKargoFiyatiHesapla);
        }

        if ($sepettekiToplamFiyat >= $ucretsizKargoBaraji) {
            $sepettekiToplamKargoFiyatiHesapla     = 0;
            $sepettekiToplamKargoFiyatiBicimlendir = fiyatBicimlendir($sepettekiToplamKargoFiyatiHesapla);

            $odenecekToplamTutariBicimlendir = fiyatBicimlendir($sepettekiToplamFiyat);
        } else {
            $odenecekToplamTutariHesapla     += ($sepettekiToplamFiyat + $sepettekiToplamKargoFiyatiHesapla);
            $odenecekToplamTutariBicimlendir = fiyatBicimlendir($odenecekToplamTutariHesapla);
        }

        $clientId        =    donusumleriGeriDondur($clientId);    //	Bankadan Sanal Pos Onaylanınca Bankanın Verdiği İşyeri Numarası
        $amount            =    $odenecekToplamTutariHesapla;    //	Sepet Ücreti yada İşlem Tutarı yada Karttan Çekilecek Tutar
        $oid            =    $sepetNumarasi;    //	Sipariş Numarası (Tekrarlanmayan Bir Değer) (Örneğin Sepet Tablosundaki IDyi Kullanabilirsiniz) (Her İşlemde Değişmeli ve Asla Tekrarlanmamalı)
        $okUrl            =    "http://www.selimtekin.com/alisverisSepetiKrediKartiOdemeSonucTamam.php";    //	Ödeme İşlemi Başarıyla Gerçekleşir ise Dönülecek Sayfa
        $failUrl        =    "http://www.selimtekin.com/alisverisSepetiKrediKartiOdemeSonucHata.php";    //	Ödeme İşlemi Red Olur ise Dönülecek Sayfa
        $rnd            =    @microtime();
        $storekey        =    donusumleriGeriDondur($storeKey);    // Sanal Pos Onaylandığında Bankanın Size Verdiği Sanal Pos Ekranına Girerek Oluşturulacak Olan İş Yeri Anahtarı
        $storetype        =    "3d";    //	3D Modeli
        $hashstr        =    $clientId . $oid . $amount . $okUrl . $failUrl . $rnd . $storekey;    // Bankanın Kendi Ayarladığı Hash Parametresi
        $hash            =    @base64_encode(@pack('H*', @sha1($hashstr)));    // Bankanın Kendi Ayarladığı Hash Şifreleme Parametresi
        $description    =    "Ürün Satışı";    //	Extra Bir Açıklama Yazmak İsterseniz Çekim İle İlgili Buraya Yazıyoruz
        $xid            =    "";        //	20 bytelik, 28 Karakterli base64 Olarak Boş Bırılınca Sistem Tarafindan Ototmatik Üretilir. Lütfen Boş Bırakın
        $lang            =    "";        //	Çekim Gösterim Dili Default Türkçedir. Ayarlamak İsterseniz Türkçe (tr), İngilizce (en) Girilmelidir. Boş Bırakılırsa (tr) Kabu Edilmiş Olur.
        $email            =    "";    //	İsterseniz Çekimi Yapan Kullanıcınızın E-Mail Adresini Gönderebilirsiniz
        $userid            =    "";    //	İsterseniz Çekimi Yapan Kullanıcınızın Idsini Gönderebilirsiniz
?>
        <form method="post" action="https://<sunucu_adresi>/<3dgate_path>"> <!-- Bu Adres Banka veya EST Firması Tarafından Verilir -->
            <input type="hidden" name="clientid" value="<?= $clientId ?>" />
            <input type="hidden" name="amount" value="<?= $amount ?>" />
            <input type="hidden" name="oid" value="<?= $oid ?>" />
            <input type="hidden" name="okUrl" value="<?= $okUrl ?>" />
            <input type="hidden" name="failUrl" value="<?= $failUrl ?>" />
            <input type="hidden" name="rnd" value="<?= $rnd ?>" />
            <input type="hidden" name="hash" value="<?= $hash ?>" />
            <input type="hidden" name="storetype" value="3d" />
            <input type="hidden" name="lang" value="tr" />
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="500" valign="top">
                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr height="40">
                                <td style="color: #FF9900;">
                                    <h3>Alışveriş Sepeti</h3>
                                </td>
                            </tr>
                            <tr height="40">
                                <td valign="30" style="border-bottom: 1px dashed #CCC;">Kredi Kartı Bilgilerini Aşağıdan Belirtebilir ve Ödeme Yapabilirsin.</td>
                            </tr>
                            <tr height="10">
                                <td style="font-size: 10px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                        <tr height="40">
                                            <td width="250">Kredi Kart Numarası</td>
                                            <td colspan="4" width="550"><input type="text" name="pan" class="inputAlanlari" />
                                        </tr>
                                        <tr height="40">
                                            <td>Son Kullanma Tarihi</td>
                                            <td width="100"><select name="Ecom_Payment_Card_ExpDate_Month" class="selectAlanlari">
                                                    <option value=""></option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select></td>
                                            <td width="20" align="center"> - </td>
                                            <td width="100"><select name="Ecom_Payment_Card_ExpDate_Year" class="selectAlanlari">
                                                    <option value=""></option>
                                                    <option value="2013">2013</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                </select></td>
                                            <td width="330"></td>
                                        </tr>
                                        <tr height="40">
                                            <td>Kart Türü</td>
                                            <td colspan="4"><input type="radio" value="1" name="cardType"> Visa <input type="radio" value="2" name="cardType"> MasterCard</td>
                                        </tr>
                                        <tr height="40">
                                            <td>Güvenlik Kodu</td>
                                            <td width="100"><input type="text" name="cv2" size="4" value="" class="inputAlanlari" /></td>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr height="40">
                                            <td align="center">&nbsp;</td>
                                            <td colspan="4" align="left"><input type="submit" value="Ödeme Yap" class="maviButon" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>

                    <td width="15">&nbsp;</td>

                    <td width="250" valign="top">
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr height="40">
                                <td style="color: #FF9900;" align="center">
                                    <h3>Sipariş Özeti</h3>
                                </td>
                            </tr>
                            <tr height="40">
                                <td valign="30" style="border-bottom: 1px dashed #CCC;" align="center">Toplam <b style="color: red;"><?php echo $sepettekiToplamUrunSayisi; ?></b> Adet Ürün</td>
                            </tr>
                            <tr height="5">
                                <td height="5" style="font-size: 5px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right">Ödenecek Tutar (KDV Dahil)</td>
                            </tr>
                            <tr>
                                <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $odenecekToplamTutariBicimlendir; ?> TL</td>
                            </tr>
                            <tr>
                                <td style="font-size: 10px;">&nbsp;</td>
                            </tr>

                            <tr>
                                <td align="right">Ürünler Toplam Tutarı (KDV Dahil)</td>
                            </tr>
                            <tr>
                                <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo fiyatBicimlendir($sepettekiToplamFiyat); ?> TL</td>
                            </tr>
                            <tr>
                                <td style="font-size: 10px;">&nbsp;</td>
                            </tr>

                            <tr>
                                <td align="right">Kargo Tutarı (KDV Dahil)</td>
                            </tr>
                            <tr>
                                <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $sepettekiToplamKargoFiyatiBicimlendir; ?> TL</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
<?php
    }
    else{
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>