<?= $data['fpd'] ?>
<div class="row">
    <?php
        foreach($data['categorias'] as $categoria) {
    ?>
        <div class="col-md-3">
            <div class="card card-plain">
                <a href="#" class="add-product <?=$categoria['nombre']?>" data-category="<?=$categoria['nombre']?>">
                    <div class="card-image">
                        <img src="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/categorias/<?=$categoria['nombre']?>.jpg">
                        <h3 class="card-title"><?=$categoria['nombre']?></h3>
                    </div>
                </a>
            </div>
        </div>
    <?php
        }
    ?>
</div>