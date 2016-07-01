<html>
    <body>
        <p>Bienvenido/a a <?=PAGE_NAME?>, <?=$data["username"]?>.</p>
        <p>¡Entra en este enlace, introduce tus datos y serás parte de esta gran comunidad!</p>
        <a href='<?=PAGE_DOMAIN?>/user?action=login_form&activation_key=<?=$data["email_key"]?>'><?=PAGE_DOMAIN?>/user?action=login_form&activation_key=<?=$data["email_key"]?></a>
        <p>Si tienes algún problema con tu registro ponte en contacto con nosotros a través de esta dirección:</p> <a href='mailto:<?=CONTACT_EMAIL?>'><?=CONTACT_EMAIL?></a>
        <p>¡Bienvenido/a!</p>
    </body>
</html>
