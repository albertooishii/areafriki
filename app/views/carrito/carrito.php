<div class="container">
    <h3>CARRITO</h3>
    <div class="row">
        <div class="col-md-10">
            <table class="table table-responsive">
                <tr>
                    <th></th>
                    <th></th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
                <?=$data["lista_productos"]?>
            </table>
        </div>
        <div class="col-md-2">
            <h4>Subtotal:</h4>
            <h4><?=$precio_total?></h4>
            <a href="carrito?action=checkout" class="btn btn-primary">Finalizar pedido</a>
        </div>
    </div>
</div>


<script>

    $(".cantidad").change(function(){
        if($(this).val()>0){
            var parametros = {
                "cantidad": $(this).val(),
                "linea": $(this).closest('.producto-carrito').data('linea')
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
            "linea": $(this).closest('.producto-carrito').data('linea')
        };

        $.ajax({
            data:parametros,
            url: '/index.php?section=carrito&action=remove',
            type: 'POST',
            success: function (response){
                location.reload();
            },
            error: function (){
                alert('Error al añadir al carrito');
            }
        });
    });
</script>
