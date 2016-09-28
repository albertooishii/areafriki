<div class="signup-page">
    <div class="page-header header-filter" style="background-image: url('<?=PAGE_DOMAIN?>/app/templates/frontoffice/img/layout/af_gamer_girl.jpg'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">

                    <div class="card card-signup">
                        <h2 class="text-center">Registrarse</h2>
                        <?=$data["reg_msg"]?>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="info info-horizontal">
                                    <div class="icon icon-rose">
                                        <i class="material-icons">touch_app</i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Control total</h4>
                                        <p class="description">
                                            Tener una cuenta te permite poder administrar tus compras dentro de <?=PAGE_NAME?>. Revisa tus pedidos, gestiona tus datos personales.
                                        </p>
                                    </div>
                                </div>

                                <div class="info info-horizontal">
                                    <div class="icon icon-primary">
                                        <i class="material-icons">group</i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Más social</h4>
                                        <p class="description">
                                            Crea tu propio perfil social dentro de <?=PAGE_NAME?>. Interacciona con otros usuarios, comenta los productos y ¡Dale like!
                                        </p>
                                    </div>
                                </div>

                                <div class="info info-horizontal">
                                    <div class="icon icon-info">
                                        <i class="material-icons">monetization_on</i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Gana dinero</h4>
                                        <p class="description">
                                            Pon a la venta en <?=PAGE_NAME?> todo tipo de productos frikis: Productos hechos a mano, cosas que ya no quieras o productos personalizados con tus diseños.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <form id="registrationForm" method="post" action="/register"
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
                                                <span class="input-group-addon" id="basic-addon3"><i class="material-icons">assignment_ind</i> <?=str_replace('https://','',PAGE_DOMAIN)?>/user/</span>
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
                                            <div class="checkbox">
                                                <label>
                                                    <input id="suscribe" type="checkbox" name="suscribe">Deseo registrarme en el boletín informativo para estar al día de las ofertas y novedades de <?=PAGE_NAME?>.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-primary btn-round" name="signup" value="Sign up">¡ADELANTE!</button>
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
