<?php
    class Producto extends Controller{

        function index_productos(){

            $this->loadModel("producto");
            $p = New Producto_Model();
            $this->loadModel("precio");
            $pr = New Precio_Model();
            $this->loadModel("categoria");
            $cat = New Categoria_Model();
            $this->loadModel("design");
            $dg = New Design_Model();
            $creador = New Users_Model();
            $this->loadModel("notification");
            $notify = New Notification_Model();

            @$action=$_GET["action"];
            switch($action){
                case 'getPrecioSize':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                        if(isset($_POST["id"])){
                            $pr->producto=$p->id=$_POST["id"];
                            $producto=$p->get();

                            $pr->categoria=$producto["categoria"];
                            $pr->codigo=$_POST["size"];
                            if(isset($_POST["orden"])){
                                $orden=$_POST["orden"];
                            }else{
                                $orden=1;
                            }

                            if($precio=$pr->get($orden)){
                                echo number_format( $precio ,2,',','')."€";
                            }else{
                                echo "error";
                            }
                        }else{
                            echo "error";
                        }
                    }
                break;

                case 'solicitarCompra':
                    if(isset($_POST)){
                        $p->id=$_POST["id"];
                        if(isset($_SESSION["login"])){
                            $p->user=$this->u->id;
                            $p->solicitarCompra();
                        }
                        $producto=$p->get();
                        $cat->id=$producto["categoria"];
                        $data["cat_nombre"]=$cat->get()["nombre"];
                        $data["token"]=$dg->token=$producto["design"];
                        $design=$dg->get();
                        $notify->to=$creador->id=$design["user"];
                        $data["dg_nombre"]=$producto["nombre"];
                        $info_creador=$creador->getUserFromID();
                        $data["nombre"]=$info_creador["user"];

                        //Notificacion para el vendedor
                        $notify->from=$this->u->id;
                        $notify->producto=$p->id;
                        $notify->titulo="Solicitud de compra";
                        $notify->texto="Un usuario quiere comprar ".$producto["nombre"]." pero no tienes configuradas las opciones de pago.";
                        $notify->url="settings";
                        $notify->tipo="compra";
                        $notify->set();

                        //Email para el vendedor
                        $this->loadModel("email");
                        $mail=New Email();
                        $mail->getEmail("solicitar_producto", $data);
                        $mail->to=$info_creador["email"];
                        $mail->subject=PAGE_NAME." | [Solicitud de compra]";
                        if($mail->sendEmail()){
                            echo true;
                        }else{
                            echo false;
                        }
                    }
                break;

                case 'new_list':
                    $p->nombre_lista=$_POST["list_name"];
                    $p->user=$this->u->id;
                    if($p->setLista()){
                        echo $p->token_lista;
                    }else{
                        echo false;
                    }
                break;

                case 'share':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $p->categoria=$cat->id=$_POST["categoria"];
                        $data["dg-token"]=$p->token=$_POST["token"];
                        $producto=$p->getProductoWhereToken();
                        $data["dg-categoria"]=$cat->get()["nombre"];
                        $data["dg-nombre"]=$producto["nombre"];
                        $data["dg-descripcion"]=$producto["descripcion"];
                        $dg->token=$producto["design"];
                        $design=$dg->get();
                        $creador->id=$design["user"];
                        $infouser=$creador->getUserFromID();
                        $data["dg-user"]=$infouser["user"];

                        if($creador->id==$this->u->id){
                            $data["dg-text"]="Mira lo que he subido a ".PAGE_NAME;
                        }else{
                            $data["dg-text"]="Mira lo que he encontrado en ".PAGE_NAME;
                        }

                        $html=$this->loadView("upload","share",$data);
                        echo $html;
                    }else{
                        $data["page_title"]="ERROR 404";
                        $this->render("error","404");
                    }
                break;

                case 'countShare':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $p->categoria=$cat->id=$_POST["categoria"];
                        $data["dg-token"]=$p->token=$_POST["token"];
                        $p->id=$p->getProductoWhereToken()["id"];
                        if($p->share()){
                            echo true;
                        }
                    }else{
                        $data["page_title"]="ERROR 404";
                        $this->render("error","404");
                    }
                break;

                case 'comment':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $p->user=$this->u->id;
                        $p->id=$_POST["producto"];
                        $data["comment_text"]=$p->comentario=$_POST["comentario"];
                        if($p->comentar()){
                            $producto=$p->get();
                            $dg->token=$producto["design"];
                            $cat->id=$producto["categoria"];
                            $notify->to=$dg->get()["user"];
                            $notify->from=$this->u->id;
                            $notify->producto=$p->id;
                            $notify->titulo="Nuevo comentario";
                            $notify->texto=$this->u->user.": ".$this->cutText($p->comentario,55);
                            $notify->url=$cat->get()["nombre"]."/".$dg->token;
                            $notify->tipo="like";
                            $notify->set();
                            $data["comment_user"]=$this->u->getUserFromID()["user"];
                            $data["comment_avatar"]=$this->u->getAvatar(128);
                            $data["comment_date"]=$this->format_date(date ("Y-m-d H:i:s"));
                            echo $this->loadView("product","comment_card", $data);
                        }else{
                            echo "false";
                        }
                    }else{
                        $data["page_title"]="ERROR 404";
                        $this->render("error","404");
                    }
                break;

                case 'delete'://deactivate
                    if(isset($_GET["id"])){
                        $p->id=$_GET["id"];
                        $dg->token=$p->get()["design"];
                        if($dg->get()["user"]==$this->u->id){
                            if($p->deactivate()){
                                header("Location:".$_SERVER['HTTP_REFERER']);
                            }else{

                            }
                        }else{
                            $data["page_title"]="ERROR 404";
                            $this->render("error","404",$data);
                        }
                    }else{
                        $data["page_title"]="ERROR 404";
                        $this->render("error","404",$data);
                    }
                break;

                case 'edit':
                    if(isset($_GET["token"])){
                        $p->token=$_GET["token"];
                        $producto=$p->getProductoWhereToken();
                        $data["id_producto"]=$pr->producto=$p->id=$producto["id"];
                        $dg->token=$producto["design"];
                        if($dg->get()["user"]==$this->u->id){
                            $p->user=$this->u->id;
                            $data["username"]=$this->u->user;
                            $data["dg-token"]=$_GET["token"];
                            $data["page_title"]=$data["dg-nombre"]=$producto["nombre"];
                            $data["dg-descripcion"]=$producto["descripcion"];
                            $data["cat_id"]=$cat->id=$producto["categoria"];
                            $info_cat=$cat->get();
                            $data["nombre_categoria"]=$info_cat["nombre"];
                            $data["precio"] = number_format($producto["beneficio"],2,',','');
                            $data["stock"]=$producto["stock"];
                            $data["preparacion"]=$producto["preparacion"];
                            $data["gastos_envio"]=$producto["gastos_envio"];
                            $data["tiempo_envio"]=$producto["tiempo_envio"];
                            $lista_tags=$p->getTags();
                            $data["tags"]="";
                            if($lista_tags){
                                foreach($lista_tags as $tag){
                                    $data["tags"].=$tag["tag"].', ';
                                }
                                $data["tags"]=trim($data["tags"], ', ');
                            }

                            $data["lista_producto"]=$p->token_lista=$producto["lista"];
                            if($data["listas"]=$p->getListas()){
                                $data["listas_productos"]=$this->loadView("designer","listas_productos",$data);
                            }else{
                                $data["listas_productos"]="";
                            }


                            if(!empty($producto["beneficio"])){
                                $data["beneficio_producto"]=$producto["beneficio"];
                                if($data["cat_id"] != 2 && $data["cat_id"] != 30){
                                    $cat->precio_base=$info_cat["precio_base"];
                                    $data["precio_base"]=$cat->precio_base;
                                    $cat->beneficio=$info_cat["beneficio"];
                                    $data["precio_tope"]=$cat->precio_base + $cat->beneficio;
                                    $data["beneficio_max"]=$cat->beneficio;
                                    $data["beneficio"]=$this->loadView("product", "product_edit_precios",$data);
                                }else{
                                    $data["precio_venta"]=round($producto["beneficio"],2);
                                    $data["comision"]=$data["precio_venta"]-$producto["beneficio"];
                                    $data["beneficio"]=$this->loadView("product", "product_edit_precios_venta",$data);
                                }
                            }else{
                                $cat->tipo_attr="size";
                                $valores=$cat->getValoresByTipo();
                                $data["beneficio"]="";
                                foreach($valores as $valor){
                                    $data["orden"]=$valor["orden"];
                                    $data["beneficio_valor"]=$pr->getBeneficio($data["orden"]);
                                    $data["valor"]=$valor["valor"];
                                    $data["beneficio_max"]=$valor["beneficio"];
                                    $data["precio_base"]=$valor["precio_base"];
                                    $data["precio_tope"]=$valor["precio_base"]+$valor["beneficio"];
                                    $data["beneficio"].=$this->loadView("product", "product_edit_precios_sizes",$data);
                                }
                            }

                            $data["thumbnails"]="";
                            if($cat->id==2 || $cat->id==30){
                                $source_folder="designs/".$data["username"]."/".$data["dg-token"]."/".$data["nombre_categoria"];

                                $data["thumbnail-number"]=0;
                                foreach(glob($source_folder."/thumb-".$data["dg-token"]."*") as $file){
                                    if($data["thumbnail-number"]>0){
                                        $data["thumbnails"].=$this->loadView("product", "thumbnails", $data);
                                    }
                                    $data["thumbnail-number"]++;
                                }
                            }
                            $data["custom_css"]="<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/css/bootstrap-slider.min.css'>";
                            $this->render("product","product_edit",$data);
                        }else{
                            $data["page_title"]="ERROR 404";
                            $this->render("error","404",$data);
                        }
                    }else{
                        $data["page_title"]="ERROR 404";
                        $this->render("error","404",$data);
                    }
                break;

                case 'savechanges':
                    //print_r($_POST);
                    if(isset($_POST["token"])){
                        $p->token=$_POST["token"];
                        $producto=$p->getProductoWhereToken();
                        $p->id=$producto["id"];
                        $dg->token=$producto["design"];
                        if($dg->get()["user"]==$this->u->id){
                            $p->nombre=$_POST["nombre"];
                            $p->descripcion=$_POST["descripcion"];
                            $p->tags=explode(',',$_POST["tags"]);
                            if(isset($_POST["listas_productos"])){
                                $p->token_lista=$_POST["listas_productos"];
                            }
                            $p->beneficio=$_POST["beneficio"];
                            if(isset($_POST["stock"])){
                                $p->stock=$_POST["stock"];
                            }
                            if(isset($_POST["preparacion"])){
                                $p->preparacion=$_POST["preparacion"];
                            }
                            if(isset($_POST["tiempo_envio"])){
                                $p->tiempo_envio=$_POST["tiempo_envio"];
                            }
                            if(isset($_POST["gastos_envio"])){
                                $p->gastos_envio=$_POST["gastos_envio"];
                            }
                            if($p->update()){
                                header("Location:".PAGE_DOMAIN.'/myuploads');
                            }else{
                                echo "error";
                            }
                        }else{
                            $data["page_title"]="ERROR 404";
                            $this->render("error","404",$data);
                        }
                    }else{
                        $data["page_title"]="ERROR 404";
                        $this->render("error","404",$data);
                    }
                break;

                case 'search':
                    if(!empty($_POST["string"])){
                        $string=$_POST["string"];
                        if($resultados=$p->search($string)){
                            $lista_productos="";
                            foreach($resultados as $producto){
                                $creador = New Users_Model();
                                $data["dg-token"]=$dg->token=$producto["design"];
                                $design=$dg->get();
                                $creador->id=$p->creador=$design["user"]; //asignamos el id del creador
                                $infocreador=$creador->getUserFromID();
                                $data["id_producto"]=$p->id;
                                $data["cat_id"]=$cat->id=$producto["categoria"];
                                $data["cat_nombre"]=$cat->get()["nombre"];
                                $data["username"]=$creador->user=$infocreador["user"];
                                $data["avatar"]=$creador->getAvatar(64);
                                $data["dg-descripcion"]=$this->cutText($producto["descripcion"],60);
                                $data["dg-nombre"]=$producto["nombre"];
                                $lista_productos.=$this->loadView("header", "search", $data);
                            }
                        }else{
                            $lista_productos="<li>No hay resultados</li>";
                        }
                        echo $lista_productos;
                    }
                break;

                case 'myuploads':
                    $p->creador=$this->u->id;
                    if($lista_productos=$p->getProductosUser()){
                        $data["lista_productos"]="";
                        foreach($lista_productos as $producto){
                            $data["producto"]=$pr->producto=$p->id=$producto["id"];
                            $data["dg_token"]=$dg->token=$producto["design"];
                            $design=$dg->get();
                            $pr->categoria=$cat->id=$p->categoria=$p->categoria=$producto["categoria"];
                            $data["dg_categoria"]=$cat->get()["nombre"];
                            $data["dg_nombre"]=$producto["nombre"];

                            $lista_tags=$p->getTags();
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

                            $pr->modelo=$p->modelo=$producto["modelo"];

                            if($valores=$p->getValoresModelo()){ //El producto tiene distintos valores
                                $data["beneficio"]=$data["precio_venta"]="";
                                foreach($valores as $orden => $size){
                                    $precio=$pr->get($orden+1);
                                    $data["beneficio"].=$size["valor"].": ".number_format($pr->beneficio, 2, ',', ' ')."€<br>";
                                    $data["precio_venta"].= $size["valor"].": ".number_format($precio, 2, ',', ' ')."€<br>";
                                }
                            }else{
                                $precio=$pr->get();
                                $data["beneficio"]=number_format($pr->beneficio, 2, ',', ' ')."€";
                                $data["precio_venta"]= number_format($precio, 2, ',', ' ')."€";
                            }

                            $data["lista_productos"].=$this->loadView("user","myuploads_card", $data);
                        }
                    }else{
                        $data["lista_productos"]=$this->loadView("error","form_error","No hay productos subidos");
                    }
                    $this->render("user","myuploads",$data);
                break;

                default:
                    if (isset($_GET["categoria"])){
                        $data["nombre_categoria"]=$cat->nombre=$categoria=$_GET["categoria"];
                        if($info_cat=$cat->getWhereNombre()){
                            $data["cat_id"]=$pr->categoria=$p->categoria=$cat->id=$info_cat["id"];
                            $data["cat_desc"]=$info_cat["descripcion"];

                            if($categoria=$cat->get()){
                                if(isset($_GET["token"])){

                                    $data["dg-token"]=$p->token=$dg->token=$_GET["token"];
                                    if($producto=$p->getProductoWhereToken()){
                                        $data["id_producto"]=$dg->id=$p->id=$pr->producto=$producto["id"];
                                        $p->visitar();
                                        $design=$dg->get();
                                        $producto=$p->get();
                                        if($p->isActive() && $p->isRevisado()){
                                            $creador->id=$design["user"];
                                            $infouser=$creador->getUserFromID();
                                            $data["username"]=$creador->user=$infouser["user"];
                                            $data["creador_avatar"]=$creador->getAvatar(64);
                                            $data['banner']=$creador->getBanner();
                                            $data["dg-token"]=$_GET["token"];
                                            $data["page_title"]=$data["dg-nombre"]=$producto["nombre"];
                                            $data["dg-descripcion"]=$producto["descripcion"];
                                            $lista_tags=$p->getTags();
                                            $data["tags"]="";

                                            if($lista_tags){
                                                foreach($lista_tags as $tag){
                                                    $data["tag"]=$tag["tag"];
                                                    $data["tag_url"]=urlencode($tag["tag"]);
                                                    $data["tags"].=$this->loadView('product','tags_list', $data).', ';
                                                }
                                                $data["tags"]=trim($data["tags"], ', ');
                                            }

                                            if(isset($_SESSION["login"])){
                                                $p->user=$this->u->id;
                                            }else{
                                                $p->user=0;
                                            }
                                            if($p->userLikeProducto()){
                                                $data["like_class"]='like';
                                            }else{
                                                $data["like_class"]='unlike';
                                            }

                                            $data["contador_likes"]=$p->getLikes();
                                            $data["contador_shares"]=$p->getShares();
                                            $data["contador_visitas"]=$p->getViews();
                                            $data["contador_comments"]=$p->getContComentarios();
                                            $data["avatar"]=$this->u->getAvatar(128);

                                            $data["comments_list"]="";
                                            $lista_comentarios=$p->getComentarios();
                                            if(!empty($lista_comentarios)){
                                                $comen=New Users_Model();
                                                foreach ($lista_comentarios as $comentario){
                                                    $comen->id=$comentario["user"];
                                                    $infocomment_user=$comen->getUserFromID();
                                                    $data["comment_user"]=$comen->user=$infocomment_user["user"];
                                                    $data["comment_avatar"]=$comen->getAvatar(128);
                                                    $data["comment_date"]=$this->format_date($comentario["fecha"]);
                                                    $data["comment_text"]=$comentario["comentario"];
                                                    $data["comments_list"].=$this->loadView("product","comment_card", $data);
                                                }
                                            }

                                            $data["cat_parent"]=$categoria["parent"];
                                            $data["puedevender"]=true;

                                            if($categoria["parent"]==1){
                                                $data["atributos"]=$data["color_selector"]="";

                                                if(!empty($producto["color"])){
                                                    $data["lista_colores"]=$p->getColores();
                                                    $data["color"]=$producto["color"];
                                                    $data["color_selector"]=$this->loadView('product','color_selector',$data);
                                                }
                                                if($precio=$pr->get()){
                                                    $data["precio_float"]=number_format($precio, 2);
                                                    $data["precio"] = number_format($data["precio_float"] ,2,',','');
                                                }

                                                $data["modelo"]=$p->modelo=$producto["modelo"];
                                                if($lista_sizes=$p->getValoresModelo()){
                                                    $data["atributos"].=$this->loadView('product','size_selector',$lista_sizes);
                                                }elseif($lista_sizes=$p->getSizes()){
                                                    $data["atributos"].=$this->loadView('product','size_selector',$lista_sizes);
                                                }
                                                $data["condition"]="new";
                                                $data["preparacion"]=PREPARACION;
                                                $data["tiempo_envio"]=TIEMPO_ENVIO;
                                                $data["modelo"]=$producto["modelo"];
                                                $data["thumbnails"]="";

                                                $data["custom_js"]="";

                                                switch($data["nombre_categoria"]){
                                                    case 'camisetas':
                                                        $data["left"]=$producto["left_pos"];
                                                        $data["top"]=$producto["top_pos"];
                                                        $data["scale"]=$producto["scale"];

                                                        $data["img_design"] = PAGE_DOMAIN."/designs/". $data["username"]."/".$data["dg-token"]."/".$data["dg-token"].".png";
                                                        $img_design = new Imagick($data["img_design"]);

                                                        $img_design_sizes=$img_design->getImageGeometry();
                                                        $data["width"]=$width=$img_design_sizes["width"];
                                                        $data["height"]=$height=$img_design_sizes["height"];

                                                        $data["montaje"]=$this->loadView("product","camisetas",$data);

                                                        $data["custom_css"]="<link rel='stylesheet' href='".PAGE_DOMAIN."/vendor/fancy_product_designer/source/css/FancyProductDesigner-all.min.css'>";
                                                    break;

                                                    case 'sudaderas':
                                                        $data["left"]=$producto["left_pos"];
                                                        $data["top"]=$producto["top_pos"];
                                                        $data["scale"]=$producto["scale"];

                                                        $data["img_design"] = PAGE_DOMAIN."/designs/". $data["username"]."/".$data["dg-token"]."/".$data["dg-token"].".png";
                                                        $img_design = new Imagick($data["img_design"]);

                                                        $img_design_sizes=$img_design->getImageGeometry();
                                                        $data["width"]=$width=$img_design_sizes["width"];
                                                        $data["height"]=$height=$img_design_sizes["height"];

                                                        $data["montaje"]=$this->loadView("product","sudaderas",$data);

                                                        $data["custom_css"]="<link rel='stylesheet' href='".PAGE_DOMAIN."/vendor/fancy_product_designer/source/css/FancyProductDesigner-all.min.css'>";
                                                    break;

                                                    default:
                                                        $data["montaje"]="<img src='".PAGE_DOMAIN."/designs/".$data["username"]."/".$data["dg-token"]."/".$data["nombre_categoria"]."/MONTAJE-".$data["dg-token"].".jpg'>";
                                                }
                                                $data["stock"]=10000;

                                                $data["custom_js"]=$this->minifyJs("product", "product_file");
                                                $data["custom_js"].=$this->minifyJs("product", "comment_card");
                                                $data["meta_tags"]=$this->loadView("meta","meta-producto",$data);
                                                $this->render('product', 'product_file', $data);
                                            }else{
                                                $data["thumbnails"]="";
                                                $source_folder="designs/".$data["username"]."/".$data["dg-token"]."/".$data["nombre_categoria"];

                                                $data["thumbnail-number"]=0;
                                                foreach(glob($source_folder."/thumb-".$data["dg-token"]."*") as $file){
                                                    if($data["thumbnail-number"]>0){
                                                        $data["thumbnails"].=$this->loadView("product", "thumbnails", $data);
                                                    }
                                                    $data["thumbnail-number"]++;
                                                }

                                                $data["precio_float"]=number_format($pr->get(),2);
                                                $data["precio"] = number_format($data["precio_float"],2,',','');

                                                if($cat->id==30){
                                                    if($producto["usado"]){
                                                        $data["condition"]="used";
                                                        $data["usado"]="¡Segunda mano!";
                                                    }else{
                                                        $data["condition"]="new";
                                                        $data["usado"]="¡Nuevo!";
                                                    }
                                                }else{
                                                    $data["condition"]="new";
                                                    $data["usado"]="";
                                                }

                                                if(!is_null($producto["stock"])){
                                                    $data["stock"]=$producto["stock"];
                                                }else{
                                                    $data["stock"]=10000;
                                                }

                                                $data["preparacion"]=$producto["preparacion"];
                                                if($producto["gastos_envio"]>0){
                                                    $data["gastos_envio"] = number_format($producto["gastos_envio"], 2, ',', '')." €";
                                                }else{
                                                    $data["gastos_envio"] = "¡Envío gratuíto!";
                                                }
                                                $data["tiempo_envio"]=$producto["tiempo_envio"];

                                                if(!$creador->puedeVender()){
                                                    $data["puedevender"]=false;
                                                }

                                                $data["atributos"]="";
                                                $data["custom_js"]=$this->minifyJs("product", "product_file");
                                                $data["custom_js"].=$this->minifyJs("product", "comment_card");
                                                $data["meta_tags"]=$this->loadView("meta","meta-producto",$data);
                                                $this->render('product', 'product_file', $data);
                                            }
                                        }else{
                                            //El producto no está active=1
                                            $data["page_title"]="ERROR 404";
                                            $this->render("error","404",$data);
                                        }
                                    }else{
                                        $data["page_title"]="ERROR 404";
                                        $this->render('error','404',$data);
                                    }
                                }else{//cargamos todos los productos de la categoria en listado

                                }
                            }else{
                                $data["page_title"]="ERROR 404";
                                $this->render('error','404',$data);
                            }
                        }else{
                            $data["page_title"]="ERROR 404";
                            $this->render('error','404',$data);
                        }
                    }
            }
        }
    }
?>
