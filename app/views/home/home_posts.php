<div class="col-md-4">
    <div class="card card-blog">
        <div class="card-image">
            <a href="<?=$data['url']?>" style="display:block;">
                <img class="img img-raised" src="<?=$data['image']?>" />
            </a>
        </div>

        <div class="card-content">
            <h6 class="category text-info"><a href="<?=BLOG_DOMAIN.'/category/'.$data['category_slug']?>"><?=$data['category_name']?></a></h6>

            <h4 class="card-title">
                <a href="<?=$data['url']?>"><?=$data['title']?></a>
            </h4>

            <p class="card-description"></p>
                <?=$data['description']?> <a href="<?=$data['url']?>"> Leer más </a>
            </p>
            <div class="footer">
                <div class="author">
                    <a href="<?=PAGE_DOMAIN?>/user/<?=$data['author_user']?>">
                        <img src="<?=$data['author_avatar']?>" alt="avatar" class="avatar img-raised">
                        <span><?=$data['author_user']?></span>
                    </a>
                </div>
                <div class="stats">
                    <i class="material-icons">schedule</i> <?=$data['date']?>
                </div>
            </div>
        </div>
    </div>
</div>