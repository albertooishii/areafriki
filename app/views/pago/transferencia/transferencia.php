<div class="container wrapper">
    <form action="/carrito?action=notify&method=transferencia" method="post">
        <h3 class="title">Pago mediante transferencia bancaria</h3>
        <p>Se va a proceder a confirmar el pedido mediante transferencia bancaria. Si estás de acuerdo pulsa en Confirmar pedido.</p>

        <input type="hidden" name="token_carrito" value="<?=$data["token_carrito"]?>">
        <input type="hidden" name="iban" value="<?=$data["iban"]?>">
        <a class="btn btn-default btn-round" href="/carrito">Volver</a>
        <button type="submit" class="btn btn-primary btn-round">Confirmar pedido</button>
    </form>
</div>
