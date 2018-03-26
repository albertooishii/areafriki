<style>
    #vender-mobile, #feedback{
        display: none !important;
    }
</style>
<div class="container wrapper">
    <h3 class="title text-center">Carrito de la compra</h3>
    <p class="nomobile">Los productos de cada vendedor están agrupados en pedidos separados. Revisa todas las cosas que has introducido en el carrito: sus cantidades, tiempos y precios. Una vez esté todo a tu gusto dale al botón <strong>Finalizar Pedido</strong> del pedido que quieras pagar para ir a la pantalla de selección de método de pago y donde quieres recibir los envíos.</p>
    <div class="row inner">
        <div class="col-md-12">
            <?=$data["lista_productos"]?>
        </div>
    </div>
</div>
