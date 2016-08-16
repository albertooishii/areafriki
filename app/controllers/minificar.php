<?php
require_once 'min/utils.php';
class MinificarController{
    public function css()
    {
        $cssUri = Minify_getUri([ // a list of files
            'vendor/dropdownjs/jquery.dropdown.css',
            'vendor/bootstrap-tokenfield/css/bootstrap-tokenfield.min.css',
            'vendor/bootstrap-tokenfield/css/tokenfield-typeahead.min.css',
            'vendor/materialize-tags/css/materialize-tags.min.css',
            'vendor/owl-carousel/assets/owl.carousel.css',
            'vendor/owl-carousel/assets/owl.theme.default.min.css',
            'vendor/formvalidation/css/formValidation.min.css',
            'vendor/bootstrap-fileinput/css/fileinput.min.css',
            'vendor/lightbox2/dist/css/lightbox.min.css',
            'vendor/cropper/cropper.min.css',
            'vendor/snackbarjs/dist/snackbar.min.css',
            'vendor/animate.css',
            //'app/templates/frontoffice/css/common.css',
        ]);
        return "<link rel=stylesheet href='{$cssUri}'>";
    }

    public function js(){
        $jsUri = Minify_getUri([
            'vendor/lightbox2/dist/js/lightbox.min.js',
            'vendor/formvalidation/js/formValidation.min.js',
            'vendor/formvalidation/js/framework/bootstrap.min.js',
            'vendor/formvalidation/js/language/es_ES.js',
            'vendor/cropper/cropper.min.js',
            'vendor/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js',
            'vendor/bootstrap-fileinput/js/plugins/sortable.min.js',
            'vendor/bootstrap-fileinput/js/fileinput.min.js',
            'vendor/bootstrap-fileinput/js/locales/es.js',
            'vendor/bootstrap-fileinput/js/themes/gly.js',
            'vendor/owl-carousel/owl.carousel.min.js',
            'vendor/bootstrap-tokenfield/bootstrap-tokenfield.min.js',
            'vendor/bootstrap-tokenfield/typeahead.bundle.min.js',
            //'vendor/modernizr-custom.js',
            //'app/templates/frontoffice/js/common.js',
        ]); // a key in groupsConfig.php
        return "<script src='{$jsUri}'></script>";
    }
}
?>
