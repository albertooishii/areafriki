<?php
    $data['page_title'] ="Artículos frikis y originales de ".ucwords($data["search"])." en ". PAGE_NAME. ".";
    $descripcion = "Descubre los Regalos más Frikis y Originales de ".ucwords($data["search"]).". Para ti, para tus amigos.";

    if($data["curpage"]>1){
        $descripcion.=". Página ".$data["curpage"];
    }
?>

<title><?=$data['page_title']?></title>
<meta name="description" content="<?=$descripcion?>">

<!--OpenGraph/facebook-->
<meta property="og:title" content="<?=$data['page_title']?>" />
<meta property="og:description" content="<?=$descripcion?>" />
<meta property="fb:app_id" content="1215279765157571"/>
<meta property="og:url" content="<?=$data["sourcepage"]?>"/>
<meta property="og:site_name" content="<?=PAGE_NAME?>" />

<!--twitter-->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@frikiarea" />
<meta name="twitter:title" content="<?=$data['page_title']?>" />
<meta name="twitter:description" content="<?=$descripcion?>" />
<meta name="twitter:creator" content="@frikiarea" />

<!--Google plus-->
<link rel="publisher" href="https://plus.google.com/113929769526461516040">
<meta itemprop="name" content="<?=$data['page_title']?>" />
<meta itemprop="description" content="<?=$descripcion?>"/>

<script type="application/ld+json"> 
{
    "@context" : "http://schema.org",
    "@type" : "Offer",
    "url" : "<?=$data["sourcepage"]?>",
    "name" : "<?=$data["subhead"]?>",
    "description": "<?=$descripcion?>"
}
</script>
