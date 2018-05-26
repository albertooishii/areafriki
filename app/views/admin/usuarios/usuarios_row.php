<tr class="usuario" data-id="<?=$data["id"]?>">
    <td data-order="<?=$data["id"]?>"><?=$data["id"]?></td>
    <td><a href="<?=PAGE_DOMAIN?>/user/<?=$this->u->user2URL($data["user"])?>" target="_blank"><?=$data["user"]?></a></td>
    <td><a href="mailto:<?=$data["email"]?>"><?=$data["email"]?></a></td>
    <td><?=$data["nombre"]?></td>
    <td><?=$data["telefono"]?></td>
    <td><?=$data["idnum"]?></td>
    <td><?=$data["referral"]?></td>
</tr>
