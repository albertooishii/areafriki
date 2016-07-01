$(document).ready(function(){
    $("#file").fileinput({
        uploadUrl:"#",
        uploadAsync: false,
        showPreview: true,
        initialPreviewAsData: true,
        minFileCount: 1,
        showUpload: false,
        language: "es",
        autoReplace: true,
        maxFileCount: 4,
        allowedFileExtensions: ["jpg", "png", "gif"],
    });

    $(".next").click(function(e){
        e.preventDefault();
        $("a[href='#"+$(this).data("href")+"']").click();
    });

    $(".stockswitch").change(function(){
        if($(this).is(":checked")){ //automático
            $(".descripcion_stock").html("STOCK AUTOMÁTICO: introduce la cantidad de unidades que tienes de este producto. Se irá descontando una por cada producto vendido, hasta que esté agotado.");
            $("#stock_automatico").show();
            $("#stock_automatico input").prop('disabled', false);
            $("#stock_manual input").prop('disabled', true);
            $("#stock_manual").hide();
        }else{ //manual
            $(".descripcion_stock").html("STOCK MANUAL: el producto lo iré haciendo a medida que me lo vayan encargando, no tengo una cantidad fija.");
            $("#stock_automatico").hide();
            $("#stock_manual").show();
            $("#stock_manual input").prop('disabled', false);
            $("#stock_automatico input").prop('disabled', true);

        }
    });

    $("#venta-submit").click(function(e){
        e.preventDefault();
        $('form').data('formValidation').validate();
        $('form').formValidation('revalidateField', 'files[]');
        if($(".has-error").size()!=0 || $('form').find('input[name="tags"]').val()==''){
            $(".modal-title").html("ERROR");
            $(".modal-body").html("Faltan campos obligatorios por rellenar.");
            $('#modalDg').modal() ;
        }else if($('textarea[name="descripcion"]').val().indexOf('[url') >= 0 ||
            $('textarea[name="descripcion"]').val().match(/http([s]?):\/\/.*/) ||
            $('textarea[name="descripcion"]').val().match(/www.[0-9a-zA-Z',-]./)) {
            $(".modal-title").html("ERROR");
            $(".modal-body").html("No se permiten enlaces en la descripción.");
            $('#modalDg').modal() ;
        }else{
            var fd = new FormData(document.getElementById("fileupload"));
            fd.append('categoria',$("#dg-categoria").data("id"));

            //PUBLICAR PRODUCTOS VENTA (CRAFTS Y BAÚL)

            $.ajax({
                method: "POST",
                url: "/upload?action=publish",
                data: fd,
                enctype: 'multipart/form-data',
                processData:false,
                contentType:false,
                beforeSend: function(){
                    $("body").append("<div id='load'><div class='sk-folding-cube'><div class='sk-cube1 sk-cube'></div><div class='sk-cube2 sk-cube'></div><div class='sk-cube4 sk-cube'></div><div class='sk-cube3 sk-cube'></div></div></div>");
                },
                error: function(error){
                    $(".modal-title").html("ERROR");
                    $(".modal-body").html("Ha habido un error al publicar la imagen. Recarga la página y vuelve a intentarlo. Gracias.");
                    $('#modalDg').modal() ;
                },
                complete: function(){
                    $("#load").remove();
                    window.onbeforeunload = null;
                },
                success: function (response){
                    if(response==1){
                        productoPublicado();
                    }else{
                        //Enviamos error por email
                        $(".modal-title").html("ERROR");
                        $(".modal-body").html("Ha ocurrido un error al subir tu producto. Nuestro sistema recopilará la información sobre este error. Se te notificará por email cuando haya sido solucionado.");
                        $('#modalDg').modal({backdrop: 'static', keyboard: false});
                    }
                }
            });
        }
    });
});
function unloadPage(){
   return "dont leave me this way";
}

window.onbeforeunload = unloadPage;
