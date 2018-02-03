<div class="col-md-7 img-design">
    <header class="aligncenter"><h3>DISEÑA TU CAMISETA</h3></header>
    <p>Utiliza las herramientas que te ofrecemos para personalizar la camiseta. Toca en "AÑADIR IMAGEN" para montar tu diseño.</p>
    <div id="fpd" class="fpd-container fpd-shadow-0 fpd-topbar fpd-tabs fpd-tabs-side fpd-top-actions-centered fpd-bottom-actions-centered fpd-views-inside-left">
        <div class="fpd-product" data-thumbnail="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/camisetas/preview.png">
            <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/camisetas/background.png" title="Fondo" data-parameters='{"x": 350, "y": 350, "z": 0}' />
            <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/camisetas/base.png" title="Base" data-parameters='{"x": 350, "y": 350, "currentColor":"#FFFFFF", "z":1}' />
            <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/camisetas/shadow.png" title="Shadows" data-parameters='{"x": 350, "y": 350, "z": 2}' />
            <img src="<?=PAGE_DOMAIN?>/vendor/fancy_product_designer/source/images/camisetas/bounding.png" title="Bounding" data-parameters='{"x": 350, "y": 324}' />
        </div>
    </div>
    <?=$data["color_pick"]?>
    <div class="inner">
        <h4><i class="material-icons">info_outline</i>DESCRIPCIÓN DEL PRODUCTO</h4>
        <p><?=$data["cat_desc"]?></p>
    </div>
</div>
<div class="col-md-5" id="design-info">
    <div class="resumen">
        <h4><i class="material-icons">info</i>INFORMACIÓN DEL DISEÑO</h4>
        <h4>Categoría: <span id="dg-categoria" data-id="<?=$data['dg-id-cat']?>"></span><?=$data['dg-nombre-cat']?></h4>
        <p class="text-danger">Campos obligatorios *</p>
        <div class="form-group">
            <label>
                <p>* NOMBRE O TÍTULO</p>
            </label>
            <input type="text" class="form-control" name="nombre" placeholder="Ponle un nombre a tu diseño" maxlength="30" minlength="5"
                data-fv-notempty="true"
                data-fv-notempty-message="El nombre es obligatorio"
                data-fv-stringlength-trim="true"
                data-fv-stringlength-message="El nombre debe tener entre 5 y 30 caracteres"/>
        </div>
        <div class="form-group">
            <label>
                <p>DESCRIPCIÓN</p>
            </label>
            <p><textarea maxlength="250" name="descripcion" style="width:100%;height: 60px; resize:none; overflow:auto;" class="form-control" placeholder="Describe tu diseño"></textarea></p>
        </div>
        <div class="form-group">
            <h4><i class="material-icons">playlist_add</i> AÑADIR A UNA LISTA</h4>
            <select class="form-control" id="select-list" name="listas_productos" data-style="btn-warning" data-width="300px">
                <option disabled selected>Selecciona una lista</option>
                <?=$data["listas_productos"]?>
            </select>
            <label><a href='#' id="add-list">Crear nueva lista</a></label>
        </div>
        <div class="form-group">
            <h4><i class="fa fa-tags"></i> AÑADE ETIQUETAS</h4>
            <label for="tokenfield-typeahead"><p>* Añade etiquetas descriptivas separadas por comas para mejorar la búsqueda de tu producto. Ejemplo: gato, negro, bigotes</p></label>
            <input type="text" class="form-control" name="tags" id="tokenfield-typeahead" placeholder="Añade etiquetas descriptivas separadas por coma"
                data-fv-notempty="true"
                data-fv-notempty-message="Al menos una etiqueta es obligatoria"/>
        </div>
        <div class="form-group">
            <h4><i class="material-icons">print</i> FICHERO PARA IMPRIMIR</h4>
            <label class="control-label">* Formatos aceptados pdf, ai, eps, svg, psd, jpg y png</label>
            <input id="file" type="file" class="file" accept="application/pdf, image/x-eps, application/illustrator, application/postscript, image/svg+xml,  application/octet-stream, image/photoshop, application/psd, image/x-psd, image/psd, image/jpeg, image/pjpeg, image/png" name="design_editable" data-allowed-file-extensions='["ai", "pdf", "eps", "ps", "svg", "psd", "jpg", "jpeg", "png"]' data-show-preview=false data-show-remove=false data-show-upload=false data-language=es
                data-fv-file-maxsize="101000000"
                data-fv-file="true"
                data-fv-file-message="El tamaño máximo permitido para el archivo es de 100MB, prueba a subirlo en otro formato o disminuir la calidad, gracias."
                data-fv-notempty="true"
                data-fv-notempty-message="El archivo editable con el diseño es obligatorio."/>
            <label class="control-label">Es necesario que el fichero para imprimir cumpla los <a href='<?=PAGE_DOMAIN?>/plantillas/<?=$data['dg-nombre-cat']?>.zip'>estándares de calidad</a>.</label>
        </div>
    </div>
    <input type="hidden" name="token" id="token" value="<?=$data["token"]?>">
   <div class="precio">
        <header><h4><i class="fa fa-coffee"></i> CONFIGURA TU BENEFICIO</h4></header>
        <label>
            <p>Indica en el siguiente formulario el beneficio que quieres tener por cada camiseta vendida con este diseño. Te recomendamos poner un precio justo para poder vender más unidades fácilmente.</p>
       </label>
       <div class="form-group">
           <p>
                <span class="precio_base" style="display:none"><?=$data["precio_base"]?></span>
                Tu beneficio: <span class="beneficio"><input type="number" name="beneficio" step="0.01" min="0" max="<?=$data["beneficio_max"]?>" class="form-control" value="0.00"
                data-fv-lessthan-message="El beneficio debe ser como máximo de <?=$data["beneficio_max"]?>">€</span><span data-container="body" data-toggle="tooltip" data-placement="top" title="" data-original-title="Al beneficio marcado se descontará el impuesto sobre el valor añadido correspondiente según la legislación vigente."><i class="material-icons">info_outline</i></span>
                <br>
                <input type="text" class="slider beneficio_range" data-slider-min="0" data-slider-max="<?=$data["beneficio_max"]?>" data-slider-step="0.01" data-slider-value="0.00" style="padding-left:10px;" maxlength="4"
                data-fv-between-message="El beneficio debe ser como máximo de <?=$data["beneficio_max"]?>"><br>
                Precio de venta: <span class="precio_venta"><?=$data["precio_base"]?>€</span>
                <br>
            </p>
       </div>
   </div>
    <div class="form-group">
        <label>
            <p>Doy mi consentimiento para que este diseño pueda ser utilizado con fines no lucrativos.<span data-container="body" data-toggle="tooltip" data-placement="top" title="" data-original-title="Marcando esta casilla das tu consentimiento para que este diseño sea utilizado con fines no lucrativos: banner de entrada a la web, sorteos, concursos, actos benéficos, etc. Siempre se hará mención al autor de la obra."><i class="material-icons">info_outline</i></span></p>
        </label>
        <div class="togglebutton">
            <label>
                <input type="checkbox" name="publi">
            </label>
        </div>
    </div>
   <button type="submit" id="form-submit" class="btn btn-primary btn-lg aligncentermobile btn-round btn-raised"><i class="fa fa-paper-plane"></i> Publicar</button>
</div>
