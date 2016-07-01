<div class="precios_sizes form-group">
    <p>
        <span class="precio_base" style="display:none"><?=$data["precio_base"]?></span>
        <span><?=$data["valor"]?></span><br>
        <span class="beneficio">
            <label>Beneficio: </label><input type="number" step="0.05" min="0" max="<?=$data["beneficio_max"]?>" class="form-control" value="0.00"
                data-fv-lessthan-message="El beneficio debe ser como máximo de <?=$data["beneficio_max"]?>">€
        </span>
        <span style="float:right; margin:5px;">
            <label>Precio final: </label><span class="precio_venta"> <?=$data["precio_base"]?> €</span>
        </span>
        <input type="text" class="slider beneficio_range" name="beneficio[]" data-slider-min="0" data-slider-max="<?=$data["beneficio_max"]?>" data-slider-step="0.05" data-slider-value="0.00" style="padding-left:10px;" maxlength="4"
    data-fv-between-message="El beneficio debe ser como máximo de <?=$data["precio_tope"]-$data["precio_base"]?>€">
    </p>
</div>
