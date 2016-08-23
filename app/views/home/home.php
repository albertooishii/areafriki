<div id="home_banner">
    <a href="<?=PAGE_DOMAIN?>/areastore/pokemongo">
        <div id="home_banner_bg" class="container-fluid" style="background-image:url(<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/home-banner.jpg)"></div>
    </a>
</div>
<div class="container">
    <!--<?=@$data["header_advertencia"]?>-->
    <?=@$data["primer_login"]?>
</div>
<div class="container carousel_container">
    <div>
        <header><h3 class="subhead aligncenter inner">LOS ÚLTIMOS PRODUCTOS</h3></header>
        <?=$data["ultimos_productos"]?>
    </div>
<?php
    if(!empty($data["mas_vendidos"])){
?>
    <div>
        <header><h3 class="subhead aligncenter inner">LOS MÁS VENDIDOS</h3></header>
        <?=$data["mas_vendidos"]?>
    </div>
<?php
    }
?>
    <div>
        <header><h3 class="subhead aligncenter inner">LOS MÁS POPULARES</h3></header>
        <?=$data["mas_populares"]?>
    </div>
</div>
<div class="container-fluid inner" id="ruleta">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <header>
                    <h3>RULETA DE LIKES</h3>
                    <p>¡Toca los productos que más te gustan y añade un más que merecido like!</p>
                </header>
            </div>
            <div class="col-md-8"><?=$data["ruleta"]?></div>
            <div class="col-md-4" id="showcard"></div>
        </div>
    </div>
</div>
