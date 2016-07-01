<div id="size_selector" class="form-group">
<label>Selecciona el tamaño:</label><br>
<select class="form-control" id="size">
<?php
    foreach($data as $size){
?>
    <option value="<?=$size["codigo"]?>" data-orden="<?=$size["orden"]?>"><?=$size["valor"]?></option>
<?php
    }
?>
</select>
</div>
