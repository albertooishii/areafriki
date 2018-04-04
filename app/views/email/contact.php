<html>
    <body>
        <p>Nombre: <?=$data["name"]?></p>
        <p>e-mail: <a href='mailto:<?=$data["email"]?>'><?=$data["email"]?></a></p>
        <p>user: <a href='<?=PAGE_DOMAIN?>/user/<?=$this->u->user2URL($this->u->user)?>'><?=$this->u->user?></a></p>
        <p>Teléfono: <?=$data["phone"]?></p>
        <p>Mensaje: <?=$data["text"]?><p>
        
        <p>---------------------------------</p>
        
        <p>IP: <?=$this->getIP()?></p>
        <p>País: <?=$this->getCountry()?></p>
        <p>USER AGENT: <?=$_SERVER['HTTP_USER_AGENT']?></p>
    </body>
</html>