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
//            $this->msg_console($response);
        }
    }

    //CALL TO UPDATE API
    //$username, $vehicle_model, $vehicle_number, $seating_capacity, $rent_per_day, $temp_file_name, $image_destination, $filename, $token
    public function update_data($data_array)
    {
        $curl = curl_init();
        $post_data = json_encode($data_array);
        curl_setopt_array($curl, array(
            CURLOPT_PORT => "80",
            CURLOPT_URL => "http://localhost:80/rentalcar/api/agency/update_api.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 316128d9-4dea-4235-2daa-d8639a550644"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //JSON TO PHP OBJECT
            $res = json_decode($response);
//            echo "<script>console.log('.$res->message.')</script>";
            echo "<script>console.log('.$response.')</script>";
            echo "<script>console.log('update-btn clicked')</script>";
//            $this->alert_message($res);
        }
    }
}

$comp = new viewvehicles_component();

//RETURN ARRAY OF VEHICLES DATA
$receive_data = $comp->getData();

if (isset($_POST['update-btn'])) {
    if (!empty($_POST['vehicle_modal']) && !empty($_POST['vehicle_number']) && !empty($_POST['rent_per_day']) && !empty($_POST['seating_capacity'])) {

        //VARIABLES FOR NEW FILES
        $file = $_FILES['vehicle_image'];
        $file_name = $file['name'];
        $temp_file_name = $file['tmp_name'];
        $file_error = $file['error'];
        $file_size = $file['size'];
        $file_destination = 'C:/xampp/htdocs/rentalcar/upload/' . $file_name;

        //VARIABLE FOR OLD FILES
        $old_vehicle_number = $_POST['old_vehicle_number'];
        $old_file_image = $_POST['old_vehicle_image'];
        $old_file_destination = 'C:/xampp/htdocs/rentalcar/upload/' . $old_file_image;
        $vehicle_id = $_POST['vehicle_id'];

        //IMAGE FILE UPDATED
        if ($file_size) {
            //UPLOADED UPDATED FILE FIRST
            move_uploaded_file($temp_file_name, $file_destination);
            unlink($old_file_destination);

            //Build PAYLOAD TO SEND THE PUT_DATA API
            $payload = [
                "username" => $_SESSION['username'],
                "vehicle_id" => $vehicle_id,
                "vehicle_model" => $_POST['vehicle_modal'],
                "vehicle_number" => $_POST['vehicle_number'],
                "old_vehicle_number" => $old_vehicle_number,
                "seating_capacity" => $_POST['seating_capacity'],
                "rent_per_day" => $_POST['rent_per_day'],
                "image_destination" => $file_destination,
                "filename" => $file_name,
                "token" => "valid-user"
            ];

        } else {
            // IMAGE FILE NOT UPDATED
            $payload = [
                "username" => $_SESSION['username'],
                "vehicle_id" => $vehicle_id,
                "vehicle_model" => $_POST['vehicle_modal'],
                "vehicle_number" => $_POST['vehicle_number'],
                "old_vehicle_number" => $old_vehicle_number,
                "seating_capacity" => $_POST['seating_capacity'],
                "rent_per_day" => $_POST['rent_per_day'],
                "image_destination" => $old_file_destination,
                "filename" => $old_file_image,
                "token" => "valid-user"
            ];

        }


//        $comp->msg_console(json_encode($payload));
        //$username, $vehicle_model, $vehicle_number, $seating_capacity, $rent_per_day, $image_destination, $filename, $token
        //CALL UPDATE API
        $comp->update_data($payload);

    } else {
        //SHOW ALERT MESSAGE TO THE USER
        echo "Request Failed";
    }
}
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
    <!--    ALERT-DIV-->
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-div" style="display:none ">
        <!--  SHOW ERROR MESSAGE !-->
    </div>
    <!-- ALERT DIV END   -->
    <div class="row row-cols-1 row-cols-md-2">
        <!--        CARD START-->
        <?php
        $index = 0;
        foreach ($receive_data as $data) {
            ?>
            <div class="col mb-4">
                <div class="card">
                    <img src="../../upload/<?= $data[4] ?>" style="max-height: 150px" alt="...">
                    <div class="card-body text-center">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Vehicle Modal : <?= $data[0] ?></li>
                            <li class="list-group-item">Vehicle Number :<?= $data[1] ?></li>
                            <li class="list-group-item">Seating Capacity:<?= $data[2] ?></li>
                            <li class="list-group-item">Rent Per Day:<?= $data[5] ?></li>
                        </ul>
                        <a href="#" class="card-link btn btn-primary"><i class="bi bi-pencil-square btn btn-primary"
                                                                         data-toggle="modal"
                                                                         data-target="#editModal-<?= $index ?>"></i>
                        </a>
                        <a href="#" class="card-link btn btn-primary"><i
                                    class="bi bi-trash-fill btn btn-danger"></i></a>
                    </div>
                </div>
                <!--            EDIT MODAL-->
                <div class="modal fade" id="editModal-<?= $index ?>" tabindex="-1" aria-labelledby="editModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Vehicle Information</h5>
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
                                               name="vehicle_modal" required minlength="3" maxlength="40"
                                               value="<?= $data[0] ?>">
                                        <div class="invalid-feedback">
                                            please write Correct Model Name
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleNumber" class="col-form-label">Vehicle Number</label>
                                        <input type="text" class="form-control text-uppercase" id="vehicleNumber"
                                               name="vehicle_number" required minlength="10" maxlength="10"
                                               value="<?= $data[1] ?>"></input>
                                        <div class="invalid-feedback">
                                            Required Valid 10 alphabet
                                        </div>
                                    </div>
                                    <!-- OLD VEHICLE NUMBER -->
                                    <div class="form-group">
                                        <input type="text" class="form-control text-uppercase" id="oldVehicleNumber"
                                               name="old_vehicle_number" required minlength="10" maxlength="10"
                                               value="<?= $data[1] ?>" hidden></input>
                                        <div class="invalid-feedback">
                                            Required Valid 10 alphabet
                                        </div>
                                    </div>
                                    <!--OLD VECHICLE NUMBER END-->
                                    <div class="form-group">
                                        <label for="rentPerDay" class="col-form-label">Rent Per Day</label>
                                        <input type="number" class="form-control" id="rentPerDay" name="rent_per_day"
                                               required
                                               min="100" value="<?= $data[5] ?>">
                                        <div class="invalid-feedback">
                                            required!
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="seatingCapacity">Seating
                                                Capacity</label>
                                        </div>

                                        <select class="custom-select" id="seatingCapacity" name="seating_capacity">
                                            <option value="1" <?php if ($data[2] == 1) echo "selected"; ?>>One</option>
                                            <option value="2" <?php if ($data[2] == 2) echo "selected"; ?>>Two</option>
                                            <option value="3" <?php if ($data[2] == 3) echo "selected"; ?>>Three
                                            </option>
                                            <option value="4" <?php if ($data[2] == 4) echo "selected"; ?>>Four</option>
                                            <option value="6" <?php if ($data[2] == 6) echo "selected"; ?>>Five</option>
                                            <option value="7" <?php if ($data[2] == 7) echo "selected"; ?>>Six</option>
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
                                                   aria-describedby="inputGroupFileAddon03" name="vehicle_image"
                                                   value="<?= $data[4] ?>" accept=".jpg, .jpeg, .png">
                                            <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                                        </div>
                                    </div>
                                    <!-- FOR SEND OLD IMAGE NAME WHILE UPDATING INFORMATION-->
                                    <!-- IT WILL BE HIDDEN-->
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="oldVehicleImage"
                                               name="old_vehicle_image" value="<?= $data[4] ?>" hidden>
                                        <div class="invalid-feedback">
                                            required!
                                        </div>
                                    </div>
                                    <!-- OLD VEHICLE ID-->
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="vehicleId"
                                               name="vehicle_id" hidden value="<?= $data[6] ?>">
                                        <div class="invalid-feedback">
                                            required!
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <!--                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE
                                        </button>
                                        <button class="btn btn-primary" name="update-btn">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--            EDIT MODAL END-->
            </div>
            <!--        CARD-END-->
            <?php $index++;
        } ?>
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

