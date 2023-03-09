<form action="index.php?sayfaKodu=15" method="post">
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="50" bgcolor="#FF9900">
            <td align="left"><h2 style="color: white;">&nbsp;SIK SORULAN SORULAR</h2></td>
        </tr>
        <tr height="50">
            <td align="left" style="border-bottom: 1px dashed #CCC;">Aklınıza takılabileceğini düşündüğümüz soruların ceavplarını bu sayfada cevapladık. Fakat farklı bir sorunuz varsa lütfen iletişim alanından bize iletiniz.</td>
        </tr>

        <tr>
            <td>
                <?php
                $soruSorgusu   = $db->prepare("SELECT * FROM sorular");
                $soruSorgusu->execute();
                $soruSayisi    = $soruSorgusu->rowCount();
                $soruKayitlari = $soruSorgusu->fetchAll(PDO::FETCH_ASSOC);

                foreach($soruKayitlari as $soru){
                ?>
                <div>
                    <div id="<?php echo $soru["id"]; ?>" class="sorununBaslikAlani" onclick="$.soruIcerigiGoster(<?php echo $soru['id']; ?>)"><?php echo $soru["soru"]; ?></div>
                    <div class="sorununCevapAlani" style="display:none;"><?php echo $soru["cevap"]; ?></div>
                </div>
                <?php 
                } ?>
            </td>
        </tr>
    </table>
</form>