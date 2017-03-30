<?php
    require_once 'app/helpers/database.php';

    class Promo_code_Model extends Database{

        var $token, $descripcion, $caducidad, $total_usos, $veces_usado, $producto, $categoria, $tienda, $vendedor, $topic, $tag, $porcentaje_desc, $cantidad_desc, $gastos_envio;

        function __construct(){
            parent::__construct();
            if(isset($_GET["promo"])){
                $this->token=$_GET["promo"];
                if($this->getPromo()){
                    setcookie("promo", '', strtotime('-1 days'), '/');
                    setcookie("promo", $_GET["promo"], strtotime($this->caducidad), '/'); 
                    //header('Location: '.PAGE_DOMAIN.parse_url(PAGE_DOMAIN.$_SERVER["REQUEST_URI"])["path"]);
                    header('Location: '.PAGE_DOMAIN);
                }
            }
        }

// Lectura-----------------------------------------------------//

        function getPromo()
        {
            //Primero miramos si el referral es un usuario
            $query="SELECT * FROM promo_code WHERE token='$this->token'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){ //Es un usuario
                $this->descripcion=$answer["descripcion"];
                $this->caducidad=$answer["caducidad"];
                $this->total_usos=$answer["total_usos"];
                $this->veces_usado=$answer["veces_usado"];
                $this->producto=$answer["producto"];
                $this->categoria=$answer["categoria"];
                $this->tienda=$answer["tienda"];
                $this->vendedor=$answer["vendedor"];
                $this->topic=$answer["topic"];
                $this->tag=$answer["tag"];
                $this->porcentaje_desc=$answer["porcentaje_desc"];
                $this->cantidad_desc=$answer["cantidad_desc"];
                $this->gastos_envio=$answer["gastos_envio"];
                return true;
            }else{
                return false;
            }
        }
    }
?>
