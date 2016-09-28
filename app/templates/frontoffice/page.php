<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="canonical" hreflang="es" href="<?=PAGE_DOMAIN.$_SERVER["REQUEST_URI"]?>" />
		<title><?=PAGE_NAME?> | <?=$data['page_title']?></title>
        <?=$data["meta_tags"]?>
        <meta name="apple-mobile-web-app-title" content="ÁreaFriki">
        <meta name="application-name" content="ÁreaFriki">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-TileImage" content="/app/templates/frontoffice/img/icons/mstile-144x144.png">
        <meta name="msapplication-config" content="/app/templates/frontoffice/img/icons/browserconfig.xml">
        <meta name="theme-color" content="#222222">
        <link rel="apple-touch-icon" sizes="57x57" href="/app/templates/frontoffice/img/icons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/app/templates/frontoffice/img/icons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/app/templates/frontoffice/img/icons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/app/templates/frontoffice/img/icons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/app/templates/frontoffice/img/icons/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/app/templates/frontoffice/img/icons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/app/templates/frontoffice/img/icons/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/app/templates/frontoffice/img/icons/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/app/templates/frontoffice/img/icons/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="/app/templates/frontoffice/img/icons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/app/templates/frontoffice/img/icons/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="/app/templates/frontoffice/img/icons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/app/templates/frontoffice/img/icons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/app/templates/frontoffice/img/icons/manifest.json">
        <link rel="mask-icon" href="/app/templates/frontoffice/img/icons/safari-pinned-tab.svg">
        <link rel="shortcut icon" href="/app/templates/frontoffice/img/icons/favicon.ico">
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
        <noscript>
            <div class="noscript">
            <p>Tu navegador no soporta Javascript. Actualiza a un navegador más reciente o activa esta función para que la web funcione correctamente.</p>
            </div>
        </noscript>
        <!--Fonts and icons -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
        <!--Bootstrap -->
        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <!--Bootstrap select-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
        <!-- Material Kit -->
        <link href="/vendor/material-kit-pro/css/material-kit.css" rel="stylesheet"/>
        <!--Bootstrap range slider -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/css/bootstrap-slider.min.css">
        <!--DropdownJs-->
		<link rel="stylesheet" href="/vendor/dropdownjs/jquery.dropdown.css">
        <!--Bootstrap-tokenfield -->
        <link rel="stylesheet" href="/vendor/bootstrap-tokenfield/css/bootstrap-tokenfield.min.css">
        <link rel="stylesheet" href="/vendor/bootstrap-tokenfield/css/tokenfield-typeahead.min.css">
        <!--OwlCarousel -->
        <link rel="stylesheet" href="/vendor/owl-carousel/assets/owl.carousel.css">
        <link rel="stylesheet" href="/vendor/owl-carousel/assets/owl.theme.default.min.css">
        <!--FormValidation -->
        <link rel="stylesheet" href="/vendor/formvalidation/css/formValidation.min.css">
        <!--FileInput -->
        <link rel="stylesheet" href="/vendor/bootstrap-fileinput/css/fileinput.min.css">
        <!--Lightbox2 -->
        <link rel="stylesheet" href="/vendor/lightbox2/dist/css/lightbox.min.css">
        <!--Cropper -->
        <link rel="stylesheet" href="/vendor/cropper/cropper.min.css">
        <!--Snackbar -->
        <link rel="stylesheet" href="/vendor/snackbarjs/dist/snackbar.min.css">
        <!--Animate -->
        <link rel="stylesheet" href="/vendor/animate.css">
        <!--PerfectScrollbar -->
        <link rel="stylesheet" href="/vendor/perfect-scrollbar/css/perfect-scrollbar.min.css">
        <!--emojis -->
        <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">

        <?=@$data["custom_css"]?>
        <?=$data["min_css"]?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-78536667-1', 'auto');
            ga('send', 'pageview');
        </script>
        <!--jQuery--->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

        <script>
          window.fbAsyncInit = function() {
            FB.init({
              appId      : '1215279765157571',
              xfbml      : true,
              version    : 'v2.6'
            });
          };

          (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/en_US/sdk.js";
             fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));
        </script>
	</head>
	<body>
      <!-- header -->
        <?=$header?>
      <!-- end: header -->
      <!-- contenido -->
        <main>
            <?=$page?>
        </main>
      <!-- end: contenido -->
      <!-- footer -->
        <?=$footer?>
        <!-- end: footer -->
        <!--Scripts -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/bootstrap-slider.min.js"></script>
        <!--Bootstrap-->
        <script type="text/javascript" src="/vendor/material-kit-pro/js/bootstrap.min.js"></script>
        <!--Bootstrap select-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/i18n/defaults-es_CL.min.js"></script>
        <!--Material design bootstrap-->
        <script type="text/javascript" src="/vendor/material-kit-pro/js/material.min.js"></script>
        <script type="text/javascript" src="/vendor/snackbarjs/dist/snackbar.min.js"></script>
        <script type="text/javascript" src="/vendor/waypoints/lib/jquery.waypoints.min.js"></script>
        <script type="text/javascript" src="/vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>

        <script type="text/javascript" src="/vendor/lightbox2/dist/js/lightbox.min.js"></script>

        <!--FormValidation -->
        <script type="text/javascript" src="/vendor/formvalidation/js/formValidation.min.js"></script>
        <script type="text/javascript" src="/vendor/formvalidation/js/framework/bootstrap.min.js"></script>
        <script type="text/javascript" src="/vendor/formvalidation/js/language/es_ES.js"></script>

        <script type="text/javascript" src="/vendor/cropper/cropper.min.js"></script>

        <!--Bootstrap fileinput -->
        <script type="text/javascript" src="/vendor/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js"></script>
        <script type="text/javascript" src="/vendor/bootstrap-fileinput/js/plugins/sortable.min.js"></script>
        <script type="text/javascript" src="/vendor/bootstrap-fileinput/js/fileinput.min.js"></script>
        <script type="text/javascript" src="/vendor/bootstrap-fileinput/js/locales/es.js"></script>
        <script type="text/javascript" src="/vendor/bootstrap-fileinput/js/themes/gly.js"></script>

        <script type="text/javascript" src="/vendor/owl-carousel/owl.carousel.min.js"></script>
        <script type="text/javascript" src="/vendor/bootstrap-tokenfield/bootstrap-tokenfield.min.js"></script>
        <script type="text/javascript" src="/vendor/bootstrap-tokenfield/typeahead.bundle.min.js"></script>

        <?=$data["min_js"]?>
        <?=@$data["custom_js"]?>
        <script>
            lightbox.option({
              'resizeDuration': 200,
              'wrapAround': true
            });
            $.material.init();
            $("select").dropdown();
        </script>
	</body>
</html>
