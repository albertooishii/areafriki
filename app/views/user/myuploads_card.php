<tr class="producto-card" data-producto="<?=$data["producto"]?>">
    <td><a href="<?=PAGE_DOMAIN?>/<?=$data["dg_categoria"]?>/<?=$data["dg_token"]?>"><img src="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["dg_autor"])?>/<?=$data["dg_token"]?>/<?=$data["dg_categoria"]?>/thumb-<?=$data["dg_token"]?>.jpg"></a></td>
    <td>
        <h4><a href="<?=PAGE_DOMAIN?>/<?=$data["dg_categoria"]?>/<?=$data["dg_token"]?>"><?=$data["dg_nombre"]?></a></h4>
        <p>Categoría: <?=ucfirst($data["dg_categoria"])?></p>
        <p><?=$data["tags"]?></p>
    </td>
    <td><h4><?=$data["beneficio"]?></h4></td>
    <td><h4><?=$data["precio_venta"]?></h4></td>
    <td><a class="remove" href="index.php?section=producto&action=delete&id=<?=$data["producto"]?>">Eliminar</a></td>
    <td><a href="index.php?section=producto&action=edit&token=<?=$data["dg_token"]?>&category=<?=$data['dg_id_categoria']?>">Modificar</a></td>
</tr>
