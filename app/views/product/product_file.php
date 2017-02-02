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
                            <h2 class="product-title title nodesktop notablet text-center"><?=$data["dg-nombre"]?></h2>
                            <div class="montaje">
            <?php
                if($data["cat_parent"]==1){
            ?>
                    <?=$data["montaje"]?>
            <?php
                }else{
            ?>
                                <a href="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["username"])?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/<?=$data["dg-token"]?>-0.jpg" data-lightbox="thumbnail" data-title="<?=$data["dg-nombre"]?>">
                                    <img src="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["username"])?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg">
                                </a>
            <?php
                }
            ?>
                            </div>
                            <div class="footer content">
                                <div class="product_author author">
                                    <a href="/user/<?=$this->u->user2URL($data["username"])?>">
                                        <img class='avatar img-raised' src="<?=PAGE_DOMAIN."/".$data["creador_avatar"]?>">
                                        <span><?=$data["username"]?></span>
                                    </a>
                                </div>
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
                                    <li class="coments-button">
                                        <a href="#coments">
                                            <i class="material-icons">&#xE560;</i>
                                            <span class="contador"><?=$data["contador_comments"]?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </article>
                        <div class="thumbnails image-set row">
                            <?=$data["thumbnails"]?>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <form>
                            <h2 class="product-title title nomobile"><?=$data["dg-nombre"]?></h2>
                            <p class="product-category nomobile">Categoría: <a href="/<?=$data["nombre_categoria"]?>"><?=$data["cat_short_desc"]?></a> <!--Etiquetas: <?=$data["tags"]?>--></p>
                           <h4 class="product-description"><?=$data["dg-descripcion"]?></h4>
                           <h3 class="main-price" id="precio"><?=$data["precio"]?>€</h3>
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
                                <label class="control-label"><p>Cantidad:</p></label>
                                <input type="number" min="1" max="<?=$data["stock"]?>" name="cantidad" step="1" id="cantidad" class="form-control" value="1" style="width:100px;"
                                    data-fv-lessthan-message="El máximo de unidades de este producto es <?=$data["stock"]?>"
                                       data-fv-greaterthan="true"
                                       data-fv-greaterthan-value="1"
                                       data-fv-greaterthan-message="La cantidad debe ser mayor o igual a 1" /><br>
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
                <section class="row">
                    <?php
                        if($data["cat_parent"]==1){
                    ?>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <header>
                            <p><i class="material-icons">&#xE88E;</i> Características del producto:</p>
                            <p><small><?=$data["cat_desc"]?></small></p>
                        </header>
                    </div>
                    <?php
                        }else{
                    ?>
                    <?php
                        }
                    ?>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <p><i class="material-icons">local_shipping</i> Envío y preparación:</p>
                        <?php
                         if(!empty($data["preparacion"])){
                        ?>
                        <p><small>Tiempo de preparación: <?=$data["preparacion"]?> días aprox.</small></p>
                        <?php
                            }
                        ?>
                        <p><small>Tiempo de envío: <?=$data["tiempo_envio"]?> días aprox.</small></p>
                        <?php
                            if(isset($data["gastos_envio"])){
                        ?>
                        <p><small>Gastos de envío: <?=$data["gastos_envio"]?></small></p>
                        <?php
                            }

                        ?>
                    </div>
                </section>
                <section class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12" id="coments">
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
                    </div>
                    <!--<div class="col-md-6">
                        Sugerencias
                    </div>-->
                </section>
            </div>
        </div>
    </div>
</div>
