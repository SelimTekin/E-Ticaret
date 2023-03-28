<?php
if (isset($_SESSION["kullanici"])) {

    if (isset($_POST["adresSecimi"])) {
        $gelenAdresSecimi = guvenlik($_POST["adresSecimi"]);
    } else {
        $gelenAdresSecimi = "";
    }
    if (isset($_POST["kargoSecimi"])) {
        $gelenKargoSecimi = guvenlik($_POST["kargoSecimi"]);
    } else {
        $gelenKargoSecimi = "";
    }

    if (($gelenAdresSecimi != "") and ($gelenKargoSecimi != "")) {
        
        $sepetiGuncellemeSorgusu = $db->prepare("UPDATE sepet SET kargoId = ?, adresId = ? WHERE uyeId = ?");
        $sepetiGuncellemeSorgusu->execute([$gelenKargoSecimi, $gelenAdresSecimi, $kullaniciId]);
        $guncellemeKontrol       = $sepetiGuncellemeSorgusu->rowCount();

        $stokIcinSepettekiUrunlerSorgusu = $db->prepare("SELECT * FROM sepet WHERE uyeId = ?");
        $stokIcinSepettekiUrunlerSorgusu->execute([$kullaniciId]);
        $stokIcinSepettekiUrunSayisi     = $stokIcinSepettekiUrunlerSorgusu->rowCount();
        $stokIcinSepettekiKayitlar       = $stokIcinSepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($stokIcinSepettekiUrunSayisi > 0) {
            foreach ($stokIcinSepettekiKayitlar as $stokIcinSepettekiSatirlar) {
                $stokIcinSepetIdsi                  = $stokIcinSepettekiSatirlar["id"];
                $stokIcinSepettekiUrununVaryantIdsi = $stokIcinSepettekiSatirlar["varyantId"];
                $stokIcinSepettekiUrununAdedi       = $stokIcinSepettekiSatirlar["urunAdedi"];

                $stokIcinUrunVaryantBilgileriSorgusu = $db->prepare("SELECT * FROM urunVaryantlari WHERE id = ? LIMIT 1");
                $stokIcinUrunVaryantBilgileriSorgusu->execute([$stokIcinSepettekiUrununVaryantIdsi]);
                $stokIcinVaryantKaydi                = $stokIcinUrunVaryantBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                $stokIcinUrununStokAdedi = $stokIcinVaryantKaydi["stokAdedi"];

                if ($stokIcinUrununStokAdedi == 0) {
                    $sepetSilSorgusu = $db->prepare("DELETE FROM sepet WHERE id = ? AND uyeId = ? LIMIT 1");
                    $sepetSilSorgusu->execute([$stokIcinSepetIdsi, $kullaniciId]);
                } elseif ($stokIcinSepettekiUrununAdedi > $stokIcinUrununStokAdedi) {
                    $sepetGuncellemeSorgusu = $db->prepare("UPDATE sepet SET urunAdedi = ? WHERE id = ? AND uyeId = ? LIMIT 1");
                    $sepetGuncellemeSorgusu->execute([$stokIcinUrununStokAdedi, $stokIcinSepetIdsi, $kullaniciId]);
                }
            }
        }


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

            $ikiTaksitAylikOdemeTutari   = number_format(($sepettekiToplamFiyat / 2), "2", ",", ".");
            $ucTaksitAylikOdemeTutari    = number_format(($sepettekiToplamFiyat / 3), "2", ",", ".");
            $dortTaksitAylikOdemeTutari  = number_format(($sepettekiToplamFiyat / 4), "2", ",", ".");
            $besTaksitAylikOdemeTutari   = number_format(($sepettekiToplamFiyat / 5), "2", ",", ".");
            $altiTaksitAylikOdemeTutari  = number_format(($sepettekiToplamFiyat / 6), "2", ",", ".");
            $yediTaksitAylikOdemeTutari  = number_format(($sepettekiToplamFiyat / 7), "2", ",", ".");
            $sekizTaksitAylikOdemeTutari = number_format(($sepettekiToplamFiyat / 8), "2", ",", ".");
            $dokuzTaksitAylikOdemeTutari = number_format(($sepettekiToplamFiyat / 9), "2", ",", ".");
?>
            <form action="index.php?sayfaKodu=100" method="post">
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
                                    <td valign="30" style="border-bottom: 1px dashed #CCC;">Ödeme Türü Seçimini Aşağıdan Belirtebilirsin.</td>
                                </tr>
                                <tr height="10">
                                    <td style="font-size: 10px;">&nbsp;</td>
                                </tr>
                                <tr height="40">
                                    <td align="left" style="background: #CCC; font-weight: bold;">&nbsp;Ödeme Türü Seçimi</td>
                                </tr>
                                <tr height="10">
                                    <td style="font-size: 10px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="left">
                                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="25" align="left">
                                                    <table width="390" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCC; margin-bottom: 10px;">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><img src="resimler/KrediKarti92x75.png" alt="Kredi Kartı Resmi"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><input type="radio" name="odemeTuruSecimi" value="Kredi Kartı" checked="checked" onclick="$.krediKartiSecildi();"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td width="20">&nbsp;</td>
                                                <td width="390" align="left">
                                                    <table width="390" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCC; margin-bottom: 10px;">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><img src="resimler/Banka80x75.png" alt="Banka Resmi"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><input type="radio" name="odemeTuruSecimi" value="Banka Havalesi" onclick="$.bankaHavalesiSecildi();"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr height="10">
                                    <td style="font-size: 10px;">&nbsp;</td>
                                </tr>

                                <tr height="40" class="KKAlanlari">
                                    <td height="40" width="800" bgcolor="#CCC" align="left"><b>&nbsp;Kredi Kartı İle Ödeme</b></td>
                                </tr>
                                <tr height="10" class="KKAlanlari">
                                    <td style="font-size: 10px;">&nbsp;</td>
                                </tr>
                                <tr class="KKAlanlari">
                                    <td height="40" width="800" align="left">Ödeme işleminizde aşağıdaki tüm kredi kartı markaları ile veya diğer markalar ile veya ATM (Bankamatik) kartı ile işlem yapabilirsiniz.</td>
                                </tr>
                                <tr height="10" class="KKAlanlari">
                                    <td style="font-size: 10px;">&nbsp;</td>
                                </tr>
                                <tr class="KKAlanlari">
                                    <td>
                                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="192">
                                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCC; margin-bottom: 10px;">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><img src="resimler/OdemeSecimiAxessCard.png" alt="Kredi Kartı Resmi"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td width="11">&nbsp;</td>
                                                <td width="192">
                                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCC; margin-bottom: 10px;">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><img src="resimler/OdemeSecimiBonusCard.png" alt="Kredi Kartı Resmi"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td width="11">&nbsp;</td>
                                                <td width="192">
                                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCC; margin-bottom: 10px;">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><img src="resimler/OdemeSecimiCardFinans.png" alt="Kredi Kartı Resmi"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td width="10">&nbsp;</td>
                                                <td width="192">
                                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCC; margin-bottom: 10px;">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><img src="resimler/OdemeSecimiMaximumCard.png" alt="Kredi Kartı Resmi"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="192">
                                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCC; margin-bottom: 10px;">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><img src="resimler/OdemeSecimiWorldCard.png" alt="Kredi Kartı Resmi"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td width="11">&nbsp;</td>
                                                <td width="192">
                                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCC; margin-bottom: 10px;">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><img src="resimler/OdemeSecimiParafCard.png" alt="Kredi Kartı Resmi"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td width="11">&nbsp;</td>
                                                <td width="192">
                                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCC; margin-bottom: 10px;">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><img src="resimler/OdemeSecimiDigerKartlar.png" alt="Kredi Kartı Resmi"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td width="10">&nbsp;</td>
                                                <td width="192">
                                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCC; margin-bottom: 10px;">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><img src="resimler/OdemeSecimiATMKarti.png" alt="Kredi Kartı Resmi"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr height="40" class="KKAlanlari">
                                    <td height="40" width="800" align="left" style="background: #CCC; font-weight: bold;">&nbsp;Taksit Seçimi</td>
                                </tr>
                                <tr height="10" class="KKAlanlari">
                                    <td style="font-size: 10px;">&nbsp;</td>
                                </tr>
                                <tr class="KKAlanlari">
                                    <td align="left">Lütfen ödeme işleminde uygulanmasını istediğiniz taksit sayısını seçiniz.</td>
                                </tr>
                                <tr height="10" class="KKAlanlari">
                                    <td style="font-size: 10px;">&nbsp;</td>
                                </tr>
                                <tr height="30" class="KKAlanlari">
                                    <td>
                                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr height="30">
                                                <td width="25" align="left" style="border-bottom: 1px dashed #CCC;"><input type="radio" name="taksitSecimi" value="1" checked="checked"></td>
                                                <td width="275" align="left" style="border-bottom: 1px dashed #CCC;">Tek Çekim</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;">1 x <?php echo $odenecekToplamTutariBicimlendir; ?> TL</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;"><?php echo $odenecekToplamTutariBicimlendir; ?> TL</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr height="30" class="KKAlanlari">
                                    <td>
                                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr height="30">
                                                <td width="25" align="left" style="border-bottom: 1px dashed #CCC;"><input type="radio" name="taksitSecimi" value="2"></td>
                                                <td width="275" align="left" style="border-bottom: 1px dashed #CCC;">2 Taksit</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;">2 x <?php echo $ikiTaksitAylikOdemeTutari; ?> TL</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;"><?php echo $odenecekToplamTutariBicimlendir; ?> TL</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr height="30" class="KKAlanlari">
                                    <td>
                                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr height="30">
                                                <td width="25" align="left" style="border-bottom: 1px dashed #CCC;"><input type="radio" name="taksitSecimi" value="3"></td>
                                                <td width="275" align="left" style="border-bottom: 1px dashed #CCC;">3 Taksit</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;">3 x <?php echo $ucTaksitAylikOdemeTutari; ?> TL</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;"><?php echo $odenecekToplamTutariBicimlendir; ?> TL</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr height="30" class="KKAlanlari">
                                    <td>
                                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr height="30">
                                                <td width="25" align="left" style="border-bottom: 1px dashed #CCC;"><input type="radio" name="taksitSecimi" value="4"></td>
                                                <td width="275" align="left" style="border-bottom: 1px dashed #CCC;">4 Taksit</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;">4 x <?php echo $dortTaksitAylikOdemeTutari; ?> TL</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;"><?php echo $odenecekToplamTutariBicimlendir; ?> TL</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr height="30" class="KKAlanlari">
                                    <td>
                                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr height="30">
                                                <td width="25" align="left" style="border-bottom: 1px dashed #CCC;"><input type="radio" name="taksitSecimi" value="5"></td>
                                                <td width="275" align="left" style="border-bottom: 1px dashed #CCC;">5 Taksit</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;">5 x <?php echo $besTaksitAylikOdemeTutari; ?> TL</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;"><?php echo $odenecekToplamTutariBicimlendir; ?> TL</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr height="30" class="KKAlanlari">
                                    <td>
                                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr height="30">
                                                <td width="25" align="left" style="border-bottom: 1px dashed #CCC;"><input type="radio" name="taksitSecimi" value="6"></td>
                                                <td width="275" align="left" style="border-bottom: 1px dashed #CCC;">6 Taksit</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;">6 x <?php echo $altiTaksitAylikOdemeTutari; ?> TL</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;"><?php echo $odenecekToplamTutariBicimlendir; ?> TL</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr height="30" class="KKAlanlari">
                                    <td>
                                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr height="30">
                                                <td width="25" align="left" style="border-bottom: 1px dashed #CCC;"><input type="radio" name="taksitSecimi" value="7"></td>
                                                <td width="275" align="left" style="border-bottom: 1px dashed #CCC;">7 Taksit</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;">7 x <?php echo $yediTaksitAylikOdemeTutari; ?> TL</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;"><?php echo $odenecekToplamTutariBicimlendir; ?> TL</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr height="30" class="KKAlanlari">
                                    <td>
                                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr height="30">
                                                <td width="25" align="left" style="border-bottom: 1px dashed #CCC;"><input type="radio" name="taksitSecimi" value="8"></td>
                                                <td width="275" align="left" style="border-bottom: 1px dashed #CCC;">8 Taksit</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;">8 x <?php echo $sekizTaksitAylikOdemeTutari; ?> TL</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;"><?php echo $odenecekToplamTutariBicimlendir; ?> TL</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr height="30" class="KKAlanlari">
                                    <td>
                                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr height="30">
                                                <td width="25" align="left" style="border-bottom: 1px dashed #CCC;"><input type="radio" name="taksitSecimi" value="9"></td>
                                                <td width="275" align="left" style="border-bottom: 1px dashed #CCC;">9 Taksit</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;">9 x <?php echo $dokuzTaksitAylikOdemeTutari; ?> TL</td>
                                                <td width="200" align="right" style="border-bottom: 1px dashed #CCC;"><?php echo $odenecekToplamTutariBicimlendir; ?> TL</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr height="40" class="BHAlanlari" style="display: none;">
                                    <td height="40" width="800" align="left" style="background: #CCC; font-weight: bold;">&nbsp;Banka Havalesi / EFT İle Ödeme</td>
                                </tr>
                                <tr height="10" class="BHAlanlari" style="display: none;">
                                    <td style="font-size: 10px;">&nbsp;</td>
                                </tr>
                                <tr class="BHAlanlari" style="display: none;">
                                    <td align="left">Banka havalesi / EFT ile ürün satın alabilmek için, öndeclikle alışveriş sepeti tutarını "Banka Hesaplarımız" sayfasında bulunan herhangi bir hesaba ödeme yaptıktan sonra "Havale Bildirim Formu" aracılığı ile lütfen tarafımıza bilgi veriniz. "Ödeme Yap" butonuna tıkladığınız anda siparişiniz sisteme kayıt edilecektir.</td>
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
                                <tr>
                                    <td style="font-size: 10px;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td align="right">
                                        <input type="submit" value="ÖDEME YAP" class="alisverisiTamamlaButonu">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>

<?php
        }else{
            header("Location: index.php?sayfaKodu=94");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>