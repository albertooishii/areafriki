<p>Precio de venta: <input type="number" class="form-control" id="precio" min="0" step="0.05" value="<?=$data["precio_venta"]?>" style="width:150px; display:inline-block;" maxlength="4"> €</p>

<input type="hidden" value="<?=$data["beneficio_producto"]?>" name="beneficio" id="beneficio">
<p>Tu beneficio: <span class="beneficio"><?=$data["beneficio_producto"]?></span> €</p>
<p>Comisión (7,5%): <span class="comision"><?=$data["comision"]?></span> €</p>
