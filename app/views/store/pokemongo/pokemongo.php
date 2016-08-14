<style>
    main{
        overflow: visible;
    }

    #pokemongo-store{
        background-color: #002456;
        background-image: url(<?=PAGE_DOMAIN?>/app/views/store/pokemongo/pokegostore.jpg);
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    h2, h3, h4, p{
        color: white !important;
    }

    #pokemongo-store img{
        width: 100%;
    }

    #pokemongo-store .card .content{
        padding-top: 80px;
        padding-bottom: 80px;
        visibility: hidden;
    }

    #pokemongo-store .card:hover .content{
        visibility: visible;
    }

    #pokemongo-store .card-background:after{
        visibility: hidden;
    }

    #pokemongo-store .card-background:hover:after{
        visibility: visible;
    }

    #pokemongo-store input{
        background: white !important;
        padding: 25px;
        font-size: 18px;
    }

    .card-price{
        font-weight: 700;
        font-family: "Roboto Slab", "Times New Roman", serif;
    }

    label{
        color: white !important;
    }
</style>
<div id="pokemongo-store">
    <div class="container wrapper">
        <div class="text-center">
            <a href="" class="btn btn-round btn-facebook">POKéMON GO</a>
        </div>

        <div class="tab-content tab-space">
            <div class="tab-pane active" id="pill1">
                <h2 class="text-center inner title">Camisetas gaming pokémon go</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-background" style="background-image: url('<?=PAGE_DOMAIN?>/designs/areafriki/AFPKGOCV/store/thumb-AFPKGOCV.jpg')">
                            <a href="#camiseta" data-toggle="tab" aria-expanded="false" data-token="AFPKGOCV" data-id="106" class="camiseta-selector">
                                <div class="content">
                                    <h3 class="card-title">Camiseta Team Valor</h3>
                                    <h3 class="card-price">19,90€</h3>
                                    <p class="card-description">
                                        Haz que brille la llama que hay en tu interior con esta camiseta del equipo rojo.
                                    </p>
                                    <span class="btn btn-round btn-google">Comprar</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-background" style="background-image: url('<?=PAGE_DOMAIN?>/designs/areafriki/AFPKGOCI/store/thumb-AFPKGOCI.jpg')">
                            <a href="#camiseta" data-toggle="tab" aria-expanded="false" data-token="AFPKGOCI" data-id="107" class="camiseta-selector">
                                <div class="content">
                                    <h3 class="card-title">Camiseta Team Instinct</h3>
                                    <h3 class="card-price">19,90€</h3>
                                    <p class="card-description">
                                        Para los que confían en su instinto y talento innato.
                                    </p>
                                    <span class="btn btn-round btn-warning">Comprar</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-background" style="background-image: url('<?=PAGE_DOMAIN?>/designs/areafriki/AFPKGOCM/store/thumb-AFPKGOCM.jpg')">
                            <a href="#camiseta" data-toggle="tab" aria-expanded="false" data-token="AFPKGOCM" data-id="108" class="camiseta-selector">
                                <div class="content">
                                    <h3 class="card-title">Camiseta Team Mystic</h3>
                                    <h3 class="card-price">19,90€</h3>
                                    <p class="card-description">
                                        Que tus enemigos terminen congelados bajo la fria ventisca de Articuno.
                                    </p>
                                    <span class="btn btn-round btn-info">Comprar</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <h2 class="text-center inner title">Tazas pokémon go</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-background" style="background-image: url('<?=PAGE_DOMAIN?>/designs/areafriki/AFPKGOTV/store/thumb-AFPKGOTV.jpg')">
                            <a href="#taza" data-toggle="tab" aria-expanded="false" data-token="AFPKGOTV" data-id="110" class="taza-selector">
                                <div class="content">
                                    <h3 class="card-title">Taza Team Valor</h3>
                                    <h3 class="card-price">9,90€</h3>
                                    <p class="card-description">
                                        Tómate un café bien calentito gracias a las llamas del espíritu de Moltres.
                                    </p>
                                    <span class="btn btn-round btn-google">Comprar</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-background" style="background-image: url('<?=PAGE_DOMAIN?>/designs/areafriki/AFPKGOTI/store/thumb-AFPKGOTI.jpg')">
                            <a href="#taza" data-toggle="tab" aria-expanded="false" data-token="AFPKGOTI" data-id="111" class="taza-selector">
                                <div class="content">
                                    <h3 class="card-title">Taza Team Instinct</h3>
                                    <h3 class="card-price">9,90€</h3>
                                    <p class="card-description">
                                        Perfecta para pasar las tormetas de verano con tu bebida favorita.
                                    </p>
                                    <span class="btn btn-round btn-warning">Comprar</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-background" style="background-image: url('<?=PAGE_DOMAIN?>/designs/areafriki/AFPKGOTM/store/thumb-AFPKGOTM.jpg')">
                            <a href="#taza" data-toggle="tab" aria-expanded="false" data-token="AFPKGOTM" data-id="112" class="taza-selector">
                                <div class="content">
                                    <h3 class="card-title">Taza Team Mystic</h3>
                                    <h3 class="card-price">9,90€</h3>
                                    <p class="card-description">
                                        Ideal para tomarte tu refrescarte este verano gracias al esprítu de Articuno.
                                    </p>
                                    <span class="btn btn-round btn-info">Comprar</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane product_file" id="camiseta" data-id="">
                <h2 class="text-center inner title">Camisetas gaming pokémon go</h2>
                <div class="col-md-6">
                    <img src="">
                </div>
                <div class="col-md-6">
                    <h3 class="title" id="title"></h3>
                    <p class="description" id="description"></p>
                    <h2 class="title">19,90€</h2>
                    <h4 class="title">Configura tu camiseta</h4>
                    <form action="#" method="post">
                        <div class="form-group diagonal-input">
                            <input type="text" class="form-control" placeholder="Nombre de entrenador" id="nota" name="nombre">
                        </div>
                        <div class="form-group diagonal-input">
                            <label>Indica la talla</label>
                            <select class="form-control" id="size" name="size" required>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                            </select>
                        </div>
                        <div class="form-group label-floating diagonal-input">
                            <label>Indica la cantidad</label>
                            <input id="cantidad" type="number" min="1" value="1" name="cantidad" class="form-control" placeholder="Indica la cantidad">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-round add-cart"><i class="material-icons">add_shopping_cart</i> Comprar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane product_file" id="taza" data-id="">
                <div class="col-md-6">
                    <img src="">
                </div>
                <div class="col-md-6">
                    <h3 class="title" id="title"></h3>
                    <p class="description" id="description"></p>
                    <h2 class="title">9,90€</h2>
                    <h4 class="title">Configura tu taza</h4>
                    <form action="#" method="post">
                        <div class="form-group label-floating diagonal-input">
                            <label>Indica la cantidad</label>
                            <input id="cantidad" type="number" min="1" name="cantidad" class="form-control" value="1" placeholder="Indica la cantidad">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-round add-cart"><i class="material-icons">add_shopping_cart</i> Comprar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        $(".camiseta-selector").click(function(){
            var token=$(this).data("token");
            $("#camiseta img").attr("src", "<?=PAGE_DOMAIN?>/designs/areafriki/"+token+"/store/thumb-"+token+".jpg");
            $("#camiseta #title").text($(this).find(".card-title").text());
            $("#camiseta #description").text($(this).find(".card-description").text());
            $("#camiseta").attr("data-id", $(this).data("id"));
        });

        $(".taza-selector").click(function(){
            var token=$(this).data("token");
            $("#taza img").attr("src", "<?=PAGE_DOMAIN?>/designs/areafriki/"+token+"/store/thumb-"+token+".jpg");
            $("#taza #title").text($(this).find(".card-title").text());
            $("#taza #description").text($(this).find(".card-description").text());
            $("#taza").attr("data-id",$(this).data("id"));
        });
    });

</script>
