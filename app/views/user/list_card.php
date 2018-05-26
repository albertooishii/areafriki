<article class="product_card col-xs-12 col-sm-6 col-md-4 col-xl-3">
    <div class="card card-plain">
        <a href="<?=PAGE_DOMAIN?>/user/<?=$this->u->user2URL($data["username"])?>/<?=$data["list_token"]?>">
            <div class="card-image">
                <img src="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["username"])?>/<?=$data["dg-token"]?>/<?=$data["cat_nombre"]?>/thumb-<?=$data["dg-token"]?>.jpg">
                <div class="card-title">
                    <?=$data["list_name"]?>
                </div>
            </div> 
        </a>
    </div>
</article>