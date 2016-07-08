<header class='masthead'>
    <div class="container">
        <div id="topbar">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <nav>
                        <div class="navbar-header">
                            <button type="button" class="pull-left navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div id="header_logo" class="navbar-brand nomobile">
                                <a href="<?=PAGE_DOMAIN?>" title="<?=PAGE_NAME?>">
                                    <img class="logo img-responsive" src="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/logo-header.png" alt="<?=PAGE_NAME?>">
                                </a>
                            </div>
                            <ul class="nav navbar-nav pull-right navbar-right">
                                <li><a href="#" id="header_search"><i class="material-icons">search</i></a></li>
                                <!--<li>
                                    <a href="/carrito"><i class="material-icons">shopping_cart</i> <span id="header-count-carrito">(<?=$data["contador-carrito"]?>)</span></a>
                                </li>-->
                                <?php
                                    if(isset($_SESSION["login"])){
                                ?>
                                <li class="dropdown pull-right" id="header-login">
                                    <a class='dropdown-toggle' href="#" data-toggle="dropdown"><img class="img-circle" src="<?=PAGE_DOMAIN?>/<?=$this->u->getAvatar()?>"><span id="login_user"><?=$_SESSION["login"]["user"]?></span><b class="caret"></b></a>
                                    <ul class="dropdown-menu dropdown-dark">
                                        <li><a href="/user/<?=$_SESSION["login"]["user"]?>"><i class="material-icons">store</i> Mi tienda</a></li>
                                        <!--<li><a href="/myorders"><i class="material-icons">history</i> Mis pedidos</a></li>-->
                                        <li><a href="/myuploads"><i class="material-icons">file_upload</i> Mis productos</a></li>
                                        <li class="divider"></li>
                                        <li><a href="/settings"><i class="material-icons">settings</i> Configuración</a></li>
                                    <?php
                                        if($this->u->isAdmin()){
                                    ?>
                                        <li><a href="/simbiosis"><i class="material-icons">dashboard</i> Admin. Panel</a></li>
                                    <?php
                                        }
                                    ?>
                                        <li class="divider"></li>
                                        <li><a href="/logout"><i class="material-icons">power_settings_new</i> Cerrar sesión</a></li>
                                    </ul>
                                </li>
                                <?php
                                    }else{
                                ?>
                                <li><a href="/login"><i class="material-icons">account_circle</i>  Entrar</a></li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="collapse navbar-collapse navbar-responsive-collapse" id="menu">
                            <ul class="nav navbar-nav navbar-left">
                                <li><a href="/"><i class="material-icons">home</i>PORTADA</a></li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    DISEÑOS<b class="caret"></b>
                                </a>
                                    <ul class="dropdown-menu">
                                        <?=$data["categorias_designer_header"]?>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="/crafts">CRAFTS</a>
                                </li>
                                <li class="dropdown">
                                    <a href="/baul">BAÚL</a>
                                </li>
                            </ul>
                        </div>
                        <div id="vender" class="nomobile">
                            <a href="/upload" class="btn btn-raised btn-warning">VENDE TUS CREACIONES</a>
                        </div>
                        <div id="vender-mobile" class="nodesktop">
                            <a href="/upload" class="btn btn-warning btn-fab"><i class="material-icons">edit</i></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<?=@$data["header_advertencia"]?>
<!-- Modal -->
<div class="modal fade" id="modalDg" tabindex="-1" role="dialog" aria-labelledby="modalDgLabel">
  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-modal btn-raised" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
