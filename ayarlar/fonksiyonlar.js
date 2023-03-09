$(document).ready(function(){

    $.soruIcerigiGoster = function(elemanIdsi){
        
        var soruIdsi      = elemanIdsi;
        var islenecekAlan = "#" + elemanIdsi;

        // $(".sorununCevapAlani").slideUp();                                  // Açılan alanı yavaşça yukarı kaldırır (kapatınca tekrar açıyor)
        $(islenecekAlan).parent().find(".sorununCevapAlani").slideToggle(); // açıksa kapatır, kapalıysa açar

    }

});