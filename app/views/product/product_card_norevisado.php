<article class="product_card product card" data-id="<?=$data["id_producto"]?>" data-categoria="<?=$data["cat_id"]?>" data-token="<?=$data["dg-token"]?>">
    <div class="product_card_glass"></div>
    <div class="content">
        <h5 class="category-social">
            <?=$data["dg-nombre"]?>
        </h5>
        <a class="product_url" href="/<?=$data["cat_nombre"]?>/<?=$data["dg-token"]?>">
            <img src="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["cat_nombre"]?>/thumb-<?=$data["dg-token"]?>.jpg">
        </a>
        <div class="footer">
            <div class="product_autor author">
                <a href="/user/<?=$data["username"]?>"><img class='img-circle avatar_thumb' src="<?=PAGE_DOMAIN."/".$data["avatar"]?>"><?=$data["username"]?></a>
            </div>
            <ul class="stats product_buttons">
                <li class="<?=$data["like_class"]?>-button">
                    <a href="#"><i class="fa fa-heart"></i>
                        <p class="contador"><?=$data["contador_likes"]?></p>
                    </a>
                </li>
                <li class="share-button">
                    <a href="#"><i class="fa fa-share"></i>
                        <p class="contador"><?=$data["contador_shares"]?></p>
                    </a>
                </li>
                <li class="coments-button">
                    <a href="/<?=$data["cat_nombre"]?>/<?=$data["dg-token"]?>#comments"><i class="fa fa-comments"></i>
                        <p class="contador"><?=$data["contador_comments"]?></p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</article>
