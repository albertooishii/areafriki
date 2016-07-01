<div class="container wrapper">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 well bs-component">
            <h3>Solicita una clave para convertirte en beta-tester</h3>
            <p>Conviértete en beta-tester de ÁREAFRIKI y se una de las primeras personas en colgar tus productos en esta gran plataforma.</p>
            <p>Muchas de las funcionalidades aún están en desarrollo por lo que puedes encontrar errores.</p>
            <form id="registrationForm" method="post" action="/user?action=solicitar_codigo"
                data-fv-framework="bootstrap"
                data-fv-icon-valid="glyphicon glyphicon-ok"
                data-fv-icon-invalid="glyphicon glyphicon-remove"
                data-fv-icon-validating="glyphicon glyphicon-refresh">

                <div class="form-group label-floating is-empty">
                    <label for="email" class="control-label">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" id="email"
                        data-fv-notempty="true"
                        data-fv-notempty-message="El e-mail es obligatorio"
                        data-fv-emailaddress="true"
                        data-fv-emailaddress-message="No has introducido una dirección de e-mail válida" />
                </div>
                <div class="form-group">
                    <label for="inputInformacion" class="control-label"><h4>Para darte acceso necesitamos un poco de información, ¿qué te gustaría aportar? diseños para imprimir, venta de segunda mano, manualidades. Acuérdate de poner algún enlace a alguna página donde podamos ver algunas muestras</h4></label>
                    <textarea style="height:150px;" class="form-control" required name="informacion" id="inputInformacion"
                        data-fv-notempty="true"
                        data-fv-notempty-message="La información es obligatoria"></textarea>
                </div>
                <div class="form-group aligncentermobile">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-warning btn-raised" name="signup" value="Sign up">Solicitar código de acceso</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
