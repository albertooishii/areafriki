<?php
    require_once 'app/helpers/database.php';

    class Precio_Model extends Database{

        var $pedido, $producto, $beneficio, $categoria, $precio_base, $modelo, $codigo, $valor, $vendedor, $subtotal, $gastos_envio, $precio_total;

        function __construct(){
           parent::__construct();
        }

        function get($orden=false)
        {
            //primero hayamos el beneficio
            $this->beneficio=$this->getBeneficio($orden);

            //segundo hayamos el precio base
            $this->precio_base=$this->getPrecioBase($orden);

            //devolvemos la suma
            return $this->precio_base + $this->beneficio;
        }

        function getPrecioPedido()
        {
            $precio=$total_af=0;
            foreach($this->pedido as $linea){
                $this->producto=$linea["producto"];
                $query = "SELECT categoria FROM productos WHERE id= ".$this->producto;
                $answer = $this->_db->query($query)->fetch_assoc();
                $this->categoria=$answer["categoria"];
                $orden=$linea["size"];
                $precio=$this->get($orden)*$linea["cantidad"];
                $this->subtotal+=$precio;
            }
            $this->getGastosEnvio();
            $this->precio_total=$this->subtotal+$this->gastos_envio;
        }

        function getGastosEnvio(){
            $sw=0;
            foreach($this->pedido as $linea){
                $query = "SELECT gastos_envio FROM productos WHERE id= ".$linea["producto"];
                $answer = $this->_db->query($query)->fetch_assoc();
                if(!is_null($answer["gastos_envio"])){
                    $sw=1;
                    $this->gastos_envio+=$answer["gastos_envio"];
                }
            }
            if($sw==0){
                if($this->subtotal<MIN_ENVIO_GRATIS){
                    $this->gastos_envio=GASTOS_ENVIO;
                }else{
                    $this->gastos_envio=0;
                } 
            }
        }

        function getBeneficio($orden=false)
        {
            if($orden==false){$orden=1;}
            $query = "SELECT beneficio, categoria FROM productos WHERE id= ".$this->producto;
            $answer = $this->_db->query($query)->fetch_assoc();
            if($answer["beneficio"]==NULL){
                $query = "SELECT beneficio FROM beneficio_valor WHERE valor IN (SELECT id FROM valores WHERE orden=$orden) AND producto=$this->producto";
                $answer = $this->_db->query($query)->fetch_assoc();
            }
            return $answer["beneficio"];
        }

        function getPrecioBase($orden=false){
            if($this->categoria==2 || $this->categoria==30){
                //$precio_base=$this->getBeneficio();
                $precio_base=0;
            }else{
                if(!$precio_base=$this->getPrecioBaseCategoria()){
                    if(!$precio_base=$this->getPrecioBaseSize($orden)){
                        $precio_base=$this->getPrecioBaseModelo();
                    }
                }
            }
            return $precio_base;
        }

//FUNCIONES PRIVADAS INTERNAS

        private function getPrecioBaseCategoria()
        {
            $query = "SELECT precio_base FROM categorias WHERE id=$this->categoria";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["precio_base"];
        }

        private function getPrecioBaseModelo()
        {
            if(!isset($this->codigo)){
                 $query = "SELECT precio_base FROM valores WHERE atributo=(SELECT id FROM atributos WHERE nombre='$this->modelo' AND categoria=$this->categoria) AND orden = 1";
            }else{
                $query = "SELECT precio_base FROM valores WHERE atributo=(SELECT id FROM atributos WHERE nombre='$this->modelo' AND categoria=$this->categoria) AND codigo='$this->codigo'";
            }
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["precio_base"];
        }

        private function getPrecioBaseSize($orden=false)
        {
            if($orden==false){$orden=1;}
            $query = "SELECT precio_base FROM valores WHERE atributo=(SELECT id FROM atributos WHERE tipo='size' AND categoria=$this->categoria) AND orden = '$orden'";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["precio_base"];
        }
    }
?>
