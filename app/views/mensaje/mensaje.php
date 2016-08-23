<div class="container wrapper text-center">
    <h2 class="title"><?=$data["titulo_mensaje"]?></h2>
    <h4><?=$data["texto_mensaje"]?></h4>
<?php
    if(!isset($data["url"])){
?>
    <a class="btn-round btn-primary btn" href="<?=$_SERVER['HTTP_REFERER']?>">Volver</a>
<?php
    }else{
?>
        <a class="btn-round btn-primary btn" href="<?=$data["url"]?>">Aceptar</a>
<?php
    }
?>
</div>
