 <header class="masthead">
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sectionsNav">
        <div class="container">
            <div id="navleft" class="navbar-header pull-left">
                <button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target="#menu" id="hamburger">
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
                <ul class="nav navbar-nav navbar-right pull-right" id="nav-actions">
                    <li class="nodesktop notablet dropdown">
                        <a href="#" data-target="#search-nav" href="#" data-toggle="collapse" class="search-mobile"><i class="material-icons">search</i></a>
                    </li>                    
                    
                    <form class="navbar-form pull-left nomobile search-container" role="search" action="<?=PAGE_DOMAIN?>" method="get">
                        <div class="form-group form-white">
                            <input type="text" class="form-control" placeholder="Busca productos y artistas" name="search" value="<?=@$_GET["search"]?>" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-white btn-raised btn-fab btn-fab-mini"><i class="material-icons">search</i></button>
                        <div class="dropdown search-results" style="display:none">
                            <ul class="dropdown-menu"></ul>
                        </div>
                    </form>
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
                            <span class="nomobile notablet" id="login_user" data-user="<?=$this->u->user?>" data-userurl="<?=$this->u->user2URL($this->u->user)?>" data-id="<?=$this->u->id?>"><?=$_SESSION["login"]["user"]?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-dark">
                            <li><a href="/user/<?=$this->u->user2URL($_SESSION["login"]["user"])?>"><i class="material-icons">store</i> Mi tienda</a></li>
                            <li><a href="/myorders"><i class="material-icons">history</i> Mis pedidos</a></li>
                            <li><a href="/mysales"><i class="material-icons">monetization_on</i> Mis ventas</a></li>
                            <!--<li><a href="/myuploads"><i class="material-icons">file_upload</i> Mis productos</a></li>-->
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
                        <?php
                            if($this->getURL()==PAGE_DOMAIN."/"){
                        ?>
                        <a href="/register"><span>REGISTRO</span></a>
                        <?php
                            }else{
                        ?>
                        <a href="/register?redirect=<?=$this->getURL()?>"><span>REGISTRO</span></a>
                        <?php
                            }
                        ?>
                    </li>
                    <li>
                        <?php
                            if($this->getURL()==PAGE_DOMAIN."/"){
                        ?>
                        <a href="/login"><span>LOGIN</span></a>
                        <?php
                            }else{
                        ?>
                        <a href="/login?redirect=<?=$this->getURL()?>"><span>LOGIN</span></a>
                        <?php
                            }
                        ?>
                    <?php
                        }
                    ?>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse pull-left" id="menu">
                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown mega-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorías <b class="caret"></b></a>
                        <ul class="dropdown-menu mega-dropdown-menu row">
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Productos personalizados</li>
                                    <li><a href='<?=PAGE_DOMAIN?>/camisetas'>Camisetas</a></li>
                                    <li><a href='<?=PAGE_DOMAIN?>/sudaderas'>Sudaderas</a></li>
                                    <li><a href='<?=PAGE_DOMAIN?>/chapas'>Chapas</a></li>
                                    <li><a href='<?=PAGE_DOMAIN?>/vinilos'>Vinilos</a></li>
                                    <li><a href='<?=PAGE_DOMAIN?>/lienzos'>Lienzos</a></li>
                                    <li><a href='<?=PAGE_DOMAIN?>/tazas'>Tazas</a></li>
                                    <li><a href='<?=PAGE_DOMAIN?>/posters'>Pósters</a></li>                   
                                </ul>
                            </li>
                            <!--<li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Productos hechos a mano</li>
                                    <li><a href="<?=PAGE_DOMAIN?>/ropa-handmade">Ropa y moda</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/complementos-handmade">Complementos y accesorios</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/hogar-handmade">Hogar y decoración</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/cosplay-handmade">Cosplay</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/electronica-handmade">Electrónica</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/toys-handmade">Juegos, figuras y peluches</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/materiales-handmade">Materiales y herramientas</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/otros-handmade">Otros</a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Nuevo y de segunda mano</li>
                                    <li><a href="<?=PAGE_DOMAIN?>/ropa-secondhand">Ropa y moda</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/complementos-secondhand">Complementos y accesorios</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/hogar-secondhand">Hogar y decoración</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/electronica-secondhand">Videojuegos y electrónica</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/lectura-secondhand">Cómics y lectura</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/audiovisual-secondhand">Películas, series y música</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/toys-secondhand">Juegos, figuras y peluches</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/otros-secondhand">Otros</a></li> 
                                </ul>
                            </li>-->
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Manualidades y Segunda Mano</li>
                                    <li><a href="<?=PAGE_DOMAIN?>/handmades">Manualidades</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/secondhand">Nuevo y Segunda Mano</a></li>
                                </ul>
                                <ul>
                                    <li class="dropdown-header">Edición limitada</li>
                                    <li><a href="<?=PAGE_DOMAIN?>/store/pokemongo">Pokémon GO</a></li>
                                    <li><a href="<?=PAGE_DOMAIN?>/store/kawaii">Kawaii</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li id="vender">
                        <a href="/upload" class="text-primary">
                            VENDER
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="https://areafriki.com/blog">
                            BLOG
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="https://gamerafl.es">
                            ÁREA FRIKI LEAGUE
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="collapse nodesktop notablet" id="search-nav">
            <form class="navbar-form search-container" role="search" action="<?=PAGE_DOMAIN?>" method="get">
                <div class="form-group form-white">
                    <input type="text" class="form-control" placeholder="Busca productos y artistas" name="search" value="<?=@$_GET["search"]?>" autocomplete="off" id="search-mobile-input">
                </div>
                <button type="submit" class="btn btn-white btn-raised btn-fab btn-fab-mini"><i class="material-icons">search</i></button>
                <div class="dropdown search-results" style="display:none">
                    <ul class="dropdown-menu"></ul>
                </div>
            </form>
        </div>
    </nav>

    <div id="vender-mobile">
        <a href="/upload" class="btn btn-primary btn-fab"><i class="material-icons">&#xE2C6;</i></a>
    </div>
    <?php
        if(isset($data["primer_login"])){
    ?>
    <div id="primerlogin" class="container-fluid">
        <?=$data["primer_login"]?>
    </div>
    <?php
        }
    ?>
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
<div id="feedback" class="nomobile">
    <a href="/contacto"><i class="material-icons">&#xE87F;</i> Feedback</a>
</div>
<div id="notifications-wrapper"></div>
