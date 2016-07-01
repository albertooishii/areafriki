<div class="container wrapper">
     <div class="row">
        <div class="col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 well bs-component">
            <form id="loginForm" role="form" method="post" action="/user?action=login"
                data-fv-framework="bootstrap"
                data-fv-icon-valid="glyphicon glyphicon-ok"
                data-fv-icon-invalid="glyphicon glyphicon-remove"
                data-fv-icon-validating="glyphicon glyphicon-refresh">

                <header class="subhead aligncenter">
                    <h4>INTRODUCE TUS DATOS PARA ACTIVAR LA CUENTA</h4>
                </header>

                <?=$data["login_msg"]?>

                <div class="form-group label-floating">
                    <label class="control-label">Nombre de usuario o email</label>
                    <input type="text" class="form-control" name="username"
                        data-fv-notempty="true"
                        data-fv-notempty-message="Nombre de usuario o email requerido"

                        data-fv-stringlength="true"
                        data-fv-stringlength-min="3"
                        data-fv-stringlength-max="100"
                        data-fv-stringlength-message="El nombre de usuario tiene que tener mínimo 3 caracteres"

                        data-fv-regexp="true"
                        data-fv-regexp-regexp="^[a-zA-Z0-9_\.@]+$"
                        data-fv-regexp-message="El nombre de usuario solo puede tener letras, números, guiones bajos y puntos" />
                </div>
                <div class="form-group label-floating">
                <label class="control-label">Contraseña</label>
                    <input type="password" class="form-control" name="password"
                        data-fv-notempty="true"
                        data-fv-notempty-message="La contraseña es obligatoria">
                </div>
               <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input id="loginrec" type="checkbox" name="loginrec"> Mantener la sesión iniciada
                        </label>
                   </div>
                </div>
                <input type='hidden' value='<?=$data["activation_key"]?>' name='activation_key'>

                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-4">
                        <button type="submit" class="btn btn-primary btn-raised" name="signup" value="Sign up">Entrar</button>
                    </div>
                </div>
            </form>
         </div>
    </div>
</div>
