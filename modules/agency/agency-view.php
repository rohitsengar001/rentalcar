<?php
 if(!defined('BLOCK_DIRECT_ACCESS')){
     header("Location: ../../../notfound");
 }
?>
  <!doctype html>
      <html lang="en">
  <head>
  <meta charset="UTF-8">
               <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                           <meta http-equiv="X-UA-Compatible" content="ie=edge">
               <title>agency_dashboard</title>
      <!-- CSS only -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  </head>
  <body>
  <!-- JavaScript Bundle with Popper -->
  <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Welcome dashboard!</h4>
      <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
      <hr>
      <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
  </div>

      <a href="./../auth/logout.php" class="btn btn-danger">Logout</a>


  </body>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
     <script src="agency.js"></script>
  </html>
