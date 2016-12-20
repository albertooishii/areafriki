<div class="container wrapper text-center" style="min-height:0px;">
    <h3 class="title">Pedido realizado correctamente</h3>
    <p>¡Enhorabuena!, tu pedido ha sido completado.</p>
    <p>Te iremos informando mediante correo electrónico del estado de tu pedido. Puedes ver todos los detalles en la página <a href="<?=PAGE_DOMAIN?>/myorders">Mis pedidos</a>.</p>

    <a href="<?=PAGE_DOMAIN?>/myorders" class="btn btn-primary btn-round">Ver mis pedidos</a>
    <a href="<?=PAGE_DOMAIN?>" class="btn btn-default btn-round">Ir a la portada</a>
</div>
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
