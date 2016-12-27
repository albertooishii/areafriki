<div class="pedido" data-token="<?=$data["token"]?>" data-estado="<?=$data["estado"]?>">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">PEDIDO <?=$data["token"]?></h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?=$data["mensaje"]?>
    <?=$data["lista_productos"]?>
    <div class="row">
        <div class="col-md-6">
            <h3>INFORMACIÓN DEL PEDIDO:</h3>

            <p>CÓDIGO DE REFERENCIA: <?=$data["token"]?></p>
            <p>VENDEDOR:
                <?php
                    if($data["id_vendedor"]!=0){
                ?>
                <a href="<?=PAGE_DOMAIN?>/user/<?=$this->u->user2URL($data["vendedor"])?>" target="_blank"><?=$data["vendedor"]?></a>
                <?php
                    }else{
                ?>
                    <?=$data["vendedor"]?>
                <?php
                    }
                ?>
            </p>
            <p>COMPRADOR:
                <?=$data["comprador"]?>
                <?php
                    if(isset($data["user"])){
                ?>
                    (<a href="<?=PAGE_DOMAIN?>/user/<?=$this->u->user2URL($data["user"])?>" target="_blank"><?=$data["user"]?></a>)
                <?php
                    }
                ?>
            </p>
            <p>PRECIO DEL PEDIDO: <?=$data["total_vendedor"]?></p>
            <p>GASTOS DE ENVÍO: <?=$data["total_envio_pedido"]?></p>
            <p>PEDIDO REALIZADO: <?=$data["fecha_pedido"]?></p>
            <p>FECHA DE PAGO: <?=$data["fecha_pago"]?></p>
            <p>FECHA DE ENVÍO: <?=$data["fecha_envio"]?></p>
            <p>FECHA DE CANCELACIÓN: <?=$data["fecha_cancelacion"]?></p>
            <p>FECHA DE COMPLETADO: <?=$data["fecha_completado"]?></p>
            <p>ESTADO:
            <select class="selectpicker select-estado">
                <?=$data["estado_selector"]?>
            </select>
            <p>MÉTODO DE PAGO: <?=$data["metodo_pago"]?></p>
            <p>OBSERVACIONES: <?=$data["observaciones"]?></p>
            <p>LOCALIZADOR: <a href="https://track.aftership.com/<?=$data["localizador"]?>" target="_blank"><?=$data["localizador"]?></a></p>
        </div>
        <div class="col-md-6">
            <h3>DATOS DE ENVÍO:</h3>
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
    </div>
</div>
