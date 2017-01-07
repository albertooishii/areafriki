<title><?=PAGE_NAME?>: <?=$data['page_title']?></title>
<meta name="description" content="<?=PAGE_NAME?>, la tienda friki de <?=$data["descripcion_corta"]?> de <?=$data["lista_tags_populares"]?>">

<!--OpenGraph/facebook-->
<meta property="og:title" content="<?=$data["descripcion_corta"]?> | <?=PAGE_NAME?>" />
<meta property="og:description" content="<?=PAGE_NAME?>, la tienda friki de <?=$data["descripcion_corta"]?> de <?=$data["lista_tags_populares"]?>" />
<meta property="fb:app_id" content="1215279765157571"/>
<meta property="og:url" content="<?=$data["sourcepage"]?>"/>
<meta property="og:image" content="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/categorias/<?=$data["nombre"]?>.jpg" />
<meta property="og:image:width" content="512" />
<meta property="og:image:height" content="512" />
<meta property="og:site_name" content="<?=PAGE_NAME?>" />

<!--twitter-->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@frikiarea" />
<meta name="twitter:title" content="<?=$data["page_title"]?> | <?=PAGE_NAME?>" />
<meta name="twitter:description" content="<?=PAGE_NAME?>, la tienda friki de <?=$data["descripcion_corta"]?> de <?=$data["lista_tags_populares"]?>" />
<meta name="twitter:creator" content="@frikiarea" />
<meta name="twitter:image" content="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/categorias/<?=$data["nombre"]?>.jpg" />

<!--Google plus-->
<link rel="publisher" href="https://plus.google.com/113929769526461516040">
<meta itemprop="name" content="<?=PAGE_NAME?>: <?=$data["page_title"]?>" />
<meta itemprop="description" content="<?=PAGE_NAME?>, la tienda friki de <?=$data["descripcion_corta"]?> de <?=$data["lista_tags_populares"]?>"/>
<meta itemprop="image" content="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/categorias/<?=$data["nombre"]?>.jpg"/>

<script type="application/ld+json">
{
    "@context" : "http://schema.org",
    "@type" : "Offer",
    "url" : "<?=$data["sourcepage"]?>",
    "name" : "<?=$data["descripcion_corta"]?>",
    "image": "<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/categorias/<?=$data["nombre"]?>.jpg",
    "description": "<?=PAGE_NAME?>, la tienda friki de <?=$data["descripcion_corta"]?> de <?=$data["lista_tags_populares"]?>"
}
</script>
