<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=$data["attr_nombre"]?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tipo de atributo: <?=$data["attr_tipo"]?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover data-table">
                        <thead>
                            <tr>
                                <th>Valor</th>  
                                <th>Código</th>  
                                <th>Precio base</th>
                                <th>Beneficio máximo</th> 
                                <th>Precio máximo total</th> 
                                <th>Modificar</th> 
                                <!--<th>Eliminar</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?=$data["valores"]?>
                        </tbody> 
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 