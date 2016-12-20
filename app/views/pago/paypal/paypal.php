<div class="container wrapper text-center inner">
    <img src="https://www.paypalobjects.com/webstatic/es_MX/mktg/logos-buttons/redesign/bnr_loading1.gif" alt="Lo estamos redirigiendo a los servidores seguros de PayPal" />
<?php
    if(USE_SANDBOX){
        $paypal_url="https://www.sandbox.paypal.com/cgi-bin/webscr";
    }else{
        $paypal_url="https://www.paypal.com/cgi-bin/webscr";
    }
?>
    <form id="paypal" action="<?=$paypal_url?>" method="post">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="<?=$data["paypal_email"]?>">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="lc" value="es_ES">
        <input type="hidden" name="no_note" value="1">
        <input type="hidden" name="rm" value="2">
        <input type="hidden" name="charset" value="UTF-8">
        <input type="hidden" name="item_name" value="Pedido de <?=PAGE_NAME?>">
        <input type="hidden" name="item_number" value="<?=$data["token_carrito"]?>">
        <input type="hidden" name="currency_code" value="EUR">
        <input type="hidden" name="amount" value="<?=$data["precio_total"]?>">
        <input type="hidden" name="notify_url" value="<?=PAGE_DOMAIN?>/carrito?action=notify&method=paypal" />
        <input type="hidden" name="return" value="<?=PAGE_DOMAIN?>/carrito/completed">
        <input type="hidden" name="cancel_return" value="<?=PAGE_DOMAIN?>/carrito">
        <button type="submit" class="btn btn-default">Pulse aquí si no se le redirige automáticamente.</button>
    </form>
</div>
