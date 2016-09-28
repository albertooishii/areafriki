<?php
require_once 'min/utils.php';
class MinificarController{
    public function css()
    {
        $cssUri = Minify_getUri([ // a list of files
            'app/templates/frontoffice/css/common.css'
        ]);
        return "<link rel=stylesheet href='{$cssUri}'>";
    }

    public function js(){
        $jsUri = Minify_getUri([
            'vendor/cookiechoices/cookiechoices.js',
            'vendor/material-kit-pro/js/material-kit.js',
            'vendor/material-kit-pro/js/jquery.dropdown.js',
            'app/views/notification/notification.js',
            'app/templates/frontoffice/js/common.js',
        ]); // a key in groupsConfig.php
        return "<script src='{$jsUri}'></script>";
    }
}
?>
