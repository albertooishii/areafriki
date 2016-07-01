<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Subcategorías</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="/simbiosis/categorias?action=new" class='btn btn-default'>AÑADIR NUEVA SUBCATEGORÍA</a>
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
                                <th>Descripción Corta</th>
                                <th>Precio base</th>
                                <th>Beneficio</th>
                                <th>Modificar</th>
                                <!--<th>Eliminar</th>-->
                                <th>Desactivar</th>
                                <th>Activar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?=$data["datos_subcategorias"]?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
