<div class="container wrapper">
    <form action="carrito?action=pago" method="post">
        <div class="row">
            <div class="col-md-9">
                <div id="direccion">
                    <h4>DIRECCIÓN DE ENVÍO</h4>
                    <div class="form-group">
                        <label for="inputNombre">Nombre y apellidos</label>
                        <input type="text" class="form-control" id="inputNombre" placeholder="Nombre y apellidos" value="<?=$data["nombre"]?>" required name="nombre"
                                data-fv-notempty="true"
                                data-fv-notempty-message="El nombre es obligatorio" />
                    </div>

                    <div class="form-group">
                        <label for="inputDireccion">Dirección</label>
                        <input type="text" class="form-control" id="inputDireccion" placeholder="Calle, número, planta, letra, escalera" value="<?=$data["direccion"]?>" required name="direccion"
                            data-fv-notempty="true"
                            data-fv-notempty-message="La dirección es obligatoria"   />
                    </div>

                    <div class="form-group">
                        <label for="inputCP">Código Postal</label>
                        <input type="text" class="form-control" id="inputCP" placeholder="Código Postal" value="<?=$data["cp"]?>" required name="cp"
                            data-fv-notempty="true"
                            data-fv-notempty-message="El código postal es obligatorio"
                            data-fv-stringlength-min="5"
                            data-fv-stringlength-max="5"/>
                    </div>

                    <div class="form-group">
                        <label for="inputLocalidad">Localidad</label>
                        <input type="text" class="form-control" id="inputLocalidad" placeholder="Localidad"value="<?=$data["localidad"]?>" required name="localidad"
                            data-fv-notempty="true"
                            data-fv-notempty-message="La localidad es obligatoria"/>
                    </div>

                    <div class="form-group">
                       <label for="inputLocalidad">Provincia</label><br/>
                        <?=$data["provincia"]?>
                    </div>

                    <div class="form-group">
                        <label for="inputTelefono">Número de teléfono</label>
                        <input type="text" class="form-control" id="inputTelefono" placeholder="Teléfono" value="<?=$data["phone"]?>" required name="phone"
                            data-fv-notempty="true"
                            data-fv-notempty-message="El número de teléfono es necesario">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputNombre">Si deseas dejar un comentario sobre el pedido, escríbelo a continuación</label>
                    <textarea class="form-control" name="descripcion"></textarea>
                </div>
                <div id="pago">
                    <h4>OPCIONES DE PAGO</h4>
                    <?=$data["form-pago"]?>
                </div>
            </div>
            <div class="col-md-3">
                <h4>Productos:</h4>
                <h4><?=$subtotal?>€</h4>
                <h4>Envío:</h4>
                <h4><?=$envio?>€</h4>
                <h3>Importe total:</h3>
                <h3><?=$precio_total?>€</h3>
                <p>Precio con IVA incluido</p>
                <input type="submit" value="Pagar" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>
<script>
$(document).ready(function() {
    $("form").formValidation();
});
</script>
