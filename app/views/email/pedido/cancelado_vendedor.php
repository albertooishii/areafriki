<h3>PEDIDO CANCELADO</h3>

<p>¡Hola, <?=$data["vendedor_nombre"]?>!</p>

<p>El comprador del pedido con código de referencia <?=$data["token"]?> lo ha cancelado por el siguiente motivo:

    <p><cite><?=$data["observaciones"]?></cite></p>

<p>En caso de haber realizado un pago deberá ser devuelto a través del mísmo sistema que fue pagado.</p>

<p>Puedes ver el resumen de tu pedido en: <a href="<?=PAGE_DOMAIN?>/mysales/<?=$data["token"]?>"><?=PAGE_DOMAIN?>/mysales/<?=$data["token"]?></a></p>

<p>Si hay algún problema con el comprador y/o la devolución del dinero puedes comunicárnoslo en <a href="<?=PAGE_DOMAIN?>/contacto">este enlace</a>.</p>

<p>¡Muchas gracias!</p>
