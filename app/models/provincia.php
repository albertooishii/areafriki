<?php
    require_once 'app/helpers/database.php';

    class Provincia_Model extends Database{
        var $id, $nombre;

        function __construct(){
           parent::__construct();
        }

        function get(){
            $query="SELECT * FROM provincias";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_provincias[]=$fila;
                }
                if(!empty($lista_provincias)){
                    return $lista_provincias;
                }else{
                    return false;
                }
            }
            return false;
        }

    }
?>
