<?php
    include_once 'app/core/controller.php';

    class CMS extends Controller{

        function index_cms(){
            $data['page_title'] = "Información";
            $this->render('info', $_GET["node"], $data);
        }
    }
?>
