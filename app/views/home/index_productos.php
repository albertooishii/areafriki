<?=$data["secondary-navbar"]?>
<div class="container-fluid">
    <div id="last-productos">
        <div class="row">
            <aside class="col-sm-4 col-md-3 col-lg-3 col-xl-3 nomobile">
                <div class="lista_categorias">
                    <header>
                        <h2 class="title">Categorías</h2>
                    </header>
                    <ul class="categories">
                        <li><a href='<?=PAGE_DOMAIN?>/camisetas'>Camisetas</a></li>
                        <li><a href='<?=PAGE_DOMAIN?>/sudaderas'>Sudaderas</a></li>
                        <li><a href='<?=PAGE_DOMAIN?>/chapas'>Chapas</a></li>
                        <li><a href='<?=PAGE_DOMAIN?>/tazas'>Tazas</a></li>
                        <li><a href='<?=PAGE_DOMAIN?>/vinilos'>Vinilos</a></li>
                        <li><a href='<?=PAGE_DOMAIN?>/lienzos'>Lienzos</a></li>
                        <li><a href='<?=PAGE_DOMAIN?>/posters'>Pósters</a></li>
                        <li><a href='<?=PAGE_DOMAIN?>/handmades'>Hecho a mano</a></li>
                        <li><a href='<?=PAGE_DOMAIN?>/secondhand'>Nuevo y usado</a></li>
                    </ul>
                </div>
                <div class="lista_etiquetas">
                    <header class="inner">
                        <h2 class="title">Etiquetas</h2>
                    </header>
                    <?=$data["tag_list"]?>
                </div>
            </aside>
            <div class="index-productos col-sm-8 col-md-9 col-lg-9 col-xl-9">
                <header>
                    <h1 class="title subhead"><?=$data["subhead"]?></h1>
                    <p class="subtitle"><?=$data["subtitle"]?></p>
                </header>
                <div class="order aligncentermobile">
                    <p><i class="material-icons">sort</i> Ordenar por:</p>
                    <select class="form-control" id="select-order" data-url="<?=$data["sourcepage"]?>">
                        <option value="onfire" <?php if($data["order"]=='onfire')echo "selected";?>>
                            On fire
                        </option>
                        <option value="date" <?php if($data["order"]=='date')echo "selected";?>>
                            Más recientes
                        </option>
                        <option value="likes" <?php if($data["order"]=='likes')echo "selected";?>>
                            Más likes
                        </option>
                    </select>
                </div>
                <div class="row">
                <?=$data["last_uploads"]?>
                </div>
            </div>
        </div>
        <div class="row">
            <?=$data["pagination"]?>
        </div>
    </div>
</div>
