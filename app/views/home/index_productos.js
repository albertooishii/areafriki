$(document).ready(function(){
    $("#select-order").change(function(){
        window.location.href = $(this).data("url") + "?orderby=" + $(this).val();
    });
});