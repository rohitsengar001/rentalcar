<?php

namespace rentalcar\modules\agency;
define('BLOCK_DIRECT_ACCESS',true);
session_start();
class view_booking_component
{
    private $username;
    private $data;

    /**
     * @param $username
     */
    public function __construct($username)
    {
        if(!isset($_SESSION['username'])){
            echo "you're not valid user!";
            header("refresh:2;url=../../modules/auth/login-component.php");
            die();
        }
        $this->username = $username;
        include './view_booking.php';
    }

    public function set_booking_data():void{
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "80",
            CURLOPT_URL => "http://localhost:80/rentalcar/api/agency/booking_api.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"username\":\"$this->username\"\n}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 85c9a959-8f23-6de1-1589-2372e3a9ccb8"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $this->data=json_decode($response);
//            print_r($response);
        }
    }

    public function view(): void
    {
        load($this->data);
    }

}
$comp = new view_booking_component($_SESSION['username']);
$comp->set_booking_data();
$comp->view();
