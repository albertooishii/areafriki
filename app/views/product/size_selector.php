<div id="size_selector" class="form-group">
    <label class="control-label"><p><i class="material-icons">zoom_out_map</i> Selecciona el tamaño:</p></label><br>
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
