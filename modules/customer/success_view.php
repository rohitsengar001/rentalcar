<?php
if (!defined("BLOCK_DIRECT_ACCESS")) {
    die("Direct Access Not Allowed");
}
function view($data): void
{
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
              integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
              crossorigin="anonymous">
        <title>Document</title>
    </head>
    <body>
    <?php include './navbar.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col text-center" id="imgRoot">
                <img src="../../resources/img/success.gif" alt="" class="img-fluid ">
            </div>
        </div>

        <div id="cardRow">
            <a type="button" class="btn btn-primary btn-lg btn-block sticky-top" href="./customer_component.php">Back to Shop</a>
            <?php
            foreach ($data as $element) {
                ?>
                <!--        CARD ROW-->
                <div class="row">
                    <div class="card mb-3 mx-auto text-center shadow-lg rounded-lg" style="max-width: 720px;">
                        <span class="badge badge-pill badge-success">BOOKED</span>
                        <h4>Billing Date :<?= $element->date ?></h4>
                        <div class="col">
                            <div class="card-body text-dark">
                                <img src="../../upload/<?= $element->filename ?>" class="img-thumbnail" alt="...">
                                <ul class="list-group">
                                    <li class="list-group-item">Model Number <span
                                                class="p-3 font-weight-bold"><?= strtoupper($element->vehicle_number) ?></span>
                                    </li>
                                    <li class="list-group-item">Seating capacity : <span
                                                class="p-3 font-weight-bold"><?= strtoupper($element->seating_capacity) ?></span>
                                    </li>
                                    <li class="list-group-item">Rent Per Day :<span
                                                class="p-3 font-weight-bold"><?= strtoupper($element->rent_per_day) ?></span>
                                    </li>
                                    <li class="list-group-item">Customer id :<span
                                                class="p-3 font-weight-bold"><?= $element->customer_id ?></span>
                                    </li>
                                    <li class="list-group-item">Booking Date : <span
                                                class="p-3 font-weight-bold"><?= strtoupper($element->booking_date) ?></span>
                                    </li>
                                    <li class="list-group-item">Agency Email : <span
                                                class="p-3 font-weight-bold"><?= ($element->username) ?></span>
                                    </li>
                                    <li class="list-group-item">Billing Amount : <span
                                                class="p-3 font-weight-bold"><?= strtoupper($element->billing_amount) ?></span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--        CARD ROW END-->
            <?php } ?>
        </div>

    </div>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
            crossorigin="anonymous"></script>

    </body>
    </html>
    <script>
        let imgDiv = document.getElementById('imgRoot');
        let card = document.getElementById("cardRow");
        console.log("card=>", card);
        card.style.display = 'none';
        (function () {
            setTimeout(() => {
                imgDiv.style.display = 'none';
                card.style.display = 'block';
            }, 3000)
        })();

    </script>
<?php } ?>
