<div id="color_selector" class="aligncenter">
        <label class="control-label"><p><i class="material-icons">color_lens</i> Selecciona el color:</p></label><br>
    <?php
        foreach($data["lista_colores"] as $color){
    ?>
        <a class="color_selector" href="#" title="<?=$color["valor"]?>" data-color="<?=$color["codigo"]?>">
            <span style="background-color:<?=$color["codigo"]?>; border:1px solid #777;"></span>
        </a>
    <?php
        }
    ?>
</div>
