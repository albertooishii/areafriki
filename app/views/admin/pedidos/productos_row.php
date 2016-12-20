<tr class="producto" data-token="<?=$data["dg_token"]?>">
    <td><a target="_blank" href="<?=PAGE_DOMAIN?>/<?=$data["dg_categoria"]?>/<?=$data["dg_token"]?>"><?=$data["dg_nombre"]?></a></td>
    <td><?=$data["dg_categoria"]?></td>
    <td><a href="<?=PAGE_DOMAIN?>/user/<?=$this->u->user2URL($data["dg_autor"])?>"><?=$data["dg_autor"]?></a></td>
    <td><?=$data["precio"]?></td>
    <td><?=$data["beneficio"]?></td>
    <td><?=$data["atributos"]?></td>
    <td><?=$data["cantidad"]?></td>
    <td><?=$data["total_producto"]?></td>
    <td><?=$data["nota"]?></td>
    <td>
        <img class="preview" src="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["dg_autor"])?>/<?=$data["dg_token"]?>/<?=$data["dg_categoria"]?>/thumb-<?=$data["dg_token"]?>.jpg">
        <?php
            if(!empty($data["file"])){
        ?>
        <a target="_blank" download="" href="<?=PAGE_DOMAIN?>/<?=$data["file"]?>" title="diseño"><i class="material-icons">file_download</i></a>
        <?php
            }
        ?>
    </td>
</tr>
