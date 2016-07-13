<div class="coment media">
    <a class="pull-left" href="/user/<?=$data["comment_user"]?>">
        <div class="avatar">
            <img class="media-object" alt="<?=$data["comment_user"]?> avatar" src="/<?=$data["comment_avatar"]?>">
        </div>
    </a>
    <div class="comment_text_block">
        <h4 class="comment_user">
            <a href="/user/<?=$data["comment_user"]?>"><?=$data["comment_user"]?></a>
            <small> · <?=$data["comment_date"]?></small>
        </h4>
        <div class="comment_text">
            <p><?=$data["comment_text"]?></p>
        </div>
    </div>
</div>
