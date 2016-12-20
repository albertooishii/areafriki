<div class="container wrapper">
    <form action="/carrito?action=notify&method=transferencia" method="post">
        <h3 class="title">Pago mediante transferencia bancaria</h3>
        <p>Para completar el pago hay que realizar un abono de <?=number_format($data["precio_total"], 2, ',', ' ')?>€ por ingreso o transferencia bancaria a la siguiente cuenta:</p>
        <blockquote><?=$data["iban"]?></blockquote>
        <p>El pedido se mantendrá en estado <em>pendiente</em> de pago hasta que se haya recibido el pago. Una vez se haya recibido el pago se cambiará el estado a <em>pagado</em> y se comenzará todo el trámite. Te enviaremos todos los detalles a tu correo electrónico.</p>
        <p>Si estás de acuerdo pulsa en Confirmar pedido.</p>

        <input type="hidden" name="token_carrito" value="<?=$data["token_carrito"]?>">
        <input type="hidden" name="iban" value="<?=$data["iban"]?>">
        <a class="btn btn-default btn-round" href="/carrito">Volver</a>
        <button type="submit" class="btn btn-primary btn-round">Confirmar pedido</button>
    </form>
</div>
