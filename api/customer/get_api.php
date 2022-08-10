<?php

namespace rentalcar\api\customer;
require_once '../common/DbConnection.php';

use Exception;
use rentalcar\api\common\DbConnection;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Method,Access-Control-Allow-Origin');

class get_api
{
    private $vehicles_data;
    private \mysqli $conn;


    public function __construct()
    {
        $this->conn = DbConnection::connect();
        $this->setVehiclesData();
    }

    /**
     * @return mixed
     */
    public function getVehiclesData()
    {
        return $this->vehicles_data;
    }


    public function setVehiclesData(): void
    {

            $res = $this->conn->query("SELECT vehicle_id,vehicle_number,vehicle_model,seating_capacity,rent_per_day,filename FROM post_cars ");
            $this->vehicles_data = $res->fetch_all();
    }

}

$get_api = new get_api();
echo json_encode($get_api->getVehiclesData());
