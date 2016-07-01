<?php
    require_once 'app/helpers/database.php';

    class Pedido_Model extends Database{

        var $pedido, $token, $linea, $cantidad, $producto, $size, $color;

        function __construct(){
           parent::__construct();
        }

        function get()
        {
            $query = "SELECT * FROM carritos WHERE user= ".$this->user;
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        function set()
        {
            $fecha=date ("Y-m-d H:i:s");
            $query="INSERT INTO carritos (token, pedido, user, fecha) VALUES('$this->token', '$this->pedido', '$this->user', '$fecha') ON DUPLICATE KEY UPDATE pedido='$this->pedido', fecha='$fecha'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function update()
        {
            $fecha=date ("Y-m-d H:i:s");
            $query="UPDATE carritos SET pedido='$this->pedido', fecha='$fecha' WHERE user='$this->user'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function delete(){
            $query="DELETE FROM carritos WHERE user='".$this->user."'";
             if ( $this->_db->query($query) )
            return true;
            return false;
        }

    }
?>
