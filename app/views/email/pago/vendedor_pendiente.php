<h3>PEDIDO REALIZADO EN <?=PAGE_NAME?></h3>
<p><?=$data["nombre"]?> 
<?php
  if(isset($data["user"])){
?>
    (<a href="<?=PAGE_DOMAIN?>/user/<?=$data["user"]?>"><?=$data["user"]?></a>)
<?php
  }
?>
ha efectuado un pedido con código de referencia <?=$data["token"]?>. El pago se ha realizado mediante paypal, pero no se ha podido confirmar.</p>
<p>Revisa si has recibido el pago en tu cuenta de paypal y en caso afirmativo cambia el estado del pedido a "pagado". Puedes gestionar este pedido desde este enlace <a href="<?=PAGE_DOMAIN?>/mysales/<?=$data["token"]?>"><?=$data["token"]?></a></p>
<p>¡Muchas gracias!</p>