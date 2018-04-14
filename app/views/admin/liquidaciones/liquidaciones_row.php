<tr class="liquidacion" data-id="<?=$data["id"]?>">
    <td><a href="<?=PAGE_DOMAIN?>/user/<?=$data["user"]?>" target="_blank"><?=$data["user"]?></a></td>
    <td><a href="mailto:<?=$data["email"]?>"><?=$data["email"]?></a></td>
    <td>Estado</td>
    <th>Importe €</th>
    <td><?=$data["banco"]?></td>
    <td><?=$data["paypal"]?> <?php if($data["paypal"]){?><a href="https://www.paypal.com/es/webapps/mpp/send-money-online"><i class="fa fa-external-link" aria-hidden="true"></i></a><?php } ?></td>
    <td><a href="#" target="_blank">Ver pedidos</a></td>
    <th>Fecha Liquidación</th>
    <th>Fecha Límite de pago</th>
    <th>Link para liquidar</th>
</tr>
