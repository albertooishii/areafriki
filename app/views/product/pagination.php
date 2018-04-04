<?php
    if($data["totalpages"]>1){
?>
    <div class="col-md-12">
        <ul class="pagination pagination-primary aligncenter">
        <?php
            if($data["curpage"]-1>0){
        ?>
            <li><a href="<?=$data["sourcepage"]?>"> <i class="material-icons">first_page</i></a></li>
            <li><a href="<?=$data["sourcepage"]?>/<?=$data["curpage"]-1?>"> <i class="material-icons">navigate_before</i></a></li>
        <?php
            }
        ?>
        <?php
            for($i=1; $i<=$data["totalpages"]; $i++){
                if($i==$data["curpage"]){
                    echo"<li class='active'><a href='".$data["sourcepage"]."/".$i."'>".$i."</a></li>";
                }else{
                    echo"<li><a href='".$data["sourcepage"]."/".$i."'>".$i."</a></li>";
                }
            }
        ?>
        <?php
            if($data["curpage"]+1<=$data["totalpages"]){
        ?>
            <li><a href="<?=$data["sourcepage"]?>/<?=$data["curpage"]+1?>"> <i class="material-icons">navigate_next</i></a></li>
            <li><a href="<?=$data["sourcepage"]?>/<?=$data["totalpages"]?>"> <i class="material-icons">last_page</i></a></li>
        <?php
            }
        ?>
        </ul>
    </div>
<?php
    }
?>