<?php
    switch($data['tipo_categoria']) {
        case 'producto':
            switch($data['nombre']) {
                case 'camisetas': case 'sudaderas': case 'chapas': case 'tazas':
                    $data['page_title'] = ucfirst($data["nombre"]). " personalizadas. Tus " . strtolower($data['descripcion_corta']) . " frikis, en " . PAGE_NAME .".";
                    $descripcion = "Descubre las " . ucfirst($data["nombre"]) . " más Frikis y Originales. Regalos para ti, regalos para tus amigos.";
                    break;
                
                case 'vinilos': case 'lienzos': case 'posters': case 'stickers':
                    $data['page_title'] = ucfirst($data["nombre"]). " personalizados. Tus " . strtolower($data['descripcion_corta']) . " frikis, en " . PAGE_NAME .".";
                    $descripcion = "Descubre los " . ucfirst($data["nombre"]) . " más Frikis y Originales. Regalos para ti, regalos para tus amigos.";
                    break;
                
                default:
                    $data['page_title'] = "Artículos de " . strtolower($data['descripcion_corta']) . " frikis, en " . PAGE_NAME .".";
                    $descripcion = "Descubre los Regalos de " . strtolower($data['descripcion_corta']) . " más Frikis y Originales. Regalos para ti, regalos para tus amigos.";
            }
            break;
        case 'topic':
            $data['page_title'] = "Regalos originales con temática de ". strtolower($data['descripcion_corta']). " en " . PAGE_NAME .".";
            $descripcion = "Descubre los Regalos más Frikis y Originales de ".$data["descripcion_corta"].". Para ti, para tus amigos.";
            break;
    }

    if($data["curpage"]>1){
        $descripcion.=" Página ".$data["curpage"];
    }
?>

<title><?=$data['page_title']?></title>
<meta name="description" content="<?=$descripcion?>">

<!--OpenGraph/facebook-->
<meta property="og:title" content="<?=$data["descripcion_corta"]?> | <?=PAGE_NAME?>" />
<meta property="og:description" content="<?=$descripcion?>" />
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
<meta name="twitter:description" content="<?=$descripcion?>" />
<meta name="twitter:creator" content="@frikiarea" />
<meta name="twitter:image" content="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/categorias/<?=$data["nombre"]?>.jpg" />

<!--Google plus-->
<link rel="publisher" href="https://plus.google.com/113929769526461516040">
<meta itemprop="name" content="<?=PAGE_NAME?>: <?=$data["page_title"]?>" />
<meta itemprop="description" content="<?=$descripcion?>"/>
<meta itemprop="image" content="<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/categorias/<?=$data["nombre"]?>.jpg"/>

<script type="application/ld+json">
{
    "@context" : "http://schema.org",
    "@type" : "Offer",
    "url" : "<?=$data["sourcepage"]?>",
    "name" : "<?=$data["descripcion_corta"]?>",
    "image": "<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/categorias/<?=$data["nombre"]?>.jpg",
    "description": "<?=$descripcion?>"
}
</script>
