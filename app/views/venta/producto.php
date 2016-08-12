<div class="producto-carrito content" data-linea="<?=$data["linea"]?>">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-12">
            <img class="img img-raised img-rounded" src="<?=PAGE_DOMAIN?>/designs/<?=$data["dg_autor"]?>/<?=$data["dg_token"]?>/<?=$data["dg_categoria"]?>/thumb-<?=$data["dg_token"]?>.jpg">
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
<?php
    if($data["dg_autor"]!="areafriki"){
?>
            <h4><a href="<?=PAGE_DOMAIN?>/<?=$data["dg_categoria"]?>/<?=$data["dg_token"]?>"><?=$data["dg_nombre"]?></a></h4>
            <p>por <a href="<?=PAGE_DOMAIN?>/user/<?=$data["dg_autor"]?>"><?=$data["dg_autor"]?></a></p>
<?php
    }else{
?>
        <h4><?=$data["dg_nombre"]?></h4>
<?php
    }
    if(!empty($data["atributos"])){
?>
            <p><?=$data["atributos"]?></p>
<?php
    }
    if(!empty($data["nota"])){
?>
            <p><?=$data["nota"]?></p>
<?php
    }
?>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-4 inner text-center">
            <label>Precio</label>
            <h4><?=$data["precio"]?></h4>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-4 text-center">
            <div class="inner">
                 <label>Cantidad</label>
                <h4><?=$data["cantidad"]?></h4>
            </div>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-4 inner text-center">
            <label>Total</label>
            <h4><?=$data["total_producto"]?></h4>
        </div>
    </div>
    <span class="divider inner"></span>
</div>
