<h3>PEDIDO CANCELADO EN <?=PAGE_NAME?></h3>
<p><?=$data["nombre"]?>
<?php
  if(isset($data["user"])){
?>
    (<a href="<?=PAGE_DOMAIN?>/user/<?=$data["user"]?>"><?=$data["user"]?></a>)
<?php
  }
?>
 ha cancelado un pedido con código de referencia <?=$data["token"]?>.</p>

<p>En caso de haber realizado un pago deberá ser devuelto a través del mísmo sistema que fue pagado (<?=$data["metodo_pago"]?>).</p>

Puedes gestionar este pedido desde este enlace <a href="<?=PAGE_DOMAIN?>/simbiosis/pedidos/<?=$data["token"]?>"><?=$data["token"]?></a>
