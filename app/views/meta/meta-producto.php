<?php
    $data["page_title"]=$data['dg-nombre'];
    if(!empty($data["description"])){
        $descripcion=$data["description"];
    }else{
        $descripcion=$data['dg-nombre']." por ".$data["username"]." en ".PAGE_NAME.". Personaliza productos con tus diseños, vende tus manualidades y artículos de segunda mano.";
    }
?>
<title><?=PAGE_NAME?>: <?=$data["page_title"]?></title>
<meta name="description" content="<?=$descripcion?>">

<!--OpenGraph/facebook-->
<meta property="og:title" content="<?=PAGE_NAME?>: <?=$data["page_title"]?>" />
<meta property="og:description" content="<?=$descripcion?>" />
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
<meta property="og:site_name" content="<?=PAGE_NAME?>" />

<!--twitter-->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@frikiarea" />
<meta name="twitter:title" content="<?=PAGE_NAME?>: <?=$data["page_title"]?>" />
<meta name="twitter:description" content="<?=$descripcion?>" />
<meta name="twitter:creator" content="@frikiarea" />
<meta name="twitter:image" content="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg" />
<meta name="twitter:data1" content="<?=$data["dg-token"]?>" />
<meta name="twitter:label1" content="TOKEN" />
<meta name="twitter:data2" content="<?=$data["precio_float"]?>" />
<meta name="twitter:label2" content="Precio" />

<!--Google plus-->
<link rel="publisher" href="https://plus.google.com/113929769526461516040">
<meta itemprop="name" content="<?=PAGE_NAME?>: <?=$data["page_title"]?>" />
<meta itemprop="description" content="<?=$descripcion?>"/>
<meta itemprop="image" content="<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg"/>

<script type="application/ld+json">
{
    "@context" : "http://schema.org",
    "@type" : "Product",
    "url" : "<?=PAGE_DOMAIN?>/<?=$data["nombre_categoria"]?>/<?=$data["dg-token"]?>",
    "name" : "<?=$data["dg-nombre"]?>",
    "image": "<?=PAGE_DOMAIN?>/designs/<?=$data["username"]?>/<?=$data["dg-token"]?>/<?=$data["nombre_categoria"]?>/thumb-<?=$data["dg-token"]?>.jpg",
    "description": "<?=$descripcion?>",
    "brand": "<?=PAGE_NAME?>",
    "productID": "<?=$data["dg-token"]?>",
    "offers": {
        "@type": "Offer",
        "priceCurrency": "EUR",
        "price": "<?=$data["precio_float"]?>",
<?php
    if($data["condition"]=="new"){
?>
        "itemCondition": "http://schema.org/NewCondition",
<?php
    }else{
?>
        "itemCondition": "http://schema.org/UsedCondition",
<?php
    }
    if($data["stock"]>0){
?>
        "availability": "http://schema.org/InStock"
<?php
    }else{
 ?>
        "availability": "http://schema.org/SoldOut"
 <?php
    }
?>
    }
}
</script>
