<div class="product-page">
    <?php
        if(!empty($data["color"])){
    ?>
        <style>
        .header-filter::before {background-color: <?=$data["color"]?>; opacity: 0.4;}
        </style>
    <?php
        }
    ?>
    <div class="page-header header-filter" data-parallax="active" style="background-image: url('<?=PAGE_DOMAIN."/".$data["banner"]?>'); background-position: center center;"></div>
    <div class="container wrapper">
    <article class="product_file product-page product" data-id="<?=$data["id_producto"]?>">
    <div class="main main-raised main-product card">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12 img-design product_card" data-id="<?=$data["id_producto"]?>" data-categoria="<?=$data["cat_id"]?>" data-token="<?=$data["dg-token"]?>">
                <div class="row">
                    <div class="montaje col-xl-12 col-md-12 col-sm-12 col-xs-12">
    <?php
        if($data["cat_id"]==2 || $data["cat_id"]==30){
    ?>
                        <a href="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["username"])?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/<?=$data["dg-token"]?>-0.jpg" data-lightbox="thumbnail" data-title="<?=$data["dg-nombre"]?>">
                            <img src="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["username"])?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg">
                        </a>
    <?php
        }else{
    ?>
                        <a href="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["username"])?>/<?=$data["dg-token"]?>/<?=$data["dg-token"]?>.png" data-lightbox="thumbnail" data-title="<?=$data["dg-nombre"]?>">
                            <img src="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["username"])?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/MONTAJE-<?=$data["dg-token"]?>.jpg">
                        </a>
    <?php
        }
    ?>
                    </div>
                </div>
                <div class="thumbnails image-set inner">
                    <?=$data["thumbnails"]?>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 col-xs-12">
                <form method="post" action="/index.php?section=producto&action=savechanges">
                    <input type="hidden" name="token" value="<?=$data["dg-token"]?>">
                    <input type="hidden" name="categoria" value="<?=$data["cat_id"]?>">

                    <div class="form-group label-floating">
                        <label class="control-label">* Nombre o título</label>
                        <input type="text" class="form-control product-title title" name="nombre" maxlength="30" minlength="5" value="<?=$data["dg-nombre"]?>"
                            required
                            data-fv-notempty="true"
                            data-fv-notempty-message="El nombre es obligatorio"
                            data-fv-stringlength-trim="true"
                            data-fv-stringlength-message="El nombre debe tener entre 5 y 30 caracteres"/>
                            <label><small>Un título sencillo y directo ayuda mucho en la búsqueda del producto.</small></label>
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">* Describe tu producto</label>
                        <p><textarea maxlength="250" name="descripcion" style="width:100%;height: 60px; resize:none; overflow:auto;" required class="form-control"><?=$data["dg-descripcion"]?></textarea></p>
                        <label><small>Poner una descripción única y bien detallada es muy importante.</small></label>
                    </div>

                    <div class="form-group">
                        <label class="control-label">* Añade etiquetas descriptivas separadas por coma</label>
                        <input type="text" class="form-control" name="tags" id="tokenfield-typeahead" value="<?=$data["tags"]?>"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Al menos una etiqueta es obligatoria"/>
                        <label><small>Las etiquetas descriptivas ayudan mucho a mejorar la búsqueda de tu producto. Ejemplo: gato, negro, bigotes</small></label>
                    </div>

                    <div class="form-group">
                        <label class="control-label" width="auto">
                            <p><i class="material-icons">view_module</i> *CATEGORÍA. Selecciona la categoría temática que mejor se adapte a tu producto.</p>
                        </label>
                        <select class="selectpicker form-control" multiple data-selected-text-format="count > 3" data-style="btn btn-primary btn-round" title="Selecciona la temática" required data-width="100%" name="topics[]"
                            data-fv-notempty="true"
                            data-fv-notempty-message="La categoría temática es obligatoria">
                            <?php
                                foreach($data["tematicas"] as $topic){
                                    if(in_array($topic["id"], $data["topics_design"])){ 
                                        $selected=" selected ";
                                    }else{$selected="";}
                                    echo "<option value='".$topic["id"]."' $selected>".$topic["descripcion_corta"]."</option>";
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
                        <?=$data["beneficio"]?>
    <?php
        if($data["cat_id"]==2 || $data["cat_id"]==30){
            if(!empty($data["stock"])){
    ?>

                        <p>Stock: <input type="number" class="form-control" id="stock" value="<?=$data['stock']?>" name="stock" min="1" max="99" step="1" value="1" style="width:150px; display:inline-block;" maxlength="4"> Unidades</p>
    <?php
            }
            if(empty($data["stock"]) && !empty($data["preparacion"])){
    ?>
                        <p>*Preparación: <input type="number" class="form-control" id="preparacion" name="preparacion" value="<?=$data["preparacion"]?>" min="0" max="365" value="1" step="1" style="width:150px; display:inline-block;" required 
                            data-fv-notempty="true"
                            data-fv-notempty-message="El tiempo de preparación es obligatorio."> Días aprox.</p>
    <?php
            }
    ?>
                        <p>*Tiempo de envío: <input type="number" class="form-control" id="tiempo_envio" name="tiempo_envio" min="0" step="1" value="<?=$data['tiempo_envio']?>" style="width:150px; display:inline-block;" maxlength="4" required 
                            data-fv-notempty="true"
                            data-fv-notempty-message="El tiempo de envío es obligatorio."> Días aprox.</p>
                        <p>*Gastos de envío: <input type="number" class="form-control" id="gastos_envio" name="gastos_envio" min="0" max="200" value="<?=$data['gastos_envio']?>" step="0.01" style="width:150px; display:inline-block;" required
                            data-fv-notempty="true"
                            data-fv-notempty-message="Los gastos de envío son obligatorios."> €</p>
    <?php
        }
    ?>
                    </div>
                    <input class="btn btn-primary btn-raised btn-round aligncentermobile" type="submit" value="Guardar Cambios">
                    <a class="btn btn-default btn-raised btn-round aligncentermobile" href="<?=$_SERVER['HTTP_REFERER']?>">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    </article>
    </div>
</div>