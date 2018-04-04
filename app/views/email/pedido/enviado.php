<h3>PAGO ENVIADO</h3>

<p>¡Hola, <?=$data["nombre"]?>!</p>

<p>El pedido que has realizado en <?=PAGE_NAME?> ha sido enviado.</p>
<?php
    if(!empty($data["localizador"])){
?>
<p>Puedes hacer un seguimiento del envío a través del siguiente enlace:</p>
<a href="https://track.aftership.com/<?=$data["localizador"]?>">Localizar pedido</a>
<?php
    }
?>
<p>Puedes ver el resumen de tu pedido en: <a href="<?=PAGE_DOMAIN?>/myorders/<?=$data["token"]?>"><?=PAGE_DOMAIN?>/myorders/<?=$data["token"]?></a></p>

<p>¡Muchas gracias!</p>