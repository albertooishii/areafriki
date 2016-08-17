<div class="card card-vendedor" data-vendedor="<?=$data["id_vendedor"]?>" data-token="<?=$data["token"]?>">
    <div class="content">
        <h4 class="card-title">Vendido por <?=$data["nombre_vendedor"]?></h4>
    </div>
        <?=$data["productos_vendedor"]?>
    <div class="content">
        <div class="row text-center">
            <div class="col-md-3">
                <p><i class="material-icons">build</i> Preparación: <?=$data["total_preparacion_vendedor"]?> días aprox.</p>
            </div>
            <div class="col-md-3">
                <p><i class="material-icons">timer</i> Tiempo envío: <?=$data["tiempo_envio_total"]?> horas aprox.</p>
            </div>
            <div class="col-md-3">
                <p><i class="material-icons">local_shipping</i> Total gastos de envío: <?=$data["total_envio_vendedor"]?> </p>
            </div>
            <div class="col-md-3">
                <p><strong class="text-primary"><i class="material-icons">monetization_on</i> TOTAL: <?=$data["total_vendedor"]?></strong> (IVA INCLUIDO)</p>
            </div>
        </div>
        <div class="row">
            <div  class="col-md-12 text-center">
                <form method="post" action="<?=PAGE_DOMAIN?>/carrito/checkout">
                    <input type="hidden" name="token" value="<?=$data["token"]?>">
                    <button type="submit" class="btn btn-primary btn-round btn-md">Finalizar pedido</button>
                </form>
            </div>
        </div>
    </div>
</div>
