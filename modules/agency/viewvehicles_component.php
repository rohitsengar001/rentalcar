<?php

namespace rental\modules\agency;
include_once '../common/common_utility.php';

use rentalcar\modules\common\common_utility;

session_start();
define("BLOCK_DIRECT_ACCESS", true);

class viewvehicles_component extends common_utility
{
    private $token;
    private $data;

    public function __construct()
    {
        if (isset($_SESSION['username'])) {
            $this->token = $_SESSION['username'];
            $this->setData();
        } else {
            echo "you're not valid user for view-vehicles";
            $this->redirect_url('http://localhost/rentalcar/modules/auth/login-component');
        }
    }

    /**
     * @return mixed
     */
    public function getData(): array
    {
        return $this->data;
    }


    public function setData(): void
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "80",
            CURLOPT_URL => "http://localhost/rentalcar/api/agency/getvehicles_api.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"token\":\"$this->token\"\n}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 81936017-a102-b4b0-db48-c268d0515588"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
//            echo $response;
            $res = json_decode($response);
            $this->data = $res;
            $this->msg_console($response);
        }
    }
}

$comp = new viewvehicles_component();

//RETURN ARRAY OF VEHICLES DATA
$receive_data = $comp->getData();
?>


<!--VIEW-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VIEW CARS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
<div class="container-fluid">
    <?php include_once '../common/navbar.php' ?>
</div>
<!--    CONTENT-->
<div class="container">
    <div class="row row-cols-1 row-cols-md-2">
        <!--        CARD START-->
        <?php
         $index=0;
         foreach ($receive_data as $data){
        ?>
        <div class="col mb-4">
            <div class="card">
                <img src="../../upload/<?= $data[4] ?>" style="max-height: 150px" alt="...">
                <div class="card-body text-center">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Vehicle Modal : <?= $data[0]?></li>
                        <li class="list-group-item">Vehicle Number :<?= $data[1]?></li>
                        <li class="list-group-item">Seating Capacity:<?= $data[2]?></li>
                        <li class="list-group-item">Seating Capacity:<?= $data[3]?></li>
                    </ul>
                    <a href="#" class="card-link btn btn-primary"><i class="bi bi-pencil-square btn btn-primary"
                                                                     data-toggle="modal"
                                                                     data-target="#editModal-<?= $index?>"></i> </a>
                    <a href="#" class="card-link btn btn-primary"><i class="bi bi-trash-fill btn btn-danger"></i></a>
                </div>
            </div>
            <!--            EDIT MODAL-->
            <div class="modal fade" id="editModal-<?= $index?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post"
                                  enctype="multipart/form-data"
                                  class="was-validated">

                                <div class="form-group">
                                    <label for="vehicleModal" class="col-form-label">Vehicle Modal</label>
                                    <input type="text" class="form-control text-uppercase" id="vehicleModal"
                                           name="vehicle-modal" required minlength="3" maxlength="40" value="<?= $data[0]?>">
                                    <div class="invalid-feedback">
                                        please write Correct Model Name
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="vehicleNumber" class="col-form-label">Vehicle Number</label>
                                    <input type="text" class="form-control text-uppercase" id="vehicleNumber"
                                           name="vehicle-number" required minlength="7" maxlength="8" value="<?= $data[1]?>"></input>
                                    <div class="invalid-feedback">
                                        Required Min Length:7 , Max:8
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rentPerDay" class="col-form-label">Rent Per Day</label>
                                    <input type="number" class="form-control" id="rentPerDay" name="rent-per-day"
                                           required
                                           min="100" value="<?= $data[2]?>"></input>
                                    <div class="invalid-feedback">
                                        required!
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="seatingCapacity">Seating Capacity</label>
                                    </div>

                                    <select class="custom-select" id="seatingCapacity" name="seating-capacity" required>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="6">Five</option>
                                        <option value="7">Six</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Required!
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button"
                                                id="inputGroupFileAddon03"
                                                data-toggle="tooltip" data-placement="top"
                                                title="jpeg,jpg and png format only">
                                            Upload Vehicle Image <i class="bi bi-info-circle-fill"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="carImage"
                                               aria-describedby="inputGroupFileAddon03" name="car-image" required value="<?= $data[0]?>">
                                        <label class="custom-file-label" for="inputGroupFile03" >Choose file</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!--                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                    <button class="btn btn-primary" name="post-btn">UPDATE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--            EDIT MODAL END-->
        </div>
        <!--        CARD-END-->
        <?php $index++;}?>
    </div>
</div>
<!--    CONTENT END-->

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

