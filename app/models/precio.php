<?php
    require_once 'app/helpers/database.php';

    class Precio_Model extends Database{

        var $pedido, $producto, $beneficio, $categoria, $precio_base, $modelo, $codigo, $valor;

        function __construct(){
           parent::__construct();
        }

        function get()
        {
            $query = "SELECT beneficio, categoria FROM productos WHERE id= ".$this->producto;
            $answer = $this->_db->query($query)->fetch_assoc();
            $beneficio=$answer["beneficio"];
            if($this->categoria==2 || $this->categoria==30){
                $precio_base=$beneficio*7.5/100;
            }elseif(empty($this->modelo)){
                $query = "SELECT precio_base FROM categorias WHERE id=".$answer["categoria"];
                $answer = $this->_db->query($query)->fetch_assoc();
                $precio_base=$answer["precio_base"];
            }else{
                $precio_base=$this->getPrecioBaseModelo();
            }
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

        function getPrecioBaseModelo()
        {
            if(!isset($this->codigo)){
                 $query = "SELECT precio_base FROM valores WHERE atributo=(SELECT id FROM atributos WHERE nombre='$this->modelo' AND categoria=$this->categoria) AND orden = 1";
            }else{
                $query = "SELECT precio_base FROM valores WHERE atributo=(SELECT id FROM atributos WHERE nombre='$this->modelo' AND categoria=$this->categoria) AND codigo='$this->codigo'";
            }
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["precio_base"];
        }

        function getPrecioBaseSize($orden)
        {
            $query = "SELECT precio_base FROM valores WHERE atributo=(SELECT id FROM atributos WHERE tipo='size' AND categoria=$this->categoria) AND orden = $orden";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["precio_base"];
        }

        function getBeneficioValor($orden)
        {
            $query = "SELECT beneficio FROM beneficio_valor WHERE valor IN (SELECT id FROM valores WHERE orden=$orden) AND producto=$this->producto";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["beneficio"];
        }
    }
?>
