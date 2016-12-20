<?php
    class Store extends Controller{

        function index_store(){
            $this->loadModel("producto");
            $pr = New Producto_Model();
            $this->loadModel("precio");
            $pre = New Precio_Model();

            if(!isset($_GET["node"])){$node="index";}else{$node=$_GET["node"];}
            $data["meta_tags"]=$this->loadView("store/".$node, "meta");
            $data["custom_js"]=$this->minifyJs("product", "product_file");
            @$data["custom_js"].=$this->minifyJs("store/".$node, "script");
            @$data["custom_css"]=$this->minifyCss("store/".$node, "style");
            $this->render("store/".$node, $node, $data);
        }
    }
?>
