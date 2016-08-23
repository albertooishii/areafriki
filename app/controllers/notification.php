<?php
    class Notification extends Controller{

        function index_notification(){
            if(isset($_SESSION["login"])){
                $this->loadModel("notification");
                $notify = New Notification_Model();
                $this->loadModel("producto");
                $p = New Producto_Model();
                $this->loadModel("categoria");
                $cat = New Categoria_Model();
                $this->loadModel("design");
                $dg = New Design_Model();
                $from_user = New Users_Model();

                @$action=$_GET["action"];
                switch($action){
                    case 'setLeido':
                        $notify->to=$this->u->id;
                        if(isset($_POST["fecha"])){
                            $notify->fecha=$_POST["fecha"];
                        }
                        if($notify->setLeido()){
                            echo true;
                        }else{
                            echo false;
                        }
                    break;

                    case 'get':
                        $notify->to=$this->u->id;
                        $from_user = New Users_Model();
                        if($lista_notificaciones=$notify->get()){
                            $data["notificaciones_header"]="";
                            foreach($lista_notificaciones as $notificacion){
                                $data["notification_url"]=PAGE_DOMAIN."/".$notificacion["url"];
                                $data["notification_type"]=$notificacion["tipo"];
                                switch($notificacion["tipo"]){
                                    //comentario, compra, follow, like, publicacion, noticia
                                    case 'comentario': case 'follow': case 'like': case 'publicacion';
                                        $from_user->id=$notificacion["from_user"];
                                        $from_user->user=$from_user->getUserFromID()["user"];
                                        $data["notification_icon"]=PAGE_DOMAIN."/".$from_user->getAvatar();
                                    break;
                                    case 'compra':
                                        $p->id=$notificacion["producto"];
                                        $producto=$p->get();
                                        $dg->token=$producto["design"];
                                        $cat->id=$producto["categoria"];
                                        $data["notification_icon"]=PAGE_DOMAIN."/designs/".$this->u->user."/".$dg->token."/".$cat->get()["nombre"]."/thumb-".$dg->token.".jpg";
                                    break;
                                }
                                $data["unformat_date"]=$notificacion["fecha"];
                               $data["fecha"]=$this->format_date($notificacion["fecha"]); $data["notification_title"]=$notificacion["title"];
                                $data["notification_text"]=$notificacion["text"];
                                $data["notificaciones_header"].=$this->loadView("notification","notification",$data);
                            }
                        }else{
                            $data["notificaciones_header"]="<li class='notification-container'><div class='notification notification_header'>No hay nuevas notificaciones</div></li>";
                        }
                        echo $data["notificaciones_header"];
                    break;

                    case 'getNews':
                        header('Content-Type: text/event-stream');
                        header('Cache-Control: no-cache');

                        if(isset($_SESSION["login"])){
                            $notify->to=$this->u->id;
                            if($lista_notificaciones=$notify->getNews()){
                                $data=array();
                                foreach($lista_notificaciones as $key => $notificacion){
                                    $data[$key]["fecha"]=$notificacion["fecha"];
                                    $data[$key]["from_user"]=$notificacion["from_user"];
                                    $data[$key]["producto"]=$notificacion["producto"];
                                    $data[$key]["title"]=$notificacion["title"];
                                    $data[$key]["text"]=$notificacion["text"];
                                    $data[$key]["url"]=PAGE_DOMAIN."/".$notificacion["url"];
                                    $data[$key]["tipo"]=$notificacion["tipo"];
                                    switch($notificacion["tipo"]){
                                        //comentario, compra, follow, like, publicacion, noticia
                                        case 'comentario': case 'follow': case 'like': case 'publicacion';
                                            $from_user->id=$notificacion["from_user"];
                                            $from_user->user=$from_user->getUserFromID()["user"];
                                            $data[$key]["icon"]=PAGE_DOMAIN."/".$from_user->getAvatar();
                                        break;
                                        case 'compra':
                                            $p->id=$notificacion["producto"];
                                            $producto=$p->get();
                                            $dg->token=$producto["design"];
                                            $cat->id=$producto["categoria"];
                                            $data[$key]["icon"]=PAGE_DOMAIN."/designs/".$this->u->user."/".$dg->token."/".$cat->get()["nombre"]."/thumb-".$dg->token.".jpg";
                                        break;

                                        default:
                                            $data[$key]["icon"]='';
                                    }
                                }
                                echo 'data: ' . json_encode($data) . "\n\n";
                            }else{
                                echo false;
                            }
                        }else{
                            echo false;
                        }
                        flush();
                    break;
                }
            }
        }
    }
?>
