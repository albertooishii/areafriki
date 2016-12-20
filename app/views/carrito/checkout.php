<style>
    #vender-mobile, #feedback, .checkout-buttons{
        display: none !important;
    }
</style>

<div class="container wrapper">
    <h3 class="title text-center">Información de envío</h3>
    <p>Introduce y revisa tus datos personales y la dirección donde quieres que lleguen los envíos. Selecciona el método de pago que vas a utilizar y una vez esté todo a tu gusto dale a <strong>Pagar</strong></p>

    <form id="payment-form" action="<?=PAGE_DOMAIN?>/carrito/pago" method="post">
        <div class="row inner">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h4 class="title">
                                Resumen del pedido
                                <i class="material-icons">keyboard_arrow_down</i>
                            </h4>
                        </a>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <?=$data["carrito_vendedor"]?>
                        </div>
                    </div>
                </div>
                <h4 class="title">Dirección de envío</h4>
                <p>Indica la dirección donde quieres que se envíe este pedido. Si ya tienes una dirección registrada en <?=PAGE_NAME?> puedes utilizarla.</p>
                <div class="card">
                    <div class="content">
                        <div id="direccion">
                            <div class="form-group label-floating">
                                <label for="inputName" class="control-label">Nombre y apellidos</label>
                                <input type="text" class="form-control" id="inputName" value="<?=$data["nombre"]?>" required name="name"
                                        data-fv-notempty="true"
                                        data-fv-notempty-message="El nombre es obligatorio" />
                            </div>
<?php
    if(!isset($_SESSION["login"])){
?>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Correo electrónico"
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="El e-mail es obligatorio"
                                    data-fv-emailaddress="true"
                                    data-fv-emailaddress-message="No has introducido una dirección de e-mail válida" />
                            </div>
<?php
    }
?>
                            <div class="form-group label-floating">
                                <label for="inputDireccion" class="control-label">Dirección postal</label>
                                <input type="text" class="form-control" id="inputDireccion" value="<?=$data["direccion"]?>" required name="address"
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="La dirección es obligatoria"   />
                            </div>

                            <div class="form-group label-floating">
                                <label for="inputCP" class="control-label">Código Postal</label>
                                <input type="text" class="form-control" id="inputCP" value="<?=$data["cp"]?>" required name="cp" data-stripe="address_zip"
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="El código postal es obligatorio"
                                    data-fv-stringlength-min="5"
                                    data-fv-stringlength-max="5"/>
                            </div>

                            <div class="form-group label-floating">
                                <label for="inputLocalidad" class="control-label">Localidad</label>
                                <input type="text" class="form-control" id="inputLocalidad" value="<?=$data["localidad"]?>" required name="localidad"
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="La localidad es obligatoria"/>
                            </div>

                            <div class="form-group">
                               <label for="inputLocalidad" class="control-label">Provincia</label><br/>
                                <?=$data["provincia"]?>
                            </div>

                            <div class="form-group label-floating">
                                <label for="inputTelefono" class="control-label">Número de teléfono</label>
                                <input type="text" class="form-control" id="inputTelefono" value="<?=$data["phone"]?>" required name="phone"
                                    data-fv-notempty="true"
                                    data-fv-notempty-message="El número de teléfono es necesario">
                            </div>
                        </div>
                        <div class="form-group label-floating">
                            <label for="inputNombre" class="control-label">Si deseas dejar alguna aclaración sobre la dirección de envío escríbela a continuación</label>
                            <textarea class="form-control" name="nota"><?=$data["nota"]?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="content">
                        <input type="hidden" name="token" value="<?=$data["token"]?>">
                        <h4 class="title">Método de pago</h4>
                        <p>Selecciona la modalidad con la que prefieras realizar el pago. Dependiendo del vendedor se ofrecerán unas opciones u otras.</p>
                        <div id="pago">
                            <?=$data["form-pago"]?>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-round">Completar pago</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
