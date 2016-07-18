<div class="container wrapper">
    <div class="row inner aligncenter">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="subhead">SUBE TUS DISEÑOS</h2>
            <p>En ÁreaFriki creamos artículos personalizados con tus diseños en los más diversos productos de la siguiente lista.</p>
            <form action="#" id="upload" method="post" enctype="multipart/form-data">
                <select class="select btn btn-raised btn-primary btn-round" id="select-category" name="categoria" required data-style="btn-warning">
                    <option selected disabled>Selecciona una categoría</option>
                    <?=$data["lista_categorias"]?>
                </select>
                <div id="plantillas_links">
                    <div class="form-group">
                        <a href="#" class="btn btn-default btn-raised btn-round" id="download_plantilla"><i class="material-icons">file_download</i>PLANTILLAS E INSTRUCCIONES</a>
                    </div>
                </div>
                <div class="form-group">
                    <button id="category-submit" type="submit" class="btn btn-primary btn-raised btn-md" disabled>Siguiente <i class="fa fa-chevron-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
