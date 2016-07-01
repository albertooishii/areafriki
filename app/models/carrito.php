<?php
    require_once 'app/helpers/database.php';

    class Carrito_Model extends Database{

        var $id, $token, $pedido, $user, $linea, $cantidad;

        function __construct(){
           parent::__construct();
        }

        function get()
        {
            if(isset($_SESSION["login"])){
                $query = "SELECT * FROM carritos WHERE user= ".$this->user;
                $answer = $this->_db->query($query)->fetch_assoc();
                if ($answer!=NULL)
                return $answer;
                return false;
            }elseif(isset($_COOKIE["PHPSESSID"])){
                $query = "SELECT * FROM carritos WHERE phpsessid= '".$_COOKIE["PHPSESSID"]."'";
                $answer = $this->_db->query($query)->fetch_assoc();
                if ($answer!=NULL)
                return $answer;
                return false;
            }else{
                return false;
            }

        }

        function add()
        {
            $this->pedido = array();
            $carrito=$this->get(); //recogemos los datos del carrito actual
            $this->pedido=unserialize($carrito["pedido"]);
            $contador=$sw=0;
            if(!empty($this->pedido)){
                foreach($this->pedido as $linea){ //recorremos el pedido para comprobar si hay un elemento igual
                    if($linea["producto"] == $this->linea["producto"] && $linea["size"]==$this->linea["size"] && $linea["color"]==$this->linea["color"]){ //si hay uno igual sumamos a la cantidad
                        $this->pedido[$contador]["cantidad"]+=$this->linea["cantidad"];
                        $sw=1;
                    }
                    $contador++;
                }
            }
            if($sw==0){ //si no hay ninguno igual añadimos la línea al final del array del pedido
                //array_push($this->pedido, $this->linea);
                $this->pedido[]=$this->linea;
            }

            if($this->set()){ //guardamos los cambios al carrito
                return true;
            }else{
                return false;
            }
        }

        function editCantidad()
        {
            $this->pedido = array();
            $carrito=$this->get(); //recogemos los datos del carrito actual
            $this->pedido=unserialize($carrito["pedido"]);
            $this->pedido[$this->linea]["cantidad"]=$this->cantidad;

            if($this->set()){ //guardamos los cambios al carrito
                return true;
            }else{
                return false;
            }
        }

        function set()
        {
            $fecha=date ("Y-m-d H:i:s");
            $this->genera_token();
            $pedido=serialize($this->pedido);
            $query="INSERT INTO carritos (phpsessid, token, pedido, user, fecha) VALUES('".$_COOKIE["PHPSESSID"]."', '$this->token', '$pedido', '$this->user', '$fecha') ON DUPLICATE KEY UPDATE pedido= '$pedido', fecha='$fecha'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function update()
        {
            $fecha=date ("Y-m-d H:i:s");
            if(isset($_SESSION["login"])){
                $query="UPDATE carritos SET pedido='".serialize($this->pedido)."', fecha='$fecha' WHERE user='$this->user'";
            }else{
                $query="UPDATE carritos SET pedido='".serialize($this->pedido)."', fecha='$fecha' WHERE phpsessid= '".$_COOKIE["PHPSESSID"]."'";
            }

            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function delete(){
            if(isset($_SESSION["login"])){
                $query="DELETE FROM carritos WHERE user='".$this->user."'";
            }else{
                $query = "DELETE FROM carritos WHERE phpsessid= '".$_COOKIE["PHPSESSID"]."'";
            }
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function removeLinea(){
            $carrito=$this->get(); //recogemos los datos del carrito actual
            $this->pedido=unserialize($carrito["pedido"]);
            $contador=$sw=0;

            unset($this->pedido[$this->linea]);
            $this->pedido = array_values($this->pedido);

            if($this->update()){ //guardamos los cambios al carrito
                if(empty($this->pedido)){
                    $this->delete();
                }
                return true;
            }else{
                return false;
            }
        }

        function countCarrito(){
            $carrito=$this->get();
            $this->pedido=unserialize($carrito["pedido"]);
            $contador=0;
            if(!empty($this->pedido)){
                foreach($this->pedido as $linea){
                    $contador+=$linea["cantidad"];
                }
            }
            return $contador;
        }

        function genera_token() {
            $chars = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M','N','O','P','Q', 'R','S','T','U','V','W','X','Y','Z');

            $long = 6;

            $token = '';
            for($i = 0; $i < $long; $i++) {
                $token .= $chars[rand(0, count($chars)-1)];
            }
            $this->token="AF".$token;
            // Ahora consultas si ya existe.
            // Si existe, vuelves a llamar a la funcion

            $query = "SELECT * FROM carritos WHERE token = '$this->token'";

            $answer = $this->_db->query($query)->fetch_row();
            if ($answer!=NULL){
                return genera_token();
            }
        }

    }
?>
