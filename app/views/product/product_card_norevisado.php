<article class="product_card col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12" data-id="<?=$data["id_producto"]?>" data-categoria="<?=$data["cat_id"]?>" data-token="<?=$data["dg-token"]?>" style="opacity:0.4;">
    <div class="row">
        <div class="product_design col-xl-9 col-md-9 col-sm-10 col-xs-10">
            <img src="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["cat_nombre"]?>/thumb-<?=$data["dg-token"]?>.jpg">
        </div>
        <div class="product_buttons col-xl-3 col-md-3 col-sm-2 col-xs-2">
            <ul>
                <li class="<?=$data["like_class"]?>-button">
                    <span><i class="fa fa-heart"></i></span>
                    <p class="contador"><?=$data["contador_likes"]?></p>
                </li>
                <li class="share-button">
                    <span><i class="fa fa-share"></i></span>
                    <p class="contador"><?=$data["contador_shares"]?></p>
                </li>
                <li class="coments-button">
                    <span><i class="fa fa-comments"></i></span>
                    <p class="contador"><?=$data["contador_comments"]?></p>
                </li>
            </ul>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="product_info">
                <figcaption class="product_name"><?=$data["dg-nombre"]?></figcaption>
                <p class='product_autor'><?=$data["username"]?></p>
            </div>
        </div>
    </div>
</article>
