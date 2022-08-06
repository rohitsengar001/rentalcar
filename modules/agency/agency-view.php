<?php
if (!defined('BLOCK_DIRECT_ACCESS')) {
    header("Location: ../../../notfound");
}
?>
<!doctype html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>agency_dashboard</title>
    <!-- CSS only -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>
<body>
<!-- JavaScript Bundle with Popper -->
<div class="container-fluid">
    <!--      NAVBAR-->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #b7d02d;">
        <!-- Navbar content -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"><span class="text-danger font-weight-bold shadow-sm">CarRental</span></a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="../login-component.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                <a href="./../auth/logout.php" class="btn btn-danger m-2">Logout</a>
            </form>
        </div>
    </nav>
    <!-- NAVBAR END-->
    <div class="alert bg-dark text-light" role="alert">
        <h4 class="alert-heading">Welcome dashboard!</h4>
        <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer
            so that you can see how spacing within an alert works with this kind of content.</p>
        <hr>
        <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
    </div>

</div>
<div class="container">
    <!--    ALERT-DIV-->
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-div" style="display:none " >
        <!--  SHOW ERROR MESSAGE !-->
    </div>
    <!-- ALERT DIV END   -->
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body bg-light shadow-lg">
                    <h5 class="card-title">Post Your Vehicles <i class="bi bi-car-front-fill"></i></h5>
                    <p class="card-text"><span class="badge badge-success">Rent</span> Your Vehicles in just a second
                    </p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#postModal"
                            data-whatever="@fat">Post Vehicles
                    </button>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body bg-light shadow-lg">
                    <h5 class="card-title">Check Your Booking <i class="bi bi-airplane-engines-fill"></i></h5>
                    <p class="card-text">Easily Track your Booking.</p>
                    <a href="#" class="btn btn-primary">Show Booking</a>
                </div>
            </div>
        </div>
    </div>

    <!--   POST-VEHICLES MODAL-->
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">POST YOUR VEHICLES</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" class="was-validated">

                        <div class="form-group">
                            <label for="vehicleModal" class="col-form-label">Vehicle Modal</label>
                            <input type="text" class="form-control text-uppercase" id="vehicleModal" name="vehicle-modal" required minlength="3" maxlength="40" >
                            <div class="invalid-feedback">
                               please write Correct Model Name
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vehicleNumber" class="col-form-label">Vehicle Number</label>
                            <input type="text" class="form-control text-uppercase" id="vehicleNumber" name="vehicle-number" required minlength="7" maxlength="8"></input>
                            <div class="invalid-feedback">
                                Required Min Length:7 , Max:8
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rentPerDay" class="col-form-label">Rent Per Day</label>
                            <input type="number" class="form-control" id="rentPerDay" name="rent-per-day" required min="100" ></input>
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
                                <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon03" data-toggle="tooltip" data-placement="top" title="jpeg,jpg and png format only">
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
                            <button  class="btn btn-primary" name="post-btn">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  POST-VEHICLES  MODAL END-->
</div>


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
<script src="agency.js"></script>
</html>