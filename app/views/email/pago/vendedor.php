<h3>PEDIDO REALIZADO EN <?=PAGE_NAME?></h3>
<p><?=$data["nombre"]?>
<?php
  if(isset($data["user"])){
?>
    (<a href="<?=PAGE_DOMAIN?>/user/<?=$data["user"]?>"><?=$data["user"]?></a>)
<?php
  }
?>
ha efectuado un pedido con código de referencia <?=$data["token"]?>. Puedes gestionar este pedido desde este enlace <a href="<?=PAGE_DOMAIN?>/mysales/<?=$data["token"]?>"><?=$data["token"]?></a>
