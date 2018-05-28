<?php
    class Mailing extends Controller{

        function index_mailing(){
            $this->loadModel("mailing");
            $mailing = New Mailing_Model();
            @$action=$_GET["action"];
            switch($action){

                case 'update':
                    if(isset($_POST['lists'])) {
                        $mailing->email=$this->u->email;
                        $mailing->lists = $_POST['lists'];
                        if($mailing->update()){
                            header("Location:".$_SERVER['HTTP_REFERER']);
                        }
                    }
                break;

                case 'set':
                    if(isset($_POST['lists'])) {
                        $mailing->email=$this->u->email;
                        $mailing->name=$this->u->user;
                        $mailing->lists = $_POST['lists'];
                        $mailing->set();
                    }

                    if(!empty($_POST["redirect"])){
                        Header("Location: ".$_POST["redirect"]);
                    }else{
                        Header("Location: ".PAGE_DOMAIN);
                    }
                break;

                default:
                    if(isset($_SESSION["login"])) {
                        $this->render('mailing', 'mailing', $data);
                    } else {
                        $this->render("error","404");
                    }
            }
        }
    }
?>
