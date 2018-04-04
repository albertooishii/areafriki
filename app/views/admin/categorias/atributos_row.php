<tr class="valor" data-valor="<?=$data["valor_id"]?>">
    <td><?=$data["valor_valor"]?></td>
    <td><?=$data["valor_codigo"]?></td>
    <td><?=$data["valor_precio_base"]?></td>
    <td><?=$data["valor_beneficio"]?></td>
    <td><?=$data["valor_precio_total"]?></td>
    <td class="center"><a href='/simbiosis/atributos?action=edit&id=<?=$data['valor_id']?>'>Modificar</a></td>
    <!--<td class="center"><a href='/simbiosis/categorias?action=delete&id=<?=$data['valor_id']?>'>Eliminar</a></td>-->
</tr>