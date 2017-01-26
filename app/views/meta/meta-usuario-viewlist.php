<?php
    $data["page_title"]="Lista de ".$data["nombre_lista"]." en la tienda friki de ".$data["username"];
    $data["descripcion"]="Entra para ver la lista de ".$data["nombre_lista"]." en la tienda friki de ".$data["username"]." en ".PAGE_NAME.".";
?>
<title><?=$data['page_title']?> | <?=PAGE_NAME?></title>
<meta name="description" content="<?=$data["descripcion"]?>">

<!--OpenGraph/facebook-->
<meta property="og:title" content="<?=$data["page_title"]?> | <?=PAGE_NAME?>" />
<meta property="og:description" content="<?=$data["descripcion"]?>" />
<meta property="fb:app_id" content="1215279765157571"/>
<meta property="og:url" content="<?=PAGE_DOMAIN?>/user/<?=$this->u->user2URL($data["username"])?>"/>
<meta property="og:image" content="<?=PAGE_DOMAIN?>/<?=$data["meta-avatar"]?>" />
<meta property="og:image:width" content="500" />
<meta property="og:image:height" content="500" />

<meta property="og:type" content="profile" />
<meta property="profile:username" content="<?=$data["username"]?>" />

<!--twitter-->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@frikiarea" />
<meta name="twitter:title" content="<?=$data["page_title"]?> | <?=PAGE_NAME?>" />
<meta name="twitter:description" content="<?=$data["descripcion"]?>" />
<meta name="twitter:creator" content="@frikiarea" />
<meta name="twitter:image" content="<?=PAGE_DOMAIN?>/<?=$data["meta-avatar"]?>" />
<meta name="twitter:data1" content="<?=$data["username"]?>" />
<meta name="twitter:label1" content="username" />

<!--Google plus-->
<link rel="publisher" href="https://plus.google.com/113929769526461516040">
<meta itemprop="name" content="<?=$data["page_title"]?> | <?=PAGE_NAME?>" />
<meta itemprop="description" content="<?=$data["descripcion"]?>"/>
<meta itemprop="image" content="<?=PAGE_DOMAIN?>/<?=$data["meta-avatar"]?>"/>

<script type="application/ld+json">
{
    "@context" : "http://schema.org",
    "@type" : "ProfilePage",
    "url" : "<?=PAGE_DOMAIN?>/user/<?=$this->u->user2URL($data["username"])?>",
    "name" : "<?=$data["username"]?>",
    "image": "<?=PAGE_DOMAIN?>/<?=$data["meta-avatar"]?>",
    "description": "<?=$data["descripcion"]?>",
    "about": "<?=$data["ocupacion"]?>"
}
</script>
