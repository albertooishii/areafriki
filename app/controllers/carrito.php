<?php
    class Carrito extends Controller{

        function index_carrito(){
            $data["page_title"]="Carrito";
            $this->loadModel('carrito');
            $car=New Carrito_Model();
            $this->loadModel('producto');
            $p=New Producto_Model();
            $this->loadModel('precio');
            $pr=New Precio_Model();
            $this->loadModel('categoria');
            $cat=New Categoria_Model();
            $car->user=$this->u->id;
            @$action=$_GET["action"];
            switch($action){

                case 'add':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                        $car->linea = array(
                            "producto"    => $_POST["id"],
                            "cantidad" => $_POST["cantidad"],
                            "size" => $_POST["size"],
                            "color" => $_POST["color"]
                        );
                        if($car->add()){
                            return true;
                        }else{
                            return false;
                        }
                    }
                break;

                case 'remove':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $car->linea=$_POST["linea"];
                        if($car->removeLinea()){
                            echo true;
                        }else{
                            echo false;
                        }
                    }
                break;

                case 'edit':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                        if(isset($_POST["cantidad"])){
                            $car->linea=$_POST["linea"];
                            $car->cantidad=$_POST["cantidad"];
                            $car->editCantidad();
                        }
                    }
                break;

                case 'checkout':
                    if($carrito=$car->get()){
                        $this->loadModel("provincia");
                        $provincia = New Provincia_Model();
                        $user=$this->u->getUser();
                        $data["nombre"]=$user["name"];
                        $data["direccion"]=$user["address"];
                        $data["cp"]=$user["cp"];
                        $data["localidad"]=$user["localidad"];
                        $data["phone"]=$user["phone"];
                        $data["lista_provincias"]=$selected="";
                        $provincias=$provincia->get();
                        $data["provincia_selected"]=$user["provincia"];
                        $data["provincia"]=$this->loadView("forms","provincia",$data);

                        $pr->pedido=unserialize($carrito["pedido"]);
                        $subtotal=$pr->getPrecioPedido();
                        $data["subtotal"]=number_format($subtotal, 2, ',', ' ');
                        $data["envio"]="3,50";
                        $data["precio_total"]=number_format($subtotal, 2, ',', ' ');
                        $data["form-pago"]=$this->loadView("forms","pago",$data);
                        $this->render("carrito","checkout",$data);
                    }
                break;

                case 'resumen_pedido':
                    echo "hola";
                break;

                case 'pago':
                    if(isset($_POST["pay_method"])){
                        $method=$_POST["pay_method"];
                        $carrito=$car->get();
                        $pr->pedido=unserialize($carrito["pedido"]);
                        $data["precio"]=$subtotal=$pr->getPrecioPedido();
                        $data["token"]=$carrito["token"];        $data["enc_token"]=md5(GLOBAL_TOKEN.$carrito["token"]);
                        switch($method){
                            case 'transferencia':
                                $this->render("pago","transferencia/transferencia",$data);
                            break;

                            case 'paypal':
                                $this->render("pago","paypal/paypal",$data);
                            break;
                        }
                    }else{
                        $this->render("error","404",$data);
                    }
                break;

                default:

                    if($carrito=$car->get()){
                        $this->loadModel('design');
                        $dg=New Design_Model();
                        $this->loadModel('user');
                        $creador=New Users_Model();

                        $pedido=unserialize($carrito["pedido"]);
                        $data["lista_productos"]=$precio_total="";
                        $contador=0;
                        foreach($pedido as $linea){
                            $pr->producto=$p->id=$linea["producto"];
                            $producto=$p->get();
                            $data["dg_token"]=$dg->token=$producto["design"];
                            $design=$dg->get();
                            $cat->id=$pr->categoria=$p->categoria=$producto["categoria"];
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

                            if(!empty($linea["size"])){
                                if($swatributo==1){
                                    $data["atributos"].=", ";
                                }
                                $data["atributos"].="tamaño ".$linea["size"];
                            }

                            $data["cantidad"]=$linea["cantidad"];

                            $pr->codigo=$linea["size"];
                            $pr->modelo="";
                            if(!empty($producto["modelo"])){
                                $pr->modelo=$producto["modelo"];
                            }

                            $precio=$pr->get();
                            $data["precio"]=number_format($precio, 2, ',', ' ')."€";
                            $precio_total+=$precio*$linea["cantidad"];

                            $data["linea"]=$contador;
                            $contador++;
                            $data["lista_productos"].=$this->loadView("carrito","producto", $data);
                        }
                        $data["precio_total"]=number_format($precio_total, 2, ',', ' ')."€";
                        $this->render("carrito","carrito",$data);
                    }else{
                        $this->render("carrito","empty",$data);
                    }
            }
        }

        function getPrecioCarrito(){

        }
    }
?>
