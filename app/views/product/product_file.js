$(document).ready(function() {
    $(".color_selector").click(function(e){
        e.preventDefault();
        $(".color_selector").removeClass("selected");
        $(this).addClass('selected');
        var color = $(this).data("color");

        var target = fpd.getElementByTitle("Base");
        fpd.currentViewInstance.changeColor(target,color,false,false);

        $('.product-page style').replaceWith('<style>.header-filter::before {background-color: '+ color +'; opacity: 0.4;}</style>');
    });

    $("#solicitar_producto").click(function(e){
        e.preventDefault();
        var parametros = {
            "id": $(this).closest(".product_file").data("id")
        }
        $.ajax({
            data:parametros,
            url: '/index.php?section=producto&action=solicitarCompra',
            type: 'POST',
            success: function (response){
                if(response==1){
                    alert("¡Solicitud realizada con éxito! Se te avisará cuando la compra de este producto esté disponible.");
                }else{
                    alert(response);
                }
            },
            error: function (){
                alert('Error al solicitar el producto para compra');
            }
        })
    });

    $("#add-cart, .add-cart").click(function(e){
        e.preventDefault();
        var productfile=$(this).closest(".product_file");
        if(productfile.find("#cantidad").val()>=1){
            var parametros = {
                "id": productfile.data("id"),
                "cantidad": productfile.find("#cantidad").val(),
                "size": productfile.find("#size").val(),
                "color" : productfile.find(".color_selector.selected").data("color"),
                "nota" : productfile.find("#nota").val()
            };

            $.ajax({
                data:parametros,
                url: '/carrito?action=add',
                type: 'POST',
                success: function (response){
                    if(response==1){
                        location.href="/carrito";
                    }else{
                        alert(response);
                    }
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
