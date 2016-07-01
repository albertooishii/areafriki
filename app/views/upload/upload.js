$(document).ready(function() {
    //SELECCIÓN DE CATEGORÍAS
    $("#select-category").val('');
    $("#select-category").change(function(){
        $("#plantillas_links").slideUp();
        $("#category-submit").removeAttr('disabled');
        $("#plantillas_links").slideDown();
        var categoria=$("#select-category option:selected").text().toLowerCase();
        $("#download_plantilla").attr('href', "/plantillas/"+categoria+".zip");
        $("form").attr("action","/designer/"+categoria);
    });
});
