<?php

namespace rentalcar\api\agency;
include_once '../common/api_utility.php';
require_once '../common/DbConnection.php';

use api\common\api_utility;
use rentalcar\api\common\DbConnection;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Method,Access-Control-Allow-Origin');
class delete_api extends api_utility
{
    private $username;
    private $vehicle_id;
    private $conn;

    public function __construct($username, $vehicle_id)
    {
        $this->username = $username;
        $this->vehicle_id = $vehicle_id;
        $this->conn = DbConnection::connect();
    }

    public function delete_data_api(): array
    {
        $return_data = [];
        if(!isset($this->username) || !isset($this->vehicle_id) || empty(trim($this->username)) || empty(trim($this->vehicle_id))){
            $return_data = $this->msg(0,404,"All Fields are mandatory");
        }else{
            $sql = 'DELETE FROM rental_car.post_cars WHERE vehicle_id=? AND username=?';
            $res = $this->conn->prepare($sql);
            $res->bind_param('ss',$this->vehicle_id,$this->username);
            if($res->execute()){
                $return_data = $this->msg(1,200,"SUCCESSFULLY DELETED!");
            }else{
                $return_data =$this->msg(0,404,"SOMETHING WRONG WITH DATABASE");
            }
        }
        return $return_data;
    }

}

$receive_data = json_decode(file_get_contents("php://input"));
$comp = new delete_api($receive_data->username, $receive_data->vehicle_id);
echo json_encode($comp->delete_data_api());
//echo json_encode(["username"=>$receive_data->username,"vehicle_id"=>$receive_data->vehicle_id]);