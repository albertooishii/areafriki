<div class="container wrapper">
     <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?=$data["reg_msg"]?>
            <form id="registrationForm" class="form-horizontal" method="post" action="/user?action=register_comprador"
                data-fv-framework="bootstrap"
                data-fv-icon-valid="glyphicon glyphicon-ok"
                data-fv-icon-invalid="glyphicon glyphicon-remove"
                data-fv-icon-validating="glyphicon glyphicon-refresh">

                <header class="subhead aligncenter">
                    <h4>INTRODUCE LOS DATOS SOLICITADOS A CONTINUACIÓN</h4>
                </header>

               <div class="form-group">
                    <label class="col-md-4 control-label">Nombre</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="firstName"
                            data-fv-notempty="true"
                            data-fv-notempty-message="El nombre es obligatorio" />
                    </div>
               </div>

                <div class="form-group">
                   <label class="col-md-4 control-label">Apellidos</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="lastName"
                            data-fv-notempty="true"
                            data-fv-notempty-message="El apellido es obligatorio" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Nombre de usuario</label>
                    <div class="col-md-8 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3"><?=str_replace('https://','',PAGE_DOMAIN)?>/user/</span>
                            <input type="text" class="form-control" name="username"
                                data-fv-notempty="true"
                                data-fv-notempty-message="Nombre de usuario requerido"

                                data-fv-stringlength="true"
                                data-fv-stringlength-min="3"
                                data-fv-stringlength-max="20"
                                data-fv-stringlength-message="El nombre de usuario tiene que tener entre 3 y 20 caracteres"

                                data-fv-regexp="true"
                                data-fv-regexp-regexp="^[a-zA-Z0-9_\. ]+$"
                                data-fv-regexp-message="El nombre de usuario solo puede tener letras, números, guiones bajos y puntos" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Correo electrónico</label>
                    <div class="col-md-8">
                        <input type="email" class="form-control" name="email"
                            data-fv-notempty="true"
                            data-fv-notempty-message="El e-mail es obligatorio"

                            data-fv-emailaddress="true"
                            data-fv-emailaddress-message="No has introducido una dirección de e-mail válida" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Contraseña</label>
                    <div class="col-md-8">
                        <input type="password" class="form-control" name="password"
                            data-fv-notempty="true"
                            data-fv-notempty-message="La contraseña es obligatoria"

                            data-fv-stringlength="true"
                            data-fv-stringlength-min="6"
                            data-fv-stringlength-message="La contraseña tiene que tener como mínimo 6 caracteres"

                            data-fv-different="true"
                            data-fv-different-field="user"
                            data-fv-different-message="La contraseña no puede ser igual que el nobmre de usuario" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Repite la contraseña</label>
                    <div class="col-md-8">
                        <input type="password" class="form-control" name="confirmPassword"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Repite la contraseña"
                            data-fv-identical="true"
                            data-fv-identical-field="password"
                            data-fv-identical-message="Las contraseñas deben coincidir" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputDireccion">Dirección</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="inputDireccion" placeholder="Calle, número, planta, letra, escalera" name="direccion"
                            data-fv-notempty="true"
                            data-fv-notempty-message="La dirección es obligatoria"   />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputCP">Código Postal</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="inputCP" placeholder="Código Postal" name="cp"
                            data-fv-notempty="true"
                            data-fv-notempty-message="El código postal es obligatorio"
                            data-fv-stringlength-min="5"
                            data-fv-stringlength-max="5"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputLocalidad">Localidad</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="inputLocalidad" placeholder="Localidad" name="localidad"
                            data-fv-notempty="true"
                            data-fv-notempty-message="La localidad es obligatoria"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputLocalidad">Provincia</label>
                    <div class="col-md-8">
                        <?=$data["provincia"]?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputTelefono">Número de teléfono</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="inputTelefono" placeholder="Teléfono" name="phone"
                            data-fv-notempty="true"
                            data-fv-notempty-message="El número de teléfono es necesario">
                    </div>
                </div>
               <div class="form-group">
                    <label class="col-sm-offset-4 col-sm-8">
                        <input id="accept-tos" type="checkbox" name="accept-tos"
                            data-fv-icon="false"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Acepta los términos para continuar"> He leído y acepto los <a href="/info/tos" target="_blank">términos y condiciones<i class="fa fa-external-link"></i></a>
                    </label>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-xs-offset-4">
                        <button type="submit" class="btn btn-primary btn-raised" name="signup" value="Sign up">Registrarse</button>
                    </div>
                </div>
            </form>
         </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#registrationForm').formValidation();
});
</script>
