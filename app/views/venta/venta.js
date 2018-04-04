$(document).ready(function(){
    $(".select-estado").on('changed.bs.select', function (e) {
        var select=$(this);
        var antiguo_estado=select.closest(".pedido").data("estado");
        var nuevo_estado = select.val();
        var token = select.closest(".pedido").data("token");

        if(nuevo_estado=="enviado"){
            $(".modal-header").html("¡Se va a cambiar el estado del pedido a enviado!");
            $(".modal-body").html("Si dispones de algún código para el seguimiento introdúcelo:<form><textarea id='localizador' class='form-control' placeholder='Código de seguimiento sin URL'></textarea></form>");
            $(".modal-footer").html("<button type='button' class='btn btn-default btn-round' data-dismiss='modal'>Cerrar</button><button id='confirmar' type='button' class='btn btn-primary btn-round'>Confirmar</button>");
        }else if(nuevo_estado=="cancelado"){
            $(".modal-header").html("¡Se va a cancelar el pedido!");
            $(".modal-body").html("Indica el motivo por el cual el pedido va a ser cancelado:<form><div class='form-group'><textarea id='observaciones' class='form-control' placeholder='Motivo de la cancelación' name='observaciones' data-fv-notempty='true' data-fv-notempty-message='El motivo de la cancelación es obligatorio' /></textarea></div><div class='text-right'><button type='button' class='btn btn-default btn-round' data-dismiss='modal'>Cerrar</button><button id='confirmar' type='submit' class='btn btn-primary btn-round'>Confirmar</button></div></form>");
            $(".modal-footer").html("");
            $(".modal form").formValidation();
        }else{
            $(".modal-header").html("¡Aviso!");
            $(".modal-body").html("¡El pedido va a cambiar su estado a "+ nuevo_estado +"!<form></form>");
            $(".modal-footer").html("<button type='button' class='btn btn-default btn-round' data-dismiss='modal'>Cerrar</button><button id='confirmar' type='button' class='btn btn-primary btn-round'>Confirmar</button>");
        }
        $(".modal").modal("show");

        $("body").on("submit",".modal form", function(event){
            event.preventDefault();
        });
        
        $("body").on("click", "#confirmar", function(event){
            $('form').formValidation('revalidateField', 'observaciones');
            if($(".has-error").size()==0){
                var parametros = {
                    "estado": select.val(),
                    "token": token,
                    "localizador": $("#localizador").val(),
                    "observaciones": $("#observaciones").val()
                }

                $.ajax({
                    method: "POST",
                    url: "?section=venta&action=changeEstado",
                    data:parametros,
                    success: function(response){
                        //$(".modal").modal("hide");
                        if(response==1){
                            window.location.reload();
                        }else{
                            $(".modal-header").html("¡Aviso!");
                            $(".modal-body").html("¡"+response+"!");
                            $(".modal-footer").html("<button type='button' class='btn btn-default btn-round' data-dismiss='modal'>Cerrar</button>");
                            $(".modal").modal("show");
                        }
                    },
                    error: function(){
                        alert("error ajax");
                    }
                });
            }
            event.stopPropagation();
        });
        
        $('#modalDg').on('hidden.bs.modal', function () { 
            select.selectpicker('val', antiguo_estado);
            select.selectpicker('refresh');
            e.stopPropagation();
        });
        e.stopPropagation();
    });
})
