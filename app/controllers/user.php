<?php
    require_once 'app/core/controller.php';

    class User extends Controller{

        function index_users(){

            $creador = New Users_Model();

            @$action=$_GET["action"];
            $data["reg_msg"]=$data["login_msg"]="";
            switch($action){

                case 'genera_codigos_registro':
                    for($i=0;$i<=100;$i++){
                        $this->u->genera_codigos_registro();
                    }
                    echo "todo perfect";
                break;

                case 'solicitar_codigo':
                    $data['page_title']="Bienvenido a ".PAGE_NAME;
                    if($_POST){
                        $email=$_POST["email"];
                        $informacion=$_POST["informacion"];

                        $this->loadModel("email");
                        $mail = new Email();
                        $mail->to = "beta@areafriki.com";
                        $mail->from = $email;
                        $mail->from_name = $email;
                        $mail->reply_to = $email;
                        $mail->reply_to_name = $email;
                        $mail->subject = "Solicitud de código en ". PAGE_NAME;
                        $mail->body="<p>Un usuario ha solicitado un código de acceso a áreafriki.</p>
                        <p>Email: ".$email."</p>
                        <p>Información: ".$informacion."</p>";
                        if ($mail->sendEmail()){
                            $data["titulo_mensaje"]="Muchas gracias.";
                            $data["texto_mensaje"]="Nos pondremos en contacto contigo por correo electrónico en plazo máximo de 48horas.";
                        }else{
                            $data["titulo_mensaje"]="Error";
                            $data["texto_mensaje"]="El email solicitado no es válido. Revisa la información y vuelve a intentarlo. Gracias.";
                        }
                        $this->render('mensaje','mensaje',$data);
                    }else{
                        $this->render("error","404",$data);
                    }
                break;

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

                case 'register_vendedor':
                    $data['page_title']="Bienvenido a ".PAGE_NAME;
                    if($_POST){
                        $data["code"]=$this->u->codigo_beta=$_POST["codigo_beta"];
                        $this->u->user=$_POST["username"];
                        $data["email"]=$this->u->email=$_POST["email"];
                        $this->u->pass=md5($_POST["password"]);
                        $this->u->name=$_POST["firstName"]." ".$_POST["lastName"];
                        $this->u->idnum=$_POST["idnum"];
                        $this->u->phone=$_POST["phone"];
                        $this->u->address=$_POST["direccion"];
                        $this->u->cp=$_POST["cp"];
                        $this->u->localidad=$_POST["localidad"];
                        $this->u->provincia=$_POST["provincia"];
                        $this->u->paypal=$_POST["paypal"];
                        $this->u->birthday=date("Y-m-d", strtotime(str_replace('/', '-', $_POST["birthday"])));
                        $this->u->rol="vendedor";
                        $this->u->ip=$this->getIP();
                        if($this->u->validateCodigoBeta()){
                            if($this->u->register()){
                                $this->u->validarBeta();
                                header ("Location: ".PAGE_DOMAIN);
                            }else{
                                $data["provincia"]=$this->loadView("forms","provincia",$data);
                                $data["reg_msg"]=$this->loadView('error','form_error',"Ya hay un usuario registrado con estos datos (email, nombre de usuario, teléfono o NIF).");
                                $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/user/js/register.js'></script>";
                                $this->render('user','vendedor_form',$data);
                            }
                        }else{
                            $data["provincia"]=$this->loadView("forms","provincia",$data);
                            //$data["reg_msg"]=$this->loadView('error','form_error',"Ya hay un usuario registrado con estos datos. Si estás registrado como comprador puedes entrar y convertir tu cuenta a \"Cuenta de vendedor\".");
                            $data["reg_msg"]=$this->loadView('error','form_error',"El código de registro beta introducido no es válido o ya ha sido utilizado.");
                            $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/user/js/register.js'></script>";
                            $this->render('user','vendedor_form',$data);
                        }
                    }else{
                        if(isset($_GET["email"]) && isset($_GET["code"])){
                            $data["email"]=$_GET["email"];
                            $data["code"]=$_GET["code"];
                            $data["provincia"]=$this->loadView("forms","provincia",$data);
                            $data["reg_msg"]=$this->loadView('error','form_error',"Faltan datos obligatorios en el formulario.");
                            $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/user/js/register.js'></script>";
                            $this->render('user','vendedor_form',$data);
                        }else{
                            $this->render("error","404",$data);
                        }
                    }
                break;

                case 'register':
                    $data['page_title']="Bienvenido a ".PAGE_NAME;
                    if($_POST){
                        $data["code"]=$this->u->codigo_beta=$_POST["codigo_beta"];
                        $this->u->name=$_POST["nombre"];
                        $this->u->user=$_POST["username"];
                        $data["email"]=$this->u->email=$_POST["email"];
                        $this->u->pass=md5($_POST["password"]);
                        $this->u->name=$_POST["nombre"];
                        $this->u->rol="vendedor";
                        $this->u->ip=$this->getIP();
                        if($this->u->validateCodigoBeta()){
                            if($this->u->register()){
                                $this->u->validarBeta();
                                header ("Location: ".PAGE_DOMAIN);
                            }else{
                                $data["reg_msg"]=$this->loadView('error','form_error',"Ya hay un usuario registrado con estos datos (email o nombre de usuario).");
                                $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/user/js/register.js'></script>";
                                $this->render('user','register',$data);
                            }
                        }else{
                            $data["reg_msg"]=$this->loadView('error','form_error',"El código de registro beta introducido no es válido o ya ha sido utilizado.");
                            $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/user/js/register.js'></script>";
                            $this->render('user','register',$data);
                        }
                    }else{
                        if(isset($_GET["code"])){
                            if(isset($_GET["email"])){
                                $data["email"]=$_GET["email"];
                            }else{
                                $data["email"]="";
                            }
                            $data["code"]=$_GET["code"];
                            $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/user/js/register.js'></script>";
                            $this->render('user','register',$data);
                        }else{
                            $this->render("error","404",$data);
                        }
                    }
                break;

                case 'convertir_vendedor':
                    $data['page_title']="Bienvenido a ".PAGE_NAME;
                    if($_POST){
                        $this->u->idnum=$_POST["idnum"];
                        $this->u->paypal=$_POST["paypal"];
                        $this->u->birthday=date("Y-m-d", strtotime(str_replace('/', '-', $_POST["birthday"])));
                        if($this->u->convertirVendedor()){
                            header ("Location: ".PAGE_DOMAIN);
                        }else{
                            $data["reg_msg"]=$this->loadView('error','form_error',"Ya hay un usuario registrado con estos datos.");
                            $this->render('user','convertir_vendedor',$data);
                        }
                    }else{
                        $data["reg_msg"]=$this->loadView('error','form_error',"Faltan datos obligatorios en el formulario.");
                        $this->render('user','convertir_vendedor',$data);
                    }
                break;

                case 'login':
                    $data['page_title']="Bienvenido a ".PAGE_NAME;
                    if($_POST){
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
                                $this->render('user','login_form',$data);
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
                        $this->render('user','login_form',$data);
                    }

                break;

                case 'login_form':
                    $data['page_title']="Bienvenido a ".PAGE_NAME;
                    if(!isset($_REQUEST["activation_key"])){
                        $this->render('user','login_form',$data);
                    }else{
                        $data["activation_key"]=$_REQUEST["activation_key"];
                        $this->render('user','activation_form',$data);
                    }
                break;

                case 'register_comprador_form':

                    $data['page_title']="Bienvenido a ".PAGE_NAME;
                    $data["provincia"]=$this->loadView("forms","provincia",$data);
                    $this->render('user','comprador_form',$data);
                break;

                case 'register_vendedor_form':
                    $data['page_title']="Bienvenido a ".PAGE_NAME;
                    if(isset($_GET["email"]) && isset($_GET["code"])){
                        $data["email"]=$_GET["email"];
                        $data["code"]=$_GET["code"];
                        $data["provincia"]=$this->loadView("forms","provincia",$data);
                        $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/user/js/register.js'></script>";
                        $this->render('user','vendedor_form',$data);
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
                            $data["email"]=$this->u->email;
                            $this->render("user","new_password",$data);
                        }else{
                            $data["titulo_mensaje"]="Error";
                            $data["texto_mensaje"]="No se ha podido generar una nueva contraseña. Si tienes algún problema con la recuperación de la contraseña ponte en contacto con nosotros a través de esta dirección: <a href='mailto:<?=CONTACT_EMAIL?>'><?=CONTACT_EMAIL?></a>. Muchas gracias.";
                            $this->render('mensaje','mensaje',$data);
                        }
                    }elseif(isset($_POST["email"]) && isset($_POST["password"])){
                        $this->u->pass=md5($_POST["password"]);
                        $this->u->email=$_POST["email"];
                        if($this->u->recoverPassword()){
                            $data["titulo_mensaje"]="¡Enhorabuena!";
                            $data["texto_mensaje"]="Se ha cambiado la contraseña correctamente. Ya puedes iniciar sesión con la nueva clave que has configurado.";
                            $this->render('mensaje','mensaje',$data);
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

                        $creador = New Users_Model();
                        $design=$dg->get();
                        $creador->id=$pr->creador=$design["user"]; //asignamos el id del creador
                        $infocreador=$creador->getUserFromID();
                        $data["username"]=$infocreador["user"];


                        if(isset($_SESSION["login"]) && $pr->userLikeProducto()){
                            $data["like_class"]='like';
                        }else{
                            $data["like_class"]='unlike';
                        }
                        $data["contador_likes"]=$pr->getLikes();
                        $data["contador_shares"]=$pr->getShares();
                        $data["contador_comments"]=$pr->getContComentarios();
                        $data["animate"]="animated zoomIn";
                        echo $this->loadView('product','carousel_card',$data);
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
                            $data["username"]=$infocreador["user"];
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

                case 'myuploads':
                    $this->loadModel("producto");
                    $pr = New Producto_Model();
                    $this->loadModel("design");
                    $dg = New Design_Model();
                    $this->loadModel("categoria");
                    $cat = New Categoria_Model();
                    $this->loadModel("precio");
                    $pre = New Precio_Model();
                    $pr->creador=$this->u->id;
                    if($lista_productos=$pr->getProductosUser()){
                        $data["lista_productos"]="";
                        foreach($lista_productos as $producto){
                            $data["producto"]=$pre->producto=$pr->id=$producto["id"];
                            $data["dg_token"]=$dg->token=$producto["design"];
                            $design=$dg->get();
                            $pre->categoria=$cat->id=$pr->categoria=$pr->categoria=$producto["categoria"];
                            $data["dg_categoria"]=$cat->get()["nombre"];
                            $data["dg_nombre"]=$producto["nombre"];

                            $lista_tags=$pr->getTags();
                            $data["tags"]="";

                            if($lista_tags){
                                foreach($lista_tags as $tag){
                                    $data["tag"]=$tag["tag"];
                                    $data["tag_url"]=urlencode($tag["tag"]);
                                    $data["tags"].=$this->loadView('product','tags_list', $data).', ';
                                }
                                $data["tags"]=trim($data["tags"], ', ');
                            }

                            $creador->id=$design["user"];
                            $data["dg_autor"]=$creador->getUserFromID()["user"];

                            $pr->modelo="";
                            if(!empty($producto["modelo"])){
                                $pr->modelo=$producto["modelo"];
                            }

                            if(!empty($producto["beneficio"])){
                                $data["beneficio"]=number_format($producto["beneficio"], 2, ',', ' ')."€";
                                $data["precio_venta"]=number_format($pre->get(), 2, ',', ' ')."€";
                            }else{
                                $data["beneficio"]=$data["precio_venta"]="";
                                $orden=0;
                                $sizes=$pr->getSizes();
                                foreach($sizes as $size){
                                    $orden++;
                                    $beneficio=$pre->getBeneficioValor($orden);
                                    $data["beneficio"].=$size["valor"].": ".number_format($beneficio, 2, ',', ' ')."€<br>";
                                    $precio_base=$pre->getPrecioBaseSize($orden);
                                    $precio_venta=$beneficio+$precio_base;
                                    $data["precio_venta"].= $size["valor"].": ".number_format($precio_venta, 2, ',', ' ')."€<br>";
                                }
                            }

                            $data["lista_productos"].=$this->loadView("user","myuploads_card", $data);
                        }
                    }else{
                        $data["lista_productos"]=$this->loadView("error","form_error","No hay productos subidos");
                    }
                    $this->render("user","myuploads",$data);
                break;

                case 'myorders':
                    echo "hola";
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
                            $data["username"]=$data['page_title']=$creador->user=$infocreador["user"];
                            $data["edit_button"]="";
                            $data['description']=$infocreador["description"];
                            $data['id']=$infocreador["id"];
                            $data['ocupacion']=$infocreador["ocupacion"];
                            $data['intereses']=$infocreador["intereses"];
                            $data['avatar']=$creador->getAvatar();
                            $data['banner']=$creador->getBanner();
                            if(isset($_SESSION["login"])){
                                if($creador->user==$this->u->user){
                                    $data["edit_button"]="<a id='edit_profile' class='btn btn-raised btn-warning' href='#'>Editar perfil</a>";
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
                                            $lists.=$this->loadView('user','list_card',$data);
                                            $data["nombre_lista"]="LISTAS PERSONALIZADAS";
                                        }
                                    }
                                break;

                                case 'viewlist':
                                    $pr->token_lista=$_GET["tokenlist"];
                                    $data['avatar']=$creador->getAvatar();
                                    $data['banner']=$creador->getBanner();
                                    $lista=$pr->getLista();
                                    $data["nombre_lista"]=$lista["nombre"];
                                    $lista_productos=$pr->getProductosLista();
                                break;

                                default:
                                    $lista_productos=$pr->getProductosUser();
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

                                        if(isset($_SESSION["login"]) && $pr->userLikeProducto()){
                                            $data["like_class"]='like';
                                        }else{
                                            $data["like_class"]='unlike';
                                        }
                                        $data["contador_likes"]=$pr->getLikes();
                                        $data["contador_shares"]=$pr->getShares();
                                        $data["contador_comments"]=$pr->getContComentarios();
                                        if($producto["revisado"]==1){
                                            $data["lista_productos"].=$this->loadView('product','product_card',$data);
                                        }else{
                                             $data["lista_productos"].=$this->loadView('product','product_card_norevisado',$data);
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
