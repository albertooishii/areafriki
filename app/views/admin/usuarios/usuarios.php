<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Usuarios</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado de usuarios
                <a href='data:,<?=$data["txtexport"]?>' download="listausuarios.csv">Exportar</a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper table-responsive">
                    <table class="table table-striped table-bordered table-hover data-table uploads" id="designs">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>user</th>
                                <th>email</th>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>DNI</th>
                                <th>Banco</th>
                                <th>Paypal</th>
                                <th>Crédito</th>
                                <th>Referral</th>
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
