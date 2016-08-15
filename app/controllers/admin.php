<?php
    class Admin extends Controller{

        function index_admins(){
            if(isset($_SESSION["login"])){
                if($this->u->isAdmin()){
                    $data['page_title'] = "Panel de Administración";

                    $this->loadModel('producto');
                    $p = New Producto_Model;
                    $this->loadModel('categoria');
                    $c = New Categoria_Model;
                    $this->loadModel('design');
                    $dg = New Design_Model;
                    $this->loadModel('precio');
                    $pre = New Precio_Model;
                    $creador = New Users_Model;

                    @$node=$_GET["node"];
                    switch($node){
                        case 'revisar':
                            $p->id=$_POST["id"];
                            if(!$p->isRevisado()){
                                if($p->revisar()){
                                    $producto=$p->get();
                                    $data["token"]=$dg->token=$producto["design"];
                                    $design=$dg->get();
                                    $creador->id=$design["user"];
                                    $designer=$creador->getUserFromID();
                                    $data["user"]=$designer["user"];
                                    $data["nombre"]=$producto["nombre"];
                                    $c->id=$producto["categoria"];
                                    $data["categoria"]=$c->get()["nombre"];

                                    $this->loadModel("email");
                                    /*PREPARAMOS EMAIL PARA EL PUBLICADOR*/
                                    $mail = new Email();
                                    $mail->to = $designer["email"];
                                    $mail->subject = "Producto aprobado - ".PAGE_NAME;
                                    $mail->getEmail('producto_aprobado', $data);

                                    if ($mail->sendEmail()){
                                        echo true;
                                    }else{
                                       echo "Se ha publicado un producto pero no se ha podido enviar la notificación por email";
                                    }
                                }else{
                                    echo false;
                                }
                            }else{
                                echo true;
                            }
                        break;

                        case 'denegar':
                            $p->id=$_POST["id"];
                            $data["nota"]=$_POST["nota"];
                            $producto=$p->get();
                            $data["token"]=$dg->token=$producto["design"];
                            $design=$dg->get();
                            $creador->id=$design["user"];
                            $data["token"]=$producto["design"];
                            $designer=$creador->getUserFromID();
                            $data["user"]=$designer["user"];
                            $data["nombre"]=$producto["nombre"];
                            $c->id=$producto["categoria"];
                            $data["categoria"]=$c->get()["nombre"];
                            $source="designs/".$data["user"]."/".$data["token"]."/".$data["categoria"];
                            $this->rmrf($source);

                            $this->loadModel("email");
                            /*PREPARAMOS EMAIL PARA EL PUBLICADOR*/
                            $mail = new Email();
                            $mail->to = $designer["email"];
                            $mail->subject = "Producto denegado - ".PAGE_NAME;
                            $mail->getEmail('producto_denegado', $data);

                            if ($mail->sendEmail() && $p->delete()){
                                echo true;
                            }else{
                               echo "Se ha eliminado el producto pero ha fallado al notificar por email a su creador";
                            }
                        break;

                        case 'designs':
                            $data["tbody"]="";
                            $p->category_parent=1;
                            if($lista_productos=$p->getProductos()){
                                foreach($lista_productos as $producto){
                                    $data["id"]=$pre->producto=$producto["id"];
                                    $data["fecha"]=$this->format_date($producto["fecha_publicacion"]);
                                    $data["token"]=$dg->token=$producto["design"];
                                    $design=$dg->get();
                                    $p->categoria=$c->id=$producto["categoria"];
                                    $creador->id=$design["user"];
                                    $infocreador=$creador->getUserFromID();
                                    $data["username"]=$infocreador["user"];
                                    $data["email"]=$infocreador["email"];
                                    $categoria=$c->get();
                                    $data["categoria"]=$categoria["nombre"];
                                    $data["nombre"]=$producto["nombre"];
                                    $data["descripcion"]=$producto["descripcion"];
                                    if(!empty($producto["beneficio"])){
                                        $data["beneficio"]=number_format($pre->getBeneficio(), 2, ',', ' ')."€";
                                    }else{
                                        $data["beneficio"]="";
                                        $orden=0;
                                        $sizes=$p->getSizes();
                                        foreach($sizes as $size){
                                            $orden++;
                                            $data["beneficio"].=$size["valor"].": ".number_format($pre->getBeneficio($orden), 2, ',', ' ')."€<br>";
                                        }
                                    }

                                    if($producto["revisado"]==1){
                                        $data["trclass"]="success";
                                    }
                                    else{
                                        $data["trclass"]="";
                                    }
                                    $source_folder="designs/".$data["username"]."/".$data["token"]."/".$data["categoria"];

                                    $data["file"]=glob($source_folder."/ORIGINAL-".$data["token"]."*")[0];

                                    $data["tbody"].=$this->loadView("admin/productos","designs_row",$data);
                                }
                            }
                            $this->render("admin/productos/","designs",$data);
                        break;

                        case 'crafts':
                            $data["tbody"]="";
                            $p->category_parent=2;
                            if($lista_productos=$p->getProductos()){
                                foreach($lista_productos as $producto){
                                    $data["id"]=$producto["id"];
                                    $data["fecha"]=$this->format_date($producto["fecha_publicacion"]);
                                    $data["token"]=$dg->token=$producto["design"];
                                    $design=$dg->get();
                                    $c->id=$producto["categoria"];
                                    $creador->id=$design["user"];
                                    $infocreador=$creador->getUserFromID();
                                    $data["username"]=$infocreador["user"];
                                    $data["email"]=$infocreador["email"];
                                    $data["categoria"]=$c->get()["nombre"];
                                    $data["nombre"]=$producto["nombre"];
                                    $data["descripcion"]=$producto["descripcion"];
                                    $data["beneficio"]=$producto["beneficio"];

                                    if($producto["revisado"]==1){
                                        $data["trclass"]="success";
                                    }
                                    else{
                                        $data["trclass"]="";
                                    }
                                    $source_folder="designs/".$data["username"]."/".$data["token"]."/".$data["categoria"];

                                    $data["tbody"].=$this->loadView("admin/productos","crafts_row",$data);
                                }
                            }
                            $this->render("admin/productos/","crafts",$data);
                        break;

                         case 'baul':
                            $data["tbody"]="";
                            $p->category_parent=30;
                            if($lista_productos=$p->getProductos()){
                                foreach($lista_productos as $producto){
                                    $data["id"]=$producto["id"];
                                    $data["fecha"]=$this->format_date($producto["fecha_publicacion"]);
                                    $data["token"]=$dg->token=$producto["design"];
                                    $design=$dg->get();
                                    $c->id=$producto["categoria"];
                                    $creador->id=$design["user"];
                                    $infocreador=$creador->getUserFromID();
                                    $data["username"]=$infocreador["user"];
                                    $data["email"]=$infocreador["email"];
                                    $data["categoria"]=$c->get()["nombre"];
                                    $data["nombre"]=$producto["nombre"];
                                    $data["descripcion"]=$producto["descripcion"];
                                    $data["beneficio"]=$producto["beneficio"];

                                    if($producto["revisado"]==1){
                                        $data["trclass"]="success";
                                    }
                                    else{
                                        $data["trclass"]="";
                                    }
                                    $source_folder="designs/".$data["username"]."/".$data["token"]."/".$data["categoria"];

                                    $data["tbody"].=$this->loadView("admin/productos","baul_row",$data);
                                }
                            }
                            $this->render("admin/productos/","baul",$data);
                        break;

                        case 'atributos':
                            $this->loadModel('categoria');
                            $c = New Categoria_Model;
                            $action=$_GET["action"];
                            switch($action){
                                case 'edit':
                                    $data["mensaje"]="";
                                    if(!empty($_POST)){
                                        $c->valor_id=$_POST["id"];
                                        $c->valor=$_POST["valor"];
                                        $c->codigo=$_POST["codigo"];
                                        $c->precio_base=$_POST["precio_base"];
                                        $c->beneficio=$_POST["beneficio"];
                                        if($c->updateValor()){
                                            $data["mensaje"]=$this->loadView('success','form_success','Valor modificado correctamente');
                                        }else{
                                            $data["mensaje"]=$this->loadView('error','form_error','Error al modificar el valor');
                                        }
                                    }
                                    $data["id"]=$c->valor_id=$_GET["id"];
                                    $valor=$c->getValor();
                                    $c->atributo=$valor["atributo"];
                                    $data["tipo_attr"]=$c->tipo_attr=$c->getAtributo()["tipo"];
                                    $data["valor"]=$valor["valor"];
                                    $data["codigo"]=$valor["codigo"];
                                    $data["precio_base"]=$valor["precio_base"];
                                    $data["beneficio"]=$valor["beneficio"];
                                    $data["cat_id"]=$valor["categoria"];
                                    $this->render('admin','categorias/atributos_edit',$data);
                                break;
                            }
                        break;

                        case 'categorias':
                            $this->loadModel('categoria');
                            $c = New Categoria_Model;
                            @$action=$_GET["action"];
                            switch($action){
                                case 'new':
                                    $data["id"]="";
                                    $data["nombre"]="";
                                    $data["descripcion"]="";
                                    $data["precio_base"]="";
                                    $data["precio_tope"]="";
                                    $this->render('admin','categorias/categorias_edit',$data);
                                break;

                                case 'edit':
                                    $data["mensaje"]="";
                                    if(!empty($_POST)){
                                        $c->nombre=$_POST["nombre"];
                                        $c->descripcion=$_POST["descripcion"];
                                        $c->descripcion_corta=$_POST["descripcion_corta"];
                                        if(!empty($_POST["precio_base"])){
                                            $c->precio_base=$_POST["precio_base"];
                                            $c->beneficio=$_POST["beneficio"];
                                        }
                                        if(empty($_POST["id"])){
                                            if($c->set()){
                                                $data["mensaje"]=$this->loadView('success','form_success','Categoría añadida correctamente');
                                            }else{
                                                $data["mensaje"]=$this->loadView('error','form_error','Error al añadir la categoría');
                                            }
                                        }else{
                                            $c->id=$_POST["id"];
                                            if($c->update()){
                                                $data["mensaje"]=$this->loadView('success','form_success','Categoría modificada correctamente');
                                            }else{
                                                $data["mensaje"]=$this->loadView('error','form_error','Error al modificar la categoría');
                                            }
                                        }
                                    }

                                    $data["id"]=$c->parent=$c->id=$_GET["id"];
                                    $categoria=$c->get();
                                    $data["cat_nombre"]=$categoria["nombre"];
                                    $data["cat_descripcion"]=$categoria["descripcion"];
                                    $data["cat_descripcion_corta"]=$categoria["descripcion_corta"];

                                    if(empty($c->getChilds('all'))){
                                        $data["cat_precio_base"]=$categoria["precio_base"];
                                        $data["cat_beneficio"]=$categoria["beneficio"];
                                    }

                                    $data["atributos"]="";
                                    if($lista_atributos=$c->getAtributos()){
                                        foreach($lista_atributos as $atributo){
                                            $data["atributo_id"]=$c->atributo=$atributo["id"];
                                            $data["attr_nombre"]=$atributo["nombre"];
                                            $data["attr_tipo"]=$atributo["tipo"];
                                            $lista_valores=$c->getValores();
                                            $data["valores"]="";
                                            foreach ($lista_valores as $valor){
                                                $data["valor_id"]=$valor["id"];
                                                $data["valor_valor"]=$valor["valor"];
                                                $data["valor_codigo"]=$valor["codigo"];
                                                if($atributo["tipo"]=='color'){
                                                    $data["valor_codigo"]=$this->loadView("admin","categorias/atributo_color",$data);
                                                }
                                                if((!empty($valor["precio_base"]) || $valor["precio_base"]!=0) && (!empty($valor["beneficio"]) && $valor["beneficio"]!=0)){
                                                    $data["valor_precio_base"]=$valor["precio_base"];
                                                    $data["valor_beneficio"]=$valor["beneficio"];
                                                    $data["valor_precio_total"]=$valor["beneficio"]+$valor["precio_base"];
                                                }else{
                                                    $data["valor_precio_base"]=$data["valor_beneficio"]=$data["valor_precio_total"]="-";
                                                }
                                                $data["valores"].=$this->loadView("admin","categorias/atributos_row",$data);
                                            }
                                            $data["atributos"].=$this->loadView("admin","categorias/atributos",$data);
                                        }
                                    }

                                    $data["subcategorias"]="";
                                    if($lista_subcategorias=$c->getChilds('all')){
                                        $data["datos_subcategorias"]="";
                                        foreach($lista_subcategorias as $subcategoria){
                                            if($subcategoria["visible"]==1){
                                                $data["trclass"]="success";
                                            }
                                            else{
                                                $data["trclass"]="danger";
                                            }
                                            $data["subcat_id"]=$subcategoria["id"];
                                            $data["subcat_nombre"]=$subcategoria["nombre"];
                                            $data["subcat_descripcion"]=$subcategoria["descripcion"];
                                            $data["subcat_descripcion_corta"]=$subcategoria["descripcion_corta"];

                                            $data["subcat_precio_base"] = !empty($subcategoria["precio_base"]) ? $subcategoria["precio_base"]."€" : "-";
                                            $data["subcat_beneficio"] = !empty($subcategoria["beneficio"]) ? $subcategoria["beneficio"]."€" : "-";
                                            $data["subcat_descripcion_corta"]=$subcategoria["descripcion_corta"];
                                            $data["datos_subcategorias"].=$this->loadView("admin","categorias/subcategorias_row",$data);
                                        }
                                        $data["subcategorias"]=$this->loadView("admin","categorias/subcategorias",$data);
                                    }
                                    $data["parent_id"]=$categoria["parent"];
                                    $this->render('admin','categorias/categorias_edit',$data);
                                break;

                                default:
                                    $data["mensaje"]="";
                                    if($action=='delete'){
                                        $data["id"]=$c->id=$_GET["id"];
                                        if($c->delete()){
                                            $data["mensaje"]=$this->loadView('success','form_success','Categoría borrada correctamente');
                                        }else{
                                            $data["mensaje"]=$this->loadView('error','form_error','Error al borrar la categoría');
                                        }
                                    }elseif($action=='disable'){
                                        $data["id"]=$c->id=$_GET["id"];
                                        if($c->disable()){
                                            $data["mensaje"]=$this->loadView('success','form_success','Categoría desactivada correctamente');
                                        }else{
                                            $data["mensaje"]=$this->loadView('error','form_error','Error al desactivar la categoría');
                                        }
                                    }elseif($action=='enable'){
                                        $data["id"]=$c->id=$_GET["id"];
                                        if($c->enable()){
                                            $data["mensaje"]=$this->loadView('success','form_success','Categoría activada correctamente');
                                        }else{
                                            $data["mensaje"]=$this->loadView('error','form_error','Error al activar la categoría');
                                        }
                                    }
                                    $lista_categorias=$c->getParents();
                                    $data["datos_categorias"]="";

                                    foreach ($lista_categorias as $categoria){
                                        $data["id"]=$categoria["id"];
                                        $data["nombre"]=$categoria["nombre"];
                                        $data["descripcion"]=$categoria["descripcion"];
                                        /*$data["precio_base"]=$categoria["precio_base"];
                                        $data["precio_tope"]=$categoria["precio_tope"];*/
                                        $data["descripcion_corta"]=$categoria["descripcion_corta"];
                                        $data["datos_categorias"].=$this->loadView("admin","categorias/categorias_row",$data);
                                    }
                                    $this->render('admin','categorias/categorias',$data);
                            }
                        break;

                        case 'pedidos':
                            $this->loadModel('producto');
                            $p=New Producto_Model();
                            $this->loadModel('categoria');
                            $cat=New Categoria_Model();
                            $this->loadModel('pedido');
                            $ped=New Pedido_Model();
                            $this->loadModel("design");
                            $dg=New Design_Model();
                            $this->loadModel("provincia");
                            $provincia=New Provincia_Model();
                            $vendedor=New Users_Model();
                            $comprador=New Users_Model();
                            $creador=New Users_Model();
                            $data["mensaje"]=$data["tbody"]="";
                            if(isset($_GET["token"])){
                                $ped->token=$data["token"]=$_GET["token"];
                                if($ar_pedido=$ped->get()){
                                    //Vendedor
                                    $data["id_vendedor"]=$vendedor->id=$ar_pedido["vendedor"];
                                    if($vendedor->id>0){
                                        $info_vendedor=$vendedor->getUserFromID();
                                        $data["vendedor"]=$info_vendedor["user"];
                                    }else{
                                        $data["vendedor"]=PAGE_NAME;
                                    }
                                    //Comprador
                                    $data["comprador"]=$ar_pedido["name"];
                                    if(!empty($pedido["user"])){
                                        $comprador->id=$pedido["user"];
                                        $info_comprador=$comprador->getUserFromID();
                                        $data["user"]=$info_comprador["user"];
                                    }


                                    $pedido=unserialize($ar_pedido["pedido"]);
                                    $data["token"]=$ar_pedido["token"];
                                    $data["total_preparacion_pedido"]=$data["productos_pedido"]="";
                                    $data["precio_total_pedido"]=$precio_total_pedido=$subtotal=$total_envio_pedido=0;
                                    foreach($pedido as $key => $linea){
                                        $data["linea"]=$key;
                                        $p->id=$linea["producto"];
                                        $producto=$p->get();
                                        $data["dg_token"]=$dg->token=$producto["design"];
                                        $design=$dg->get();
                                        $cat->id=$p->categoria=$producto["categoria"];
                                        $data["dg_categoria"]=$cat->get()["nombre"];
                                        $data["dg_nombre"]=$producto["nombre"];

                                        $creador->id=$design["user"];
                                        $data["dg_autor"]=$creador->getUserFromID()["user"];

                                        $data["atributos"]="";
                                        $swatributo=0;

                                        if(!empty($linea["color"])){
                                            $p->codigo=$linea["color"];
                                            $color=$p->getNombreColor();
                                            $data["atributos"].="color ".$color;
                                            $swatributo=1;
                                        }

                                        $p->modelo=$producto["modelo"];
                                        if(!empty($linea["size"])){
                                            if($swatributo==1){
                                                $data["atributos"].=", ";
                                            }
                                            if($valor=$p->getValor($linea["size"])["valor"]){
                                                $data["atributos"].="Tamaño: ".$valor;
                                            }elseif($talla=$p->getSize($linea["size"])["valor"]){
                                                $data["atributos"].="Talla: ".$talla;
                                            }else{
                                                $data["atributos"].="Talla: ".$linea["size"];
                                            }
                                        }

                                        $data["nota"]=$linea["nota"];
                                        $data["cantidad"]=$linea["cantidad"];

                                        /*PRECIO----------*/
                                        $precio=$linea["precio"];
                                        $data["precio"]=number_format($precio, 2, ',', ' ')."€";
                                        $data["total_producto"]=number_format($precio*$linea["cantidad"], 2, ',', ' ')."€";
                                        $precio_total_pedido+=$precio*$linea["cantidad"];
                                        $subtotal+=$precio*$linea["cantidad"];
                                        $data["tbody"].=$this->loadView("admin","pedidos/productos_row", $data);
                                    }

                                    $data["name"]=$ar_pedido["name"];
                                    $data["address"]=$ar_pedido["address"];
                                    $data["cp"]=$ar_pedido["cp"];
                                    $data["localidad"]=$ar_pedido["localidad"];
                                    $provincia->id=$ar_pedido["provincia"];
                                    $data["provincia"]=$provincia->getNombre();
                                    $data["phone"]=$ar_pedido["phone"];
                                    $data["nota"]=$ar_pedido["nota"];

                                    //Calculo de cancelación
                                    $temp1=strtotime(date("Y-m-d H:i:s")); //hora actual
                                    $temp2=strtotime($ar_pedido["fecha_pago"]); //hora del pago
                                    $diferencia= abs($temp1-$temp2); //abs=valor absoluto :D

                                    $horas=floor($diferencia/60/60); //floor=redondea hacia arriba :D
                                    //echo "horas transcurridas: ".$horas;

                                    $ar_estados=$ped->getEstados();

                                    $data["estado_selector"]="";
                                    $key_estado = array_search($ar_pedido["estado"], $ar_estados);
                                    foreach($ar_estados as $key => $estado){
                                            if($key >= $key_estado){ //No se puede cambiar a un estado anterior
                                                if($estado==$ar_pedido["estado"]){
                                                    $data["estado_selected"]="selected";
                                                }else{
                                                    $data["estado_selected"]="";
                                                }

                                                $data["class_estado"]=$this->classEstado($estado);
                                                $data["estado"]=$estado;
                                                $data["estado_selector"].=$this->loadView("venta","estado_selector",$data);
                                            }
                                    }

                                    $data["estado"]=$ar_pedido["estado"];
                                    $data["localizador"]=$ar_pedido["localizador"];

                                    $data["fecha_pedido"]=$this->format_date($ar_pedido["fecha_pedido"]);
                                    if(!empty($ar_pedido["fecha_pago"])){
                                        $data["fecha_pago"]=$this->format_date($ar_pedido["fecha_pago"]);
                                    }else{
                                        $data["fecha_pago"]="No realizado";
                                    }
                                    if(!empty($ar_pedido["fecha_envio"])){
                                        $data["fecha_envio"]=$this->format_date($ar_pedido["fecha_envio"]);
                                    }else{
                                        $data["fecha_envio"]="No realizado";
                                    }

                                    if(!empty($ar_pedido["fecha_completado"])){
                                        $data["fecha_completado"]=$this->format_date($ar_pedido["fecha_completado"]);
                                    }else{
                                        $data["fecha_completado"]="No realizado";
                                    }

                                    if(!empty($ar_pedido["fecha_cancelacion"])){
                                        $data["fecha_cancelacion"]=$this->format_date($ar_pedido["fecha_cancelacion"]);
                                    }else{
                                        $data["fecha_cancelacion"]="No realizado";
                                    }

                                    $data["metodo_pago"]=$ar_pedido["metodo_pago"];
                                    $data["total_preparacion_pedido"]=$ar_pedido["preparacion"];
                                    $data["tiempo_envio"]=$ar_pedido["tiempo_envio"]*24; $data["total_envio_pedido"]=number_format($ar_pedido["gastos_envio"], 2, ',', ' ')."€";
                                    $data["total_vendedor"]=number_format($ar_pedido["precio"], 2, ',', ' ')."€";
                                    $data["observaciones"]=$ar_pedido["observaciones"];
                                    $data["pedido"]=$this->loadView("venta","pedido",$data);
                                    $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/venta/venta.js'></script>";
                                    $data["lista_productos"]=$this->loadView("admin","pedidos/productos",$data);
                                    $this->render("admin","pedidos/pedidos_view",$data);
                                }else{
                                    //El pedido no existe
                                    echo "este pedido no existe";
                                }
                            }else{
                                if($lista_pedidos=$ped->getPedidos()){
                                    $data["listado_pedidos"]="";
                                    foreach($lista_pedidos as $pedido){
                                        $data["id"]=$pedido["id"];
                                        $data["token"]=$pedido["token"];
                                        //comprador
                                        $data["comprador"]=$pedido["name"];
                                        if(!empty($pedido["user"])){
                                            $comprador->id=$pedido["user"];
                                            $info_comprador=$comprador->getUserFromID();
                                            $data["user"]=$info_comprador["user"];
                                        }

                                        //vendedor
                                        $data["vendedor_id"]=$pedido["vendedor"];
                                        if($pedido["vendedor"]!=0){
                                            $vendedor->id=$pedido["vendedor"];
                                            $info_vendedor=$vendedor->getUserFromID();
                                            $data["vendedor"]=$info_vendedor["user"];
                                        }else{
                                            $data["vendedor"]=PAGE_NAME;
                                        }

                                        $data["fecha_pedido"]=$this->format_date($pedido["fecha_pedido"]);
                                        $data["estado"]=$pedido["estado"];
                                        $data["class_estado"]=$this->classEstado($data["estado"]);
                                        $data["precio"]=number_format($pedido["precio"], 2, ',', ' ')."€";
                                        $data["gastos_envio"]=number_format($pedido["gastos_envio"], 2, ',', ' ')."€";
                                        $data["nota"]=$pedido["nota"];
                                        $data["observaciones"]=$pedido["observaciones"];
                                        $data["localizador"]=$pedido["localizador"];

                                        $data["listado_pedidos"].=$this->loadView("admin", "pedidos/pedidos_row",$data);
                                    }
                                    $this->render('admin','pedidos/pedidos',$data);
                                }
                            }
                        break;

                        case 'tags':
                            $this->loadModel('tags');
                            $t = New Tag_Model;
                            @$action=$_GET["action"];
                            switch($action){
                                case '':

                                break;

                                default:
                            }
                        break;

                        default:
                            $data["count_productos"]=$p->countProductos();
                            $data["count_newproductos"]=$p->countNoRevisados();
                            $data["count_users"]=$creador->countUsers();
                            $data["count_newusers"]=$creador->countNewUsers();
                            $this->render('admin','index',$data);
                    }
                }else{
                    $_GET["section"]='home';
                    $this->render('error', '404');
                }
            }else{
                header('Location: '.PAGE_DOMAIN.'/login?redirect='.$this->getURL());
            }
        }

        function classEstado($estado){
            switch($estado){
                case 'pendiente': return "default"; break;
                case 'pagado': return "primary"; break;
                case 'procesado': return "warning"; break;
                case 'enviado': return "info"; break;
                case 'completado': return "success"; break;
                case 'cancelado': return "danger"; break;
            }
        }

    }
?>
