<tr class="usuario" data-id="<?=$data["id"]?>">
    <td data-order="<?=$data["id"]?>"><?=$data["id"]?></td>
    <td><a href="<?=PAGE_DOMAIN?>/user/<?=$data["user"]?>" target="_blank"><?=$data["user"]?></a></td>
    <td><a href="mailto:<?=$data["email"]?>"><?=$data["email"]?></a></td>
    <td><?=$data["nombre"]?></td>
    <td><?=$data["telefono"]?></td>
    <td><?=$data["idnum"]?></td>
    <td><?=$data["banco"]?></td>
    <td><?=$data["paypal"]?> <?php if($data["paypal"]){?><a href="https://www.paypal.com/es/webapps/mpp/send-money-online"><i class="fa fa-external-link" aria-hidden="true"></i></a><?php } ?></td>
    <td><?=$data["credito"]?>€</td>
    <td><?=$data["referral"]?></td>
</tr>
