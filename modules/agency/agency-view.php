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
<!--    NAVBAR START-->
    <?php include '../common/navbar.php';?>
<div class="container-fluid">
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
                    <a href="./view_booking_component.php" class="btn btn-primary">Show Booking</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-4">
            <div class="card">
                <div class="card-body bg-light shadow-lg">
                    <h5 class="card-title">Check Posted Vehicles <i class="bi bi-eyeglasses "></i></h5>
                    <p class="card-text">Easily Track Your All Posts.</p>
                    <a href="./viewvehicles_component.php" class="btn btn-primary">View Vehicles</a>
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
                            <input type="text" class="form-control text-uppercase" id="vehicleNumber" name="vehicle-number" required minlength="10" maxlength="10"></input>
                            <div class="invalid-feedback">
                                At Least 10 Character is required
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

<div class="container">
    <section style="height:80px;"></section>
    <div class="row" style="text-align:center;">
        <h2>Bootstrap Dark Footer UI</h2>
    </div>
    <!----------- Footer ------------>
    <footer class="footer-bs">
        <div class="row">
            <div class="col-md-3 footer-brand animated fadeInLeft">
                <h2>Logo</h2>
                <p>Suspendisse hendrerit tellus laoreet luctus pharetra. Aliquam porttitor vitae orci nec ultricies. Curabitur vehicula, libero eget faucibus faucibus, purus erat eleifend enim, porta pellentesque ex mi ut sem.</p>
                <p>© 2014 BS3 UI Kit, All rights reserved</p>
            </div>
            <div class="col-md-4 footer-nav animated fadeInUp">
                <h4>Menu —</h4>
                <div class="col-md-6">
                    <ul class="pages">
                        <li><a href="#">Travel</a></li>
                        <li><a href="#">Nature</a></li>
                        <li><a href="#">Explores</a></li>
                        <li><a href="#">Science</a></li>
                        <li><a href="#">Advice</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contacts</a></li>
                        <li><a href="#">Terms & Condition</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 footer-social animated fadeInDown">
                <h4>Follow Us</h4>
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">RSS</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-ns animated fadeInRight">
                <h4>Newsletter</h4>
                <p>A rover wearing a fuzzy suit doesn’t alarm the real penguins</p>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-envelope"></span></button>
                      </span>
                </div><!-- /input-group -->
            </div>
        </div>
    </footer>
    <section style="text-align:center; margin:10px auto;"><p>Designed by <a href="http://enfoplus.net">Rohit Sengar</a></p></section>
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