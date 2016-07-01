<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Crafts subidos</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado de crafts subidos
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper table-responsive">
                    <table class="table table-striped table-bordered table-hover data-table uploads" id="crafts">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Token</th>
                                <th>Categoría</th>
                                <th>Autor</th>
                                <th>Email</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Beneficio</th>
                                <th>Comprobación</th>
                                <th>Validar</th>
                                <th>Denegar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?=$data["tbody"]?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
