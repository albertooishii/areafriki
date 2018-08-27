$(document).ready(function () {
    var customImage = false
    $(".fpd-container").bind('elementAdd', function (event, element) {
        if (element.hasControls) {
            $(this).find("[data-module=images]").hide();
            $("#form-submit").removeClass('disabled');
            $("#form-submit").removeAttr('disabled');
            $(".add-product." + event.target.parentElement.id).addClass('selected');
            customImage = element
        }
    });

    /*$(".fpd-container").bind('ready', function (event) {
        if (event.target.parentElement.id !== 'camisetas') {
            $(this).parent().hide();
        }
    });*/

    $(".add-product").click(function (event) {
        event.preventDefault();
        const category = $(this).data('category');

        if (!$(".designer#" + category).is(":visible")) {
            $(".designer").hide();
            $("#" + category).show().resize();
            $(".product-info").hide();
            $(".product-info." + category).show();
            if (customImage) {
                $(this).addClass('selected');
                setImage(category);
            }
        } else {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                removeImage(category)
                $(".add-product.selected").click();
            } else if (customImage) {
                $(this).addClass('selected');
                setImage(category);
            }
        }
    });

    $(".fpd-container").bind('elementRemove', function (event, element) {
        if (element.hasControls) {
            $(this).find("[data-module=images]").removeClass("fpd-active").show();
            $(".add-product." + event.target.parentElement.id).removeClass('selected');
        }
    });

    $(".fpd-container").bind('productSelect', function (event){
        if (customImage) {
            $(this).bind('productCreate', function (){
                setImage(event.target.parentElement.id)
            })
        }
    });

    function setImage(category) {
        switch (category) {
            case 'camisetas':
                if (!fpdCamisetas.getCustomElements()[0]) {
                    fpdCamisetas.addCustomImage(customImage.source, customImage.title);
                }
                break;
            case 'sudaderas':
                if (!fpdSudaderas.getCustomElements()[0]) {
                    fpdSudaderas.addCustomImage(customImage.source, customImage.title);
                }
                break;
            case 'vinilos':
                if (!fpdVinilos.getCustomElements()[0]) {
                    fpdVinilos.addCustomImage(customImage.source, customImage.title);
                }
                break;
            case 'lienzos':
                if (!fpdLienzos.getCustomElements()[0]) {
                    fpdLienzos.addCustomImage(customImage.source, customImage.title);
                }
                break;
            case 'chapas':
                if (!fpdChapas.getCustomElements()[0]) {
                    fpdChapas.addCustomImage(customImage.source, customImage.title);
                }
                break;
            case 'tazas':
                if (!fpdTazas.getCustomElements()[0]) {
                    fpdTazas.addCustomImage(customImage.source, customImage.title);
                }
                break;
            case 'posters':
                if (!fpdPosters.getCustomElements()[0]) {
                    fpdPosters.addCustomImage(customImage.source, customImage.title);
                }
                break;
        }
    }

    function removeImage(category) {
        switch (category) {
            case 'camisetas':
                if (fpdCamisetas.getCustomElements()[0]) {
                    fpdCamisetas.currentViewInstance.removeElement(customImage.title);
                }
                break;
            case 'sudaderas':
                if (fpdSudaderas.getCustomElements()[0]) {
                    fpdSudaderas.currentViewInstance.removeElement(customImage.title);
                }
                break;
            case 'vinilos':
                if (fpdVinilos.getCustomElements()[0]) {
                    fpdVinilos.currentViewInstance.removeElement(customImage.title);
                }
                break;
            case 'lienzos':
                if (fpdLienzos.getCustomElements()[0]) {
                    fpdLienzos.currentViewInstance.removeElement(customImage.title);
                }
                break;
            case 'chapas':
                if (fpdChapas.getCustomElements()[0]) {
                    fpdChapas.currentViewInstance.removeElement(customImage.title);
                }
                break;
            case 'tazas':
                if (fpdTazas.getCustomElements()[0]) {
                    fpdTazas.currentViewInstance.removeElement(customImage.title);
                }
                break;
            case 'posters':
                if (fpdPosters.getCustomElements()[0]) {
                    fpdPosters.currentViewInstance.removeElement(customImage.title);
                }
                break;
        }
    }

    function addToFd(fpd, category, fd) {
        const promise = new Promise(function (resolve) {
            if (fpd.getCustomElements()[0]) {
                fpd.getProductDataURL(function (dataURL){
                    fd.append('montaje_' + category, dataURLtoBlob(dataURL));
                    fd.append('modelo_' + category, fpd.getProduct()[0]['title']);
                    if (fpd.getUsedColors() && fpd.getUsedColors()[0]) {
                        fd.append('color_' + category, fpd.getUsedColors()[0])
                    } else if (fpd.getElementByTitle("Base")["currentColor"]) {
                        fd.append('color_' + category, fpd.getElementByTitle("Base")["currentColor"])
                    }
                    fd.append('top_' + category, fpd.getCustomElements()[0]["element"].top);
                    fd.append('left_' + category, fpd.getCustomElements()[0]["element"].left);
                    fd.append('scale_' + category, fpd.getCustomElements()[0]["element"].scaleX);
                    resolve(fd)
                })
            } else {
                resolve(fd)
            }
        })

        return promise;
    }

    $("#form-submit").click(function (e) {
        e.preventDefault();
        $('form').data('formValidation').validate();
        $('form').formValidation('revalidateField', 'design_editable');
        if ($(".has-error").size() != 0) {
            FPDUtil.showModal("ERROR: Faltan campos obligatorios por rellenar.");
        } else if ($('textarea[name="descripcion"]').val().indexOf('[url') >= 0 ||
            $('textarea[name="descripcion"]').val().match(/http([s]?):\/\/.*/) ||
            $('textarea[name="descripcion"]').val().match(/www.[0-9a-zA-Z',-]./)) {
            FPDUtil.showModal("ERROR: No se permiten enlaces en la descripción.");
        } else {
            if (!(fpdCamisetas.getCustomElements()[0] || fpdSudaderas.getCustomElements()[0] || fpdVinilos.getCustomElements()[0] || fpdLienzos.getCustomElements()[0] || fpdChapas.getCustomElements()[0] || fpdTazas.getCustomElements()[0] || fpdPosters.getCustomElements()[0])) {
                FPDUtil.showModal("ERROR: Es necesario al menos un tipo de producto.");
            /*} else if (fpdCamisetas.getCustomElements()[0] && fpdCamisetas.getCustomElements()[0]["element"].isOut) {
                FPDUtil.showModal("ERROR: El diseño de la camiseta sobresale del área de impresión.");
            } else if (fpdSudaderas.getCustomElements()[0] && fpdSudaderas.getCustomElements()[0]["element"].isOut) {
                FPDUtil.showModal("ERROR: El diseño de la sudadera sobresale del área de impresión.");*/
            } else {
                window.onbeforeunload = null;
                var fd = new FormData(document.getElementById("designer"));

                addToFd(fpdCamisetas, 'camisetas', fd)
                    .then(function () { return addToFd(fpdSudaderas, 'sudaderas', fd) })
                    .then(function () { return addToFd(fpdVinilos, 'vinilos', fd) })
                    .then(function () { return addToFd(fpdLienzos, 'lienzos', fd) })
                    .then(function () { return addToFd(fpdChapas, 'chapas', fd) })
                    .then(function () { return addToFd(fpdTazas, 'tazas', fd) })
                    .then(function () { return addToFd(fpdPosters, 'posters', fd) })
                    .then(function () {
                        var designblob = dataURLtoBlob(customImage.source);
                        fd.append('design', designblob);
                        publicarDesign(fd, $("#token").val());
                    })
                // e.stopPropagation();
            }
        }
        e.stopPropagation();
    });

    $("[name=tags]").change(function () {
        $('form').formValidation('revalidateField', 'tags');
        $('form').formValidation('revalidateField', 'topics[]')
    });
});

function unloadPage() {
    return "dont leave me this way";
}

window.onbeforeunload = unloadPage;

//PUBLICAR PRODUCTOS DESIGNER
function publicarDesign(data, token) {
    $.ajax({
        type: "POST",
        url: "/upload?action=publish",
        data: data,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $("body").append("<div id='load'><div class='chart' id='uploadprogress'><p></p><span></span><canvas id='progresscanvas'></canvas></div></div>");
        },
        error: function (jqXHR, textStatus, errorThrown) {

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
            $('#modalDg').modal({ backdrop: 'static', keyboard: false });
        },
        complete: function () {
            $("#load").remove();
        },
        xhr: function () {
            var ajax = new window.XMLHttpRequest();
            ajax.upload.addEventListener("progress", function (event) {
                //_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
                var percent = (event.loaded / event.total) * 100;
                uploadProgress(parseInt(percent));
                console.log(percent);
                //_("progressBar").value = Math.round(percent);
                //_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
            }, false);
            return ajax;
        },
        success: function (response) {
            if (response == 1) {
                productoPublicado(token);
            } else {
                console.log(response);
                $(".modal-title").html("ERROR");
                $(".modal-body").html("Ha ocurrido un error al subir tu producto. Nuestro sistema recopilará la información sobre este error. Se te notificará por email cuando haya sido solucionado.");
                /*$(".modal-body").html("Lo sentimos, ha habido un error al publicar los archivos. Revisa el formato y vuelve a intentarlo. Gracias.");*/
                $('#modalDg').modal({ backdrop: 'static', keyboard: false });
                /*$(".close-modal").click(function(){
                    window.location.href="/";
                });*/
            }
        }
    });
}

function uploadProgress(percent) {
    var el = $("#uploadprogress");

    var options = {
        percent: percent || 0,
        size: el.data('size') || 220,
        lineWidth: el.data('line') || 15,
        rotate: el.data('rotate') || 0
    }

    var canvas = document.getElementById("progresscanvas");
    var span = el.find('span');
    var texto = el.find('p');

    if (percent < 100) {
        texto.html("SUBIENDO ARCHIVOS");
    } else {
        texto.html("FINALIZANDO");
    }

    span.html(parseInt(options.percent) + '%');

    if (typeof (G_vmlCanvasManager) !== 'undefined') {
        G_vmlCanvasManager.initElement(canvas);
    }

    var ctx = canvas.getContext('2d');
    canvas.width = canvas.height = options.size;

    ctx.translate(options.size / 2, options.size / 2); // change center
    ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI); // rotate -90 deg

    //imd = ctx.getImageData(0, 0, 240, 240);
    var radius = (options.size - options.lineWidth) / 2;

    var drawCircle = function (color, lineWidth, percent) {
        percent = Math.min(Math.max(0, percent || 1), 1);
        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
        ctx.strokeStyle = color;
        ctx.lineCap = 'round'; // butt, round or square
        ctx.lineWidth = lineWidth
        ctx.stroke();
    };

    drawCircle('#efefef', options.lineWidth, 100 / 100);
    drawCircle('#FF5722', options.lineWidth, options.percent / 100);
}
