<title><?=PAGE_NAME?>: <?=$data['page_title']?></title>
<meta name="description" content="<?=PAGE_NAME?>, todos los productos de <?=$data["nombre-tag"]?>">

<!--OpenGraph/facebook-->
<meta property="og:title" content="<?=PAGE_NAME?>: <?=$data['page_title']?>" />
<meta property="og:description" content="<?=PAGE_NAME?>, todos los productos de <?=$data["nombre-tag"]?>" />
<meta property="fb:app_id" content="1215279765157571"/>
<meta property="og:url" content="<?=$data["sourcepage"]?>"/>
<meta property="og:site_name" content="<?=PAGE_NAME?>" />

<!--twitter-->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@frikiarea" />
<meta name="twitter:title" content="<?=PAGE_NAME?>: <?=$data['page_title']?>" />
<meta name="twitter:description" content="<?=PAGE_NAME?>, todos los productos de <?=$data["nombre-tag"]?>" />
<meta name="twitter:creator" content="@frikiarea" />

<!--Google plus-->
<link rel="publisher" href="https://plus.google.com/113929769526461516040">
<meta itemprop="name" content="<?=PAGE_NAME?>: <?=$data['page_title']?>" />
<meta itemprop="description" content="<?=PAGE_NAME?>, todos los productos de <?=$data["nombre-tag"]?>"/>

<script type="application/ld+json">
{
    "@context" : "http://schema.org",
    "@type" : "Offer",
    "url" : "<?=$data["sourcepage"]?>",
    "name" : "<?=$data["subhead"]?>",
    "description": "<?=PAGE_NAME?>, todos los productos de <?=$data["nombre-tag"]?>"
}
</script>
