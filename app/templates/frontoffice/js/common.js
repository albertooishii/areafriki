if ('serviceWorker' in navigator) {
    // Override the default scope of '/' with './', so that the registration applies
    // to the current directory and everything underneath it.
    navigator.serviceWorker.register('/service-worker.js', {scope: './'}).then(function(registration) {
      // At this point, registration has taken place.
      // The service worker will not handle requests until this page and any
      // other instances of this page (in other tabs, etc.) have been
      // closed/reloaded.
      console.log('succeeded');
    }).catch(function(error) {
      // Something went wrong during registration. The service-worker.js file
      // might be unavailable or contain a syntax error.
      console.log(error);
    });
} else {
    // The current browser doesn't support service workers.
    var aElement = document.createElement('a');
    aElement.href = 'http://www.chromium.org/blink/serviceworker/service-worker-faq';
    aElement.textContent = 'unavailable';
    console.log(aElement);
}

document.addEventListener('DOMContentLoaded', function(event) {
    cookieChoices.showCookieConsentBar('Utilizamos cookies para proporcionarle un mejor servicio', 'Cerrar mensaje', 'Más información', '/info/cookies');
});

$(document).ready(function() {

    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();

    $('form').formValidation();
    $("body").on("form","submit",function(){
       $(this).formValidation();
    });

    $('#notifications-panel').perfectScrollbar({"suppressScrollX":true});

    //SISTEMA DE BÚSQUEDA
    $("#header-search").click(function(e){
        e.preventDefault();
        $(".masthead").addClass("searchmode");
        $("#search-container ").show();
        $("#search-container input").focus();
        e.stopPropagation();
    });

    $("#search-container").click(function(e){
        e.stopPropagation();
    });

    $("body").click(function(e){
        if($(".searchmode").length){
            e.preventDefault();
            $(".masthead").removeClass("searchmode");
            $("#header-search input").hide();
            $("#search-results").hide();
        }
    });

    var timer;
    $("#search-container input").keyup(function(e){
        clearTimeout(timer);
        var ms = 500; //milliseconds
        var string=$(this).val();
        $("#search-results").show();
        $("#search-results ul").html("<li>Buscando...</li>");
        timer = setTimeout(function(){
            search(string);
        }, ms);
    });

    function search(string){
        if(string!=''){
            var parametros={
                "string":string
            }

            $.ajax({
                type: "POST",
                url: "?section=producto&action=search",
                data: parametros,
                success: function (response){
                    $("#search-results").addClass("open");
                    $("#search-results ul").html(response);
                }
            });
        }else{
            $("#search-results").hide();
        }
    }

    //SISTEMA DE ETIQUETAS
    var engine = new Bloodhound({
        remote: {
            url: '/upload?action=loadTagsQuery&string=%QUERY',

            filter: function (response) {
                  return $.map(response, function (tag) {
                      return {
                          value: tag.nombre
                      };
                  });
              }
        },
        datumTokenizer: function (d) {
            return Bloodhound.tokenizers.whitespace(d.value);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    engine.initialize();

    $('#tokenfield-typeahead').tokenfield({
        typeahead: [null, {source: engine.ttAdapter() }],
        createTokensOnBlur: true
    });

    $(".remove").click(function(e){
        e.preventDefault();
        if (confirm("¿Seguro que quieres borrar este producto?")) {
            location.href=$(this).attr("href");
        }
    });

    var rangeSlider = $("input.slider").bootstrapSlider();


    //RANGO BENEFICIO
    $(".beneficio_range").change(function(e){
        var precio_venta=parseFloat($(this).val()) + parseFloat($(this).siblings(".precio_base").html().replace(',', '.'));
        $(this).closest(".form-group").find(".precio_venta").html(precio_venta.toFixed(2)+"€");
        $(this).closest(".form-group").find(".beneficio input").val($(this).val());
    });

    $(".beneficio input").change(function(e){
        $(this).closest(".form-group").find(".beneficio_range").bootstrapSlider('setValue', parseFloat($(this).val())).change();
    });

    $("body").on("keyup", "#precio",function(){
        $(this).change();
    });

    //Nueva lista de productos
    $("#add-list").click(function(e){
        e.preventDefault();
        $(".modal-title").html("Añade el nombre de la lista");
        $(".modal-body").html("<input class='form-control' type='text' name='list-name' placeholder='Nombre de la lista'>");
        $("#add-list-confirm").remove();
        $(".modal-footer").prepend("<a href='#' id='add-list-confirm' class='btn btn-warning btn-raised'>Añadir</a>");
        $('#modalDg').modal({backdrop: 'static', keyboard: false});
        $("body").on("click", ".close-modal", function(){
            $("#add-list-confirm").remove();
        });
    });

    $("body").on("click","#add-list-confirm", function(e){
        e.preventDefault();
        if($("input[name='list-name']").val().replace(/\s+/g, '').trim()!=""){
            var parametros={
                "list_name":$("input[name='list-name']").val()
            }
            $.ajax({
                type: "POST",
                url: "?section=producto&action=new_list",
                data: parametros,
                success: function (response){
                    $("#modalDg").modal('hide');
                    $("#add-list-confirm").remove();
                    $("#select-list").append(new Option($("input[name='list-name']").val(), response, true, true));
                    $("#select-list .selected").change();
                    //alert($("#select-list").val());
                }
            });
        }
    });


    //LIKES Y UNLIKES
    $("body").on("click", ".unlike-button a", function(event){
        var selected=$(this);
        var parametros = {
            producto: $(this).closest(".product").data('id'),
        }

        $.ajax({
            method: "POST",
            url: "/user?action=like",
            data: parametros,
            success: function (response){
                if(response){
                    $(selected).parent().removeClass("unlike-button").addClass("like-button");
                    $(selected).find('.contador').html((parseInt($(selected).find('.contador').html()) + 1));
                }else{
                    $(".modal-title").html("¡Aviso!");
                    $(".modal-body").html("<h4>Tienes que estar registrado/a para hacer esta acción</h4>");
                    $(".modal-footer").html("<a href='/login' class='btn btn-primary btn-round'>Iniciar sesión</a>");
                    $(".modal").modal();
                }
            }
        });
        event.preventDefault();
    });

    $("body").on("click", ".like-button a", function(event){
        event.preventDefault();
        var selected=$(this);
        var parametros = {
            producto: $(this).closest(".product").data('id'),
        }

        $.ajax({
            method: "POST",
            url: "/user?action=unlike",
            data: parametros,
            success: function (response){
                if(response){
                    $(selected).parent().removeClass("like-button").addClass("unlike-button");
                    $(selected).find('.contador').html((parseInt($(selected).find('.contador').html()) -1 ));
                }else{
                    $(".modal-title").html("¡Aviso!");
                    $(".modal-body").html("<h4>Tienes que estar registrado/a para hacer esta acción</h4>");
                    $(".modal-footer").html("<a href='/login' class='btn btn-primary btn-round'>Iniciar sesión</a>");
                    $(".modal").modal();
                }
            }
        });
    });

    //SHARES
    $("body").on("click", ".share-button a", function(event){
        event.preventDefault();
        $("*").removeClass("share-button-selected");
        $(this).parent(".share-button").addClass("share-button-selected");
        var selected=$(this);
        var categoria= $(this).closest(".product").data("categoria");
        var token= $(this).closest(".product").data("token");
        $(".modal-dialog").removeClass("modal-lg").addClass("modal-sm");
        $(".modal-title").html("Compartir");
        $(".modal-body").html("<p>Comparte este producto en las redes sociales</p>");
        var parametros={
            "categoria": categoria,
            "token": token
        };
        $.ajax({
            method: "POST",
            url: "/index.php?section=producto&action=share",
            data: parametros,
            success: function (response){
                $(".modal-body").append(response);
                $('#modalDg').modal() ;
            }
        });
    });

    $("body").on("click", "#share-dialog a", function(event){

        var parametros={
            "categoria": $(this).closest("#share-dialog").data("categoria"),
            "token": $(this).closest("#share-dialog").data("token")
        };
        $.ajax({
            method: "POST",
            url: "/index.php?section=producto&action=countShare",
            data: parametros,
            success: function (response){
                if(response==1){
                    $(".share-button-selected").find('.contador').html((parseInt($(".share-button-selected").find('.contador').html()) + 1));
                    $("#modalDg").modal("hide");
                }
                event.stopPropagation();
            }
        });
    });

    $("body").on("click", ".btn-copy", function(event){
        event.preventDefault();
        if(copyToClipboard($(this).children("input"))){
            tosnackbar("Copiado al portapapeles");
        }else{
            tosnackbar("No se ha podido copiar el enlace");
        }
    });

    function copyToClipboard(elem) {
        // create hidden text element, if it doesn't already exist
        var targetId = "_hiddenCopyText_";
        var origSelectionStart, origSelectionEnd;

        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.val();
        // select the content
        var currentFocus = document.activeElement;
        target.focus();
        target.setSelectionRange(0, target.value.length);

        // copy the selection
        var succeed;
        try {
            succeed = document.execCommand("copy");
        } catch(e) {
            succeed = false;
        }
        // restore original focus
        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }

        // clear temporary content
        target.textContent = "";
        return succeed;
    }

    //OTRAS
    $('body').on('keydown paste', '[contenteditable]', function(e) {
        var $field = $(e.currentTarget);
        if (e.keyCode===13 && $field.hasClass('multiline')) {
            return true;
        } else if (e.keyCode===13 || e.type==='paste') {
            setTimeout(function() {
                $field.html($field.text());
            },0);
        }
    });

    $('body').on('drop', '[contenteditable]', function(e) {
        e.preventDefault();
    });


    $('.owl-carousel').owlCarousel({
        stagePadding: 30,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            480:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            },
            1200:{
                items:4
            },
        },
    });
});

function tosnackbar(string){
    var options =  {
        content: string, // text of the snackbar
    }

    var snackbar=$.snackbar(options);
    var elementid=snackbar.get(0).id;
    $("#"+elementid).snackbar("show");
}

function productoPublicado(){
    $(".modal-title").html("Producto publicado correctamente");
    $(".modal-body").html("Tu producto se ha publicado correctamente. Nuestros moderadores comprobarán que cumple todas las normas de uso de la plataforma al producto antes de que sea visible públicamente. Se te avisará mediante un correo electrónico cuando sea aprobado.");
    $('#modalDg').modal({backdrop: 'static', keyboard: false});
    $(".close, .close-modal").click(function(){
        window.location.href="/user/"+$("#login_user").data("user");
    });
}

$('#modalDg').on('hidden.bs.modal', function () {
    $(".modal-footer").html("<button type='button' class='btn btn-default close-modal btn-raised' data-dismiss='modal'>Cerrar</button>");
})

function dataURLtoBlob(dataurl) {
    var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
    while(n--){
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new Blob([u8arr], {type:mime});
}

// Cookies
function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";

    var fixedName = '<%= Request["formName"] %>';
    name = fixedName + name;

    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}
