<?php
    class Carrito extends Controller{

        function index_carrito(){
            $data["page_title"]="Carrito";
            $this->loadModel('carrito');
            $car=New Carrito_Model();
            $this->loadModel('producto');
            $p=New Producto_Model();
            $this->loadModel("design");
            $dg=New Design_Model();
            $this->loadModel('precio');
            $pr=New Precio_Model();
            $this->loadModel('categoria');
            $cat=New Categoria_Model();
            $this->loadModel('pedido');
            $ped=New Pedido_Model();
            $this->loadModel("notification");
            $notify = New Notification_Model();
            $car->user=$this->u->id;
            @$action=$_GET["action"];
            switch($action){

                case 'add':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $creador=New Users_Model();
                        if(isset($_POST["id"])){
                            $p->id=$_POST["id"];
                            $producto=$p->get();
                        }elseif(isset($_POST["token"])){
                            $p->token=$_POST["token"];
                            $producto=$p->getProductoWhereToken();
                            $p->id=$producto["id"];
                        }
                        $cat->id=$producto["categoria"];
                        $dg->token=$producto["design"];
                        $design=$dg->get();
                        $creador->id=$design["user"];

                        if($cat->get()["parent"]==1){ //areafriki (designs)
                            $car->vendedor=0;
                        }else{ //creador (crafts, baul)
                            $car->vendedor=$creador->id;
                        }

                        if(!empty($_POST["size"])){$size=$_POST["size"];}else{$size="";}
                        if(!empty($_POST["color"])){$color=$_POST["color"];}else{$color="";}
                        if(!empty($_POST["nota"])){$nota=$_POST["nota"];}else{$nota="";}

                        $car->linea = array(
                            "producto"    => $p->id,
                            "cantidad" => $_POST["cantidad"],
                            "size" => $size,
                            "color" => $color,
                            "nota" => $nota,
                            "fecha" => date ("Y-m-d H:i:s"),
                            "activo" => true,
                        );

                        if($car->add()){
                            echo true;
                        }else{
                            echo false;
                        }
                    }
                break;

                case 'remove':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $car->linea=$_POST["linea"];
                        $car->token=$_POST["token"];
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
                            $car->token=$_POST["token"];
                            $car->vendedor=$_POST["vendedor"];
                            $car->editCantidad();
                        }
                    }
                break;

                case 'checkout':
                    if(isset($_POST["token"])){
                        $data["token"]=$car->token=$_POST["token"];

                        if($carrito=$car->get()){
                            $creador=New Users_Model();
                            $vendedor=New Users_Model();

                            $pedido=$pr->pedido=unserialize($carrito["pedido"]);
                            $pr->vendedor=$vendedor->id=$data["id_vendedor"]=$carrito["vendedor"];
                            $subtotal=$total_envio_vendedor=$data["total_preparacion_vendedor"]=$data["tiempo_envio_total"]=$precio_total_vendedor=NULL;
                            $swgastosenvionull=$swpreparacionnull=0;
                            $data["productos_vendedor"]=$data["lista_productos"]="";
                            foreach($pedido as $key => $linea){
                                $data["linea"]=$key;
                                $pr->producto=$p->id=$linea["producto"];
                                $producto=$p->get();
                                $data["dg_token"]=$dg->token=$producto["design"];
                                $design=$dg->get();
                                $cat->id=$pr->categoria=$p->categoria=$producto["categoria"];
                                $data["dg_categoria"]=$cat->get()["nombre"];
                                $data["dg_nombre"]=$producto["nombre"];
                                $data["stock"]=$producto["stock"];
                                $data["cantidad"]=$linea["cantidad"];

                                if($data["stock"]>0 || $data["stock"]==NULL){
                                    if(!is_null($producto["preparacion"])){
                                        $data["total_preparacion_vendedor"]+=$data["preparacion"]=$producto["preparacion"];
                                    }else{
                                        $swpreparacionnull=1;
                                        $data["preparacion"]=$producto["preparacion"];
                                    }

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

                                    $data["nota"]="";
                                    if(!empty($linea["nota"])){
                                        $data["nota"]=$linea["nota"];
                                    }

                                    /*PRECIO----------*/
                                    $precio=$pr->get($linea["size"]);
                                    $data["precio"]=number_format($precio, 2, ',', ' ')."€";
                                    $data["total_producto"]=number_format($precio*$linea["cantidad"], 2, ',', ' ')."€";
                                    $precio_total_vendedor+=$precio*$linea["cantidad"];
                                    $subtotal+=$precio*$linea["cantidad"];

                                    /*GASTOS_ENVIO----------*/
                                    if(!is_null($producto["gastos_envio"])){
                                        $data["gastos_envio_float"]=$gastos_envio=$producto["gastos_envio"];
                                        $data["gastos_envio"]=number_format($gastos_envio, 2, ',', ' ')."€";
                                        $total_envio_vendedor+=$gastos_envio;
                                    }else{
                                        $swgastosenvionull=1;
                                        $gastos_envio=$data["gastos_envio_float"]=NULL;
                                    }
                                    $data["total_envio_vendedor"]=number_format($total_envio_vendedor, 2, ',', ' ')."€";

                                    if($pr->vendedor==0){
                                        $data["nombre_vendedor"]=PAGE_NAME;
                                        if($precio_total_vendedor<MIN_ENVIO_GRATIS){

                                            if($total_envio_vendedor==0 && !$swgastosenvionull){
                                                $total_envio_vendedor=0;
                                                $data["total_envio_vendedor"]=number_format($total_envio_vendedor, 2, ',', ' ')."€";
                                            }else{
                                                $total_envio_vendedor=GASTOS_ENVIO;
                                                $data["total_envio_vendedor"]=number_format($total_envio_vendedor, 2, ',', ' ')."€";
                                            }
                                        }else{
                                            $total_envio_vendedor=0;
                                            $data["total_envio_vendedor"]=number_format($total_envio_vendedor, 2, ',', ' ')."€";
                                        }
                                        if(is_null($producto["tiempo_envio"])){
                                            $data["tiempo_envio"]=$data["tiempo_envio_total"]=TIEMPO_ENVIO*24;
                                        }else{
                                            $data["tiempo_envio"]=$data["tiempo_envio_total"]=$producto["tiempo_envio"]*24;
                                        }

                                        if($swpreparacionnull){
                                            $data["total_preparacion_vendedor"]=PREPARACION;
                                        }
                                    }else{
                                        $info_vendedor=$vendedor->getUserFromID();
                                        $data["nombre_vendedor"]=$info_vendedor["user"];
                                        $data["tiempo_envio"]=$producto["tiempo_envio"]*24;
                                        //como tiempo de envio total marcamos el mayor de los productos del vendedor
                                        if($data["tiempo_envio"]>$data["tiempo_envio_total"]){
                                            $data["tiempo_envio_total"]=$data["tiempo_envio"];
                                        }
                                    }
                                    $data["total_envio_vendedor_float"]=$total_envio_vendedor;
                                    $data["total_vendedor_float"]=$precio_total_vendedor;
                                   $data["total_vendedor"]=number_format($precio_total_vendedor + $total_envio_vendedor, 2, ',', ' ')."€";
                                    $data["productos_vendedor"].=$this->loadView("carrito","producto",$data);
                                }else{
                                    header('Location: '.PAGE_DOMAIN.'/carrito');
                                }
                            }
                            $data["carrito_vendedor"]=$this->loadView("carrito","vendedor",$data);

                            if($pr->vendedor==0){
                                if(PAYPAL){$data["paypal"]=true;}else{$data["paypal"]=false;}
                                if(IBAN){$data["iban"]=true;}else{$data["iban"]=false;}
                                if(STRIPE_PUBLIC && STRIPE_SECRET){$data["stripe"]=true;}else{$data["stripe"]=false;}
                            }else{
                                if(!empty($info_vendedor["paypal"])){$data["paypal"]=true;}else{$data["paypal"]=false;}
                                if(!empty($info_vendedor["iban"])){$data["iban"]=true;}else{$data["iban"]=false;}
                                //Stripe lo configuraremos en un futuro para que los vendedores puedan usarlo, de momento false
                                $data["stripe"]=false;
                            }


                            $data["form-pago"]=$this->loadView("forms","pago",$data);

                            $this->loadModel("address");
                            $address = New Address_Model();
                            $provincias=$address->getProvincias();
                            if(!empty($carrito["name"])){
                                $data["nombre"]=$carrito["name"];
                                $data["direccion"]=$carrito["address"];
                                $data["cp"]=$carrito["cp"];
                                $data["localidad"]=$carrito["localidad"];
                                $data["phone"]=$carrito["phone"];
                                $data["provincia_selected"]=$carrito["provincia"];
                                $data["nota"]=$carrito["nota"];
                            }elseif(isset($_SESSION["login"])){
                                $user=$this->u->getUser();
                                $data["nombre"]=$user["name"];
                                $data["direccion"]=$user["address"];
                                $data["cp"]=$user["cp"];
                                $data["localidad"]=$user["localidad"];
                                $data["phone"]=$user["phone"];
                                $data["provincia_selected"]=$user["provincia"];
                                $data["nota"]="";
                            }else{
                                $data["nombre"]=$data["direccion"]=$data["cp"]=$data["localidad"]=$data["phone"]=$data["provincia_selected"]="";
                            }
                            $data["provincia"]=$this->loadView("forms","provincia",$data);
                            $data["custom_js"]="<script type='text/javascript' src='https://js.stripe.com/v2/'></script>";
                            $data["custom_js"].=$this->minifyJs("forms", "pago");
                            $data["custom_js"].=$this->minifyJs("carrito", "carrito");
                            $this->render("carrito","checkout",$data);
                        }
                    }else{
                        $this->render("error","404",$data);
                    }
                break;

                case 'pago':
                    if(isset($_POST["pay_method"])){
                        $vendedor=New Users_Model();
                        $data["token_carrito"]=$car->token=$_POST["token"];
                        $carrito=$car->get();

                        $pedido=unserialize($carrito["pedido"]);
                        $pr->pedido=$pedido_vendedor=$pedido;

                        $vendedor->id=$car->vendedor=$carrito["vendedor"];
                        $info_vendedor=$vendedor->getUserFromID();

                        $pr->getPrecioPedido();
                        $data["precio_total"]=number_format($pr->precio_total, 2);

                        //Guardamos en el carrito la información de envío
                        $car->name=$_POST["name"];
                        if(isset($_SESSION["login"])){
                            $car->email=$this->u->getUser()["email"];
                        }else{
                            $car->email=$_POST["email"];
                        }
                        $car->address=$_POST["address"];
                        $car->cp=$_POST["cp"];
                        $car->provincia=$_POST["provincia"];
                        $car->localidad=$_POST["localidad"];
                        $car->phone=$_POST["phone"];
                        $car->nota=$_POST["nota"];

                        if($car->setInfoEnvio()){
                            switch($_POST["pay_method"]){
                                case 'transferencia':
                                    if($vendedor->id==0){
                                        $data["iban"]=IBAN;
                                    }else{
                                        $data["iban"]=$info_vendedor["iban"];
                                    }
                                    $this->render("pago","transferencia/transferencia",$data);
                                break;

                                case 'paypal':
                                    if($vendedor->id==0){
                                        $data["paypal_email"]=PAYPAL;
                                    }else{
                                        $data["paypal_email"]=$info_vendedor["paypal"];
                                    }
                                    $data["custom_js"]=$this->minifyJs("pago", "paypal/paypal");
                                    $this->render("pago","paypal/paypal",$data);
                                break;

                                case 'stripe':
                                    include_once DIR."/app/views/pago/stripe/stripe.php";
                                break;
                            }
                        }else{
                            $data["titulo_mensaje"]="Error";
                            $data["texto_mensaje"]="No se ha podido guardar la información de envío.";
                            $this->render('mensaje','mensaje',$data);
                        }
                    }else{
                        $this->render("error","404",$data);
                    }
                break;

                case 'notify':
                    $creador=New Users_Model();
                    $vendedor=New Users_Model();
                    $comprador=New Users_Model();
                    $this->loadModel("email");
                    $mail=New Email();
                    $log="";
                    if(isset($_GET["method"])){
                        if($_GET["method"]=="paypal"){
                            include_once DIR."/app/views/pago/paypal/notify.php";
                            $car->token=$token_carrito;
                        }else{
                            $car->token=$_POST["token_carrito"];
                        }

                        if(isset($car->token)){
                            if($carrito=$car->get()){
                                $vendedor->id=$ped->vendedor=$carrito["vendedor"];
                                $pedido=unserialize($carrito["pedido"]);
                                $ped->preparacion=0;
                                foreach($pedido as $key => $linea){
                                    $p->id=$pr->producto=$linea["producto"];
                                    $producto=$p->get();
                                    $pr->categoria=$producto["categoria"];
                                    $precio=$pr->get($linea["size"]);
                                    $pedido[$key]["precio"]=$precio;
                                    $pedido[$key]["beneficio"]=$pr->beneficio;
                                    if($vendedor->id>0 || !is_null($producto["preparacion"])){
                                        $ped->preparacion+=$producto["preparacion"];
                                    }else{
                                        $ped->preparacion=PREPARACION;
                                    }
                                    //como tiempo de envio marcamos el mayor de los productos del vendedor
                                    if($producto["tiempo_envio"]>$ped->tiempo_envio){
                                        $ped->tiempo_envio=$producto["tiempo_envio"];
                                    }else{
                                        $ped->tiempo_envio=TIEMPO_ENVIO;
                                    }
                                }

                                $ped->pedido=$pr->pedido=$pedido;
                                $pr->getPrecioPedido();
                                $ped->gastos_envio=$pr->gastos_envio;
                                $ped->precio=$pr->subtotal;
                                $data["precio_total"]=number_format($pr->precio_total, 2, ',', ' ')."€";

                                $ped->metodo_pago=$_GET["method"];
                                if(!empty($carrito["user"])){
                                    $comprador->id=$ped->user=$carrito["user"];
                                    $info_comprador=$comprador->getUserFromID();
                                    $data["user"]=$info_comprador["user"];
                                }

                                //Información de envío
                                $data["nombre"]=$ped->name=$carrito["name"];
                                $ped->email=$carrito["email"];
                                $ped->address=$carrito["address"];
                                $ped->cp=$carrito["cp"];
                                $ped->provincia=$carrito["provincia"];
                                $ped->localidad=$carrito["localidad"];
                                $ped->phone=$carrito["phone"];
                                $ped->nota=$carrito["nota"];

                                $swpedido=0;
                                switch($_GET["method"]){
                                    case 'stripe':
                                        $ped->genera_token();
                                        $ped->metodo_pago="tarjeta";
                                        $data["token"]=$ped->token;
                                        if($_POST["estado"]=="pagado"){
                                            $ped->estado="pagado";
                                        }else{
                                            $ped->estado="pendiente";
                                        }
                                        if($ped->set()){
                                            $swpedido=1;
                                            $car->delete();
                                        }else{
                                            $data["titulo_mensaje"]="Error";
                                            $data["texto_mensaje"]="No se ha podido guardar la información de envío.";
                                            $this->render('mensaje','mensaje',$data);
                                        }
                                    break;

                                    case 'paypal':
                                        if($estado=="pagado"){
                                            $ped->estado="pagado";
                                        }else{
                                            $ped->estado="pendiente";
                                        }
                                        $ped->genera_token();
                                        $data["token"]=$ped->token;
                                        if($ped->set()){
                                            $swpedido=1;
                                            $car->delete();
                                        }else{
                                            $log.="No se ha podido dar de alta el pedido\n\r";
                                            $log.=print_r($ped,true);
                                        }
                                    break;

                                    case 'transferencia':
                                        $ped->estado=$estado="pendiente";
                                        $ped->genera_token();
                                        $data["token"]=$ped->token;
                                        $data["iban"]=$_POST["iban"];
                                        if($ped->set()){
                                            $swpedido=1;
                                            $car->delete();
                                        }else{
                                            $data["titulo_mensaje"]="Error";
                                            $data["texto_mensaje"]="No se ha podido guardar la información de envío.";
                                            $this->render('mensaje','mensaje',$data);
                                        }
                                    break;
                                }

                                if($swpedido==1){ //pedido perfecto
                                    //Email para ÁreaFriki
                                    $mail->getEmail("pago/administrador",$data);
                                    $mail->to=CONTACT_EMAIL;
                                    $mail->subject="[NUEVO PEDIDO] - ".$data["token"];
                                    $mail->sendEmail();

                                    $info_vendedor=$vendedor->getUserFromID();
                                    if($ped->estado=="pagado"){ //estado es pagado
                                        //Email para el comprador
                                        $mail->getEmail("pago/comprador", $data);
                                        $mail->to=$ped->email;
                                        $mail->subject=PAGE_NAME." | [Confirmación de pedido]";
                                        $mail->sendEmail();

                                        if($vendedor->id==0){
                                            //Email para el/los diseñador/es
                                            $log.="emails para los diseñadores";
                                            foreach($pr->pedido as $linea){
                                                $pr->producto=$p->id=$linea["producto"];
                                                $producto=$p->get();
                                                $data["dg_token"]=$dg->token=$producto["design"];
                                                $design=$dg->get();
                                                $cat->id=$pr->categoria=$p->categoria=$producto["categoria"];
                                                $data["dg_categoria"]=$cat->get()["nombre"];
                                                $data["dg_nombre"]=$producto["nombre"];

                                                $creador->id=$design["user"];
                                                if($creador->id!=0){
                                                    $info_creador=$creador->getUserFromID();
                                                    $data["dg_autor"]=$info_creador["user"];
                                                    $data["cantidad"]=$linea["cantidad"];

                                                    $orden=$linea["size"];
                                                    $pr->modelo=$producto["modelo"];

                                                    $precio=$pr->get($orden);
                                                    $credito_anterior=$info_creador["credit"];
                                                    $data["credito_anterior"]=number_format($credito_anterior, 2, ',', ' ')."€";
                                                    $creador->credito=$credito=$pr->beneficio*$linea["cantidad"];
                                                    $creador->updateCredito();
                                                    $data["credito"]=number_format($credito, 2, ',', ' ')."€";
                                                    $credito_actual=$credito_anterior+$credito;
                                                    $data["credito_actual"]=number_format($credito_actual, 2, ',', ' ')."€";

                                                    $mail->getEmail("pago/designer", $data);
                                                    $mail->to=$info_creador["email"];
                                                    $mail->subject=PAGE_NAME." | [Producto vendido]";
                                                    $mail->sendEmail();

                                                    //Notificacion para el diseñador
                                                    $notify->to=$creador->id;
                                                    $notify->from=$this->u->id;
                                                    $notify->producto=$p->id;
                                                    $notify->titulo="Venta de producto";
                                                    $notify->texto="Han comprado ".$producto["nombre"].". Se ha añadido el saldo correspondiente a tu cuenta.";
                                                    $notify->url=$data["dg_categoria"]."/".$data["dg_token"];
                                                    $notify->tipo="compra";
                                                    $notify->set();
                                                }
                                            }
                                            //Comisión de referral
                                            if(isset($_COOKIE["referral"])){
                                                $this->loadModel("referer");
                                                $ref=New Referer_Model();
                                                $ref->referral=$_COOKIE["referral"];
                                                $ref->precio=$ped->precio;
                                                if($info_comision=$ref->getComision()){
                                                    $referral=New Users_Model();
                                                    $referral->id=$info_comision["id"];
                                                    $referral->credito=$info_comision["comision"];
                                                    $referral->updateCredito();
                                                    //borramos la cookie para que no vuelva a añadir comision por compras
                                                    setcookie("referral", '', strtotime('-1 days'), '/');
                                                }
                                            }
                                        }else{
                                            //Email para el vendedor
                                            $mail->getEmail("pago/vendedor", $data);
                                            $mail->to=$info_vendedor["email"];
                                            $mail->subject=PAGE_NAME." | [Nuevo pedido]";
                                            $mail->sendEmail();
                                        }
                                    }else{//estado es pendiente
                                        if($_GET["method"]=="transferencia"){
                                            //Email para comprador
                                            $mail->getEmail("pago/transferencia", $data);
                                            $mail->to=$ped->email;
                                            $mail->subject=PAGE_NAME." | [Pedido pendiente]";
                                            $mail->sendEmail();

                                            //Email para vendedor
                                            if($vendedor->id>0){
                                                $mail->getEmail("pago/vendedor_transferencia", $data);
                                                $mail->to=$info_vendedor["email"];
                                                $mail->subject=PAGE_NAME." | [Pedido pendiente mediante transferencia bancaria]";
                                                $mail->sendEmail();
                                            }
                                        }elseif($_GET["method"]=="paypal"){
                                            //Email para vendedor
                                            if($vendedor->id>0){
                                                $mail->getEmail("pago/vendedor_pendiente", $data);
                                                $mail->to=$info_vendedor["email"];
                                                $mail->subject=PAGE_NAME." | [Pedido pendiente mediante paypal]";
                                                $mail->sendEmail();
                                            }
                                        }
                                    }
                                    //Notificacion para el vendedor
                                    $notify->to=$vendedor->id;
                                    $notify->from=$this->u->id;
                                    $notify->producto=$p->id;
                                    $notify->titulo="Venta de producto";
                                    $notify->texto=$data["nombre"]." ha comprado ".$producto["nombre"].".";
                                    $notify->url="mysales/".$data["token"];
                                    $notify->tipo="compra";
                                    $notify->set();

                                    //sumamos las ventas a los productos y si tienen stock le restamos las unidades vendidas
                                    foreach($pr->pedido as $linea){
                                        $p->id=$linea["producto"];
                                        $p->vender($linea["cantidad"]);
                                    }

                                    if($_GET["method"]=='stripe' || $_GET["method"]=='transferencia'){
                                        header('Location: '.PAGE_DOMAIN.'/carrito/completed');
                                    }
                                }
                            }else{
                                $log.="No existe ningun carrito con este token";
                                $data["titulo_mensaje"]="Error";
                                $data["texto_mensaje"]="No hay ningún carrito con este token.";
                                $this->render('mensaje','mensaje',$data);
                            }
                        }else{
                            $this->render("error","404",$data);
                        }
                        $this->write_log($log, "LOG");
                    }else{
                        $this->render("error","404",$data);
                    }
                break;

                case 'completed':
                    $this->render("carrito","completed",$data);
                break;

                default:
                    if($this->getCountry()=="ES"){
                        if($carritos=$car->getCarritosUser()){
                            $creador=New Users_Model();
                            $vendedor=New Users_Model();

                            $data["lista_productos"]=$data["productos_vendedor"]="";
                            $data["total_preparacion_vendedor"]=$subtotal=$precio_total_vendedor=$total_envio_vendedor=NULL;

                            foreach($carritos as $carrito){
                                $data["id_vendedor"]=$vendedor->id=$carrito["vendedor"];
                                $pedido=unserialize($carrito["pedido"]);
                                $car->token=$data["token"]=$carrito["token"];
                                $data["tiempo_envio_total"]=$swgastosenvionull=$swpreparacionnull=0;
                                foreach($pedido as $key => $linea){
                                    $car->linea=$data["linea"]=$key;
                                    $pr->producto=$p->id=$linea["producto"];
                                    $producto=$p->get();
                                    $data["dg_token"]=$dg->token=$producto["design"];
                                    $design=$dg->get();
                                    $cat->id=$pr->categoria=$p->categoria=$producto["categoria"];
                                    $data["dg_categoria"]=$cat->get()["nombre"];
                                    $data["dg_nombre"]=$producto["nombre"];
                                    $data["stock"]=$producto["stock"];
                                    $car->cantidad=$data["cantidad"]=$linea["cantidad"];

                                    if($data["stock"]>0 || $data["stock"]==NULL){
                                        if(!is_null($producto["preparacion"])){
                                            $data["total_preparacion_vendedor"]+=$data["preparacion"]=$producto["preparacion"];
                                        }else{
                                            $swpreparacionnull=1;
                                            $data["preparacion"]=$producto["preparacion"];
                                        }

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

                                        $data["nota"]="";
                                        if(!empty($linea["nota"])){
                                            $data["nota"]=$linea["nota"];
                                        }

                                        /*PRECIO----------*/
                                        $precio=$pr->get($linea["size"]);
                                        $data["precio"]=number_format($precio, 2, ',', ' ')."€";
                                        $data["total_producto"]=number_format($precio*$linea["cantidad"], 2, ',', ' ')."€";
                                        $precio_total_vendedor+=$precio*$linea["cantidad"];
                                        $subtotal+=$precio*$linea["cantidad"];

                                        /*GASTOS_ENVIO----------*/
                                        if(!is_null($producto["gastos_envio"])){
                                            $data["gastos_envio_float"]=$gastos_envio=$producto["gastos_envio"];
                                            $data["gastos_envio"]=number_format($gastos_envio, 2, ',', ' ')."€";
                                            $total_envio_vendedor+=$gastos_envio;
                                        }else{
                                            $swgastosenvionull=1;
                                            $gastos_envio=$data["gastos_envio_float"]=NULL;
                                        }
                                        $data["total_envio_vendedor"]=number_format($total_envio_vendedor, 2, ',', ' ')."€";

                                        $data["productos_vendedor"].=$this->loadView("carrito","producto", $data);
                                    }else{
                                        //No hay stock suficiente para este producto
                                        $car->removeLinea();
                                        if($data["stock"]==0){
                                            $data["productos_vendedor"].=$this->loadView("carrito","agotado",$data);
                                        }else{
                                            $data["productos_vendedor"].=$this->loadView("carrito","stock_bajo",$data);
                                        }
                                    }
                                }
                                if($vendedor->id==0){
                                    $data["nombre_vendedor"]=PAGE_NAME;
                                    if($precio_total_vendedor<MIN_ENVIO_GRATIS){

                                        if($total_envio_vendedor==0 && !$swgastosenvionull){
                                            $total_envio_vendedor=0;
                                            $data["total_envio_vendedor"]=number_format($total_envio_vendedor, 2, ',', ' ')."€";
                                        }else{
                                            $total_envio_vendedor=GASTOS_ENVIO;
                                            $data["total_envio_vendedor"]=number_format($total_envio_vendedor, 2, ',', ' ')."€";
                                        }
                                    }else{
                                        $total_envio_vendedor=0;
                                        $data["total_envio_vendedor"]=number_format($total_envio_vendedor, 2, ',', ' ')."€";
                                    }
                                    if(is_null($producto["tiempo_envio"])){
                                        $data["tiempo_envio"]=$data["tiempo_envio_total"]=TIEMPO_ENVIO*24;
                                    }else{
                                        $data["tiempo_envio"]=$data["tiempo_envio_total"]=$producto["tiempo_envio"]*24;
                                    }

                                    if($swpreparacionnull){
                                        $data["total_preparacion_vendedor"]=PREPARACION;
                                    }
                                }else{
                                    $data["nombre_vendedor"]=$vendedor->getUserFromID()["user"];
                                    $data["tiempo_envio"]=$producto["tiempo_envio"]*24;
                                    //como tiempo de envio total marcamos el mayor de los productos del vendedor
                                    if($data["tiempo_envio"]>$data["tiempo_envio_total"]){
                                        $data["tiempo_envio_total"]=$data["tiempo_envio"];
                                    }
                                }
                               $data["total_envio_vendedor_float"]=$total_envio_vendedor;
                                $data["total_vendedor_float"]=$precio_total_vendedor;
                                $data["total_vendedor"]=number_format($precio_total_vendedor + $total_envio_vendedor, 2, ',', ' ')."€";
                                $data["lista_productos"].=$this->loadView("carrito","vendedor",$data);
                               $data["total_preparacion_vendedor"]=$precio_total_vendedor=$total_envio_vendedor=0;
                                $data["productos_vendedor"]="";
                            }

                            $data["custom_js"]=$this->minifyJs("carrito", "carrito");
                            $this->render("carrito","carrito",$data);
                        }else{
                            $this->render("carrito","empty",$data);
                        }
                    }else{
                        $this->render("carrito","nodisponible",$data);
                    }
            }
        }
    }
?>
