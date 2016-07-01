<tr class="producto-carrito" data-linea="<?=$data["linea"]?>">
    <td><img src="<?=PAGE_DOMAIN?>/designs/<?=$data["dg_autor"]?>/<?=$data["dg_token"]?>/<?=$data["dg_categoria"]?>/thumb-<?=$data["dg_token"]?>.jpg"></td>
    <td>
        <h4><?=$data["dg_nombre"]?> <span>por <a href="user/<?=$data["dg_autor"]?>"><?=$data["dg_autor"]?></a></span></h4>
        <p><?=$data["atributos"]?></p>
    </td>
    <td><h4><?=$data["precio"]?></h4></td>
    <td><input type="number" class="cantidad form-control" min="1" value="<?=$data["cantidad"]?>"></td>
    <td><a class="remove" href="#">Eliminar</a></td>
</tr>
