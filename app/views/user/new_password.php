<div class="container wrapper">
     <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?=$data["reg_msg"]?>
            <form id="newpassword" class="form-horizontal" method="post" action="/user?action=recoverpass"
                data-fv-framework="bootstrap"
                data-fv-icon-valid="glyphicon glyphicon-ok"
                data-fv-icon-invalid="glyphicon glyphicon-remove"
                data-fv-icon-validating="glyphicon glyphicon-refresh">

                <header class="subhead aligncenter">
                    <h4>INTRODUCE LA NUEVA CONTRASEÑA</h4>
                </header>

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
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary btn-raised" name="signup" value="Sign up">Confirmar</button>
                    </div>
                </div>
            </form>
         </div>
    </div>
</div>
