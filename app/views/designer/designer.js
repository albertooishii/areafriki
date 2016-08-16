$(document).ready(function() {
    $(".color_selector").click(function(e){
        e.preventDefault();
        var color=$(this).data("color");
        var target = fpd.getElementByTitle("Base");
        fpd.currentViewInstance.changeColor(target,color,false,false);
    })

    $("#fpd").bind('elementAdd', function(event, element){
        if(element.hasControls){
            $("[data-module=images]").hide().removeClass("fpd-active");
            $("#form-submit").removeClass('disabled');
            $("#form-submit").removeAttr('disabled');
        }
    });

    $("#fpd").bind('elementRemove', function(event, element){
        if(element.hasControls){
            $("[data-module=images]").removeClass("fpd-active").show();
        }
    });

    $("body").on("click", "[data-module=products] .fpd-item", function(){
        $("[data-module=images], [data-module=designs]").removeClass("fpd-active").show();
    });

    $("body").on("click", "[data-module=designs] .fpd-item", function(){
        var source=$(this).data("source").split('/');
        var source=source[source.length-1].split('.');
        var source=source[source.length-2];
        $("#token").val(source);
        $("[name=nombre]").val($(this).data("title"));
    });

    $("#form-submit").click(function(e){
        $('form').data('formValidation').validate();
        $('form').formValidation('revalidateField', 'design_editable');
        if($(".has-error").size()!=0){
            FPDUtil.showModal("ERROR: Faltan campos obligatorios por rellenar.");
        }else if(typeof fpd.getCustomElements()[0] == 'undefined'){
            FPDUtil.showModal("ERROR: No has colocado la imagen correctamente.");
        }else if(fpd.getCustomElements()[0]["element"].isOut){
            FPDUtil.showModal("ERROR: El diseño sobresale del área de impresión.");
        }else if($('textarea[name="descripcion"]').val().indexOf('[url') >= 0 ||
            $('textarea[name="descripcion"]').val().match(/http([s]?):\/\/.*/) ||
            $('textarea[name="descripcion"]').val().match(/www.[0-9a-zA-Z',-]./)) {
            FPDUtil.showModal("ERROR: No se permiten enlaces en la descripción.");
        }else{
            window.onbeforeunload = null;
            fpd.getProductDataURL(function(dataURL) {
                var fd = new FormData(document.getElementById("designer"));

                fd.append('categoria',$("#dg-categoria").data("id"));
                var montajeblob=dataURLtoBlob(dataURL);
                fd.append('montaje',montajeblob);
                if(typeof fpd.getElementByTitle("Base")!='undefined'){
                    if(typeof fpd.getElementByTitle("Base")["fill"] != 'undefined' && typeof fpd.getElementByTitle("Base")["currentColor"] != 'undefined'){
                        if(fpd.getElementByTitle("Base")["fill"] != false){
                            fd.append('color',fpd.getElementByTitle("Base")["fill"]);
                        }else{
                            fd.append('color',fpd.getElementByTitle("Base")["currentColor"]);
                        }
                    }
                }
                fd.append('modelo',fpd.getProduct()[0]['title']);
                fd.append('top',fpd.getCustomElements()[0]["element"].top);
                fd.append('left',fpd.getCustomElements()[0]["element"].left);
                fd.append('scale',fpd.getCustomElements()[0]["element"].scaleX);
                var designblob=dataURLtoBlob(fpd.getCustomElements()[0]['element']['source']);
                fd.append('design',designblob);
                publicarDesign(fd, $("#dg-categoria").data("id"), $("#token").val(), fpd);
            });
        }
        e.stopPropagation();
    });

    $("[name=tags]").change(function(){
        $('form').formValidation('revalidateField', 'tags');
    });
});

function unloadPage(){
   return "dont leave me this way";
}

window.onbeforeunload = unloadPage;

//PUBLICAR PRODUCTOS DESIGNER
function publicarDesign(data, categoria, token, fpd)
{
    $.ajax({
        type: "POST",
        url: "/upload?action=publish",
        data: data,
        processData:false,
        contentType:false,
        beforeSend: function(){
            $("body").append("<div id='load'><div class='sk-folding-cube'><div class='sk-cube1 sk-cube'></div><div class='sk-cube2 sk-cube'></div><div class='sk-cube4 sk-cube'></div><div class='sk-cube3 sk-cube'></div></div></div>");
        },
        error: function( jqXHR, textStatus, errorThrown ) {

            if (jqXHR.status === 0) {

            console.log('Not connect: Verify Network.');

            } else if (jqXHR.status == 404) {
                console.log('Requested page not found [404]');
            } else if (jqXHR.status == 500) {
                console.log('Internal Server Error [500].');
            } else if (textStatus === 'parsererror') {
                console.log('Requested JSON parse failed.');
            } else if (textStatus === 'timeout') {
                console.log('Time out error.');
            } else if (textStatus === 'abort') {
                console.log('Ajax request aborted.');
            } else {
                console.log('Uncaught Error: ' + jqXHR.responseText);
            }

            $(".modal-title").html("ERROR");
            $(".modal-body").html("Lo sentimos, ha habido un error al publicar la imagen. Revisa el formato y vuelve a intentarlo. Gracias.");
            $('#modalDg').modal({backdrop: 'static', keyboard: false});
        },
        complete: function(){
            $("#load").remove();
        },
        xhr: function() {
            var ajax = new window.XMLHttpRequest();
            ajax.upload.addEventListener("progress", function (event) {
                //_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
                var percent = (event.loaded / event.total) * 100;
                console.log(percent);
                //_("progressBar").value = Math.round(percent);
                //_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
            }, false);
            return ajax;
        },
        success: function (response){
            if(response==1){
                productoPublicado();
            }else{
                console.log(response);
                $(".modal-title").html("ERROR");
                $(".modal-body").html("Ha ocurrido un error al subir tu producto. Nuestro sistema recopilará la información sobre este error. Se te notificará por email cuando haya sido solucionado.");
                $('#modalDg').modal({backdrop: 'static', keyboard: false});
                $(".close-modal").click(function(){
                    window.location.href="/";
                });
            }
        }
    });
}
