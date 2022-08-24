<link rel="stylesheet" href="<?php echo BASE_URL;?>/app/assets/libs/css/scroll_v.css">
<main>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-6">
            <div id="caruselVivienda" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php foreach($imagenes as $ind=>$img){
                    $activo = $ind==0 ? "active" : ""; ?>
                <div class="carousel-item <?php echo $activo?>">
                    <img class="d-block w-100" src="../../<?php echo $img['camino']?>" alt="Casa<?php echo $ind?>">
                </div>
                <?php }?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#caruselVivienda" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#caruselVivienda" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
            </div>
            </div>
            <div class="col-6 align-self-start">
                <div class="card-body text-white">
                    <h3 class="card-title"><?php echo $vivienda['precio'] ?> €<small> /mes</small></h3>
                    <p class="card-text"><?php echo $vivienda['provincia']." - ".$vivienda['localidad']." - ".$vivienda['direccion']." Nº: ".$vivienda['numero']?></p>
                    <p class="card-text"><small><?php echo $caracteristicas?></small></p>
                    <p class="card-text scroll" style="overflow: auto; max-height: 300px;"><small><?php echo $vivienda['descripcion']?></small></p>
                    <p class="card-text text-center"><small>Publicada: <?php echo $fechaPublicacion[0]['fechaPublicacion']?></small></p>
                </div>
            </div>
        </div>
    </div> 
</main>