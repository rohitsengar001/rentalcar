<?php

namespace rentalcar\modules\customer;
include '../common/common_utility.php';
require_once '../../api/common/DbConnection.php';

use rentalcar\api\common\DbConnection;
use rentalcar\modules\common\common_utility;

session_start();
define("BLOCK_DIRECT_ACCESS", true);

interface my_booking
{
    public function book($vehicle_id);
}

class booking_component extends common_utility
{
    private $conn;
    private $data;

    function __construct()
    {
        if (!isset($_SESSION['customer'])) {
            echo "your are not valid user kindly login first";
            $this->redirect_url("../auth/customer_login.php");
            die();
        }
        $this->conn = DbConnection::connect();
        if (isset($_GET['vehicleid'])) {
            $this->set_data($_GET['vehicleid']);
        } else {
            echo "vehicleid is not available";
            die();
        }

    }

    private function set_data($id)
    {
        $sql = "Select vehicle_model , vehicle_number, seating_capacity,filename,rent_per_day,vehicle_id FROM post_cars WHERE vehicle_id=?";
        $query = $this->conn->prepare($sql);
        $query->bind_param("s", $id);
        if ($query->execute()) {
//        echo json_encode($query->get_result()->fetch_assoc());

            //SET DATA
            $this->data = $query->get_result()->fetch_assoc();
        } else {
            $this->alert_box_danger("ERROR IN DATABASE SERVER");
        }
    }

    public function get_booked_dates($vehicle_id)
    {
        $return_data = [];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "80",
            CURLOPT_URL => "http://localhost:80/rentalcar/api/customer/booking_dates_api.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"vehicle_id\":\"$vehicle_id\"\n}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: b50e16dd-08f7-06da-1e44-aaaa5055a033"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //DOES NOT REQUIRE TO CONVERT IN JSON_DECODE
            // BECAUSE IT'S RESULT DIRECTLY ACCEPTABLE INTO JS ARRAY OBJECT
            $return_data = $response;
        }
        return $return_data;
    }

    public function get_data()
    {
        return $this->data;
    }

    public function load_view(): void
    {
        include './booking_view.php';
    }
}

if (!isset($_GET['vehicleid'])) {
  echo 'you can not direct access this page';
  header("Location: ../
  auth/customer_login");
  die();
}
    $comp = new booking_component();
    $comp->load_view();
    $receive_data = $comp->get_data();
    $receive_dates = $comp->get_booked_dates($_GET['vehicleid']);

//FUNCTION DEFINITION IN  `booking_view.php`
//LOADING CARD
    load($receive_data, $receive_dates);

//echo $receive_data['vehicle_model'] ?? "data not available";
