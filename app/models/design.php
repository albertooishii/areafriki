<?php
    require_once 'app/helpers/database.php';

    class Design_Model extends Database{

        var $nombre, $token, $categoria, $user, $publi;

        function __construct(){
           parent::__construct();
        }

// Lectura-----------------------------------------------------//

        function get()
        {
            $query = "SELECT * FROM designs WHERE token = '$this->token'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        function getAllDesigns()
        {
            $query = "SELECT * FROM designs";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_designs[]=$fila;
                }
                if(!empty($lista_designs)){
                    return $lista_designs;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getMyDesigns()
        {
            $query = "SELECT * FROM designs WHERE user = $this->user AND token NOT IN (SELECT design FROM productos WHERE categoria=$this->categoria)";
            //echo $query;
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_designs[]=$fila;
                }
                if(!empty($lista_designs)){
                    return $lista_designs;
                }else{
                    return false;
                }
            }
            return false;
        }
// Escritura -----------------------------------------------------//

        function set(){
            $fecha=date('Y-m-d H:i:s');
            $query = "INSERT INTO designs(token, user, fecha, publi) VALUES ('".$this->token."','".$this->user."', '".$fecha."', '".$this->publi."')";
            if ($this->_db->query($query)){
                return true;
            }else{
                return false;
            }
        }

        function genera_token() {
            $chars = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M','N','O','P','Q', 'R','S','T','U','V','W','X','Y','Z');

            $long = 6;

            $this->token = '';
            for($i = 0; $i < $long; $i++) {
                $this->token .= $chars[rand(0, count($chars)-1)];
            }

            // Ahora consultas si ya existe.
            // Si existe, vuelves a llamar a la funcion

            $query = "SELECT * FROM designs WHERE token = '$this->token'";

            $answer = $this->_db->query($query)->fetch_row();
            if ($answer!=NULL){
                return genera_token();
            }
        }

    }
?>
