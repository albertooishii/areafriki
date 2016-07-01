$(document).ready(function() {
    $(".option").click(function(e){
        e.preventDefault();
        $("#form-contacto").slideDown("slow");
        $("#contact-options").removeClass("col-md-12").addClass("col-md-6");
        $("#form-title").html($(this).find("h4").html());
        $("#email-destino").val($(this).data("email"));
        $('html, body').animate({
            scrollTop: $("#form-contacto").offset().top
        }, 1000);
    });
});
