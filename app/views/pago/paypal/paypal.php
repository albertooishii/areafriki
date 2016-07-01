<div class="container wrapper">
    <img src="https://www.paypalobjects.com/webstatic/es_MX/mktg/logos-buttons/redesign/bnr_loading1.gif" alt="Check out with PayPal" />
    <p>Espere mientras le redirigimos a la página de Paypal para efectuar su pago.</p>
    <a id="redirect" href="#">Pulse aquí si no se le redirige automáticamente.</a>
    <form id="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" class="form form-horizontal" data-toggle="validator" role="form">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="<?=PAYPAL_EMAIL?>">
        <input type="hidden" name="item_name" value="Pedido en <?=PAGE_NAME?>">
        <input type="hidden" name="currency_code" value="EUR">
        <input type="hidden" name="amount" value="<?=$data["precio"]?>">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="lc" value="es_ES">
        <input type="hidden" name="image_url" value="<?=PAGE_DOMAIN?>/app/views/pago/logo-paypal.png">

        <input type="hidden" name="return" value="http://<?=PAGE_DOMAIN?>/index.php?section=home&node=pago&payment=successful&token=<?=$data["enc_token"]?>">
        <input type="hidden" name="cancel_return" value="http://<?=PAGE_DOMAIN?>/index.php?section=home&node=pago">
    </form>
</div>
<script type="text/javascript">
    $( document ).ready(function() {
        $("#paypal").submit();

        $("#redirect").click(function(event){
            $("#paypal").submit();
            event.preventDefault();
        });
    });
</script>
