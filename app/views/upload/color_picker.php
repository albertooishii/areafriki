<div id="color_selector" class="aligncenter inner">
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
