<div class="container wrapper">
     <div class="row">
        <div class="col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 bs-component">
            <div class="well">
                <?=$data["reg_msg"]?>
                <form id="registrationForm" method="post" action="/register"
                    data-fv-framework="bootstrap"
                    data-fv-icon-valid="glyphicon glyphicon-ok"
                    data-fv-icon-invalid="glyphicon glyphicon-remove"
                    data-fv-icon-validating="glyphicon glyphicon-refresh">

                    <header class="subhead">
                        <h4>INTRODUCE LOS DATOS SOLICITADOS A CONTINUACIÓN</h4>
                        <p>¡Bienvenido a <?=PAGE_NAME?>! Rellena los datos que te solicitamos a continuación y pasarás a formar parte de esta gran comunidad.</p>
                    </header>

                    <div class="form-group label-floating">
                        <label class="control-label">Código de registro beta</label>
                        <input type="text" class="form-control" name="codigo_beta" value="<?=$data["code"]?>" readonly
                            data-fv-notempty="true"
                            data-fv-notempty-message="El código de registro es obligatorio" />
                   </div>

                   <div class="form-group label-floating">
                        <label class="control-label">Nombre y Apellidos</label>
                        <input type="text" class="form-control" name="nombre"
                            data-fv-notempty="true"
                            data-fv-notempty-message="El nombre es obligatorio" />
                   </div>
                    <div class="form-group">
                        <label class="control-label" for="username">Nombre de usuario</label>
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon3"><?=str_replace('https://','',PAGE_DOMAIN)?>/user/</span>
                                <input type="text" class="form-control" name="username" id="username"
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

                    <div class="form-group label-floating">
                        <label class="control-label" for="email">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" value="<?=$data["email"]?>"
                            data-fv-notempty="true"
                            data-fv-notempty-message="El e-mail es obligatorio"
                            data-fv-emailaddress="true"
                            data-fv-emailaddress-message="No has introducido una dirección de e-mail válida" />
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Contraseña</label>
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
                        <label class="control-label">Repite la contraseña</label>
                        <input type="password" class="form-control" name="confirmPassword"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Repite la contraseña"
                            data-fv-identical="true"
                            data-fv-identical-field="password"
                            data-fv-identical-message="Las contraseñas deben coincidir" />
                    </div>

                   <div class="form-group">
                        <div class="checkbox">
                            <label style="text-align:left;">
                                <input id="accept-tos" type="checkbox" name="accept-tos"
                                    data-fv-icon="false"
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="Acepta los términos para continuar"> He leído y acepto los <a href="/info/tos" target="_blank">términos y condiciones<i class="fa fa-external-link"></i></a>
                            </label>
                       </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-raised" name="signup" value="Sign up">Registrarse</button>
                    </div>
                </form>
            </div>
         </div>
    </div>
</div>
