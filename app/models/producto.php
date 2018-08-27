<?php
    putenv("TZ=".TIMEZONE);
    date_default_timezone_set(TIMEZONE);
    ini_set('date.timezone', TIMEZONE);
    
    require_once 'app/helpers/database.php';

    class Producto_Model extends Database{

        var $id, $nombre, $descripcion, $beneficio, $user, $creador, $design, $categoria, $category_parent, $color, $modelo, $tag, $tags, $valor, $codigo, $height, $width, $top, $left, $scale, $usado, $stock, $preparacion, $gastos_envio, $tiempo_envio, $comentario, $coment_parent,  $token_lista, $nombre_lista, $token, $search;

        function __construct(){
           parent::__construct();
        }

// Lectura-----------------------------------------------------//

        function getProductos($limit=false, $active=false)
        {

            $active = $active ? ' AND active = 1 ' : '' ;

            if(isset($this->category_parent)){
                $query = "SELECT * FROM productos WHERE categoria =$this->category_parent OR categoria IN(SELECT id FROM categorias WHERE parent = $this->category_parent) $active ORDER BY fecha_publicacion DESC";
            }elseif($limit){
                $query = "SELECT productos.id AS id, productos.nombre AS nombre, productos.descripcion AS descripcion, productos.design AS design, productos.categoria AS categoria, COUNT(distinct ventas.id) AS ventas, COUNT(distinct likes.user) AS likes, (COUNT( distinct ventas.id) + COUNT(distinct likes.user )) AS popularidad FROM productos LEFT JOIN ventas ON ventas.producto = productos.id LEFT JOIN likes ON likes.producto = productos.id WHERE id > 1 $active ORDER BY fecha_publicacion DESC LIMIT $limit";
            }else{
                $query = "SELECT * FROM productos WHERE id > 1 $active ORDER BY fecha_publicacion DESC";
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function get()
        {
            $query = "SELECT * FROM productos WHERE id= ".$this->id;
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        function getProductosUser($limit=false)
        {
            if($limit){
                $query = "SELECT * FROM productos WHERE design IN (SELECT token FROM designs WHERE user= ".$this->creador.") AND active=1 ORDER BY fecha_publicacion DESC LIMIT ".$limit;
            }else{
                $query = "SELECT * FROM productos WHERE design IN (SELECT token FROM designs WHERE user= ".$this->creador.") AND active=1 ORDER BY fecha_publicacion DESC";
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getProductosCategoria($limit=false, $order=false)
        {
            if(empty($order)){
                $order="popularidad DESC, likes.date";
            }else{
                switch($order){
                    case 'likes':
                        $order="likes";
                    break;

                    case 'sales':
                        $order="ventas";
                    break;

                    case 'date':
                        $order="fecha_publicacion";
                    break;

                    default:
                        $order="popularidad DESC, likes.date";
                }
            }

            if($limit){
                $query="SELECT productos.id AS id, productos.nombre AS nombre, productos.descripcion AS descripcion, productos.design AS design, productos.categoria AS categoria, COUNT(distinct ventas.id) AS ventas, COUNT(distinct likes.user) AS likes, (COUNT( distinct ventas.id) * 2 + COUNT(distinct likes.user )) AS popularidad FROM productos LEFT JOIN ventas ON ventas.producto = productos.id LEFT JOIN likes ON likes.producto = productos.id WHERE active =1 AND revisado =1 AND (categoria=$this->categoria OR design IN (SELECT design FROM design_topic WHERE topic=$this->categoria)) GROUP BY productos.id ORDER BY $order DESC LIMIT ".$limit;
            }else{
                $query="SELECT productos.id AS id, productos.nombre AS nombre, productos.descripcion AS descripcion, productos.design AS design, productos.categoria AS categoria, COUNT(distinct ventas.id) AS ventas, COUNT(distinct likes.user) AS likes, (COUNT( distinct ventas.id) * 2 + COUNT(distinct likes.user )) AS popularidad FROM productos LEFT JOIN ventas ON ventas.producto = productos.id LEFT JOIN likes ON likes.producto = productos.id WHERE active =1 AND revisado =1 AND (categoria=$this->categoria OR design IN (SELECT design FROM design_topic WHERE topic=$this->categoria)) GROUP BY productos.id ORDER BY $order DESC";
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function countProductosCategoria()
        {
            $query = "SELECT count(*) as count FROM productos WHERE categoria = $this->categoria AND revisado=1 AND active=1 ";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                return $answer["count"];
            }else{
                return 0;
            }
        }

        function getProductosCategoryUser()
        {
            $query="SELECT * FROM productos WHERE categoria=$this->category_parent AND design IN(SELECT token FROM designs WHERE user=$this->creador)";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;

        }

        function getProductosCategoryParentUser()
        {
            $query="SELECT * FROM productos WHERE categoria IN (SELECT id FROM categorias WHERE parent=$this->category_parent) AND design IN(SELECT token FROM designs WHERE user=$this->creador)";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;

        }

        function countProductosCategoryParentUser()
        {
            $query="SELECT count(*) as count FROM productos WHERE categoria IN (SELECT id FROM categorias WHERE parent=$this->category_parent) AND design IN(SELECT token FROM designs WHERE user=$this->creador)";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                return $answer["count"];
            }else{
                return 0;
            }
        }

        function countProductosCategoryUser()
        {
            $query="SELECT count(*) as count FROM productos WHERE categoria = $this->categoria AND design IN(SELECT token FROM designs WHERE user=$this->creador)";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                return $answer["count"];
            }else{
                return 0;
            }
        }

        function getProductosTag($limit=false)
        {
            if(empty($order)){
                $order="popularidad DESC, likes.date";
            }else{
                switch($order){
                    case 'likes':
                        $order="likes";
                    break;

                    case 'sales':
                        $order="ventas";
                    break;

                    case 'date':
                        $order="fecha_publicacion";
                    break;

                    default:
                        $order="popularidad DESC, likes.date";
                }
            }

            if($limit){
                $query="SELECT productos.id AS id, productos.nombre AS nombre, productos.descripcion AS descripcion, productos.design AS design, productos.categoria AS categoria, COUNT(distinct ventas.id) AS ventas, COUNT(distinct likes.user) AS likes, (COUNT( distinct ventas.id) * 2 + COUNT(distinct likes.user )) AS popularidad FROM productos LEFT JOIN ventas ON ventas.producto = productos.id LEFT JOIN likes ON likes.producto = productos.id WHERE productos.id IN (SELECT producto FROM producto_tag WHERE tag = '$this->tag') AND active =1 AND revisado =1 GROUP BY productos.id ORDER BY $order DESC LIMIT ".$limit;
            }else{
                $query="SELECT productos.id AS id, productos.nombre AS nombre, productos.descripcion AS descripcion, productos.design AS design, productos.categoria AS categoria, COUNT(distinct ventas.id) AS ventas, COUNT(distinct likes.user) AS likes, (COUNT( distinct ventas.id) * 2 + COUNT(distinct likes.user )) AS popularidad FROM productos LEFT JOIN ventas ON ventas.producto = productos.id LEFT JOIN likes ON likes.producto = productos.id WHERE productos.id IN (SELECT producto FROM producto_tag WHERE tag = '$this->tag') AND active =1 AND revisado =1 GROUP BY productos.id ORDER BY $order DESC";
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function countProductosTag(){
            $query = "SELECT count(*) as count FROM productos WHERE id IN (SELECT producto FROM producto_tag WHERE tag = '$this->tag') AND revisado=1 AND active=1 ";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["count"];
        }

        function getProductosDesign()
        {
            $query = "SELECT * FROM productos WHERE design = '$this->token'";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function countProductosDesign(){
            $query = "SELECT count(*) as count FROM productos WHERE design = '$this->token' AND revisado=1 AND active=1 ";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["count"];
        }

        function getProductoWhereTokenAndCategoria()
        {
            $query = "SELECT * FROM productos WHERE design = '$this->token' AND categoria = '$this->categoria'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        function isRevisado()
        {
            $query="SELECT revisado FROM productos WHERE id='$this->id'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer["revisado"]==1)
            return true;
            return false;
        }

        function isActive()
        {
            $query="SELECT active FROM productos WHERE id='$this->id'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer["active"]==1)
            return true;
            return false;
        }

        function countProductos()
        {
            $query="SELECT count(*) as count FROM productos WHERE active=1 AND revisado=1";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["count"];
        }

        function countNoRevisados()
        {
            $query="SELECT count(*) as count FROM productos WHERE revisado=0";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["count"];
        }

        function getLikes()
        {
            $query = "SELECT count(user) as 'likes' FROM likes WHERE producto= ".$this->id;
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["likes"];
        }

        function userLikeProducto()
        {
            $query = "SELECT * FROM likes WHERE producto= ".$this->id." AND user= ".$this->user;
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return true;
            return false;
        }

         function getUltimosProductos($limit=false){
            if($limit){
                $query = "SELECT * FROM productos WHERE active=1 and revisado=1 ORDER BY fecha_publicacion DESC LIMIT ".$limit;
            }else{
                $query = "SELECT * FROM productos WHERE active=1 and revisado=1 ORDER BY fecha_publicacion DESC";
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getMasVendidos($limit=false){
            if($limit){
                $query = "SELECT * FROM productos WHERE ventas >= 1 AND  active=1 and revisado=1 ORDER BY ventas DESC limit $limit";
            }else{
                $query = "SELECT * FROM productos WHERE ventas >= 1 AND  active=1 and revisado=1 ORDER BY ventas DESC";
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getMasLikes($limit=false){
            if(!empty($limit)){
                $query="SELECT productos.id as id, productos.nombre as nombre, productos.descripcion as descripcion, productos.design as design, productos.categoria as categoria, count(likes.user) as likes FROM productos INNER JOIN likes ON productos.id=likes.producto WHERE active=1 and revisado=1 GROUP BY id ORDER BY likes DESC LIMIT ".$limit;
            }else{
                $query="SELECT productos.id as id, productos.nombre as nombre, productos.descripcion as descripcion, productos.design as design, productos.categoria as categoria, count(likes.user) as likes FROM productos INNER JOIN likes ON productos.id=likes.producto WHERE active=1 and revisado=1 GROUP BY id ORDER BY likes DESC";
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getOnFire($limit=false){
            $today = date ("Y-m-d");
            $week = date('Y-m-d', strtotime('-1 weeks', strtotime($today)));

            if(!empty($limit)){
                $query="SELECT productos.id AS id, productos.nombre AS nombre, productos.descripcion AS descripcion, productos.design AS design, productos.categoria AS categoria, COUNT(distinct ventas.id) AS ventas, COUNT(distinct likes.user) AS likes, (COUNT( distinct ventas.id) * 2 + COUNT(distinct likes.user )) AS popularidad FROM productos LEFT JOIN ventas ON ventas.producto = productos.id LEFT JOIN likes ON likes.producto = productos.id WHERE active =1 AND revisado =1 GROUP BY productos.id ORDER BY popularidad DESC, likes.date DESC LIMIT ".$limit;
            }else{
                $query="SELECT productos.id AS id, productos.nombre AS nombre, productos.descripcion AS descripcion, productos.design AS design, productos.categoria AS categoria, COUNT(distinct ventas.id) AS ventas, COUNT(distinct likes.user) AS likes, (COUNT( distinct ventas.id) * 2 + COUNT(distinct likes.user )) AS popularidad FROM productos LEFT JOIN ventas ON ventas.producto = productos.id LEFT JOIN likes ON likes.producto = productos.id WHERE active =1 AND revisado =1 GROUP BY productos.id ORDER BY popularidad DESC, likes.date DESC";
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function userNotLikeProducto($limit)//recogemos los productos a los que no se les ha dado like
        {
            if(!empty($this->user)){
                $query="SELECT * FROM productos WHERE id NOT IN (SELECT producto FROM likes WHERE user=$this->user) AND revisado=1 AND active=1 ORDER by RAND() LIMIT $limit";
            }else{
                $query="SELECT * FROM productos WHERE revisado=1 AND active=1 ORDER by RAND() LIMIT $limit";
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getNewRuletaItem($id1, $id2, $id3, $id4, $id5)
        {
            $query="SELECT * FROM productos WHERE id NOT IN (SELECT producto FROM likes WHERE user=$this->user) AND id!=$id1  AND id!=$id2 AND id!=$id3 AND id!=$id4 AND id!=$id5 AND revisado=1 AND active=1 ORDER by RAND() LIMIT 1";
            //echo $query;
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        function getShares()
        {
            $query = "SELECT shares FROM productos WHERE id= ".$this->id;
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["shares"];
        }

        function getViews()
        {
            $query = "SELECT visitas FROM productos WHERE id= ".$this->id;
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["visitas"];
        }

        function getLastViewsUser($limit)
        {
            if(!empty($this->user)){
                $query = "SELECT productos.* from productos INNER JOIN visitas on productos.id = visitas.producto where visitas.id in (SELECT MAX(visitas.id) from visitas where visitas.user='".$this->user."' GROUP BY visitas.producto) ORDER BY visitas.date DESC LIMIT $limit";
            }else{
                $query = "SELECT productos.* from productos INNER JOIN visitas on productos.id = visitas.producto where visitas.id in (SELECT MAX(visitas.id) from visitas where visitas.ip='".$this->getIP()."' GROUP BY visitas.producto) ORDER BY visitas.date DESC LIMIT $limit";
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getColores(){
            $query="SELECT valor, codigo FROM valores WHERE atributo=(SELECT id FROM atributos WHERE tipo='color' AND categoria=$this->categoria) ORDER BY orden";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_colores[]=$fila;
                }
                if(!empty($lista_colores)){
                    return $lista_colores;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getNombreColor(){
            $query="SELECT valor FROM valores WHERE codigo= '$this->codigo' AND atributo=(SELECT id FROM atributos WHERE tipo='color' AND categoria=$this->categoria) ORDER BY orden";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer["valor"];
            return false;
        }

        function getSizes(){
            $query="SELECT valor, codigo, orden FROM valores WHERE atributo=(SELECT id FROM atributos WHERE tipo='size' AND categoria=$this->categoria) ORDER BY orden";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_sizes[]=$fila;
                }
                if(!empty($lista_sizes)){
                    return $lista_sizes;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getSize($orden){
            if(isset($this->categoria) && !empty($orden)){
                $query="SELECT valor, codigo FROM valores WHERE atributo=(SELECT id FROM atributos WHERE tipo='size' AND categoria=$this->categoria) AND orden='$orden'";
                $answer = $this->_db->query($query)->fetch_assoc();
                if($answer!=NULL)
                return $answer;
                return false;
            }else{
                return false;
            }
        }

        function getValoresModelo(){
            $query="SELECT valor, codigo, orden FROM valores WHERE atributo=(SELECT id FROM atributos WHERE tipo='modelo' AND nombre='$this->modelo' AND categoria=$this->categoria) ORDER BY orden";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_sizes[]=$fila;
                }
                if(!empty($lista_sizes)){
                    return $lista_sizes;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getValor($orden){
            if(isset($this->modelo) && isset($this->categoria)){
                $query="SELECT valor, codigo FROM valores WHERE atributo=(SELECT id FROM atributos WHERE tipo='modelo' AND nombre='$this->modelo' AND categoria=$this->categoria) AND orden=$orden";
                $answer = $this->_db->query($query)->fetch_assoc();
                if($answer!=NULL)
                return $answer;
                return false;
            }else{
                return false;
            }
        }

        function getTags(){
            $query="SELECT tag FROM producto_tag WHERE producto = $this->id";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_tags[]=$fila;
                }
                if(isset($lista_tags)){
                    return $lista_tags;
                }
            }
            return false;
        }

        function search($limit=false, $order=false){
            
            $search_keys=explode(" ", $this->search);
            
            if(empty($order)){
                $order="popularidad DESC, likes.date";
            }else{
                switch($order){
                    case 'likes':
                        $order="likes";
                    break;

                    case 'sales':
                        $order="ventas";
                    break;

                    case 'date':
                        $order="fecha_publicacion";
                    break;

                    default:
                        $order="popularidad DESC, likes.date";
                }
            }

            $string="";
            foreach($search_keys as $key => $word){
                if($key>0){
                    $string.=" AND ";
                }
                $string.="nombre LIKE '%$word%'";
            }
            
            if($limit){
                $query="SELECT productos.id AS id, productos.nombre AS nombre, productos.descripcion AS descripcion, productos.design AS design, productos.categoria AS categoria, COUNT(distinct ventas.id) AS ventas, COUNT(distinct likes.user) AS likes, (COUNT( distinct ventas.id) * 2 + COUNT(distinct likes.user )) AS popularidad FROM productos LEFT JOIN ventas ON ventas.producto = productos.id LEFT JOIN likes ON likes.producto = productos.id WHERE ((".$string.") OR productos.id IN (SELECT producto FROM producto_tag WHERE tag LIKE '%".$this->search."%')) AND active=1 AND revisado=1 AND active =1 AND revisado =1 GROUP BY productos.id ORDER BY $order DESC LIMIT ".$limit;
            }else{
                $query="SELECT productos.id AS id, productos.nombre AS nombre, productos.descripcion AS descripcion, productos.design AS design, productos.categoria AS categoria, COUNT(distinct ventas.id) AS ventas, COUNT(distinct likes.user) AS likes, (COUNT( distinct ventas.id) * 2 + COUNT(distinct likes.user )) AS popularidad FROM productos LEFT JOIN ventas ON ventas.producto = productos.id LEFT JOIN likes ON likes.producto = productos.id WHERE ((".$string.") OR productos.id IN (SELECT producto FROM producto_tag WHERE tag LIKE '%".$this->search."%')) AND active=1 AND revisado=1 GROUP BY productos.id ORDER BY $order DESC";
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;
        }
        
        function countProductosSearch()
        {
            $query = "SELECT count(*) as count FROM productos WHERE (nombre LIKE '%".$this->search."%' OR id IN (SELECT producto FROM producto_tag WHERE tag LIKE '%".$this->search."%')) AND active=1 AND revisado=1";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                return $answer["count"];
            }else{
                return 0;
            }
        }
// Escritura -----------------------------------------------------//

        function setDesign()
        {
            $fecha=date ("Y-m-d H:i:s");

            //print_r($this->beneficio);
            if(is_array($this->beneficio)){
                 $query="INSERT INTO productos (nombre, descripcion, beneficio, design, categoria, color, modelo, fecha_publicacion, height, width, top_pos, left_pos, scale) VALUES('$this->nombre', '$this->descripcion', NULL, '$this->design', '$this->categoria', '$this->color', '$this->modelo', '$fecha', '$this->height', '$this->width', '$this->top', '$this->left', '$this->scale')";
            }else{
                $query="INSERT INTO productos (nombre, descripcion, beneficio, design, categoria, color, modelo, fecha_publicacion, height, width, top_pos, left_pos, scale) VALUES('$this->nombre', '$this->descripcion', '$this->beneficio', '$this->design', '$this->categoria', '$this->color', '$this->modelo', '$fecha', '$this->height', '$this->width', '$this->top', '$this->left', '$this->scale')";
            }

            //echo $query;
            if ($this->_db->query($query)){
                $this->id=mysqli_insert_id($this->_db);

                $this->setProductoLista();

                if(is_array($this->beneficio)){
                    $this->setBeneficioProducto();
                }

                foreach($this->tags as $tag){
                    $tag=str_replace(" ", "-", trim(strtolower($tag)));
                    $query = "INSERT INTO tags (nombre) VALUES ('$tag')";
                    $this->_db->query($query);
                    $query = "INSERT INTO producto_tag (producto, tag) VALUES ('$this->id','$tag')";
                    $this->_db->query($query);
                }

                return $this->id;
            }else{
                return false;
            }
        }

        function setCraft()
        {
            $fecha=date ("Y-m-d H:i:s");
            $query="INSERT INTO productos (nombre, descripcion, beneficio, design, categoria, fecha_publicacion, usado, stock, preparacion, gastos_envio, tiempo_envio) VALUES('$this->nombre', '$this->descripcion', $this->beneficio, '$this->design', '$this->categoria', '$fecha', $this->usado, $this->stock, $this->preparacion, $this->gastos_envio, $this->tiempo_envio)";
            // echo $query;
            if ($this->_db->query($query)){
                $this->id=mysqli_insert_id($this->_db);
                $this->setProductoLista();
                foreach($this->tags as $tag){
                    $tag=str_replace(" ", "-", trim(strtolower($tag)));
                    $query = "INSERT INTO tags (nombre) VALUES ('$tag')";
                    $this->_db->query($query);
                    $query = "INSERT INTO producto_tag (producto, tag) VALUES ('$this->id','$tag')";
                    $this->_db->query($query);
                }

                return $this->id;
            }else{
                return false;
            }
        }

        function like()
        {
            $fecha=date ("Y-m-d H:i:s");
            $query="INSERT INTO likes (producto, user, date) VALUES('$this->id', '$this->user', '$fecha')";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function setBeneficioProducto()
        {
            $orden=0;
            foreach ($this->beneficio as $beneficio){
                $orden++;
                $query="INSERT INTO beneficio_valor (producto, valor, beneficio) VALUES('$this->id', (SELECT id FROM valores WHERE atributo=(SELECT id FROM atributos WHERE categoria=".$this->categoria." AND tipo='size') AND orden=".$orden."), '$beneficio') ON DUPLICATE KEY UPDATE beneficio='$beneficio'";
                //echo $query;
                if ( !$this->_db->query($query) ){
                    return false;
                }
            }
            return true;
        }

        //Solicitud de compra
        function solicitarCompra()
        {
            $date=date ("Y-m-d H:i:s");
            $query="INSERT INTO solicitud_compra (user, producto, date) VALUES ($this->user, $this->id, '$date')";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function getSolicitudesCompra()
        {
            $query="SELECT * FROM solicitud_compra WHERE producto='$this->id'";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_solicitudes[]=$fila;
                }
                if(!empty($lista_solicitudes)){
                    return $lista_solicitudes;
                }else{
                    return false;
                }
            }
            return false;

        }

        function deleteSolicitudCompra()
        {
            $query="DELETE FROM solicitud_compra WHERE user='$this->user' AND id='$this->id'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

// Actualizado -----------------------------------------------------//

        function revisar()
        {
            $query="UPDATE productos SET revisado='1' WHERE id='$this->id'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function share()
        {
            $query="UPDATE productos SET shares=shares+1 WHERE id='$this->id'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function visitar()
        {
            $fecha=date ("Y-m-d H:i:s");
            if (preg_match( "/^([d]{1,3}).([d]{1,3}).([d]{1,3}).([d]{1,3})$/", getenv('HTTP_X_FORWARDED_FOR'))){
                $ip=getenv('HTTP_X_FORWARDED_FOR');
            }else{
                $ip=getenv('REMOTE_ADDR');
            }
            if(!empty($this->user)){
                $query="INSERT INTO visitas (date, user, ip, producto) VALUES ('$fecha', '$this->user', '$ip', '$this->id')";
            }else{
                $query="INSERT INTO visitas (date, ip, producto) VALUES ('$fecha', '$ip', '$this->id')";
            }
            if ($this->_db->query($query)){
                $query="UPDATE productos SET visitas=visitas+1 WHERE id='$this->id'";
                if ( $this->_db->query($query) )
                return true;
                return false;
            }else{
                return false;
            }
        }

        function vender($cantidad)
        {
            $fecha=date ("Y-m-d H:i:s");
            $query="UPDATE productos SET ventas=ventas+$cantidad, stock=stock-$cantidad WHERE id='$this->id'";
            if ( $this->_db->query($query) ){
                $query="INSERT INTO ventas (producto, cantidad, fecha) VALUES ('$this->id', '$cantidad', '$fecha')";
                if ( $this->_db->query($query) ){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        function cancelarVenta($cantidad){
            $query="UPDATE productos SET ventas=ventas-$cantidad, stock=stock+$cantidad WHERE id='$this->id'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function update()
        {
            $fecha=date ("Y-m-d H:i:s");
            if(is_array($this->beneficio)){
                $query="UPDATE productos SET nombre='$this->nombre', descripcion='$this->descripcion', fecha_actualizacion='$fecha' WHERE id='$this->id'";
            }elseif(!empty($this->stock)){
                $query="UPDATE productos SET nombre='$this->nombre', descripcion='$this->descripcion', fecha_actualizacion='$fecha', beneficio='$this->beneficio', stock='$this->stock', gastos_envio='$this->gastos_envio', tiempo_envio='$this->tiempo_envio' WHERE id='$this->id'";
            }elseif(!empty($this->preparacion)){
                 $query="UPDATE productos SET nombre='$this->nombre', descripcion='$this->descripcion', fecha_actualizacion='$fecha', beneficio='$this->beneficio', preparacion='$this->preparacion', gastos_envio='$this->gastos_envio', tiempo_envio='$this->tiempo_envio' WHERE id='$this->id'";
            }else{
                $query="UPDATE productos SET nombre='$this->nombre', descripcion='$this->descripcion', fecha_actualizacion='$fecha', beneficio='$this->beneficio' WHERE id='$this->id'";
            }

            //echo $query;
            $this->setProductoLista();

            if ($this->_db->query($query)){

                if(is_array($this->beneficio)){
                    $this->setBeneficioProducto();
                }

                $query="DELETE FROM producto_tag WHERE producto='$this->id'";
                $this->_db->query($query);
                foreach($this->tags as $tag){
                    $tag=str_replace(" ", "-", trim(strtolower($tag)));
                    $query = "INSERT INTO tags (nombre) VALUES ('$tag')";
                    $this->_db->query($query);
                    $query = "INSERT INTO producto_tag (producto, tag) VALUES ('$this->id','$tag')";
                    $this->_db->query($query);
                }

                return true;
            }else{
                return false;
            }
        }

        function unlike()
        {
            $query="DELETE FROM likes WHERE producto='$this->id' AND user='$this->user'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

//Delete y desactivado

        function deactivate()
        {
            $query="UPDATE productos SET active=0 WHERE id='$this->id'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function delete($username, $token, $categoria){
            //Primero vemos si hay alguna venta de este producto
            $query = "SELECT count(*) as count FROM productos WHERE ventas >=1 AND design = '".$token."'";
            $answer = $this->_db->query($query)->fetch_assoc();
            //Si no hay venta
            if (!$answer['count']){
                //Primero eliminamos producto de la base de datos
                $query="DELETE FROM productos WHERE id='".$this->id."'";
                if ( $this->_db->query($query) ) {
                    //Borramos la carpeta de este producto
                    $source="designs/".$username."/".$token."/".$categoria."/";
                    $this->rmrf($source);

                    //Vemos si hay más productos con este diseño
                    $query = "SELECT count(*) AS count FROM productos WHERE design = '".$token."'";
                    $answer = $this->_db->query($query)->fetch_assoc();
                    if (!$answer['count']){ //Si no hay más productos con este diseño
                        //Borramos en base de datos el diseño
                        $query="DELETE FROM designs WHERE token='".$token."'";
                        if($this->_db->query($query)) {
                            //Borramos la carpeta completa del diseño
                            $source="designs/".$username."/".$token."/";
                            $this->rmrf($source);
                        } else {
                            return false;
                        }
                    }
                    return true;
                } else {
                    return false;
                }
            } else {
                //Si hay venta lo desactivamos en lugar de eliminar
                //if($this->deactivate())
                return true;
                return false;
            }
        }

//Comentarios

        function comentar(){
            $fecha=date ("Y-m-d H:i:s");
            if (preg_match( "/^([d]{1,3}).([d]{1,3}).([d]{1,3}).([d]{1,3})$/", getenv('HTTP_X_FORWARDED_FOR'))){
                $ip=getenv('HTTP_X_FORWARDED_FOR');
            }else{
                $ip=getenv('REMOTE_ADDR');
            }

            if(isset($this->coment_parent)){
                $query="INSERT INTO comentarios (fecha, producto, user, comentario, ip, parent) VALUES ('$fecha', '$this->id', '$this->user', '$this->comentario', '$ip', '$this->comment_parent')";
            }else{
                $query="INSERT INTO comentarios (fecha, producto, user, comentario, ip) VALUES ('$fecha', '$this->id', '$this->user', '$this->comentario', '$ip')";
            }
            if ($this->_db->query($query)){
                return true;
            }else{
                return false;
            }
        }

        function getComentarios(){
            $query="SELECT * FROM comentarios WHERE producto='$this->id' ORDER BY id DESC";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_comentarios[]=$fila;
                }
                if(!empty($lista_comentarios)){
                    return $lista_comentarios;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getContComentarios(){
            $query="SELECT count(*) as contador FROM comentarios WHERE producto='$this->id' ORDER BY id DESC";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer["contador"];
            return false;
        }

//Listas de productos
        function setLista(){
            $date=date ("Y-m-d H:i:s");
            $chars = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M','N','O','P','Q', 'R','S','T','U','V','W','X','Y','Z');

            $long = 8;

            $this->token_lista = '';
            for($i = 0; $i < $long; $i++) {
                $this->token_lista .= $chars[rand(0, count($chars)-1)];
            }

            $query="INSERT INTO listas (token, user, nombre, fecha_creacion, fecha_update) VALUES ('$this->token_lista', $this->user, '$this->nombre_lista', '$date', '$date')";
            if ( $this->_db->query($query) )
            return true;
        }

        function getListas(){
            $query="SELECT * FROM listas WHERE user=$this->user";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $listas[]=$fila;
                }
                if(!empty($listas)){
                    return $listas;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        function getLista(){
            $query="SELECT * FROM listas WHERE token='$this->token_lista'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        function getListasUsadas(){
            $query="SELECT listas.token as token, listas.nombre as nombre, productos.id as producto FROM listas INNER JOIN productos ON listas.token=productos.lista WHERE user=$this->creador AND productos.active=1 AND productos.revisado=1 GROUP BY token";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $listas[]=$fila;
                }
                if(!empty($listas)){
                    return $listas;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getListaProducto(){
            $query="SELECT lista FROM productos WHERE producto='$this->id'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer["lista"];
            return false;
        }

        function getProductosLista(){
            $query="SELECT * FROM productos WHERE lista='$this->token_lista'";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_productos[]=$fila;
                }
                if(!empty($lista_productos)){
                    return $lista_productos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function setProductoLista(){
            if(!empty($this->token_lista)){
                $query="UPDATE productos SET lista='$this->token_lista' WHERE id='$this->id'";
            }else{
                $query="UPDATE productos SET lista=NULL WHERE id='$this->id'";
            }
            //echo $query;
            if ( $this->_db->query($query) )
            return true;
            return false;
        }
    }

?>
