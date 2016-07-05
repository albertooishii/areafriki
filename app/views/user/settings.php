<div class="container wrapper">
     <div class="row">
        <div class="col-sm-6">
            <a class="well" data-toggle="tab" href="#personal_information"><i class="material-icons">contact_mail</i> DATOS PERSONALES</a>
            <a class="well" data-toggle="tab" href="#cash_information"><i class="material-icons">credit_card</i> INFORMACIÓN SOBRE VENTAS</a>
            <a class="well" data-toggle="tab" href="#change_password"><i class="material-icons">vpn_key</i> CAMBIAR CONTRASEÑA</a>
        </div>
        <div class="col-sm-6 tab-content">
            <div id="personal_information" class="well tab-pane fade  in active">
                <form id="registrationForm" method="post" action="/settings"
                    data-fv-framework="bootstrap"
                    data-fv-icon-valid="glyphicon glyphicon-ok"
                    data-fv-icon-invalid="glyphicon glyphicon-remove"
                    data-fv-icon-validating="glyphicon glyphicon-refresh">

                    <header class="subhead">
                        <h4><i class="material-icons">contact_mail</i> Datos personales</h4>
                        <p>Aquí puedes cambiar los ajustes de información personal sobre tu cuenta.</p>
                    </header>
                    <?=$data["mensaje"]?>
                    <p>Nombre y apellidos: <?=$data["nombre"]?></p>

                    <div class="form-group label-floating">
                        <label class="control-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" value="<?=$data["email"]?>"
                            data-fv-notempty="true"
                            data-fv-notempty-message="El e-mail es obligatorio"
                            data-fv-emailaddress="true"
                            data-fv-emailaddress-message="No has introducido una dirección de e-mail válida" />
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="inputDireccion">Dirección</label>
                        <input type="text" class="form-control" id="inputDireccion" value="<?=$data["address"]?>" placeholder="Calle, número, planta, letra, escalera" name="address"
                            data-fv-notempty="true"
                            data-fv-notempty-message="La dirección es obligatoria"   />
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label" for="inputCP">Código Postal</label>
                        <input type="text" class="form-control" id="inputCP" value="<?=$data["cp"]?>" name="cp"
                            data-fv-notempty="true"
                            data-fv-notempty-message="El código postal es obligatorio"
                            data-fv-stringlength-min="5"
                            data-fv-stringlength-max="5"/>
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label" for="inputLocalidad">Localidad</label>
                        <input type="text" class="form-control" id="inputLocalidad" value="<?=$data["localidad"]?>" name="localidad"
                            data-fv-notempty="true"
                            data-fv-notempty-message="La localidad es obligatoria"/>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="inputLocalidad">Provincia</label>
                        <?=$data["provincia"]?>
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label" for="inputTelefono">Número de teléfono</label>
                        <input type="text" class="form-control" id="inputTelefono" name="phone" value="<?=$data["phone"]?>"
                            data-fv-notempty="true"
                            data-fv-notempty-message="El número de teléfono es necesario">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-raised" name="signup" value="Sign up"><i class="material-icons">save</i> Guardar los cambios</button>
                        <a href="#" class="btn btn-danger btn-raised"><i class="material-icons">warning</i> Borrar la cuenta</a>
                    </div>
                </form>
            </div>


            <div id="cash_information" class="well tab-pane fade">
                <form id="registrationForm" method="post" action="/user?action=updatecash"
                    data-fv-framework="bootstrap"
                    data-fv-icon-valid="glyphicon glyphicon-ok"
                    data-fv-icon-invalid="glyphicon glyphicon-remove"
                    data-fv-icon-validating="glyphicon glyphicon-refresh">

                    <header class="subhead">
                        <h4><i class="material-icons">credit_card</i> Información sobre ventas</h4>
                        <p>Ajuste de información sobre pagos.</p>
                    </header>

                    <p>Saldo: <?=$data["credit"]?> €</p>

                    <div class="form-group">
                       <label for="idnum" class="control-label">DNI/NIE/CIF</label>
                        <input type="text" class="form-control" name="idnum" id="idnum" value="<?=$data["idnum"]?>" autocomplete="off"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Es necesario el número del documento para garantizar la identidad de nuestros vendedores"
                            data-fv-id="true"
                            data-fv-id-country="ES"
                            data-fv-id-message="El número de identificación no es válido"/>
                        <label class="control-label" for="idnum">El número de identificación debe tener la letra MAYÚSCULA. Ejemplo: 012345678Z</label>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="inputFechaNacimiento">Fecha de nacimiento (DD/MM/YYYY)</label>
                        <input type="text" class="form-control" id="inputFechaNacimiento" placeholder="DD/MM/YYYY" name="birthday" value="<?=$data["birthday"]?>"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Introduce tu fecha de nacimiento">
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label" for="inputPaypal">
                            <i class="fa fa-paypal"></i> Cuenta de PAYPAL (usuario@email.com)
                        </label>
                        <input type="email" class="form-control" id="inputPaypal" name="paypal" value="<?=$data["paypal"]?>"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Introduce el email de tu cuenta de paypal"
                            data-fv-emailaddress="true"
                            data-fv-emailaddress-message="La cuenta de paypal no es correcta">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-raised" name="signup" value="Sign up"><i class="material-icons">save</i> Guardar los cambios</button>
                    </div>
                </form>
            </div>


            <div id="change_password" class="well tab-pane fade">
                <form id="registrationForm" method="post" action="/user?action=updatepassword"
                    data-fv-framework="bootstrap"
                    data-fv-icon-valid="glyphicon glyphicon-ok"
                    data-fv-icon-invalid="glyphicon glyphicon-remove"
                    data-fv-icon-validating="glyphicon glyphicon-refresh">

                    <header class="subhead">
                        <h4><i class="material-icons">vpn_key</i> Cambiar contraseña</h4>
                        <p>Cambia la contraseña de acceso a tu cuenta.</p>
                    </header>
                    <div class="form-group label-floating">
                        <label class="control-label">Contraseña actual</label>
                        <input type="password" class="form-control" name="oldpassword"
                            data-fv-notempty="true"
                            data-fv-notempty-message="La contraseña es obligatoria"

                            data-fv-stringlength="true"
                            data-fv-stringlength-min="6"
                            data-fv-stringlength-message="La contraseña tiene que tener como mínimo 6 caracteres"

                            data-fv-different="true"
                            data-fv-different-field="user"
                            data-fv-different-message="La contraseña no puede ser igual que el nobmre de usuario" />
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Nueva contraseña</label>
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
                    <div class="form-group label-floating">
                        <label class="control-label">Repite la nueva contraseña</label>
                        <input type="password" class="form-control" name="confirmPassword"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Repite la contraseña"
                            data-fv-identical="true"
                            data-fv-identical-field="password"
                            data-fv-identical-message="Las contraseñas deben coincidir" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-raised" name="signup" value="Sign up"><i class="material-icons">save</i> Actualizar la contraseña</button>
                    </div>
                </form>
            </div>
         </div>
    </div>
</div>
