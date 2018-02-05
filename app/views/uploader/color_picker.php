<div id="color_selector" class="aligncenter">
    <?php
        foreach($data as $color){
    ?>
        <a class="color_selector btn btn-just-icon btn-round" href="#" title="<?=$color["valor"]?>" data-color="<?=$color["codigo"]?>" style="background-color:<?=$color["codigo"]?>; border:1px solid #777;"></a>
    <?php
        }
    ?>
</div>
