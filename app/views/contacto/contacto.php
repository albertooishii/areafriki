<div class="container wrapper">
    <div id='contacto'>
        <div class="row">
            <?=$data["contact_msg"]?>
            <section id='contact-options' class="col-md-12 aligncenter">
                <a href="#" class="card card-raised option" data-email="CONTACT_EMAIL">
                    <div class="content">
                        <h4><i class="material-icons">question_answer</i> DUDAS, OPINIONES Y SUGERENCIAS</h4>
                        <p>Si tienes alguna pregunta general sobre la página y no sabes como hacérnosla llegar este es tu sitio.</p>
                    </div>
                </a>
                <a href="#" class="card card-raised option" data-email="ERROR_EMAIL">
                    <div class="content">
                        <h4><i class="material-icons">bug_report</i> NOTIFICACIÓN DE ERRORES</h4>
                        <p>¡Me he asustado! He encontrado un error en la página o un apartado que no funciona correctamente.</p>
                    </div>
                </a>
                <a href="#" class="card card-raised option" data-email="SUPPORT_EMAIL">
                    <div class="content">
                        <h4><i class="material-icons">build</i> SOPORTE TÉCNICO</h4>
                        <p>No se configurar mi perfil, como subir un diseño, un producto para vender. ¡Estoy perdido!</p>
                    </div>
                </a>
            </section>

            <section id='form-contacto' class="col-md-6" style="display:none">
                <div class="card card-raised">
                    <div class="content">
                        <h4 id="form-title" class="aligncenter"></h4>
                        <form id="data" action="contacto" method="post" data-toggle="validator" role="form">

                            <div class="form-group label-floating">
                                <label for="inputName" class="control-label">Nombre y apellidos o nombre de usuario</label>
                                <input type="text" class="form-control" id="inputName" name="name" maxlength="255" required value="<?=$this->u->user?>">
                            </div>
                            
                            <div class="form-group label-floating">
                                <label for="inputEmail" class="control-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="inputEmail" maxlength="255" data-error="Error, este email es inválido" name="email" required value="<?=$this->u->email?>">
                                <div class="help-block with-errors"></div>
                            </div>
                            
                             <div class="form-group label-floating">
                                <label for="inputTel" class="control-label">Teléfono de contacto</label>
                                <input type="tel" class="form-control" id="inputTel" name="phone" maxlength="12">
                            </div>

                            <div class="form-group label-floating">
                                <label for="inputAsunto" class="control-label">Asunto del mensaje</label>
                                <input type="text" class="form-control" id="inputAsunto" name="subject" required>
                            </div>

                            <div class="form-group label-floating">
                                <label for="mensaje" class="control-label">Mensaje</label>
                                <textarea class="form-control" id="mensaje" rows="3" name='text' required></textarea>
                            </div>
                            <input type="hidden" id="email-destino" name="email-destino">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input id="accept-tos" type="checkbox" name="accept-tos"
                                        data-fv-icon="false"
                                        data-fv-notempty="true"
                                        data-fv-notempty-message="Acepta las condiciones para continuar"> He leído y acepto la <a href="/info/proteccion-datos" target="_blank">política de privacidad<i class="fa fa-external-link"></i></a>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-round btn-raised">Enviar</button>
                            </div>
                            <div>
                                <p><?=PAGE_NAME?> te informa que los datos de carácter personal que nos proporciones rellenando el presente formulario serán tratados por Jorge Manuel Bueno Méndez (80079483-S) como responsable de esta web. La finalidad de la recogida y tratamiento de los datos personales que te solicitamos en este formulario es para poder contactar contigo. La legitimación se realiza a través del consentimiento del interesado. ​Podrás ejercer tus derechos de acceso, rectificación, limitación y suprimir los datos en central@areafriki.com así como el derecho a presentar una reclamación ante una autoridad de control. Puedes consultar la información adicional y detallada sobre Protección de Datos en nuestra <a href="/info/proteccion-datos" target="_blank">política de privacidad<i class="fa fa-external-link"></i>.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
