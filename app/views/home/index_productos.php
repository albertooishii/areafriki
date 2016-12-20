<?=$data["cta-vender"]?>
<div class="container">
    <header>
        <h2 class="aligncenter title"><?=$data["subhead"]?></h2>
    </header>
    <div id="last-productos">
        <div class="row">
            <div class="col-sm-3 col-md-3 nomobile">
                <div class="lista_categorias">
                    <header>
                        <h4 class="title">
                            <i class="material-icons">label</i> Categorias:
                        </h4>
                    </header>
                    <p class="category">ROPA Y COMPLEMENTOS</p>
                    <ul>
                        <li><a href='<?=PAGE_DOMAIN?>/camisetas'>Camisetas</a></li>
                        <li><a href='<?=PAGE_DOMAIN?>/sudaderas'>Sudaderas</a></li>
                        <li><a href='<?=PAGE_DOMAIN?>/chapas'>Chapas</a></li>
                    </ul>

                    <p class="category">DECORACIÓN</p>
                    <ul>
                        <li><a href='<?=PAGE_DOMAIN?>/tazas'>Tazas</a></li>

                        <li><a href='<?=PAGE_DOMAIN?>/vinilos'>Vinilos</a></li>
                        <li><a href='<?=PAGE_DOMAIN?>/lienzos'>Lienzos</a></li>
                        <li><a href='<?=PAGE_DOMAIN?>/stickers'>Stickers</a></li>
                        <li><a href='<?=PAGE_DOMAIN?>/posters'>Pósters</a></li>
                    </ul>

                    <p class="category">VENTA</p>
                    <ul>
                        <li><a href='<?=PAGE_DOMAIN?>/crafts'>Hecho a mano</a></li>
                        <li><a href='<?=PAGE_DOMAIN?>/baul'>Nuevo y usado</a></li>
                    </ul>
                </div>
                <div class="lista_etiquetas">
                    <header class="inner">
                        <h4 class="title">
                            <i class="material-icons">local_offer</i> Etiquetas:
                        </h4>
                    </header>
                    <?=$data["tag_list"]?>
                </div>
            </div>
            <div class="col-sm-9 col-md-9">
                <div class="order aligncentermobile">
                    <p><i class="material-icons">sort</i> Ordenar por:</p>
                    <select class="form-control" id="select-order" data-url="<?=$data["sourcepage"]?>">
                        <option value="date" <?php if($data["order"]=='date')echo "selected";?>>
                            Más recientes
                        </option>
                        <option value="sales" <?php if($data["order"]=='sales')echo "selected";?>>
                            Más vendidos
                        </option>
                        <option value="likes" <?php if($data["order"]=='likes')echo "selected";?>>
                            Más likes
                        </option>
                    </select>
                </div>
                <?=$data["last_uploads"]?>
            </div>
        </div>
        <div class="row">
            <?=$data["pagination"]?>
        </div>
    </div>
</div>
