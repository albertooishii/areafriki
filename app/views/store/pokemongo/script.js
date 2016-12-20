$(document).ready(function(){

    $(".camiseta-selector").click(function(){
        var token=$(this).data("token");
        $("#camiseta img").attr("src", "/designs/areafriki/"+token+"/store/thumb-"+token+".jpg");
        $("#camiseta a").attr("href", "/designs/areafriki/"+token+"/store/thumb-"+token+".jpg");
        $("#camiseta #title").text($(this).find(".card-title").text());
        $("#camiseta #description").text($(this).find(".card-description").text());
        $("#camiseta").attr("data-token", $(this).data("token"));
    });

    $(".taza-selector").click(function(){
        var token=$(this).data("token");
        $("#taza img").attr("src", "/designs/areafriki/"+token+"/store/thumb-"+token+".jpg");
        $("#taza a").attr("href", "/designs/areafriki/"+token+"/store/thumb-"+token+".jpg");
        $("#taza #title").text($(this).find(".card-title").text());
        $("#taza #description").text($(this).find(".card-description").text());
        $("#taza").attr("data-token",$(this).data("token"));
    });
});
