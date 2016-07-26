<div id="fpd" class="fpd-container fpd-shadow-0">
    <?php
        if($data["modelo"]=="Capucha"){
    ?>
    <div class="fpd-product" title="Capucha" data-thumbnail="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/capucha/preview.png">
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/capucha/background.png" title="Fondo" data-parameters='{"x": 350, "y": 350, "z":0}' />
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/capucha/base.png" title="Base" data-parameters='{"x": 350, "y": 350, "z":1, "fill": "<?=$data["color"]?>"}' />
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/capucha/shadow.png" title="Shadows" data-parameters='{"x": 350, "y": 350, "z": 2}' />
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/capucha/bounding.png" title="Bounding" data-parameters='{"x": 350, "y": 320}' />
        <img src="<?=$data["img_design"]?>" data-parameters='{"left": <?=$data["left"]?>, "top": <?=$data["top"]?>, "height": <?=$data["height"]?>, "width": <?=$data["width"]?>, "z": 3}' title="CustomImage">
    </div>
    <?php
        }else{
    ?>
    <div class="fpd-product" title="Normal" data-thumbnail="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/normal/preview.png">
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/normal/background.png" title="Fondo" data-parameters='{"x": 350, "y": 350, "z":0}' />
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/normal/base.png" title="Base" data-parameters='{"x": 350, "y": 350, "z":1, "fill": "<?=$data["color"]?>"}' />
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/normal/shadow.png" title="Shadows" data-parameters='{"x": 350, "y": 350, "z": 2}' />
        <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/sudaderas/normal/bounding.png" title="Bounding" data-parameters='{"x": 350, "y": 320}' />
        <img src="<?=$data["img_design"]?>" data-parameters='{"left": <?=$data["left"]?>, "top": <?=$data["top"]?>, "height": <?=$data["height"]?>, "width": <?=$data["width"]?>, "z": 3}' title="CustomImage">
    </div>
    <?php
        }
    ?>
</div>

<script src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/js/fabric.min.js"></script>

<script src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/js/FancyProductDesigner-all.min.js"></script>

<script>
    var $fpd=$('#fpd'),
    pluginOpts = {
        stageHeight: '700',
        width:'700',
        copyable:false,
        elementParameters:{
            draggable:false,
            removable:false,
            resizable:false,
            rotatable:false,
            copyable:false,
            boundingBox: "Bounding",
            boundingBoxMode: "clipping",
        },
        mainBarModules: [''],
        langJSON: '<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/lang/es.json',
        templatesDirectory: '<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/html/'
    },
    fpd = new FancyProductDesigner($fpd, pluginOpts);
</script>
