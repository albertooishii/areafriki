<article class="product_card product card zoom" data-id="<?=$data["id_producto"]?>" data-categoria="<?=$data["cat_id"]?>" data-token="<?=$data["dg-token"]?>">
    <div class="content">
        <h5 class="category-social">
            <?=$data["dg-nombre"]?>
        </h5>
    </div>
        <a class="product_url" href="/<?=$data["cat_nombre"]?>/<?=$data["dg-token"]?>">
            <img src="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["username"])?>/<?=$data["dg-token"]?>/<?=$data["cat_nombre"]?>/thumb-<?=$data["dg-token"]?>.jpg" alt="Thumbnail <?=$data["dg-nombre"]?>">
        </a>
        <div class="footer content">
            <div class="product_author author nomobile">
                <a href="/user/<?=$this->u->user2URL($data["username"])?>">
                    <img class='avatar img-raised' src="<?=PAGE_DOMAIN."/".$data["creador_avatar"]?>" alt="Avatar de <?=$data["username"]?>">
                    <span><?=$data["username"]?></span>
                </a>
            </div>
            <ul class="stats product_buttons">
                <li class="precio_card">
                    <?=$data["precio"]?>
                </li>
                <li class="<?=$data["like_class"]?>-button">
                    <a href="#">
                        <i class="material-icons">&#xE87D;</i>
                    </a>
                </li>
                <li class="share-button">
                    <a href="#">
                        <i class="material-icons">&#xE80D;</i>
                    </a>
                </li>
            </ul>
        </div>
</article>
