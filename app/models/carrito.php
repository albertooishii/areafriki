<?php
    require_once 'app/helpers/database.php';

    class Carrito_Model extends Database{

        var $id, $token, $pedido, $user, $linea, $cantidad, $vendedor;

        function __construct(){
           parent::__construct();
        }

        function get()
        {
            if(!is_null($this->vendedor)){
                if(isset($_SESSION["login"]) || !empty($this->user)){
                    $query = "SELECT * FROM carritos WHERE vendedor=$this->vendedor AND user= ".$this->user;
                }elseif(isset($_COOKIE["PHPSESSID"])){
                    $query = "SELECT * FROM carritos WHERE vendedor=$this->vendedor AND phpsessid= '".$_COOKIE["PHPSESSID"]."'";
                }
            }elseif(!empty($this->token)){
                $query = "SELECT * FROM carritos WHERE token='$this->token'";
            }
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                return $answer;
            }else{
                return false;
            }
        }

        function getCarritosUser()
        {
            if(isset($_SESSION["login"]) || !empty($this->user)){
                $query = "SELECT * FROM carritos WHERE user= $this->user ORDER BY vendedor ASC";
                if($answer=$this->_db->query($query)){
                    while($fila = $answer->fetch_assoc()){
                        $lista_carritos[]=$fila;
                    }
                    if(!empty($lista_carritos)){
                        return $lista_carritos;
                    }else{
                        return false;
                    }
                }
                return false;
            }elseif(isset($_COOKIE["PHPSESSID"])){
                $query = "SELECT * FROM carritos WHERE phpsessid= '".$_COOKIE["PHPSESSID"]."' ORDER BY vendedor ASC";
                if($answer=$this->_db->query($query)){
                    while($fila = $answer->fetch_assoc()){
                        $lista_carritos[]=$fila;
                    }
                    if(!empty($lista_carritos)){
                        return $lista_carritos;
                    }else{
                        return false;
                    }
                }
                return false;
            }else{
                return false;
            }
        }

        function add()
        {
            $this->pedido = array();
            $contador=$sw=0;

            //Comprobamos si ya existe un carrito de este vendedor
            if($carrito=$this->get()){ //recogemos los datos de este carrito
                $this->pedido=unserialize($carrito["pedido"]);

                foreach($this->pedido as $linea){ //recorremos el pedido para comprobar si hay un elemento igual
                    if($linea["producto"] == $this->linea["producto"] && $linea["size"]==$this->linea["size"] && $linea["color"]==$this->linea["color"] && $linea["nota"]==$this->linea["nota"]){ //si hay uno igual sumamos a la cantidad
                        $this->pedido[$contador]["cantidad"]+=$this->linea["cantidad"];
                        $sw=1;
                    }
                    $contador++;
                }
                $this->token=$carrito["token"];
            }else{ //Si no existe un carrito de este vendedor
                $this->genera_token();
            }
            if($sw==0){ //si no hay ninguno igual añadimos la línea al final del array
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
            $fecha_pedido=date ("Y-m-d H:i:s");
            $pedido=serialize($this->pedido);
            if(empty($this->user)){$user='NULL';}else{$user=$this->user;}
            $query="INSERT INTO carritos (token, vendedor, user, phpsessid, pedido, fecha) VALUES('$this->token', $this->vendedor, $user, '".$_COOKIE["PHPSESSID"]."', '$pedido', '$fecha_pedido') ON DUPLICATE KEY UPDATE pedido= '$pedido', fecha='$fecha_pedido'";

            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function setInfoEnvio()
        {
            $query="UPDATE carritos SET name='$this->name', email='$this->email', address='$this->address', cp='$this->cp', provincia='$this->provincia', localidad='$this->localidad', phone='$this->phone', nota='$this->nota' WHERE token='$this->token'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function update()
        {
            $fecha=date ("Y-m-d H:i:s");
            $query="UPDATE carritos SET pedido='".serialize($this->pedido)."', fecha='$fecha' WHERE token='$this->token'";

            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function delete(){
            if(!is_null($this->vendedor)){
                if(isset($_SESSION["login"])){
                    $query="DELETE FROM carritos WHERE vendedor=$this->vendedor AND user='".$this->user."'";
                }else{
                    $query = "DELETE FROM carritos WHERE vendedor=$this->vendedor AND phpsessid= '".$_COOKIE["PHPSESSID"]."'";
                }
            }elseif(!empty($this->token)){
                $query = "DELETE FROM carritos WHERE token='$this->token'";
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
            if($carritos=$this->getCarritosUser()){
                $contador=0;
                foreach($carritos as $carrito){
                    $this->pedido=unserialize($carrito["pedido"]);
                    foreach($this->pedido as $linea){
                        $contador+=$linea["cantidad"];
                    }
                }
                return $contador;
            }else{
                return 0;
            }
        }

        function asignar(){
            if(!$this->getCarritosUser()){
                $query = "UPDATE carritos SET user = '$this->user' WHERE phpsessid= '".$_COOKIE["PHPSESSID"]."'";
                if ( $this->_db->query($query) )
                return true;
                return false;
            }else{
                return true;
            }
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
