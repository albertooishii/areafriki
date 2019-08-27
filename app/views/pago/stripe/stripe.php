<?php
    require_once('vendor/stripe-php-6.43.0/init.php');
    // Set your secret key: remember to change this to your live secret key in production
    // See your keys here: https://dashboard.stripe.com/account/apikeys
    \Stripe\Stripe::setApiKey(STRIPE_SECRET);

    // Get the credit card details submitted by the form
    $stripe_token = $_POST['stripeToken'];

    // Create a charge: this will charge the user's card
    try {
      $charge = \Stripe\Charge::create(array(
        "amount" => $data["precio_total"]*100, // Amount in cents
        "currency" => "eur",
        "source" => $stripe_token,
        "description" => $data["token_pedido"]
        ));
        $estado="pagado";
    } catch(\Stripe\Error\Card $e) {
        $estado="pendiente";
    }
?>
<form action="/carrito?action=notify&method=stripe" method="post" name="token_form">
    <input type="hidden" name="token_pedido" value="<?=$data["token_pedido"]?>">
    <input type="hidden" name="estado" value="<?=$estado?>">
</form>
<script type="text/javascript">
    document.token_form.submit();
</script>
