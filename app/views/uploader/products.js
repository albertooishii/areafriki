$(document).ready(function(){
    var inputFiles = [];

    $(".next").click(function(e){
        e.preventDefault();
        $("a[href='#"+$(this).data("href")+"']").click();
    });

    $(".pill-stock, .pill-prepa").click(function(){
        if ($(this).hasClass('pill-stock')) {
            $("#stock_automatico input").prop('disabled', false);
            $("#stock_manual input").prop('disabled', true);
        } else if ($(this).hasClass('pill-prepa')) {
            $("#stock_manual input").prop('disabled', false);
            $("#stock_automatico input").prop('disabled', true);
        }
    });

    $("#venta-submit").click(function(e){
        e.preventDefault()
        $('form').data('formValidation').validate();

        if($(".has-error").size()!=0 || $('form').find('input[name="tags"]').val()==='' || !$('form').find('select[name="subcategoria"]').val() || !$('form').find('select[name="topics[]"]').val() || $('form').find('input[name="beneficio"]').val()==='' || $('form').find('input[name="gastos_envio"]').val()==='' || $('form').find('input[name="tiempo_envio"]').val()===''){
            $(".modal-title").html("ERROR");
            $(".modal-body").html("Faltan campos obligatorios por rellenar.");
            $('#modalDg').modal() ;
        } else if (!inputFiles.length) {
            $(".modal-title").html("ERROR");
            $(".modal-body").html("Al menos una imagen es obligatoria.");
            $('#modalDg').modal();
        }else if($('textarea[name="descripcion"]').val().indexOf('[url') >= 0 ||
            $('textarea[name="descripcion"]').val().match(/http([s]?):\/\/.*/) ||
            $('textarea[name="descripcion"]').val().match(/www.[0-9a-zA-Z',-]./)) {
            $(".modal-title").html("ERROR");
            $(".modal-body").html("No se permiten enlaces en la descripción.");
            $('#modalDg').modal();
        }else{
            var fd = new FormData(document.getElementById("fileupload"));
            $.each(inputFiles, function (i, file) {
                fd.append('files[' + i + ']', file)
            })

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
                        console.log(response)
                        //Enviamos error por email
                        $(".modal-title").html("ERROR");
                        $(".modal-body").html("Ha ocurrido un error al subir tu producto. Nuestro sistema recopilará la información sobre este error. Se te notificará por email cuando haya sido solucionado.");
                        $('#modalDg').modal({backdrop: 'static', keyboard: false});
                    }
                }
            });
        }
        e.stopPropagation();
    });

//FOTO UPLOAD
    var names = [];

    $('body').on('change', '.picupload', function(event) {
        var files = [...event.target.files];
        const maxFiles = 4
        var output = document.getElementById("media-list");
        var z = 0
        files.splice(maxFiles, files.length - maxFiles)

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (names.length < maxFiles) {
                names.push($(this).get(0).files[i].name);
                var picReader = new FileReader();
                picReader.fileName = file.name
                picReader.addEventListener("load", function(event) {

                    var picFile = event.target;

                    var div = document.createElement("li");

                    div.innerHTML = "<img src='" + picFile.result + "'" +
                        "title='" + event.target.fileName + "'/><div  class='post-thumb'><div class='inner-post-thumb'><a href='javascript:void(0);' data-id='" + event.target.fileName + "' class='remove-pic'><i class='fa fa-times' aria-hidden='true'></i></a><div></div>";

                    $(".myupload").before(div);

                });
                picReader.readAsDataURL(file);
            }
        }

        inputFiles = [...inputFiles, ...files]
        inputFiles.splice(maxFiles, inputFiles.length - maxFiles)

        //console.log(names);
        if (names.length >= 4) {
            $(".myupload").hide()
        } else {
            $(".myupload").show()
        }
    });

    $('body').on('click', '.remove-pic', function() {
        $(this).parent().parent().parent().remove();
        var removeItem = $(this).attr('data-id');
        var yet = names.indexOf(removeItem);

        if (yet != -1) {
            names.splice(yet, 1);
            inputFiles.splice(yet, 1);
            console.log(inputFiles)
        }
        //console.log(names)
        if (names.length >= 4) {
            $(".myupload").hide()
        } else {
            $(".myupload").show()
        }
    });
});

function unloadPage(){
   return "dont leave me this way";
}

window.onbeforeunload = unloadPage;
