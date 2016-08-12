<div class="card pedido" data-token="<?=$data["token"]?>">
    <div class="content">
        <div class="row">
            <div class="col-md-4">PEDIDO REALIZADO: <?=$data["fecha_pedido"]?></div>
            <div class="col-md-2">ESTADO: <span class="label label-<?=$data["class_estado"]?>"><?=$data["estado"]?></span></div>
        <?php
            if(!isset($_GET["token"])){
        ?>
                <div class="col-md-6 text-right">CÓDIGO DE REFERENCIA: <a href="<?=PAGE_DOMAIN?>/myorders/<?=$data["token"]?>"><?=$data["token"]?> (Ver detalles)</a></div>
        <?php
            }
        ?>
        </div>
        <div class="row inner">
            <div class="col-md-4 aligncentermobile">
                VENDIDO POR: <?=$data["nombre_vendedor"]?>
            </div>
            <div class="col-md-4 aligncentermobile">
                MÉTODO DE PAGO: <?=strtoupper($data["metodo_pago"])?>
            </div>
            <div class="col-md-4 text-right aligncentermobile order-actions">
<?php
    if(isset($data["localizador"])){
?>
                <a href="https://track.aftership.com/<?=$data["localizador"]?>" target="_blank" class="btn btn-round btn-primary btn-sm"><i class="material-icons">place</i> Localizar pedido</a>
<?php
    }
    if($data["permite_cancelar"]){
?>
                <a href="#" class="btn btn-round btn-danger btn-sm cancel"><i class="material-icons">cancel</i> Cancelar pedido</a>
<?php
    }
?>
            </div>
        </div>
    </div>
    <?=$data["productos_pedido"]?>
    <div class="content">
        <div class="row text-center">
            <div class="col-md-3">
                <p><i class="material-icons">build</i> Preparación: <?=$data["total_preparacion_pedido"]?> días aprox.</p>
            </div>
            <div class="col-md-3">
                <p><i class="material-icons">timer</i> Tiempo envío: <?=$data["tiempo_envio"]?> horas aprox.</p>
            </div>
            <div class="col-md-3">
                <p><i class="material-icons">local_shipping</i> Total gastos de envío: <?=$data["total_envio_pedido"]?> </p>
            </div>
            <div class="col-md-3">
                <p><strong><i class="material-icons">monetization_on</i> TOTAL: <?=$data["total_vendedor"]?></strong></p>
            </div>
        </div>
        <div class="row">
            <div  class="col-md-12 text-center">
                <form method="post" action="<?=PAGE_DOMAIN?>/carrito/checkout">
                    <input type="hidden" name="token" value="<?=$data["token"]?>">
                    <!--<button type="submit" class="btn btn-primary btn-round btn-md">Finalizar pedido</button>-->
                </form>
            </div>
        </div>
    </div>
</div>
