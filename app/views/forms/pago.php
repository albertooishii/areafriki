<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Paypal o Tarjeta bancaria
                <input type="radio" name="pay_method" value="paypal" id="checkbox_paypal"
                    data-fv-choice="true"
                    data-fv-choice-min="1"
                    data-fv-choice-max="1"
                    data-fv-choice-message="Selecciona un método de pago"
                />
                <img style="width:100%" src="/app/views/forms/img/paypal_button.jpg">
            </label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Ingreso o transferencia bancaria
                <input type="radio" name="pay_method" value="transferencia" id="checkbox_transferencia" required>
                <img style="width:100%" src="/app/views/forms/img/transferencia_button.jpg">
            </label>
        </div>
    </div>
</div>
