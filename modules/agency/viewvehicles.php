<?php
if (!defined("BLOCK_DIRECT_ACCESS")) {
    echo "page not found";
    exit();
}
?>
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
    <!--    CARD-->
    <div class="card m-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="../../resources/images/draw2.svg" alt="..." class="img-thumbnail rounded  ">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
        <!--CARD LIST-->
        <div class="card-header bg-info">
            DETAILS
        </div>
        <ul class="list-group list-group-flush text-center">
            <li class="list-group-item">Car Model :<span class="mx-3">sdkjskjksjd</span></li>
            <li class="list-group-item">Car Number</li>
            <li class="list-group-item">Seating Capacity</li>
            <li class="list-group-item"><i class="bi bi-pencil-square btn btn-primary" data-toggle="modal"
                                           data-target="#editModal"></i> <i
                        class="bi bi-trash-fill btn btn-danger"></i></li>
        </ul>
        <!-- END CARD LIST-->

        <!--        MODAL EDIT-->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data"
                              class="was-validated">

                            <div class="form-group">
                                <label for="vehicleModal" class="col-form-label">Vehicle Modal</label>
                                <input type="text" class="form-control text-uppercase" id="vehicleModal"
                                       name="vehicle-modal" required minlength="3" maxlength="40">
                                <div class="invalid-feedback">
                                    please write Correct Model Name
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="vehicleNumber" class="col-form-label">Vehicle Number</label>
                                <input type="text" class="form-control text-uppercase" id="vehicleNumber"
                                       name="vehicle-number" required minlength="7" maxlength="8"></input>
                                <div class="invalid-feedback">
                                    Required Min Length:7 , Max:8
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rentPerDay" class="col-form-label">Rent Per Day</label>
                                <input type="number" class="form-control" id="rentPerDay" name="rent-per-day" required
                                       min="100"></input>
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
                                    <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon03"
                                            data-toggle="tooltip" data-placement="top"
                                            title="jpeg,jpg and png format only">
                                        Upload Vehicle Image <i class="bi bi-info-circle-fill"></i>
                                    </button>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="carImage"
                                           aria-describedby="inputGroupFileAddon03" name="car-image" required>
                                    <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
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
        <!--        MODAL EDIT END-->
    </div>
    <!--    CARD ENDS-->
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