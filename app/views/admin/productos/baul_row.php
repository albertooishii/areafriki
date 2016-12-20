<tr class="producto <?=$data["trclass"]?>" data-id="<?=$data["id"]?>">
    <td data-order="<?=strtotime($data["fecha"])?>"><?=$data["fecha"]?></td>
    <td><a target="_blank" href="<?=PAGE_DOMAIN?>/<?=$data["categoria"]?>/<?=$data["token"]?>"><?=$data["token"]?></a></td>
    <td><?=$data["categoria"]?></td>
    <td><a href="<?=PAGE_DOMAIN?>/user/<?=$this->u->user2URL($data["username"])?>"><?=$data["username"]?></a></td>
    <td><a href="mailto:<?=$data["email"]?>"><?=$data["email"]?></a></td>
    <td><?=$data["nombre"]?></td>
    <td><?=$data["descripcion"]?></td>
    <td><?=$data["beneficio"]?>€</td>
    <td>
        <a class="preview" href="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["username"])?>/<?=$data["token"]?>/<?=$data["categoria"]?>/<?=$data["token"]?>-0.jpg" data-lightbox="<?=$data["token"]?>" data-title="<?=$data["nombre"]?>">
            <img src="<?=PAGE_DOMAIN?>/designs/<?=$this->u->user2URL($data["username"])?>/<?=$data["token"]?>/<?=$data["categoria"]?>/thumb-<?=$data["token"]?>.jpg">
        </a>
    </td>
    <td class="center">
        <a class="validar" href="/simbiosis/designs?node=revisar"><i class="material-icons text-success">done</i></a>
    </td>
    <td class="center">
        <a class="denegar" href="/simbiosis/designs?node=denegar"><i class="material-icons text-danger">close</i></a>
    </td>
</tr>
