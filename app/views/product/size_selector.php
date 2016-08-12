<div id="size_selector" class="form-group">
    <label class="control-label">Selecciona el tamaño:</label><br>
    <select class="form-control" id="size">
<?php
    foreach($data as $size){
?>
        <option value="<?=$size["orden"]?>" data-orden="<?=$size["orden"]?>"><?=$size["valor"]?></option>
<?php
    }
?>
    </select>
</div>
