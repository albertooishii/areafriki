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
            <div class="row main main-raised main-product card">
                <div class="col-md-6 col-sm-12 col-xs-12 img-design">
                    <article class="product_card product" data-id="<?=$data["id_producto"]?>" data-categoria="<?=$data["cat_id"]?>" data-token="<?=$data["dg-token"]?>">
                        <div class="montaje">
        <?php
            if($data["cat_parent"]==1){
        ?>
                            <!--<a href="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["dg-token"]?>.png" data-lightbox="image-1" data-title="<?=$data["dg-nombre"]?>">-->
                                <?=$data["montaje"]?>
                            <!--</a>-->
        <?php
            }else{
        ?>
                            <a href="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/<?=$data["dg-token"]?>-0.jpg" data-lightbox="thumbnail" data-title="<?=$data["dg-nombre"]?>">
                                <img src="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg">
                            </a>
        <?php
            }
        ?>
                        </div>
                        <div class="footer content">
                            <div class="product_author author">
                                <a href="/user/<?=$data["username"]?>">
                                    <img class='avatar img-raised' src="<?=PAGE_DOMAIN."/".$data["creador_avatar"]?>">
                                    <span><?=$data["username"]?></span>
                                </a>
                            </div>
                            <ul class="stats product_buttons">
                                <li class="<?=$data["like_class"]?>-button">
                                    <a href="#">
                                        <i class="fa fa-heart"></i>
                                        <span class="contador"><?=$data["contador_likes"]?></span>
                                    </a>
                                </li>
                                <li class="views">
                                    <i class="fa fa-eye"></i>
                                    <span class="contador"><?=$data["contador_visitas"]?></span>
                                </li>
                                <li class="share-button">
                                    <a href="#">
                                        <i class="fa fa-share"></i>
                                        <span class="contador"><?=$data["contador_shares"]?></span>
                                    </a>
                                </li>
                                <li class="coments-button">
                                    <a href="#comments">
                                        <i class="fa fa-comments"></i>
                                        <span class="contador"><?=$data["contador_comments"]?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </article>
                    <div class="thumbnails image-set row">
                        <?=$data["thumbnails"]?>
                    </div>
                    <?php
                        if($data["cat_parent"]==1){
                    ?>
                    <?=$data["color_selector"]?>
                    <header>
                        <h4><i class="fa fa-info-circle"></i> CARACTERÍSTICAS DEL PRODUCTO</h4>
                        <p><?=$data["cat_desc"]?></p>
                    </header>
                    <?php
                        }
                    ?>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12">
                    <form>
                        <h2 class="title"><?=$data["dg-nombre"]?></h2>
                       <h4><?=$data["dg-descripcion"]?></h4>
                       <h3 class="main-price" id="precio"><?=$data["precio"]?>€</h3>
                       <p>Categoría: <a href="/<?=$data["nombre_categoria"]?>"><?=$data["nombre_categoria"]?></a> Etiquetas: <?=$data["tags"]?></p>
                        <?php
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
                            if(!empty($data["preparacion"])){
                        ?>
                                <p>Tiempo de preparación: <?=$data["preparacion"]?> días aprox.</p>
                        <?php
                            }
                        ?>
                                <p>Tiempo de envío: <?=$data["tiempo_envio"]?> días aprox.</p>
                        <?php
                            if(isset($data["gastos_envio"])){
                        ?>
                                <p>Gastos de envío: <?=$data["gastos_envio"]?></p>
                        <?php
                            }
                            if($data["stock"]>0){
                            if($data["puedevender"]){
                        ?>
                        <div class="atributos">
                            <?=$data["atributos"]?>
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
                            <button id="add-cart" type="submit" class="btn btn-primary btn-round"><i class="material-icons">add_shopping_cart</i> Añadir al carrito</button>
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
                        ?>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" id="comments">
                    <header>
                        <h3>COMENTARIOS</h3>
                    </header>
                    <section id="comments_area">
        <?php
            if(isset($_SESSION["login"])){
        ?>
                        <div class="media media-post">
                            <a class="pull-left author" href="/user/<?=$this->u->user?>">
                                <div class="avatar">
                                    <img src="/<?=$data["avatar"]?>">
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
            </div>
        </div>
    </div>
</div>
