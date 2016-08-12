 <header class="masthead">
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sectionsNav">
        <div class="container">
            <div id="navleft" class="navbar-header pull-left">
                <a href="<?=PAGE_DOMAIN?>" title="<?=PAGE_NAME?>" class="navbar-brand">
                    <img class="logo img-responsive nomobile" src="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/logo-header.png" alt="<?=PAGE_NAME?>">
                    <img class="logo img-responsive nodesktop" src="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/icons/android-chrome-128x128.png" alt="<?=PAGE_NAME?>">
                </a>
            </div>
            <div id="navright" class="navbar-header pull-right">
                <ul class="nav navbar-nav navbar-right pull-right">
                    <li>
                        <div class="btn btn-white btn-round btn-raised btn-fab btn-fab-mini" id="header-cart">
                            <a href="/carrito"><i class="material-icons">shopping_cart</i></a>
                        </div>
                        <span id="header-count-carrito"><?=$data["contador-carrito"]?></span>
                    </li>
                    <?php
                        if(isset($_SESSION["login"])){
                    ?>
                    <li class="dropdown pull-right" id="header-user">
                        <a class='profile-photo dropdown-toggle' href="#" data-toggle="dropdown">
                            <div class="profile-photo-small">
                                <img class="img-circle img-responsive" src="<?=PAGE_DOMAIN?>/<?=$this->u->getAvatar()?>">
                            </div>
                            <span class="nomobile" id="login_user" data-user="<?=$this->u->user?>" data-id="<?=$this->u->id?>"><?=$_SESSION["login"]["user"]?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-dark">
                            <li><a href="/user/<?=$_SESSION["login"]["user"]?>"><i class="material-icons">store</i> Mi tienda</a></li>
                            <li><a href="/myorders"><i class="material-icons">history</i> Mis pedidos</a></li>
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
                    <li class="pull-right" id="header-login">
                        <a class='profile-photo' href="/login">
                            <div class="profile-photo-small icon">
                                <img class="img-circle img-responsive" src="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/avatar/user.svg">
                            </div>
                            <span>INICIAR SESIÓN</span>
                        </a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div id="vender-mobile" class="nodesktop">
        <a href="/upload" class="btn btn-primary btn-fab"><i class="material-icons">edit</i></a>
    </div>
</header>
<!-- Modal -->
<div class="modal fade" id="modalDg" tabindex="-1" role="dialog" aria-labelledby="modalDgLabel">
  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="material-icons">clear</i>
				</button>
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
