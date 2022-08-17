<?php
if (!defined('BLOCK_DIRECT_ACCESS')) {
    echo "Direct Access is not Allowed";
    header("Refresh:2 ;url=./customer_component.php");
    die();
}
function load($data): void
{

    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>My Booking</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    </head>
    <body>
    <?php
    include './navbar.php';
    ?>
    <div class="container">
        <?php foreach($data

        as $ele) {?>
<!--        CARD START-->
        <div class="card shadow-lg mt-2 ">
            <div class="card-header">
                <span class="font-weight-bold col order-first">Booking ID:<?= md5($ele->booking_id) ?></span>
                <span class="font-weight-bold col mx-5">Booking Date:<?= $ele->booking_date ?></span>
                <span class=" float-right font-weight-bold order-last ">Invoice:</span>
            </div>
            <div class="card-body row">
                <div class="col-md-2">
                    <img src="../../upload/<?= $ele->filename?>" alt="" class="card-img">
                </div>

                <div class="col-md-6">
                    <h5 class="card-title"><?= strtoupper($ele->vehicle_model) ?></h5>
                    <p class="card-text p-2"><span class="badge badge-pill badge-primary">Seating Capacity:<?= $ele->seating_capacity?></span> <span class="badge badge-pill badge-primary">Amount<?= $ele->billing_amount?></span></p>
                    <div class="btn  btn-warning"><i class="bi bi-arrow-counterclockwise p-1"></i>Rent it again</div>
                </div>
                <div class="col-md-4">
                    <div class="btn btn-sm btn-outline-secondary border-3 border-dark shadow-lg col-md-12">Track Order
                    </div>
                    <br>
                    <div class="btn btn-sm  border-3 border-dark  shadow-lg mt-4 col-md-12 btn-outline-secondary">Leave
                        Feedback To Seller
                    </div>
                    <br>
                    <div class="btn btn-sm  border-3 border-dark  shadow-lg mt-1 col-md-12 btn-outline-secondary">Leave
                        Delivery Feedback
                    </div>
                    <br>
                    <div class="btn btn-sm  border-3 border-dark  shadow-lg mt-1 col-md-12 btn-outline-secondary">Write
                        A Product Review
                    </div>
                    <br>
                </div>
            </div>
            <div class="card-footer"><a href="#"><i class="bi bi-box-arrow-right m-1"></i>Archive order</a></div>
        </div>
<!--        CARD END-->
        <?php }?>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    </body>
    </html>
<?php } ?>