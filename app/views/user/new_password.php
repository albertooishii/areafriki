<div class="signup-page">
    <div class="page-header header-filter" style="background-image: url('<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/af_gamer_girl.jpg'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <div class="card card-signup">
                        <h2 class="text-center">Introduce la nueva contraseña</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <form id="registrationForm" method="post" action="/login/recoverpass"
                                    data-fv-framework="bootstrap"
                                    data-fv-icon-valid="glyphicon glyphicon-ok"
                                    data-fv-icon-invalid="glyphicon glyphicon-remove"
                                    data-fv-icon-validating="glyphicon glyphicon-refresh">
                                    <div class="content">
                                        <?=$data["login_msg"]?>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                                <input type="password" class="form-control" name="password" placeholder="Contraseña"
                                                    data-fv-notempty="true"
                                                    data-fv-notempty-message="La contraseña es obligatoria"

                                                    data-fv-stringlength="true"
                                                    data-fv-stringlength-min="6"
                                                    data-fv-stringlength-message="La contraseña tiene que tener como mínimo 6 caracteres"

                                                    data-fv-different="true"
                                                    data-fv-different-field="user"
                                                    data-fv-different-message="La contraseña no puede ser igual que el nombre de usuario" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                                <input type="password" class="form-control" name="confirmPassword" placeholder="Repite la contraseña"
                                                    data-fv-notempty="true"
                                                    data-fv-notempty-message="Repite la contraseña"
                                                    data-fv-identical="true"
                                                    data-fv-identical-field="password"
                                                    data-fv-identical-message="Las contraseñas deben coincidir" />
                                            </div>
                                        </div>
                                        <input type="hidden" value="<?=$data["recoverpasskey"]?>" name="recoverpasskey">
                                        <input type="hidden" value="<?=$data["email"]?>" name="email">
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-primary btn-round" name="signup" value="Sign up">CONFIRMAR</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
