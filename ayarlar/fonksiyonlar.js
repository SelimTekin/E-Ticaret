$(document).ready(function(){

    $.soruIcerigiGoster = function(elemanIdsi){
        
        var soruIdsi      = elemanIdsi;
        var islenecekAlan = "#" + elemanIdsi;

        // $(".sorununCevapAlani").slideUp();                                  // Açılan alanı yavaşça yukarı kaldırır (kapatınca tekrar açıyor)
        $(islenecekAlan).parent().find(".sorununCevapAlani").slideToggle(); // açıksa kapatır, kapalıysa açar

    }

    $.urunDetayResmiDegistir = function(klasor, resimDegeri){
        var resimIcinDosyaYolu = "resimler/UrunResimleri/" + klasor + "/" + resimDegeri;
        $("#buyukResim").attr("src", resimIcinDosyaYolu); // id'si buyukResim olan etiket için src attribute'u oluşturduk ve içeriğini 2. paramtrede verdik. (Zaten src vardı lakin burada içeriğini değiştirmek için böyle yaptık)
    }

});