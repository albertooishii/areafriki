<p>¡Buenas <?=$data["username"]?>!</p>
<p>Nos ha comentado un pajarito que has olvidado tu contraseña, pero no hay problema, podemos generar una nueva. Entra en este enlace y podrás poner una nueva.</p>
<a href='<?=PAGE_DOMAIN?>/user?action=recoverpass&recoverpasskey=<?=$data["recoverpasskey"]?>'><?=PAGE_DOMAIN?>/user?action=recoverpass&recoverpasskey=<?=$data["recoverpasskey"]?></a>
<p>Si tienes algún problema con la recuperación de la contraseña ponte en contacto con nosotros a través de esta dirección:</p> <a href='mailto:<?=CONTACT_EMAIL?>'><?=CONTACT_EMAIL?></a>
<p>Si has recibido este mensaje por error puedes ignorarlo o borrarlo.</p>
<p>¡Un saludo!</p>
