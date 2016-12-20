<?php
    require_once 'app/helpers/database.php';

    class Referer_Model extends Database{

        var $precio, $referral;

        function __construct(){
            parent::__construct();
            setcookie("referral", '', strtotime('-1 days'), '/');
            setcookie("referral", $_GET["ref"], strtotime('+1 days'), '/');
            header('Location: '.PAGE_DOMAIN.parse_url(PAGE_DOMAIN.$_SERVER["REQUEST_URI"])["path"]);
        }

// Lectura-----------------------------------------------------//

        function getComision()
        {
            //Primero miramos si el referral es un usuario
            $query="SELECT id, comision_referer FROM users WHERE user='$this->referral'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){ //Es un usuario
                $info_comision["id"]=$answer["id"];
                $porcentaje=$answer["comision_referer"];
                if($porcentaje==NULL){ //Si el usuario no es premium
                    $porcentaje=COMISION_REFERER;
                }
                $info_comision["comision"]=$porcentaje/100*$this->precio;
                return $info_comision;
            }else{
                return false;
            }
        }
    }
?>
