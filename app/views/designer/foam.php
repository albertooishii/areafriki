<div class="col-md-7 img-design">
    <header class="aligncenter"><h3>DISEÑA TU FOAM</h3></header>
    <p>Utiliza las herramientas que te ofrecemos para personalizar el foam. Toca en "AÑADIR IMAGEN" para montar tu diseño. . Puedes elegir entre los distintos formatos en "CAMBIAR MODELO".</p>
    <div id="fpd" class="fpd-container fpd-shadow-2 fpd-topbar fpd-tabs fpd-tabs-side fpd-top-actions-centered fpd-bottom-actions-centered fpd-views-inside-left">
        <div class="fpd-category" title="Foam">
            <div class="fpd-product" title="Cuadrado" data-thumbnail="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/foam/cuadrado/cuadrado.png">
                <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/foam/cuadrado/cuadrado.png" title="Strings" data-parameters='{"x": 0, "y": 0}' />
            </div>
            <div class="fpd-product" title="4:3 Horizontal" data-thumbnail="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/foam/4_3/horizontal.png">
                <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/foam/4_3/horizontal.png" title="Strings" data-parameters='{"x": 0, "y": 0}' />
            </div>
            <div class="fpd-product" title="4:3 Vertical" data-thumbnail="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/foam/4_3/vertical.png">
                <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/foam/4_3/vertical.png" title="Strings" data-parameters='{"x": 0, "y": 0}' />
            </div>
            <div class="fpd-product" title="16:9 Horizontal" data-thumbnail="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/foam/16_9/horizontal.png">
                <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/foam/16_9/horizontal.png" title="Strings" data-parameters='{"x": 0, "y": 0}' />
            </div>
            <div class="fpd-product" title="16:9 Vertical" data-thumbnail="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/foam/16_9/vertical.png">
                <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/foam/16_9/vertical.png" title="Strings" data-parameters='{"x": 0, "y": 0}' />
            </div>
            <div class="fpd-product" title="Panorama Horizontal" data-thumbnail="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/foam/panorama/horizontal.png">
                <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/foam/panorama/horizontal.png" title="Strings" data-parameters='{"x": 0, "y": 0}' />
            </div>
            <div class="fpd-product" title="Panorama Vertical" data-thumbnail="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/foam/panorama/vertical.png">
                <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/foam/panorama/vertical.png" title="Strings" data-parameters='{"x": 0, "y": 0}' />
            </div>
            <div class="fpd-design">
                <?=$data["my_designs"]?>
            </div>
        </div>
    </div>
    <div class="inner">
        <h4><i class="material-icons">info_outline</i>DESCRIPCIÓN DEL PRODUCTO</h4>
        <p><?=$data["cat_desc"]?></p>
    </div>
</div>
<div class="col-md-5" id="design-info">
    <div class="resumen">
        <h4><i class="material-icons">info</i>INFORMACIÓN DEL DISEÑO</h4>
        <h4>Categoría: <span id="dg-categoria" data-id="<?=$data['dg-id-cat']?>"></span><?=$data['dg-nombre-cat']?></h4>
        <div class="form-group">
            <label>
                <p>* NOMBRE O TÍTULO</p>
            </label>
            <input type="text" class="form-control" name="nombre" placeholder="Ponle un nombre a tu diseño"
                data-fv-notempty="true"
                data-fv-notempty-message="El nombre es obligatorio" />
        </div>
        <div class="form-group">
            <label>
                <p>DESCRIPCIÓN</p>
            </label>
            <p><textarea maxlength="250" name="descripcion" style="width:100%;height: 60px; resize:none; overflow:auto;" class="form-control" placeholder="Describe tu diseño"></textarea></p>
        </div>
        <div class="form-group">
            <h4><i class="fa fa-tags"></i> AÑADE ETIQUETAS</h4>
            <label>
                <p>* Añade etiquetas descriptivas separadas por comas. Verás que pueden aparecer sugerencias mientras escribes.</p>
            </label>
            <input type="text" class="form-control" name="tags" id="tokenfield-typeahead" placeholder="Añade etiquetas descriptivas separadas por coma"
                data-fv-notempty="true"
                data-fv-notempty-message="Al menos una etiqueta es obligatoria"/>
        </div>
        <div class="form-group">
            <h4><i class="material-icons">print</i> FICHERO PARA IMPRIMIR</h4>
            <label class="control-label">* Formatos aceptados pdf, ai, eps, svg, psd, jpg y png</label>
            <input id="file" type="file" class="file" accept="application/pdf, image/x-eps, application/illustrator, application/postscript, image/svg+xml, application/octet-stream, application/psd, image/x-psd, image/psd, image/jpeg, image/pjpeg, image/png" name="design_editable" data-allowed-file-extensions='["ai", "pdf", "eps", "ps", "svg", "psd", "jpg", "jpeg", "png"]' data-show-preview=false data-show-upload=false data-language=es
                data-fv-file-maxsize="101000000"
                data-fv-file="true"
                data-fv-file-message="El tamaño máximo permitido para el archivo es de 100MB, prueba a subirlo en otro formato o disminuir la calidad, gracias."
                data-fv-notempty="true"
                data-fv-notempty-message="El archivo editable con el diseño es obligatorio."/>
        </div>
    </div>
    <input type="hidden" name="token" id="token" value="<?=$data["token"]?>">
   <div class="precio">
        <header><h4><i class="fa fa-coffee"></i> CONFIGURA TU BENEFICIO</h4></header>
        <label>
            <p>Ajusta el precio de venta para los diferentes tamaños.</p><span data-container="body" data-toggle="tooltip" data-placement="top" title="" data-original-title="Al beneficio marcado se descontará el impuesto sobre el valor añadido correspondiente según la legislación vigente."><i class="material-icons">info_outline</i></span>
       </label>
       <div id="precios_sizes">
            <?=$data["precios_sizes"]?>
       </div>
   </div>
   <button type="submit" id="form-submit" class="btn btn-primary btn-lg aligncentermobile btn-round btn-raised"><i class="fa fa-paper-plane"></i> Publicar</button>
</div>
<script>
    var $fpd=$('#fpd'),
        pluginOpts = {
        //editorMode: true,
        stageHeight: 700,
        width:700,
        hideDialogOnAdd:true,
        customImageParameters: {
            colors: false,
            autoCenter: true,
            removable: true,
            maxH:7000,
            maxW:7000,
            minH:500,
            minW:500,
            resizeToH:400,
            resizable:true,
            draggable:true,
            opacity:0.9,
            boundingBox: "Bounding",
            z:0,
        },
        elementParameters:{
            draggable:false,
            removable:false,
            autoCenter:true,
            resizable:false,
            rotatable:false,
            opacity:1,
        },
        mainBarModules: ['products','images', 'designs'],
        langJSON: '<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/lang/es.json',
        templatesDirectory: '<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/html/'
    },
    fpd = new FancyProductDesigner($fpd, pluginOpts);

</script>
