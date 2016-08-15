<div class="card pedido" data-token="<?=$data["token"]?>" data-estado="<?=$data["estado"]?>">
    <div class="content">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">CÓDIGO DE REFERENCIA: <?=$data["token"]?></div>
<?php
    if(isset($data["localizador"])){
?>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <a href="https://track.aftership.com/<?=$data["localizador"]?>" target="_blank"><i class="material-icons">place</i> Localizar pedido</a>
            </div>
<?php
    }else{
?>
            <div class="col-md-4 col-sm-4 col-xs-12"></div>
<?php
    }
?>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <p class="label-selector">ESTADO: </p>
                <select class="selectpicker select-estado">
                    <?=$data["estado_selector"]?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4">PEDIDO REALIZADO: <?=$data["fecha_pedido"]?></div>
            <div class="col-md-4 col-sm-4">FECHA DE PAGO: <?=$data["fecha_pago"]?></div>
            <div class="col-md-4 col-sm-4">FECHA DE ENVÍO: <?=$data["fecha_envio"]?></div>
        </div>
        <div class="row">
            <div class="col-md-4">
                MÉTODO DE PAGO: <?=strtoupper($data["metodo_pago"])?>
            </div>
        </div>
    </div>
    <?=$data["productos_pedido"]?>
    <div class="content">
        <p>DATOS DE ENVÍO:</p>
        <p>Nombre y apellidos: <?=$data["name"]?></p>
        <p>Dirección: <?=$data["address"]?>, <?=$data["cp"]?>, <?=$data["localidad"]?>, <?=$data["provincia"]?></p>
        <p>Teléfono de contacto: <?=$data["phone"]?></p>
    <?php
        if(!empty($data["nota"])){
    ?>
        <p>Nota: <?=$data["nota"]?></p>
    <?php
        }
    ?>
    </div>
    <span class="divider inner"></span>
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
    </div>
</div>
