<?php
    require_once 'app/helpers/database.php';

    class Referer_Model extends Database{

        var $precio, $referral, $comision;

        function __construct(){
            parent::__construct();
            if(isset($_GET["ref"])){
                setcookie("referral", '', strtotime('-1 days'), '/');
                setcookie("referral", $_GET["ref"], strtotime('+1 days'), '/');
                header('Location: '.PAGE_DOMAIN.parse_url(PAGE_DOMAIN.$_SERVER["REQUEST_URI"])["path"]);
            }
        }

// Lectura-----------------------------------------------------//

        function getComision()
        {
            //Primero miramos si el referral es un usuario
            $query="SELECT user, comision_referer FROM users WHERE id='$this->referral'";
            error_log ($query);
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){ //Es un usuario
                $porcentaje=$answer["comision_referer"];
                if($porcentaje==NULL){ //Si el usuario no es premium
                    $porcentaje=COMISION_REFERER;
                }
                $this->comision=$porcentaje/100*$this->precio;
                return true;
            }else{
                return false;
            }
        }
        
        function addComision()
        {
            error_log ("estoy aqui");
            if($this->getComision()){
                $query = "UPDATE users SET credit=credit+$this->comision WHERE id='$this->referral'";
                if ( $this->_db->query($query) ){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        
        function removeReferrer()
        {
            setcookie("referral", '', strtotime('-1 days'), '/');
        }
    }
?>
