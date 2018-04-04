<?php
    $this->loadModel("address");
    $address = New Address_Model();
    $data["lista_provincias"]="";
    $provincias=$address->getProvincias();
    foreach($provincias as $provincia){
        $selected ="";
        if($provincia["id"]==@$data["provincia_selected"]){
            $selected = " selected ";
        }
        $data["lista_provincias"].="<option ".$selected." value=".$provincia["id"].">".$provincia["nombre"]."</option>";
    }

?>

<select class="form-control" data-live-search="true" required name="provincia" data-fv-notempty="true" data-fv-notempty-message="Selecciona una provincia">
    <option value="" disabled selected>Selecciona la provincia</option>
    <?=$data["lista_provincias"]?>
</select>