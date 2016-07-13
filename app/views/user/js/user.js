function unloadPage(){
   return "dont leave me this way";
}

$(document).ready(function() {
    $("body").on("click","#edit_profile",function(e){
        e.preventDefault();
        window.onbeforeunload = unloadPage;
        $("#user_avatar img, #user_banner_bg").attr("data-toggle","dropdown");
        $("#user_banner_bg, #user_avatar img").addClass("img_edit");
        $("div[class ^=user_info_] span").attr("contenteditable","true");
        $(this).addClass("save_profile").text("Guardar cambios");
    });

    $("body").on("click", ".save_profile",function(){
        var parametros={
            "descripcion":$(".user_info_description span").html(),
            "ocupacion":$(".user_info_ocupacion span").html(),
            "intereses":$(".user_info_intereses span").html()
        }

        $.ajax({
            data: parametros,
            url: '?section=user&action=saveProfile',
            type: 'POST',
            success:  function (success) {
                $("#edit_profile").removeClass("save_profile").text("Editar perfil");
                $("*").removeClass("img_edit").removeAttr("contenteditable");
                $("#user_avatar img, #user_banner_bg").removeAttr("data-toggle");
                notify("¡Cambios guardados correctamente!");
                window.onbeforeunload = null;
            },
            error:  function () {
                notify('Error', 'No se ha podido borrar la imagen', '', 'warning');
            }
        });

    });

/*-------EDIT AVATAR-------*/

    $("#user_avatar").on('click', '#upload_avatar', function(){
        $("#user_avatar input").click();
    });

    $("#user_avatar").on('click', '#delete_avatar', function(){
        deleteavatar();
        $("#avatar_options").remove();
    });


     $('#user_avatar').on('change', '#edit_avatar', function(){
        $("#modalDg .modal-title").html("Ajusta la imagen");
        $("#user_avatar").find(".modal-title").text("Ajusta la imagen de perfil");
        $("#modalDg .modal-body").html("<div class='avatar-wrapper'><img id='inputfile-preview' src=''></div>");
        $("#modalDg .modal-footer").html("<button type='button' class='btn btn-default btn-raised' data-dismiss='modal'>Cerrar</button><button class='avatar-like btn btn-primary btn-raised'>¡ME GUSTA!</button>");
        $("#modalDg .modal-dialog").removeClass("modal-lg");
        var reader = new FileReader();
        var input = document.getElementById('edit_avatar');
        reader.onload = function (e){
            document.getElementById('inputfile-preview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
        var element = document.getElementById('inputfile-preview');

        $("#modalDg").on("shown.bs.modal", function() {
            $(element).cropper({
                aspectRatio: 1/1
            });
        });

        $("#modalDg").modal('show');

        $("body").on('click','.avatar-like', function(){
            var avatar=$(element).cropper("getCroppedCanvas",{
                width: 300,
                height: 300,
            }).toBlob(function (avatar) {
                var formData = new FormData();

                formData.append('avatar', avatar);

                $.ajax({
                    url: '?section=user&action=uploadAvatar',
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $fileupload = $('#edit_avatar');
                        $fileupload.replaceWith($fileupload.clone(true));
                        $("#modalDg").modal('hide');
                        $("#user_avatar .img_edit").replaceWith("<div id='loading'><div id='block_1' class='loading_block'></div><div id='blockG_2' class='loading_block'></div><div id='blockG_3' class='loading_block'></div></div>");
                    },
                    success: function (response) {
                        var imgsrc = "../app/templates/frontoffice/img/avatar/" + response + "?d=" + new Date().getTime();
                        $("#user_avatar #loading").replaceWith("<img class='dropdown-toggle img_edit img-circle' src='" + imgsrc + "' data-toggle='dropdown'>");
                        $("#header-login img").attr("src", imgsrc);
                    },
                    error: function () {
                        console.log('Upload error');
                        alert("No se ha podido subir la imagen");
                    }
                });
            });
        });
     });

    function deleteavatar(){
         $.ajax({
            url: '?section=user&action=deleteAvatar',
            type: 'POST',
            beforeSend: function () {
                //$("#sms_ajaxdb div").html("Borrando imagen...");
                $("#user_avatar .img_edit").replaceWith("<div id='loading'><div id='block_1' class='loading_block'></div><div id='blockG_2' class='loading_block'></div><div id='blockG_3' class='loading_block'></div></div>");
            },
            success:  function (success) {
                //$("#sms_ajaxdb div").html(success);
                //$("#sms_ajaxdb").hide();
                $("#loading").replaceWith("<img class='dropdown-toggle img_edit img-circle' src='../app/templates/frontoffice/img/avatar/user.svg' data-toggle='dropdown'>");
            },
            error:  function () {
                notify('Error', 'No se ha podido borrar la imagen', '', 'warning');
            }
        });
    }

/*-------EDIT BANNER-------*/

    $("#user_banner").on('click', '#upload_banner', function(){
        $("#user_banner input").click();
    });

    $("#user_banner").on('click', '#delete_banner', function(){
        deletebanner();
        $("#banner_options").remove();
    });


     $('#user_banner').on('change', '#edit_banner', function(){
        $("#modalDg .modal-dialog").addClass("modal-lg");
        $("#modalDg .modal-title").html("Ajusta la imagen");
        $("#user_banner").find(".modal-title").text("Ajusta la imagen de banner");
        $("#modalDg .modal-body").html("<div class='banner-wrapper'><img id='inputfile-preview' src=''></div>");
        $("#modalDg .modal-footer").html("<button type='button' class='btn btn-default btn-raised' data-dismiss='modal'>Cerrar</button><button class='banner-like btn btn-primary btn-raised'>¡ME GUSTA!</button>");
        var reader = new FileReader();
        var input = document.getElementById('edit_banner');
        reader.onload = function (e){
            document.getElementById('inputfile-preview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
        var element = document.getElementById('inputfile-preview');

        $("#modalDg").on("shown.bs.modal", function() {
            $(element).cropper({
                aspectRatio: 2120/350
            });
        });

        $("#modalDg").modal('show');

        $("body").on('click','.banner-like', function(){
            var banner=$(element).cropper("getCroppedCanvas",{
                width: 2120,
                height: 350,
            }).toBlob(function (banner) {
                var formData = new FormData();

                formData.append('banner', banner);

                $.ajax({
                    url: '?section=user&action=uploadBanner',
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $fileupload = $('#edit_banner');
                        $fileupload.replaceWith($fileupload.clone(true));
                        $("#modalDg").modal('hide');
                        $("#user_banner_bg").replaceWith("<div id='loading'><div id='block_1' class='loading_block'></div><div id='blockG_2' class='loading_block'></div><div id='blockG_3' class='loading_block'></div></div>");
                    },
                    success: function (response) {
                        var imgsrc = response + "?d=" + new Date().getTime();
                        $("#user_banner #loading").replaceWith("<div id='user_banner_bg' class='dropdown dropdown-toggle img_edit' data-toggle='dropdown' style='background-image:url(\"../app/templates/frontoffice/img/banner/"+ imgsrc +"\")  !important'></div>");
                    },
                    error: function () {
                        console.log('Upload error');
                        alert("No se ha podido subir la imagen");
                    }
                });
            });
        });
     });

    function deletebanner(){
         $.ajax({
            url: '?section=user&action=deleteBanner',
            type: 'POST',
            beforeSend: function () {
                //$("#sms_ajaxdb div").html("Borrando imagen...");
                $("#user_banner .img_edit").replaceWith("<div id='loading'><div id='block_1' class='loading_block'></div><div id='blockG_2' class='loading_block'></div><div id='blockG_3' class='loading_block'></div></div>");
            },
            success:  function (success) {
                //$("#sms_ajaxdb div").html(success);
                //$("#sms_ajaxdb").hide();
                $("#loading").replaceWith("<div id='user_banner_bg' class='dropdown dropdown-toggle img_edit' data-toggle='dropdown' style='background-image:url(\"../app/templates/frontoffice/img/banner/banner.jpg\")  !important'></div>");
            },
            error:  function () {
                notify('Error', 'No se ha podido borrar la imagen', '', 'warning');
            }
        });
    }


/*----------TEXTO DE INFORMACIÓN---------*/

    $("span[contenteditable='true']").keyup(function(e){
        max = 255;
        var content=$(this);
        if(e.which != 8 && content.text().length > max)
        {
           content.text(content.text().substring(0, max));
           e.preventDefault();
        }
        e.preventDefault();
    });

    function dataURItoBlob(dataURI) {
        var binary = atob(dataURI.split(',')[1]);
        var array = [];
        for(var i = 0; i < binary.length; i++) {
            array.push(binary.charCodeAt(i));
        }
        return new Blob([new Uint8Array(array)], {type: 'image/jpeg'});
    }

/*-------------USER PRODUCTS----------------*/
    /*$("#my-lists").click(function(e){
        e.preventDefault();
        var userid=$("#user_profile").data("userid");
        $.ajax({
            url: '?section=user&action=getLists&userid='+userid,
            type: 'POST',
            beforeSend: function () {
                //$("#sms_ajaxdb div").html("Borrando imagen...");
                $("#user_products").html("<div id='loading'><div id='block_1' class='loading_block'></div><div id='blockG_2' class='loading_block'></div><div id='blockG_3' class='loading_block'></div></div>");
            },
            success:  function (success) {
                $("#user_products").html(success);
            },
            error:  function () {
                notify("Error al mostrar los resultados");
            }
        });
    });*/


});
