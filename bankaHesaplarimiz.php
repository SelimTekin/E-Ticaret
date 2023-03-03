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
                            <td width="340">
                                <table align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCC;">
                                    <tr height="40">
                                        <td colspan="4" align="center"><img src="resimler/Banka20x20.png" alt="bankaIcon"></td>
                                    </tr>
                                    <tr height="25">
                                        <td width="5">&nbsp;</td>
                                        <td width="80">Banka Adı</td>
                                        <td width="10">:</td>
                                        <td width="245">Ziraat Bankası</td>
                                    </tr>
                                    <tr height="25">
                                        <td width="5">&nbsp;</td>
                                        <td>Konum</td>
                                        <td>:</td>
                                        <td>İstanbul / Türkiye</td>
                                    </tr>
                                    <tr height="25">
                                        <td width="5">&nbsp;</td>
                                        <td>Şube</td>
                                        <td>:</td>
                                        <td>Fındıkzade / 1234</td>
                                    </tr>
                                    <tr height="25">
                                        <td width="5">&nbsp;</td>
                                        <td>Birim</td>
                                        <td>:</td>
                                        <td>Türk Lirası</td>
                                    </tr>
                                    <tr height="25">
                                        <td width="5">&nbsp;</td>
                                        <td>Hesap Adı</td>
                                        <td>:</td>
                                        <td>Selim Tekin</td>
                                    </tr>
                                    <tr height="25">
                                        <td width="5">&nbsp;</td>
                                        <td>Hesap No</td>
                                        <td>:</td>
                                        <td>1234567890</td>
                                    </tr>
                                    <tr height="25">
                                        <td width="5">&nbsp;</td>
                                        <td>IBAN No</td>
                                        <td>:</td>
                                        <td>TR000000000000000000000000</td>
                                    </tr>
                                </table>
                            </td>

                            <td width="20">&nbsp;</td>
                        
                        <?php

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