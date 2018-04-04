<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=$data["cat_nombre"]?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?=$data["mensaje"]?> 
<form id="categoriaForm" class="form-horizontal" method="post" action="<?=PAGE_DOMAIN?>/simbiosis/categorias?action=edit&id=<?=$data["id"]?>"
    data-fv-framework="bootstrap"
    data-fv-icon-valid="glyphicon glyphicon-ok"
    data-fv-icon-invalid="glyphicon glyphicon-remove"
    data-fv-icon-validating="glyphicon glyphicon-refresh">

    <div class="form-group">
        <label class="col-md-3 control-label">Nombre de categoría</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="nombre" value="<?=$data["cat_nombre"]?>"
                data-fv-notempty="true"
                data-fv-notempty-message="Nombre de categoría requerida"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Descripción</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="descripcion" value="<?=$data["cat_descripcion"]?>"
                data-fv-notempty="true"
                data-fv-notempty-message="La descripción es obligatoria"

                data-fv-stringlength="true"
                data-fv-stringlength-max="255"
                data-fv-stringlength-message="La descripción tiene como máximo 255 caracteres"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Descripción corta</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="descripcion_corta" value="<?=$data["cat_descripcion_corta"]?>"
                data-fv-stringlength="true"
                data-fv-stringlength-max="255"
                data-fv-stringlength-message="La descripción tiene como máximo 80 caracteres"/>
        </div>
    </div>
<?php
    if(isset($data["cat_precio_base"]) && isset($data["cat_beneficio"])){
?>
    <div class="form-group">
        <label class="col-md-3 control-label">Precio base</label>
        <div class="col-md-6">
            <input type="number" class="form-control" name="precio_base" step="0.01" value="<?=$data["cat_precio_base"]?>"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Beneficio máximo del diseñador</label>
        <div class="col-md-6">
            <input type="number" class="form-control" name="beneficio" step="0.01" value="<?=$data["cat_beneficio"]?>"/>
        </div>
    </div>
<?php
    }
?>
    <input type="hidden" name='id' value="<?=$data['id']?>">
    <div class="form-group">
        <div class="col-xs-9 col-xs-offset-3">
<?php
    if(!empty($data["parent_id"])){
?>
            <a href="<?=PAGE_DOMAIN?>/simbiosis/categorias?action=edit&id=<?=$data["parent_id"]?>" class="btn btn-default">Volver</a>
<?php
    }else{
?>
            <a href="<?=PAGE_DOMAIN?>/simbiosis/categorias" class="btn btn-default">Volver</a>         
<?php
    }
?>
            <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Guardar</button>
        </div>
    </div>
</form>
<?=$data["atributos"]?>
<?=$data["subcategorias"]?>
