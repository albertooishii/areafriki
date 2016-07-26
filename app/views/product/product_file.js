$(document).ready(function() {
    $(".color_selector").click(function(e){
        e.preventDefault();
        $(".color_selector").removeClass("selected");
        $(this).addClass('selected');
        var color = $(this).data("color");

        var target = fpd.getElementByTitle("Base");
        fpd.currentViewInstance.changeColor(target,color,false,false);

        $('.product-page style').replaceWith('<style>.header-filter::before {background-color: '+ color +'; opacity: 0.4;}</style>');

        /*var parametros={
            "color":color
        };

        $.ajax({
            data:parametros,
            url: '?action=changeColor',
            type: 'POST',
            beforeSend: function(){
                $("body").append("<div id='load'><div class='sk-folding-cube'><div class='sk-cube1 sk-cube'></div><div class='sk-cube2 sk-cube'></div><div class='sk-cube4 sk-cube'></div><div class='sk-cube3 sk-cube'></div></div></div>");
            },
            complete: function(){
                $("#load").remove();
            },
            success: function (response){
                $(".montaje img").attr("src", response);
                $('.product-page style').replaceWith('<style>.header-filter::before {background-color: '+ color +'; opacity: 0.4;}</style>');

            },
            error: function (){
                alert('Error al añadir al carrito');
            }
        });*/
    });

    $("#add-cart").click(function(e){
        e.preventDefault();
        if($("#cantidad").val()>=1){
            var parametros = {
                "id": $(".product_file").data("id"),
                "cantidad": $("#cantidad").val(),
                "size": $("#size").val(),
                "color" : $(".color_selector.selected").data("color")
            };

            $.ajax({
                data:parametros,
                url: '/index.php?section=carrito&action=add',
                type: 'POST',
                success: function (response){
                    location.href="/carrito";
                },
                error: function (){
                    alert('Error al añadir al carrito');
                }
            });
        }else{
            alert("La cantidad introducida no es válida");
        }
    });

    $("#size").change(function(e){
        var parametros = {
            "id": $(".product_file").data("id"),
            "size": $("#size").val(),
            "orden": $("#size").find(':selected').data("orden")
        };

        $.ajax({
            data:parametros,
            url: '/index.php?section=producto&action=getPrecioSize',
            type: 'POST',
            success: function (response){
                $("#precio").html(response);
            },
            error: function (){
                alert('Error al calcular el precio');
            }
        });
    });

});
