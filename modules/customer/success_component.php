<?php

namespace rentalcar\modules\customer;
require '../common/common_utility.php';

use rentalcar\modules\common\common_utility;

//session_start();
define("BLOCK_DIRECT_ACCESS", true);

class success_component extends common_utility
{
    function __construct()
    {
//        if (!isset($_SESSION['customer'])) {
//            echo "your are not valid user kindly login first";
//            $this->redirect_url("../auth/customer_login.php");
//            die();
//        }
        include './success_view.php';
    }

    public function load($view, $data): void
    {
        $view($data);
    }

    public function get_booking_vehicle($last_booking_nums): array
    {
        //call api by
        $curl = curl_init();
        $res = [];
        curl_setopt_array($curl, array(
            CURLOPT_PORT => "80",
            CURLOPT_URL => "http://localhost:80/rentalcar/api/customer/current_booking_api.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t \"last_books_nums\": \"$last_booking_nums\"\n}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 1929524f-d121-30ec-2667-6d6483d5fd51"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $res = json_decode($response);
//            $this->msg_console($res);
        }
        return $res;
    }
}

if (isset($_GET['booking_nums'])) {
    $comp = new success_component();
    $receive_data = $comp->get_booking_vehicle($_GET['booking_nums']);
    $comp->load("view", $receive_data);
} else {
    echo "Response are not Received !";
}

