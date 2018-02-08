 <div class="container">
    <header class="subhead aligncenter col-md-offset-3">
        <h4>INTRODUCE LOS DATOS DEL VALOR</h4>
    </header>

    <form id="valorForm" class="form-horizontal" method="post" action="<?=PAGE_DOMAIN?>/simbiosis/atributos?action=edit&id=<?=$data["id"]?>"
        data-fv-framework="bootstrap"
        data-fv-icon-valid="glyphicon glyphicon-ok"
        data-fv-icon-invalid="glyphicon glyphicon-remove"
        data-fv-icon-validating="glyphicon glyphicon-refresh">

         <?=$data["mensaje"]?>

        <div class="form-group">
            <label class="col-md-3 control-label">Nombre del Valor</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="valor" value="<?=$data["valor"]?>"
                    data-fv-notempty="true"
                    data-fv-notempty-message="Nombre del valor requerido"/>
            </div>
        </div>

    <?php if($data["tipo_attr"]!='color'){?>
        <div class="form-group">
            <label class="col-md-3 control-label">Código o medida del tamaño</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="codigo" value="<?=$data["codigo"]?>"
                    data-fv-notempty="true"
                    data-fv-notempty-message="El código es requerido"/>
            </div>
        </div>
    <?php }else{ ?>
        <div class="form-group">
            <label class="col-md-3 control-label">Código del color</label>
            <div class="col-md-6">
                <div id="cp2" class="input-group colorpicker-component colorpicker-input">
                    <input type="text" value="<?=$data["codigo"]?>" class="form-control" name="codigo" />
                    <span class="input-group-addon"><i></i></span>
                </div>
            </div>
        </div>
    <?php } ?>
        <div class="form-group">
            <label class="col-md-3 control-label">Precio base</label>
            <div class="col-md-6">
                <input type="number" class="form-control" name="precio_base" step="0.01" value="<?=$data["precio_base"]?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Beneficio máximo</label>
            <div class="col-md-6">
                <input type="number" class="form-control" name="beneficio" step="0.01" value="<?=$data["beneficio"]?>"/>
            </div>
        </div>

        <input type="hidden" name='id' value="<?=$data['id']?>">
        <div class="form-group">
            <div class="col-xs-9 col-xs-offset-3">
                <a href="<?=PAGE_DOMAIN?>/simbiosis/categorias?action=edit&id=<?=$data["cat_id"]?>" class="btn btn-default">Volver</a>
                <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Guardar</button>
            </div>
        </div>
    </form>
</div>
