<?php

namespace rentalcar\modules\auth;
include_once "../common/common_utility.php";
require_once '../../api/common/DbConnection.php';

use mysqli_sql_exception;
use rentalcar\api\common\DbConnection;
use rentalcar\modules\common\common_utility;

define("BLOCK_DIRECT_ACCESS", true);

session_start();
class customer_login extends common_utility
{
    private $conn;

    function __construct()
    {
        //INITIALIZATION OF CONNECTION OBJECT
        $this->conn = DbConnection::connect();

        // SESSION IS AVAILABLE
        if (isset($_SESSION['customer'])) {
            header("Location: ../../modules/customer/customer_component.php");
            exit();
        }
        include "./login-view.php";
    }


    //CALL SIGNING API

    /**
     * @return void
     */
    public function signin($username, $password): void
    {
        $sql = "Select password FROM auth_customer WHERE username='{$username}'";
        try {
            $res = $this->conn->query($sql);
            if ($res->num_rows > 0) {
                if ($password == $res->fetch_assoc()['password']) {
                    $_SESSION['customer'] = $username;
                    $this->redirect_url("./customer_login.php");
                } else {
                    echo '<div class="alert alert-danger" role="alert">
                            You are not Valid User
                          </div>';
                }
            }else {
                echo '<div class="alert alert-danger text-center top-50" role="alert">
                            <i class="bi bi-exclamation-octagon-fill"></i>User does not exist!
                       </div>';
            }
        } catch (mysqli_sql_exception $e) {
            echo "Exception handling Required" . $e;
        }
    }

}

$comp = new customer_login();
if(isset($_POST['signin'])){
    $username = $_POST['email'];
    $password =$_POST['password'];
    if($_POST['user_type'] != "customer"){
        $comp->alert_box_danger("USER TYPE IS NOT SELECTED AS A CUSTOMER!");
    }else{
    $comp->signin($username,$password);
    }
}