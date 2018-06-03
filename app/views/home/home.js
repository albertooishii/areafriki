$(document).ready(function() {
    $("body").on("click", ".ruleta_item", function(e){
        e.preventDefault();
        $(this).find(".icon").html("favorite");
        var minNumber = 1;
        var maxNumber = 100;
        var random=randomNumberFromRange(minNumber, maxNumber);
        function randomNumberFromRange(min,max)
        {
            return Math.floor(Math.random()*(max-min+1)+min);
        }
        if(random<=5){

            var animationName='hinge';
        }else{
            var animationName='bounceOut';
        }

        var id_producto=$(this).data("id");

        var parametros={
            "id_producto":id_producto,
        };
        $.ajax({
            type: "POST",
            url: "?section=user&action=showCard",
            data: parametros,
            success: function (response){
                if(response!=""){
                    $("#showcard").html(response);
                }
            }
        });

        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        $(this).addClass('animated ' + animationName).one(animationEnd, function() {
            var ruletaitem=$(this);
            var dataValues = $(this).parent().children().map(function() {
                if($(this).data("id")!=id_producto){
                    return $(this).data("id");
                }
            }).get();

            var parametros={
                "id_producto":id_producto,
                "id_hermanos":dataValues
            };

            $.ajax({
                type: "POST",
                url: "?section=user&action=ruletaLike",
                data: parametros,
                success: function (response){
                    if(response==""){
                        $(".modal-title").html("¡Aviso!");
                        $(".modal-body").html("<h4>Tienes que estar registrado/a para hacer esta acción</h4>");
                        $(".modal-footer").html("<a href='/login?redirect=" + window.location + "' class='btn btn-primary btn-round'>Iniciar sesión</a>"); 
                        $(".modal").modal();
                    }else{
                        ruletaitem.replaceWith(response);
                    }
                }
            });
        });
    });
});
