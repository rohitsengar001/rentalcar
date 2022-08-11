<?php

namespace rentalcar\modules\auth\register;
include '../../common/common_utility.php';
use rentalcar\modules\common\common_utility;

define("BLOCK_DIRECT_ACCESS",true);
class customer_registration_component extends common_utility
{
    function __construct(){
        include ('./customer_registration_view.php');
    }

    function register_customer($username,$password,$user_type){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_PORT => "80",
            CURLOPT_URL => "http://localhost:80/rentalcar/api/customer/customer_registration_api.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"username\":\"$username\",\n\t\"password\":\"$password\",\n\t\"user_type\":\"$user_type\"\n}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: b96ffda7-c0d2-dda2-9784-02cffc1b7c9c"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $res =json_decode($response);
            $this->msg_console($res->message);
            if($res->success)
                $this->alert_box_success($res->message);
            else
                $this->alert_box_danger($res->message);
            $this->redirect_url("http://localhost:63342/rentalcar/modules/auth/customer_login.php");

        }
    }

}
$comp = new customer_registration_component();
if(isset($_POST['register-btn'])){
    $username = $_POST['email'];
    $password = $_POST['password'];
    $user_type ="customer";
    $comp->register_customer($username,$password,$user_type);
}