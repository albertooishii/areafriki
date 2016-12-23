<title><?=$data['page_title']?> | <?=PAGE_NAME?></title>
<meta name="description" content="Resultados de búsqueda de <?=$data["subhead"]?>">

<!--OpenGraph/facebook-->
<meta property="og:title" content="<?=$data["subhead"]?> | <?=PAGE_NAME?>" />
<meta property="og:description" content="Resultados de búsqueda de <?=$data["subhead"]?>" />
<meta property="fb:app_id" content="1215279765157571"/>
<meta property="og:url" content="<?=$data["sourcepage"]?>"/>
<meta property="og:site_name" content="<?=$data["dg-nombre"]?> | <?=PAGE_NAME?>" />

<!--twitter-->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@frikiarea" />
<meta name="twitter:title" content="<?=$data["page_title"]?> | <?=PAGE_NAME?>" />
<meta name="twitter:description" content="Resultados de búsqueda de <?=$data["subhead"]?>" />
<meta name="twitter:creator" content="@frikiarea" />

<!--Google plus-->
<link rel="publisher" href="https://plus.google.com/113929769526461516040">
<meta itemprop="name" content="<?=$data["page_title"]?> | <?=PAGE_NAME?>" />
<meta itemprop="description" content="Resultados de búsqueda de <?=$data["subhead"]?>"/>

<script type="application/ld+json">
{
    "@context" : "http://schema.org",
    "@type" : "Offer",
    "url" : "<?=$data["sourcepage"]?>",
    "name" : "<?=$data["subhead"]?>",
    "description": "Resultados de búsqueda de <?=$data["subhead"]?>"
}
</script>
