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
    <div class="row">
        <form id="fileupload" class="formvalidation" method="POST" enctype="multipart/form-data">
            <div class="col-lg-7 col-md-12 col-sm-12 img-design">
                <label>
                   <h4>FOTOGRAFÍAS del producto</h4>
                   <p>Hazle fotos al artículo que quieres vender y súbelas. Formatos permitidos: jpg, png, gif. Máximo de imágenes 4.</p>
                </label>
                <div class="form-group">
                    <input id="file" type="file" multiple class="file-loading" accept="image/*" name="files[]"
                    data-fv-notempty="true"
                    data-fv-notempty-message="Las fotografías son obligatorias."/>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12" id="design-info">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#info"><i class="material-icons">info</i><span class="text-tab nomobile">Información</span></a></li>
                    <li><a data-toggle="tab" href="#stock"><i class="fa fa-cubes"></i><span class="text-tab nomobile">Stock</span></a></li>
                    <li><a data-toggle="tab" href="#envio"><i class="fa fa-truck"></i><span class="text-tab nomobile">Envío</span></a></li>
                    <li><a data-toggle="tab" href="#precio"><i class="fa fa-coffee"></i><span class="text-tab nomobile">Precio</span></a></li>
                </ul>
                <div class="tab-content">
                  <div id="info" class="tab-pane fade in active">
                    <h4>INFORMACIÓN DEL PRODUCTO</h4>
                    <h4>Categoría: <span id="dg-categoria" data-id="<?=$data['dg-id-cat']?>"></span><?=$data['dg-nombre-cat']?></h4>
                    <p class="text-danger">Campos obligatorios *</p>
                    <div class="form-group">
                        <label>
                            <p>* NOMBRE O TÍTULO</p>
                        </label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ponle un nombre a tu producto"
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
                        <h4><i class="material-icons">playlist_add</i> AÑADIR A UNA LISTA</h4>
                        <select class="form-control" id="select-list" name="listas_productos" data-style="btn-warning" data-width="300px">
                            <option disabled selected>Selecciona una lista</option>
                            <?=$data["listas_productos"]?>
                        </select>
                        <label><a href='#' id="add-list">Crear nueva lista</a></label>
                    </div>
                    <div class="form-group">
                        <label>
                            <p>* ETIQUETAS. Añade etiquetas descriptivas separadas por comas para mejorar la búsqueda de tu producto. Ejemplo: gato, negro, bigotes</p>
                        </label>
                        <input type="text" class="form-control" name="tags" id="tokenfield-typeahead" placeholder="Añade etiquetas descriptivas separadas por coma"
                data-fv-notempty="true"
                data-fv-notempty-message="Al menos una etiqueta es obligatoria"/>
                    </div>
                    <div class="form-group">
                        <label>
                            <p>SEGUNDA MANO. Marca la casilla si tu producto es de segunda mano.</p>
                        </label>
                        <div class="togglebutton">
                            <label>
                                <input type="checkbox" name="onoffswitch" id="usadoswitch">
                            </label>
                        </div>
                      </div>
                        <div class="form-group">
                            <a href="#" class="next btn btn-primary btn-raised aligncentermobile" data-href="stock"><i class="fa fa-arrow-right" aria-hidden="true"></i> Siguiente</a>
                        </div>
                  </div>
                  <div id="stock" class="tab-pane fade">
                    <h4>STOCK</h4>
                    <div class="form-group">
                        <div class="togglebutton">
                            <label>
                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox stockswitch" id="stockswitch" checked>
                            </label>
                        </div>
                        <label>
                            <p class="descripcion_stock" style="margin-top:5px;">STOCK AUTOMÁTICO: introduce la cantidad de unidades que tienes de este producto. Se irá descontando una por cada producto vendido, hasta que esté agotado.</p>
                        </label>
                        <div id="stock_automatico">
                            <p>Stock: <input type="number" class="form-control" id="stock" name="stock" min="1" max="99" step="1" value="1" style="width:150px; display:inline-block;" maxlength="4"> Unidades</p>
                        </div>
                        <div id="stock_manual" style="display:none">
                            <p>Tiempo de preparación: <input type="number" class="form-control" id="preparacion" name="preparacion" min="0" max="365" step="1" value="1" style="width:150px; display:inline-block;" disabled="disabled"> Días</p>
                        </div>
                      </div>
                        <div class="form-group">
                            <a href="#" class="next btn btn-primary btn-raised aligncentermobile" data-href="envio"><i class="fa fa-arrow-right" aria-hidden="true"></i> Siguiente</a>
                        </div>
                  </div>

                    <div id="envio" class="tab-pane fade">
                        <div class="form-group">
                            <header><h4>CONFIGURACIÓN DE ENVÍO</h4></header>
                            <p>Gastos de envío: <input type="number" class="form-control" id="gastos_envio" name="gastos_envio" min="0" max="200" step="0.01" value="0.00" style="width:150px; display:inline-block;"> €</p>
                            <p>Tiempo de envío: <input type="number" class="form-control" id="tiempo_envio" name="tiempo_envio" min="0" step="1" value="0" style="width:150px; display:inline-block;" maxlength="4"> Días aprox.</p>
                        </div>
                        <div class="form-group">
                           <a href="#" class="next btn btn-primary btn-raised aligncentermobile" data-href="precio"><i class="fa fa-arrow-right" aria-hidden="true"></i> Siguiente</a>
                        </div>
                    </div>
                    <div id="precio" class="tab-pane fade">
                        <div class="form-group">
                            <header><h4>CONFIGURA TU PRECIO</h4></header>
                            <p>Indica el precio al que quieres vender tu producto:</p>
                            <p>Precio de venta: <input type="number" name="beneficio" class="form-control" id="precio" min="0" max="9999" step="0.01" value="0.00" style="width:150px; display:inline-block;"> €</p>
                        </div>
                        <div class="form-group">
                           <button type="submit" id="venta-submit" class="btn btn-primary btn-round aligncentermobile" name="submit"><i class="fa fa-paper-plane"></i> Publicar</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="token" id="token" value="<?=$data["token"]?>">
            </div>
        </form>
    </div>
</div>
