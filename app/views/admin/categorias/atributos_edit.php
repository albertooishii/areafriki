 <form id="valorForm" class="form-horizontal" method="post" action="?section=simbiosis&node=atributos&action=save"
    data-fv-framework="bootstrap"
    data-fv-icon-valid="glyphicon glyphicon-ok"
    data-fv-icon-invalid="glyphicon glyphicon-remove"
    data-fv-icon-validating="glyphicon glyphicon-refresh">

    <header class="subhead aligncenter">
        <h4>INTRODUCE LOS DATOS DEL VALOR</h4>
    </header>

    <div class="form-group">
        <label class="col-md-3 control-label">Nombre del Valor</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="valor" value="<?=$data["valor"]?>"
                data-fv-notempty="true"
                data-fv-notempty-message="Nombre del valor requerido"/>
        </div>
    </div>

<?php if($data["tipo_attr"]=='size'){?>
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
                <input type="color" value="<?=$data["codigo"]?>" class="form-control" name="codigo"
                    data-fv-color="true"
                    data-fv-color-type="hex"
                    data-fv-color-message="El código no es hexadecimal"/>
        </div>
    </div>
<? } ?>
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
            <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Guardar</button>
        </div>
    </div>
</form>
