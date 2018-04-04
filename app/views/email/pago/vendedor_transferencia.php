<h3>PEDIDO REALIZADO EN <?=PAGE_NAME?></h3>
<p><?=$data["nombre"]?> 
<?php
  if(isset($data["user"])){
?>
    (<a href="<?=PAGE_DOMAIN?>/user/<?=$data["user"]?>"><?=$data["user"]?></a>)
<?php
  }
?>
ha efectuado un pedido con código de referencia <?=$data["token"]?>. El pago se va ha realizar mediante transferencia a tu cuenta bancaria, por lo que puede llegar hasta 48 horas desde que se realiza el pago en aparecer.</p>
<p>Recuerda cambiar el estado del pedido a "pagado" cuando hayas recibido el ingreso. Puedes gestionar este pedido desde este enlace <a href="<?=PAGE_DOMAIN?>/mysales/<?=$data["token"]?>"><?=$data["token"]?></a></p>
<p>¡Muchas gracias!</p>