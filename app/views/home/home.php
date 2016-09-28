<div id="home_banner">
    <a href="<?=PAGE_DOMAIN?>/areastore/pokemongo">
        <div id="home_banner_bg" class="container-fluid" style="background-image:url(<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/home-banner.jpg)"></div>
    </a>
</div>
<div class="container-fluid">
    <!--<?=@$data["header_advertencia"]?>-->
    <?=@$data["primer_login"]?>
</div>
<div id="home_categories" class="nomobile">
    <nav class="navbar">
        <div class="container">
            <ul class="nav navbar-nav text-center aligncenter notablet">
                <li><a href='<?=PAGE_DOMAIN?>/camisetas'>Camisetas</a></li>
                <li><a href='<?=PAGE_DOMAIN?>/sudaderas'>Sudaderas</a></li>
                <li><a href='<?=PAGE_DOMAIN?>/tazas'>Tazas</a></li>
                <li><a href='<?=PAGE_DOMAIN?>/chapas'>Chapas</a></li>
                <li><a href='<?=PAGE_DOMAIN?>/vinilos'>Vinilos</a></li>
                <li><a href='<?=PAGE_DOMAIN?>/lienzos'>Lienzos</a></li>
                <li><a href='<?=PAGE_DOMAIN?>/stickers'>Stickers</a></li>
                <li><a href='<?=PAGE_DOMAIN?>/posters'>Pósters</a></li>
                <li><a href='<?=PAGE_DOMAIN?>/crafts'>Hecho a mano</a></li>
                <li><a href='<?=PAGE_DOMAIN?>/baul'>Nuevo y usado</a></li>
            </ul>
        </div>
        <div id="home_shipping">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <div class="info-horizontal">
                        <div class="icon icon-info">
                            <i class="material-icons">local_shipping</i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">Envío gratuito</h4>
                            <p>Para pedidos de ropa y decoración superiores a 25€.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="info-horizontal">
                        <div class="icon icon-rose">
                            <i class="material-icons">timer</i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">48 horas</h4>
                            <p>Envíos en 48 horas para los productos indicados.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="info-horizontal">
                        <div class="icon icon-success">
                            <i class="material-icons">verified_user</i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">Compra garantizada</h4>
                            <p>En todos los productos de vendedores verificados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
<div class="container carousel_container">
    <?=$data["home_categorias"]?>
</div>
<div class="container-fluid nomobile" id="banner_upload">
    <div class="container">
        <a href="<?=PAGE_DOMAIN?>/upload">
            <h3 class="title">¡<?=PAGE_NAME?> somos todos!</h3>
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
            <h3 class="title aligncentermobile"><i class="material-icons">whatshot</i>On fire</h3>
        </header>
        <?=$data["mas_populares"]?>
    </div>
</div>
<div class="container-fluid" id="ruleta">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <header>
                    <h3 class="title aligncentermobile"><i class="material-icons">shuffle</i> Ruleta de likes</h3>
                    <p>¡Toca los productos que más te gustan y añade un más que merecido like!</p>
                </header>
            </div>
            <div class="col-md-8"><?=$data["ruleta"]?></div>
            <div class="col-md-4" id="showcard"></div>
        </div>
    </div>
</div>
<div class="container carousel_container inner">
    <h3 class="title aligncentermobile">Productos vistos recientemente</h3>
    <?=$data["visitas_recientes"]?>
</div>
<div class="subscribe-line subscribe-line-image">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="text-center">
                    <h3 class="title">Recibe las mejores ofertas en tu email</h3>
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
