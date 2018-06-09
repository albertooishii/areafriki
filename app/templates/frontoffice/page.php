<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="canonical" href="<?=PAGE_DOMAIN.$_SERVER["REQUEST_URI"]?>" />
        <link rel="alternate" hreflang="es" href="<?=PAGE_DOMAIN.$_SERVER["REQUEST_URI"]?>">
        <?=$data["meta_tags"]?>

        <link rel="apple-touch-icon" sizes="180x180" href="/app/templates/frontoffice/img/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/app/templates/frontoffice/img/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/app/templates/frontoffice/img/icons/favicon-16x16.png">
        <link rel="manifest" href="/app/templates/frontoffice/img/icons/site.webmanifest">
        <link rel="mask-icon" href="/app/templates/frontoffice/img/icons/safari-pinned-tab.svg" color="#fab809">
        <link rel="shortcut icon" href="/app/templates/frontoffice/img/icons/favicon.ico">
        <meta name="apple-mobile-web-app-title" content="<?=PAGE_NAME?>">
        <meta name="application-name" content="<?=PAGE_NAME?>">
        <meta name="msapplication-TileColor" content="#fab809">
        <meta name="msapplication-config" content="/app/templates/frontoffice/img/icons/browserconfig.xml">
        <meta name="theme-color" content="#353535">

		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
        <noscript>
            <div class="noscript">
            <p>Tu navegador no soporta Javascript. Actualiza a un navegador más reciente o activa esta función para que la web funcione correctamente.</p>
            </div>
        </noscript>
        <!--Bootstrap -->
        <link rel="stylesheet" href="/vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <!-- Material Kit -->
        <!--<link href="/vendor/material-kit-pro/css/material-kit.css" rel="stylesheet"/>-->
        <!--Fonts and icons -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
        <?=@$data["custom_css"]?>
        <?=$data["min_css"]?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', '<?=GOOGLE_ANALYTICS?>', 'auto');
            ga('send', 'pageview');
        </script>
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
        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '164226414047284');
            fbq('track', 'PageView');
            <?=@$data['fbevent']?>
        </script>
        <noscript>
            <img height="1" width="1"
            src="https://www.facebook.com/tr?id=164226414047284&ev=PageView
            &noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
        <!-- Hotjar Tracking Code for http://dev.areafriki.com -->
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:<?=HOTJAR?>,hjsv:5};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');

            hj('tagRecording', ['<?=$this->u->user?>', '<?=$this->u->email?>']);

        </script>
        <!--Start of Tawk.to Script-->
            <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/585d498e6343131686627cfa/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
            <?php
                if(isset($_SESSION["login"])){
            ?>
            Tawk_API.visitor = {
                name  : '<?=$this->u->user?>',
                email : '<?=$this->u->email?>'
            };
            <?php
                }
            ?>
        </script>
        <!--End of Tawk.to Script-->
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
        <!--Style (footer css)-->
        <!--FormValidation -->
        <link rel="stylesheet" href="/vendor/formvalidation/css/formValidation.min.css">
        <!--FileInput -->
        <link rel="stylesheet" href="/vendor/bootstrap-fileinput/css/fileinput.min.css">
        <!--Lightbox2 -->
        <link rel="stylesheet" href="/vendor/lightbox2/dist/css/lightbox.min.css">
        <!--Cropper -->
        <link rel="stylesheet" href="/vendor/cropper/cropper.min.css">
        <!--Animate -->
        <!--<link rel="stylesheet" href="/vendor/animate.css">-->
        <!--PerfectScrollbar -->
        <link rel="stylesheet" href="/vendor/perfect-scrollbar/css/perfect-scrollbar.min.css">
        <!--Bootstrap range slider -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/css/bootstrap-slider.min.css">
        <!--Bootstrap select-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
        <!--DropdownJs-->
		<link rel="stylesheet" href="/vendor/dropdownjs/jquery.dropdown.css">
        <!--Bootstrap-tokenfield -->
        <link rel="stylesheet" href="/vendor/bootstrap-tokenfield/css/bootstrap-tokenfield.min.css">
        <link rel="stylesheet" href="/vendor/bootstrap-tokenfield/css/tokenfield-typeahead.min.css">
        <!--Snackbar -->
        <link rel="stylesheet" href="/vendor/snackbarjs/dist/snackbar.min.css">
        <link rel="stylesheet" href="/vendor/snackbarjs/themes-css/material.css">

        <!--Scripts -->
        <!--jQuery--->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/bootstrap-slider.min.js"></script>
        <!--Bootstrap-->
        <script src="/vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <!--Bootstrap select-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-es_ES.min.js"></script>
        <!--Material design bootstrap-->
        <script type="text/javascript" src="/vendor/material-kit-pro/js/material.min.js"></script>
        <script type="text/javascript" src="/vendor/snackbarjs/dist/snackbar.min.js"></script>
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
        </script>
	</body>
</html>
