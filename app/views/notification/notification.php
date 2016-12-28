<li class="notification-container">
    <div class="notification notification_header <?=$data["notification_type"]?> <?=$data["notification_class"]?>" data-fecha='<?=$data["unformat_date"]?>' data-id='<?=$data["id"]?>' data-token='<?=$data["token"]?>' data-categoria='<?=$data["categoria"]?>'>
        <a href="<?=$data["notification_url"]?>">
            <div class="row">
                <div class='col-md-3 col-sm-3 col-xs-3'>
                    <img src="<?=$data["notification_icon"]?>">
                </div>
                <div class='col-md-9 col-sm-9 col-xs-9'>
                    <div class="row">
                        <div class="col-md-10 col-sm-10 col-xs-10">
                            <p class="notification-date"><?=$data["fecha"]?></p>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2 text-right">
                            <div class="remove-notification">
                                <p><i class="material-icons">close</i></p>
                            </div>
                        </div>
                    </div>
                    <div class='notification-text'>
                        <h4><?=$data["notification_title"]?></h4>
                        <p><?=$data["notification_text"]?></p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</li>
