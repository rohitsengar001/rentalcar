<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>logout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>

<div class="spinner-grow text-primary" role="status">
    <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-secondary" role="status">
    <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-success" role="status">
    <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-danger" role="status">
    <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-warning" role="status">
    <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-info" role="status">
    <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-light" role="status">
    <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-dark" role="status">
    <span class="sr-only">Loading...</span>
</div>
</body>
</html>

<?php
session_start();
echo "dashboard logout....";
unset($_SESSION["customer"]);
header("Refresh: 1;url= ../../modules/customer/customer_component.php");
