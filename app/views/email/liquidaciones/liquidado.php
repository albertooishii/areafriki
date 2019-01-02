<h3>LIQUIDACIÓN <?=PAGE_NAME?></h3>
<p>¡Hola, <?=$data["nombre_vendedor"]?>!</p>
<p>Te acabamos de realizar el pago del saldo acumulado por tus ventas en la web a través del método de pago que configuraste (PayPal o transferencia bancaria).</p>
<p>Se ha descontado el saldo correspondiente de tu cuenta:</p>
<ul>
    <li>Saldo liquidado: <?=$data["credito"]?></li>
    <li>Saldo actual: 0,00€</li>
</ul>
<p>Cualquier duda que tengas no dudes en contactarnos.</p>
<p>¡Muchas gracias!</p> 
