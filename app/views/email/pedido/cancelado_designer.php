<h3>PEDIDO CANCELADO EN <?=PAGE_NAME?></h3>
<p>¡Hola, <?=$data["dg_autor"]?>!</p>
<p>Se ha cancelado un pedido que incluía <?=$data["cantidad"]?> unidad/es de <a href="<?=PAGE_DOMAIN?>/<?=$data["dg_categoria"]?>/<?=$data["dg_token"]?>"><?=$data["dg_nombre"]?></a> en <?=PAGE_NAME?>.</p>
<p>Se ha descontado el saldo correspondiente a tu cuenta según el beneficio marcado:</p>
<ul>
    <li>Saldo anterior: <?=$data["credito_anterior"]?></li>
    <li>Saldo descontado: <?=$data["credito"]?></li>
    <li>Saldo actual: <?=$data["credito_actual"]?></li>
</ul>
<p>Sentimos las molestias causadas.</p>
<p>¡Muchas gracias!</p>
