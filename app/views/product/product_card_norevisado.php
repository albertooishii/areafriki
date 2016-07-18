<article class="product_card product card" data-id="<?=$data["id_producto"]?>" data-categoria="<?=$data["cat_id"]?>" data-token="<?=$data["dg-token"]?>">
    <div class="product_card_glass"></div>
    <div class="content">
        <h5 class="category-social">
            <?=$this->cutText($data["dg-nombre"],25)?>
        </h5>
    </div>
        <a class="product_url" href="/<?=$data["cat_nombre"]?>/<?=$data["dg-token"]?>">
            <img src="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["cat_nombre"]?>/thumb-<?=$data["dg-token"]?>.jpg">
        </a>
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
                <li class="share-button">
                    <a href="#"><i class="fa fa-share"></i>
                        <span class="contador"><?=$data["contador_shares"]?></span>
                    </a>
                </li>
                <li class="coments-button">
                    <a href="/<?=$data["cat_nombre"]?>/<?=$data["dg-token"]?>#comments"><i class="fa fa-comments"></i>
                        <span class="contador"><?=$data["contador_comments"]?></span>
                    </a>
                </li>
            </ul>
        </div>
</article>
