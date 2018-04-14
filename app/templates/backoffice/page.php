<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="robots" content="NOINDEX,NOFOLLOW">
		<title>BackOffice de <?=PAGE_NAME?></title>

        <link rel="apple-touch-icon" sizes="180x180" href="/app/templates/frontoffice/img/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/app/templates/frontoffice/img/icons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/app/templates/frontoffice/img/icons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/app/templates/frontoffice/img/icons/manifest.json">
        <link rel="mask-icon" href="/app/templates/frontoffice/img/icons/safari-pinned-tab.svg" color="#353535">
        <link rel="shortcut icon" href="/app/templates/frontoffice/img/icons/favicon.ico">
        <meta name="apple-mobile-web-app-title" content="<?=PAGE_NAME?>">
        <meta name="application-name" content="<?=PAGE_NAME?>">
        <meta name="msapplication-config" content="/app/templates/frontoffice/img/icons/browserconfig.xml">
        <meta name="theme-color" content="#353535">

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

        <!-- Bootstrap Core CSS -->
        <link href="/app/templates/backoffice/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="/app/templates/backoffice/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="/app/templates/backoffice/dist/css/timeline.css" rel="stylesheet">
        <!-- DataTables CSS -->
        <link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
        <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.bootstrap.min.css">

        <!-- Custom CSS -->
        <link href="/app/templates/backoffice/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="/app/templates/backoffice/bower_components/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="/app/templates/backoffice/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

        <!--Colorpicker -->
        <link rel="stylesheet" href="/vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">

        <!--Bootstrap select-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

        <!--FormValidation-------------------------->
		<script src="<?=PAGE_DOMAIN?>/vendor/formvalidation/js/formValidation.min.js"></script>
		<link rel="stylesheet" href="<?=PAGE_DOMAIN?>/vendor/formvalidation/css/formValidation.min.css">
        <script src="<?=PAGE_DOMAIN?>/vendor/formvalidation/js/framework/bootstrap.min.js"></script>
        <script src="<?=PAGE_DOMAIN?>/vendor/formvalidation/js/language/es_ES.js"></script>

        <!--Styles---------------------------------->
		<link rel="stylesheet" href="<?=PAGE_DOMAIN?>/app/templates/backoffice/css/common.css">
    </head>
    <body>

    <div id="wrapper">
      <!-- header -->
        <?php
            require_once 'app/templates/backoffice/header.php';
        ?>
        <div class="modal fade" id="modalDg" tabindex="-1" role="dialog" aria-labelledby="modalDgLabel">
          <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="page-wrapper">
            <?=$page?>
        </div>
        <footer>
            <?php
                require_once 'app/templates/backoffice/footer.php';
            ?>
        </footer>
    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="/app/templates/backoffice/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="<?=PAGE_DOMAIN?>/app/templates/backoffice/js/common.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/app/templates/backoffice/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="/app/templates/backoffice/bower_components/raphael/raphael-min.js"></script>
    <script src="/app/templates/backoffice/bower_components/morrisjs/morris.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>

    <!--Colorpicker JavaScript-->
    <script src="/vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

    <!--Bootstrap select-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-es_CL.min.js"></script>

    <!--Lightbox2------------>
    <script src="<?=PAGE_DOMAIN?>/vendor/lightbox2/src/js/lightbox.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=PAGE_DOMAIN?>/vendor/lightbox2/src/css/lightbox.css" />
    <?=@$data["custom_js"]?>
    <script>
        lightbox.option({
          'resizeDuration': 200,
          'wrapAround': true
        })
    </script>

    <!-- Custom Theme JavaScript -->
    <script src="/app/templates/backoffice/dist/js/sb-admin-2.js"></script>
</body>

</html>
