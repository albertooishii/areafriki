<?php
    require_once 'app/helpers/database.php';

    class Categoria_Model extends Database{

        var $id, $nombre, $descripcion, $descripcion_corta, $precio_base, $precio_tope, $parent, $orden, $atributo, $valor, $valor_id, $nombre_attr, $tipo_attr, $codigo_valor, $beneficio;

        function __construct(){
           parent::__construct();
        }

        // Read functions-----------------------------------------------------//

        // Leer categorias
        function getCategorias($tipo=false)
        {
            $filter="";
            if(!empty($tipo)){
                $filter=" AND tipo='$tipo' ";
            }
            
            $query = "SELECT id, nombre, descripcion, descripcion_corta, precio_base, beneficio, parent, orden FROM categorias WHERE visible=1 $filter ORDER BY orden ASC";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_categorias[]=$fila;
                }
                return $lista_categorias;
            }
            return false;
        }


        function get()
        {
            $query = "SELECT * FROM categorias WHERE id= ".$this->id;
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        function getWhereNombre()
        {
            $query = "SELECT * FROM categorias WHERE nombre= '".$this->nombre."'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        function getParent(){
            $query = "SELECT * FROM categorias WHERE id= ".$this->parent;
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        function getParents()
        {
            $query = "SELECT id, nombre, descripcion, descripcion_corta FROM categorias WHERE parent IS NULL";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_categorias[]=$fila;
                }
                return $lista_categorias;
            }
            return false;
        }

        function getChilds($param='enabled', $tipo=false)
        {
            //$param: 'all', 'enabled', 'disabled'
            $filter="";
            if(!empty($tipo)){
                $filter=" AND tipo='$tipo' ";
            }

            switch($param){
                case 'all':
                    $query = "SELECT id, nombre, descripcion, descripcion_corta, precio_base, beneficio, orden, visible FROM categorias WHERE parent = ".$this->parent." $filter ORDER by orden ASC";
                break;

                case 'disabled':
                    $query = "SELECT id, nombre, descripcion, descripcion_corta, precio_base, beneficio, orden, visile FROM categorias WHERE visible=0 AND parent = ".$this->parent." $filter ORDER by orden ASC";
                break;

                default:
                    $query = "SELECT id, nombre, descripcion, descripcion_corta, precio_base, beneficio, orden, visible FROM categorias WHERE visible=1 AND parent = ".$this->parent." $filter ORDER by orden ASC";
            }
//echo $query;
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_categorias[]=$fila;
                }
                if(!empty($lista_categorias)){
                    return $lista_categorias;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getAtributos($tipo=false)
        {
            if($tipo){
                $query = "SELECT id, nombre, tipo, orden FROM atributos WHERE tipo='$tipo' AND categoria=".$this->id;
            }else{
                $query = "SELECT id, nombre, tipo, orden FROM atributos WHERE categoria=".$this->id;
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_atributos[]=$fila;
                }
                if(!empty($lista_atributos)){
                    return $lista_atributos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getAtributo()
        {
            $query = "SELECT categoria, nombre, tipo, orden FROM atributos WHERE id=".$this->atributo;
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        function getValores()
        {
            $query = "SELECT id, valor, codigo, precio_base, beneficio, orden FROM valores WHERE atributo=".$this->atributo;
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_valores[]=$fila;
                }
                if(!empty($lista_valores)){
                    return $lista_valores;
                }else{
                    return false;
                }
            }
        }

        function getValoresByTipo()
        {
            $query = "SELECT id, codigo, valor, precio_base, beneficio, orden FROM valores WHERE atributo = (SELECT id FROM atributos WHERE categoria=".$this->id." AND tipo='$this->tipo_attr')";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_valores[]=$fila;
                }
                if(!empty($lista_valores)){
                    return $lista_valores;
                }else{
                    return false;
                }
            }
        }

        function getValor()
        {
            $query = "SELECT valor, codigo, precio_base, beneficio, valores.orden as orden, atributo, atributos.categoria as categoria FROM valores INNER JOIN atributos ON valores.atributo=atributos.id WHERE valores.id=".$this->valor_id;
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        function updateValor()
        {
            if(!empty($this->precio_base) && !empty($this->beneficio)){
                $query="UPDATE valores SET valor='$this->valor', codigo='$this->codigo', precio_base='$this->precio_base', beneficio='$this->beneficio' WHERE id='$this->valor_id'";
            }else{
                $query="UPDATE valores SET valor='$this->valor', codigo='$this->codigo', precio_base=NULL, beneficio=NULL WHERE id='$this->valor_id'";
            }

            if ( $this->_db->query($query) )
            //return mysqli_insert_id($this->_db);
            return true;
            return false;
        }

        function set()
        {
            $query="INSERT INTO categorias(nombre, descripcion, descripcion_corta, precio_base, beneficio, parent, orden) VALUES('$this->nombre', '$this->descripcion', '$this->descripcion_corta', '$this->precio_base', '$this->beneficio', '$this->parent', '$this->orden')";
            if ( $this->_db->query($query) )
            //return mysqli_insert_id($this->_db);
            return true;
            return false;
        }

        function update()
        {
             $query="UPDATE categorias SET nombre='$this->nombre', descripcion='$this->descripcion', descripcion_corta='$this->descripcion_corta', precio_base='$this->precio_base', beneficio='$this->beneficio' WHERE id='$this->id'";
            if ( $this->_db->query($query) )
            //return mysqli_insert_id($this->_db);
            return true;
            return false;
        }

        function disable()
        {
             $query="UPDATE categorias SET visible=0 WHERE id='$this->id'";
            if ( $this->_db->query($query) )
            //return mysqli_insert_id($this->_db);
            return true;
            return false;
        }

        function enable()
        {
             $query="UPDATE categorias SET visible=1 WHERE id='$this->id'";
            if ( $this->_db->query($query) )
            //return mysqli_insert_id($this->_db);
            return true;
            return false;
        }

        function delete(){
            $query="DELETE FROM categorias WHERE id='".$this->id."'";
             if ( $this->_db->query($query) )
            return true;
            return false;
        }

    }
?>
