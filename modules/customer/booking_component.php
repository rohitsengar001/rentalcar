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


    public function get_data()
    {
        return $this->data;
    }

    function load_view(): void
    {
        include './booking_view.php';
    }
}

$comp = new booking_component();
$comp->load_view();
$receive_data = $comp->get_data();

//FUNCTION DEFINITION IN  `booking_view.php`
//LOADING CARD
load($receive_data);

//echo $receive_data['vehicle_model'] ?? "data not available";
