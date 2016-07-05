<article class="product_card col-xs-12 col-sm-6 col-md-4 col-xl-3" data-id="<?=$data["id_producto"]?>" data-categoria="<?=$data["cat_id"]?>" data-token="<?=$data["dg-token"]?>">
    <a href="<?=PAGE_DOMAIN?>/user/<?=$data["username"]?>/<?=$data["list_token"]?>">
        <div class="row">
            <div class="product_design col-xl-12 col-md-12 col-sm-12 col-xs-12">
                <img src="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["cat_nombre"]?>/thumb-<?=$data["dg-token"]?>.jpg">
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="product_info">
                    <figcaption class="product_name"><?=$data["list_name"]?></figcaption>
                </div>
            </div>
        </div>
    </a>
</article>
