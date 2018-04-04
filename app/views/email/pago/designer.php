<h3>ARTÍCULO VENDIDO EN <?=PAGE_NAME?></h3>
<p>¡Hola, <?=$data["dg_autor"]?>!</p>
<p>Se han vendido <?=$data["cantidad"]?> unidad/es de <a href="<?=PAGE_DOMAIN?>/<?=$data["dg_categoria"]?>/<?=$data["dg_token"]?>"><?=$data["dg_nombre"]?></a> en <?=PAGE_NAME?>.</p>
<p>Se ha añadido el saldo correspondiente a tu cuenta según el beneficio marcado:</p>
<ul>
    <li>Saldo anterior: <?=$data["credito_anterior"]?></li>
    <li>Saldo añadido: <?=$data["credito"]?></li>
    <li>Saldo actual: <?=$data["credito_actual"]?></li>
</ul>
<p>Te recordamos que el pago del saldo acumulado se realizará entre los primeros 10 días de cada mes.</p>
<p>¡Muchas gracias!</p> 
