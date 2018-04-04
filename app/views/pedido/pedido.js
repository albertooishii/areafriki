$(document).ready(function(){
    $("body").on("click", ".cancel", function(e){
        var token = $(this).closest(".pedido").data("token");

        $(".modal-header").html("¡Vas a cancelar un pedido!");
        $(".modal-body").html("Indica el motivo por el cual quieres cancelar el pedido:<form><div class='form-group'><textarea id='observaciones' class='form-control' placeholder='Motivo de la cancelación' name='observaciones' data-fv-notempty='true' data-fv-notempty-message='El motivo de la cancelación es obligatorio' /></textarea></div><div class='text-right'><button type='button' class='btn btn-default btn-round' data-dismiss='modal'>Cerrar</button><button id='confirmar' type='submit' class='btn btn-primary btn-round'>Confirmar</button></div></form>");
        $(".modal-footer").html("");
        $(".modal form").formValidation();

        $(".modal").modal();

        $("body").on("submit",".modal form", function(event){
            event.preventDefault();
        });
        
        $("body").on("click", "#confirmar", function(e){
            $('form').formValidation('revalidateField', 'observaciones');
            if($(".has-error").size()==0){
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
                            $(".modal-header").html("¡Pedido cancelado!");
                            $(".modal-body").html("El pedido se ha cancelado correctamente. Se ha notificado al vendedor para que haga la devolución del dinero, en caso de que haya sido pagado, a través del mismo sistema en que fue realizado el pago.");
                            $(".modal-footer").html("<button type='button' class='btn btn-default btn-round' data-dismiss='modal'>Cerrar</button>");

                            $('#modalDg').on('hidden.bs.modal', function () {
                                window.location.reload();
                            });
                        }else{
                            alert(response);
                            window.location.reload();
                        }
                    },
                    error: function(){
                        alert("error ajax");
                    }
                });
            }
            e.stopPropagation();
        });


        e.stopPropagation();
    });
})
