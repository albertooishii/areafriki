$(document).ready(function() {
    var now = new Date ($("#now_promo").data('nowtime')).getTime();
    var end = new Date ($("#now_promo").data('endtime')).getTime();
    var x = setInterval(function() {
        // Find the distance between now an the count down date
        var distance = end - now;
        //console.log(now, end, distance);
        // Time calculations for days, hours, minutes and seconds
        if (distance > 0) {
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
            $(".countdown").html((days ? days + "d " : "") + hours + "h " + minutes + "m " + seconds + "s");
        } else {
            $(".countdown").html("Oferta finalizada");
        }
        now = now + 1000;
      }, 1000);
});