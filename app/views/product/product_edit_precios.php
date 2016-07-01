<span class="precio_base" style="display:none"><?=$data["precio_base"]?></span>
Tu beneficio: <span class="beneficio"><input type="number" name="beneficio" step="0.05" min="0" max="<?=$data["beneficio_max"]?>" class="form-control" value="<?=$data["beneficio_producto"]?>"
data-fv-lessthan-message="El beneficio debe ser como máximo de <?=$data["beneficio_max"]?>">€</span><br>
<input type="text" class="slider beneficio_range" data-slider-min="0" data-slider-max="<?=$data["beneficio_max"]?>" data-slider-step="0.05" data-slider-value="<?=$data["beneficio_producto"]?>" style="padding-left:10px;" maxlength="4"
data-fv-between-message="El beneficio debe ser como máximo de <?=$data["beneficio_max"]?>"><br>
Precio de venta: <span class="precio_venta"><?=$data["precio_base"]+$data["beneficio_producto"]?>€</span>
