<?php
    require_once 'app/core/controller.php';

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
                    $creador = New Users_Model;

                    @$node=$_GET["node"];
                    switch($node){
                        case 'revisar':
                            $p->id=$_POST["id"];
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
                                    $data["id"]=$producto["id"];
                                    $data["fecha"]=$producto["fecha_publicacion"];
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

                                    if($producto["revisado"]==1){$data["trclass"]="success";}
                                    else{$data["trclass"]="";}
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
                                    $data["fecha"]=$producto["fecha_publicacion"];
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

                                    if($producto["revisado"]==1){$data["trclass"]="success";}
                                    else{$data["trclass"]="";}
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
                                    $data["fecha"]=$producto["fecha_publicacion"];
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

                                    if($producto["revisado"]==1){$data["trclass"]="success";}
                                    else{$data["trclass"]="";}
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
                                    $data["id"]=$c->valor_id=$_GET["id"];
                                    $valor=$c->getValor();
                                    $c->atributo=$valor["atributo"];
                                    $data["tipo_attr"]=$c->tipo_attr=$c->getAtributo()["tipo"];
                                    $data["valor"]=$valor["valor"];
                                    $data["codigo"]=$valor["codigo"];
                                    $data["precio_base"]=$valor["precio_base"];
                                    $data["beneficio"]=$valor["beneficio"];
                                    $this->render('admin','categorias/atributos_edit',$data);
                                break;
                                case 'save':
                                    $c->valor_id=$_POST["id"];
                                    $c->valor=$_POST["valor"];
                                    $c->codigo=$_POST["codigo"];
                                    $c->precio_base=$_POST["precio_base"];
                                    $c->beneficio=$_POST["beneficio"];
                                    $c->updateValor();
                                    header("Location:".$_SERVER['HTTP_REFERER']);
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
                                    $data["id"]=$c->id=$_GET["id"];
                                    $categoria=$c->get();
                                    $data["cat_nombre"]=$categoria["nombre"];
                                    $data["cat_descripcion"]=$categoria["descripcion"];
                                    $data["cat_descripcion_corta"]=$categoria["descripcion_corta"];
                                    $data["cat_precio_base"]=$categoria["precio_base"];
                                    $data["cat_beneficio"]=$categoria["beneficio"];

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
                                                $data["valor_precio_base"]=$valor["precio_base"];
                                                $data["valor_beneficio"]=$valor["beneficio"];
                                                $data["valor_precio_total"]=$valor["beneficio"]+$valor["precio_base"];
                                                $data["valores"].=$this->loadView("admin","categorias/atributos_row",$data);
                                            }
                                            $data["atributos"].=$this->loadView("admin","categorias/atributos",$data);
                                        }
                                    }

                                    $c->parent=$c->id;
                                    $data["subcategorias"]="";
                                    if($lista_subcategorias=$c->getChilds('all')){
                                        $data["datos_subcategorias"]="";
                                        foreach($lista_subcategorias as $subcategoria){
                                            if($subcategoria["visible"]==1){$data["trclass"]="success";}
                                            else{$data["trclass"]="danger";}
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
                                    $this->render('admin','categorias/categorias_edit',$data);
                                break;

                                default:
                                    $data["mensaje"]="";
                                    if($action=='save'){
                                        $c->nombre=$_POST["nombre"];
                                        $c->descripcion=$_POST["descripcion"];
                                        $c->descripcion_corta=$_POST["descripcion_corta"];
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
                                    }elseif($action=='delete'){
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

                        case 'productos':
                            $this->loadModel('producto');
                            $p = New Producto_Model;
                            $this->loadModel('categoria');
                            $c = New Categoria_Model;
                            $this->loadModel('user');
                            $u = New Users_Model;
                            @$action=$_GET["action"];

                            $data["mensaje"]=$data["datos_productos"]="";
                            switch($action){
                                case 'revisar':
                                    $p->id=$_GET["id"];
                                    if($p->revisar()){
                                        $data["mensaje"]=$this->loadView('success','form_success','Producto revisado correctamente');
                                    }
                                break;

                                case 'delete':
                                    $data["id"]=$p->id=$_GET["id"];
                                    if($p->delete()){
                                        $data["mensaje"]=$this->loadView('success','form_success','Producto borrado correctamente');
                                    }else{
                                        $data["mensaje"]=$this->loadView('error','form_error','Error al borrar el producto');
                                    }
                                break;
                            }

                            if($lista_productos=$p->getProductos()){

                                foreach ($lista_productos as $producto){
                                    $c->id=$producto["categoria"];
                                    $categoria=$c->get()["nombre"];
                                    $p->id=$producto["id"];

                                    $u->id=$producto["user"];
                                    $creador=$u->getUserFromID()["user"];

                                    $data["datos_productos"].="
                                        <tr>
                                            <td>".$producto['id']."</td>
                                            <td>".$producto['nombre']."</td>
                                            <td>".str_replace('.',',',$producto['beneficio'])."€</td>
                                            <td>".$producto['ventas']."</td>
                                            <td>".$categoria."</td>
                                            <td>".$creador."</td>
                                            <td>".$producto['visitas']."</td>
                                            <td>".$p->getLikes()."</td>
                                            <td>".$producto['shares']."</td>
                                            <td>".$producto['fecha_publicacion']."</td>
                                            <td><a href='/simbiosis/productos?action=revisar&id=".$producto['id']."'>Revisar</a></td>
                                            <td><a href='/simbiosis/productos?action=delete&id=".$producto['id']."'>Eliminar</a></td>
                                        </tr>
                                    ";
                                }
                            }else{
                                $data["datos_productos"]="</table>No hay productos";
                            }
                            $this->render('admin','productos',$data);
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
                            $this->render('admin','index');
                    }
                }else{
                    $_GET["section"]='home';
                    $this->render('error', '404');
                }
            }else{
                $_GET["section"]='home';
                $this->render('error', '404');
            }
        }

    }
?>
