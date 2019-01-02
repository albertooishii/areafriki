<h3>SOLICITUD DE COMPRA</h3>

<p>¡Hola, <?=$data["nombre"]?>!</p>

<p>Un usuario ha solicitado comprar tu producto <a href="<?=PAGE_DOMAIN?>/<?=$data["cat_nombre"]?>/<?=$data["token"]?>"><?=$data["dg_nombre"]?></a> en <?=PAGE_NAME?></p>

<p>Debido a que han pasado más de 15 días desde la publicación o última actualización, el producto ha caducado y el comprador no ha podido añadir este producto a su carrito.</p>

<p>Si aún lo tienes disponible para venta y quieres volverlo a activar es necesario revisar la información del producto.</p>

<p>Para ello inicia sesión en tu cuenta y entra en <a href="<?=PAGE_DOMAIN?>/<?=$data["cat_nombre"]?>/<?=$data["token"]?>/edit">EDICIÓN DEL PRODUCTO</a>. Revisa que la información sigue siendo correcta o modifícala y dale a GUARDAR CAMBIOS.</p> 

<p>Notificaremos al comprador de que ya se encuentra disponible.</p>

<p>¡Muchas gracias!</p>
