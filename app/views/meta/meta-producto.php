<meta name="description" content="<?=$data["dg-descripcion"]?>">
<meta property="og:title" content="<?=PAGE_NAME?> | <?=$data["dg-nombre"]?>" />
<meta property="og:description" content="<?=$data["dg-descripcion"]?>" />

<!--facebook-->
<meta property="og:url" content="<?=PAGE_DOMAIN?>" />
<meta property="og:image" content="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg" />
<meta property="og:image:width" content="512" />
<meta property="og:image:height" content="512" />
<meta content="product" property="og:type" />
<meta property="og:site_name" content="<?=$data["dg-nombre"]?> | <?=PAGE_NAME?>" />

<!--twitter-->
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@frikiarea" />
<meta name="twitter:title" content="<?=$data["page_title"]?> | <?=PAGE_NAME?>" />
<meta name="twitter:description" content="<?=$data["dg-descripcion"]?>" />
<meta name="twitter:creator" content="@frikiarea" />
<meta name="twitter:image" content="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg" />

<!--Google plus-->
<link rel="publisher" href="https://plus.google.com/113929769526461516040">

<meta content="Camisetas, sudaderas, tazas, pósters, vinilos de decoración, cuadros de lienzo, chapas, skins para consolas, handmades, etc..." itemprop="headline" />
<meta content="<?=$data["dg-descripcion"]?>" itemprop="description" />
<meta content="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg" itemprop="image" />

<script type="application/ld+json">
{
    "@context" : "http://schema.org",
    "@type" : "Product",
    "url" : "<?=PAGE_DOMAIN?>/<?=$data["nombre_categoria"]?>/<?=$data["dg-token"]?>",
    "name" : "<?=$data["dg-nombre"]?>",
    "image": "<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg",
    "description": "<?=$data["dg-descripcion"]?>",
    "productID": "<?=$data["dg-token"]?>",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "<?=$data["contador_likes"]?>",
        "reviewCount": "<?=$data["contador_comments"]?>"
    },
    "offers": {
        "@type": "Offer",
        "priceCurrency": "EUR",
        "price": "<?=$data["precio_float"]?>",
        "itemCondition": "http://schema.org/UsedCondition",
        "availability": "http://schema.org/InStock"
    }
}
</script>
