<div class="container wrapper">
     <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 well bs-component">
            <form id="loginForm" role="form" method="post" action="/user?action=login"
                data-fv-framework="bootstrap"
                data-fv-icon-valid="glyphicon glyphicon-ok"
                data-fv-icon-invalid="glyphicon glyphicon-remove"
                data-fv-icon-validating="glyphicon glyphicon-refresh">

                <header class="subhead aligncenter">
                    <h4>INTRODUCE TUS DATOS PARA ENTRAR</h4>
                </header>

                <div class="form-group label-floating">
                    <label class="control-label">Nombre de usuario o email</label>
                    <input type="text" class="form-control" name="username"
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
                <div class="form-group label-floating">
                    <label class="control-label" for="password">Contraseña</label>
                    <input type="password" class="form-control" name="password" autocomplete="off" id="password"
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
                <?=$data["login_msg"]?>

                <div class="form-group aligncentermobile">
                    <div class="col-sm-8 col-sm-offset-4">
                        <button type="submit" class="btn btn-primary btn-raised" name="signup" value="Sign up">Entrar</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
                 <div class="col-sm-12 aligncenter">
                    <a href="/login/recoverpass">He olvidado mi contraseña</a>
                 </div>
             </form>
         </div>
    </div>
    <!--<div class="row">
        <header class="subhead aligncenter">
            <h3>NO TENGO CUENTA, ME GUSTARÍA REGISTRARME</h3>
        </header>
        <div class="col-md-6"><a href="/user?action=register_comprador_form" class="btn btn-primary aligncenter">QUIERO COMPRAR</a></div>
        <div class="col-md-6"><a href="/user?action=register_vendedor_form" class="btn btn-primary aligncenter">QUIERO VENDER</a></div>
    </div>-->
</div>
