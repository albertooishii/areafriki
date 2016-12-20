<tr class="pedido" data-token="<?=$data["token"]?>">
    <td data-order="<?=strtotime($data["fecha_pedido"])?>"><?=$data["fecha_pedido"]?></td>
    <td><a href="<?=PAGE_DOMAIN?>/simbiosis/pedidos?token=<?=$data["token"]?>"><?=$data["token"]?></a></td>
    <td>
        <?php
            if($data["vendedor_id"]!=0){
        ?>
        <a href="<?=PAGE_DOMAIN?>/user/<?=$this->u->user2URL($data["vendedor"])?>" target="_blank"><?=$data["vendedor"]?></a>
        <?php
            }else{
        ?>
            <?=$data["vendedor"]?>
        <?php
            }
        ?>
    </td>
    <td>
        <?=$data["comprador"]?>
        <?php
            if(isset($data["user"])){
        ?>
            (<a href="<?=PAGE_DOMAIN?>/user/<?=$this->u->user2URL($data["user"])?>" target="_blank"><?=$data["user"]?></a>)
        <?php
            }
        ?>
    </td>
    <td><span class="label label-<?=$data["class_estado"]?>"><?=$data["estado"]?></span></td>
    <td><?=$data["precio"]?></td>
    <td><?=$data["gastos_envio"]?></td>
    <td><?=$data["nota"]?></td>
    <td><?=$data["observaciones"]?></td>
    <td><a href="https://track.aftership.com/<?=$data["localizador"]?>" target="_blank"><?=$data["localizador"]?></a></td>
</tr>
