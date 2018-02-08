<?php
    class Pedido extends Controller{

        function index_pedido(){
            $data["page_title"]="Mis pedidos";
            $this->loadModel('producto');
            $p=New Producto_Model();
            $this->loadModel('categoria');
            $cat=New Categoria_Model();
            $this->loadModel('pedido');
            $ped=New Pedido_Model();
            $this->loadModel("design");
            $dg=New Design_Model();
            $this->loadModel("address");
            $address=New Address_Model();
            $vendedor=New Users_Model();
            $creador=New Users_Model();
            @$action=$_GET["action"];
            switch($action){
                case 'cancelar':
                    if(isset($_POST)){
                        $this->loadModel("email");
                        $mail=New Email();
                        if($_POST["token"]){
                            $data["token"]=$ped->token=$_POST["token"];
                            $ar_pedido=$ped->get();
                            if($ar_pedido["user"]==$this->u->id){
                                $ped->email=$ar_pedido["email"];
                                $data["nombre"]=$ar_pedido["name"];
                                $data["observaciones"]=$ped->observaciones=$_POST["observaciones"];
                                $data["metodo_pago"]=$ar_pedido["metodo_pago"];
                                //Email para el comprador
                                $mail->getEmail("pedido/cancelado", $data);
                                $mail->to=$ped->email;
                                $mail->subject=PAGE_NAME." | [Pedido cancelado]";
                                $mail->sendEmail();
                                //Email para el vendedor
                                $vendedor->id=$ar_pedido["vendedor"];
                                $info_vendedor=$vendedor->getUserFromID();
                                $vendedor->email=$info_vendedor["email"];
                                $data["vendedor_nombre"]=$info_vendedor["name"];
                                if($ar_pedido["vendedor"]==0){
                                    $mail->getEmail("pedido/cancelado_administrador", $data);
                                    $mail->to=CONTACT_EMAIL;
                                    $mail->subject="[PEDIDO CANCELADO] - ".$data["token"];
                                    $mail->sendEmail();
                                }else{
                                    $mail->getEmail("pedido/cancelado_vendedor", $data);
                                    $mail->to=$vendedor->email;
                                    $mail->subject=PAGE_NAME." | [Pedido cancelado]";
                                    $mail->sendEmail();
                                }
                                if($ped->cancelar()){
                                    $pedido=unserialize($ar_pedido["pedido"]);
                                    foreach($pedido as $linea){
                                        $p->id=$linea["producto"];
                                        $producto=$p->get();
                                        $data["dg_token"]=$dg->token=$producto["design"];
                                        $design=$dg->get();
                                        $cat->id=$p->categoria=$producto["categoria"];
                                        $data["dg_categoria"]=$cat->get()["nombre"];
                                        $data["dg_nombre"]=$producto["nombre"];
                                        $creador->id=$design["user"];
                                        $p->cancelarVenta($linea["cantidad"]);
                                        //Si el vendedor es AF pero no el creador
                                        if($ar_pedido["vendedor"]==0 && $creador->id>0){
                                            $info_creador=$creador->getUserFromID();
                                            $data["dg_autor"]=$info_creador["user"];
                                            $data["cantidad"]=$linea["cantidad"];

                                            $precio=$linea["precio"];
                                            $beneficio=$linea["beneficio"];
                                            $credito_anterior=$info_creador["credit"];
                                            $data["credito_anterior"]=number_format($credito_anterior, 2, ',', ' ')."€";
                                            $creador->credito = $credito = $credito_anterior - $beneficio * $linea["cantidad"];
                                            $creador->updateCredito();
                                            $data["descontado"] = number_format($beneficio * $linea["cantidad"], 2, ',', ' ')."€";
                                            $credito_actual = $credito;
                                            $data["credito_actual"]=number_format($credito_actual, 2, ',', ' ')."€";

                                            $mail->getEmail("pedido/cancelado_designer", $data);
                                            $mail->to=$info_creador["email"];
                                            $mail->subject=PAGE_NAME." | [Pedido cancelado]";
                                            $mail->sendEmail();
                                        }
                                    }
                                    echo true;
                                }else{
                                    echo "No se ha podido cancelar el pedido";
                                }
                            }else{
                                echo "Este pedido no te corresponde";
                            }
                        }else{
                            $this->render("error", "404", $data);
                        }
                    }else{
                        $this->render("error", "404", $data);
                    }
                break;

                case 'view':
                    if(isset($_SESSION["login"])){
                        $ped->user=$this->u->id;
                        $ped->token=$_GET["token"];
                        if($ar_pedido=$ped->get()){
                            if($ar_pedido["user"]==$this->u->id){ //comprobamos que el pedido es de este usuario
                                $data["id_vendedor"]=$vendedor->id=$ar_pedido["vendedor"];
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
                                        $data["atributos"].="Color: ".$color;
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
                                    $data["productos_pedido"].=$this->loadView("pedido","producto", $data);
                                }

                                if($vendedor->id==0){
                                    $data["nombre_vendedor"]=PAGE_NAME;
                                }else{
                                    $data["nombre_vendedor"]=$vendedor->getUserFromID()["user"];
                                }
                                $data["estado"]=$ar_pedido["estado"];
                                $data["class_estado"]=$this->classEstado($data["estado"]);

                                //Calculo de cancelación
                                $temp1=strtotime(date("Y-m-d H:i:s")); //hora actual
                                $temp2=strtotime($ar_pedido["fecha_pago"]); //hora del pago
                                $diferencia= abs($temp1-$temp2); //abs=valor absoluto :D

                                $horas=floor($diferencia/60/60); //floor=redondea hacia arriba :D
                                //echo "horas transcurridas: ".$horas;

                                if(($data["estado"]=="pendiente" || $data["estado"]=="pagado" || $horas < 18) && $data["estado"]!="cancelado"){
                                    $data["permite_cancelar"]=true;
                                }else{
                                    $data["permite_cancelar"]=false;
                                }

                                $data["fecha_pedido"]=$this->format_date($ar_pedido["fecha_pedido"]);
                                $data["metodo_pago"]=$ar_pedido["metodo_pago"];
                                $data["total_preparacion_pedido"]=$ar_pedido["preparacion"];
                                $data["tiempo_envio"]=$ar_pedido["tiempo_envio"]*24; $data["total_envio_pedido"]=number_format($ar_pedido["gastos_envio"], 2, ',', ' ')."€";
                                $data["total_vendedor"]=number_format($ar_pedido["precio"], 2, ',', ' ')."€";
                                $data["pedido"]=$this->loadView("pedido","pedido",$data);
                                $data["localizador"]=$ar_pedido["localizador"];

                                $data["name"]=$ar_pedido["name"];
                                $data["address"]=$ar_pedido["address"];
                                $data["cp"]=$ar_pedido["cp"];
                                $data["localidad"]=$ar_pedido["localidad"];
                                $address->id=$ar_pedido["provincia"];
                                $data["provincia"]=$address->getNombreProvincia();
                                $data["phone"]=$ar_pedido["phone"];
                                $data["nota"]=$ar_pedido["nota"];

                                $data["datos_envio"]=$this->loadView("pedido", "datos_envio", $data);
                                $data["custom_js"]=$this->minifyJs("pedido", "pedido");
                                $this->render("pedido","detalles_pedido",$data);
                            }else{
                                $this->render("error","404",$data);
                            }
                        }else{
                            //No tienes ningún pedido
                            $this->render("pedido","empty",$data);
                        }
                    }else{
                        //redirigimos al login con redireccion de vuelta para aca
                        header('Location: '.PAGE_DOMAIN.'/login?redirect='.$this->getURL());
                    }
                break;

                default:
                    if(isset($_SESSION["login"])){
                        $ped->user=$this->u->id;
                        if($lista_pedidos=$ped->getPedidos()){
                            $data["lista_pedidos"]="";
                            foreach($lista_pedidos as $ar_pedido){
                                $data["id_vendedor"]=$vendedor->id=$ar_pedido["vendedor"];
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
                                        $data["atributos"].="Color: ".$color;
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
                                    $data["productos_pedido"].=$this->loadView("pedido","producto", $data);
                                }

                                if($vendedor->id==0){
                                    $data["nombre_vendedor"]=PAGE_NAME;
                                }else{
                                    $data["nombre_vendedor"]=$vendedor->getUserFromID()["user"];
                                }
                                $data["estado"]=$ar_pedido["estado"];
                                $data["class_estado"]=$this->classEstado($data["estado"]);

                                //Calculo de cancelación
                                $temp1=strtotime(date("Y-m-d H:i:s")); //hora actual
                                $temp2=strtotime($ar_pedido["fecha_pago"]); //hora del pago
                                $diferencia= abs($temp1-$temp2); //abs=valor absoluto :D

                                $horas=floor($diferencia/60/60); //floor=redondea hacia arriba :D
                                //echo "horas transcurridas: ".$horas;

                                if(($data["estado"]=="pendiente" || $data["estado"]=="pagado" || $horas < 18) && $data["estado"]!="cancelado"){
                                    $data["permite_cancelar"]=true;
                                }else{
                                    $data["permite_cancelar"]=false;
                                }

                                $data["localizador"]=$ar_pedido["localizador"];

                                $data["fecha_pedido"]=$this->format_date($ar_pedido["fecha_pedido"]);
                                $data["metodo_pago"]=$ar_pedido["metodo_pago"];
                                $data["total_preparacion_pedido"]=$ar_pedido["preparacion"];
                                $data["tiempo_envio"]=$ar_pedido["tiempo_envio"]*24; $data["total_envio_pedido"]=number_format($ar_pedido["gastos_envio"], 2, ',', ' ')."€";
                                $data["total_vendedor"]=number_format($ar_pedido["precio"]+$ar_pedido["gastos_envio"], 2, ',', ' ')."€";
                                $data["lista_pedidos"].=$this->loadView("pedido","pedido",$data); $data["total_preparacion_pedido"]=$precio_total_pedido=$total_envio_pedido=0;
                                $data["productos_pedido"]="";
                            }
                            $data["custom_js"]=$this->minifyJs("pedido", "pedido");
                            $this->render("pedido","myorders",$data);
                        }else{
                            //No tienes ningún pedido
                            $this->render("pedido","empty",$data);
                        }
                    }else{
                        //redirigimos al login con redireccion de vuelta para aca
                        header('Location: '.PAGE_DOMAIN.'/login?redirect='.$this->getURL());
                    }
            }
        }

        function classEstado($estado){
            switch($estado){
                case 'pendiente': return "default"; break;
                case 'pagado': return "rose"; break;
                case 'procesado': return "warning"; break;
                case 'enviado': return "info"; break;
                case 'completado': return "success"; break;
                case 'cancelado': return "danger"; break;
            }
        }
    }
?>
