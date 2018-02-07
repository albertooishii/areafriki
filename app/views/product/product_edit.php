<div class="container wrapper">
<header>
    <h3 class="subhead aligncenter inner">EDICIÓN DE PRODUCTOS</h3>
</header>
<article class="product_file" data-id="<?=$data["id_producto"]?>">
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
            <form class="form-horizontal" method="post" action="index.php?section=producto&action=savechanges">
                <input type="hidden" name="token" value="<?=$data["dg-token"]?>">
                <input type="hidden" name="categoria" value="<?=$data["cat_id"]?>">
                <div class="form-group">
                    <label for="nombre" class="col-lg-2 control-label">Nombre o título</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" id="nombre" name="nombre"
                             placeholder="Nombre" value="<?=$data["dg-nombre"]?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="descripcion" class="col-lg-2 col-xs-2 control-label">Descripción</label>
                    <div class="col-lg-10 col-xs-10">
                        <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Descripción del producto" name="descripcion"><?=$data["dg-descripcion"]?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tokenfield-typeahead" class="col-lg-2 col-xs-2 control-label">Etiquetas</label>
                    <div class="col-lg-10 col-xs-10">
                        <input type="text" class="form-control" name="tags" id="tokenfield-typeahead" value="<?=$data["tags"]?>"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Al menos una etiqueta es obligatoria"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="select-list" class="col-lg-2 col-xs-2 control-label"><i class="material-icons">library_add</i> Añadir a una lista</label>
                    <div class="col-lg-10 col-xs-10">
                        <select class="form-control" id="select-list" name="listas_productos" data-style="btn-warning" data-width="300px">
                            <option disabled selected>Selecciona una lista</option>
                            <?=$data["listas_productos"]?>
                        </select>
                    </div>
                    <label class="col-lg-12 col-xs-12"><a href='#' id="add-list">Crear nueva lista</a></label>
                </div>
                <div class="form-group">
                    <label for="precio" class="col-lg-2 col-xs-2 control-label">Beneficio</label>
                    <div class="col-lg-10 col-xs-10">
                        <?=$data["beneficio"]?>
                    </div>
                </div>
<?php
    if($data["cat_id"]==2 || $data["cat_id"]==30){
        if(!empty($data["stock"])){
?>
                <div class="form-group">
                    <label for="stock" class="col-lg-2 col-xs-2 control-label">Stock</label>
                    <div class="col-lg-8">
                        <input type="number" min="1" name="stock" step="1" id="stock" class="form-control" value="<?=$data["stock"]?>"
                               data-fv-greaterthan="true"
                               data-fv-greaterthan-value="1"
                               data-fv-greaterthan-message="El stock debe ser mayor o igual a 1" />
                    </div>
                    <label for="stock" class="col-lg-2 control-label">Unidades</label>
                </div>
<?php
        }
        if(empty($data["stock"]) && !empty($data["preparacion"])){
?>
                <div class="form-group">
                    <label for="preparacion" class="col-lg-2 control-label">Tiempo de preparación</label>
                    <div class="col-lg-8 col-xs-10">
                        <input type="number" min="1" name="preparacion" step="1" id="preparacion" class="form-control" value="<?=$data["preparacion"]?>"
                               data-fv-greaterthan="true"
                               data-fv-greaterthan-value="1"
                               data-fv-greaterthan-message="Los días deben ser mayor o igual a 1" />
                    </div>
                    <label for="stock" class="col-lg-2 col-xs-2 control-label">Días aprox.</label>
                </div>
<?php
    }
?>
                <div class="form-group">
                    <label for="tiempo_envio" class="col-lg-2 control-label">Tiempo de envío</label>
                    <div class="col-lg-8 col-xs-10">
                        <input type="number" min="1" name="tiempo_envio" step="1" id="tiempo_envio" class="form-control" value="<?=$data["tiempo_envio"]?>"
                               data-fv-greaterthan="true"
                               data-fv-greaterthan-value="1"
                               data-fv-greaterthan-message="Los días deben ser mayor o igual a 1" />
                    </div>
                    <label for="stock" class="col-lg-2 col-xs-2 control-label">Días aprox.</label>
                </div>
                <div class="form-group">
                    <label for="gastos_envio" class="col-lg-2 control-label">Gastos de envío</label>
                    <div class="col-lg-8 col-xs-10">
                        <input type="number" min="0" name="gastos_envio" step="0.01" id="gastos_envio" class="form-control" value="<?=$data["gastos_envio"]?>"/>
                    </div>
                    <label for="stock" class="col-lg-2 col-xs-2 control-label">€</label>
                </div>
<?php
    }
?>
                <input class="btn btn-primary btn-raised aligncenter" type="submit" value="Guardar Cambios">
            </form>
        </div>
    </div>
</article>
</div>
