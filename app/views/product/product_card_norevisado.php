<article class="product_card norevisado" data-id="<?=$data["id_producto"]?>" data-categoria="<?=$data["cat_id"]?>" data-token="<?=$data["dg-token"]?>">
    <div class="product_card_glass"></div>
    <div class="product_info">
        <p class="product_name"><?=$data["dg-nombre"]?></p>
        <p class="product_description"><?=$data["dg-descripcion"]?></p>
    </div>
    <img src="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["cat_nombre"]?>/thumb-<?=$data["dg-token"]?>.jpg">
    <figcaption class="product_autor">
        <a href="/user/<?=$data["username"]?>"><img class='img-circle avatar_thumb' src="<?=PAGE_DOMAIN."/".$data["avatar"]?>"><?=$data["username"]?></a>
    </figcaption>
    <div class="product_buttons">
        <ul>
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
</article>
