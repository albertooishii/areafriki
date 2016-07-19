<?php

    require_once 'app/core/controller.php';

    class Upload extends Controller{
        function index_uploads(){
            if(isset($_SESSION["login"]) && $this->u->getRol()!='comprador' && $this->u->getUser_activeaccount()){
                $this->loadModel("producto");
                $pr = New Producto_Model();
                $this->loadModel("design");
                $dg = New Design_Model();
                $this->loadModel("categoria");
                $cat = New Categoria_Model();
                $this->loadModel('tag');
                $t = New Tag_Model();

                @$action=$_GET["action"];
                switch($action){

                    case 'step2':
                        $data["page_title"]="2º Paso";
                        $cat->nombre=$_GET["node"];
                        $data["dg-id-cat"]=$cat->id=$cat->getWhereNombre()["id"];

                        switch($cat->nombre){
                            case 'designer':
                                $cat->parent=$cat->id;
                                $hijos=$cat->getChilds();
                                $data["lista_categorias"]="";
                                foreach($hijos as $categoria){
                                    $data["lista_categorias"].="<option value='".$categoria["id"]."'>".strtoupper($categoria["nombre"])."</option>";
                                }
                                $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/upload/upload.js'></script>";
                                $this->render("upload","segundo_paso_designer",$data);
                            break;

                            case 'crafts':
                                $dg->genera_token();
                                $data["token"]=$dg->token;
                                $data["dg-nombre-cat"]=$cat->nombre;
                                $pr->user=$this->u->id;
                                $data["listas"]=$pr->getListas();
                                $data["listas_productos"]=$this->loadView("designer","listas_productos",$data);
                                $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/upload/upload.js'></script>";
                                $data["custom_js"].="<script src='".PAGE_DOMAIN."/app/views/designer/crafts.js'></script>";
                                $this->render('designer','crafts',$data);
                            break;

                            case 'baul':
                                $dg->genera_token();
                                $data["token"]=$dg->token;
                                $data["dg-nombre-cat"]=$cat->nombre;
                                $pr->user=$this->u->id;
                                $data["listas"]=$pr->getListas();
                                $data["listas_productos"]=$this->loadView("designer","listas_productos",$data);
                                $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/upload/upload.js'></script>";
                                $data["custom_js"].="<script src='".PAGE_DOMAIN."/app/views/designer/baul.js'></script>";
                                $this->render('designer','baul',$data);
                            break;

                            default:
                                $this->render("error","404");
                        }
                    break;

                    case 'step3':
                        if(isset($_GET["categoria"])){
                            $data["page_title"]="3er Paso";
                            $cat->nombre=$data["dg-nombre-cat"]=$_GET["categoria"];
                            $info_cat=$cat->getWhereNombre();
                            $data["dg-id-cat"]=$dg->categoria=$pr->categoria=$cat->id=$info_cat["id"];
                            $data["cat_desc"]=$info_cat["descripcion"];
                            $dg->genera_token();
                            $data["token"]=$dg->token;
                            if($data["lista_colores"]=$pr->getColores()){
                                $data["color_pick"]=$this->loadView('upload', 'color_picker', $data);
                            }
                            $pr->user=$dg->user=$this->u->id;
                            $data["listas"]=$pr->getListas();
                            $data["listas_productos"]=$this->loadView("designer","listas_productos",$data);

                            /*$designs=$dg->getMyDesigns();
                            $data["my_designs"]="";
                            if(!empty($designs)){
                                $data["nombre_creador"]=$this->u->user;
                                foreach ($designs as $design){
                                    $data["dg_token"]=$design["token"];
                                    $data["dg_nombre"]=$design["nombre"];
                                    $data["my_designs"].=$this->loadView("designer","my_designs", $data);
                                }
                            }*/
                            if(!empty($info_cat["precio_base"])){
                                $cat->precio_base=$info_cat["precio_base"];
                                $data["precio_base"]=str_replace('.', ',', $cat->precio_base);
                                $cat->beneficio=$info_cat["beneficio"];
                                $data["precio_tope"]=str_replace('.', ',', $cat->precio_base + $cat->beneficio);
                                $data["beneficio_max"]=$cat->beneficio;
                            }else{
                                $cat->tipo_attr="size";
                                $valores=$cat->getValoresByTipo();
                                $data["precios_sizes"]="";
                                foreach($valores as $valor){
                                    $data["orden"]=$valor["orden"];
                                    $data["valor"]=$valor["valor"];
                                    $data["beneficio_max"]=$valor["beneficio"];
                                    $data["precio_base"]=$valor["precio_base"];
                                    $data["precio_tope"]=$valor["precio_base"]+$valor["beneficio"];
                                    $data["precios_sizes"].=$this->loadView("designer","precios_sizes",$data);
                                }
                            }
                            $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/designer/designer.js'></script>";
                            $data["custom_js"].="<script src='".PAGE_DOMAIN."/vendor/fancy_product_designer/source/js/fabric.min.js'></script>";
                            $data["custom_js"].="<script src='".PAGE_DOMAIN."/vendor/fancy_product_designer/source/js/FancyProductDesigner-all.min.js'></script>";
                            $data["custom_js"].="<script src='".PAGE_DOMAIN."/app/views/designer/".$cat->nombre.".js'></script>";
                            $data["custom_css"]="<link rel='stylesheet' href='".PAGE_DOMAIN."/vendor/fancy_product_designer/source/css/FancyProductDesigner-all.min.css'>";
                    		$data["custom_css"].="<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/css/bootstrap-slider.min.css'>";
                            $data["designer"]=$this->loadView('designer',$cat->nombre,$data);
                            $this->render("designer", 'designer',$data);
                        }
                    break;

                    case 'publish':
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            set_time_limit(60*30);//Establece tiempo máximo de ejecuccion.
                            $cat->id=$pr->categoria=$_POST["categoria"];
                            $cat->nombre=$cat->get()["nombre"];
                            if(!$cat->parent=$cat->get()["parent"]){
                                $cat->parent=$cat->id;
                            }
                            $data["parent_nombre"]=$cat->getParent()["nombre"];
                            $pr->nombre=$data["nombre"]=trim($_POST["nombre"]);
                            $pr->descripcion=$_POST["descripcion"];
                            $pr->beneficio=$_POST["beneficio"];
                            $t->tags=$_POST["tags"];
                            if(isset($_POST["listas_productos"])){
                                $pr->token_lista=$_POST["listas_productos"];
                            }
                            $data["token"]=$pr->design=$dg->token=$_POST["token"];
                            $upload_folder ='designs/'.$this->u->user.'/'.$dg->token;
                            $design_name = $dg->token;
                            $height = 700;
                            $thumbsize=512;
                            $jpg_quality=100;
                            $swerror=0;
                            if($cat->parent==1){ //SUBIDA DE DISEÑOS
                                #SUBIDA MONTAJE-------------###
                                if(mkdir($upload_folder.'/'.$cat->nombre, 0777, true)){
                                    $img_montaje = new Imagick ($_FILES["montaje"]["tmp_name"]);
                                    $img_montaje->setImageFormat('jpeg');
                                    $img_montaje->scaleImage($height,0);
                                    //$img->setImageCompressionQuality(100);
                                    $img_montaje_dst=$upload_folder.'/'.$cat->nombre.'/MONTAJE-'.$design_name.'.jpg';
                                    if($img_montaje->writeImage ($img_montaje_dst)){
                                        #SUBIDA DEL THUMBNAIL--------------###
                                        $img_montaje->cropThumbnailImage($thumbsize, $thumbsize);
                                        $img_thumb_dst=$upload_folder.'/'.$cat->nombre.'/thumb-'.$design_name.'.jpg';
                                        $img_montaje->writeImage($img_thumb_dst);

                                        #SUBIDA DEL DISEÑO .PNG--------------###
                                        $img_dg = new Imagick($_FILES["design"]['tmp_name']);
                                        $img_dg_sizes=$img_dg->getImageGeometry();
                                        $pr->width=$img_dg_sizes["width"];
                                        $pr->height=$img_dg_sizes["height"];
                                        $pr->top=$_POST["top"];
                                        $pr->left=$_POST["left"];
                                        $pr->scale=$_POST["scale"];

                                        if($img_dg->writeImage($upload_folder."/".$design_name.'.png')){//guardamos la imagen original como png

                                        #SUBIMOS EL FICHERO EDITABLE------------###
                                            if($_FILES["design_editable"]["error"]==0){
                                                $filename = $_FILES['design_editable']['name'];
                                                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                                $tmp_name = $_FILES['design_editable']['tmp_name'];
                                                $design_editable_name = $dg->token . "." . $ext;
                                                if(move_uploaded_file($tmp_name, $upload_folder.'/'.$cat->nombre."/ORIGINAL-".$design_editable_name)){
                                                    $swerror=0;
                                                }else{
                                                    $codigo_error= "No se ha podido mover el fichero editable a su carpeta";
                                                }
                                            }else{
                                                $codigo_error= "Error al pasar el fichero por ajax (error>0)";
                                            }
                                        }else{
                                            $codigo_error= "No se ha podido subir el diseño a su carpeta";
                                        }
                                    }else{
                                        $codigo_error= "No se ha podido convertir a jpg y/o borrar el original png";
                                    }
                                }else{
                                    $codigo_error= "No se ha podido crear la carpeta y/o subir el montaje png a su carpeta";
                                }
                            }else{ //SUBIDA DE ARTÍCULOS PARA VENTA (CRAFTS Y BAÚL)
                                if(isset($_POST["usado"])){$pr->usado=1;}else{$pr->usado=0;}
                                if(!empty($_POST["stock"])){$pr->stock=$_POST["stock"];}else{$pr->stock="NULL";}
                                if(!empty($_POST["preparacion"])){$pr->preparacion=$_POST["preparacion"];}else{$pr->preparacion="NULL";}
                                if(!empty($_POST["gastos_envio"])){$pr->gastos_envio=$_POST["gastos_envio"];}else{$pr->gastos_envio="NULL";}
                                if(!empty($_POST["tiempo_envio"])){$pr->tiempo_envio=$_POST["tiempo_envio"];}else{$pr->tiempo_envio="NULL";}

                                $files = $this->reArrayFiles($_FILES['files']);
                                $contador=0;
                                if(mkdir($upload_folder.'/'.$cat->nombre, 0777, true)){
                                    foreach ($files as $file) {
                                        $img_venta = new Imagick ($file['tmp_name']);
                                        $img_venta->setImageFormat('jpeg');
                                        $img_venta->scaleImage($height,0);
                                        $img_venta_dst=$upload_folder.'/'.$cat->nombre."/".$design_name."-".$contador.".jpg";
                                        if($img_venta->writeImage ($img_venta_dst)){
                                            #SUBIDA DEL THUMBNAIL--------------###
                                            $img_venta->cropThumbnailImage($thumbsize, $thumbsize);
                                            if($contador==0){
                                                $img_thumb_dst=$upload_folder.'/'.$cat->nombre.'/thumb-'.$design_name.'.jpg';
                                            }else{
                                                $img_thumb_dst=$upload_folder.'/'.$cat->nombre.'/thumb-'.$design_name.'-'.$contador.'.jpg';
                                            }
                                            $img_venta->writeImage($img_thumb_dst);
                                            $swerror=0;
                                        }else{
                                            $swerror=1;
                                        }
                                        $contador++;
                                    }
                                }else{
                                    $codigo_error= "No se ha podido crear la carpeta";
                                }
                            }

                            if(empty($codigo_error)){
                                $pr->tags=explode(',',$_POST["tags"]);
                                $dg->user=$this->u->id;
                                if(isset($_POST["publi"])){$dg->publi=1;}else{$dg->publi="NULL";}
                                $data["user"]=$this->u->user;

                                $pr->color = !empty($_POST["color"]) ? $_POST["color"] : '';
                                $pr->modelo = !empty($_POST["modelo"]) ? $_POST["modelo"] : '';

                                $dg->set();
                                if($cat->parent==1){ //si es diseño
                                    if($pr->id=$pr->setDesign()){
                                        $this->loadModel("email");
                                        /*PREPARAMOS EMAIL PARA EL PUBLICADOR*/
                                        $mail = new Email();
                                        $mail->to = $this->u->getUser()["email"];
                                        $mail->subject = "Producto pendiente de aprobar - ".PAGE_NAME;
                                        $mail->getEmail('producto_publicado', $data);
                                        /*PREPARAMOS EMAIL PARA EL ADMINISTRADOR*/
                                        $admail = new Email();
                                        $admail->to = ADMIN_EMAIL;
                                        $admail->subject = "Nuevo producto publicado por ".$this->u->user;
                                        $admail->getEmail('adm_producto_publicado', $data);
                                        if ($mail->sendEmail() && $admail->sendEmail()){
                                            echo true;
                                        }else{
                                           echo "Se ha publicado un producto pero no se ha podido enviar la notificación por email";
                                        }
                                    }else{
                                        echo "No se ha podido dar de alta como producto.";
                                    }
                                }else{ //si es para vender
                                     if($pr->setCraft()){
                                        $this->loadModel("email");
                                        /*PREPARAMOS EMAIL PARA EL PUBLICADOR*/
                                        $mail = new Email();
                                        $mail->to = $this->u->getUser()["email"];
                                        $mail->subject = "Producto pendiente de aprobar - ".PAGE_NAME;
                                        $mail->getEmail('producto_publicado', $data);
                                        /*PREPARAMOS EMAIL PARA EL ADMINISTRADOR*/
                                        $admail = new Email();
                                        $admail->to = ADMIN_EMAIL;
                                        $admail->subject = "Nuevo producto publicado por ".$this->u->user;
                                        $admail->getEmail('adm_producto_publicado', $data);
                                        if ($mail->sendEmail() && $admail->sendEmail()){
                                            echo true;
                                        }else{
                                           echo "Se ha publicado un producto pero no se ha podido enviar la notificación por email";
                                        }
                                    }else{
                                        echo "No se ha podido dar de alta como producto.";
                                    }
                                }
                            }else{
                                $this->loadModel("error");
                                $error=New Error_Model();
                                $error->codigo_error=$codigo_error;
                                $error->from_name=$this->u->user;
                                $error->from_email=$this->u->getUser()["email"];
                                $error->send_email();
                                //echo "Algunas de las imágenes no se han podido subir";
                            }
                        }
                    break;

                    case 'loadTagsQuery':
                        $lista_tags=$t->getActiveTagsQuery($_GET["string"]);
                        echo json_encode($lista_tags);
                    break;

                    default:
                        $data['page_title'] = "1er Paso";
                        $this->render('upload', 'primer_paso',$data);
                }
            }elseif(isset($_SESSION["login"]) && $this->u->getRol()=='comprador'){
                 //Convierte tu cuenta a cuenta de vendedor.
                $data['page_title']="Sube tus diseños";
                $this->render("user", "convertir_vendedor", $data);
            }elseif(isset($_SESSION["login"]) && $this->u->getRol()!='comprador' && !$this->u->getUser_activeaccount()){
                //Eres vendedor pero no tienes la cuenta activada
                $this->u->email=$this->u->getUser()["email"];
                $this->u->sendActivationMail();
                $data['page_title']="Verifica tu cuenta";
                $this->render('user', 'cuenta_no_verificada', $data);
            }else{
                //Redireccionamos a página de registro
                Header("Location: ".PAGE_DOMAIN."/register");
            }
        }

        function reArrayFiles(&$file_post) {
            $file_ary = array();
            $file_count = count($file_post['name']);
            $file_keys = array_keys($file_post);

            for ($i=0; $i<$file_count; $i++) {
                foreach ($file_keys as $key) {
                    $file_ary[$i][$key] = $file_post[$key][$i];
                }
            }
            return $file_ary;
        }
    }
?>
