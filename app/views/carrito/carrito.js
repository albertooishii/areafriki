$(document).ready(function(){
    $(".cantidad").change(function(){
        if($(this).val()>0){
            var parametros = {
                "cantidad": $(this).val(),
                "linea": $(this).closest('.producto-carrito').data('linea'),
                "token": $(this).closest(".card-vendedor").data("token"),
                "vendedor": $(this).closest(".card-vendedor").data("vendedor")
            };

            $.ajax({
                data:parametros,
                url: '/index.php?section=carrito&action=edit',
                type: 'POST',
                success: function (response){
                    location.reload();
                },
                error: function (){
                    alert('Error al añadir al cambiar la cantidad');
                }
            });
        }else{
            alert("La cantidad introducida no es válida");
        }
    })

    $(".remove").click(function(event){
        event.preventDefault();
        var parametros = {
            "linea": $(this).closest('.producto-carrito').data('linea'),
            "token": $(this).closest(".card-vendedor").data("token")
        };

        $.ajax({
            data:parametros,
            url: '/index.php?section=carrito&action=remove',
            type: 'POST',
            success: function (response){
                window.location.href = '/carrito';
            },
            error: function (){
                alert('Error al quitar del carrito');
            }
        });
    });
});
