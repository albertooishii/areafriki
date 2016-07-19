<?php
    include_once 'app/core/controller.php';

    class Producto extends Controller{

        function index_productos(){

            $this->loadModel("producto");
            $pr = New Producto_Model();
            $this->loadModel("precio");
            $pre = New Precio_Model();
            $this->loadModel("categoria");
            $cat = New Categoria_Model();
            $this->loadModel("design");
            $dg = New Design_Model();
            $this->loadModel("user");
            $creador = New Users_Model();

            @$action=$_GET["action"];
            switch($action){
                case 'getPrecioSize':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $pre->producto=$pr->id=$_POST["id"];
                        $producto=$pr->get();

                        $pre->categoria=$producto["categoria"];
                        $pre->codigo=$_POST["size"];
                        $orden=$_POST["orden"];

                        if($precio=$pre->get($orden)){
                            echo number_format( $precio ,2,',','')."€";
                        }else{
                            echo "error";
                        }
                    }
                break;

                case 'changeColor':
                    $data["nombre_categoria"]=$cat->nombre=$categoria=$_GET["categoria"];
                    $pr->categoria=$cat->id=$cat->getWhereNombre()["id"];
                    $data["dg-token"]=$pr->token=$dg->token=$_GET["token"];
                    if($producto=$pr->getProductoWhereToken()){
                        $data["id_producto"]=$dg->id=$pr->id=$producto["id"];
                        $design=$dg->get();
                        $producto=$pr->get();
                        $creador->id=$design["user"];
                        $infouser=$creador->getUserFromID();
                        $data["username"]=$infouser["user"];

                        $img_design = new Imagick(PAGE_DOMAIN."/designs/". $data["username"]."/".$data["dg-token"]."/".$data["dg-token"].".png");

                        $img_design_sizes=$img_design->getImageGeometry();
                        $width=$img_design_sizes["width"]*$producto["scale"];
                        $height=$img_design_sizes["height"]*$producto["scale"];
                        $x=$y=0;
                        $x=$producto["left_pos"]-($width/2);
                        $y=$producto["top_pos"]-($height/2);

                        $img_design->scaleImage($width,0);

                        $pr->codigo=$_POST["color"];
                        $color=$pr->getNombreColor();
                        $color=str_replace(" ", "_", strtolower ($pr->getNombreColor()));
                        if(empty($producto["modelo"])){
                            $img_base = new Imagick(PAGE_DOMAIN."/app/views/product/colores/".$data["nombre_categoria"]."/".$color.".png");
                        }else{
                            $img_base = new Imagick(PAGE_DOMAIN."/app/views/product/colores/".$data["nombre_categoria"]."/".strtolower($producto["modelo"])."/".$color.".png");
                        }

                        $img_base->setImageColorspace($img_design->getImageColorspace());
                        $img_base->compositeImage($img_design, $img_design->getImageCompose(), $x, $y);
                        $img_base=$img_base->getImageBlob();
                        echo "data:image/jpg;base64,".base64_encode($img_base);
                    }else{
                        echo false;
                    }
                break;

                case 'new_list':
                    $pr->nombre_lista=$_POST["list_name"];
                    $pr->user=$this->u->id;
                    if($pr->setLista()){
                        echo $pr->token_lista;
                    }else{
                        echo false;
                    }
                break;

                case 'share':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $pr->categoria=$cat->id=$_POST["categoria"];
                        $data["dg-token"]=$pr->token=$_POST["token"];
                        $producto=$pr->getProductoWhereToken();
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

                case 'comment':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $pr->user=$this->u->id;
                        $pr->id=$_POST["producto"];
                        $data["comment_text"]=$pr->comentario=$_POST["comentario"];
                        if($pr->comentar()){
                            $data["comment_user"]=$this->u->getUserFromID()["user"];
                            $data["comment_avatar"]=$this->u->getAvatar(128);
                            $data["comment_date"]="Ahora mismo";
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
                        $pr->id=$_GET["id"];
                        $dg->token=$pr->get()["design"];
                        if($dg->get()["user"]==$this->u->id){
                            if($pr->deactivate()){
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
                        $pr->token=$_GET["token"];
                        $producto=$pr->getProductoWhereToken();
                        $data["id_producto"]=$pre->producto=$pr->id=$producto["id"];
                        $dg->token=$producto["design"];
                        if($dg->get()["user"]==$this->u->id){
                            $pr->user=$this->u->id;
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
                            $lista_tags=$pr->getTags();
                            $data["tags"]="";
                            if($lista_tags){
                                foreach($lista_tags as $tag){
                                    $data["tags"].=$tag["tag"].', ';
                                }
                                $data["tags"]=trim($data["tags"], ', ');
                            }

                            $data["lista_producto"]=$pr->token_lista=$producto["lista"];
                            $data["listas"]=$pr->getListas();
                            $data["listas_productos"]=$this->loadView("designer","listas_productos",$data);


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
                                    $data["precio_venta"]=round($producto["beneficio"]*1.075,2);
                                    $data["comision"]=$data["precio_venta"]-$producto["beneficio"];
                                    $data["beneficio"]=$this->loadView("product", "product_edit_precios_venta",$data);
                                }
                            }else{
                                $cat->tipo_attr="size";
                                $valores=$cat->getValoresByTipo();
                                $data["beneficio"]="";
                                foreach($valores as $valor){
                                    $data["orden"]=$valor["orden"];
                                    $data["beneficio_valor"]=$pre->getBeneficio($data["orden"]);
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
                        $pr->token=$_POST["token"];
                        $producto=$pr->getProductoWhereToken();
                        $pr->id=$producto["id"];
                        $dg->token=$producto["design"];
                        if($dg->get()["user"]==$this->u->id){
                            $pr->nombre=$_POST["nombre"];
                            $pr->descripcion=$_POST["descripcion"];
                            $pr->tags=explode(',',$_POST["tags"]);
                            if(isset($_POST["listas_productos"])){
                                $pr->token_lista=$_POST["listas_productos"];
                            }
                            $pr->beneficio=$_POST["beneficio"];
                            if(isset($_POST["stock"])){
                                $pr->stock=$_POST["stock"];
                            }
                            if(isset($_POST["preparacion"])){
                                $pr->preparacion=$_POST["preparacion"];
                            }
                            if(isset($_POST["tiempo_envio"])){
                                $pr->tiempo_envio=$_POST["tiempo_envio"];
                            }
                            if(isset($_POST["gastos_envio"])){
                                $pr->gastos_envio=$_POST["gastos_envio"];
                            }
                            if($pr->update()){
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
                        if($resultados=$pr->search($string)){
                            $lista_productos="";
                            foreach($resultados as $producto){
                                $creador = New Users_Model();
                                $data["dg-token"]=$dg->token=$producto["design"];
                                $design=$dg->get();
                                $creador->id=$pr->creador=$design["user"]; //asignamos el id del creador
                                $infocreador=$creador->getUserFromID();
                                $data["id_producto"]=$pr->id;
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
                                $data["beneficio"]=number_format($pre->getBeneficio(), 2, ',', ' ')."€";
                                $data["precio_venta"]=number_format($pre->get(), 2, ',', ' ')."€";
                            }else{
                                $data["beneficio"]=$data["precio_venta"]="";
                                $orden=0;
                                $sizes=$pr->getSizes();
                                foreach($sizes as $size){
                                    $orden++;
                                    $data["beneficio"].=$size["valor"].": ".number_format($pre->getBeneficio($orden), 2, ',', ' ')."€<br>";
                                    $data["precio_venta"].= $size["valor"].": ".number_format($pre->get(), 2, ',', ' ')."€<br>";
                                }
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
                            $data["cat_id"]=$pre->categoria=$pr->categoria=$cat->id=$info_cat["id"];
                            $data["cat_desc"]=$info_cat["descripcion"];

                            if($categoria=$cat->get()){
                                if(isset($_GET["token"])){

                                    $data["dg-token"]=$pr->token=$dg->token=$_GET["token"];
                                    if($producto=$pr->getProductoWhereToken()){
                                        $data["id_producto"]=$dg->id=$pr->id=$pre->producto=$producto["id"];
                                        $pr->visitar();
                                        $design=$dg->get();
                                        $producto=$pr->get();
                                        if($pr->isActive() && $pr->isRevisado()){
                                            $creador->id=$design["user"];
                                            $infouser=$creador->getUserFromID();
                                            $data["username"]=$creador->user=$infouser["user"];
                                            $data["creador_avatar"]=$creador->getAvatar(64);
                                            $data["dg-token"]=$_GET["token"];
                                            $data["page_title"]=$data["dg-nombre"]=$producto["nombre"];
                                            $data["dg-descripcion"]=$producto["descripcion"];
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

                                            if(isset($_SESSION["login"])){
                                                $pr->user=$this->u->id;
                                            }else{
                                                $pr->user=0;
                                            }
                                            if($pr->userLikeProducto()){
                                                $data["like_class"]='like';
                                            }else{
                                                $data["like_class"]='unlike';
                                            }

                                            $data["contador_likes"]=$pr->getLikes();
                                            $data["contador_shares"]=$pr->getShares();
                                            $data["contador_visitas"]=$pr->getViews();
                                            $data["contador_comments"]=$pr->getContComentarios();
                                            $data["avatar"]=$this->u->getAvatar(128);

                                            $data["comments_list"]="";
                                            $lista_comentarios=$pr->getComentarios();
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
                                            if($categoria["parent"]==1){
                                                $data["atributos"]="";

                                                if(!empty($producto["color"])){
                                                    $data["lista_colores"]=$pr->getColores();
                                                    $data["color"]=$producto["color"];
                                                    $data["atributos"].=$this->loadView('product','color_selector',$data);
                                                }
                                                if($precio=$pre->get()){
                                                    $data["precio_float"]=number_format($precio, 2);
                                                    $data["precio"] = number_format($data["precio_float"] ,2,',','');
                                                }

                                                if($lista_sizes=$pr->getValoresModelo()){
                                                    $data["atributos"].=$this->loadView('product','size_selector',$lista_sizes);
                                                }elseif($lista_sizes=$pr->getSizes()){
                                                    $data["atributos"].=$this->loadView('product','size_selector',$lista_sizes);
                                                }
                                                $data["condition"]="new";
                                                $data["preparacion"]=2;
                                                $data["tiempo_envio"]=3;
                                                $data["thumbnails"]="";
                                                $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/product/product_file.js'></script>";
                                                $data["custom_js"].="<script src='".PAGE_DOMAIN."/app/views/product/comment_card.js'></script>";
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

                                                $data["precio_float"]=number_format($pre->get(),2);
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

                                                $data["stock"]=$producto["stock"];
                                                $data["preparacion"]=$producto["preparacion"];
                                                if($producto["gastos_envio"]>0){
                                                    $data["gastos_envio"] = number_format($producto["gastos_envio"], 2, ',', '')." €";
                                                }else{
                                                    $data["gastos_envio"] = "¡Envío gratuíto!";
                                                }
                                                $data["tiempo_envio"]=$producto["tiempo_envio"];
                                                $data["atributos"]="";
                                                $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/product/product_file.js'></script>";
                                                $data["custom_js"].="<script src='".PAGE_DOMAIN."/app/views/product/comment_card.js'></script>";
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
