<style>
#feedback{
    display: none !important;
}
</style>

<div id="home">
    <?=$data["secondary-navbar"]?>
    <div id="home_categories">
        <div class="container carousel_container">
            <?=$data["home_categorias"]?>
        </div>
    </div>
    <div class="container-fluid nomobile" id="banner_upload">
        <div class="container">
            <a href="<?=PAGE_DOMAIN?>/upload">
                <header> 
                    <h3 class="title">¡<?=PAGE_NAME?> somos todos!</h3>
                </header>
                <h4 class="title">Pon a la venta cualquier producto friki: sube tus diseños, vende tus creaciones artesanales y todo lo que ya no uses.</h4>
                <img src="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/banner-upload.png" alt="sube tus creaciones">
                <h4 class="title">Crea tu propia tienda friki · Tu marcas tus beneficios · Totalmente gratis</h4>
            </a>
            <a href="<?=PAGE_DOMAIN?>/upload" class="btn btn-round btn-primary btn-lg">¡EMPIEZA AHORA!</a>
        </div>
    </div>
    <div class="container carousel_container">
        <div>
            <header>
                <h2 class="title aligncentermobile"><i class="material-icons">whatshot</i>On fire</h2>
            </header>
            <?=$data["mas_populares"]?>
        </div>
    </div>
    <?php
        if(isset($_SESSION["login"])){
    ?>
    <div class="container-fluid" id="ruleta">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <header>
                        <h2 class="title aligncentermobile"><i class="material-icons">shuffle</i> Ruleta de likes</h2>
                    </header>
                    <p>¡Toca los productos que más te gustan y añade un más que merecido like!</p>
                </div>
                <div class="col-md-8"><?=$data["ruleta"]?></div>
                <div class="col-md-4" id="showcard"></div>
            </div>
        </div>
    </div>
    <?php
        }
        if(isset($data["visitas_recientes"])){
    ?>
    <div class="container carousel_container inner">
        <header>
            <h2 class="title aligncentermobile"><i class="material-icons">history</i> Productos vistos recientemente</h2>
        </header>
        <?=$data["visitas_recientes"]?>
    </div>
    <?php
        }
    ?>
    <div class="subscribe-line subscribe-line-image">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="text-center">
                        <header>
                            <h2 class="title">Recibe las mejores ofertas en tu email</h2>
                        </header>
                        <p class="description">
                            Registrate en el boletín informativo para estar al día de las ofertas y novedades de <?=PAGE_NAME?>.
                        </p>
                    </div>
                    <div class="card card-raised card-form-horizontal">
                        <div class="content">
                            <form method="post" action="<?=PAGE_DOMAIN?>/mailing/set">
                                <div class="row">
                                    <div class="col-sm-8">

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">mail</i>
                                            </span>
                                            <div class="form-group is-empty"><input type="email" placeholder="Tu email..." class="form-control" name="email"><span class="material-input"></span></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-primary btn-block">Subscribirse</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
