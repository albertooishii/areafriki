<?php
    class Home extends Controller{

        function index_home(){
            $this->loadModel("producto");
            $p = New Producto_Model();
            $this->loadModel("design");
            $dg = New Design_Model();
            $this->loadModel("categoria");
            $cat = New Categoria_Model();
            $this->loadModel("tag");
            $t = New Tag_Model();
            $this->loadModel("precio");
            $pr = New Precio_Model();
            $creador = New Users_Model();
            $this->loadModel("blog");
            $blog = New Blog_Model();
            if(isset($_SESSION["login"])){
                $p->user=$this->u->id;//asignamos el id del usuario de sesion
            }else{
                $p->user=0;
            }
            $lista_productos=$product_cards="";

            if(!empty($_GET["search"])){
                $items=30;
                if(isset($_GET["page"])){
                    $data["curpage"]=$page=$_GET["page"];
                }else{
                    $data["curpage"]=$page=1;
                }
                if(isset($_GET["orderby"])){
                    $data["order"]=$_GET["orderby"];
                }else{
                    $data["order"]=false;
                }
                
                $cat->nombre=$creador->user=$p->search=trim(str_replace("-"," ",urldecode($_GET["search"])));
                
                if($info_categoria=$cat->getWhereNombre()){ //Primero comprobamos si es una categoria
                    $t->categoria=$p->categoria=$info_categoria["id"];
                    $data["nombre"]=$info_categoria["nombre"];
                    $data["descripcion_corta"]=$nombre_categoria=$info_categoria["descripcion_corta"];
                    $data["descripcion"]=$info_categoria["descripcion"];
                    $data["sourcepage"]=PAGE_DOMAIN."/".$info_categoria["nombre"];
                    $limit1=$items*($page-1);
                    $totalitems=$p->countProductosCategoria();
                    $data["totalpages"]=$totalpages=ceil($totalitems/$items);
                    $lista_productos=$p->getProductosCategoria($limit1.", ".$items, $data["order"]);
                    $data["subhead"]=$nombre_categoria;
                    $data["subtitle"]=$data["descripcion"];
                    if($popular_tags=$t->getPopularTagsFromCategoria(6)){
                        $data["lista_tags_populares"]='';
                        foreach($popular_tags as $tag_popular){
                            $data["lista_tags_populares"].=" ".str_replace("-"," ",$tag_popular["tag"]). ",";
                        }
                        $data["lista_tags_populares"]=trim($data["lista_tags_populares"],',')."...";
                    }else{
                        $data["lista_tags_populares"]="";
                    }
                    $data['page_title'] = "Tienda friki de ".$nombre_categoria;
                    $data["meta_tags"]=$this->loadView("meta","meta-categoria",$data);
                }elseif($info_creador=$creador->getUser()){ //Comprobamos si es un usuario
                    Header("Location: ".PAGE_DOMAIN."/user/".$creador->user2URL($info_creador["user"]));
                }else{
                    $data["search"]=$p->search;
                    $data["sourcepage"]=PAGE_DOMAIN."/".$_GET["search"];
                    $limit1=$items*($page-1);
                    $totalitems=$p->countProductosSearch();
                    $data["totalpages"]=$totalpages=ceil($totalitems/$items);
                    $lista_productos=$p->search($limit1.", ".$items, $data["order"]);
                    $data['page_title'] = $data["subhead"] = "Resultados de búsqueda de ".$data["search"];
                    $data["subtitle"]="Total de productos encontrados: $totalitems"; 

                    $data["meta_tags"]=$this->loadView("meta","meta-search",$data);
                }
                if(!empty($lista_productos)){
                    foreach($lista_productos as $producto){
                        $data["id_producto"]=$pr->producto=$p->id=$producto["id"];
                        $creador = New Users_Model();
                        $data["dg-token"]=$dg->token=$producto["design"];
                        $design=$dg->get();
                        $creador->id=$p->creador=$design["user"]; //asignamos el id del creador
                        $infocreador=$creador->getUserFromID();
                        $data["cat_id"]=$pr->categoria=$cat->id=$producto["categoria"];
                        $categoria=$cat->get();
                        $data["cat_nombre"]=$categoria["nombre"];
                        $creador->user=$data["username"]=$infocreador["user"];
                        $data["creador_avatar"]=$creador->getAvatar(64);
                        $data["precio"]=number_format($pr->get(),2,',','')."€";
                        //Añadimos al título del producto la categoría en singular si es diseño y no está ya incluida en el título
                        if($categoria["parent"]==1 && strpos(strtolower($producto["nombre"]), strtolower(substr($data["cat_nombre"], 0, -1)))!==0){
                            $data["dg-nombre"]=ucwords(substr($data["cat_nombre"], 0, -1)." ".$producto["nombre"]);
                        }else{
                            $data["dg-nombre"]=$producto["nombre"];
                        }

                        if($p->userLikeProducto()){
                            $data["like_class"]='like';
                        }else{
                            $data["like_class"]='unlike';
                        }
                        $data["contador_likes"]=$p->getLikes();
                        $data["contador_shares"]=$p->getShares();
                        $data["contador_comments"]=0;
                        $data["product_card"]=$this->loadView('product','product_card',$data);
                        $product_cards.=$this->loadView('product','product_card_col-xl-4',$data);
                    }
                    $data["last_uploads"]=$product_cards;
                    $data["pagination"]=$this->loadView("product", "pagination", $data);
                }else{
                    $data["subtitle"]="<p class='alert text-danger'>No se han encontrado productos que coincidan con esta búsqueda.</p>";
                    $data["last_uploads"]="";
                    $data["pagination"]="";
                }
                $data["tag_list"]="";
                if($lista_tags=$t->getPopularTags(20)) {
                    foreach($lista_tags as $tag){
                        $data["nombre_tag"]=$tag["tag"];
                        $data["tag_list"].=$this->loadView("product","tag_list",$data);
                    }
                }
                $data["custom_js"]=$this->minifyJs("home", "index_productos");
                $data["custom_css"] = $this->minifyCss('product', 'product_card');
                $data["secondary-navbar"]=$this->loadView("home","secondary-navbar",$data);
                $this->render('home', 'index_productos', $data);
            }else{
                /*LOS MÁS POPULARES*/
                $data["carousel_item"]="";
                if($lista_mas_populares=$p->getOnFire(8)){
                    foreach ($lista_mas_populares as $producto){
                        $p->id=$producto["id"];
                        if($p->isActive() && $p->isRevisado()){
                            $data["dg-token"]=$dg->token=$producto["design"];
                            $design=$dg->get();
                            $creador->id=$p->creador=$design["user"]; //asignamos el id del creador
                            $infocreador=$creador->getUserFromID();
                            $data["id_producto"]=$pr->producto=$p->id;
                            $data["cat_id"]=$pr->categoria=$cat->id=$producto["categoria"];
                            $categoria=$cat->get();
                            $data["cat_nombre"]=$categoria["nombre"];
                            $data["username"]=$creador->user=$infocreador["user"];
                            $data["creador_avatar"]=$creador->getAvatar(64);
                            $data["precio"]=number_format($pr->get(),2,',','')."€";
                            //Añadimos al título del producto la categoría en singular si es diseño y no está ya incluida en el título
                            if($categoria["parent"]==1 && strpos(strtolower($producto["nombre"]), strtolower(substr($data["cat_nombre"], 0, -1)))!==0){
                                $data["dg-nombre"]=ucwords(substr($data["cat_nombre"], 0, -1)." ".$producto["nombre"]);
                            }else{
                                $data["dg-nombre"]=$producto["nombre"];
                            }
                            if(isset($_SESSION["login"]) && $p->userLikeProducto()){
                                $data["like_class"]='like';
                            }else{
                                $data["like_class"]='unlike';
                            }
                            $data["contador_likes"]=$p->getLikes();
                            $data["contador_shares"]=$p->getShares();
                            $data["contador_comments"]=$p->getContComentarios();
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
                $p->user=$this->u->id;
                if($lista_ultimos_vistos=$p->getLastViewsUser(6)){
                    foreach ($lista_ultimos_vistos as $producto){
                        $p->id=$producto["id"];
                        if($p->isActive() && $p->isRevisado()){
                            $creador = New Users_Model();
                            $data["dg-token"]=$dg->token=$producto["design"];
                            $design=$dg->get();
                            $creador->id=$p->creador=$design["user"]; //asignamos el id del creador
                            $infocreador=$creador->getUserFromID();
                            $data["id_producto"]=$pr->producto=$p->id;
                            $data["cat_id"]=$pr->categoria=$cat->id=$producto["categoria"];
                            $categoria=$cat->get();
                            $data["cat_nombre"]=$categoria["nombre"];
                            $data["username"]=$creador->user=$infocreador["user"];
                            $data["creador_avatar"]=$creador->getAvatar(64);
                            $data["precio"]=number_format($pr->get(),2,',','')."€";
                            //Añadimos al título del producto la categoría en singular si es diseño y no está ya incluida en el título
                            if($categoria["parent"]==1 && strpos(strtolower($producto["nombre"]), strtolower(substr($data["cat_nombre"], 0, -1)))!==0){
                                $data["dg-nombre"]=ucwords(substr($data["cat_nombre"], 0, -1)." ".$producto["nombre"]);
                            }else{
                                $data["dg-nombre"]=$producto["nombre"];
                            }
                            if(isset($_SESSION["login"]) && $p->userLikeProducto()){
                                $data["like_class"]='like';
                            }else{
                                $data["like_class"]='unlike';
                            }
                            $data["contador_likes"]=$p->getLikes();
                            $data["contador_shares"]=$p->getShares();
                            $data["contador_comments"]=$p->getContComentarios();
                            $data["product_card"]=$this->loadView('product','product_card',$data);
                            $product_cards.=$this->loadView('product','product_card_col-xl-2',$data);
                        }
                    }
                    $data["visitas_recientes"]=$product_cards;
                }else{
                     $data["visitas_recientes"]=$this->loadView("error", "form_error", "Aquí aparecerán los productos que vayas visitando");
                }


                /*Mostrar productos que no has dado like (6)*/
                $data["ruleta"]="";
                if($lista_not_like=$p->userNotLikeProducto(6)){
                    foreach($lista_not_like as $key => $producto){
                        $p->id=$producto["id"];
                        if($p->isActive() && $p->isRevisado()){
                            $creador = New Users_Model();
                            $data["dg-token"]=$dg->token=$producto["design"];
                            $design=$dg->get();
                            $creador->id=$p->creador=$design["user"]; //asignamos el id del creador
                            $infocreador=$creador->getUserFromID();
                            $data["id_producto"]=$p->id;
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

                /*HOME POSTS*/
                $blog->getPosts();
                $data['home_posts'] = '';
                foreach ($blog->posts as $post) {
                    $post['date'] = $this->format_date($post['date']);
                    $creador->user = $post['author_user'];
                    $post['author_avatar'] = $creador->getAvatar(64);
                    $data["home_posts"].=$this->loadView("home", "home_posts", $post);
                }

                $data['page_title'] = "Tienda friki de camisetas, manualidades y segunda mano.";
                $data["custom_js"]=$this->minifyJs("home", "home");
                $data["custom_css"] = $this->minifyCss('product', 'product_card');
                $data["secondary-navbar"]=$this->loadView("home","secondary-navbar",$data);
                $this->render('home', 'home', $data);
            }

        }
    }
?>
