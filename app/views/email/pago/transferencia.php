<h3>DATOS PARA LA TRANSFERENCIA BANCARIA</h3>
<p>¡Hola, <?=$data["nombre"]?>!</p>
<p>Gracias por haber comprado en <?=PAGE_NAME?></p>
<p>Para completar el pago hay que realizar un abono de <?=$data["precio_total"]?> por ingreso o transferencia bancaria a la siguiente cuenta:</p>
<blockquote><?=$data["iban"]?><br>Indica como concepto: <?=strtoupper(PAGE_NAME)?> <?=$data["token"]?></blockquote>
<p>El pedido se mantendrá en estado <em>pendiente</em> de pago hasta que se haya recibido el pago. Una vez se haya recibido el pago se cambiará el estado a <em>pagado</em> y se comenzará todo el trámite.</p>

<p>Puedes comprobar el estado de tu pedido en: <a href="<?=PAGE_DOMAIN?>/myorders/<?=$data["token"]?>"><?=PAGE_DOMAIN?>/myorders/<?=$data["token"]?></a></p>

<p>¡Muchas gracias!</p>
