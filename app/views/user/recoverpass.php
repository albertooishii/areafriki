<div class="signup-page">
    <div class="page-header header-filter" style="background-image: url('<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/af_gamer_girl.jpg'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <div class="card card-signup">
                        <h2 class="text-center">Recuperar contraseña</h2>
                        <p class="text-center">Introduce a continuación tu nombre de usuario o email. Te enviaremos un mensaje de correo electrónico con un enlace único para poder recuperar tu contraseña.</p>
                        <div class="row">
                            <div class="col-md-12">
                                <form id="registrationForm" method="post" action="/login/recoverpass"
                                    data-fv-framework="bootstrap"
                                    data-fv-icon-valid="glyphicon glyphicon-ok"
                                    data-fv-icon-invalid="glyphicon glyphicon-remove"
                                    data-fv-icon-validating="glyphicon glyphicon-refresh">
                                    <div class="content">
                                        <?=@$data["error_msg"]?>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">assignment_ind</i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Nombre de usuario o email" name="username"
                                                    data-fv-notempty="true"
                                                    data-fv-notempty-message="Nombre de usuario o email requerido"

                                                    data-fv-stringlength="true"
                                                    data-fv-stringlength-min="3"
                                                    data-fv-stringlength-max="100"
                                                    data-fv-stringlength-message="El nombre de usuario tiene que tener entre 3 y 20 caracteres"

                                                    data-fv-regexp="true"
                                                    data-fv-regexp-regexp="^[a-zA-Z0-9_\.@]+$"
                                                    data-fv-regexp-message="El nombre de usuario solo puede tener letras, números, guiones bajos y puntos" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-primary btn-round" name="signup" value="Sign up">RECUPERAR CONTRASEÑA</button>
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
