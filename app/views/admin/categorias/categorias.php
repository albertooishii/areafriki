<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Categorías</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
        <?=$data["mensaje"]?>
                Listado de categorías
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper table-responsive">
                    <table class="table table-striped table-bordered table-hover data-table" id="categorias">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Descripción corta</th>
                                <th>Modificar</th>
                                <!--<th>Desactivar</th>
                                <th>Activar</th>
                                <th>Eliminar</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?=$data["datos_categorias"]?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
