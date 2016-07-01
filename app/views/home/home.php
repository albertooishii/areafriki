<div id="video_container">
    <header id="header_video">
        <video autoplay preload="auto" loop="loop" class="full-width">
            <source src="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/header-video.mp4" type="video/mp4"> Tu navegador es muy antiguo y no soporta vídeos, recomendamos actualizarlo a la última versión.
        </video>
        <div class="poster hidden">
            <img src="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/header-thumbnail.png" alt="">
        </div>
    </header>
    <div class="row">
        <div class="col-md-12 container">
            <?=@$data["primer_login"]?>
        </div>
    </div>
</div>
<div class="container wrapper">
    <div>
        <header><h2 class="subhead aligncenter inner">LOS ÚLTIMOS PRODUCTOS</h2></header>
        <?=$data["ultimos_productos"]?>
    </div>
    <div>
        <header><h2 class="subhead aligncenter inner">LOS MÁS VENDIDOS</h2></header>
        <?=$data["mas_vendidos"]?>
    </div>
    <div>
        <header><h2 class="subhead aligncenter inner">LOS MÁS POPULARES</h2></header>
        <?=$data["mas_populares"]?>
    </div>
</div>
<div class="container-fluid inner" id="ruleta">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <header>
                    <h2 class="aligncenter">RULETA DE LIKES!</h2>
                </header>
            </div>
            <div class="col-md-7"><?=$data["ruleta"]?></div>
            <div class="col-md-5">
                <div id="showcard"></div>
            </div>
        </div>
    </div>
</div>
<div class="container wrapper">
    <div>
        <header><h2 class="subhead aligncenter inner">LOS MÁS POPULARES</h2></header>
        <?=$data["mas_populares"]?>
    </div>
</div>
