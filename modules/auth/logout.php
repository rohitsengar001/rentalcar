<?php

session_start();
echo "dashboard logout....";
unset($_SESSION["username"]);
header("Refresh: 5;url= ./login-component");
