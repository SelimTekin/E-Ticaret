<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="500"  valign="top">
            <form action="index.php?sayfaKodu=10" method="post">
                <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color: #FF9900;"><h3>Havale Bildirim Formu</h3></td>
                    </tr>
                    <tr height="40">
                        <td valign="30" style="border-bottom: 1px dashed #CCC;">Tamamlanmış Olan Ödeme İşleminizi Aşağıdaki Formdan İletiniz.</td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">İsim Soyisim (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="isimSoyisim" class="inputAlanlari"></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">E-Mail Adresi (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="mail" name="emailAdresi" class="inputAlanlari"></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">Telefon Numarası (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="telefonNumarasi" class="inputAlanlari" maxlength="11"></td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">Ödeme Yapılan Banka (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left">
                            <select name="bankaSecimi" class="selectAlanlari">
                                <?php
                                $bankalarSorgusu = $db->prepare("SELECT * FROM bankahesaplarimiz ORDER BY bankaAdi ASC");
                                $bankalarSorgusu->execute();
                                $bankaSayisi     = $bankalarSorgusu->rowCount();
                                $bankalar        = $bankalarSorgusu->fetchAll(PDO::FETCH_ASSOC);

                                foreach($bankalar as $banka){
                                ?>
                                <option value="<?php echo $banka["id"]; ?>"><?php echo donusumleriGeriDondur($banka["bankaAdi"]); ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                    <tr height="30">
                        <td valign="bottom" align="left">Açıklama</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><textarea name="aciklama" cols="30" rows="10" class="textAreaAlanlari"></textarea></td>
                    </tr>

                    <tr height="40">
                        <td align="center"><input type="submit" value="Bildirimi Gönder" class="maviButon"></td>
                    </tr>

                </table>
            </form>
        </td>

        <td width="20">&nbsp;</td>

        <td width="545" valign="top">
            <table width="545" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="40">
                    <td colspan="2" style="color: #FF9900;"><h3>İşleyiş</h3></td>
                </tr>
                <tr height="40">
                    <td colspan="2" valign="30" style="border-bottom: 1px dashed #CCC;">Havale / EFT İşlemlerinin Kontrolü.</td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size: 5px;">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td align="left" width="30"><img src="resimler/Banka20x20.png" alt="bankaIcon" border="0" style="margin-top: 3px;"></td>
                    <td align="left"><b>Havale / EFT İşlemi</b></td>
                </tr>
                <tr height="30">
                    <td colspan="2" align="left">Müşteri tarafından öncelikle banka hesaplarımız sayfasında bulunan herhangi bir hesaba ödeme işlemi gerçekleştirilir.</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td align="left" width="30"><img src="resimler/DokumanKirmiziKalemli20x20.png" alt="bankaIcon" border="0" style="margin-top: 3px;"></td>
                    <td align="left"><b>Bildirim İşlemi</b></td>
                </tr>
                <tr height="30">
                    <td colspan="2" align="left">Ödeme işlemi tamamlandıktan sonra "Havale Bildirim Formu" sayfasından müşteri yapmış olduğu ödeme için bildirim formunu doldurarak online olarak gönderir.</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td align="left" width="30"><img src="resimler/CarklarSiyah20x20.png" alt="bankaIcon" border="0" style="margin-top: 3px;"></td>
                    <td align="left"><b>Kontroller</b></td>
                </tr>
                <tr height="30">
                    <td colspan="2" align="left">"Havale Bildirim Formu"'nuz tarafımıza ulaştığı anda ilgili departman tarafından yapmış olduğunuz havale / EFT işlemi ile ilgili banka üzerinden kontrol edilir.</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td align="left" width="30"><img src="resimler/InsanlarSiyah20x20.png" alt="bankaIcon" border="0" style="margin-top: 3px;"></td>
                    <td align="left"><b>Onay / Red</b></td>
                </tr>
                <tr height="30">
                    <td colspan="2" align="left">Havale bildirimi geçerli ise yani ödeme hesaba geçmiş ise, yönetici ilgili ödeme onayını vererek, siparişiniz teslimat birimine iletilir.</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td align="left" width="30"><img src="resimler/SaatEsnetikGri20x20.png" alt="bankaIcon" border="0" style="margin-top: 3px;"></td>
                    <td align="left"><b>Sipariş Hazırlama & Teslimat</b></td>
                </tr>
                <tr height="30">
                    <td colspan="2" align="left">Yönetici ödeme onayından sonra sayfamız üzerinden vermiş olduğunuz sipariş en kısa sürede hazırlanarak kargoya teslim edilir ve tarafınız ulaştırılır.</td>
                </tr>
            </table>
        </td>
    </tr>
</table>