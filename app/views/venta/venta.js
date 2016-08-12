$(document).ready(function(){
    $("body").on("change", ".select-estado", function(e){
        var nuevo_estado = $(this).val();
        var token = $(this).closest(".pedido").data("token");

        if(nuevo_estado=="enviado"){
            $(".modal-header").html("¡Se va a cambiar el estado del pedido a enviado!");
            $(".modal-body").html("Si dispones de algún código para el seguimiento introdúcelo:<form><textarea id='localizador' class='form-control' placeholder='Código de seguimiento sin URL'></textarea></form>");
            $(".modal-footer").html("<button type='button' class='btn btn-default btn-round' data-dismiss='modal'>Cerrar</button><button id='confirmar' type='button' class='btn btn-primary btn-round'>Confirmar</button>");
        }else if(nuevo_estado=="cancelado"){
            $(".modal-header").html("¡Se va a cancelar el pedido!");
            $(".modal-body").html("Indica el motivo por el cual el pedido va a ser cancelado:<form><textarea id='observaciones' class='form-control' placeholder='Motivo de la cancelación'></textarea></form>");
            $(".modal-footer").html("<button type='button' class='btn btn-default btn-round' data-dismiss='modal'>Cerrar</button><button id='confirmar' type='button' class='btn btn-primary btn-round'>Confirmar</button>");
        }else{
            $(".modal-header").html("¡Aviso!");
            $(".modal-body").html("¡El pedido va a cambiar su estado a "+ nuevo_estado +"!");
            $(".modal-footer").html("<button type='button' class='btn btn-default btn-round' data-dismiss='modal'>Cerrar</button><button id='confirmar' type='button' class='btn btn-primary btn-round'>Confirmar</button>");
        }
        $(".modal").modal();

        $("body").on("click", "#confirmar", function(e){
            var parametros = {
                "estado": nuevo_estado,
                "token": token,
                "localizador": $("#localizador").val(),
                "observaciones": $("#observaciones").val()
            }

            $.ajax({
                method: "POST",
                url: "?section=venta&action=changeEstado",
                data:parametros,
                success: function(response){
                    $(".modal").modal("hide");
                    if(response==1){
                        window.location.reload();
                    }else{
                        alert(response);
                    }
                },
                error: function(){
                    alert("error ajax");
                }
            })
            e.stopPropagation();
        });


        e.stopPropagation();
    });
})
