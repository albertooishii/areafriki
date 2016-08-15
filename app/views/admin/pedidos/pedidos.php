<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pedidos</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
        <?=$data["mensaje"]?>
                Listado de pedidos
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper table-responsive">
                    <table class="table table-striped table-bordered table-hover data-table" id="pedidos">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>TOKEN</th>
                                <th>Vendedor</th>
                                <th>Comprador</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Precio</th>
                                <th>Gastos envío</th>
                                <th>Nota</th>
                                <th>Observaciones</th>
                                <th>Localizador</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?=$data["listado_pedidos"]?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
