<?php
    class Store extends Controller{

        function index_store(){
            $this->loadModel("producto");
            $pr = New Producto_Model();
            $this->loadModel("precio");
            $pre = New Precio_Model();

            switch(@$_GET["node"]){
                default:
                    $data["page_title"] = "Pokémon Go - AreaStore";
                    $data["custom_js"]=$this->minifyJs("product", "product_file");
                    $this->render("store/pokemongo","pokemongo",$data);
            }
        }
    }
?>
