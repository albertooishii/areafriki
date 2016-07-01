<div class="container wrapper">
     <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <form id="registrationForm" class="form-horizontal" method="post" action="/user?action=convertir_vendedor"
                data-fv-framework="bootstrap"
                data-fv-icon-valid="glyphicon glyphicon-ok"
                data-fv-icon-invalid="glyphicon glyphicon-remove"
                data-fv-icon-validating="glyphicon glyphicon-refresh">

                <header class="subhead">
                    <h4>PARA REGISTRARTE COMO VENDEDOR NECESITAMOS AÑADIR A TU CUENTA LA SIGUIENTE INFORMACIÓN</h4>
                </header>

                <div class="form-group">
                   <label class="col-md-4 control-label">DNI/NIE/CIF</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="idnum"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Es necesario el número del documento para garantizar la identidad de nuestros vendedores"
                            data-fv-id="true"
                            data-fv-id-country="ES"
                            data-fv-id-message="El número de identificación no es válido" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputFechaNacimiento">Fecha de nacimiento</label>
                    <div class="date col-md-8">
                        <input type="text" class="form-control" id="inputFechaNacimiento" placeholder="DD/MM/YYYY" name="birthday"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Introduce tu fecha de nacimiento">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputPaypal">
                        <i class="fa fa-paypal"></i> Cuenta de PAYPAL
                    </label>
                    <div class="col-md-8">
                        <input type="email" class="form-control" id="inputPaypal" name="paypal" placeholder="usuario@email.com"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Introduce el email de tu cuenta de paypal"
                            data-fv-emailaddress="true"
                            data-fv-emailaddress-message="La cuenta de paypal no es correcta">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-offset-4 col-sm-8">
                        <input id="accept-tos" type="checkbox" name="accept-tos"
                            data-fv-icon="false"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Acepta los términos para continuar"> He leído y acepto los <a href="/info/tos" target="_blank">términos y condiciones<i class="fa fa-external-link"></i></a>
                    </label>
                </div>

                <div class="form-group">
                    <div class="col-xs-9 col-xs-offset-3">
                        <button type="submit" class="btn btn-primary btn-raised" name="signup" value="Sign up">Convertir cuenta</button>
                    </div>
                </div>
            </form>
         </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#registrationForm').formValidation({
        fields: {
            birthday: {
                validators: {
                    callback: {
                        message: 'La fecha de nacimiento no es válida',
                        callback: function(value, validator, $field) {
                            if (value === '') {
                                return true;
                            }

                            // Check if the value has format of DD-MM-YYYY
                            return moment(value, 'DD/MM/YYYY', true).isValid();
                        }
                    }
                }
            }
        }
    });

    $("#inputFechaNacimiento").keyup(function(e){
        if (e.keyCode != 8){
            if ($(this).val().length == 2){
                $(this).val($(this).val() + "/");
            } else if ($(this).val().length == 5){
                $(this).val($(this).val() + "/");
            }
        } else {
            var temp = $(this).val();

            if ($(this).val().length == 5){
                $(this).val(temp.substring(0,4));
            } else if ($(this).val().length == 2){
                $(this).val(temp.substring(0,1));
            }
        }
    });
});
</script>
