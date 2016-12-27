<?php
    session_start();
    header("Content-type: text/html; charset=UTF-8");

    include_once 'app/core/config.php';
    include_once '../../vendor/autoload.php';
	include_once 'app/core/controller.php';

    //print_r($_REQUEST);
    if (isset($_GET["section"])){
        $section=$_GET['section'];

        switch ($section){
            case 'carrito':
                include_once 'app/controllers/carrito.php';
                $u = new Carrito();
                $u->index_carrito();
            break;

            case 'pedido':
                include_once 'app/controllers/pedido.php';
                $p = new Pedido();
                $p->index_pedido();
            break;

            case 'venta':
                include_once 'app/controllers/venta.php';
                $p = new Venta();
                $p->index_venta();
            break;

            case 'user':
                include_once 'app/controllers/user.php';
                $u = new User();
                $u->index_users();
            break;

            case 'producto':
                include_once 'app/controllers/producto.php';
                $p = new Producto();
                $p->index_productos();
            break;

            case 'simbiosis':/*administrador*/
                include_once 'app/controllers/admin.php';
                $admin = new Admin();
                $admin->index_admins();
            break;

            case 'upload':
                include_once 'app/controllers/upload.php';
                $upload = new Upload();
                $upload->index_uploads();
            break;

            case 'contacto':
                include_once 'app/controllers/contacto.php';
                $c = new Contacto();
                $c->index_contacto();
            break;

            case 'mailing':
                include_once 'app/controllers/mailing.php';
                $mailing = new Mailing();
                $mailing->index_mailing();
            break;

            case 'info':
                include_once 'app/controllers/static.php';
                $c = new CMS();
                $c->index_CMS();
            break;

            case 'home':
                include_once 'app/controllers/home.php';
                $h = new Home();
                $h->index_home();
            break;

            case 'store':
                include_once 'app/controllers/store.php';
                $as = new Store();
                $as->index_store();
            break;

            case 'notification':
                include_once 'app/controllers/notification.php';
                $notify = new Notification();
                $notify->index_notification();
            break;

            case 'error':
                include_once 'app/controllers/error.php';
                $e = new Error();
                $e->index_error();
            break;

            case 'sitemap':
                include_once 'app/controllers/sitemap.php';
                $sm = new Sitemapgen();
                $sm->index_sitemapgen();
            break;

            default:
                $controller = new Controller();
                $controller->render('error','404');
        }
    }else{
        $section='home';
        include_once 'app/controllers/home.php';
        $h = new Home();
        $h->index_home();
    }
?>
