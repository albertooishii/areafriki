<div class="coment media">
    <a class="pull-left" href="/user/<?=$data["comment_user"]?>">
        <div class="avatar">
            <img class="media-object" alt="<?=$data["comment_user"]?> avatar" src="/<?=$data["comment_avatar"]?>">
        </div>
    </a>
    <div class="media-body">
        <div class="media-heading">
            <h4 class="comment_user">
                <small>
                    <a href="/user/<?=$data["comment_user"]?>"><?=$data["comment_user"]?></a>
                 · <?=$data["comment_date"]?>
                </small>
            </h4>
        </div>
        <p><?=$data["comment_text"]?></p>
    </div>
</div>
