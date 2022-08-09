<?php

namespace rentalcar\api\agency;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Method,Access-Control-Allow-Origin');

//INCLUDES DEPENDENCIES
include_once '../common/DbConnection.php';

use Exception;
use rentalcar\api\common\DbConnection;

interface get_api
{

    /**
     * @param $token
     * @return array
     */
    public function get_all_cars($token): array;

    /**
     * @param $token
     * @param $id
     * @return mixed
     */
    public function get_car_id($token, $id);
}

/**
 *
 */
class getcars_api implements get_api
{
    private $conn;

    /**
     * @param $conn
     */
    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function get_all_cars($token): array
    {
        $return_data = [];
        $sql = "SELECT  vehicle_model, vehicle_number, seating_capacity, image_destination,filename,rent_per_day,vehicle_id FROM post_cars WHERE username = '{$token}' ";
        try {
            $res = $this->conn->query($sql);
        } catch (Exception $e) {
            die("Error" . $e);
        }
        if($res->num_rows>0)
            $return_data=$res->fetch_all(MYSQLI_NUM);
        else
            $return_data=$this->msg(1,200,"No Data Found");
        return $return_data;
    }

    public function msg($success, $status, $message, array $extra = []): array
    {
        return array_merge(["success" => $success, "status" => $status, "message" => $message], $extra);
    }

    public function get_car_id($token, $id)
    {
        // TODO: Implement get_car_id() method.
    }
}

$comp = new getcars_api();
$receive_data = json_decode(file_get_contents("php://input"));
//echo $receive_data->token;

//PASS TOKEN TO get_all_cars METHOD AS USERNAME
echo json_encode($comp->get_all_cars($receive_data->token));


