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
            }
        }
    }
?>
