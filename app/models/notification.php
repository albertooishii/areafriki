<?php
    require_once 'app/helpers/database.php';

    class Notification_Model extends Database{

        var $fecha, $to, $from, $producto, $titulo, $texto, $url, $tipo, $class, $visto, $leido;

        function __construct(){
           parent::__construct();
        }

        //Funciones de lectura
        function get()
        {
            $query="SELECT * FROM notificaciones WHERE to_user='$this->to' AND leido=0 ORDER BY fecha DESC";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $this->fecha=$fila["fecha"];
                    $this->setVisto();
                    $lista_notificaciones[]=$fila;
                }
                if(!empty($lista_notificaciones)){
                    return $lista_notificaciones;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getNews()
        {
            $query="SELECT * FROM notificaciones WHERE to_user='$this->to' AND visto=0";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $this->fecha=$fila["fecha"];
                    $this->setVisto();
                    $lista_notificaciones[]=$fila;
                }
                if(!empty($lista_notificaciones)){
                    return $lista_notificaciones;
                }else{
                    return false;
                }
            }
            return false;
        }

        function countNotificaciones()
        {
            $query="SELECT count(*) as count FROM notificaciones WHERE to_user='$this->to' AND leido=0";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["count"];
        }

        //Funciones de escritura
        function set()
        {
            if($this->to!=$this->from){
                $this->fecha=date ("Y-m-d H:i:s");
                if(!empty($this->class)){
                    $query="INSERT INTO notificaciones (fecha, to_user, from_user, producto, title, text, url, class, tipo) VALUES ('$this->fecha', '$this->to', '$this->from', '$this->producto', '$this->titulo', '$this->texto', '$this->url', '$this->class', '$this->tipo')";
                }else{
                    $query="INSERT INTO notificaciones (fecha, to_user, from_user, producto, title, text, url, tipo) VALUES ('$this->fecha', '$this->to', '$this->from', '$this->producto', '$this->titulo', '$this->texto', '$this->url', '$this->tipo')";
                }
                if ( $this->_db->query($query) )
                return true;
                return false;
            }else{
                return false;
            }
        }

        //Funciones de actualizado
        function setVisto()
        {
            $query="UPDATE notificaciones SET visto=1 WHERE to_user='$this->to' AND fecha='$this->fecha'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function setLeido()
        {
            if(!empty($this->fecha)){
                $query="UPDATE notificaciones SET leido=1 WHERE to_user='$this->to' AND fecha='$this->fecha'";
            }else{
                $query="UPDATE notificaciones SET leido=1 WHERE to_user='$this->to'";
            }
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        //Funciones de borrado
        function clear()
        {
            if(!empty($this->fecha)){
                $query="DELETE FROM notificaciones WHERE to_user='$this->to' AND fecha='$this->fecha'";
            }else{
                $query="DELETE FROM notificaciones WHERE to_user='$this->to'";
            }
            if ( $this->_db->query($query) )
            return true;
            return false;
        }
    }
?>
