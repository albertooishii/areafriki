<div class="card card-vendedor" data-vendedor="<?=$data["id_vendedor"]?>" data-token="<?=$data["token"]?>">
    <div class="content">
        <h4 class="card-title">Vendido por <?=$data["nombre_vendedor"]?></h4>
    </div>
        <?=$data["productos_vendedor"]?>
        <?=@$data["info_promo"]?>
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
                <p>
                    <strong class="text-primary"><i class="material-icons">monetization_on</i>
                    TOTAL: 
                    <?php
                        if(isset($data["total_nodesc"])){
                    ?>
                    <strike><?=$data["total_nodesc"]?></strike>
                    <?php
                        }
                    ?>
                    <?=$data["total_vendedor"]?></strong> (IVA INCLUIDO)
                </p>
            </div>
        </div>
        <div class="row">
            <div  class="col-md-12 text-center">
                <?php
                    if($data["total_envio_vendedor_float"] > 0 && $data["id_vendedor"]==0){
                        $diferencia_float=MIN_ENVIO_GRATIS-$data["total_vendedor_float"];
                        $diferencia=number_format($diferencia_float, 2, ',', ' ');
                        if($diferencia_float>5){
                ?>
                <p>Llega a <?=number_format(MIN_ENVIO_GRATIS, 2, ',', ' ')?>€ para conseguir los gastos de envío gratis.</p>
                <?php
                        }else{
                ?>
                <p>¡Con <?=$diferencia?>€ más, tus gastos de envío gratis!</p>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
        <div class="row checkout-buttons">
            <div  class="col-md-12 text-center">
                <form method="post" action="<?=PAGE_DOMAIN?>/carrito/checkout">
                    <input type="hidden" name="token" value="<?=$data["token"]?>">
                    <?php
                        if(isset($_GET["return"])){
                    ?>
                    <a href="<?=PAGE_DOMAIN?>/<?=$_GET["return"]?>" class="btn btn-default btn-round btn-md">Seguir comprando</a>
                    <?php
                        }else{
                    ?>
                    <a href="<?=PAGE_DOMAIN?>" class="btn btn-default btn-round btn-md">Seguir comprando</a>
                    <?php
                        }
                    ?>
                    <button type="submit" id="finish-order" class="btn btn-primary btn-round btn-lg">Finalizar pedido</button>
                </form>
            </div>
        </div>
    </div>
</div>
