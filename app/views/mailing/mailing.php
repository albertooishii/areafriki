<div class="container wrapper center">
    <form action="<?=PAGE_DOMAIN?>/mailing/set" method="post">
        <h2 class="title">Listas de interés</h2>
        <h4>Marca las categorías temáticas que sean de tu interés y te mantendremos al tanto de todas las novedades adaptadas a tus gustos.</h4>
        <div class="row">
            <div class="form-group">
                <ul class="col-md-4">
                    <li><div class="checkbox"><label><input type="checkbox" value="12" name="lists[]">Cine</label></div></li>
                    <li><div class="checkbox"><label><input type="checkbox" value="13" name="lists[]">Videojuegos</label></div></li>
                    <li><div class="checkbox"><label><input type="checkbox" value="14" name="lists[]">Series</label></div></li>
                </ul>
                <ul class="col-md-4">
                    <li><div class="checkbox"><label><input type="checkbox" value="15" name="lists[]">Manga & Anime (japonés)</label></div></li>
                    <li><div class="checkbox"><label><input type="checkbox" value="16" name="lists[]">Cómics</label></div></li>
                    <li><div class="checkbox"><label><input type="checkbox" value="17" name="lists[]">Animación Occidental</label></div></li>
                </ul>
                <ul class="col-md-4">
                    <li><div class="checkbox"><label><input type="checkbox" value="18" name="lists[]">Literatura fantástica</label></div></li>
                    <li><div class="checkbox"><label><input type="checkbox" value="19" name="lists[]">Kawaii</label></div></li>
                    <li><div class="checkbox"><label><input type="checkbox" value="20" name="lists[]">Cultura Friki</label></div></li>
                </ul>
            </div>
        </div>
        <?php
            if(isset($_GET["redirect"])){
        ?>
            <input type="hidden" name="redirect" value="<?=$_GET["redirect"]?>">
        <?php
            }
        ?>
        <div class="form-group text-center">
            <input type="submit" value="Continuar" name="subscribe" class="button btn btn-primary btn-round">
        </div>
    </form>

    <!--End mc_embed_signup-->
    <div style="clear:both">
        <p><?=PAGE_NAME?> te informa que los datos de carácter personal que nos proporciones rellenando el presente formulario serán tratados por Jorge Manuel Bueno Méndez (80079483-S) como responsable de esta web. La finalidad de la recogida y tratamiento de los datos personales que te solicitamos es para efectuar el envío de comunicaciones publicitarias relacionadas con los productos y servicios ofrecidos en la Web. La legitimación se realiza a través del consentimiento del interesado. ​Podrás ejercer tus derechos de acceso, rectificación, limitación y suprimir los datos en central@areafriki.com así como el derecho a presentar una reclamación ante una autoridad de control. Puedes consultar la información adicional y detallada sobre Protección de Datos en nuestra <a href="/info/proteccion-datos" target="_blank">política de privacidad<i class="fa fa-external-link"></i></a>.</p>
    </div>
</div>