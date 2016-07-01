<div class="container">
    <div class="row inner aligncenter">
        <h2 class="subhead">SUBE TUS DISEÑOS</h2>
        <p>En ÁreaFriki creamos artículos personalizados con tus diseños en los más diversos productos de la siguiente lista.</p>
        <form action="#" id="upload" method="post" enctype="multipart/form-data">
            <div class="aligncenter">
                <div class="form-group">
                    <h4>SELECCIONA LA CATEGORÍA</h4>
                    <select class="form-control selectpicker" id="select-category" name="categoria" required data-style="btn-warning" data-width="300px">
                        <option selected disabled>Selecciona una categoría</option>
                        <?=$data["lista_categorias"]?>
                    </select>
                </div>
                <div id="plantillas_links">
                    <div class="form-group">
                        <a href="#" class="btn btn-warning btn-raised" id="download_plantilla"><i class="material-icons">file_download</i>PLANTILLAS E INSTRUCCIONES</a>
                    </div>
                </div>
                <div class="form-group">
                    <button id="category-submit" type="submit" class="btn btn-primary btn-raised btn-md" disabled>Siguiente <i class="fa fa-chevron-right"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
