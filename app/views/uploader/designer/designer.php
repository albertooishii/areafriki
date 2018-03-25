<?= $data['fpd'] ?>
<p id="upload-text" class="text-center title">¡Sube tu diseño a tantos productos como quieras!</p>
<div class="row cat-buttons">
    <?php
        foreach($data['categorias'] as $categoria) {
    ?>
        <div class="col-md-2 col-sm-2 col-xs-3">
            <div class="card card-plain">
                <a href="#" class="add-product <?=$categoria['nombre']?>" data-category="<?=$categoria['nombre']?>">
                    <div class="card-image">
                        <img src="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/uploader/<?=$categoria['nombre']?>.png">
                    </div>
                </a>
            </div>
            <h3 class="card-title"><?=$categoria['nombre']?></h3>
        </div>
    <?php
        }
    ?>
</div>