<div class="container wrapper">
    <h3 class="title">Pedido realizado correctamente</h3>
    <p>Para completar el pago hay que realizar un abono de <?=$data["precio_total"]?> por ingreso o transferencia bancaria a la siguiente cuenta:</p>
    <blockquote><?=$data["banco"]?><br>Indica como concepto: <?=strtoupper(PAGE_NAME)?> <?=$data["token"]?></blockquote>
    <p>El pedido se mantendrá en estado <em>pendiente</em> de pago hasta que se haya recibido el pago. Una vez se haya recibido el pago se cambiará el estado a <em>pagado</em> y se comenzará todo el trámite.</p>
    <a href="<?=PAGE_DOMAIN?>/myorders" class="btn btn-primary btn-round">Ver mis pedidos</a>
</div>
