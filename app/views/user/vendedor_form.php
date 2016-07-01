<div class="container wrapper">
     <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 well bs-component">
            <?=$data["reg_msg"]?>
            <form id="registrationForm" class="form-horizontal" method="post" action="/user?action=register_vendedor"
                data-fv-framework="bootstrap"
                data-fv-icon-valid="glyphicon glyphicon-ok"
                data-fv-icon-invalid="glyphicon glyphicon-remove"
                data-fv-icon-validating="glyphicon glyphicon-refresh">

                <header class="subhead aligncenter">
                    <h4>INTRODUCE LOS DATOS SOLICITADOS A CONTINUACIÓN</h4>
                </header>

                <div class="form-group">
                    <label class="col-md-4 control-label">Código de registro beta</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="codigo_beta" value="<?=$data["code"]?>" readonly
                            data-fv-notempty="true"
                            data-fv-notempty-message="El código de registro es obligatorio" />
                    </div>
               </div>

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
                   <label for="idnum" class="col-md-4 control-label">DNI/NIE/CIF</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="idnum" id="idnum" autocomplete="off"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Es necesario el número del documento para garantizar la identidad de nuestros vendedores"
                            data-fv-id="true"
                            data-fv-id-country="ES"
                            data-fv-id-message="El número de identificación no es válido"/>
                        <label class="control-label" for="idnum">El número de identificación debe tener la letra MAYÚSCULA. Ejemplo: 012345678Z</label>
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
                        <input type="email" class="form-control" name="email" readonly value="<?=$data["email"]?>"
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
                    <label class="col-md-4 control-label" for="inputFechaNacimiento">Fecha de nacimiento (DD/MM/YYYY)</label>
                    <div class="date col-md-8">
                        <input type="text" class="form-control" id="inputFechaNacimiento" placeholder="DD/MM/YYYY" name="birthday"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Introduce tu fecha de nacimiento">
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
                    <label class="col-md-4 control-label" for="inputPaypal">
                        <i class="fa fa-paypal"></i> Cuenta de PAYPAL
                    </label>
                    <div class="col-md-8">
                        <input type="email" class="form-control" id="inputPaypal" name="paypal" placeholder="usuario@email.com"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Introduce el email de tu cuenta de paypal"
                            data-fv-emailaddress="true"
                            data-fv-emailaddress-message="La cuenta de paypal no es correcta">
                    </div>
                </div>
               <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8 checkbox">
                        <label style="text-align:left;">
                            <input id="accept-tos" type="checkbox" name="accept-tos"
                                data-fv-icon="false"
                                data-fv-notempty="true"
                                data-fv-notempty-message="Acepta los términos para continuar"> He leído y acepto los <a href="/info/tos" target="_blank">términos y condiciones<i class="fa fa-external-link"></i></a>
                        </label>
                   </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary btn-raised" name="signup" value="Sign up">Registrarse</button>
                    </div>
                </div>
            </form>
         </div>
    </div>
</div>
