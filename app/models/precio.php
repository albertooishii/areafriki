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
                if($this->vendedor===0){
                    $total_af+=$precio;
                    if($total_af<MIN_ENVIO_GRATIS){
                        $this->gastos_envio+=GASTOS_ENVIO;
                    }
                }
                $this->subtotal+=$precio;
                $this->gastos_envio+=$this->getGastosEnvio();
            }
            $this->precio_total=$this->subtotal+$this->gastos_envio;
        }

        function getGastosEnvio(){
            if($this->vendedor===0){
                return 0;
            }else{
                $query = "SELECT gastos_envio FROM productos WHERE id= ".$this->producto;
                $answer = $this->_db->query($query)->fetch_assoc();
                return $answer["gastos_envio"];
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
