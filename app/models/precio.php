<?php
    require_once 'app/helpers/database.php';

    class Precio_Model extends Database{

        var $pedido, $producto, $beneficio, $categoria, $precio_base, $modelo, $codigo, $valor;

        function __construct(){
           parent::__construct();
        }

        function get($orden=false)
        {
            //primero hayamos el beneficio
            $beneficio=$this->getBeneficio($orden);

            //segundo hayamos el precio base
            $precio_base=$this->getPrecioBase($orden);

            //devolvemos la suma
            return $precio_base + $beneficio;
        }

        function getPrecioPedido()
        {
            $precio=0;
            foreach($this->pedido as $linea){
                $this->producto=$linea["producto"];
                $this->modelo=NULL;
                if(!empty($this->producto["modelo"])){
                    $this->modelo=$this->producto["modelo"];
                    $this->categoria=$this->producto["categoria"];
                    $this->codigo=$this->producto["size"];
                }
                $precio+=$this->get();
            }
            return $precio;
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
                $precio_base=$this->getBeneficio()*7.5/100;
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
            $query = "SELECT precio_base FROM valores WHERE atributo=(SELECT id FROM atributos WHERE tipo='size' AND categoria=$this->categoria) AND orden = $orden";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["precio_base"];
        }
    }
?>
