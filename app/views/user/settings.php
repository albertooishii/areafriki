<div class="container wrapper">
    <ul class="nav nav-pills nav-pills-danger">
        <li class="active"><a href="#personal_information" data-toggle="tab" aria-expanded="false">DATOS PERSONALES</a></li>
        <li class=""><a href="#cash_information" data-toggle="tab" aria-expanded="false">CONFIGURACIÓN DE PAGOS</a></li>
        <li class=""><a href="#mailing_notifications" data-toggle="tab" aria-expanded="false">GESTIÓN DE NOTIFICACIONES</a></li>
        <li class=""><a href="#change_password" data-toggle="tab" aria-expanded="true">CAMBIAR CONTRASEÑA</a></li>
    </ul>
    <div class="tab-content tab-space">
        <div id="personal_information" class="card card-raised tab-pane fade  in active">
            <div class="content">
                <form id="registrationForm" method="post" action="/settings"
                    data-fv-framework="bootstrap"
                    data-fv-icon-valid="glyphicon glyphicon-ok"
                    data-fv-icon-invalid="glyphicon glyphicon-remove"
                    data-fv-icon-validating="glyphicon glyphicon-refresh">

                    <header>
                        <h3 class="title text-primary"><i class="material-icons">contact_mail</i> Datos personales</h3>
                        <p>Aquí puedes cambiar los ajustes de información personal sobre tu cuenta.</p>
                    </header>
                    <?=$data["mensaje"]?>
                    <p>Nombre y apellidos: <?=$data["nombre"]?></p>

                    <div class="form-group label-floating">
                        <label class="control-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" disabled value="<?=$data["email"]?>"
                            data-fv-notempty="true"
                            data-fv-notempty-message="El e-mail es obligatorio"
                            data-fv-emailaddress="true"
                            data-fv-emailaddress-message="No has introducido una dirección de e-mail válida" />
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label" for="inputTelefono">Número de teléfono</label>
                        <input type="text" class="form-control" id="inputTelefono" name="phone" value="<?=$data["phone"]?>"
                            data-fv-notempty="true"
                            data-fv-notempty-message="El número de teléfono es necesario">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="inputFechaNacimiento">Fecha de nacimiento (DD/MM/YYYY)</label>
                        <input type="text" class="form-control" id="inputFechaNacimiento" placeholder="DD/MM/YYYY" name="birthday" value="<?=$data["birthday"]?>"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Introduce tu fecha de nacimiento">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="inputLocalidad">País</label>
                        <?=$data["pais"]?>
                    </div>
                    
                    <div id="info_spain">
                        <div class="form-group">
                            <label class="control-label" for="inputDireccion">Dirección</label>
                            <input type="text" class="form-control" id="inputDireccion" value="<?=$data["address"]?>" placeholder="Calle, número, planta, letra, escalera" name="address"
                                data-fv-notempty="true"
                                data-fv-notempty-message="La dirección es obligatoria"   />
                        </div>

                        <div class="form-group label-floating">
                            <label class="control-label" for="inputCP">Código Postal</label>
                            <input type="text" class="form-control" id="inputCP" value="<?=$data["cp"]?>" name="cp"
                                data-fv-notempty="true"
                                data-fv-notempty-message="El código postal es obligatorio"
                                data-fv-stringlength-min="5"
                                data-fv-stringlength-max="5"/>
                        </div>

                        <div class="form-group label-floating">
                            <label class="control-label" for="inputLocalidad">Localidad</label>
                            <input type="text" class="form-control" id="inputLocalidad" value="<?=$data["localidad"]?>" name="localidad"
                                data-fv-notempty="true"
                                data-fv-notempty-message="La localidad es obligatoria"/>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputLocalidad">Provincia</label>
                            <?=$data["provincia"]?>
                        </div>

                        <div class="form-group">
                           <label for="idnum" class="control-label">DNI/NIE/CIF</label>
                            <input type="text" class="form-control" name="idnum" id="idnum" value="<?=$data["idnum"]?>" autocomplete="off"
                                data-fv-notempty="true"
                                data-fv-notempty-message="Es necesario el número del documento para garantizar la identidad de nuestros vendedores"
                                data-fv-id="true"
                                data-fv-id-country="ES"
                                data-fv-id-message="El número de identificación no es válido"/>
                            <label class="control-label" for="idnum">El número de identificación debe tener la letra MAYÚSCULA. Ejemplo: 012345678Z</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-raised btn-round" name="signup" value="Sign up"><i class="material-icons">save</i> Guardar los cambios</button>
                        <!--<a href="#" class="btn btn-danger btn-raised btn-round"><i class="material-icons">warning</i> Borrar la cuenta</a>-->
                    </div>
                </form>
            </div>
        </div>


        <div id="cash_information" class="card card-raised tab-pane fade">
            <div class="content">
                <form id="registrationForm" method="post" action="/user?action=updatecash"
                    data-fv-framework="bootstrap"
                    data-fv-icon-valid="glyphicon glyphicon-ok"
                    data-fv-icon-invalid="glyphicon glyphicon-remove"
                    data-fv-icon-validating="glyphicon glyphicon-refresh">

                    <header>
                        <h3 class="title text-primary"><i class="material-icons">monetization_on</i> Configuración de pagos</h3>
                        <p>Configura aquí los métodos de pago de los que dispones para poder cobrar por tus productos vendidos:</p>
                    </header>
                    <ul style="padding-left:20px;">
                        <li>El beneficio ganado en los <strong>productos vendidos con tus diseños</strong> quedará acumulado como saldo en tu cuenta y se ingresará en la cuenta que tengas configurada entre los primeros 10 días de cada mes. <strong>Saldo actual: <?=$data["credit"]?> €</strong></li>
                        <li>El pago de los <strong>productos hechos a mano, nuevos y segunda mano</strong> se realizará directamente en tu cuenta sin ningún tipo de comisión por nuestra parte.</li>
                    </ul>

                    <p class="inner"><i class="fa fa-paypal"></i> PayPal:</p>
                    <div class="form-group label-floating">
                        <label class="control-label" for="inputPaypal">
                            Cuenta de PAYPAL (usuario@email.com)
                        </label>
                        <input type="email" class="form-control" id="inputPaypal" name="paypal" value="<?=$data["paypal"]?>"
                            data-fv-notempty-message="Introduce el email de tu cuenta de paypal"
                            data-fv-emailaddress="true"
                            data-fv-emailaddress-message="La cuenta de paypal no es correcta">
                    </div>

                    <p class="inner"><i class="material-icons">&#xE84F;</i> Transferencia bancaria:</p>
                    <div class="form-group label-floating">
                        <label class="control-label" for="inputBanco">
                            Entidad bancaria (nombre del banco)
                        </label>
                        <input type="text" class="form-control" id="inputBanco" name="banco" value="<?=$data["banco"]?>"/>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label" for="inputIBAN">
                            Cuenta bancaria (IBAN)
                        </label>
                        <input type="text" class="form-control" id="inputIBAN" name="iban" value="<?=$data["iban"]?>"
                            data-fv-iban="true"
                            data-fv-iban-sepa="true"
                            data-fv-iban-country="ES"
                            data-fv-iban-message="El IBAN introducido no es correcto" />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-raised btn-round" name="signup" value="Sign up"><i class="material-icons">save</i> Guardar los cambios</button>
                    </div>
                </form>
            </div>
        </div>


        <div id="mailing_notifications" class="card card-raised tab-pane fade">
            <div class="content">
                <form action="<?=PAGE_DOMAIN?>/mailing/update" method="post">
                    <header>
                        <h3 class="title text-primary"><i class="material-icons">notifications_active</i> Gestión de notificaciones</h3>
                        <p>Aquí puedes gestionar que tipo de notificaciones por email quieres recibir.</p>
                    </header>

                    <input type="hidden" name="lists[]" value="1">

                    <h4 class="title">Novedades de <?=PAGE_NAME?></h4>
                    <p>Te mantendremos informado/a sobre actualizaciones y mejoras de interés general sobre <?=PAGE_NAME?>. Nuevas funcionalidades y mejoras de la web, curiosidades del ámbito friki, eventos, etc.</p>
                    <ul class="col-md-12">
                        <li><div class="checkbox"><label><input type="checkbox" <?=in_array(4, $data['lists'])?'checked':''?> value="4" name="lists[]">Nuevas funcionalidades y curiosidades</label></div></li>
                    </ul>

                    <h4 class="title">Novedades de interés para vendedores</h4>
                    <p>Te mantendremos informado/a sobre actualizaciones y mejoras de <?=PAGE_NAME?> relacionados con el tipo de producto que vendes: nuevas utilidades y opciones, facilidades de venta, sugerencias para vender más, etc.</p>
                    <ul class="col-md-12">
                        <li><div class="checkbox"><label><input type="checkbox" <?=in_array(8, $data['lists'])?'checked':''?> value="8" name="lists[]">Productos personalizados con diseños</label></div></li>
                        <li><div class="checkbox"><label><input type="checkbox" <?=in_array(9, $data['lists'])?'checked':''?> value="9" name="lists[]">Manualidades, artesanía, handmades</label></div></li>
                        <li><div class="checkbox"><label><input type="checkbox" <?=in_array(11, $data['lists'])?'checked':''?> value="11" name="lists[]">Productos nuevos y de segunda mano</label></div></li>
                    </ul>

                    <h4 class="title">Descuentos y promociones sobre productos de tu interés</h4>
                    <p>Marca las categorías temáticas que sean de tu interés y te mantendremos al tanto de todas las novedades adaptadas a tus gustos. ¡Serás el primero en enterarte!</p>
                        <div class="form-group">
                            <ul class="col-md-4">
                                <li><div class="checkbox"><label><input type="checkbox" <?=in_array(12, $data['lists'])?'checked':''?> value="12" name="lists[]">Cine</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" <?=in_array(13, $data['lists'])?'checked':''?> value="13" name="lists[]">Videojuegos</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" <?=in_array(14, $data['lists'])?'checked':''?> value="14" name="lists[]">Series</label></div></li>
                            </ul>
                            <ul class="col-md-4">
                                <li><div class="checkbox"><label><input type="checkbox" <?=in_array(15, $data['lists'])?'checked':''?> value="15" name="lists[]">Manga & Anime (japonés)</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" <?=in_array(16, $data['lists'])?'checked':''?> value="16" name="lists[]">Cómics</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" <?=in_array(17, $data['lists'])?'checked':''?> value="17" name="lists[]">Animación Occidental</label></div></li>
                            </ul>
                            <ul class="col-md-4">
                                <li><div class="checkbox"><label><input type="checkbox" <?=in_array(18, $data['lists'])?'checked':''?> value="18" name="lists[]">Literatura fantástica</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" <?=in_array(19, $data['lists'])?'checked':''?> value="19" name="lists[]">Kawaii</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" <?=in_array(20, $data['lists'])?'checked':''?> value="20" name="lists[]">Cultura Friki</label></div></li>
                            </ul>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-raised btn-round" name="signup" value="Sign up"><i class="material-icons">save</i> Guardar los cambios</button>
                    </div>
                </form>
            </div>
        </div>


        <div id="change_password" class="card card-raised tab-pane fade">
            <div class="content">
                <form id="registrationForm" method="post" action="/user?action=updatepassword"
                    data-fv-framework="bootstrap"
                    data-fv-icon-valid="glyphicon glyphicon-ok"
                    data-fv-icon-invalid="glyphicon glyphicon-remove"
                    data-fv-icon-validating="glyphicon glyphicon-refresh">

                    <header>
                        <h3 class="title text-primary"><i class="material-icons">vpn_key</i> Cambiar contraseña</h3>
                        <p>Cambia la contraseña de acceso a tu cuenta.</p>
                    </header>
                    <div class="form-group label-floating">
                        <label class="control-label">Contraseña actual</label>
                        <input type="password" class="form-control" name="oldpassword"
                            data-fv-notempty="true"
                            data-fv-notempty-message="La contraseña es obligatoria"

                            data-fv-stringlength="true"
                            data-fv-stringlength-min="6"
                            data-fv-stringlength-message="La contraseña tiene que tener como mínimo 6 caracteres"

                            data-fv-different="true"
                            data-fv-different-field="user"
                            data-fv-different-message="La contraseña no puede ser igual que el nobmre de usuario" />
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Nueva contraseña</label>
                        <input type="password" class="form-control" name="password"
                            data-fv-notempty="true"
                            data-fv-notempty-message="La contraseña es obligatoria"

                            data-fv-stringlength="true"
                            data-fv-stringlength-min="6"
                            data-fv-stringlength-message="La contraseña tiene que tener como mínimo 6 caracteres"

                            data-fv-different="true"
                            data-fv-different-field="user"
                            data-fv-different-message="La contraseña no puede ser igual que el nobmre de usuario" />
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Repite la nueva contraseña</label>
                        <input type="password" class="form-control" name="confirmPassword"
                            data-fv-notempty="true"
                            data-fv-notempty-message="Repite la contraseña"
                            data-fv-identical="true"
                            data-fv-identical-field="password"
                            data-fv-identical-message="Las contraseñas deben coincidir" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-raised btn-round" name="signup" value="Sign up"><i class="material-icons">save</i> Actualizar la contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
