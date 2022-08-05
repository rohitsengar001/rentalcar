<?php

session_start();
echo "dashboard logout....";
unset($_SESSION["username"]);
header("Refresh: 1;url= ./login-component");
