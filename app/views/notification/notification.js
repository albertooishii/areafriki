/*DOCUMENTACIÓN NOTIFICACIONES
notify(title, text, url, type, from, icon, time);
title = título de la notificación
text = mensaje principal
link = enlace de la notificación, al pinchar sobre ella redirige a este enlace. Con NULL o '' el link se desactiva.
type = tipo de notificación (warning, info, wins, proposal, project, event, default)
from = usuario que realiza la acción del mensaje
time = tiempo de la animación en ms, 0 para infinito (la notificación no desaparece), default o '' tiempo 7000.
classattr = clase de la notificación. Permite css y scripts propios.

Ejemplos:
notify('Nueva entrada en tu perfil', 'Hola me presento, me llamo albertoi, estoy programando las notificaciones. Un saludo.', '/user/albertoi', 'default', '1');
notify('Trofeo: Master Troll', 'Has ganado un trofeo por trollero. La culpa la tiene Darío.', '/user/dariomehr', 'wins');
notify('¡Aviso!', 'No tienes permisos para realizar esta acción. Para registrarte pincha aquí.', '/', 'warning');
notify('¡Te has conectado correctamente!', 'En breve estarás dentro y podrás participar en la comunidad','','info', '', '0');
notify('Nuevo producto publicado', 'Nombre del producto y descripcion','/camisetas/XXXXXX','producto');*/
var notifications_list;

$(document).ready(function() {

//CONSULTA DE NUEVAS NOTIFICACIONES
    if(typeof(EventSource) !== "undefined") {//para navegadores que soporten sse
        var source = new EventSource("?section=notification&action=getNews");
        source.onmessage = function(event) {
            //console.log(event.data);
            notifications_list=JSON.parse(event.data);
            $.each(notifications_list, function(index, notification){
                notify(notification.title, notification.text, notification.url, notification.tipo, notification.from_user, notification.icon);
            });
        };
    }else {//Para ie/edge y navegadores antiguos que no soporten el sse
        function nuevasNotificaciones(){
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "?section=notification&action=getNews",
                success: function (event){
                    console.log(event.data);
                    notifications_list=JSON.parse(event.data);
                    $.each(notifications_list, function(index, notification){
                        notify(notification.title, notification.text, notification.url, notification.tipo, notification.from_user, notification.icon, notification.class);
                    });
                }
            });
        }
        setInterval(nuevasNotificaciones, 1*5*1000);//ms
    }

    $("#notifications-icon").click(function(){
        $.ajax({
            type: "POST",
            url: "?section=notification&action=get",
            beforeSend: function(){
                $("#notifications-panel .notification-container").remove();
                $("#notifications-panel").append("<li class='loading notification-container'><i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i></li>");
            },
            success: function (response){
                $("#notifications-panel .loading").replaceWith(response);
                $('#notifications-panel').perfectScrollbar('destroy');
                $('#notifications-panel').perfectScrollbar({"suppressScrollX":true});
            }
        });
    });

    $("body").on("click", ".clear-notifications", function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "?section=notification&action=setLeido",
            success: function (response){
                $("#notifications-panel .notification-container").remove();
                $("#notifications-panel").append("<li class='notification-container'><div class='notification notification_header'>No hay nuevas notificaciones</div></li>");
                $("#header-notifications .header-count").html("0").hide();
                $('#notifications-panel').perfectScrollbar('destroy');
                $('#notifications-panel').perfectScrollbar({"suppressScrollX":true});
            }
        });
        e.stopPropagation();
    });

    $("body").on("click", ".remove-notification", function(e){
        e.preventDefault();
        var notificacion=$(this).closest(".notification");
        var data={
            "fecha":$(this).closest("notification").data("fecha")
        }

        $.ajax({
            type: "POST",
            url: "?section=notification&action=setLeido",
            data:data,
            success: function (response){
                var count=parseInt($("#header-notifications .header-count").html());
                if(count-1>0){
                    notificacion.remove();
                    $("#header-notifications .header-count").html(count-1).show();
                }else{
                    $("#notifications-panel .notification-container").remove();
                    $("#notifications-panel").append("<li class='notification-container'><div class='notification notification_header'>No hay nuevas notificaciones</div></li>");
                    $("#header-notifications .header-count").html("0").hide();
                }
                $('#notifications-panel').perfectScrollbar('destroy');
                $('#notifications-panel').perfectScrollbar({"suppressScrollX":true});
            }
        });
        e.stopPropagation();
    });
});

var notify = function(title, text, url, type, from, icon, classattr=false, time=false) {
    var iconhtml = "<img src='"+icon+"'>";
    var htmltitle = "<h4>" + title + "</h4>";
	var htmltext = "<p>" + text + "</p>";
	if (url == '' || url == undefined)url='#';
	if (!time)time=7000;

    var message = $("<div class='notification "+ type +" "+ classattr +"'><a href='" + url + "'><div class='row'><div class='col-md-4 col-sm-4 col-xs-4'>" + iconhtml + "</div><div class='col-md-8 col-sm-8 col-xs-8'><div class='notification-text'><div class='row'><div class='col-md-10 col-sm-10 col-xs-10'>" + htmltitle + "</div><div class='col-md-2 col-sm-2 col-xs-2 text-right'><div class='remove-push'><p><i class='material-icons'>close</i></p></div></div></div>" + htmltext + "</div></div></div></a></div>");
    sendnotify(message); 

	function sendnotify(message){
        //Notificacion web
		$('#notifications-wrapper').append(message);
		message.animate({
		 	right: parseInt(message.css('right'),350) == 0 ?
			-message.outerWidth() : 0
		}, function() {
			if (time != 0){
				window.setTimeout(function() {
					message.animate({
						right: parseInt(message.css('right'),0) == 0 ?
						-message.outerWidth() : 0
					}, function(){
						message.remove();
					})
				}, time);
			}
		});

        //Notificacion de escritorio
        if(Notification.permission=="granted") {
            var options = {
              body: text,
              icon: icon
            }
            var n = new Notification(title, options);
            n.onclick = function() {
                window.open(url);
            };
        }
        $("#header-notifications .header-count").html(parseInt($("#header-notifications .header-count").html())+1).show().addClass("bounceIn animated");
        $("#header-notifications .header-count").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $(this).removeClass('animated bounceIn');
        });
	}
}

//NOTIFICACIONES DE ESCRITORIO
// Validamos y activamos el Permiso para Notificar
if(Notification.permission!=="granted") {
	Notification.requestPermission();
}

// var notificador = document.getElementById("notificadorThingy");

// Instanciamos el botón, para que al hacer Click en el, se proceda a lanzar la Notificación o un mensaje para actualizar el Navegador
$("#btn_notificar").click(onNotificationButtonClick);

// Validamos si el Navegador soporta las Notificaciones en HTML 5
function onNotificationButtonClick() {
	if (!isNotificationSupported()) {
		logg("Tu navegador no soporta Notificaciones. Por favor, utiliza una versión Reciente del Navegador Google Chrome, Firefox o Safari.");
	return;
	}

	// Si el Navegador soporta las Notificaciones HTML 5, entonces que proceda a Notificar
	var notificacion = new Notification("Tienes nuevos Mensajes !", {
	    icon: 'img/gmail.png',
	    body: 'Abrir Bandeja de Gmail.'
	});

	// Redireccionamos a un determinado Destino o URL al hacer click en la Notificación
	notificacion.onclick = function() {
		window.open("http://gmail.com/");
	};
}

// Solicitamos los Permisos del Sistema
function requestPermissions() {

}

// Luego del Permiso del Sistema, le indicamos que nos Muestre la Notificación
function isNotificationSupported() {
	return ("Notification" in window);
}

// Mostramos el Mensaje de la Notificación
function logg(mensaje) {
	notificador.innerHTML += "<p>"+mensaje+"</p>";
}
