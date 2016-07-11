<div id="color_selector">
    <label class="control-label"><p><i class="material-icons">color_lens</i> Selecciona el color:</p></label><br>

<?php
    foreach($data["lista_colores"] as $color){
        if(strtoupper($data["color"]) == strtoupper($color["codigo"])){

            $selected='selected';
        }else{
            $selected="";
        }
?>
    <a class="color_selector <?=$selected?> btn btn-just-icon btn-round" href="#" title="<?=$color["valor"]?>" data-color="<?=$color["codigo"]?>" style="background-color:<?=$color["codigo"]?>">
    </a>
<?php
    }
?>
</div>
