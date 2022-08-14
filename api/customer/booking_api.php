<?php

namespace rentalcar\api\customer;
require_once '../common/DbConnection.php';
require_once '../common/api_utility.php';

use api\common\api_utility;
use mysqli;
use rentalcar\api\common\DbConnection;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Method,Access-Control-Allow-Origin');

class booking_api extends api_utility
{
    private $vehicle_id;
    private $customer_id;
    private $booking_date;
    private $billing_amount;
    private mysqli $conn;

    /**
     * @param $vehicle_id
     * @param $customer_id
     * @param $booking_date
     * @param $billing_amount
     */
    public function __construct($vehicle_id, $customer_id, $booking_date, $billing_amount)
    {
        $this->vehicle_id = $vehicle_id;
        $this->customer_id = $customer_id;
        $this->booking_date = $booking_date;
        $this->billing_amount = $billing_amount;
        $this->conn = DbConnection::connect();
    }

    public function booked_vehicle(): array
    {
        $return_data = [];

        //CHECK ANY ONE FIELDS HAVE EMPTY AND NULL VALUE
        if ((!isset($this->vehicle_id))
            || (!isset($this->customer_id))
            || (!isset($this->booking_date))
            || (!isset($this->billing_amount))
            || (empty(trim($this->vehicle_id)))
            || (empty(trim($this->customer_id)))
            || (empty(trim($this->booking_date)))
            || (empty(trim($this->billing_amount)))
        ) {
            $fields = ["vehicle_id", "customer_id", "days", "booking_date", "billing_amount"];
            $return_data = $this->msg(0, 404, "KINDLY FILL ALL MANDATORY FIELDS", $fields);
        } // VALIDATION OF CUSTOMER ID
        elseif (!$this->is_user_exist($this->conn, "auth_customer", $this->customer_id)) {
            $return_data = $this->msg(0, 404, "CUSTOMER IS NOT EXIST!");
        } //VALIDATE VEHICLE ID
        elseif (!$this->is_vehicle_exist($this->conn, $this->vehicle_id)) {
            $return_data = $this->msg(0, 404, 'VEHICLE IS NOT EXIST!');
        } else {
            $query = $this->conn->prepare("INSERT INTO booking(customer_id, vehicle_id,booking_date, billing_amount) VALUES(?,?,?,?)");
            $query->bind_param('ssss', $this->customer_id, $this->vehicle_id, $this->booking_date, $this->billing_amount);
            if ($query->execute()) {
                $return_data = $this->msg(1, 200, "VEHICLE SUCCESSFULLY BOOKED!");
            } else {
                $return_data = $this->msg(1, 500, "MYSQL INTERNAL ERROR");
            }
        }
        return $return_data;
    }

}

$receive_data = json_decode(file_get_contents("php://input"));
$res=[];
for ($i = 0; $i < count($receive_data->booking_date); $i++) {
    $comp = new booking_api($receive_data->vehicle_id, $receive_data->customer_id, $receive_data->booking_date[$i], $receive_data->billing_amount);
    $res=$comp->booked_vehicle();
}
$res['days']=$receive_data->days;
    echo json_encode($res);
