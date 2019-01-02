<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Liquidaciones</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado de liquidaciones
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper table-responsive">
                    <table class="table table-striped table-bordered table-hover data-table" id="liquidaciones">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>E-Mail</th>
                                <th>Importe</th>
                                <th>Banco</th>
                                <th>Paypal</th>
                                <th>Estado</th>
                                <!--<th>Pedidos</th>
                                <th>Fecha Liquidación</th>
                                <th>Fecha Límite de pago</th>
                                <th>Liquidar</th>-->
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