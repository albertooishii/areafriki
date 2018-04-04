<div class="card">
    <div class="content">
        <h4>DATOS DE ENVÍO:</h4>
        <p>Nombre y apellidos: <?=$data["name"]?></p>
        <p>Dirección: <?=$data["address"]?>, <?=$data["cp"]?>, <?=$data["localidad"]?>, <?=$data["provincia"]?></p>
        <p>Teléfono de contacto: <?=$data["phone"]?></p>
    <?php
        if(!empty($data["nota"])){
    ?>
        <p>Nota: <?=$data["nota"]?></p>
    <?php
        }
    ?>
    </div>
</div>