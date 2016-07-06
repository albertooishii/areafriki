<div class="container">
<article class="product_file product"  data-id="<?=$data["id_producto"]?>" data-categoria="<?=$data["cat_id"]?>" data-token="<?=$data["dg-token"]?>">
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12 img-design">
            <div class="product_container">
                <div class="montaje">
                    <a href="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["dg-token"]?>.png" data-lightbox="image-1" data-title="<?=$data["dg-nombre"]?>">
                        <img src="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/MONTAJE-<?=$data["dg-token"]?>.jpg">
                    </a>
                </div>
                <figcaption class="product_autor">
                    <a href="/user/<?=$data["username"]?>"><img class='img-circle avatar_thumb' src="<?=PAGE_DOMAIN."/".$data["avatar"]?>"><span class="nomobile">Diseñado por </span><?=$data["username"]?></a>
                </figcaption>
                <div class="product_buttons">
                    <ul>
                        <li class="<?=$data["like_class"]?>-button">
                            <a href="#">
                                <i class="fa fa-heart"></i>
                                <p class="contador"><?=$data["contador_likes"]?></p>
                            </a>
                        </li>
                        <li>
                            <i class="fa fa-eye"></i>
                            <p class="contador"><?=$data["contador_visitas"]?></p>
                        </li>
                        <li class="share-button">
                            <a href="#">
                                <i class="fa fa-share"></i>
                                <p class="contador"><?=$data["contador_shares"]?></p>
                            </a>
                        </li>
                        <li class="coments-button">
                            <a href="#comments" class="disabled">
                                <i class="fa fa-comments"></i>
                                <p class="contador"><?=$data["contador_comments"]?></p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
           <h3><?=$data["dg-nombre"]?></h3>
           <p><?=$data["dg-descripcion"]?></p>
           <h3 id="precio"><?=$data["precio"]?>€</h3>
           <p>Categoría: <a href="/<?=$data["nombre_categoria"]?>"><?=$data["nombre_categoria"]?></a> Etiquetas: <?=$data["tags"]?></p>
           <h4>Personaliza tu diseño:</h4>
           <div class="atributos">
                <?=$data["atributos"]?>
           </div>
            <div class="form-group">
                <label class="control-label"><p><i class="material-icons">add_circle</i> Cantidad:</p></label>
                <input type="number" min="1" name="cantidad" id="cantidad" class="form-control" value="1" style="width:100px;">
            </div>
           <!--<a href="#" id="add-cart" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Añadir al carrito</a>-->
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <header>
                <h3><i class="fa fa-info-circle"></i> CARACTERÍSTICAS DEL PRODUCTO</h3>
                <p><?=$data["cat_desc"]?></p>
            </header>
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
                <div class="new_comment">
                    <div class="comment_avatar">
                        <img src="/<?=$data["avatar"]?>">
                    </div>
                    <div id="new_comment_text">
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
        <div class="col-md-6">
            Sugerencias
        </div>
    </div>
</article>
</div>
