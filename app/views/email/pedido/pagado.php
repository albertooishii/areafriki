<h3>PAGO CONFIRMADO</h3>

<p>¡Hola, <?=$data["nombre"]?>!</p>

<p>Gracias por haber comprado en <?=PAGE_NAME?></p>

<p>El pago de tu pedido con código de referencia <?=$data["token"]?> se ha efectuado correctamente. Puedes ver el resumen de tu pedido en: <a href="<?=PAGE_DOMAIN?>/myorders/<?=$data["token"]?>"><?=PAGE_DOMAIN?>/myorders/<?=$data["token"]?></a></p>

<p>¡Muchas gracias!</p>
