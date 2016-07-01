<tr class="categoria <?=$data["trclass"]?>" data-id="<?=$data["id"]?>">
    <td><?=$data["id"]?></td>
    <td><?=$data["nombre"]?></td>
    <td><?=$data["descripcion"]?></td>
    <td><?=$data["descripcion_corta"]?></td>
    <td class="center"><a href='/simbiosis/categorias?action=edit&id=<?=$data['id']?>'>Modificar</a></td>
    <!--<td class="center"><a class="disabled" href='/simbiosis/categorias?action=delete&id=<?=$data['id']?>'>Eliminar</a></td>
    <td class="center"><a href='/simbiosis/categorias?action=disable&id=<?=$data['id']?>'>Desactivar</a></td>
    <td class="center"><a href='/simbiosis/categorias?action=enable&id=<?=$data['id']?>'>Activar</a></td>-->
</tr>
