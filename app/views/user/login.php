<div class="signup-page">
    <div class="page-header header-filter" style="background-image: url('<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/af_gamer_girl.jpg'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">

                    <div class="card card-signup">
                        <h2 class="text-center">Inciar sesión</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <form id="registrationForm" method="post" action="/login"
                                    data-fv-framework="bootstrap"
                                    data-fv-icon-valid="glyphicon glyphicon-ok"
                                    data-fv-icon-invalid="glyphicon glyphicon-remove"
                                    data-fv-icon-validating="glyphicon glyphicon-refresh">
                                    <div class="content">
                                        <?=$data["login_msg"]?>
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
                                                    data-fv-stringlength-message="Debe tener entre 3 y 20 caracteres"

                                                    data-fv-regexp="true"
                                                    data-fv-regexp-regexp="^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_. +@]+$"
                                                    data-fv-regexp-message="Solo puede tener letras, números, guiones bajos, espacios y puntos" />
                                            </div> 
                                        </div>

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

                                        <!-- If you want to add a checkbox to this form, uncomment this code -->

                                        <div class="checkbox">
                                            <label>
                                                <input id="loginrec" type="checkbox" name="loginrec"> Mantener la sesión iniciada
                                            </label>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <a href="/login/recoverpass">He olvidado mi contraseña</a>
                                    </div>
                                <?php
                                    if(isset($_GET["redirect"])){
                                ?>
                                    <input type="hidden" name="redirect" value="<?=$_GET["redirect"]?>">
                                <?php
                                    }
                                ?>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-primary btn-round" name="signup" value="Sign up">¡ENTRAR!</button>
                                    </div>
                                </form>
                                <div class="footer text-center">
                                    <a href="/register" class="btn btn-primary btn-round">REGISTRARSE</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
