<?php
    putenv("TZ=".TIMEZONE);
    date_default_timezone_set(TIMEZONE);
    ini_set('date.timezone', TIMEZONE);
    
    require_once 'app/helpers/database.php';
    //date_default_timezone_set('Europe/Madrid');

    class Promo_Model extends Database{

        var $id, $descripcion, $producto, $categoria, $tienda, $query, $porcentaje_desc, $cantidad_desc, $token, $fecha_inicio, $caducidad, $max_usos, $veces_usado, $colaborador, $tipo;

        function __construct(){
            parent::__construct();
            if(isset($_GET['promo'])){
                $this->token=$_GET['promo'];
                if($this->getPromo()){
                    setcookie('promo', '', strtotime('-1 days'), '/');
                    setcookie('promo', $_GET['promo'], strtotime($this->caducidad), '/'); 
                    //header('Location: '.PAGE_DOMAIN.parse_url(PAGE_DOMAIN.$_SERVER['REQUEST_URI'])['path']);
                    header('Location: '.PAGE_DOMAIN);
                }
            }
        }

// Lectura-----------------------------------------------------//

        function getPromoById()
        {
            $query="SELECT * FROM promo WHERE id='$this->id'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                foreach($answer as $key => $value) {
                    $this->$key = $value;
                }
                return true;
            }else{
                return false;
            }
        }

        function getProductPromo()
        {
            $now = date ("Y-m-d H:i:s");
            $query="SELECT * FROM promo WHERE producto='$this->producto' AND fecha_inicio <= '$now' AND caducidad > '$now'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                foreach($answer as $key => $value) {
                    $this->$key = $value;
                }
                return true;
            }else{
                return false;
            }
        }

        function getNowPromo()
        {
            $now = date ("Y-m-d H:i:s");
            $query="SELECT * FROM promo WHERE tipo = '$this->tipo' AND fecha_inicio <= '$now' ORDER BY fecha_inicio ASC limit 1";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                foreach($answer as $key => $value) {
                    $this->$key = $value;
                }
                return true;
            }else{
                return false;
            }
        }

        function getNextPromo()
        {
            $now = date ("Y-m-d H:i:s");
            $query="SELECT * FROM promo WHERE tipo = '$this->tipo' AND fecha_inicio > '$now' ORDER BY fecha_inicio ASC limit 1";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                foreach($answer as $key => $value) {
                    $this->$key = $value;
                }
                return true;
            }else{
                return false;
            }
        }

        function getPromoByDateAndType()
        {
            $query="SELECT * FROM promo WHERE fecha_inicio >= '$this->fecha_inicio' AND caducidad <= '$this->caducidad' AND tipo = '$this->tipo'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                foreach($answer as $key => $value) {
                    $this->$key = $value;
                }
                return true;
            }else{
                return false;
            }
        }

        function getPromosByCategoria()
        {
            $query="SELECT * FROM promo WHERE categoria='$this->categoria'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                foreach($answer as $key => $value) {
                    $this->$key = $value;
                }
                return true;
            }else{
                return false;
            }
        }

        function getPromosByQuery()
        {
            $query="SELECT * FROM promo WHERE query='$this->query'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                foreach($answer as $key => $value) {
                    $this->$key = $value;
                }
                return true;
            }else{
                return false;
            }
        }

        function getPromoByToken()
        {
            $query="SELECT * FROM promo WHERE token='$this->token'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){ 
                foreach($answer as $key => $value) {
                    $this->$key = $value;
                }
                return true;
            }else{
                return false;
            }
        }
    }
?>
