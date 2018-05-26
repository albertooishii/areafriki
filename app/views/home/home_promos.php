<article id="home_promos" class="inner">
<?php
    if (isset($data['now'])) {
        $data['col'] = isset($data['next']) ? 'col-xl-8 col-lg-8 col-md-8' : 'col-xl-12 col-lg-12 col-md-12';
?>

    <div id="now_promo" data-nowtime="<?=$data['nowtime']?>" data-endtime="<?=$data['endtime']?>" class="product_card <?=$data['col']?> col-sm-12 col-xs-12">
        <div class="card card-plain">
            <a href="<?=PAGE_DOMAIN?>/<?=$data['now']->nombre_categoria?>/<?=$data['now']->dg_token?>">
                <div class="card-image" style="background-color: #222222;">
                    <div class="card-background" style="background-image:url('<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data['now']->user)?>/<?=$data['now']->dg_token?>/<?=$data['now']->dg_token?>.png');"></div>
                </div>
                <div class="product-image card card-plain">
                    <div class="card-image">
                        <img src="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data['now']->user)?>/<?=$data['now']->dg_token?>/<?=$data['now']->nombre_categoria?>/MONTAJE-<?=$data['now']->dg_token?>.jpg" alt="<?=$data['now']->nombre?>">
                    </div>
                </div>
                <span class="while">DURANTE</span>
                <div class="countdown"></div>
                <div class="card-footer">
                    <div class="card-title">
                        <?=$data['now']->nombre?> - 
                        <span class="tachado"><?=$data['now']->precio?></span>
                    </div>
                    <div class="card-subtitle">
                        -<?=$data['now']->porcentaje_desc?>% de Descuento
                    </div>
                    <div class="price-promo">
                        <?=$data['now']->precio_promo?>
                    </div>
                </div>
            </a>
        </div>
    </div>
<?php
    }
    if (isset($data['next'])) {
        $data['col'] = isset($data['now']) ? 'col-md-4' : 'col-xl-12 col-lg-12 col-md-12';
?>
    <div id="next_promo" class="product_card <?=$data['col']?> col-sm-12 col-xs-12">
        <div class="card card-plain">
            <a href="<?=PAGE_DOMAIN?>/<?=$data['next']->nombre_categoria?>/<?=$data['next']->dg_token?>">
                <div class="card-image" style="background-color: #222222">
                    <div class="card-background" style="background-image:url('<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data['next']->user)?>/<?=$data['next']->dg_token?>/<?=$data['next']->nombre_categoria?>/MONTAJE-<?=$data['next']->dg_token?>.jpg');"></div>
                </div>
                <div class="card-header">
                    <span>Desde el <?=strftime('%e de %B', strtotime($data['next']->fecha_inicio))?></span>
                </div>
                <div class="card-footer">
                    <div class="card-subtitle">
                        -<?=$data['next']->porcentaje_desc?>% de Descuento                        
                    </div>
                    <div class="card-title">
                        <?=$data['next']->nombre?>
                    </div>
                </div>
            </a>
        </div>
    </div>
<?php
    }
?>
</article>
