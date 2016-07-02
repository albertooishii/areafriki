<meta name="description" content="<?=$data["dg-descripcion"]?>">

<!--OpenGraph/facebook-->
<meta property="og:title" content="<?=$data["dg-nombre"]?> | <?=PAGE_NAME?>" />
<meta property="og:description" content="<?=$data["dg-descripcion"]?>" />
<meta property="fb:app_id" content="1215279765157571"/>
<meta property="og:url" content="<?=PAGE_DOMAIN?>/<?=$data["nombre_categoria"]?>/<?=$data["dg-token"]?>"/>
<meta property="og:image" content="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg" />
<meta property="og:image:width" content="512" />
<meta property="og:image:height" content="512" />
<meta property="og:type" content="product.item" />
<meta property="product:retailer_item_id" content="<?=$data["dg-token"]?>" />
<meta property="product:price:amount" content="<?=$data["precio_float"]?>" />
<meta property="product:price:currency" content="EUR" />
<meta property="product:availability" content="in stock" />
<meta property="product:condition" content="<?=$data["condition"]?>" />
<meta property="og:site_name" content="<?=$data["dg-nombre"]?> | <?=PAGE_NAME?>" />

<!--twitter-->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@frikiarea" />
<meta name="twitter:title" content="<?=$data["page_title"]?> | <?=PAGE_NAME?>" />
<meta name="twitter:description" content="<?=$data["dg-descripcion"]?>" />
<meta name="twitter:creator" content="@frikiarea" />
<meta name="twitter:image" content="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg" />
<meta name="twitter:data1" content="<?=$data["dg-token"]?>" />
<meta name="twitter:label1" content="TOKEN" />
<meta name="twitter:data2" content="<?=$data["float_precio"]?>" />
<meta name="twitter:label2" content="Precio" />

<!--Google plus-->
<link rel="publisher" href="https://plus.google.com/113929769526461516040">
<meta itemprop="name" content="<?=$data["page_title"]?> | <?=PAGE_NAME?>" />
<meta itemprop="description" content="<?=$data["dg-descripcion"]?>"/>
<meta itemprop="image" content="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg"/>

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
