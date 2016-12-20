<?php
    $this->loadModel("address");
    $address = New Address_Model();
    $data["lista_paises"]="";
    $paises=$address->getPaises();
    foreach($paises as $pais){
        $selected ="";
        if($pais["id"]==@$data["pais_selected"]){
            $selected = " selected ";
        }
        $data["lista_paises"].="<option ".$selected." value=".$pais["id"].">".$pais["nombre"]."</option>";
    }

?>

<select class="form-control" data-live-search="true" required name="pais" data-fv-notempty="true" data-fv-notempty-message="Selecciona un país">
    <option value="" disabled selected>Selecciona el país</option>
    <?=$data["lista_paises"]?>
</select>
