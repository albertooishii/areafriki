<?php
    class Venta extends Controller{

        function index_venta(){
            $data["page_title"]="Mis ventas";
            $this->loadModel('producto');
            $p=New Producto_Model();
            $this->loadModel('categoria');
            $cat=New Categoria_Model();
            $this->loadModel('pedido');
            $ped=New Pedido_Model();
            $this->loadModel('precio');
            $this->loadModel("design");
            $dg=New Design_Model();
            $this->loadModel("provincia");
            $provincia=New Provincia_Model();
            $vendedor=New Users_Model();
            $creador=New Users_Model();
            @$action=$_GET["action"];
            switch($action){
                case 'changeEstado':
                    if(isset($_POST)){
                        $this->loadModel("email");
                        $mail=New Email();
                        if($_POST["token"]){
                            $data["token"]=$ped->token=$_POST["token"];
                            $ar_pedido=$ped->get();
                            if($ar_pedido["vendedor"]==$this->u->id || $ar_pedido["vendedor"]==0){
                                $ped->email=$ar_pedido["email"];
                                $data["nombre"]=$ar_pedido["name"];

                                //Calculo de cancelación
                                $temp1=strtotime(date("Y-m-d H:i:s")); //hora actual
                                if(!empty($ar_pedido["fecha_pago"])){
                                    $temp2=strtotime($ar_pedido["fecha_pago"]); //hora del pago
                                    $diferencia= $temp1-$temp2; //abs=valor absoluto :D
                                    $horas=floor($diferencia/60/60); //floor=redondea hacia arriba :D
                                    //echo "horas transcurridas: ".$horas;
                                }else{
                                    $horas=0;
                                }

                                switch($_POST["estado"]){
                                    case 'pagado':
                                        $mail->getEmail("pedido/pagado", $data);
                                        $mail->to=$ped->email;
                                        $mail->subject=PAGE_NAME." | [Pago confirmado]";
                                        $mail->sendEmail();
                                        if($ped->pagar()){
                                            //Si el vendedor es la página tenemos que pagar a los diseñadores
                                            if($ar_pedido["vendedor"]==0){
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
                                                    if($creador->id>0){
                                                        $info_creador=$creador->getUserFromID();
                                                        $data["dg_autor"]=$info_creador["user"];
                                                        $data["cantidad"]=$linea["cantidad"];

                                                        $precio=$linea["precio"];
                                                        $credito_anterior=$info_creador["credit"];
                                                        $data["credito_anterior"]=number_format($credito_anterior, 2, ',', ' ')."€";
                                                        $creador->credito=$credito=$linea["precio"]*$linea["cantidad"];
                                                        $creador->updateCredito();
                                                        $data["credito"]=number_format($credito, 2, ',', ' ')."€";
                                                        $credito_actual=$credito_anterior+$credito;
                                                        $data["credito_actual"]=number_format($credito_actual, 2, ',', ' ')."€";

                                                        $mail->getEmail("pago/designer", $data);
                                                        $mail->to=$info_creador["email"];
                                                        $mail->subject=PAGE_NAME." | [Producto vendido]";
                                                        $mail->sendEmail();
                                                    }
                                                }
                                            }
                                            echo true;
                                        }
                                    break;

                                    case 'procesado':
                                        if(($ar_pedido["estado"]=="pendiente" || $ar_pedido["estado"]=="pagado") && $horas>=TIEMPO_ESPERA){
                                            $ped->estado=$_POST["estado"];
                                            if($ped->changeEstado()){
                                                echo true;
                                            }else{
                                                echo "No se ha podido cambiar el estado a este pedido";
                                            }
                                        }else{
                                            echo "No puedes cambiar el estado del pedido hasta que hayan pasado ".TIEMPO_ESPERA." horas";
                                        }
                                    break;

                                    case 'enviado':
                                        if(((($ar_pedido["estado"]=="pendiente" || $ar_pedido["estado"]=="pagado") && $horas>=TIEMPO_ESPERA)) || ($ar_pedido["estado"]=="procesado")){
                                            $data["localizador"]=$ped->localizador=$_POST["localizador"];
                                            $mail->getEmail("pedido/enviado", $data);
                                            $mail->to=$ped->email;
                                            $mail->subject=PAGE_NAME." | [Pedido enviado]";
                                            $mail->sendEmail();
                                            if($ped->enviar()){
                                                echo true;
                                            }
                                        }else{
                                            echo "No puedes cambiar el estado del pedido hasta que hayan pasado ".TIEMPO_ESPERA." horas";
                                        }
                                    break;

                                    case 'completado':
                                        if((($ar_pedido["estado"]=="pendiente" || $ar_pedido["estado"]=="pagado") && $horas>=TIEMPO_ESPERA) || $ar_pedido["estado"]=="procesado" || $ar_pedido["estado"]=="enviado"){
                                            if($ped->completar()){
                                                echo true;
                                            }else{
                                                echo "No se ha podido marcar este pedido como completado";
                                            }
                                        }else{
                                            echo "No puedes cambiar el estado del pedido hasta que hayan pasado ".TIEMPO_ESPERA." horas";
                                        }
                                    break;

                                    case 'cancelado':
                                        $data["observaciones"]=$ped->observaciones=$_POST["observaciones"];
                                        $data["metodo_pago"]=$ar_pedido["metodo_pago"];
                                        $mail->getEmail("pedido/cancelado", $data);
                                        $mail->to=$ped->email;
                                        $mail->subject=PAGE_NAME." | [Pedido cancelado]";
                                        $mail->sendEmail();
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
                                                    $credito_anterior=$info_creador["credit"];
                                                    $data["credito_anterior"]=number_format($credito_anterior, 2, ',', ' ')."€";
                                                    $creador->credito=$credito=$linea["precio"]*$linea["cantidad"];
                                                    $creador->updateCredito();
                                                    $data["credito"]=number_format($credito, 2, ',', ' ')."€";
                                                    $credito_actual=$credito_anterior-$credito;
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
                                    break;
                                }
                            }else{
                                echo "Este pedido no corresponde a este vendedor";
                            }
                        }else{
                            $this->render("error","404",$data);
                        }
                    }else{
                        $this->render("error","404",$data);
                    }
                break;

                case 'view':
                    if(isset($_SESSION["login"])){
                        $ped->user=$this->u->id;
                        $ped->token=$_GET["token"];
                        if($ar_pedido=$ped->get()){
                            if($ar_pedido["vendedor"]==$this->u->id){
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
                                    $data["productos_pedido"].=$this->loadView("venta","producto", $data);
                                }

                                $data["name"]=$ar_pedido["name"];
                                $data["address"]=$ar_pedido["address"];
                                $data["cp"]=$ar_pedido["cp"];
                                $data["localidad"]=$ar_pedido["localidad"];
                                $provincia->id=$ar_pedido["provincia"];
                                $data["provincia"]=$provincia->getNombre();
                                $data["phone"]=$ar_pedido["phone"];
                                $data["nota"]=$ar_pedido["nota"];

                                if($vendedor->id==0){
                                    $data["nombre_vendedor"]=PAGE_NAME;
                                }else{
                                    $data["nombre_vendedor"]=$vendedor->getUserFromID()["user"];
                                }

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

                                $data["metodo_pago"]=$ar_pedido["metodo_pago"];
                                $data["total_preparacion_pedido"]=$ar_pedido["preparacion"];
                                $data["tiempo_envio"]=$ar_pedido["tiempo_envio"]*24; $data["total_envio_pedido"]=number_format($ar_pedido["gastos_envio"], 2, ',', ' ')."€";
                                $data["total_vendedor"]=number_format($ar_pedido["precio"], 2, ',', ' ')."€";
                                $data["pedido"]=$this->loadView("venta","pedido",$data);
                                $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/venta/venta.js'></script>";
                                $this->render("venta","detalles_venta",$data);
                            }else{
                                //No tienes ningún pedido
                                $this->render("pedido","empty",$data);
                            }
                        }else{
                            $this->render("error", "404", $data);
                        }
                    }else{
                        //redirigimos al login con redireccion de vuelta para aca
                        header('Location: '.PAGE_DOMAIN.'/login?redirect='.$this->getURL());
                    }
                break;

                default:
                    if(isset($_SESSION["login"])){
                        $ped->vendedor=$this->u->id;
                        if($lista_pedidos=$ped->getVentas()){
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
                                    $data["productos_pedido"].=$this->loadView("venta","producto", $data);
                                }

                                $data["name"]=$ar_pedido["name"];
                                $data["address"]=$ar_pedido["address"];
                                $data["cp"]=$ar_pedido["cp"];
                                $data["localidad"]=$ar_pedido["localidad"];
                                $provincia->id=$ar_pedido["provincia"];
                                $data["provincia"]=$provincia->getNombre();
                                $data["phone"]=$ar_pedido["phone"];
                                $data["nota"]=$ar_pedido["nota"];

                                if($vendedor->id==0){
                                    $data["nombre_vendedor"]=PAGE_NAME;
                                }else{
                                    $data["nombre_vendedor"]=$vendedor->getUserFromID()["user"];
                                }

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
                                    /*if(($estado!="procesado" && $estado!="enviado" && $estado!="completado") || $horas>=TIEMPO_ESPERA){
                                        if(($ar_pedido["estado"]=="pendiente" && ($estado=="pagado" || $estado=="cancelado" || $estado=="pendiente")) || $ar_pedido["estado"]!="pendiente"){ //Si es pendiente solo puede aparecer como opciones pagado o cancelado*/
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
                                        /*}
                                    }*/
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

                                $data["metodo_pago"]=$ar_pedido["metodo_pago"];
                                $data["total_preparacion_pedido"]=$ar_pedido["preparacion"];
                                $data["tiempo_envio"]=$ar_pedido["tiempo_envio"]*24; $data["total_envio_pedido"]=number_format($ar_pedido["gastos_envio"], 2, ',', ' ')."€";
                                $data["total_vendedor"]=number_format($ar_pedido["precio"], 2, ',', ' ')."€";
                                $data["lista_pedidos"].=$this->loadView("venta","pedido",$data); $data["total_preparacion_pedido"]=$precio_total_pedido=$total_envio_pedido=0;
                                $data["productos_pedido"]="";
                            }
                            $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/venta/venta.js'></script>";
                            $this->render("venta","mysales",$data);
                        }else{
                            //No tienes ningún pedido
                            $this->render("venta","empty",$data);
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
