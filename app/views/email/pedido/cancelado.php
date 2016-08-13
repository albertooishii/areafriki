<h3>PEDIDO CANCELADO</h3>

<p>¡Hola, <?=$data["nombre"]?>!</p>

<p>El pedido con código de referencia <?=$data["token"]?> ha sido cancelado por el siguiente motivo:

    <p><cite><?=$data["observaciones"]?></cite></p>

<p>En caso de haber realizado un pago será devuelto a través del mísmo sistema que fue pagado (<?=$data["metodo_pago"]?>).</p>

<p>Puedes ver el resumen de tu pedido en: <a href="<?=PAGE_DOMAIN?>/myorders/<?=$data["token"]?>"><?=PAGE_DOMAIN?>/myorders/<?=$data["token"]?></a></p>

<p>Si hay algún problema con el vendedor y/o la devolución del dinero puedes comunicárnoslo en <a href="<?=PAGE_DOMAIN?>/contacto">este enlace</a>.</p>

<p>¡Muchas gracias!</p>
