<?php
    include_once 'app/core/controller.php';

    class Beta extends Controller{

        function index_beta(){
            $data['page_title'] = "Inicio";
            $this->render('home', 'beta', $data);
        }
    }
?>
