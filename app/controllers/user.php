<?php
    require_once 'app/core/controller.php';

    class User extends Controller{

        function index_users(){

            $creador = New Users_Model();

            @$action=$_GET["action"];
            $data["reg_msg"]=$data["login_msg"]="";
            switch($action){

                case 'register_comprador':
                    $data['page_title']="Bienvenido a ".PAGE_NAME;
                    if($_POST){
                        $this->u->user=$_POST["username"];
                        $this->u->email=$_POST["email"];
                        $this->u->pass=md5($_POST["password"]);
                        $this->u->name=$_POST["firstName"]." ".$_POST["lastName"];
                        $this->u->phone=$_POST["phone"];
                        $this->u->address=$_POST["direccion"];
                        $this->u->cp=$_POST["cp"];
                        $this->u->localidad=$_POST["localidad"];
                        $this->u->provincia=$_POST["provincia"];
                        $this->u->rol="comprador";
                        $this->u->ip=$this->getIP();
                        if($this->u->register()){
                            header ("Location: ".PAGE_DOMAIN);
                        }else{
                            $data["provincia"]=$this->loadView("forms","provincia",$data);
                            $data["reg_msg"]=$this->loadView('error','form_error',"Ya hay un usuario registrado con estos datos.");
                            $this->render('user','comprador_form',$data);
                        }
                    }else{
                        $data["provincia"]=$this->loadView("forms","provincia",$data);
                        $data["reg_msg"]=$this->loadView('error','form_error',"Faltan datos obligatorios en el formulario.");
                        $this->render('user','comprador_form',$data);
                    }
                break;

                case 'register':
                    $data['page_title']="Bienvenido a ".PAGE_NAME;
                    if($_POST){
                        $this->u->name=$_POST["nombre"];
                        $this->u->user=$_POST["username"];
                        $this->u->email=$_POST["email"];
                        $this->u->pass=md5($_POST["password"]);
                        $this->u->name=$_POST["nombre"];
                        $this->u->rol="vendedor";
                        $this->u->ip=$this->getIP();
                        if($this->u->register()){
                            header ("Location: ".PAGE_DOMAIN);
                        }else{
                            $data["reg_msg"]=$this->loadView('error','form_error',"Ya hay un usuario registrado con estos datos (email o nombre de usuario).");
                            $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/user/js/register.js'></script>";
                            $this->render('user','register',$data);
                        }
                    }else{
                        $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/user/js/register.js'></script>";
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
                                Header("Location: ".PAGE_DOMAIN);
                            }else{
                                $data["login_msg"]=$this->loadView('error','form_error',"El nombre de usuario o la contraseña no son válidos.");
                                $this->render('user','login',$data);
                            }
                        }else{
                            if($this->u->activate($_REQUEST["activation_key"])){
                                if($this->u->login($loginrec)){
                                    Header("Location: ".PAGE_DOMAIN);
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
                                    Header("Location: ".PAGE_DOMAIN);
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
                        $upload_folder ='app/templates/frontoffice/img/avatar';
                        $tmp_name = $_FILES['avatar']['tmp_name'];
                        $avatar_name = $this->u->id."-".$_SESSION["login"]["user"].'.jpg';
                        $jpeg_quality = 100; //calidad jpg
                        $image = imagecreatefrompng($tmp_name);


                        list($width, $height) = getimagesize($tmp_name);
                        $output = imagecreatetruecolor($width, $height);
                        $white = imagecolorallocate($output,  255, 255, 255);
                        imagefilledrectangle($output, 0, 0, $width, $height, $white);
                        imagecopy($output, $image, 0, 0, 0, 0, $width, $height);

                        //comprobamos si el archivo ha subido
                        if (imagejpeg($output, $upload_folder."/".$avatar_name, $jpeg_quality)){
                            imagedestroy($image);
                            $this->u->activateAvatar();
                            sleep(3);//retrasamos la petición 3 segundos
                            echo $avatar_name;//devolvemos el nombre del archivo para pintar la imagen
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

                case 'deleteAvatar':
                    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
                        $upload_folder ='app/templates/frontoffice/img/avatar';
                        $this->u->user=$_SESSION["login"]["user"];
                        $infouser=$this->u->getUser();
                        $this->u->id=$infouser['id'];
                        $avatar_name = $this->u->id."-".$_SESSION["login"]["user"].'.jpg';
                        if($this->u->deleteAvatar()){
                            if(unlink($upload_folder."/".$avatar_name)){
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
                        $upload_folder ='app/templates/frontoffice/img/banner';
                        $tmp_name = $_FILES['banner']['tmp_name'];
                        $banner_name = $this->u->id."-".$_SESSION["login"]["user"].'.jpg';
                        $jpeg_quality = 100; //calidad jpg
                        $image = imagecreatefrompng($tmp_name);


                        list($width, $height) = getimagesize($tmp_name);
                        $output = imagecreatetruecolor($width, $height);
                        $white = imagecolorallocate($output,  255, 255, 255);
                        imagefilledrectangle($output, 0, 0, $width, $height, $white);
                        imagecopy($output, $image, 0, 0, 0, 0, $width, $height);

                        //comprobamos si el archivo ha subido
                        if (imagejpeg($output, $upload_folder."/".$banner_name, $jpeg_quality)){
                            imagedestroy($image);
                            $this->u->activateBanner();
                            sleep(3);//retrasamos la petición 3 segundos
                            echo $banner_name;//devolvemos el nombre del archivo para pintar la imagen
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
                    $this->loadModel("producto");
                    $pr = New Producto_Model();
                    $this->loadModel("design");
                    $dg = New Design_Model();
                    $this->loadModel("categoria");
                    $cat = New Categoria_Model();
                    $data["id_producto"]=$pr->id=$_POST["id_producto"];
                    $pr->user=$this->u->id;
                    if($pr->like()){
                        $producto=$pr->get();
                        $data["cat_id"]=$cat->id=$producto["categoria"];
                        $data["cat_nombre"]=$cat->get()["nombre"];
                        $data["dg-token"]=$dg->token=$producto["design"];
                        $design=$dg->get();
                        $data["dg-nombre"]=$producto["nombre"];
                        $data["dg-descripcion"]=$this->cutText($producto["descripcion"],60);

                        $creador = New Users_Model();
                        $design=$dg->get();
                        $creador->id=$pr->creador=$design["user"]; //asignamos el id del creador
                        $infocreador=$creador->getUserFromID();
                        $data["username"]=$creador->user=$infocreador["user"];
                        $data["avatar"]=$creador->getAvatar();

                        if(isset($_SESSION["login"]) && $pr->userLikeProducto()){
                            $data["like_class"]='like';
                        }else{
                            $data["like_class"]='unlike';
                        }
                        $data["contador_likes"]=$pr->getLikes();
                        $data["contador_shares"]=$pr->getShares();
                        $data["contador_comments"]=$pr->getContComentarios();
                        $data["animate"]="animated zoomIn";
                        echo $this->loadView('product','product_card',$data);
                    }else{
                        echo "";
                    }
                break;

                case 'ruletaLike':
                    if(isset($_SESSION["login"]["user"])){
                        $infouser=$this->u->getUser();
                        $this->loadModel("producto");
                        $pr = New Producto_Model();
                        $this->loadModel("design");
                        $dg = New Design_Model();
                        $this->loadModel("categoria");
                        $cat = New Categoria_Model();
                        $pr->id=$_POST["id_producto"];
                        $pr->user=$infouser['id'];
                        //print_r($_POST);

                        $id1 = !isset($_POST["id_hermanos"][0]) ?  $pr->id : $_POST["id_hermanos"][0];
                        $id2 = !isset($_POST["id_hermanos"][1]) ?  $pr->id : $_POST["id_hermanos"][1];
                        $id3 = !isset($_POST["id_hermanos"][2]) ?  $pr->id : $_POST["id_hermanos"][2];
                        $id4 = !isset($_POST["id_hermanos"][3]) ?  $pr->id : $_POST["id_hermanos"][3];
                        $id5 = !isset($_POST["id_hermanos"][4]) ?  $pr->id : $_POST["id_hermanos"][4];
                        if($producto=$pr->getNewRuletaItem($id1, $id2, $id3, $id4, $id5)){
                            $creador = New Users_Model();
                            $data["dg-token"]=$dg->token=$producto["design"];
                            $design=$dg->get();
                            $creador->id=$pr->creador=$design["user"]; //asignamos el id del creador
                            $infocreador=$creador->getUserFromID();
                            $data["id_producto"]=$producto["id"];
                            $data["cat_id"]=$cat->id=$producto["categoria"];
                            $data["cat_nombre"]=$cat->get()["nombre"];
                            $data["username"]=$creador->user=$infocreador["user"];
                            $data["avatar"]=$creador->getAvatar();
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
                        $this->loadModel("producto");
                        $pr = New Producto_Model();
                        $pr->id=$_POST["producto"];
                        $pr->user=$infouser['id'];
                        if($pr->like()){
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
                        $pr = New Producto_Model();
                        $pr->id=$_POST["producto"];
                        $pr->user=$infouser['id'];
                        if($pr->unlike()){
                            echo true;
                        }else{
                            echo false;
                        }
                    }else{
                        return false;
                    }
                break;

                case 'myorders':
                    echo "hola";
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
                        $this->u->idnum=trim($_POST["idnum"]);
                        $this->u->birthday=date("Y-m-d", strtotime(str_replace('/', '-', $_POST["birthday"])));
                        $this->u->paypal=trim($_POST["paypal"]);
                        if(!empty($_POST["idnum"]) && !empty($_POST["birthday"]) && !empty($_POST["paypal"])){
                            if($this->u->updateUserCash()){
                                $data["titulo_mensaje"]="¡Información de pago actualizada!";
                                $data["texto_mensaje"]="Tus información sobre pagos se ha actualizado correctamente.";
                            }else{
                                $data["titulo_mensaje"]="Error";
                                $data["texto_mensaje"]="Ha ocurrido un error al actualizar la información sobre pagos.";
                            }
                        }else{
                            $data["titulo_mensaje"]="Error";
                            $data["texto_mensaje"]="Faltan datos obligatorios por rellenar.";
                        }
                        $this->render("mensaje","mensaje",$data);
                    }else{
                        $this->render("error","404",$data);
                    }
                break;

                case 'settings':
                    $data["mensaje"]="";
                    if(!empty($_POST)){
                        $this->u->email=trim($_POST["email"]);
                        $this->u->address=trim($_POST["address"]);
                        $this->u->cp=trim($_POST["cp"]);
                        $this->u->localidad=trim($_POST["localidad"]);
                        $this->u->provincia=trim($_POST["provincia"]);
                        $this->u->phone=trim($_POST["phone"]);
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
                    $data["birthday"]=date("d/m/Y", strtotime($user["birthday"]));
                    $data["address"]=$user["address"];
                    $data["cp"]=$user["cp"];
                    $data["localidad"]=$user["localidad"];
                    $data["phone"]=$user["phone"];
                    $data["paypal"]=$user["paypal"];
                    $data["credit"]=number_format($user["credit"], 2, ',', ' ');
                    $data["provincia_selected"]=$user["provincia"];
                    $data["provincia"]=$this->loadView("forms","provincia",$data);
                    $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/user/js/register.js'></script>";
                    $this->render("user","settings",$data);
                break;

                default:
                    if(isset($_GET["user"])){

                        $creador->user=$_GET["user"];//nombre del creador
                        if($infocreador=$creador->getUser()){
                            $this->loadModel("producto");
                            $pr = New Producto_Model();
                            $this->loadModel("design");
                            $dg = New Design_Model();
                            $this->loadModel("categoria");
                            $cat = New Categoria_Model();

                            $data["userid"]=$pr->creador=$creador->id=$infocreador["id"];
                            $data["creador_user"]=$data["username"]=$data['page_title']=$creador->user=$infocreador["user"];
                            $data["edit_button"]="";
                            $data['description']=$infocreador["description"];
                            $data['id']=$infocreador["id"];
                            $data['ocupacion']=$infocreador["ocupacion"];
                            $data['intereses']=$infocreador["intereses"];
                            $data["creador_avatar"]=$data['avatar']=$creador->getAvatar();
                            $data['banner']=$creador->getBanner();
                            if(isset($_SESSION["login"])){
                                if($creador->user==$this->u->user){
                                    $data["edit_button"]="<a id='edit_profile' class='btn btn-round btn-primary' href='#'>Editar perfil</a>";
                                }
                            }

                            $pr->user=$this->u->id;//asignamos el id del usuario de sesion

                            switch(@$_GET["node"]){
                                case 'designs':
                                    $pr->category_parent=1;
                                    $lista_productos=$pr->getProductosCategoryParentUser();
                                break;

                                case 'crafts':
                                    $pr->category_parent=2;
                                    $lista_productos=$pr->getProductosCategoryUser();
                                break;

                                case 'baul':
                                    $pr->category_parent=30;
                                    $lista_productos=$pr->getProductosCategoryUser();
                                break;

                                case 'lists':
                                    if($listas_productos=$pr->getListasUsadas()){
                                        $lists="";
                                        foreach($listas_productos as $lista){
                                            $data["list_name"]=$lista["nombre"];
                                            $data["list_token"]=$lista["token"];
                                            $data["id_producto"]=$pr->id=$lista["producto"];
                                            $producto=$pr->get();
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
                                    $pr->token_lista=$_GET["tokenlist"];
                                    $data["creador_avatar"]=$data['avatar']=$creador->getAvatar();
                                    $data['banner']=$creador->getBanner();
                                    $lista=$pr->getLista();
                                    $data["nombre_lista"]=$lista["nombre"];
                                    $lista_productos=$pr->getProductosLista();
                                break;

                                default:
                                    $lista_productos=$pr->getProductosUser();
                                    $data["nombre_lista"]="ÚLTIMOS PRODUCTOS";
                            }

                            if(!empty($lista_productos)){
                                $data["lista_productos"]="";
                                foreach($lista_productos as $producto){
                                    $pr->id=$producto["id"];
                                    if($pr->isActive() && ($creador->user==$this->u->user) || ($pr->isRevisado() && $creador->user!=$this->u->user)){
                                        $data["revisado"]=$producto["revisado"];
                                        $data["id_producto"]=$pr->id=$producto["id"];
                                        $data["cat_id"]=$cat->id=$producto["categoria"];
                                        $data["cat_nombre"]=$cat->get()["nombre"];
                                        $data["dg-token"]=$dg->token=$producto["design"];
                                        $design=$dg->get();
                                        $data["dg-nombre"]=$producto["nombre"];
                                        $data["dg-descripcion"]=$this->cutText($producto["descripcion"],60);

                                        if(isset($_SESSION["login"]) && $pr->userLikeProducto()){
                                            $data["like_class"]='like';
                                        }else{
                                            $data["like_class"]='unlike';
                                        }
                                        $data["contador_likes"]=$pr->getLikes();
                                        $data["contador_shares"]=$pr->getShares();
                                        $data["contador_comments"]=$pr->getContComentarios();
                                        if($producto["revisado"]==1){
                                            $data["product_card"]=$this->loadView('product','product_card',$data);
                                            $data["lista_productos"].=$this->loadView('product','product_card_col',$data);
                                        }else{
                                            $data["product_card"]=$this->loadView('product','product_card_norevisado',$data);
                                            $data["lista_productos"].=$this->loadView('product','product_card_col',$data);
                                        }
                                    }
                                }
                            }elseif(!empty($lists)){
                                $data["lista_productos"]=$lists;
                            }else{
                                $data["lista_productos"]=$this->loadView("error","form_error","No hay productos publicados.");
                            }

                            //$data["custom_js"]=$this->minifyJs("user","js/user");
                            $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/user/js/user.js'></script>";
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
