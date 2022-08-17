<?php
if (!defined('BLOCK_DIRECT_ACCESS')) {
    echo "DIRECT ACCESS IS NOT ALLOWED";
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
        <title>BOOKING VIEW</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
              integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>
    <body>
<!--    HEADER-->
<?php include '../../modules/common/navbar.php'?>
    <div class="container">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product Image</th>
                <th scope="col">Vehicle Model</th>
                <th scope="col">Vehicle Number</th>
                <th scope="col">Booking Date</th>
                <th scope="col">Booking Amount</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
             foreach ($data as $key=>$element){
            ?>
            <tr>
                <th scope="row"><?= $key+1?></th>
                <td><img src="../../upload/<?= $element->filename?>" alt="" style="width: 100px"></td>
                <td class="font-weight-bold"><?= strtoupper($element->vehicle_model)?></td>
                <td class="font-weight-bold"><?= strtoupper($element->vehicle_number)?></td>
                <td><?= $element->booking_date?></td>
                <td><?= $element->billing_amount?></td>
                <td><span class="badge badge-success">BOOKED</span></td>
                <td>action</td>

            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
    <!--Bootstrap js library-->
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
<?php } ?>
