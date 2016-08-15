<?php
    foreach($data["listas"] as $lista){
        if(isset($data["lista_producto"])){
            if($lista["token"]==$data["lista_producto"]){
                $selected="selected";
            }else{
                $selected="";
            }
        }else{
            $selected="";
        }
?>
        <option value="<?=$lista["token"]?>" <?=$selected?>><?=$lista["nombre"]?></option>
<?php
    }
?>
