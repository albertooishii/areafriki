<?php
    class Home extends Controller{

        function index_home(){
            $data['page_title'] = "Tienda friki: camisetas, decoración, segunda mano";
            $this->loadModel("producto");
            $pr = New Producto_Model();
            $this->loadModel("design");
            $dg = New Design_Model();
            $this->loadModel("categoria");
            $cat = New Categoria_Model();
            $this->loadModel("tag");
            $t = New Tag_Model();
            if(isset($_SESSION["login"])){
                $pr->user=$this->u->id;//asignamos el id del usuario de sesion
            }else{
                $pr->user=0;
            }
            $lista_productos=$product_cards="";
            if(!empty($_GET)){
                $items=30;
                $data["curpage"]=$page=$_GET["page"];
                if(isset($_GET["orderby"])){
                    $data["order"]=$_GET["orderby"];
                }else{
                    $data["order"]=false;
                }
                if(isset($_GET["categoria"])){
                    $cat->nombre=$_GET["categoria"];
                    $info_categoria=$cat->getWhereNombre();
                    $pr->categoria=$info_categoria["id"];
                    $nombre_categoria=$info_categoria["descripcion_corta"];
                    $data["sourcepage"]=PAGE_DOMAIN."/".$info_categoria["nombre"];
                    $limit1=$items*($page-1)+1;
                    $totalitems=$pr->countProductosCategoria();
                    $data["totalpages"]=$totalpages=ceil($totalitems/$items);
                    $lista_productos=$pr->getProductosCategoria($limit1.", ".$items, $data["order"]);
                    $data["subhead"]=$nombre_categoria;
                }elseif(isset($_GET["tag"])){
                    $pr->tag=urldecode($_GET["tag"]);
                    $data["sourcepage"]=PAGE_DOMAIN."/tag/".$_GET["tag"];
                    $limit1=$items*($page-1)+1;
                    $totalitems=$pr->countProductosTag();
                    $data["totalpages"]=$totalpages=ceil($totalitems/$items);
                    $lista_productos=$pr->getProductosTag($limit1.", ".$items, $data["order"]);
                    $data["subhead"]="#".str_replace("-"," ",$pr->tag);
                }
                if(!empty($lista_productos)){
                    foreach($lista_productos as $producto){
                        $data["id_producto"]=$pr->id=$producto["id"];
                        $creador = New Users_Model();
                        $data["dg-token"]=$dg->token=$producto["design"];
                        $design=$dg->get();
                        $creador->id=$pr->creador=$design["user"]; //asignamos el id del creador
                        $infocreador=$creador->getUserFromID();
                        $data["cat_id"]=$cat->id=$producto["categoria"];
                        $data["cat_nombre"]=$cat->get()["nombre"];
                        $creador->user=$data["username"]=$infocreador["user"];
                        $data["creador_avatar"]=$creador->getAvatar(64);
                        $data["dg-nombre"]=$producto["nombre"];
                        $data["dg-descripcion"]=$producto["descripcion"];

                        if($pr->userLikeProducto()){
                            $data["like_class"]='like';
                        }else{
                            $data["like_class"]='unlike';
                        }
                        $data["contador_likes"]=$pr->getLikes();
                        $data["contador_shares"]=$pr->getShares();
                        $data["contador_comments"]=0;
                        $data["product_card"]=$this->loadView('product','product_card',$data);
                        $product_cards.=$this->loadView('product','product_card_col-xl-4',$data);
                    }
                    $data["last_uploads"]=$product_cards;
                    $data["pagination"]=$this->loadView("product", "pagination", $data);
                }else{
                    $data["last_uploads"]=$this->loadView("error", "form_error", "No se han encontrado resultados");
                    $data["pagination"]="";
                }
                $data["tag_list"]="";
                $lista_tags=$t->getPopularTags(20);
                foreach($lista_tags as $tag){
                    $data["nombre_tag"]=$tag["tag"];
                    $data["tag_list"].=$this->loadView("product","tag_list",$data);
                }
                $data["custom_js"]=$this->minifyJs("home", "index_productos");
                $this->render('home', 'index_productos', $data);
            }else{
                if(isset($_SESSION["login"])){
                    if(!$this->u->getUser_activeaccount() && $this->u->vecesLogueado()==1){
                        $data["primer_login"]=$this->loadView("success","form_success","¡Bienvenido/a! Te hemos enviado un email para poder activar tu cuenta y así acceder a todas las opciones que te ofrece ".PAGE_NAME.". Si no ves el mensaje revisa la bandeja de spam o correo no deseado, puede que haya terminado ahí por error. Se paciente, puede tardar hasta 5 minutos en llegar.");
                    }elseif($this->u->getUser_activeaccount() && $this->u->vecesLogueado()==1){
                        $data["primer_login"]=$this->loadView("success","form_success","¡Bienvenido/a a ".PAGE_NAME."! ¡Ya tienes tu cuenta activada correctamente!");
                    }
                }

                /*LOS MÁS POPULARES*/
                $data["carousel_item"]="";
                if($lista_mas_populares=$pr->getOnFire(8)){
                    foreach ($lista_mas_populares as $producto){
                        $pr->id=$producto["id"];
                        if($pr->isActive() && $pr->isRevisado()){
                            $creador = New Users_Model();
                            $data["dg-token"]=$dg->token=$producto["design"];
                            $design=$dg->get();
                            $creador->id=$pr->creador=$design["user"]; //asignamos el id del creador
                            $infocreador=$creador->getUserFromID();
                            $data["id_producto"]=$pr->id;
                            $data["cat_id"]=$cat->id=$producto["categoria"];
                            $data["cat_nombre"]=$cat->get()["nombre"];
                            $data["username"]=$creador->user=$infocreador["user"];
                            $data["creador_avatar"]=$creador->getAvatar(64);
                            $data["dg-nombre"]=$producto["nombre"];
                            if(isset($_SESSION["login"]) && $pr->userLikeProducto()){
                                $data["like_class"]='like';
                            }else{
                                $data["like_class"]='unlike';
                            }
                            $data["contador_likes"]=$pr->getLikes();
                            $data["contador_shares"]=$pr->getShares();
                            $data["contador_comments"]=$pr->getContComentarios();
                            $data["product_card"]=$this->loadView('product','product_card',$data);
                            $product_cards.=$this->loadView('product','product_card_col-xl-3',$data);
                        }
                    }
                    $data["mas_populares"]=$product_cards;
                }else{
                     $data["mas_populares"]=$this->loadView("error", "form_error", "No hay productos con likes");
                }

                /*LOS ÚLTIMOS VISITADOS*/
                $data["carousel_item"]=$product_cards="";
                $pr->user=$this->u->id;
                if($lista_ultimos_vistos=$pr->getLastViewsUser(6)){
                    foreach ($lista_ultimos_vistos as $producto){
                        $pr->id=$producto["id"];
                        if($pr->isActive() && $pr->isRevisado()){
                            $creador = New Users_Model();
                            $data["dg-token"]=$dg->token=$producto["design"];
                            $design=$dg->get();
                            $creador->id=$pr->creador=$design["user"]; //asignamos el id del creador
                            $infocreador=$creador->getUserFromID();
                            $data["id_producto"]=$pr->id;
                            $data["cat_id"]=$cat->id=$producto["categoria"];
                            $data["cat_nombre"]=$cat->get()["nombre"];
                            $data["username"]=$creador->user=$infocreador["user"];
                            $data["creador_avatar"]=$creador->getAvatar(64);
                            $data["dg-nombre"]=$this->cutText($producto["nombre"],15);
                            if(isset($_SESSION["login"]) && $pr->userLikeProducto()){
                                $data["like_class"]='like';
                            }else{
                                $data["like_class"]='unlike';
                            }
                            $data["contador_likes"]=$pr->getLikes();
                            $data["contador_shares"]=$pr->getShares();
                            $data["contador_comments"]=$pr->getContComentarios();
                            $data["product_card"]=$this->loadView('product','product_card',$data);
                            $product_cards.=$this->loadView('product','product_card_col-xl-2',$data);
                        }
                    }
                    $data["visitas_recientes"]=$product_cards;
                }else{
                     $data["visitas_recientes"]=$this->loadView("error", "form_error", "No hay productos vistos recientemente");
                }


                /*Mostrar productos que no has dado like (6)*/
                $data["ruleta"]="";
                if($lista_not_like=$pr->userNotLikeProducto(6)){
                    foreach($lista_not_like as $key => $producto){
                        $pr->id=$producto["id"];
                        if($pr->isActive() && $pr->isRevisado()){
                            $creador = New Users_Model();
                            $data["dg-token"]=$dg->token=$producto["design"];
                            $design=$dg->get();
                            $creador->id=$pr->creador=$design["user"]; //asignamos el id del creador
                            $infocreador=$creador->getUserFromID();
                            $data["id_producto"]=$pr->id;
                            $data["cat_id"]=$cat->id=$producto["categoria"];
                            $data["cat_nombre"]=$cat->get()["nombre"];
                            $data["username"]=$infocreador["user"];
                            $data["ruleta"].=$this->loadView("home","ruleta",$data);
                        }
                    }
                }else{
                    $data["ruleta"]="¡Eres un ansias! ¡Ya le has dado like a todos los productos!";
                }

                /*HOME CATEGORIAS*/
                $data["home_categorias"]=$this->loadView("home","home_categorias", $data);


                $data["custom_js"]=$this->minifyJs("home", "home");
                $this->render('home', 'home', $data);
            }

        }
    }
?>
