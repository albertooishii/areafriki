$(document).ready(function(){
    $("body").on("click", ".cancel", function(e){
        var token = $(this).closest(".pedido").data("token");

        $(".modal-header").html("¡Vas a cancelar un pedido!");
        $(".modal-body").html("Indica el motivo por el cual quieres cancelar el pedido:<form><textarea id='observaciones' class='form-control' placeholder='Motivo de la cancelación'></textarea></form>");
        $(".modal-footer").html("<button type='button' class='btn btn-default btn-round' data-dismiss='modal'>Cerrar</button><button id='confirmar' type='button' class='btn btn-primary btn-round'>Confirmar</button>");

        $(".modal").modal();

        $("body").on("click", "#confirmar", function(e){
            var parametros = {
                "token": token,
                "observaciones": $("#observaciones").val()
            }

            $.ajax({
                method: "POST",
                url: "?section=pedido&action=cancelar",
                data:parametros,
                success: function(response){
                    $(".modal").modal("hide");
                    if(response==1){
                        alert("Pedido cancelado correctamente");
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
