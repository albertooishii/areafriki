<?php
    session_start();
    header("Content-type: text/html; charset=UTF-8");

    include_once 'app/core/config.php';
	include_once 'app/core/controller.php';

    //print_r($_REQUEST);

    if (isset($_GET["section"]) && (isset($_SESSION["login"]) || isset($_COOKIE["user"]))){
        $section=$_GET['section'];

        switch ($section){
            case 'carrito':
                include_once 'app/controllers/carrito.php';
                $u = new Carrito();
                $u->index_carrito();
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

            /*administrador*/
            case 'simbiosis':
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

            case 'error':
                include_once 'app/controllers/error.php';
                $e = new Error();
                $e->index_error();
            break;

            default:
                $controller = new Controller();
                $controller->render('error','404');
            break;
        }
    }else{
        if(isset($_SESSION["login"]) || isset($_COOKIE["user"])){
            $section='home';
            include_once 'app/controllers/home.php';
            $h = new Home();
            $h->index_home();
        }else{
            if(@$_GET["section"]=="user"){
                include_once 'app/controllers/user.php';
                $u = new User();
                $u->index_users();
            }else{
                $_GET["section"]='beta_home';
                include_once 'app/controllers/beta.php';
                $h = new Beta();
                $h->index_beta();
            }
        }
    }
?>
