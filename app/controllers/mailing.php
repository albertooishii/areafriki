<?php
    class Mailing extends Controller{

        function index_mailing(){
            $this->loadModel("mailing");
            $mailing = New Mailing_Model();
            @$action=$_GET["action"];
            switch($action){

                case 'get':

                break;

                case 'set':
                    $mailing->user=$this->u->id;
                    $mailing->email=$_POST["email"];
                    if($mailing->set()){
                        //Suscrito correctamente
                        $data["titulo_mensaje"]="Te has suscrito correctamente";
                        $data["texto_mensaje"]="A partir de ahora podrás recibir información y ofertas exclusivas en tu email. Puedes gestionar tu suscripción desde aquí.";
                    }else{
                        //Ya te habías suscrito anteriormente
                        $data["titulo_mensaje"]="Error al suscribirte";
                        $data["texto_mensaje"]="Tu dirección de email ya estaba registrada en nuestro sistema de suscripción. No es necesario suscribirse de nuevo.";
                    }
                    $this->render("mensaje","mensaje",$data);
                break;

                case 'delete':

                break;

                default:
                    if(isset($_SESSION["login"])) {
                        $this->u->name = $info_user=$this->u->getUser()['name'];
                        if(isset($_POST["mailing"])){
                            $this->loadModel("mailing");
                            $mailing = New Mailing_Model();
                            $mailing->user=$_POST["username"];
                            $mailing->email=$_POST["email"];
                            $mailing->set();
                        }

                        if(!empty($_POST["redirect"])){
                            $data['skip'] = $_POST["redirect"];
                        }else{
                            $data['skip'] = PAGE_DOMAIN;
                        }
                        $this->render('mailing', 'mailing', $data);


                        /*if(!empty($_POST["redirect"])){
                            Header("Location: ".$_POST["redirect"]);
                        }else{
                            Header("Location: ".PAGE_DOMAIN);
                        }*/
                    } else {
                        $this->render("error","404");
                    }
            }
        }
    }
?>
