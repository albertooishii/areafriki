<h3>ARTÍCULO VENDIDO EN <?=PAGE_NAME?></h3>
<p>¡Hola, <?=$data["user_vendedor"]?>!</p>
<p>Se han vendido <?=$data["cantidad"]?> unidad/es de <a href="<?=PAGE_DOMAIN?>/<?=$data["dg_categoria"]?>/<?=$data["dg_token"]?>"><?=$data["dg_nombre"?></a> en <?=PAGE_NAME?>.</p>
<p>Se ha añadido el crédito correspondiente a tu cuenta según el beneficio marcado:</p>
<ul>
    <li>Crédito anterior: <?=$data["credito_anterior"]?></li>
    <li>Crédito añadido: <?=$data["credito"]?></li>
    <li>Crédito actual: <?=$data["credito_actual"]?></li>
</ul>

<p>¡Muchas gracias!</p>
