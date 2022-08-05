<?php
 if(!defined('BLOCK_DIRECT_ACCESS')){
     header("Location: location.href='../../../notfound.php");
     die();
 }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="./register.css">
    <title>Agency Registration</title>
</head>
<body>
<!--   NAVBAR-CONTAINER-->
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #b7d02d;">
            <!-- Navbar content -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Navbar</a>

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
                </form>
            </div>
        </nav>
    </div>
<!--NAVBAR-CONTAINER END-->

<div class="container">
    <!--JUMBOTRON-CONTAINER-->
    <div class=" bg-dark text-light text-center">
            <h1 class="display-5">Agency Registration Form</h1>
            <p class="lead">Kindly Fill All Necessary Fields(<span class="text-danger">*</span>)</p>
    </div>
    <!--JUMBOTRON-CONTAINER-END-->
<!--    ALERT-DIV-->
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-div" style="display: none" >

    </div>
<!-- ALERT DIV END   -->
    <form class="shadow p-3 mb-3 bg-white rounded" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email<sup class="text-danger">*</sup></label>
                <input type="email" class="form-control" id="email" name="email" required>
            <small id="email-feedback" class="form-text text-danger invalid-feedback">
            </small>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password<sup class="text-danger">*</label>
                <input type="password" class="form-control" id="password" name="password" required>
            <small id="password-feedback" class="form-text text-danger invalid-feedback">
            </small>
            </div>
        </div>
        <div class="form-group">
            <label  for="preference">Preference <sup class="text-danger">*</label>
            <input type="text" class="form-control" name="preference" id="preference" value="Agency" disabled>
        </div>
        <div class="form-group">
            <label for="phone">phone<sup class="text-danger">*</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="1234 Main St" required>
            <small id="phone-feedback" class="form-text text-danger invalid-feedback">
            </small>
        </div>
        <div class="form-group">
            <label for="address1">Address 1<sup class="text-danger">*</label>
            <input type="text" class="form-control" name="address1" id="address1" placeholder="1234 Main St" required>
        </div>
        <div class="form-group">
            <label for="address2">Address 2</label>
            <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment, studio, or floor">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city">
            </div>
            <div class="form-group col-md-4">
                <label for="state">State</label>
                <input type="text" name="state" id="state" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="country">Country</label>
                <input type="text" name="country" id="country" class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" name="zipcode">
            </div>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" >
                <label class="form-check-label" for="gridCheck">
                    Check me out
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="registerBtn" name="register-btn" disabled>Register</button>
    </form>
</div>
<script src="./register.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>
