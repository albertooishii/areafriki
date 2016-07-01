<div id="color_selector">
<label>Selecciona el color:</label><br>

<?php
    foreach($data["lista_colores"] as $color){
        if(strtoupper($data["color"]) == strtoupper($color["codigo"])){

            $selected='selected';
        }else{
            $selected="";
        }
?>
    <a class="color_selector <?=$selected?>" href="#" title="<?=$color["valor"]?>" data-color="<?=$color["codigo"]?>">
        <span style="background-color:<?=$color["codigo"]?>"></span>
    </a>
<?php
    }
?>
</div>
