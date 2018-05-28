<?php
class Upload extends Controller
{
    function index_uploads()
    {
        $this->loadModel("producto");
        $pr = new Producto_Model();
        $this->loadModel("design");
        $dg = new Design_Model();
        $this->loadModel("categoria");
        $cat = new Categoria_Model();
        $this->loadModel('tag');
        $t = new Tag_Model();
        $this->loadModel("email");
        $mail = new Email();

        @$action = $_GET["action"];
        switch ($action) {

            case 'step2':
                if (isset($_SESSION["login"])) {
                    $cat->nombre = $_GET["node"];

                    switch ($cat->nombre) {
                        case 'designs':
                            $data["page_title"] = "Diseña tu producto";

                            $data['category_parent']= $pr->category_parent = $cat->parent = $cat->getWhereNombre($cat->nombre)['id'];
                            $categorias = $cat->getChilds();
                            $data["tematicas"] = $cat->getCategorias('topic');
                            $dg->genera_token();
                            $data["token"] = $dg->token;
                            $pr->user = $dg->user = $this->u->id;
                            if ($data["listas"] = $pr->getListas()) {
                                $data["listas_productos"] = $this->loadView("uploader", "listas_productos", $data);
                            } else {
                                $data["listas_productos"] = "";
                            }
                            $data['categorias'] = array();
                            foreach ($categorias as $categoria) {
                                $pr->categoria = $categoria['id'];
                                $colores = $pr->getColores();

                                $categoria_array = array(
                                    'id' => $categoria['id'],
                                    'nombre' => $categoria['nombre'],
                                    'descripcion' => $categoria['descripcion'],
                                    'precio_base' => $categoria['precio_base'],
                                    'precio_base_formated' => str_replace('.', ',', $categoria['precio_base']),
                                    'beneficio' => $categoria['beneficio'],
                                    'beneficio_formated' => str_replace('.', ',', $categoria['beneficio']),
                                    'precio_max' => $categoria['precio_base'] + $categoria['beneficio'],
                                    'precio_max_formated' => str_replace('.', ',', $categoria['precio_base'] + $categoria['beneficio'])
                                );

                                $pr->categoria = $categoria['id'];
                                if ($colores = $pr->getColores()) {
                                    $categoria_array['colores'] = $colores;
                                    $categoria_array['color_pick'] = $this->loadView('uploader', 'color_picker', $colores);
                                }

                                if (empty($categoria['precio_base'])) {
                                    $precios_size = array();
                                    $cat->id = $categoria['id'];
                                    $cat->tipo_attr = "size";
                                    $valores = $cat->getValoresByTipo();
                                    $categoria_array['precios_slider'] = '';
                                    foreach ($valores as $valor) {
                                        $precio_size = array(
                                            'categoria' => $categoria['nombre'],
                                            'orden' => $valor['orden'],
                                            'valor' => $valor['valor'],
                                            'beneficio' => $valor['beneficio'],
                                            'beneficio_formated' => str_replace('.', ',', $valor['beneficio']),
                                            'precio_base' => $valor['precio_base'],
                                            'precio_base_formated' => str_replace('.', ',', $valor['precio_base']),
                                            'precio_max' => $valor['precio_base'] + $valor['beneficio']
                                        );
                                        array_push($precios_size, $precio_size);
                                        $categoria_array['precios_slider'] .= $this->loadView("uploader", "precios_sizes", $precio_size);
                                    }
                                    $categoria_array['precios_size'] = $precios_size;
                                }
                                array_push($data['categorias'], $categoria_array);
                            }
                            $data["custom_js"] = "<script src='" . PAGE_DOMAIN . "/vendor/fancy_product_designer/source/js/fabric.min.js'></script>";
                            $data["custom_js"] .= "<script src='" . PAGE_DOMAIN . "/vendor/fancy_product_designer/source/js/FancyProductDesigner-all.min.js'></script>";
                            $data['fpd'] = '';
                            foreach ($data['categorias'] as $categoria) {
                                $data['fpd'] .= $this->loadView('uploader/designer', $categoria['nombre'], $categoria);
                                $data["custom_js"] .= $this->minifyJs("uploader/designer", $categoria['nombre']);
                            }

                            $data["custom_js"] .= $this->minifyJs("uploader", "designs");

                            $data['designer'] = $this->loadView('uploader/designer', 'designer', $data);
                            $data["custom_css"] = "<link rel='stylesheet' href='" . PAGE_DOMAIN . "/vendor/fancy_product_designer/source/css/FancyProductDesigner-all.min.css'>";
                            $data["custom_css"] .= "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/css/bootstrap-slider.min.css'>";
                            $data["custom_css"] .= $this->minifyCss('uploader', 'designs');
                            $this->render("uploader", 'designs', $data);
                            break;

                        case 'handmades': case 'secondhand':
                            $data["page_title"] = "Configura tu producto";

                            $data["dg-id-cat"] = $cat->id = $cat->getWhereNombre()["id"];
                            $dg->genera_token();
                            $data["token"] = $dg->token;
                            $data["dg-nombre-cat"] = $cat->nombre;
                            $cat->parent = $cat->id = $cat->getWhereNombre()["id"];
                            $data["subcategorias"] = $cat->getChilds('enabled', 'producto');
                            $data["tematicas"] = $cat->getCategorias('topic');
                            $pr->user = $this->u->id;
                            if ($data["listas"] = $pr->getListas()) {
                                $data["listas_productos"] = $this->loadView("uploader", "listas_productos", $data);
                            } else {
                                $data["listas_productos"] = "";
                            }
                            $data["custom_js"] = $this->minifyJs("uploader", "products");
                            $data["custom_css"] = $this->minifyCss('uploader', 'products');
                            $this->render('uploader', 'products', $data);
                            break;

                        default:
                            $this->render("error", "404", $data);
                    }
                } else {
                        //Redireccionamos a página de registro
                    Header("Location: " . PAGE_DOMAIN . "/login?redirect=" . $this->getURL());
                }
                break;

            case 'publish':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    set_time_limit(60 * 30);//Establece tiempo máximo de ejecuccion.
                    $cat->parent = $cat->id = $_POST["categoria"];
                    $cat->nombre = $cat->get()["nombre"];
                    $data["parent_nombre"] = $cat->nombre;
                    $pr->nombre = $data["nombre"] = trim($_POST["nombre"]);
                    $pr->descripcion = $_POST["descripcion"];
                    $topics = $_POST['topics'];
                    $t->tags = $_POST["tags"];
                    if (isset($_POST["listas_productos"])) {
                        $pr->token_lista = $_POST["listas_productos"];
                    }
                    $data["token"] = $pr->design = $dg->token = $_POST["token"];
                    $upload_folder = 'designs/' . $this->u->user2URL($this->u->user) . '/' . $dg->token;
                    $design_name = $dg->token;

                    $height = 700;
                    $thumbsize = 512;
                    $jpg_quality = 100;
                    $swerror = 0;

                    $codigo_error = Array();

                    if ($cat->nombre == 'designs') { //SUBIDA DE DISEÑOS
                        $categorias = $cat->getChilds();
                        foreach($categorias as $categoria) {
                            if (!empty($_FILES['montaje_'.$categoria['nombre']]['tmp_name'])){
                                if (!file_exists($upload_folder . '/' . $categoria['nombre'])) {
                                    mkdir($upload_folder . '/' . $categoria['nombre'], 0777, true);
                                }
                                #SUBIDA MONTAJE-------------###
                                $img_montaje = new Imagick($_FILES["montaje_".$categoria['nombre']]["tmp_name"]);
                                $img_montaje->setImageFormat('jpeg');
                                $img_montaje->scaleImage($height, 0);
                                    //$img->setImageCompressionQuality(100);
                                $img_montaje_dst = $upload_folder . '/' . $categoria['nombre'] . '/MONTAJE-' . $design_name . '.jpg';
                                if ($img_montaje->writeImage($img_montaje_dst)) {
                                    
                                    #SUBIDA DEL THUMBNAIL--------------###
                                    $img_montaje->cropThumbnailImage($thumbsize, $thumbsize);
                                    $img_thumb_dst = $upload_folder . '/' . $categoria['nombre'] . '/thumb-' . $design_name . '.jpg';
                                    $img_montaje->writeImage($img_thumb_dst);
                                } else {
                                    array_push($codigo_error, "No se ha podido convertir a jpg y/o borrar el original png");
                                }
                            }
                        }

                        #SUBIDA DEL DISEÑO .PNG--------------###
                        $img_dg = new Imagick($_FILES["design"]['tmp_name']);
                        $img_dg_sizes = $img_dg->getImageGeometry();
                        $pr->width = $img_dg_sizes["width"];
                        $pr->height = $img_dg_sizes["height"];
                        $img_dg->scaleImage(0, $height);
                        $img_dg->writeImage($upload_folder . "/thumb-" . $design_name . '.png');
                        // $img_dg->scaleImage($pr->width * $pr->scale, 0);

                        if ($img_dg->writeImage($upload_folder . "/" . $design_name . '.png')) {//guardamos la imagen original como png
                            #SUBIMOS EL FICHERO EDITABLE------------###
                            if ($_FILES["design_editable"]["error"] == 0) {
                                $filename = $_FILES['design_editable']['name'];
                                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                $tmp_name = $_FILES['design_editable']['tmp_name'];
                                $design_editable_name = $dg->token . "." . $ext;
                                if (move_uploaded_file($tmp_name, $upload_folder . "/ORIGINAL-" . $design_editable_name)) {
                                    $swerror = 0;
                                } else {
                                    array_push($codigo_error, "No se ha podido mover el fichero editable a su carpeta");
                                }
                            } else {
                                array_push($codigo_error, "Error al pasar el fichero por ajax (" . $_FILES["design_editable"]["error"] . ")");
                            }
                        } else {
                            array_push($codigo_error, "No se ha podido subir el diseño a su carpeta");
                        }
                    } else { //SUBIDA DE ARTÍCULOS PARA VENTA (handmades Y BAÚL)
                        if (!file_exists($upload_folder . '/' . $cat->nombre)) {
                            mkdir($upload_folder . '/' . $cat->nombre, 0777, true);
                        }

                        $pr->beneficio = !empty($_POST["beneficio"]) ? $_POST['beneficio'] : 0;
                        $pr->usado = !empty($_POST['usado']) ? 1 : 0;

                        // print_r($_POST); print_r($_FILES);

                        $pr->preparacion = !isset($_POST['stock']) && !empty($_POST['preparacion']) ? $_POST['preparacion'] : 'NULL';
                        
                        $pr->stock = !isset($_POST['preparacion']) && !empty($_POST['stock']) ? $_POST['stock'] : 'NULL';

                        $pr->gastos_envio = !empty($_POST['gastos_envio']) ? $_POST['gastos_envio'] : 0;
                        $pr->tiempo_envio = !empty($_POST['tiempo_envio']) ? $_POST['tiempo_envio'] : 0;

                        $files = $this->reArrayFiles($_FILES['files']);
                        $contador = 0;

                        foreach ($files as $file) {
                            $img_venta = new Imagick($file['tmp_name']);
                            $img_venta->setImageFormat('jpeg');
                            $img_venta->scaleImage($height, 0);
                            $img_venta_dst = $upload_folder . '/' . $cat->nombre . "/" . $design_name . "-" . $contador . ".jpg";
                            if ($img_venta->writeImage($img_venta_dst)) {
                                    #SUBIDA DEL THUMBNAIL--------------###
                                $img_venta->cropThumbnailImage($thumbsize, $thumbsize);
                                if ($contador == 0) {
                                    $img_thumb_dst = $upload_folder . '/' . $cat->nombre . '/thumb-' . $design_name . '.jpg';
                                } else {
                                    $img_thumb_dst = $upload_folder . '/' . $cat->nombre . '/thumb-' . $design_name . '-' . $contador . '.jpg';
                                }
                                $img_venta->writeImage($img_thumb_dst);
                                $swerror = 0;
                            } else {
                                $swerror = 1;
                            }
                            $contador++;
                        }
                    }

                    if (empty($codigo_error)) {
                        $dg->user = $pr->creador = $this->u->id;
                        $pr->tags = explode(',', $_POST["tags"]);
                        $data["user"] = $this->u->user;

                        $dg->set();
                        if ($cat->nombre == 'designs') { //si es diseño
                            foreach($categorias as $categoria) {
                                if(!empty($_FILES['montaje_'.$categoria['nombre']]['tmp_name'])) {
                                    $pr->top = $_POST["top_".$categoria['nombre']];
                                    $pr->left = $_POST["left_".$categoria['nombre']];
                                    $pr->scale = $_POST["scale_".$categoria['nombre']];
                                    $pr->color = !empty($_POST["color_".$categoria['nombre']]) ? $_POST["color_".$categoria['nombre']] : '';
                                    $pr->modelo = !empty($_POST["modelo_".$categoria['nombre']]) ? $_POST["modelo_".$categoria['nombre']] : '';
                                    $pr->beneficio = $_POST["beneficio_".$categoria['nombre']];
                                    $pr->categoria = $categoria['id'];
                                    if (!$pr->id = $pr->setDesign()) {
                                        array_push($codigo_error, "Error al subir el producto de la categoría ".$categoria['nombre']);
                                        print_r($codigo_error);
                                    } else {
                                        $dg->setTopicsDesign($topics);
                                    }
                                }
                            }
                            if (empty($codigo_error)) {
                                //Si es su primer diseño
                                if($pr->countProductosCategoryParentUser() == 1) {
                                    $this->loadModel("mailing");
                                    $mailing = New Mailing_Model();
                                    $mailing->email=$this->u->email;
                                    $mailing->name=$this->u->user;
                                    $mailing->list = 8; //Lista informativa para vendedores de productos con diseños
                                    $mailing->set();
                                }

                                $this->loadModel("email");
                                /*PREPARAMOS EMAIL PARA EL ADMINISTRADOR*/
                                $admail = new Email();
                                $admail->to = ADMIN_EMAIL;
                                $admail->subject = "Nuevo diseño publicado por " . $this->u->user;
                                $admail->getEmail('adm_producto_publicado', $data);
                                if ($admail->sendEmail()) {
                                    echo true;
                                } else {
                                    echo "Se ha publicado un producto pero no se ha podido enviar la notificación por email";
                                }
                            }
                        } else { //si es para vender
                            $pr->categoria = $cat->id;
                            if ($pr->setCraft()) {
                                $dg->setTopicsDesign($topics);
                                $dg->setSubCategory($_POST["subcategoria"]);

                                //Si es su producto de handmade/segundamano
                                if($pr->countProductosCategoryUser() == 1) {
                                    $this->loadModel("mailing");
                                    $mailing = New Mailing_Model();
                                    $mailing->email=$this->u->email;
                                    $mailing->name=$this->u->user;
                                    if ($cat->nombre == 'handmades') {
                                        $mailing->list = 9; //Lista informativa para vendedores de productos de handmade
                                    } else if($cat->nombre == 'secondhand') {
                                        $mailing->list = 11; //Lista informativa para vendedores de productos de seconcdhand
                                    }
                                    $mailing->set();
                                }

                                $this->loadModel("email");
                                /*PREPARAMOS EMAIL PARA EL ADMINISTRADOR*/
                                $admail = new Email();
                                $admail->to = ADMIN_EMAIL;
                                $admail->subject = "Nuevo producto publicado por " . $this->u->user;
                                $admail->getEmail('adm_producto_publicado', $data);
                                if ($admail->sendEmail()) {
                                    echo true;
                                } else {
                                    echo "Se ha publicado un producto pero no se ha podido enviar la notificación por email";
                                }
                            } else {
                                echo "No se ha podido dar de alta como producto.";
                            }
                        }
                            //Si no tiene las opciones de pago configuradas le enviamos un email para que lo haga.
                        if (!$this->u->puedeVender()) {
                            $mail->getEmail("pago/informacion_pago", $data);
                            $mail->to = $this->u->getUser()["email"];
                            $mail->subject = PAGE_NAME . " | [IMPORTANTE: Información sobre ventas]";
                            $mail->sendEmail();
                        }
                    } else {
                        $this->loadModel("error");
                        $error = new Error_Model();
                        $error->codigo_error = $codigo_error;
                        $error->from_name = $this->u->user;
                        $error->from_email = $this->u->getUser()["email"];
                        $error->send_email();
                            //echo "Algunas de las imágenes no se han podido subir";
                    }
                } else {
                    $data["page_title"] = "ERROR 404";
                    $this->render("error", "404", $data);
                }
                break;

            case 'loadTagsQuery':
                $lista_tags = $t->getActiveTagsQuery($_GET["string"]);
                echo json_encode($lista_tags);
                break;

            default:
                if ($this->getCountry() == "ES") {
                    $data['page_title'] = "Vende camisetas personalizadas con tus diseños, manualidades y segunda mano.";
                    $this->render('upload', 'primer_paso', $data);
                } else {
                    Header("Location: " . PAGE_DOMAIN . "/upload/designs");
                }
        }
    }

    function reArrayFiles(&$file_post)
    {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
        return $file_ary;
    }
}
?>
