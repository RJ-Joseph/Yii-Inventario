<?php

/** @var yii\web\View $this */

$this->title = 'Inventario';
$this->registerCss("
    body {
        background-image: url('https://wallpapers.com/images/hd/playstation-4k-rfzvatc0skdekp1v.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: fixed;
    }
");
?>
<div class="jumbotron text-center bg-transparent mt-5 mb-5" style="color: white;">
    <h1 class="display-4">BIENVENIDO</h1>
    <p><a class="btn btn-lg btn-success" href="https://youtube.com/@benchrj?si=aToATbJpX3-nsM8A" target="_blank">Rendimiento Real Sin Excusas.</a></p>
</div>

<!-- Carrusel centrado -->
<div class="container d-flex justify-content-center mb-5">
    <div id="carouselExampleIndicators" class="carousel slide w-75" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
                aria-label="Slide 5"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5"
                aria-label="Slide 6"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://www.hd-tecnologia.com/imagenes/articulos/2021/09/El-trailer-debut-de-God-of-War-Ragnarok-ofrece-un-combate-brutal-con-Thor-como-Villano-7.jpg" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="https://cdn1.epicgames.com/offer/6b0541b5d9aa476cbf407643ab3b1d7d/EGS_TheCallistoProtocolSeasonPass_StrikingDistanceStudios_SeasonPass_G1A_00_1920x1080-d120e92e8b6f90e38e2586e3ed55ef65" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="https://i.redd.it/bunch-of-screenshots-of-ghost-of-yotei-v0-o1jw8jvaauqd1.png?width=1920&format=png&auto=webp&s=6cb13f3a8fb751608bb15b920d2a366203b16b28" class="d-block w-100" alt="Slide 3">
            </div>
            <div class="carousel-item">
                <img src="https://cdn1.epicgames.com/57dfd95548214a138218e56cd9e5b9d8/offer/EGS_Back4Blood_TurtleRockStudios_S1-2560x1440-c50bb45e4f6f4805a26914e28491c15a.jpg" class="d-block w-100" alt="Slide 4">
            </div>
            <div class="carousel-item">
                <img src="https://image.api.playstation.com/vulcan/ap/rnd/202305/3116/b1641ab1b5ec0c8f76c44e59e9d8a1639c913c98c09d057f.jpg" class="d-block w-100" alt="Slide 5">
            </div>
            <div class="carousel-item">
                <img src="https://i.blogs.es/2e090b/the-last-of-us-part-ii-remastered-analisis/1366_2000.jpeg" class="d-block w-100" alt="Slide 6">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="container">
    <div class="row d-flex align-items-stretch">
        <?php foreach ($videojuegos as $videojuego): ?>
            <div class="col-md-4 mb-4 d-flex">
                <div class="card w-100 h-100 d-flex flex-column">
                    <img src="<?= Yii::getAlias('@web') ?>/portadas/<?= $videojuego->portada ?>" class="card-img-top" alt="<?= $videojuego->nombre ?>">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title"><?= $videojuego->nombre ?></h5>
                        <p class="card-text">
                            <strong>Fecha de lanzamiento:</strong> <?= $videojuego->fechalanzamiento ?>
                        </p>
                        <p class="card-text">
                            <strong>Director:</strong>
                            <?= $videojuego->directorIddirector ? $videojuego->directorIddirector->nombre . ' ' . $videojuego->directorIddirector->apellido : 'No disponible' ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



</div>