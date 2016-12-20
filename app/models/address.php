<?php
    require_once 'app/helpers/database.php';

    class Address_Model extends Database{
        var $id, $nombre;

        function __construct(){
           parent::__construct();
        }

        //Pais
        function getPaises(){
            $query="SELECT * FROM paises ORDER BY nombre ASC";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_paises[]=$fila;
                }
                if(!empty($lista_paises)){
                    return $lista_paises;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getNombrePais(){
            $query="SELECT nombre FROM paises WHERE id=$this->id";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer["nombre"];
            return false;
        }

        //Provincias
        function getProvincias(){
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

        function getNombreProvincia(){
            $query="SELECT nombre FROM provincias WHERE id=$this->id";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer["nombre"];
            return false;
        }

    }
?>
