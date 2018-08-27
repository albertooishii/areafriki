<div class="product-page">
    <?php
        if(!empty($data["color"])){
    ?>
        <style>
        .header-filter::before {background-color: <?=$data["color"]?>; opacity: 0.4;}
        </style>
    <?php
        }
    ?>
    <div class="page-header header-filter" data-parallax="active" style="background-image: url('<?=PAGE_DOMAIN."/".$data["banner"]?>'); background-position: center center;"></div>
    <div class="container wrapper">
        <div class="product_file product-page product"  data-id="<?=$data["id_producto"]?>" data-categoria="<?=$data["cat_id"]?>" data-token="<?=$data["dg-token"]?>">
            <div class="main main-raised main-product card">
                <section class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 img-design">
                        <article class="product_card product" data-id="<?=$data["id_producto"]?>" data-categoria="<?=$data["cat_id"]?>" data-token="<?=$data["dg-token"]?>">
                            <nav id="breadcrumb"><a href="<?=PAGE_DOMAIN?>">Inicio</a> / <a href="<?=PAGE_DOMAIN?>/<?=$data["nombre_categoria"]?>"><?=$data["cat_short_desc"]?></a> / <?=$data["dg-nombre"]?></nav>
                            <h2 class="product-title title nodesktop notablet text-center"><?=$data["dg-nombre"]?></h2>
                            <div class="montaje">
            <?php
                if($data["cat_parent"]==1){
            ?>
                    <?=$data["montaje"]?>
            <?php
                }else{
            ?>
                                <a href="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["username"])?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/<?=$data["dg-token"]?>-0.jpg" data-toggle="lightbox" data-gallery="thumbnail">
                                    <img src="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["username"])?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg">
                                </a>
                                <div class="thumbnails">
                                    <?=@$data["thumbnails"]?>
                                </div>
            <?php
                }
            ?>
                            </div>
                            <div class="product_author author">
                                <a href="/user/<?=$this->u->user2URL($data["username"])?>">
                                    <img class='avatar img-raised' src="<?=PAGE_DOMAIN."/".$data["creador_avatar"]?>">
                                    <span><?=$data["username"]?></span>
                                </a>
                            </div>
                            <div class="footer content nomobile">
                                <ul class="stats product_buttons">
                                    <li class="<?=$data["like_class"]?>-button">
                                        <a href="#">
                                            <i class="material-icons">&#xE87D;</i>
                                            <span class="contador"><?=$data["contador_likes"]?></span>
                                        </a>
                                    </li>
                                    <li class="views">
                                        <i class="material-icons">&#xE417;</i>
                                        <span class="contador"><?=$data["contador_visitas"]?></span>
                                    </li>
                                    <li class="share-button">
                                        <a href="#">
                                            <i class="material-icons">&#xE80D;</i>
                                            <span class="contador"><?=$data["contador_shares"]?></span>
                                        </a>
                                    </li>
                                    <!--<li class="coments-button">
                                        <a href="#coments">
                                            <i class="material-icons">&#xE560;</i>
                                            <span class="contador"><?=$data["contador_comments"]?></span>
                                        </a>
                                    </li>-->
                                </ul>
                            </div>
                            <?php
                                    if($data["cat_parent"]==1){
                                ?>
                                <div>
                                    <header>
                                        <h4>Características del producto</h4>
                                    </header>
                                    <p><small><?=$data["cat_desc"]?></small></p>

                                    <?php
                                        if ($data["samples"] || $data["sample-video"]) {
                                    ?>
                                    <div class="thumbnails image-set">
                                        <header><h4>Muestras</h4></header>
                                        <?=@$data["samples"]?>
                                        <?=@$data['sample-video']?>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <?php
                                    }
                                ?>
                        </article>
                        <!--<div id="coments">
                            <section id="comments_area">
                                <header>
                                    <p><i class="material-icons">forum</i> Comentarios:</p>
                                </header>
                <?php
                    if(isset($_SESSION["login"])){
                ?>
                                <div class="media media-post">
                                    <a class="pull-left author" href="/user/<?=$this->u->user2URL($this->u->user)?>">
                                        <div class="avatar">
                                            <img class="media-object" alt="avatar de <?=$this->u->user?>" src="/<?=$data["avatar"]?>">
                                        </div>
                                    </a>
                                    <div class="media-body" id="new_comment_text">
                                        <div contenteditable="true" class="new-comment-edit" placeholder="Escribe un comentario"></div>
                                    </div>
                                </div>
                <?php
                                                }
                ?>
                                <div id="comments_list">
                                    <?=$data["comments_list"]?>
                                </div>
                            </section>
                        </div>-->
                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <?php
                            if($this->u->id === $data['creador_id'] || $this->u->isAdmin()){
                        ?>
                        <li class="dropdown pull-right" id="product-options">
                            <a class='dropdown-toggle' href="#" data-toggle="dropdown">
                                <i class="material-icons">&#xE5D4;</i>
                            </a>
                            <ul class="dropdown-menu dropdown-dark">
                                <li><a href="/<?=$data['nombre_categoria']?>/<?=$data['dg-token']?>/edit"><i class="material-icons">&#xE254;</i>Editar producto</a></li>
                                <li><a class="remove" href="/<?=$data['nombre_categoria']?>/<?=$data['dg-token']?>/delete"><i class="material-icons">&#xE872;</i>Eliminar producto</a></li>
                            </ul>
                        </li>
                        <?php
                            }
                        ?>
                        <form>
                            <h2 class="product-title title nomobile"><?=$data["dg-nombre"]?></h2>
                            <p class="product-category nomobile">Categoría: <a href="/<?=$data["nombre_categoria"]?>"><?=$data["cat_short_desc"]?></a> <!--Etiquetas: <?=$data["tags"]?>--></p>
                            <p class="product-description"><?=$data["dg-descripcion"]?></p>
                            <h4 class="text-danger" id="promo-countdown"></h4>
                            <h3 class="main-price" id="precio">
                                <span class="<?=$data['precio_promo']?'tachado':''?>">
                                    <?=$data["precio"]?>€
                                </span>
                        <?php
                            if (isset($data['precio_promo'])) {
                        ?>
                                <span id="promo" class="precio_promo" data-nowtime="<?=$data['nowtime']?>" data-endtime="<?=$data['endtime']?>">
                                    - <?=$data["precio_promo"]?>€
                                </span>
                        <?php
                            }
                        ?>
                            </h3>
                            <?php
                            if($data["cat_parent"]==1){
                            ?>
                            <p>Vendido y enviado por: <?=PAGE_NAME?><i class="material-icons text-success" style="margin-left: 5px; vertical-align:bottom;">&#xE8E8;</i></p>
                            <?php
                            }else{
                            ?>
                            <p>Vendido y enviado por: <?=$data["username"]?></p>
                            <?php
                            }
                            if($this->getCountry()=="ES"){
                                if($data["stock"]<=5 && $data["stock"]>0){
                            ?>
                                    <p class="text-warning">¡Últimas <?=$data["stock"]?> unidades!</p>
                            <?php
                                }elseif(isset($data["stock"]) && $data["stock"]<=0){
                            ?>
                                    <p class="text-danger">¡Producto agotado!</p>
                            <?php
                                }
                                if($data["cat_id"]==30){
                            ?>
                                    <p>Estado: <?=$data["usado"]?></p>
                            <?php
                                }
                                if($data["stock"]>0){
                                if($data["puedevender"]){
                                    if(isset($data["cat_parent"])){
                            ?>
                            <?=$data["color_selector"]?>
                            <?php
                                    }
                            ?>
                            <div class="atributos">
                                <?=$data["atributos"]?>
                                <?php
                                if(isset($data["indicaciones_size"])){
                                ?>
                                <p style="font-size:70%;line-height: initial;"><?=$data["indicaciones_size"]?></p>
                                <?php
                                }
                                ?>
                           </div>
                            <?php
                                if($data["stock"]>1){
                            ?>
                            <div class="form-group">
                                <label class="control-label"><p>Cantidad:</p></label>
                                <input type="number" min="1" max="<?=$data["stock"]?>" name="cantidad" step="1" id="cantidad" class="form-control" value="1" style="width:100px;"
                                    data-fv-lessthan-message="El máximo de unidades de este producto es <?=$data["stock"]?>"
                                       data-fv-greaterthan="true"
                                       data-fv-greaterthan-value="1"
                                       data-fv-greaterthan-message="La cantidad debe ser mayor o igual a 1" />
                            </div>
                            <?php
                                }else{
                            ?>
                                    <input type="hidden" value="1" name="cantidad" id="cantidad" class="form-control">
                            <?php
                                }
                            ?>
                            <?php
                                if($data["cat_parent"]!=1){
                            ?>
                            <div class="form-group label-floating">
                                <label class="control-label">Indica el modelo/color en caso de que haya varias opciones para elegir. (opcional)</label>
                                <textarea class="form-control" name="nota" id="nota"></textarea>
                            </div>
                            <?php
                                }
                            ?>
                            <div>
                                <button id="add-cart" type="submit" class="btn btn-primary btn-round aligncentermobile"><i class="material-icons">add_shopping_cart</i> Añadir al carrito</button>

                                <?php
                                    if(!empty($data["preparacion"])){
                                ?>
                                <p><small><i class="material-icons">local_printshop</i> El producto estará terminado en <b><?=$data["preparacion"]?> días</b> aproximadamente.</small></p>
                                <?php
                                    }
                                ?>
                                <p><small><i class="material-icons">local_shipping</i> El producto te llegará en <b><?=$data["tiempo_envio"]?> días</b> aproximadamente<?=!empty($data["preparacion"])?' desde su finalización':''?>. <?=isset($data["gastos_envio"]) ? '<br>Los <b>gastos de envío</b> son de <b>'.$data["gastos_envio"].'</b>.':''?></small></p>
                            </div>
                            <?php
                                }else{
                            ?>
                            <div>
                                <a href="#" id="solicitar_producto"><h4>¡Me gustaría comprar este producto!</h4></a>
                            </div>
                            <?php
                                }
                                }
                            }else{
                            ?>
                                <p class="text-danger">Aún no está disponible la opción de compra desde tu país.<br>Pero puedes vender productos personalizados con tus diseños <a href='<?=PAGE_DOMAIN?>/upload/designs'>OK!</a></p>
                            <?php
                            }
                            ?>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
