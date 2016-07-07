<?php
    include_once 'app/core/controller.php';

    class Home extends Controller{

        function index_home(){
            $data['page_title'] = "Inicio";
            $this->loadModel("producto");
            $pr = New Producto_Model();
            $this->loadModel("design");
            $dg = New Design_Model();
            $this->loadModel("categoria");
            $cat = New Categoria_Model();
            if(isset($_SESSION["login"])){
                $pr->user=$this->u->id;//asignamos el id del usuario de sesion
            }else{
                $pr->user=0;
            }
            $lista_productos=$product_cards="";
            if(!empty($_GET)){
                if(isset($_GET["categoria"])){
                    $cat->nombre=$_GET["categoria"];
                    $pr->categoria=$cat->getWhereNombre()["id"];
                    $lista_productos=$pr->getProductosCategoria(20);
                    $data["subhead"]="CATEGORIA: ".strtoupper($cat->nombre);
                }elseif(isset($_GET["tag"])){
                    $pr->tag=urldecode($_GET["tag"]);
                    $lista_productos=$pr->getProductosTag(20);
                    $data["subhead"]="ETIQUETA: ".str_replace("-"," ",$pr->tag);
                }else{
                    $lista_productos=$pr->getProductos(20);
                }
                if(!empty($lista_productos)){
                    foreach($lista_productos as $producto){
                        $data["id_producto"]=$pr->id=$producto["id"];
                        if($pr->isActive() && $pr->isRevisado()){
                            $creador = New Users_Model();
                            $data["dg-token"]=$dg->token=$producto["design"];
                            $design=$dg->get();
                            $creador->id=$pr->creador=$design["user"]; //asignamos el id del creador
                            $infocreador=$creador->getUserFromID();
                            $data["cat_id"]=$cat->id=$producto["categoria"];
                            $data["cat_nombre"]=$cat->get()["nombre"];
                            $creador->user=$data["username"]=$infocreador["user"];
                            $data["avatar"]=$creador->getAvatar();
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
                            $product_cards.=$this->loadView('product','product_card_col',$data);
                        }
                    }
                    $data["last_uploads"]=$product_cards;
                }else{
                    $data["last_uploads"]=$this->loadView("error", "form_error", "No hay productos en esta sección");
                }
                $this->render('home', 'index_productos', $data);
            }else{
                if(!$this->u->getUser_activeaccount() && $this->u->vecesLogueado()==1){
                    $data["primer_login"]=$this->loadView("success","form_success","¡Bienvenido/a! Te hemos enviado un email para poder activar tu cuenta y así acceder a todas las opciones que te ofrece ".PAGE_NAME.". Si no ves el mensaje revisa la bandeja de spam o correo no deseado, puede que haya terminado ahí por error.");
                }

                //Los últimos productos
                $data["carousel_item"]="";
                if($lista_ultimos_productos=$pr->getUltimosProductos(8)){
                    foreach ($lista_ultimos_productos as $producto){
                        $pr->id=$producto["id"];
                        $creador = New Users_Model();
                        $data["dg-token"]=$dg->token=$producto["design"];
                        $design=$dg->get();
                        $creador->id=$pr->creador=$design["user"]; //asignamos el id del creador
                        $infocreador=$creador->getUserFromID();
                        $data["id_producto"]=$pr->id;
                        $data["cat_id"]=$cat->id=$producto["categoria"];
                        $data["cat_nombre"]=$cat->get()["nombre"];
                        $data["username"]=$creador->user=$infocreador["user"];
                        $data["avatar"]=$creador->getAvatar();
                        $data["dg-descripcion"]=$this->cutText($producto["descripcion"],60);
                        $data["dg-nombre"]=$producto["nombre"];
                        if(isset($_SESSION["login"]) && $pr->userLikeProducto()){
                            $data["like_class"]='like';
                        }else{
                            $data["like_class"]='unlike';
                        }
                        $data["contador_likes"]=$pr->getLikes();
                        $data["contador_shares"]=$pr->getShares();
                        $data["contador_comments"]=$pr->getContComentarios();
                        $data["product_card"]=$this->loadView("product","product_card", $data);
                        $data["carousel_item"].=$this->loadView("carousel","carousel_item", $data);
                    }
                    $data["ultimos_productos"]=$this->loadView("carousel","home_carousel8",$data);
                }else{
                    $data["ultimos_productos"]=$this->loadView("error", "form_error", "No hay últimos productos");
                }
                //Los más vendidos
                $data["carousel_item"]="";
                if($lista_mas_vendidos=$pr->getMasVendidos(8)){
                    foreach ($lista_mas_vendidos as $producto){
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
                            $data["avatar"]=$creador->getAvatar();
                            $data["dg-descripcion"]=$this->cutText($producto["descripcion"],60);
                            $data["dg-nombre"]=$producto["nombre"];
                            if(isset($_SESSION["login"]) && $pr->userLikeProducto()){
                                $data["like_class"]='like';
                            }else{
                                $data["like_class"]='unlike';
                            }
                            $data["contador_likes"]=$pr->getLikes();
                            $data["contador_shares"]=$pr->getShares();
                            $data["contador_comments"]=$pr->getContComentarios();
                            $data["product_card"]=$this->loadView("product","product_card", $data);
                            $data["carousel_item"].=$this->loadView("carousel","carousel_item", $data);
                        }
                    }
                    $data["mas_vendidos"]=$this->loadView("carousel","home_carousel8",$data);
                }else{
                     $data["mas_vendidos"]="";
                }

                /*LOS MÁS POPULARES*/
                $data["carousel_item"]="";
                if($lista_mas_likes=$pr->getMasLikes(8)){
                    foreach ($lista_mas_likes as $producto){
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
                            $data["avatar"]=$creador->getAvatar();
                            $data["dg-descripcion"]=$this->cutText($producto["descripcion"],60);
                            $data["dg-nombre"]=$producto["nombre"];
                            if(isset($_SESSION["login"]) && $pr->userLikeProducto()){
                                $data["like_class"]='like';
                            }else{
                                $data["like_class"]='unlike';
                            }
                            $data["contador_likes"]=$pr->getLikes();
                            $data["contador_shares"]=$pr->getShares();
                            $data["contador_comments"]=$pr->getContComentarios();
                            $data["product_card"]=$this->loadView("product","product_card", $data);
                            $data["carousel_item"].=$this->loadView("carousel","carousel_item", $data);
                        }
                    }
                    $data["mas_populares"]=$this->loadView("carousel","home_carousel8",$data);
                }else{
                     $data["mas_populares"]=$this->loadView("error", "form_error", "No hay productos con likes");
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
                $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/home/home.js'></script>";
                $this->render('home', 'home', $data);
            }

        }
    }
?>
