<?php
if (!defined('DIRECT_BLOCK_ACCESS')) {
    die("Page not Found");
}
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Rent Car</title>
        <!--    BOOTSTRAP CDN-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
              integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>
<body>
    <div class="">
        <!--    NAVBAR-->
        <?php
         include './navbar.php';
        ?>
        <!--    NAVBAR END-->
    </div>
<div class="container-xl">
    <div class="media">
        <img src="https://rentsyst.com/assets/46faa286/img/svg/top-carsharing-img.svg" class="mr-3" alt="...">
        <div class="media-body">
            <h5 class="mt-0">Media heading</h5>
            <p>Will you do the same for me? It's time to face the music I'm no longer your muse. Heard it's beautiful,
                be the judge and my girls gonna take a vote. I can feel a phoenix inside of me. Heaven is jealous of our
                love, angels are crying from up above. Yeah, you take me to utopia.</p>
        </div>
    </div>
    <hr>
    <!--    CARD-->
    <div class="row row-cols-1 row-cols-md-2">
<?php
function load($vehicles_data): void
{
foreach ($vehicles_data as $row) {
    ?>
    <div class="col mb-4">
        <div class="card">
            <img src="../../upload/<?= $row[5]?>" class="card-img-top" alt="..." style="height: 280px">
            <div class="card-body">

            </div>
            <ul class="list-group list-group-flush border-dark ">
                <li class="list-group-item">Vehicle Number : <span class="p-3 font-weight-bold"><?= strtoupper($row[1])?></span></li>
                <li class="list-group-item">Vehicle Model :<span class="p-3 font-weight-bold"><?= strtoupper($row[2])?></span></li>
                <li class="list-group-item">Vehicle Seating Capacity :<span class="p-3 font-weight-bold"><?= $row[3]?></span></li>
                <li class="list-group-item">Rent Per Day:<span class="p-3 font-weight-bold"><?= $row[4]?></span></li>
            </ul>
            <div class="card-body">
                <a href="./booking_component.php?vehicleid=<?= $row[0]?>" class="card-link btn btn-primary">Rent Now</a>
            </div>
        </div>
    </div>
<?php } ?>
    </div>
    <!--    CARD ENDS-->
    </div>
    <!--JAVASCRIPT BOOTSTRAP CDN-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
            integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
            crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
}

?>