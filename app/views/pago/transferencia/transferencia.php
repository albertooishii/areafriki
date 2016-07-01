<div class="container wrapper">
    <form action="/carrito?action=pago_completado" method="post">
        <h3>¡Pedido completado satisfactoriamente!</h3>
        <h4>INGRESO O TRANSFERENCIA BANCARIA</h4>
        <p>Para completar el pago por ingreso o transferencia bancaria hay que realizar un abono a la siguiente cuenta:</p>
        <blockquote>BBVA ES4001821508500201591888<br>Indica como concepto: AREAFRIKI <?=$data["token"]?></blockquote>
        <p>El pedido se mantendrá en estado <em>pendiente</em> de pago hasta que hayamos recibido el pago. Una vez se haya recibido el pago se cambiará el estado a <em>pagado</em> y se comenzará todo el trámite.</p>
        <a href="<?=PAGE_DOMAIN?>/carrito?action=resumen_pedido" class="btn btn-primary">Ver resumen del pedido <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
    </form>
</div>
