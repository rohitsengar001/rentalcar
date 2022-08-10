<?php

namespace rentalcar\modules\customer;
include 'C:\xampp\htdocs\rentalcar\modules\common\common_utility.php';
define("DIRECT_BLOCK_ACCESS",true);
use rentalcar\modules\common\common_utility;


class customer_component extends common_utility
{
    private $data;

    public function __construct()
    {
        $this->set_data();
    }


    public function get_data()
    {
        return $this->data;
    }

    public function set_data(): void
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/rentalcar/api/customer/get_api",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 0aeb8d8e-a490-fb68-22ad-f34e26ed299a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $res=json_decode($response);
            $this->data =$res;
        }
    }
    function load_view($data){
        include "./view.php";
        load($data);
    }
}
$custComponent = new customer_component();
$vehicles_data=$custComponent->get_data();
$custComponent->load_view($vehicles_data);

