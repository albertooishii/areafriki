<div class="producto-carrito content" data-linea="<?=$data["linea"]?>">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-12">
            <img class="img img-raised img-rounded" src="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["dg_autor"])?>/<?=$data["dg_token"]?>/<?=$data["dg_categoria"]?>/thumb-<?=$data["dg_token"]?>.jpg">
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">

<?php
    if($data["dg_autor"]!="areafriki"){
?>
            <h4><a href="<?=PAGE_DOMAIN?>/<?=$data["dg_categoria"]?>/<?=$data["dg_token"]?>"><?=$data["dg_nombre"]?></a></h4>
            <p>por <a href="<?=PAGE_DOMAIN?>/user/<?=$this->u->user2URL($data["dg_autor"])?>"><?=$data["dg_autor"]?></a></p>
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
            <p>Nota: <?=$data["nota"]?></p>
<?php
    }
?>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-3 inner">
            <label>Precio</label>
            <h4>
                <span class="<?=$data['precio_promo']?'tachado':''?>">
                    <?=$data["precio"]?>€
                </span>

<?php
    if (isset($data['precio_promo'])) {
?>
                <span id="promo" class="precio_promo" data-nowtime="<?=$data['nowtime']?>" data-endtime="<?=$data['endtime']?>">
                    - <?=$data["precio_promo"]?>€
                </span>
<?php
    }
?>
            </h4>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-5">
<?php
    if(empty($data["stock"]) || $data["stock"]>1){
?>
            <div class="form-group">
                 <label>Cantidad</label>
                <input type="number" class="cantidad form-control" min="1" value="<?=$data["cantidad"]?>">
            </div>
<?php
    }else{
?>
            <div class="inner">
                 <label>Cantidad</label>
                <h4><?=$data["cantidad"]?></h4>
            </div>
<?php
    }
?>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-3 inner">
            <label>Total</label>
            <h4><?=$data["total_producto"]?>€</h4>
        </div>
        <div class="col-md-1 col-sm-1 col-xs-1 inner">
            <a href="#" rel="tooltip" data-placement="left" title="" class="btn btn-simple remove-producto" data-original-title="Eliminar del carrito">
            <i class="material-icons">remove_shopping_cart</i></a>
        </div>
    </div>

    <div class="row inner">
        <div class="col-md-4">
<?php
    if($data["preparacion"]>0){
?>
            <p>Preparación: <?=$data["preparacion"]?> días aprox.</p>
<?php
    }
?>
        </div>
        <div class="col-md-4">

        </div>
        <div class="col-md-4">
<?php
    if($data["gastos_envio_float"]>0){
?>
            <p>Gastos de envío: <?=$data["gastos_envio"]?></p>
<?php
    }
?>
        </div>
    </div>
    <span class="divider"></span>
</div>
