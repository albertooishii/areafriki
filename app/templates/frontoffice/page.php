<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="canonical" hreflang="es" href="<?=PAGE_DOMAIN.$_SERVER["REQUEST_URI"]?>" />
		<title><?=$data['page_title']?> | <?=PAGE_NAME?></title>
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
        <!--     Fonts and icons     -->
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
        <?=@$data["custom_css"]?>
        <?=$data["min_css"]?>
        <link rel="stylesheet" href="<?=PAGE_DOMAIN?>/app/templates/frontoffice/css/common.css">
        <!--<script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-78536667-1', 'auto');
            ga('send', 'pageview');
        </script>-->
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
        <script type="text/javascript" src="/vendor/material-kit-pro/js/jquery.dropdown.js"></script>
        <script type="text/javascript" src="/vendor/cookiechoices/cookiechoices.js"></script>
        <script type="text/javascript" src="/vendor/snackbarjs/dist/snackbar.min.js"></script>
        <script type="text/javascript" src="/vendor/waypoints/lib/jquery.waypoints.min.js"></script>
        <script type="text/javascript" src="/vendor/material-kit-pro/js/material-kit.js"></script>
        <?=$data["min_js"]?>
        <?=@$data["custom_js"]?>
        <script type="text/javascript" src="/app/templates/frontoffice/js/common.js"></script>
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
