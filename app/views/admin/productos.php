<div class="container">
    <div><a href="/simbiosis">Volver al panel de administración</a></div>
    <?=$data["mensaje"]?>
    <table class="table">
        <thead>
            <th>#</th>
            <th>Nombre</th>
            <th>Beneficio</th>
            <th>Ventas</th>
            <th>Categoría</th>
            <th>Creador</th>
            <th>Visitas</th>
            <th>Likes</th>
            <th>Shares</th>
            <th>Fecha</th>
            <th>Revisar</th>
            <th>Eliminar</th>
        </thead>
        <tbody>
            <?=$data["datos_productos"]?>
        </tbody>
    </table>
</div>
