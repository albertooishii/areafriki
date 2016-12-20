 <header class="masthead">
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sectionsNav">
        <div class="container">
            <div id="navleft" class="navbar-header pull-left" style="margin-left:5px;">
                <button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target="#menu-store" id="hamburger">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?=PAGE_DOMAIN?>" title="<?=PAGE_NAME?>" class="navbar-brand">
                    <img class="logo img-responsive nomobile notablet" src="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/logo-header.png" alt="<?=PAGE_NAME?>">
                    <img class="logo img-responsive nodesktop" src="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/icons/android-chrome-192x192.png" alt="<?=PAGE_NAME?>">
                </a>
            </div>
            <div id="navright" class="navbar-header pull-right">
                <form class="navbar-form navbar-right" role="search" id="search-container">
                    <div class="form-group form-white">
                        <input type="text" class="form-control" placeholder="Buscar">
                    </div>
                    <div id="search-results" class="dropdown">
                        <ul class="dropdown-menu"></ul>
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right pull-right" id="nav-actions">
                    <?php
                        if($data["contador-carrito"]>0){
                    ?>
                    <li id="header-cart">
                        <a href="/carrito"><i class="material-icons">shopping_cart</i>
                            <span class="header-count"><?=$data["contador-carrito"]?></span>
                        </a>

                    </li>
                    <?php
                        }else{
                    ?>
                    <li id="header-cart" style="display:none;">
                        <a href="/carrito"><i class="material-icons">shopping_cart</i>
                            <span class="header-count"><?=$data["contador-carrito"]?></span>
                        </a>

                    </li>
                    <?php
                        }
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
                            <li><a href="/mysales"><i class="material-icons">monetization_on</i> Mis ventas</a></li>
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
                    <li class="dropdown pull-right" id="header-notifications">
                        <a id="notifications-icon" class='dropdown-toggle' href="#" data-toggle="dropdown">
                            <i class="material-icons">notifications</i>
                            <?php
                                if($data["contador-notificaciones"]==0){
                                    $count_noti_style="display:none";
                                }else{
                                    $count_noti_style="";
                                }
                            ?>
                            <span class="header-count" style="<?=$count_noti_style?>"><?=$data["contador-notificaciones"]?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-dark" id="notifications-panel">
                            <li id="notifications-actions">
                                <div class="row">
                                    <div class="col-md-10">
                                        <a href="#" class="clear-notifications"><i class="material-icons">clear_all</i> Limpiar notificaciones</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <?php
                        }else{
                    ?>
                    <li>
                        <a href="/register?redirect=<?=$this->getURL()?>"><span>REGISTRO</span></a>
                    </li>
                    <li>
                        <a href="/login?redirect=<?=$this->getURL()?>"><span>LOGIN</span></a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="collapse navbar-collapse pull-left text-center" id="menu-store">
    <ul class="nav navbar-nav">
        <li>
            <a href="<?=PAGE_DOMAIN?>/store/kawaii" class="btn btn-round btn-nintenderos"><img src="<?=PAGE_DOMAIN?>/app/views/store/kawaii/logo_icon.png" class="store-icon"></a>
        </li>
        <li>
            <a href="<?=PAGE_DOMAIN?>/store/nintenderos" class="btn btn-round btn-nintenderos"><img src="<?=PAGE_DOMAIN?>/app/views/store/nintenderos/icon.png" class="store-icon">NINTENDEROS</a>
        </li>
        <li>
            <a href="<?=PAGE_DOMAIN?>/store/pokemongo" class="btn btn-round btn-facebook"><img src="<?=PAGE_DOMAIN?>/app/views/store/pokemongo/icon.png" class="store-icon">POKéMON GO</a>
        </li>
    </ul>
</div>
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
