<div id="color_selector">
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
