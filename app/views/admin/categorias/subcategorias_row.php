<tr class="categoria" data-id="<?=$data["subcat_id"]?>">
    <td><?=$data["subcat_id"]?></td>
    <td><?=$data["subcat_nombre"]?></td>
    <td><?=$data["subcat_descripcion"]?></td>
    <td><?=$data["subcat_descripcion_corta"]?></td>
    <td><?=$data["subcat_precio_base"]?></td>
    <td><?=$data["subcat_beneficio"]?></td>
    <td class="center"><a href='/simbiosis/categorias?action=edit&id=<?=$data['subcat_id']?>'>Modificar</a></td>
    <!--<td class="center"><a href='/simbiosis/categorias?action=delete&id=<?=$data['subcat_id']?>'>Eliminar</a></td>-->
    <td class="center"><a href='/simbiosis/categorias?action=disable&id=<?=$data['subcat_id']?>'>Desactivar</a></td>
    <td class="center"><a href='/simbiosis/categorias?action=enable&id=<?=$data['subcat_id']?>'>Activar</a></td>
</tr>
