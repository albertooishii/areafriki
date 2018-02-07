<link rel="stylesheet" href="/app/views/uploader/designs.css">
<div class="container-fluid wrapper">
    <!-- Modal -->
    <div class="modal fade" id="modalDg" tabindex="-1" role="dialog" aria-labelledby="modalDgLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <form class="formvalidation" id="designer" method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="card" id="design-info">
                    <input type="hidden" value="<?=$data['category_parent']?>" name="categoria">
                    <h4><i class="material-icons">info</i> Información del diseño</h4>
                    <p class="text-danger">Campos obligatorios *</p>
                    <div class="form-group label-floating">
                    <label class="control-label">* Ponle un título a tu diseño</label>
                    <input type="text" class="form-control" name="nombre" maxlength="30" minlength="5"
                        required
                        data-fv-notempty="true"
                        data-fv-notempty-message="El nombre es obligatorio"
                        data-fv-stringlength-trim="true"
                        data-fv-stringlength-message="El nombre debe tener entre 5 y 30 caracteres"/>
                        <label><small>Un título sencillo y directo ayuda mucho en la búsqueda del producto.</small></label>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">* Describe tu diseño</label>
                        <p><textarea maxlength="250" name="descripcion" style="width:100%;height: 60px; resize:none; overflow:auto;" required class="form-control"></textarea></p>
                        <label><small>Poner una descripción única y bien detallada es muy importante.</small></label>
                    </div>
                    <div class="form-group">
                        <label class="control-label">* Añade etiquetas descriptivas separadas por coma</label>
                        <input type="text" class="form-control" name="tags" id="tokenfield-typeahead"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Al menos una etiqueta es obligatoria"/>
                        <label><small>Las etiquetas descriptivas ayudan mucho a mejorar la búsqueda de tu producto. Ejemplo: gato, negro, bigotes</small></label>
                    </div>
                    <div class="form-group">
                        <label width="auto">
                            <p><i class="material-icons">view_module</i> CATEGORÍA. Selecciona la categoría temática que mejor se adapte a tu producto.</p>
                        </label>
                        <select class="selectpicker" multiple data-selected-text-format="count > 3" data-style="btn btn-primary btn-round" title="* Selecciona la temática" required data-width="100%" name="topics[]">
                            <?php
                                foreach($data["tematicas"] as $topic){
                            ?>
                            <option value="<?=$topic["id"]?>"><?=$topic["descripcion_corta"]?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>
                            <p><i class="material-icons">playlist_add</i> AÑADIR A UNA LISTA. Las listas permiten organizar tus productos de una manera mucho más cómoda en tu tienda</p>
                        </label>
                        <select class="selectpicker" id="select-list" name="listas_productos" data-style="btn btn-primary btn-round" data-width="100%" title="Selecciona una lista">
                            <?=$data["listas_productos"]?>
                        </select>
                        <label><a href='#' id="add-list">Crear nueva lista</a></label>
                    </div>
                    <div class="form-group">
                        <h4><i class="material-icons">print</i> Archivo para imprimir</h4>
                        <label>Es necesario que el archivo para imprimir cumpla los <a href='<?= PAGE_DOMAIN ?>/plantillas/estandares_calidad.pdf' target="_blank">estándares de calidad<i class="material-icons small">open_in_new</i></a>. Un producto podrá ser rechazado si no pasa la revisión.</label>
                        <label class="control-label">* Formatos aceptados pdf, ai, eps, svg, psd, jpg y png</label>
                        <input id="file" type="file" class="file" accept="application/pdf, image/x-eps, application/illustrator, application/postscript, image/svg+xml,  application/octet-stream, image/photoshop, application/psd, image/x-psd, image/psd, image/jpeg, image/pjpeg, image/png" name="design_editable" data-allowed-file-extensions='["ai", "pdf", "eps", "ps", "svg", "psd", "jpg", "jpeg", "png"]' data-show-preview=false data-show-remove=false data-show-upload=false data-language=es
                            data-fv-file-maxsize="101000000"
                            data-fv-file="true"
                            data-fv-file-message="El tamaño máximo permitido para el archivo es de 100MB, prueba a subirlo en otro formato o disminuir la calidad, gracias."
                            data-fv-notempty="true"
                            data-fv-notempty-message="El archivo editable con el diseño es obligatorio."/>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?= $data["token"] ?>">
                </div>
            </div>
            <div class="col-md-4 img-design">
                <?= $data['designer'] ?>
            </div>
            <div class="col-md-4">
                <?php
                    foreach($data['categorias'] as $categoria) {
                ?>
                <div class="card product-info <?= $categoria['nombre'] ?>">
                    <h4 style="text-transform:capitalize;"><i class="material-icons">info</i> <?=$categoria['nombre']?></h4>
                    <p><?= $categoria['descripcion'] ?></p>
                    <header><h4><i class="fa fa-coffee"></i> Configura el precio de venta</h4></header>
                    <label>
                        <p>Indica cuanto quieres ganar por cada venta de <?=$categoria['nombre']?> con este diseño. Te recomendamos poner un precio justo para poder vender más unidades fácilmente.</p>
                    </label>
                    <?php
                            if (!empty($categoria['precio_base'])) {
                    ?>
                    <div class="form-group">
                        <p>
                            <span class="precio_base" style="display:none"><?= $categoria["precio_base"] ?></span>
                            Tu beneficio: <span class="beneficio"><input type="number" name="beneficio_<?=$categoria['nombre']?>" step="0.01" min="0" max="<?= $categoria["beneficio"] ?>" class="form-control" value="0.00"
                            data-fv-lessthan-message="El beneficio debe ser como máximo de <?= $categoria["beneficio_formated"] ?>€"></span><span data-container="body" data-toggle="tooltip" data-placement="top" title="" data-original-title="Al beneficio marcado se descontará el impuesto sobre el valor añadido correspondiente según la legislación vigente."><i class="material-icons">info_outline</i></span>
                            <br>
                            <input type="text" class="slider beneficio_range" data-slider-min="0" data-slider-max="<?= $categoria["beneficio"] ?>" data-slider-step="0.01" data-slider-value="0.00" style="padding-left:10px;" maxlength="4"
                            data-fv-between-message="El beneficio debe ser como máximo de <?= $categoria["beneficio_formated"] ?>€"><br>
                            Precio de venta: <span class="precio_venta"><?= $categoria["precio_base_formated"] ?>€</span>
                            <br>
                        </p>
                    </div>
                    <?php
                            } else { ?>
                    <div id="precios_sizes">
                        <?=$categoria["precios_slider"]?>
                    </div>
                    <?php      
                            }
                    ?>
                        <header><h4><i class="material-icons">lightbulb_outline</i> Tip del día</h4></header>
                        <p>Puedes utilizar nuestra plantilla de <?= $categoria['nombre'] ?> para asegurarte que quedará con la mejor calidad posible</p>
                        <a class="btn btn-sm btn-primary" href='<?= PAGE_DOMAIN ?>/plantillas/<?= $categoria['nombre'] ?>.zip'><i class="material-icons"></i> Plantilla</a>
                </div>
                    <?php
                        }
                    ?>
                <div class="card">
                    <button type="submit" id="form-submit" class="btn btn-primary btn-lg aligncentermobile btn-round btn-raised"><i class="fa fa-paper-plane"></i> Publicar</button>
                </div>
            </div>
        </div>
    </form>
</div>
