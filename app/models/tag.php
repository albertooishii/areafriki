<?php
    require_once 'app/helpers/database.php';

    class Tag_Model extends Database{

        var $id, $nombre;

        function __construct(){
           parent::__construct();
        }

        // Read functions-----------------------------------------------------//

        // Leer tags
        function getTags()
        {
            $query = "SELECT nombre, activa FROM tags";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_tags[]=$fila;
                }
                return $lista_tags;
            }
            return false;
        }

        function getActiveTags()
        {
            $query = "SELECT nombre FROM tags WHERE activa=1";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_tags[]=$fila;
                }
                return $lista_tags;
            }
            return false;
        }

        function getActiveTagsQuery($string)
        {
            $query = "SELECT nombre FROM tags WHERE activa=1 AND nombre LIKE '%$string%'";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_tags[]=str_replace("-", " ",$fila);
                }
                if(!empty($lista_tags)){
                    return $lista_tags;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getPopularTags($limit=false){
            if($limit){
                $query = "SELECT tag, count(tag) as count FROM producto_tag WHERE tag IN (SELECT nombre FROM tags WHERE activa=1) AND producto IN (SELECT id FROM productos  WHERE revisado=1 AND active=1) GROUP BY tag ORDER BY count DESC LIMIT $limit";
            }else{
                 $query = "SELECT tag, count(tag) as count FROM producto_tag WHERE tag IN (SELECT nombre FROM tags WHERE activa=1) AND producto IN (SELECT id FROM productos  WHERE revisado=1 AND active=1) GROUP BY tag ORDER BY count DESC";
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_tags[]=$fila;
                }
                return $lista_tags;
            }
            return false;
        }

        function set()
        {
            $query="INSERT INTO tags(nombre) VALUES('$this->nombre')";
            if ( $this->_db->query($query) )
            //return mysqli_insert_id($this->_db);
            return true;
            return false;
        }

        function activateTag()
        {
            $query="UPDATE tags SET activa=1 WHERE nombre='$this->nombre'";
            if ( $this->_db->query($query) )
            //return mysqli_insert_id($this->_db);
            return true;
            return false;
        }

        function delete(){
            $query="DELETE FROM tags WHERE nombre='".$this->nombre."'";
             if ( $this->_db->query($query) )
            return true;
            return false;
        }

    }
?>
