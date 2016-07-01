<div class="container wrapper">
     <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 well">
            <form id="loginForm" role="form" method="post" action="/user?action=recoverpass"
                data-fv-framework="bootstrap"
                data-fv-icon-valid="glyphicon glyphicon-ok"
                data-fv-icon-invalid="glyphicon glyphicon-remove"
                data-fv-icon-validating="glyphicon glyphicon-refresh">

                <header class="subhead aligncenter">
                    <h4>INTRODUCE TU NOMBRE DE USUARIO O EMAIL</h4>
                </header>
                <p>Introduce a continuación tu nombre de usuario o email. Te enviaremos un mensaje de correo electrónico con un enlace único para poder recuperar tu contraseña.</p>

                <div class="form-group label-floating">
                    <label class="control-label" for="username">Nombre de usuario o email</label>
                    <input type="text" class="form-control" name="username" id="username"
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
                <?=@$data["error_msg"]?>

                <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-primary btn-raised" name="signup" value="Sign up">Recuperar contraseña</button>
                    </div>
                </div>
             </form>
         </div>
         <div class="col-sm-3"></div>
    </div>
</div>
