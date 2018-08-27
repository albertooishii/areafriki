<div class="row" id="share-dialog" data-categoria="<?=$data["dg-categoria"]?>" data-token="<?=$data["dg-token"]?>">
    <div class="col-xs-12">
        <!-- Twitter -->
        <a href="http://twitter.com/home?status=¡<?=$data["dg-text"]?>!, <?=$data["dg-nombre"]?>: <?=$data['url']?> @frikiarea" title="Share on Twitter" target="_blank" class="btn btn-share btn-twitter"><i class="fa fa-twitter"></i> Twitter</a>
    </div>
    <div class="col-xs-12">
         <!-- Facebook -->
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$data['url']?>" data-href="<?=$data['url']?>" title="Share on Facebook" target="_blank" class="btn btn-share btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
    </div>
    <div class="col-xs-12">
        <!-- Google+ -->
        <a href="https://plus.google.com/share?url=<?=$data['url']?>" title="Share on Google+" target="_blank" class="btn btn-share btn-googleplus"><i class="fa fa-google-plus"></i> Google+</a>
    </div>
    <div class="col-xs-12">
        <!-- Pinterest -->
        <a href="https://pinterest.com/pin/create/button/?url=<?=$data['url']?>&media=<?=PAGE_DOMAIN?>/designs/<?=$data["dg-user"]?>/<?=$data["dg-token"]?>/<?=$data["dg-categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg&description=<?=$data["dg-nombre"]?>" title="Share on Pinterest" target="_blank" class="btn btn-share btn-pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest</a>
    </div>
    <div class="col-xs-12">
        <!-- Tumblr -->
        <a href="http://www.tumblr.com/share/link?url=<?=$data['url']?>" target="blank_" class="btn btn-share btn-tumblr"><i class="fa fa-tumblr"></i> Tumblr</a>
    </div>
    <div class="col-xs-12">
        <!-- LinkedIn -->
        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$data['url']?>&title=¡<?=$data["dg-text"]?>!&summary=<?=$data["dg-descripcion"]?>" title="Share on LinkedIn" target="_blank" class="btn btn-share btn-linkedin"><i class="fa fa-linkedin"></i> LinkedIn</a>
    </div>
    <div class="col-xs-12 nodesktop">
        <!-- WhatsApp -->
        <a href="whatsapp://send?text=¡<?=$data["dg-text"]?>!, <?=$data["dg-nombre"]?>: <?=$data['url']?>" target="_blank" class="btn btn-share btn-whatsapp" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i> WhatsApp</a>
    </div>
    <div class="col-xs-12">
        <!-- Telegram -->
        <a href="https://telegram.me/share/url?url=<?=$data['url']?>" target="_blank" class="btn btn-share btn-telegram"><i class="fa fa-paper-plane" aria-hidden="true"></i> Telegram</a>
    </div>
    <div class="col-xs-12">
        <!-- Copiar enlace -->
        <a href="#" class="btn btn-share btn-copy btn-default"><i class="material-icons">content_copy</i> <input type="hidden" value="<?=$data['url']?>">Copiar enlace</a> 
    </div>
    <span id="info_creador" data-user="<?=$data["dg-user"]?>"></span>
</div>
<style>
    .btn-share{
        width: 100%;
        margin: 7px 0;
        padding: 10px;
    }

    .btn-twitter {
        background: #00acee;
        border-radius: 0;
        color: #fff
    }
    .btn-twitter:link, .btn-twitter:visited {
        color: #fff;
    }
    .btn-twitter:active, .btn-twitter:hover {
        background: #0087bd !important;
        color: #fff
    }
    .btn-facebook {
        background: #3b5998;
        border-radius: 0;
        color: #fff
    }
    .btn-facebook:link, .btn-facebook:visited {
        color: #fff
    }
    .btn-facebook:active, .btn-facebook:hover {
        background: #30477a !important;
        color: #fff
    }
    .btn-googleplus {
        background: #e93f2e;
        border-radius: 0;
        color: #fff
    }
    .btn-googleplus:link, .btn-googleplus:visited {
        color: #fff
    }
    .btn-googleplus:active, .btn-googleplus:hover {
        background: #ba3225 !important;
        color: #fff
    }
    .btn-pinterest {
        background: #bd081c;
        border-radius: 0;
        color: #fff
    }
    .btn-pinterest:link, .btn-pinterest:visited {
        color: #fff
    }
    .btn-pinterest:active, .btn-pinterest:hover {
        background: #940616 !important;
        color: #fff
    }
    .btn-whatsapp {
        background: #019501;
        border-radius: 0;
        color: #fff
    }
    .btn-whatsapp:link, .btn-whatsapp:visited {
        color: #fff
    }
    .btn-whatsapp:active, .btn-whatsapp:hover {
        background: #056F05 !important;
        color: #fff
    }
    .btn-tumblr {
        background: #36465D;
        border-radius: 0;
        color: #fff
    }
    .btn-tumblr:link, .btn-tumblr:visited {
        color: #fff
    }
    .btn-tumblr:active, .btn-tumblr:hover {
        background: #2F3D51 !important;
        color: #fff
    }
    .btn-linkedin {
        background: #0e76a8;
        border-radius: 0;
        color: #fff
    }
    .btn-linkedin:link, .btn-linkedin:visited {
        color: #fff
    }
    .btn-linkedin:active, .btn-linkedin:hover {
        background: #0b6087 !important;
        color: #fff
    }
    .btn-telegram {
        background: #2ca5e0;
        border-radius: 0;
        color: #fff
    }
    .btn-telegram:link, .btn-telegram:visited {
        color: #fff
    }
    .btn-telegram:active, .btn-telegram:hover {
        background: #2a96cc !important;
        color: #fff
    }
</style>
