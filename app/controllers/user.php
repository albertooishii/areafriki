<?php
    class User extends Controller{

        function index_users(){

            $creador = New Users_Model();
            $this->loadModel("producto");
            $p = New Producto_Model();
            $this->loadModel("design");
            $dg = New Design_Model();
            $this->loadModel("categoria");
            $cat = New Categoria_Model();
            $this->loadModel("notification");
            $notify = New Notification_Model();
            @$action=$_GET["action"];
            $data["reg_msg"]=$data["login_msg"]="";
            switch($action){
                case 'register':
                    $data['page_title']="Bienvenido a ".PAGE_NAME;
                    $data["reg_msg"]="";
                    if($_POST){
                        $this->u->name=trim($_POST["nombre"]);
                        $this->u->user=trim($_POST["username"]);
                        $this->u->email=trim($_POST["email"]);
                        $this->u->pass=md5($_POST["password"]);
                        $this->u->rol="user";
                        $this->u->ip=$this->getIP();
                        if(isset($_COOKIE["referral"])){
                            $this->u->referral=$_COOKIE["referral"];
                        }
                        if($this->u->register()){
                            if(isset($_POST["mailing"])){
                                $this->loadModel("mailing");
                                $mailing = New Mailing_Model();
                                $mailing->user=$_POST["username"];
                                $mailing->email=$_POST["email"];
                                $mailing->set();
                            }
                            if(!empty($_POST["redirect"])){
                                Header("Location: ".$_POST["redirect"]);
                            }else{
                                Header("Location: ".PAGE_DOMAIN);
                            }
                        }else{
                            $data["reg_msg"]=$this->loadView('error','form_error',"Ya hay un usuario registrado con estos datos (email o nombre de usuario).");
                            $data["custom_js"]=$this->minifyJs("user/js", "register");
                            $this->render('user','register',$data);
                        }
                    }else{
                        $data["custom_js"]=$this->minifyJs("user/js", "register");
                        $this->render('user','register',$data);
                    }
                break;

                case 'login':
                    $data['page_title']="Bienvenido a ".PAGE_NAME;
                    if(!empty($_POST["username"])){
                        if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$_POST["username"])){
                            $this->u->email=$_POST["username"];
                        }else{
                            $this->u->user=$_POST["username"];
                        }
                        $this->u->pass=md5($_POST["password"]);
                        if(isset($_POST["loginrec"])){
                            $loginrec=1;
                        }else{$loginrec=0;}
                        if(!isset($_REQUEST["activation_key"])){
                            if($this->u->login($loginrec)){
                                $this->loadModel('carrito');
                                $car=New Carrito_Model();
                                $car->user=$this->u->id;
                                $car->asignar();
                                $this->loadModel("pedido");
                                $ped = New Pedido_Model();
                                $ped->user=$this->u->id;
                                $ped->email=$this->u->email;
                                $ped->asignarPedidos();
                                if(!empty($_POST["redirect"])){
                                    Header("Location: ".$_POST["redirect"]);
                                }else{
                                    Header("Location: ".PAGE_DOMAIN);
                                }
                            }else{
                                $data["login_msg"]=$this->loadView('error','form_error',"El nombre de usuario o la contraseña no son válidos.");
                                $this->render('user','login',$data);
                            }
                        }else{
                            if($this->u->activate($_REQUEST["activation_key"])){
                                if($this->u->login($loginrec)){
                                    $this->loadModel('carrito');
                                    $car=New Carrito_Model();
                                    $car->user=$this->u->id;
                                    $car->asignar();
                                    $this->loadModel("pedido");
                                    $ped = New Pedido_Model();
                                    $ped->user=$this->u->id;
                                    $ped->email=$this->u->email;
                                    $ped->asignarPedidos();
                                    if(!empty($_POST["redirect"])){
                                        Header("Location: ".$_POST["redirect"]);
                                    }else{
                                        Header("Location: ".PAGE_DOMAIN);
                                    }
                                }else{
                                    $data["login_msg"]=$this->loadView('error','form_error',"El nombre de usuario o la contraseña no son válidos.");
                                    $this->render('user','activation_form',$data);
                                }
                            }else{
                                 $data["login_msg"]=$this->loadView('error','form_error',"Esta cuenta ya está activada.");
                                $data["activation_key"]=$_REQUEST["activation_key"];
                                $this->render('user','activation_form',$data);
                            }
                        }
                    }else{
                        if(isset($_REQUEST["activation_key"])){
                            if(isset($_SESSION["login"]["user"])){
                                $this->u->pass=$_SESSION["login"]["pass"];
                                //Intentamos activar con la sesion iniciada
                                if($this->u->activate($_REQUEST["activation_key"])){
                                    $this->u->updateVecesLogin();
                                    $this->loadModel('carrito');
                                    $car=New Carrito_Model();
                                    $car->user=$this->u->id;
                                    $car->asignar();
                                    $this->loadModel("pedido");
                                    $ped = New Pedido_Model();
                                    $ped->user=$this->u->id;
                                    $ped->email=$this->u->email;
                                    $ped->asignarPedidos();
                                    if(!empty($_POST["redirect"])){
                                        Header("Location: ".$_POST["redirect"]);
                                    }else{
                                        Header("Location: ".PAGE_DOMAIN);
                                    }
                                }else{ //Si no deja pedimos los datos de acceso
                                    $data["activation_key"]=$_REQUEST["activation_key"];
                                    $this->render('user','activation_form',$data);
                                }
                            }else{
                                $data["activation_key"]=$_REQUEST["activation_key"];
                                $this->render('user','activation_form',$data);
                            }
                        }else{
                            $this->render('user','login',$data);
                        }
                    }

                break;

                case 'sendactivation':
                    if(isset($_SESSION["login"]) && !$this->u->getUser_activeaccount()){
                        $this->u->email=$this->u->getUser()["email"];
                        if($this->u->sendActivationMail()){
                            $data["titulo_mensaje"]="¡Email de activación enviado!";
                            $data["texto_mensaje"]="Hemos enviado un email a la dirección de correo que nos has facilitado al registrarte con un enlace único para poder verificar tu cuenta. Puede tardar hasta 5 minutos desde que te registraste. No olvides revisar tu bandeja de spam/no deseado.";
                        }else{
                            $data["titulo_mensaje"]="Error";
                            $data["texto_mensaje"]="No se ha podido enviar el email de activación de la cuenta. Ponte en contacto con nosotros a través de esta dirección: <a href='mailto:".CONTACT_EMAIL."'>".CONTACT_EMAIL."</a> para que te la podamos activar manualmente. Muchas gracias.";
                        }
                        $this->render('mensaje','mensaje',$data);
                    }else{
                        $this->render("error","404",$data);
                    }
                break;

                case 'recoverpass':
                    $data['page_title']="He olvidado mi contraseña";
                    if(isset($_POST["username"])){
                        if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$_POST["username"])){
                            $this->u->email=$_POST["username"];
                        }else{
                            $this->u->user=$_POST["username"];
                        }
                        if($this->u->existeUsuario()){
                            //generamos una key unica para recuperar la contraseña
                            $data["recoverpasskey"]=$this->u->generarKeyPassword();
                            //enviamos un email
                            $this->loadModel("email");
                            $mail = new Email();
                            $mail->to = $this->u->email;
                            $mail->from = NOREPLY_EMAIL;
                            $mail->from_name = PAGE_NAME;
                            $mail->subject = "He olvidado mi contraseña de ". PAGE_NAME;
                            $data["username"]=$this->u->user;
                            $mail->getEmail("recover_password",$data);
                            if ($mail->sendEmail()){
                                $data["titulo_mensaje"]="¡Tienes un nuevo mensaje!";
                                $data["texto_mensaje"]="Te hemos enviado un mensaje de correo electrónico con un enlace único para poder generar una nueva contraseña.";
                            }else{
                                $data["titulo_mensaje"]="Error";
                                $data["texto_mensaje"]="No se ha podido enviar un email para generar una nueva contraseña. Si tienes algún problema con la recuperación de la contraseña ponte en contacto con nosotros a través de esta dirección: <a href='mailto:".CONTACT_EMAIL."'>".CONTACT_EMAIL."</a>. Muchas gracias.";
                            }
                            $this->render('mensaje','mensaje',$data);
                        }else{
                            //El nombre de usuario o email introducido no es correcto
                            $data["error_msg"]=$this->loadView("error","form_error","El nombre de usuario o email introducido no es correcto");
                            $this->render("user","recoverpass",$data);
                        }
                    }elseif(isset($_GET["recoverpasskey"])){
                        if($this->u->validarRecoverpasskey($_GET["recoverpasskey"])){
                            $data["recoverpasskey"]=$_GET["recoverpasskey"];
                            $data["email"]=$this->u->email;
                            $this->render("user","new_password",$data);
                        }else{
                            $data["titulo_mensaje"]="Error";
                            $data["texto_mensaje"]="No se ha podido generar una nueva contraseña. Si tienes algún problema con la recuperación de la contraseña ponte en contacto con nosotros a través de esta dirección: <a href='mailto:<?=CONTACT_EMAIL?>'><?=CONTACT_EMAIL?></a>. Muchas gracias.";
                            $this->render('mensaje','mensaje',$data);
                        }
                    }elseif(isset($_POST["password"]) && isset($_POST["recoverpasskey"])){
                        $this->u->pass=md5($_POST["password"]);
                        $this->u->email=$_POST["email"];
                        if($this->u->recoverPassword()){
                            $data["titulo_mensaje"]="¡Enhorabuena!";
                            $data["texto_mensaje"]="Se ha cambiado la contraseña correctamente. Ya puedes iniciar sesión con la nueva clave que has configurado.";
                            $data["url"]=PAGE_DOMAIN."/login";
                            //$this->render('mensaje','mensaje',$data);
                        }else{
                            $data["titulo_mensaje"]="Error";
                            $data["texto_mensaje"]="No se ha podido generar una nueva contraseña. Si tienes algún problema con la recuperación de la contraseña ponte en contacto con nosotros a través de esta dirección: <a href='mailto:".CONTACT_EMAIL."'>".CONTACT_EMAIL."</a>. Muchas gracias.";
                            $this->render('mensaje','mensaje',$data);
                        }
                        $this->render('mensaje','mensaje',$data);
                    }else{
                        $this->render("user","recoverpass",$data);
                    }
                break;

                case 'saveProfile':
                    $this->u->descripcion=$_POST["descripcion"];
                    $this->u->ocupacion=$_POST["ocupacion"];
                    $this->u->intereses=$_POST["intereses"];
                    if($this->u->updateProfile()){
                        echo true;
                    }else{
                        echo false;
                    }
                break;

                case 'logout':
                    $this->u->logout();
                break;

                case 'uploadAvatar':
                    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

                        $this->u->user=$_SESSION["login"]["user"];
                        $infouser=$this->u->getUser();
                        $this->u->id=$infouser['id'];
                        $upload_folder ='app/templates/frontoffice/img/avatar/'.$this->u->user;
                        if (!file_exists($upload_folder)) {
                            mkdir($upload_folder, 0777, true);
                        }
                        $tmp_name = $_FILES['avatar']['tmp_name'];
                        $avatar= new Imagick($tmp_name);
                        $avatar->setImageResolution(72,72);
                        $avatar->setImageFormat('jpeg');
                        $avatar->setCompression(Imagick::COMPRESSION_JPEG);
                        //$avatar -> gaussianBlurImage(0.8, 10);      //blur
                        $avatar -> setImageCompressionQuality(80);  //set compress quality to 85
                        $sizes = Array(500,300,128,64,32);
                        foreach ($sizes as $size){
                            $avatar_name = $size.'.jpg';
                            $avatar->thumbnailImage($size, $size, true, true);
                            $avatar->writeImage($upload_folder."/".$avatar_name);
                        }
                        $this->u->activateAvatar();
                        //sleep(3);//retrasamos la petición 3 segundos
                        echo $this->u->user."/300.jpg";//devolvemos el nombre del archivo para pintar la imagen
                    }else{
                        //echo "no hagas tramposerías";
                        echo false;
                    }
                break;

                case 'deleteAvatar':
                    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
                        $upload_folder ='app/templates/frontoffice/img/avatar/'.$this->u->user;
                        if($this->u->deleteAvatar()){
                            if(unlink($upload_folder)){
                                echo true;
                            }else{
                                echo false;
                            }
                        }else{
                            echo false;
                        }
                    }
                break;

                case 'uploadBanner':
                    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

                        $this->u->user=$_SESSION["login"]["user"];
                        $infouser=$this->u->getUser();
                        $this->u->id=$infouser['id'];
                        $upload_folder ='app/templates/frontoffice/img/banner/'.$this->u->user;
                        if (!file_exists($upload_folder)) {
                            mkdir($upload_folder, 0777, true);
                        }
                        $tmp_name = $_FILES['banner']['tmp_name'];
                        $size=1920;
                        $banner_name = $size.'.jpg';

                        $banner= new Imagick($tmp_name);
                        $banner->setImageResolution(72,72);
                        $banner->setImageFormat('jpeg');
                        $banner->scaleImage(1920, 350);
                        if($banner->writeImage($upload_folder."/".$banner_name)){
                            $this->u->activateBanner();
                            //sleep(3);//retrasamos la petición 3 segundos
                            echo $this->u->user.'/'.$banner_name;//devolvemos el nombre del archivo para pintar la imagen
                        }
                        else{
                            //echo "no funciona bien, nombre de imagen: ". $avatar_name;
                            echo false;
                        }
                    }else{
                        //echo "no hagas tramposerías";
                        echo false;
                    }
                break;

                case 'deleteBanner':
                    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
                        $upload_folder ='app/templates/frontoffice/img/banner';
                        $this->u->user=$_SESSION["login"]["user"];
                        $infouser=$this->u->getUser();
                        $this->u->id=$infouser['id'];
                        $banner_name = $this->u->id."-".$_SESSION["login"]["user"].'.jpg';
                        if($this->u->deleteBanner()){
                            if(unlink($upload_folder."/".$banner_name)){
                                echo true;
                            }else{
                                echo false;
                            }
                        }else{
                            echo false;
                        }
                    }
                break;

                case 'showCard':
                    $data["id_producto"]=$p->id=$_POST["id_producto"];
                    $p->user=$this->u->id;
                    if($p->like()){
                        $producto=$p->get();
                        $data["cat_id"]=$cat->id=$producto["categoria"];
                        $data["cat_nombre"]=$cat->get()["nombre"];
                        $data["dg-token"]=$dg->token=$producto["design"];
                        $design=$dg->get();
                        $data["dg-nombre"]=$producto["nombre"];
                        $data["dg-descripcion"]=$this->cutText($producto["descripcion"],60);

                        $creador = New Users_Model();
                        $design=$dg->get();
                        $creador->id=$p->creador=$design["user"]; //asignamos el id del creador
                        $infocreador=$creador->getUserFromID();
                        $data["username"]=$creador->user=$infocreador["user"];
                        $data["creador_avatar"]=$creador->getAvatar(64);

                        if(isset($_SESSION["login"]) && $p->userLikeProducto()){
                            $data["like_class"]='like';
                        }else{
                            $data["like_class"]='unlike';
                        }
                        $data["contador_likes"]=$p->getLikes();
                        $data["contador_shares"]=$p->getShares();
                        $data["contador_comments"]=$p->getContComentarios();
                        $data["animate"]="animated zoomIn";
                        echo $this->loadView('product','product_card',$data);
                    }else{
                        echo "";
                    }
                break;

                case 'ruletaLike':
                    if(isset($_SESSION["login"]["user"])){
                        $infouser=$this->u->getUser();
                        $p->id=$_POST["id_producto"];
                        $p->user=$infouser['id'];
                        //print_r($_POST);

                        $id1 = !isset($_POST["id_hermanos"][0]) ?  $p->id : $_POST["id_hermanos"][0];
                        $id2 = !isset($_POST["id_hermanos"][1]) ?  $p->id : $_POST["id_hermanos"][1];
                        $id3 = !isset($_POST["id_hermanos"][2]) ?  $p->id : $_POST["id_hermanos"][2];
                        $id4 = !isset($_POST["id_hermanos"][3]) ?  $p->id : $_POST["id_hermanos"][3];
                        $id5 = !isset($_POST["id_hermanos"][4]) ?  $p->id : $_POST["id_hermanos"][4];
                        if($producto=$p->getNewRuletaItem($id1, $id2, $id3, $id4, $id5)){
                            $creador = New Users_Model();
                            $data["dg-token"]=$dg->token=$producto["design"];
                            $design=$dg->get();
                            $creador->id=$p->creador=$design["user"]; //asignamos el id del creador
                            $infocreador=$creador->getUserFromID();
                            $data["id_producto"]=$producto["id"];
                            $data["cat_id"]=$cat->id=$producto["categoria"];
                            $data["cat_nombre"]=$cat->get()["nombre"];
                            $data["username"]=$creador->user=$infocreador["user"];
                            $data["animate"]="animated bounceIn";
                            echo $this->loadView("home","ruleta",$data);
                        }else{
                            echo "<div class='col-xs-4'>";
                        }
                    }else{
                        return false;
                    }
                break;

                case 'like':
                    if(isset($_SESSION["login"]["user"])){
                        $infouser=$this->u->getUser();
                        $p->id=$_POST["producto"];
                        $p->user=$infouser['id'];
                        if($p->like()){
                            $producto=$p->get();
                            $dg->token=$producto["design"];
                            $cat->id=$producto["categoria"];
                            $notify->to=$dg->get()["user"];
                            $notify->from=$this->u->id;
                            $notify->producto=$p->id;
                            $notify->titulo="Nuevo like";
                            $notify->texto="A ".$this->u->user." le ha gustado ".$producto["nombre"].".";
                            $notify->url=$cat->get()["nombre"]."/".$dg->token;
                            $notify->tipo="like";
                            $notify->set();
                            echo true;
                        }else{
                            echo false;
                        }
                    }else{
                        return false;
                    }
                break;

                case 'unlike':
                    if(isset($_SESSION["login"]["user"])){
                        $this->u->user=$_SESSION["login"]["user"];
                        $infouser=$this->u->getUser();
                        $this->loadModel("producto");
                        $p = New Producto_Model();
                        $p->id=$_POST["producto"];
                        $p->user=$infouser['id'];
                        if($p->unlike()){
                            echo true;
                        }else{
                            echo false;
                        }
                    }else{
                        return false;
                    }
                break;

                case 'updatepassword':
                    if(!empty($_POST)){
                        $this->u->pass=md5($_POST["oldpassword"]);
                        if($this->u->coincideUserAndPassword()){
                            $this->u->pass=md5($_POST["password"]);
                            if($this->u->updatePassword()){
                                if(isset($_COOKIE["user"]) && isset($_COOKIE["pass"])){
                                    $this->u->login(1);
                                }else{
                                    $this->u->login();
                                }
                                $data["titulo_mensaje"]="¡Contraseña actualizada!";
                                $data["texto_mensaje"]="Se ha actualizado tu contraseña correctamente. Recuerda que para volver a entrar tienes que introducir la nueva contraseña.";
                            }else{
                                $data["titulo_mensaje"]="Error";
                                $data["texto_mensaje"]="Ha ocurrido un error al actualizar la contraseña.";
                            }
                        }else{
                            $data["titulo_mensaje"]="Error";
                            $data["texto_mensaje"]="Tu contraseña anterior no es correcta. Revísala y vuelve a intentarlo, gracias.";
                        }
                        $this->render('mensaje','mensaje',$data);
                    }else{
                        $this->render("error","404",$data);
                    }
                break;

                case 'updatecash':
                    if(!empty($_POST)){
                        $this->u->paypal=trim($_POST["paypal"]);
                        $this->u->banco=trim($_POST["banco"]);
                        $this->u->iban=str_replace(' ', '', $_POST["iban"]);
                        if(!empty($_POST["paypal"]) || !empty($_POST["iban"])){
                            if($this->u->updateUserCash()){
                                //Enviamos un email a los que han solicitado compra y borramos
                                $comprador = New Users_Model();
                                $this->loadModel("producto");
                                $p = New Producto_Model();
                                $this->loadModel("categoria");
                                $cat = New Categoria_Model();
                                $this->loadModel("design");
                                $dg = New Design_Model();
                                $this->loadModel("email");
                                $mail = new Email();
                                $p->creador=$this->u->id;
                                $lista_productos=$p->getProductosUser();
                                foreach($lista_productos as $producto){
                                    $p->id=$producto["id"];
                                    $producto=$p->get();
                                    $cat->id=$producto["categoria"];
                                    $data["cat_nombre"]=$cat->get()["nombre"];
                                    $data["token"]=$dg->token=$producto["design"];
                                    $design=$dg->get();
                                    $data["dg_nombre"]=$producto["nombre"];
                                    if($solicitudes=$p->getSolicitudesCompra()){
                                        //Avisamos a los potenciales compradores de que ya está disponible
                                        foreach($solicitudes as $solicitud){
                                            $comprador->id=$solicitud["user"];
                                            $info_comprador=$comprador->getUserFromID();
                                            $mail->to = $info_comprador["email"];
                                            $mail->subject = PAGE_NAME." | [Producto a la venta]";
                                            $data["user"]=$info_comprador["user"];
                                            $mail->getEmail("producto_disponible",$data);
                                            $mail->sendEmail();
                                        }
                                    }
                                }

                                $data["titulo_mensaje"]="¡Información de pago actualizada!";
                                $data["texto_mensaje"]="Tus información sobre pagos se ha actualizado correctamente.";
                            }else{
                                $data["titulo_mensaje"]="Error";
                                $data["texto_mensaje"]="Error al guardar los datos.";
                            }
                        }else{
                            $data["titulo_mensaje"]="Error";
                            $data["texto_mensaje"]="Faltan datos obligatorios por rellenar. Es necesario configurar al menos un método de pago";
                        }
                        $this->render("mensaje","mensaje",$data);
                    }else{
                        $this->render("error","404",$data);
                    }
                break;

                case 'settings':
                    if(isset($_SESSION["login"])){
                        $data["mensaje"]="";
                        if(!empty($_POST)){
                            print_r($_POST);
                            $this->u->email=trim($_POST["email"]);
                            $this->u->address=trim($_POST["address"]);
                            $this->u->cp=trim($_POST["cp"]);
                            $this->u->localidad=trim($_POST["localidad"]);
                            $this->u->provincia=trim($_POST["provincia"]);
                            $this->u->phone=trim($_POST["phone"]);
                            $this->u->pais=$_POST["pais"];
                            $this->u->idnum=trim($_POST["idnum"]);
                            $this->u->birthday=date("Y-m-d", strtotime(str_replace('/', '-', $_POST["birthday"])));
                            if(!empty($_POST["email"]) && !empty($_POST["address"]) && !empty($_POST["cp"]) && !empty($_POST["localidad"]) && !empty($_POST["provincia"]) && !empty($_POST["phone"])){
                                if($this->u->updateUserInformation()){
                                    $data["mensaje"]=$this->loadView('success','form_success','Información actualizada correctamente');
                                }else{
                                    $data["mensaje"]=$this->loadView('error','form_error','Error al guardar los datos');
                                }
                            }else{
                                $data["mensaje"]=$this->loadView('error','form_error','Faltan datos por rellenar');
                            }
                        }

                        $user=$this->u->getUser();
                        $data["nombre"]=$user["name"];
                        $data["email"]=$user["email"];
                        $data["idnum"]=$user["idnum"];
                        if(!empty($user["idnum"])){
                            $data["idnum"]=$data["idnum"]."\" readonly \" ";
                        }
                        if(!empty($user["birthday"])){
                            $data["birthday"]=date("d/m/Y", strtotime($user["birthday"]));
                        }else{
                            $data["birthday"]="";
                        }
                        if(empty($user["pais"])){
                            $data["pais_selected"]=28;
                        }else{
                            $data["pais_selected"]=$user["pais"];
                        }
                        $data["pais"]=$this->loadView("forms","pais",$data);
                        $data["address"]=$user["address"];
                        $data["cp"]=$user["cp"];
                        $data["localidad"]=$user["localidad"];
                        $data["phone"]=$user["phone"];
                        $data["paypal"]=$user["paypal"];
                        $data["banco"]=$user["banco"];
                        $data["iban"]=$user["iban"];
                        $data["credit"]=number_format($user["credit"], 2, ',', ' ');
                        $data["provincia_selected"]=$user["provincia"];
                        $data["provincia"]=$this->loadView("forms","provincia",$data);
                        $data["custom_js"]=$this->minifyJs("user/js", "settings");
                        $this->render("user","settings",$data);
                    }else{
                        //redirigimos al login con redireccion de vuelta para aca
                        header('Location: '.PAGE_DOMAIN.'/login?redirect='.$this->getURL());
                    }
                break;

                default:
                    if(isset($_GET["user"])){

                        $creador->user=$creador->URL2user($_GET["user"]);//nombre del creador
                        if($infocreador=$creador->getUser()){
                            $data["userid"]=$p->creador=$creador->id=$infocreador["id"];
                            $data["creador_user"]=$data["username"]=$creador->user=$infocreador["user"];
                            $data["edit_button"]="";
                            $data['description']=$infocreador["description"];
                            $data['id']=$infocreador["id"];
                            $data['ocupacion']=$infocreador["ocupacion"];
                            $data['intereses']=$infocreador["intereses"];
                            $data['avatar']=$creador->getAvatar(300);
                            $data['meta-avatar']=$creador->getAvatar(500);
                            $data["creador_avatar"]=$creador->getAvatar(64);
                            $data['banner']=$creador->getBanner();
                            if(isset($_SESSION["login"])){
                                if($creador->user==$this->u->user){
                                    $data["edit_button"]="<a id='edit_profile' class='btn btn-round btn-primary' href='#'>Editar perfil</a>";
                                }
                            }

                            $p->user=$this->u->id;//asignamos el id del usuario de sesion

                            switch(@$_GET["node"]){
                                case 'designs':
                                    $p->category_parent=1;
                                    $lista_productos=$p->getProductosCategoryParentUser();
                                break;

                                case 'crafts':
                                    $p->category_parent=2;
                                    $lista_productos=$p->getProductosCategoryUser();
                                break;

                                case 'baul':
                                    $p->category_parent=30;
                                    $lista_productos=$p->getProductosCategoryUser();
                                break;

                                case 'lists':
                                    if($listas_productos=$p->getListasUsadas()){
                                        $lists="";
                                        foreach($listas_productos as $lista){
                                            $data["list_name"]=$lista["nombre"];
                                            $data["list_token"]=$lista["token"];
                                            $data["id_producto"]=$p->id=$lista["producto"];
                                            $producto=$p->get();
                                            $data["cat_id"]=$cat->id=$producto["categoria"];
                                            $data["cat_nombre"]=$cat->get()["nombre"];
                                            $data["dg-token"]=$dg->token=$producto["design"];
                                            $design=$dg->get();
                                            $data["dg-nombre"]=$producto["nombre"];
                                            $data["dg-descripcion"]=$this->cutText($producto["descripcion"],60);
                                            $lists.=$this->loadView('user','list_card',$data);
                                            $data["nombre_lista"]="LISTAS PERSONALIZADAS";
                                        }
                                    }
                                break;

                                case 'viewlist':
                                    $p->token_lista=$_GET["tokenlist"];
                                    $data['banner']=$creador->getBanner();
                                    $lista=$p->getLista();
                                    $data["nombre_lista"]=$lista["nombre"];
                                    $lista_productos=$p->getProductosLista();
                                break;

                                default:
                                    $lista_productos=$p->getProductosUser();
                                    $data["nombre_lista"]="ÚLTIMOS PRODUCTOS";
                            }

                            if(!empty($lista_productos)){
                                $data["lista_productos"]="";
                                foreach($lista_productos as $producto){
                                    $p->id=$producto["id"];
                                    if($p->isActive() && ($creador->user==$this->u->user) || ($p->isRevisado() && $creador->user!=$this->u->user)){
                                        $data["revisado"]=$producto["revisado"];
                                        $data["id_producto"]=$p->id=$producto["id"];
                                        $data["cat_id"]=$cat->id=$producto["categoria"];
                                        $data["cat_nombre"]=$cat->get()["nombre"];
                                        $data["dg-token"]=$dg->token=$producto["design"];
                                        $design=$dg->get();
                                        $data["dg-nombre"]=$producto["nombre"];
                                        $data["dg-descripcion"]=$this->cutText($producto["descripcion"],60);

                                        if(isset($_SESSION["login"]) && $p->userLikeProducto()){
                                            $data["like_class"]='like';
                                        }else{
                                            $data["like_class"]='unlike';
                                        }
                                        $data["contador_likes"]=$p->getLikes();
                                        $data["contador_shares"]=$p->getShares();
                                        $data["contador_comments"]=$p->getContComentarios();
                                        if($producto["revisado"]==1){
                                            $data["product_card"]=$this->loadView('product','product_card',$data);
                                            $data["lista_productos"].=$this->loadView('product','product_card_col-xl-4',$data);
                                        }else{
                                            $data["product_card"]=$this->loadView('product','product_card_norevisado',$data);
                                            $data["lista_productos"].=$this->loadView('product','product_card_col-xl-4',$data);
                                        }
                                    }
                                }
                            }elseif(!empty($lists)){
                                $data["lista_productos"]=$lists;
                            }else{
                                $data["lista_productos"]=$this->loadView("error","form_error","No hay productos publicados.");
                            }

                            $data["custom_js"]=$this->minifyJs("user/js", "user");
                            $data["meta_tags"]=$this->loadView("meta","meta-usuario",$data);
                            $this->render('user', 'user', $data);
                        }else{
                            $this->render('error','404',$data);
                        }
                    }else{
                        $this->render('error','404',$data);
                    }
            }
        }

    }
?>
