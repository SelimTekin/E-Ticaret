<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr height="100" bgcolor="#FF9900">
        <td align="left">
            <h2 style="color: white;">&nbsp;BANKA HESAPLARIMIZ</h2>
        </td>
    </tr>
    <tr height="50">
        <td align="left" style="border-bottom: 1px dashed #CCC;">Ödemeleriniz İçin Çalışmkata Olduğumuz Tüm Banka Hesap Bilgileri Aşağıdadır.</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>

            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <?php

                    $bankalarSorgusu = $db->prepare("SELECT * FROM bankahesaplarimiz");
                    $bankalarSorgusu->execute();
                    $bankaSayisi     = $bankalarSorgusu->rowCount();
                    $bankaKayitlari  = $bankalarSorgusu->fetchAll(PDO::FETCH_ASSOC);

                    $donguSayisi = 1;
                    $sutunAdetSayisi = 3;

                    foreach ($bankaKayitlari as $banka) {
                    ?>
                            <td width="348">
                                <table align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCC; margin-bottom: 10px;">
                                    <tr height="40">
                                        <td colspan="4" align="center"><img src="resimler/Banka20x20.png" alt="bankaIcon"></td>
                                    </tr>
                                    <tr height="25">
                                        <td width="5">&nbsp;</td>
                                        <td width="80"><b>Banka Adı</b></td>
                                        <td width="10"><b>:</b></td>
                                        <td width="253"><?php echo donusumleriGeriDondur($banka["bankaAdi"]); ?></td>
                                    </tr>
                                    <tr height="25">
                                        <td width="5">&nbsp;</td>
                                        <td><b>Konum</b></td>
                                        <td><b>:</b></td>
                                        <td><?php echo donusumleriGeriDondur($banka["konumSehir"]); ?> / <?php echo donusumleriGeriDondur($banka["konumUlke"]); ?></td>
                                    </tr>
                                    <tr height="25">
                                        <td width="5">&nbsp;</td>
                                        <td><b>Şube</b></td>
                                        <td><b>:</b></td>
                                        <td><?php echo donusumleriGeriDondur($banka["subeAdi"]); ?> / <?php echo donusumleriGeriDondur($banka["subeKodu"]); ?></td>
                                    </tr>
                                    <tr height="25">
                                        <td width="5">&nbsp;</td>
                                        <td><b>Birim</b></td>
                                        <td><b>:</b></td>
                                        <td><?php echo donusumleriGeriDondur($banka["paraBirimi"]); ?></td>
                                    </tr>
                                    <tr height="25">
                                        <td width="5">&nbsp;</td>
                                        <td><b>Hesap Adı</b></td>
                                        <td><b>:</b></td>
                                        <td><?php echo donusumleriGeriDondur($banka["hesapSahibi"]); ?></td>
                                    </tr>
                                    <tr height="25">
                                        <td width="5">&nbsp;</td>
                                        <td><b>Hesap No</b></td>
                                        <td><b>:</b></td>
                                        <td><?php echo donusumleriGeriDondur($banka["hesapNumarasi"]); ?></td>
                                    </tr>
                                    <tr height="25">
                                        <td width="5">&nbsp;</td>
                                        <td><b>IBAN No</b></td>
                                        <td><b>:</b></td>
                                        <td><?php echo IBANBicimlendir(donusumleriGeriDondur($banka["ibanNumarasi"])); ?></td>
                                    </tr>
                                </table>
                            </td>
                            <?php
                            if($donguSayisi < $sutunAdetSayisi){
                            ?>
                                <td width="10">&nbsp;</td>
                        <?php 
                            }
                        $donguSayisi++;
                        if($donguSayisi > $sutunAdetSayisi){
                            echo "<tr></tr>";
                            $donguSayisi = 1;
                        }

                    }
                    ?>

            </tr>
            </table>

        </td>
    </tr>
</table>