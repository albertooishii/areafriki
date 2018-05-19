<div class="container wrapper">
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
    <form id="fileupload" class="formvalidation" method="post" enctype="multipart/form-data" data-id="<?= $data['dg-id-cat'] ?>">
        <div class="row">
            <div class="card">
                <div id="fotos" class="col-md-5">
                    <p>Hazle fotos al artículo que quieres vender y súbelas (4 imágenes máximo).</p>
                    <ul id="media-list" class="clearfix">
                        <li class="myupload">
                            <span>
                                <i class="material-icons">&#xE439;</i>
                                <input type="file" id="picupload" class="picupload" multiple accept="image/*"
                                    data-fv-file-maxfiles="4"
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="Las fotografías son obligatorias."/>
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-7">
                    <ul class="nav nav-tabs" id="tab-menu">
                        <li class="active"><a data-toggle="tab" href="#info"><i class="material-icons">info</i><span class="text-tab">Información</span></a></li>
                        <li><a data-toggle="tab" href="#categories"><i class="material-icons">view_module</i><span class="text-tab">Categorías</span></a></li>
                        <li><a data-toggle="tab" href="#precio"><i class="material-icons">shopping_cart</i><span class="text-tab">Precio</span></a></li>
                    </ul>

                    <div class="tab-content">
                        <!-- pestaña info -->
                        <div id="info" class="tab-pane fade in active">
                            <p>INFORMACIÓN DEL PRODUCTO.</p>
                            <input type="hidden" name="categoria" value="<?= $data['dg-id-cat'] ?>">
                            <p class="text-danger">Campos obligatorios *</p>
                            <div class="form-group label-floating">
                                <label class="control-label">* Ponle un título a tu producto</label>
                                <input type="text" class="form-control" name="nombre" maxlength="30" minlength="5"
                                    required
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="El nombre es obligatorio"
                                    data-fv-stringlength-trim="true"
                                    data-fv-stringlength-message="El nombre debe tener entre 5 y 30 caracteres"/>
                                <label><small>Un título sencillo y directo ayuda mucho en la búsqueda del producto.</small></label>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">* Descripción</label>
                                <p><textarea maxlength="250" minlength="20" name="descripcion" style="width:100%;height: 60px; resize:none; overflow:auto;" class="form-control"
                                    required
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="La descripción es obligatoria"
                                    data-fv-stringlength-trim="true"
                                    data-fv-stringlength-message="La descripción debe tener entre 20 y 350 caracteres"></textarea></p>
                                <label><small>Una descripción única y bien detallada ayuda mucho a que el cliente sepa lo que compra.</small></label>
                            </div>
                            <div class="form-group">
                                <label class="control-label">* Etiquetas de búsqueda</label>
                                <input type="text" class="form-control" name="tags" id="tokenfield-typeahead"
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="Al menos una etiqueta es obligatoria"/>
                                <label><small>Las etiquetas descriptivas separadas por coma ayudan a mejorar la búsqueda de tu producto. Ejemplo: <em>figura, juego de tronos, daenerys</em>.</small></label>
                            </div>
<?php
    if ($data['dg-nombre-cat'] === 'secondhand') {
?>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="usado" id="usadoswitch"><span class="checkbox-material"></span>
                                        SEGUNDA MANO. Marcar si el producto es de segunda mano.
                                    </label>
                                </div>
                            </div>
<?php
    }
?>
                            <div class="form-group">
                                <a href="#" class="next btn btn-primary btn-raised aligncentermobile" data-href="categories"><i class="fa fa-arrow-right" aria-hidden="true"></i> Siguiente</a>
                            </div>
                        </div>

                        <!-- pestaña categorias -->
                        <div id="categories" class="tab-pane fade">
                            <p>CATEGORÍAS.</p>
                            <div class="form-group">
                                <label width="auto">
                                    <p>* Selecciona la categoría y temáticas que mejor se adapten a tu producto.</p>
                                </label>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <select class="selectpicker form-control" data-style="btn btn-primary btn-round" title="Selecciona la categoría" data-width="100%" name="subcategoria" required
                                            data-fv-notempty="true"
                                            data-fv-notempty-message="La categoría es obligatoria">
                                                <?php
                                                foreach ($data["subcategorias"] as $subcategoria) {
                                                    ?>
                                                <option value="<?= $subcategoria["id"] ?>"><?= $subcategoria["descripcion_corta"] ?></option>
                                                <?php

                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <select class="selectpicker form-control" multiple data-selected-text-format="count > 3" data-style="btn btn-primary btn-round" title="Selecciona la temática" required data-width="100%" name="topics[]"
                                            data-fv-notempty="true"
                                            data-fv-notempty-message="La categoría temática es obligatoria">
                                            <?php
                                                foreach ($data["tematicas"] as $topic) {
                                            ?>
                                            <option value="<?= $topic["id"] ?>"><?= $topic["descripcion_corta"] ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>
                                    <p><i class="material-icons">playlist_add</i> AÑADIR A UNA LISTA. Las listas permiten organizar tus productos de una manera mucho más cómoda en tu tienda</p>
                                </label>
                                <select class="selectpicker" id="select-list" name="listas_productos" data-style="btn btn-primary btn-round" data-width="100%" title="Selecciona una lista">
                                    <?= $data["listas_productos"] ?>
                                </select>
                                <label><a href='#' id="add-list">Crear nueva lista</a></label>
                            </div>
                            <div class="form-group">
                                <a href="#" class="next btn btn-primary btn-raised aligncentermobile" data-href="precio"><i class="fa fa-arrow-right" aria-hidden="true"></i> Siguiente</a>
                            </div>
                        </div>

                        <!-- pestaña precio y envio -->
                        <div id="precio" class="tab-pane fade">
<?php
    if ($data['dg-nombre-cat'] === 'handmades') {
?>
                            <p>GESTIÓN DE STOCK. Indica si tienes el producto o es bajo pedido.</p>
                            <ul class="nav nav-pills nav-pills-primary">
                                <li class="active pill-stock"><a href="#pill-stock" data-toggle="tab">Lo tengo disponible</a></li>
                                <li class="pill-prepa"><a href="#pill-prepa" data-toggle="tab">Bajo pedido</a></li>
                            </ul>
                            <div class="tab-content tab-space">
                                <div class="tab-pane active" id="pill-stock">
                                    Introduce la cantidad de unidades que tienes de este producto. Se irá descontando una por cada producto vendido, hasta que esté agotado.
                                    <div class="form-group" id="stock_automatico">
                                        <p>Stock: <input type="number" class="form-control" id="stock" name="stock" min="1" max="99" step="1" value="1" style="width:150px; display:inline-block;" maxlength="4"> Unidades</p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="pill-prepa">
                                    El producto lo iré teniendo a medida que me lo vayan encargando, no tengo una cantidad fija.
                                    <div class="form-group" id="stock_manual">
                                        <p>Tiempo de preparación: <input type="number" class="form-control" id="preparacion" name="preparacion" disabled min="0" max="365" value="1" step="1" style="width:150px; display:inline-block;"> Días aprox.</p>
                                    </div>
                                </div>
                            </div>
<?php
    }
?>
                            <p>CONFIGURACIÓN DE PRECIO Y ENVÍO.</p>
                            <div class="form-group">
                                <p>*Precio de venta: <input type="number" name="beneficio" class="form-control" id="precio" min="0" max="9999" step="0.01" style="width:150px; display:inline-block;" required
                                data-fv-notempty="true"
                                    data-fv-notempty-message="El precio de venta es."> €</p>
                                <p>*Gastos de envío: <input type="number" class="form-control" id="gastos_envio" name="gastos_envio" min="0" max="200" value="0.00" step="0.01" style="width:150px; display:inline-block;" required
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="Los gastos de envío son obligatorios."> €</p>
                                <p>*Tiempo de envío: <input type="number" class="form-control" id="tiempo_envio" name="tiempo_envio" min="0" step="1" style="width:150px; display:inline-block;" maxlength="4" required 
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="El tiempo de envío es obligatorio."> Días aprox.</p>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="venta-submit" class="btn btn-primary btn-lg btn-round btn-raised aligncentermobile"><i class="fa fa-paper-plane"></i> Subir producto</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?= $data["token"] ?>">
                </div>
            </div>
        </div>
    </form>
</div>
