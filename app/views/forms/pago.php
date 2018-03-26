<div class="row">
<?php
    if($data["stripe"]==true){
?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-group radio">
            <label><i class="fa fa-credit-card" aria-hidden="true"></i> Tarjeta bancaria
                <input type="radio" name="pay_method" value="stripe" id="checkbox_stripe"
                    data-fv-choice="true"
                    data-fv-choice-min="1"
                    data-fv-choice-max="1"
                    data-fv-choice-message="Selecciona un método de pago"
                />
            </label>
        </div>
        <div id="stripe_inputs" class="pay_method_inputs" data-publickey="<?=STRIPE_PUBLIC?>" style="display:none;">
              <div class='col-xs-12 form-group required label-floating'>
                  <label class='control-label'>Número de tarjeta</label>
                  <input autocomplete='off' class='form-control' name="ccNumber" data-stripe="number" size='20' type='text' required data-fv-creditcard="true"
                data-fv-creditcard-message="El número de la tarjeta de crédito no es válido">
              </div>
              <div class='col-xs-4 form-group required'>
                  <label class='control-label'>Caducidad</label>
                  <input class='form-control' placeholder='MM' size='2' type='text' data-stripe="exp_month" required data-fv-notempty="true" data-fv-notempty-message="Introduce el mes de expiración de la tarjeta. Ej. 09">
              </div>
              <div class='col-xs-4 form-group required'>
                  <label class='control-label'> </label>
                  <input class='form-control' placeholder='AAAA' size='4' type='text' data-stripe="exp_year" required data-fv-notempty="true" data-fv-notempty-message="Introduce el año de expiración de la tarjeta. Ej. 2019">
              </div>
            <div class='col-xs-4 form-group required'>
                  <label class='control-label'>CVC</label>
                  <input autocomplete='off' class='form-control' placeholder='ej. 311' size='4' type='text' data-stripe="cvc" required name="cvc" data-fv-cvv="true"
                data-fv-cvv-ccfield="ccNumber" data-fv-cvv-message="El código CVC no es válido.">
              </div>
              <div class='col-md-12'>
                  <div class='payment-errors'>
                      <p class="text-danger"></p>
                  </div>
              </div>
        </div>
    </div>
<?php
    }
    if($data["paypal"]==true){
?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-group radio">
            <label><i class="fa fa-paypal" aria-hidden="true"></i> Paypal
                <input type="radio" name="pay_method" value="paypal" id="checkbox_paypal"
                    data-fv-choice="true"
                    data-fv-choice-min="1"
                    data-fv-choice-max="1"
                    data-fv-choice-message="Selecciona un método de pago"
                />
            </label>
        </div>
    </div>
<?php
    }
    if($data["iban"]==true){
?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-group radio">
            <label><i class="fa fa-exchange" aria-hidden="true"></i> Ingreso o transferencia bancaria
                <input type="radio" name="pay_method" value="transferencia" id="checkbox_transferencia" required>
            </label>
        </div>
    </div>
<?php
    }
?>
</div>
