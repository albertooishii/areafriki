<?php
    require_once 'app/helpers/database.php';

    class Pedido_Model extends Database{

        var $pedido, $vendedor, $token, $producto, $size, $color, $estado, $metodo_pago, $precio, $gastos_envio, $user, $name, $email, $address, $cp, $provincia, $localidad, $phone, $nota, $observaciones, $preparacion, $tiempo_envio, $localizador;

        function __construct(){
           parent::__construct();
        }

        function get()
        {
            $query = "SELECT * FROM pedidos WHERE token= '".$this->token."'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        function getPedidos()
        {
            if(empty($this->user)){
                $query = "SELECT * FROM pedidos ORDER BY fecha_pedido DESC";
            }else{
                $query = "SELECT * FROM pedidos WHERE user= '".$this->user."' ORDER BY fecha_pedido DESC";
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_pedidos[]=$fila;
                }
                if(!empty($lista_pedidos)){
                    return $lista_pedidos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function getVentas()
        {
             $query = "SELECT * FROM pedidos WHERE vendedor= '".$this->vendedor."' ORDER BY fecha_pedido DESC";
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_pedidos[]=$fila;
                }
                if(!empty($lista_pedidos)){
                    return $lista_pedidos;
                }else{
                    return false;
                }
            }
            return false;
        }

        function countPedidos(){
            $query="SELECT count(*) as count FROM pedidos";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["count"];
        }

        function countNewPedidos(){
            $query="SELECT count(*) as count FROM pedidos WHERE estado='pendiente' OR estado='pagado'";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["count"];
        }

        function getEstados()
        {
            $query = "SHOW COLUMNS FROM pedidos WHERE field = 'estado'";
            $answer = $this->_db->query($query);
            $row = $answer->fetch_assoc();
            $type = $row['Type'];
            preg_match("/^set\(\'(.*)\'\)$/", $type, $matches);
            $enum = explode("','", $matches[1]);
            return $enum;
        }

        function set()
        {
            $fecha_pedido=date ("Y-m-d H:i:s");

            if($this->estado=="pagado"){
                $fecha_pago=$fecha_pedido;
            }

            $pedido=serialize($this->pedido);

            if(!empty($this->user)){
                $user=$this->user;
            }else{
                $user='NULL';
            }

            if($this->estado=="pendiente"){
                $query="INSERT INTO pedidos (token, vendedor, pedido, fecha_pedido, estado, metodo_pago, precio, gastos_envio, preparacion, tiempo_envio, user, name, email, address, cp, provincia, localidad, phone, nota) VALUES('$this->token', '$this->vendedor', '$pedido', '$fecha_pedido', '$this->estado', '$this->metodo_pago', '$this->precio', '$this->gastos_envio', '$this->preparacion', '$this->tiempo_envio', $user, '$this->name', '$this->email', '$this->address', '$this->cp', '$this->provincia', '$this->localidad', '$this->phone', '$this->nota')";
            }elseif($this->estado=="pagado"){
                $query="INSERT INTO pedidos (token, vendedor, pedido, fecha_pedido, fecha_pago, estado, metodo_pago, precio, gastos_envio, preparacion, tiempo_envio, user, name, email, address, cp, provincia, localidad, phone, nota) VALUES('$this->token', '$this->vendedor', '$pedido', '$fecha_pedido', '$fecha_pago', '$this->estado', '$this->metodo_pago', '$this->precio', '$this->gastos_envio', '$this->preparacion', '$this->tiempo_envio', $user, '$this->name', '$this->email', '$this->address', '$this->cp', '$this->provincia', '$this->localidad', '$this->phone', '$this->nota')";
            }

            if ($this->_db->query($query))
            return true;
            return false;
        }

        function update()
        {
            $fecha=date ("Y-m-d H:i:s");
            $query="UPDATE carritos SET pedido='$this->pedido', fecha='$fecha' WHERE user='$this->user'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function delete(){
            $query="DELETE FROM pedidos WHERE token='".$this->token."'";
             if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function pagar(){
            $fecha_pago=date ("Y-m-d H:i:s");
            $query="UPDATE pedidos SET estado='pagado', fecha_pago='$fecha_pago' WHERE token='$this->token'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function cancelar(){
            $fecha_cancelacion=date ("Y-m-d H:i:s");
            $query="UPDATE pedidos SET estado='cancelado', fecha_cancelacion='$fecha_cancelacion', observaciones='$this->observaciones' WHERE token='$this->token'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function enviar(){
            $fecha_envio=date ("Y-m-d H:i:s");
            $query="UPDATE pedidos SET estado='enviado', fecha_envio='$fecha_envio', localizador='$this->localizador' WHERE token='$this->token'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function completar(){
            $fecha_completado=date ("Y-m-d H:i:s");
            $query="UPDATE pedidos SET estado='completado', fecha_completado='$fecha_completado' WHERE token='$this->token'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function changeEstado(){
            $fecha_pago=date ("Y-m-d H:i:s");
            $query="UPDATE pedidos SET estado='$this->estado' WHERE token='$this->token'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function asignarPedidos(){
            $fecha_pago=date ("Y-m-d H:i:s");
            $query="UPDATE pedidos SET user='$this->user' WHERE email='$this->email'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function genera_token() {
            $chars = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M','N','O','P','Q', 'R','S','T','U','V','W','X','Y','Z');

            $long = 6;

            $token = '';
            for($i = 0; $i < $long; $i++) {
                $token .= $chars[rand(0, count($chars)-1)];
            }
            $this->token="AF".$token;
            // Ahora consultas si ya existe.
            // Si existe, vuelves a llamar a la funcion

            $query = "SELECT * FROM pedidos WHERE token = '$this->token'";

            $answer = $this->_db->query($query)->fetch_row();
            if ($answer!=NULL){
                return genera_token();
            }
        }
    }
?>
