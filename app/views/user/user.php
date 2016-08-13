<div id="user_profile" data-user="<?=$data["username"]?>" data-userid="<?=$data["userid"]?>">
    <div id="user_banner">
        <div id="user_banner_bg" class="dropdown dropdown-toggle container-fluid" style="background-image:url(<?=PAGE_DOMAIN."/".$data["banner"]?>)"></div>
        <input type="file" style="display:none;" accept="image/*" id="edit_banner">
        <ul class='dropdown-menu' id='banner_options'>
            <li id='upload_banner'><a href="#">Cambiar banner</a></li>
            <li id='delete_banner'><a href="#">Eliminar banner</a></li>
            <li class="divider"></li>
            <li id='cancel_banner'><a href="#">Cancelar</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <section id="user_info" class="col-md-3 aligncentermobile">
                <div id="user_avatar" class="dropdown dropdown-toggle">
                    <img id="user_avatar_img" class='img-circle' src="<?=PAGE_DOMAIN."/".$data["avatar"]?>">
                    <input type="file" style="display:none;" accept="image/*" id="edit_avatar">
                    <ul class='dropdown-menu' id='avatar_options'>
                        <li id='upload_avatar'><a href="#">Cambiar avatar</a></li>
                        <li id='delete_avatar'><a href="#">Eliminar avatar</a></li>
                        <li class="divider"></li>
                        <li id='cancel_avatar'><a href="#">Cancelar</a></li>
                    </ul>
                </div>
                <ul>
                    <li class="username aligncenter"><?=$data["username"]?></li>
                    <li>
                        <div class="user_info_description">
                            <span placeholder="Descripción"><?=$data["description"]?></span>
                        </div>
                    </li>
                    <li>
                        <div class="user_info_ocupacion">
                            <i class="material-icons">work</i><span placeholder="Trabajo u ocupación"><?=$data["ocupacion"]?></span>
                        </div>
                    </li>
                    <li>
                        <div class="user_info_intereses">
                            <i class="material-icons">sms</i><span placeholder="Intereses"><?=$data["intereses"]?></span>
                        </div>
                    </li>
                    <li class="aligncenter"><?=$data["edit_button"]?></li>
               </ul>
            </section>
            <section class="col-md-9">
                <div class="row inner">
                    <div class="btn-group btn-group-justified btn-group-raised" id="user_menu">
                        <a href="<?=PAGE_DOMAIN?>/user/<?=$data["username"]?>" class="btn btn-raised btn-default option-button"><i class="material-icons">home</i> Inicio</a>
                        <div class="btn-group">
                            <a href="bootstrap-elements.html" data-target="#" class="btn dropdown-toggle option-button" data-toggle="dropdown"><i class="material-icons">label</i> Categorías <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?=PAGE_DOMAIN?>/user/<?=$data["username"]?>/designs">Diseños</a></li>
                                <li><a href="<?=PAGE_DOMAIN?>/user/<?=$data["username"]?>/crafts">Crafts</a></li>
                                <li><a href="<?=PAGE_DOMAIN?>/user/<?=$data["username"]?>/baul">Baúl</a></li>
                            </ul>
                        </div>
                        <a href="<?=PAGE_DOMAIN?>/user/<?=$data["username"]?>/lists" class="btn btn-raised btn-default option-button"><i class="material-icons">library_books</i> LISTAS</a>
                    </div>
                    <div id="user_products">
                        <header>
                            <h3 class="subhead aligncenter inner">
                                <?=@$data["nombre_lista"]?>
                            </h3>
                        </header>
                        <?=$data["lista_productos"]?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
