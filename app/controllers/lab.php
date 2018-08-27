<?php
    require_once 'app/helpers/database.php';

    class Lab extends Database{
        function __construct(){
            parent::__construct();
         }

        function index_lab(){
            @$action=$_GET["action"];
            switch($action){
                default:
                    $query = "SELECT designs.user as userid, sum(productos.visitas) as visitas from productos inner join designs on productos.design=designs.token group by designs.user order by visitas desc";
                    if($answer=$this->_db->query($query)){
                        while($fila = $answer->fetch_assoc()){
                            $lista_users[]=$fila;
                        }

                        foreach ($lista_users as $user){
                            $query="UPDATE users SET views = '".$user['visitas']."' WHERE id = '".$user['userid']."'";
                            $this->_db->query($query);
                        }
                    }
            }
        }
    }
?>