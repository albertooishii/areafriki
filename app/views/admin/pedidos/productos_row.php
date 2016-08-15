<tr class="producto <?=$data["trclass"]?>" data-token="<?=$data["dg_token"]?>">
    <td><a target="_blank" href="<?=PAGE_DOMAIN?>/<?=$data["dg_categoria"]?>/<?=$data["dg_token"]?>"><?=$data["dg_token"]?></a></td>
    <td><?=$data["dg_nombre"]?></td>
    <td><?=$data["dg_categoria"]?></td>
    <td><a href="<?=PAGE_DOMAIN?>/user/<?=$data["dg_autor"]?>"><?=$data["dg_autor"]?></a></td>
    <td><?=$data["precio"]?></td>
    <td><?=$data["cantidad"]?></td>
    <td><?=$data["total_producto"]?></td>
    <td><?=$data["nota"]?></td>

</tr>
