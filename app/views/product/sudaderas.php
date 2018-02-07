<div id="fpd" class="fpd-container fpd-shadow-0">
    <?php
        if($data["modelo"]=="Capucha"){
    ?>
    <div class="fpd-product" title="Capucha" data-thumbnail="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/capucha/preview.png">
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/capucha/background.png" title="Fondo" data-parameters='{"x": 350, "y": 350, "z":0}' />
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/capucha/base.png" title="Base" data-parameters='{"x": 350, "y": 350, "z":1, "fill": "<?=$data["color"]?>"}' />
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/capucha/shadow.png" title="Shadows" data-parameters='{"x": 350, "y": 350, "z": 2}' />
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/capucha/bounding.png" title="Bounding" data-parameters='{"x": 350, "y": 320}' />
        <img src="<?=$data["img_design"]?>" data-parameters='{"left": <?=$data["left"]?>, "top": <?=$data["top"]?>, "height": <?=$data["height"]?>, "width": <?=$data["width"]?>, "scale": <?=$data["scale"]?>, "z": 3}' title="CustomImage">
    </div>
    <?php
        }elseif($data["modelo"]=="Normal"){
    ?>
    <div class="fpd-product" title="Normal" data-thumbnail="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/normal/preview.png">
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/normal/background.png" title="Fondo" data-parameters='{"x": 350, "y": 350, "z":0}' />
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/normal/base.png" title="Base" data-parameters='{"x": 350, "y": 350, "z":1, "fill": "<?=$data["color"]?>"}' />
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/normal/shadow.png" title="Shadows" data-parameters='{"x": 350, "y": 350, "z": 2}' />
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/normal/bounding.png" title="Bounding" data-parameters='{"x": 350, "y": 320}' />
        <img src="<?=$data["img_design"]?>" data-parameters='{"left": <?=$data["left"]?>, "top": <?=$data["top"]?>, "height": <?=$data["height"]?>, "width": <?=$data["width"]?>, "scale": <?=$data["scale"]?>, "z": 3}' title="CustomImage">
    </div>
    <?php
        }
    ?>
</div>
