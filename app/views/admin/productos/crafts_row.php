<tr class="producto <?=$data["trclass"]?>" data-id="<?=$data["id"]?>">
    <td data-order="<?=strtotime($data["fecha_sql"])?>"><?=$data["fecha"]?></td>
    <td><a target="_blank" href="<?=PAGE_DOMAIN?>/<?=$data["categoria"]?>/<?=$data["token"]?>"><?=$data["nombre"]?></a></td>
    <td><?=$data["descripcion"]?></td>
    <td>
        <a href="<?=PAGE_DOMAIN?>/user/<?=$this->u->user2URL($data["username"])?>" target="_blank"><?=$data["username"]?></a><br>
        <small><small><a href="mailto:<?=$data["email"]?>"><?=$data["email"]?></a></small></small>
    </td>
    <td><?=$data["categoria"]?></td>
    <td>
    <select class="selectpicker select-topic" multiple data-selected-text-format="count > 3">
        <?php
            foreach($data["lista_topics"] as $topic){
                if(in_array($topic["id"], $data["topics_design"])){ 
                    $selected=" selected ";
                }else{$selected="";}
                echo "<option value='".$topic["id"]."' $selected>".$topic["descripcion_corta"]."</option>";
            }
        ?>
    </select>
    </td>
    <td><?=$data["beneficio"]?></td>
    <td>
        <a class="preview" href="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["username"])?>/<?=$data["token"]?>/<?=$data["categoria"]?>/<?=$data["token"]?>-0.jpg" data-lightbox="<?=$data["token"]?>" data-title="<?=$data["nombre"]?>">
            <img src="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["username"])?>/<?=$data["token"]?>/<?=$data["categoria"]?>/thumb-<?=$data["token"]?>.jpg">
        </a>
    </td>
    <td class="center">
        <a class="validar" href="/simbiosis/designs?node=revisar"><i class="material-icons text-success">done</i></a>
    </td>
    <td class="center">
        <a class="denegar" href="/simbiosis/designs?node=denegar"><i class="material-icons text-danger">close</i></a>
    </td>
</tr>
