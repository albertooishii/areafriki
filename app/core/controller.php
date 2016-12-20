<?php
    class Controller {
        private $view = null;
        private $folder = null;
        private $data = array();
        private $modelName;

        public function __construct()
        {
            $this->loadModel('user');
            $this->u = new Users_Model();

            if(isset($_COOKIE["user"]) && isset($_COOKIE["pass"])){
                $this->u->user=$_COOKIE["user"];
                $this->u->pass=$_COOKIE["pass"];
                if(!$this->u->coincideUserAndPassword()){
                    $this->u->logout();
                }elseif(!isset($_SESSION["login"])){
                    $this->u->login();
                }
            }
            if(isset($_SESSION["login"])){
                $this->u->user=$_SESSION["login"]["user"];
                $info_user=$this->u->getUser();
                $this->u->id=$info_user["id"];
                $this->u->email=$info_user["email"];
            }

            if(!empty($_GET["ref"])){
                $this->loadModel("referer");
                $ref = new Referer_Model();
            }
        }

        public function loadHelper($helperName){
            include_once DIR."/app/helpers/$helperName.php";
        }

        public function loadModel($modelName){
            include_once DIR."/app/models/$modelName.php";
        }

        public function loadView($folder,$view,$data=false){
            ob_start();                      // start capturing output
            include DIR."/app/views/".$folder."/".$view.".php";   // execute the file
            $page = ob_get_contents();    // get the contents from the buffer
            ob_end_clean();
            return $page;
        }

        public function loadTemplate($folder,$template,$data=false){
            ob_start();                      // start capturing output
            include DIR."/app/templates/".$folder."/".$template.".php";   // execute the file
            $page = ob_get_contents();    // get the contents from the buffer
            ob_end_clean();
            return $page;
        }

        public function render($folder, $view, $data=false){
            if(@$_GET["section"]=='simbiosis'){
                $page=$this->loadView($folder, $view, $data);
                include_once 'app/templates/backoffice/page.php';
            }elseif(!MAINTENANCE || $this->u->isAdmin()){
                #ETIQUETAS DEL HEADER POR DEFECTO#
                if(!isset($data["page_title"])){
                    $data["page_title"]=PAGE_NAME;
                }
                if(!isset($data["meta_tags"])){
                    $data["meta_tags"]=$this->loadView("meta","meta",$data);
                }

                require_once 'app/controllers/minificar.php';
                $m = new MinificarController();
                $data["min_js"]=$m->js();
                $data["min_css"]=$m->css();

                if(isset($_SESSION["login"])){
                    if(!$this->u->getUser_activeaccount() && $this->u->vecesLogueado()==1){
                        $data["primer_login"]=$this->loadView("success","form_success","¡Bienvenido/a! Te hemos enviado un email para poder activar tu cuenta y así acceder a todas las opciones que te ofrece ".PAGE_NAME.". Si no ves el mensaje revisa la bandeja de spam o correo no deseado, puede que haya terminado ahí por error. Se paciente, puede tardar hasta 5 minutos en llegar.");
                    }elseif($this->u->getUser_activeaccount() && $this->u->vecesLogueado()==1){
                        $data["primer_login"]=$this->loadView("success","form_success","¡Bienvenido/a a ".PAGE_NAME."! ¡Ya tienes tu cuenta activada correctamente!");
                    }
                }

                $this->loadModel("carrito");
                $car = new Carrito_Model();
                $this->loadModel("categoria");
                $cat = new Categoria_Model();
                $this->loadModel("notification");
                $notify = new Notification_Model();

                $notify->to=$car->user=$this->u->id;
                $data["contador-carrito"]=$car->countCarrito();
                $data["contador-notificaciones"]=$notify->countNotificaciones();
                $lista_notificaciones=$notify->get();

                if(!$this->u->getUser_activeaccount() && isset($_SESSION["login"])){
                    $data["header_advertencia"]=$this->loadView("header","advertencia");
                }
                if(@$_GET["section"]=='store'){
                    $header=$this->loadTemplate("store", "header", $data);
                    $footer=$this->loadTemplate("store", "footer", $data);
                    $page=$this->loadView($folder, $view, $data);
                    ob_start();                      // start capturing output
                    include_once 'app/templates/store/page.php';   // execute the file
                }else{
                    $header=$this->loadTemplate("frontoffice", "header", $data);
                    $footer=$this->loadTemplate("frontoffice", "footer", $data);
                    $page=$this->loadView($folder, $view, $data);
                    ob_start();                      // start capturing output
                    include_once 'app/templates/frontoffice/page.php';   // execute the file
                }

                $html = ob_get_contents();    // get the contents from the buffer
                ob_end_clean();
                echo $this->minifyHtml($html);
            }else{
                ob_start();                      // start capturing output
                include_once 'maintenance.php';   // execute the file
                $html = ob_get_contents();    // get the contents from the buffer
                ob_end_clean();
                echo $this->minifyHtml($html);
            }
        }

        public function getIP(){
            if (isset($_SERVER["HTTP_CLIENT_IP"])){
                return $_SERVER["HTTP_CLIENT_IP"];
            }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                return $_SERVER["HTTP_X_FORWARDED_FOR"];
            }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
                return $_SERVER["HTTP_X_FORWARDED"];
            }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
                return $_SERVER["HTTP_FORWARDED_FOR"];
            }elseif (isset($_SERVER["HTTP_FORWARDED"])){
                return $_SERVER["HTTP_FORWARDED"];
            }else{
                return $_SERVER["REMOTE_ADDR"];
            }
        }

        public function getCountry(){
            $adapter     = new \Ivory\HttpAdapter\CurlHttpAdapter();
            $geocoder = new \Geocoder\Provider\IpInfoDb($adapter, '00e5547711eec5d70d9e0fa575417329cd176f88ae3af16c86a5984c1dbe2963');
            $countryCode = $geocoder->geocode($this->getIP())->get(0)->getCountryCode();
            return $countryCode;
        }

        public function getURL(){
            return PAGE_DOMAIN.$_SERVER["REQUEST_URI"];
        }

        public function format_date($datetime){
            setlocale(LC_TIME,"spanish");
            $now = date('Y-m-d H:i:s');
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $hour = date('H');
            $minute = date('i');

            $datetime_year = strftime("%Y",strtotime($datetime));
            $datetime_month = strftime("%m",strtotime($datetime));
            $datetime_day = strftime("%d",strtotime($datetime));
            $datetime_hour = strftime("%H",strtotime($datetime));
            $datetime_minute = strftime("%M",strtotime($datetime));

            $days_diff = $day - $datetime_day;
            $minutes_diff = $minute - $datetime_minute;

            if ($datetime_year == $year){ //Este año
                if (($datetime_month == $month) && ($days_diff == 0)){ //Hoy
                    if (($datetime_hour == $hour) && ($minutes_diff < 2)){
                        $datetime="Ahora mismo"; //Hoy hace menos de dos minutos
                    }else if(($datetime_hour == $hour) && ($minutes_diff < 59)){
                        $datetime="Hace ". $minutes_diff ." minutos"; //Hoy hace menos de una hora
                    }
                    else{
                        $datetime=utf8_encode(strftime("Hoy a las %H:%M",strtotime($datetime))); //Hoy hace más de una hora
                    }
                }elseif (($datetime_month == $month) && ($days_diff == 1)){
                    $datetime=utf8_encode(strftime("Ayer a las %H:%M",strtotime($datetime))); //Ayer
                }elseif (($datetime_month == $month) && ($days_diff <= 7)){
                    $datetime=utf8_encode(strftime("El %a. a las %H:%M",strtotime($datetime))); //Esta semana
                }else{
                    $datetime=utf8_encode(strftime("El %e de %b. a las %H:%M",strtotime($datetime))); //Más de una semana
                }
            }else{
                $datetime=utf8_encode(strftime("%e %b. %Y a las %H:%M",strtotime($datetime))); //Más de un año
            }
            return $datetime;
        }

        public function minifyHtml($buffer){
            $search = array(
                '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
                '/[^\S ]+\</s',  // strip whitespaces before tags, except space
                '/(\s)+/s'       // shorten multiple whitespace sequences
            );

            $replace = array(
                '>',
                '<',
                '\\1'
            );

            $buffer = preg_replace($search, $replace, $buffer);

            return $buffer;
        }

        public function minifyCss($folder, $file){
            require_once 'min/utils.php';
            $css="app/views/".$folder."/".$file.".css";
            $cssUri = Minify_getUri([$css]);
            return "<link rel=stylesheet href='{$cssUri}'>";
        }

        public function minifyJs($folder, $file){
            require_once 'min/utils.php';
            $js="app/views/".$folder."/".$file.".js";
            $jsUri = Minify_getUri([$js]);
            return "<script src='{$jsUri}'></script>";
        }

        public function cutText($text,$num){
            if(strlen($text)>$num){
                return substr ($text, 0, $num)."...";
            }else{
                return $text;
            }
        }

        public function rmrf($source){
            foreach(glob($source."/*.*") as $archivos_carpeta){
                unlink($archivos_carpeta);
            }
            rmdir($source);
        }

        public function write_log($cadena, $type=false)
        {
            $arch = fopen(realpath( '.' )."/logs/".date("Y-m-d").".txt", "a+");

            fwrite($arch, "[".date("Y-m-d H:i:s.u")." - ".$type." - ".$_SERVER['REMOTE_ADDR']."] ".$cadena."\n");
            fclose($arch);
        }
    }
?>
