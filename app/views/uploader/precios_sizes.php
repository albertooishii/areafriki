<div class="precios_sizes form-group">
    <p>
        <span class="precio_base" style="display:none"><?=$data["precio_base"]?></span>
        <span><?=$data["valor"]?></span><br>
        <span class="beneficio">
            <label>Beneficio: </label><input type="number" step="0.01" min="0" max="<?=$data["beneficio"]?>" class="form-control" value="0.00"
                required
                data-fv-greaterthan="true"
                data-fv-greaterthan-value="0"
                data-fv-greaterthan-message="No has indicado tu beneficio"
                data-fv-lessthan-message="El beneficio debe ser como máximo de <?=$data["beneficio_formated"]?>">€
        </span>
        <span style="float:right; margin:5px;">
            <label>Precio final: </label><span class="precio_venta"> <?=$data["precio_base_formated"]?> €</span>
        </span>
        <input type="text" class="slider beneficio_range" name="beneficio_<?=$data['categoria']?>[]" data-slider-min="0" data-slider-max="<?=$data["beneficio"]?>" data-slider-step="0.01" data-slider-value="0.00" style="padding-left:10px;" maxlength="4"
    data-fv-between-message="El beneficio debe ser como máximo de <?=$data['beneficio_formated']?>€">
    </p>
</div>
