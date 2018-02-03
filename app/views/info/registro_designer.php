<style>
    #menu, footer, #feedback, #vender-mobile, #header-search, .navbar-toggle{
        display: none !important;
    }

    .navbar{
        background-color: transparent !important;
        box-shadow: none !important;
        color: #fff !important;
    }

    .navbar-brand{
        margin-left: 20px;
    }
</style>
<div class="page-header header-filter" data-parallax="active" style="background-image: url(<?=PAGE_DOMAIN?>/app/views/info/registro_designer_bg.jpg); transform: translate3d(0px, 0px, 0px);">
    <div class="container wrapper">
        <div class="row">
            <div class="col-md-6">
                <h1 class="title">¿Eres diseñador?</h1>
                <h4>Vende productos personalizados con tus diseños: camisetas, sudaderas, tazas, lienzos, chapas, vinilos y pósters. Marca cuanto quieres ganar por cada venta · Totalmente gratis, sin comisiones adicionales.</h4>
                <br>
                <iframe width="100%" height="340" src="https://www.youtube.com/embed/PQ1iQTx-jHM" frameborder="0" allowfullscreen class="nomobile notablet"></iframe>
            </div>
            <div class="col-md-5 col-md-offset-1">
                <form id="registrationForm" method="post" style="background-color:white; padding:25px; border-radius:3px;" action="/register"
                    data-fv-framework="bootstrap"
                    data-fv-icon-valid="glyphicon glyphicon-ok"
                    data-fv-icon-invalid="glyphicon glyphicon-remove"
                    data-fv-icon-validating="glyphicon glyphicon-refresh">
                    <div class="content">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">face</i>
                                </span>
                                <input type="text" class="form-control" placeholder="Nombre y Apellidos" name="nombre"
                                data-fv-notempty="true"
                                data-fv-notempty-message="El nombre es obligatorio" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon3">
                                    <i class="material-icons">assignment_ind</i>
                                </span>
                                <input type="text" class="form-control" name="username" placeholder="Nombre de usuario" id="username"
                                    maxlength="30"
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="Nombre de usuario requerido"

                                    data-fv-stringlength="true"
                                    data-fv-stringlength-min="3"
                                    data-fv-stringlength-max="30"
                                    data-fv-stringlength-message="Debe tener entre 3 y 30 caracteres"

                                    data-fv-regexp="true"
                                    data-fv-regexp-regexp="^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_. ]+$"
                                    data-fv-regexp-message="Solo puede tener letras, números, guiones bajos, espacios y puntos" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">email</i>
                                </span>
                                <input type="email" class="form-control" name="email" placeholder="Correo electrónico"
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="El e-mail es obligatorio"
                                    data-fv-emailaddress="true"
                                    data-fv-emailaddress-message="No has introducido una dirección de e-mail válida" />
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

                        <!-- If you want to add a checkbox to this form, uncomment this code -->
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input id="accept-tos" type="checkbox" name="accept-tos"
                                    data-fv-icon="false"
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="Acepta los términos para continuar"> He leído y acepto los <a href="/info/tos" target="_blank">términos y condiciones<i class="fa fa-external-link"></i></a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="redirect" value="<?=PAGE_DOMAIN?>/upload/designs">
                    <div class="footer text-center">
                        <button type="submit" class="btn btn-primary btn-round" name="signup" value="Sign up">¡ADELANTE!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
