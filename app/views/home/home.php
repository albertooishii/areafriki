<style>
#feedback{
    display: none !important;
}
</style>

<div id="home">
    <?=$data["secondary-navbar"]?>
    <div id="home_categories">
        <div class="container carousel_container">
                <!--<header>
                    <h1 class="text-center">La tienda friki donde puedes <strong>Comprar</strong> y <strong><a href="<?=PAGE_DOMAIN?>/upload">Vender</strong></h1>
                </header>-->
            <?=$data["home_categorias"]?>
        </div>
    </div>
    <div id="home_posts" class="container">
        <header>
            <h2 class="title aligncentermobile"><i class="material-icons">art_track</i>Últimas entradas del blog</h2>
        </header>
        <div class="row">
            <?=$data["home_posts"]?>
        </div>
        <h3 class="aligncenter"><a href="<?=BLOG_DOMAIN?>" class="btn btn-round btn-primary">Más entradas</a></h3>
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
</div>
