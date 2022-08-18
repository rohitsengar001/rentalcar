<?php
if (!defined('BLOCK_DIRECT_ACCESS')) {
    header("Location: ../../../notfound.php");
    die();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>login</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="./login.css" rel="stylesheet">
</head>
<body class="text-center">

<main class="form-signin w-100 mx-auto ">
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert-div">

        </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >

        <!--    <form>-->

        <img class="mt-5"
             src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToC1dXoZ2nq61L01uJ1MKUG-IvTqxjVFd-Mg&usqp=CAU"
             alt="" width="100" height="80">
        <h1 class="h2 mb-3 fw-normal">Please sign in</h1>
        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="userType"
                name="user_type">
            <option selected>Select User</option>
            <option value="agency">Agency</option>
            <option value="customer">Customer</option>
        </select>
        <div id="user-feedback" class="invalid-feedback">
            invalid
        </div>
        <div class="form-floating">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                   required autocomplete="off">
            <label for="floatingInput">Email address</label>
            <small id="email-feedback" class="form-text text-danger invalid-feedback">
            </small>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                   required autocomplete="off">
            <label for="floatingPassword">Password</label>
            <small id="password-feedback" class="form-text text-danger invalid-feedback">
            </small>

        </div>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="signin" id="signin">Sign in</button>
        <div class="m-2" >
<!--            <a class="btn btn-outline-primary" href="./register/customer_register.php" id="regBtn">Registration</a>-->
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Registration
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./register/register_component.php">Agency Registration</a></li>
                    <li><a class="dropdown-item" href="./register/customer_registration_component.php">Customer Registration</a></li>
                </ul>
            </div>
            <label for="regBtn"><span class="badge text-bg-success">Register Yourself</span>To Access
                Application</label><br>
        </div>
        <!--    </form>-->
    </form>
</main>
<script src="./login-component.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
</body>
</html>
