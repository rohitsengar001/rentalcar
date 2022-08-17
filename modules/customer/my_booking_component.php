<?php

namespace rentalcar\modules\customer;
include_once '../common/common_utility.php';
use rentalcar\modules\common\common_utility;
session_start();
define('BLOCK_DIRECT_ACCESS',true);
class my_booking_component extends common_utility
{
    private $booking_data;

    /**
     * @param $booking_data
     */
    public function __construct()
    {
        if (!isset($_SESSION['customer'])) {
            echo "your are not valid user kindly login first";
            $this->redirect_url("../auth/customer_login.php");
            die();
        }
        include './my_booking.php';
        $this->set_data();
    }

    private function set_data():void{
        $return_data =null;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "80",
            CURLOPT_URL => "http://localhost:80/rentalcar/api/customer/mybooking_api.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"customer_id\":\"test@gmail.com\"\n}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: ff0e15ec-f59e-fca4-056a-ca5e84085194"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            die("Data is not Receive kindly contact to admin!");
        } else {
            $this->booking_data = json_decode($response);
            $this->msg_console($response);
//            print_r ($this->booking_data);

        }
    }

    public function view():void
    {
        load($this->booking_data);
    }
}
//INSTANTIATE TO THE COMPONENT
$comp = new my_booking_component();

//LOAD VIEW
$comp->view();


