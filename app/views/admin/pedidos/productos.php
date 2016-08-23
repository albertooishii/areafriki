<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Productos del pedido
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper table-responsive">
                    <table class="table table-striped table-bordered table-hover data-table productos" id="crafts">
                        <thead>
                            <tr>
                                <th>Token</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Autor</th>
                                <th>Precio</th>
                                <th>Atributos</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Nota</th>
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
