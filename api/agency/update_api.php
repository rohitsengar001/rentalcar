<?php

namespace rentalcar\api\agency;
include_once '../common/api_utility.php';
require_once '../common/DbConnection.php';

use api\common\api_utility;
use Exception;
use rentalcar\api\common\DbConnection;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Method,Access-Control-Allow-Origin');


class update_api extends api_utility
{
    private $username;
    private $vehicle_model;
    private $vehicle_number;
    private $seating_capacity;
    private $rent_per_day;
    private $temp_file_name;
    private $image_destination;
    private $filename;
    private $token;
    private $vehicle_id;
    private $old_vehicle_number;
    private $conn;

    /**
     * @param $username
     * @param $vehicle_model
     * @param $vehicle_number
     * @param $seating_capacity
     * @param $rent_per_day
     * @param $image_destination
     * @param $filename
     * @param $token
     */
    public function __construct($username, $vehicle_id, $vehicle_model, $vehicle_number, $old_vehicle_number, $seating_capacity, $rent_per_day, $image_destination, $filename, $token)
    {
        $this->username = $username;
        $this->vehicle_id = $vehicle_id;
        $this->vehicle_model = $vehicle_model;
        $this->vehicle_number = $vehicle_number;
        $this->old_vehicle_number = $old_vehicle_number;
        $this->seating_capacity = $seating_capacity;
        $this->rent_per_day = $rent_per_day;
        $this->image_destination = $image_destination;
        $this->filename = $filename;
        $this->token = $token;
        $this->conn = DbConnection::connect();
    }

    public function put_data(): array
    {
        $return_data = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $return_data = $this->msg(0, 404, 'PAGE NOT FOUND!');
        } elseif (!isset($this->vehicle_model)
            || (!isset($this->vehicle_number))
            || (!isset($this->seating_capacity))
            || (!isset($this->rent_per_day))
            || (!isset($this->image_destination))
            || (empty(trim($this->vehicle_model)))
            || (empty(trim($this->vehicle_number)))
            || (empty(trim($this->rent_per_day)))
            || (empty(trim($this->seating_capacity)))
            || (empty(trim($this->image_destination)))
        ) {
            $fields = ['fields' => [
                'vehicle_model',
                "vehicle_number",
                "seating_capacity",
                "rent_per_day",
                "image_destination"
            ]];
            $return_data = $this->msg(0, 404, 'PLEASE FILL ALL REQUIRED FIELDS', $fields);
        } elseif (!$this->filter_file($this->filename)) {
            $fields = ["jpeg", "png", "jpg"];
            $return_data = $this->msg(0, 404, "FILE EXTENSION IS NOT VALID", $fields);
        } elseif (!$this->filter_token($this->token)) {
            $return_data = $this->msg(0, 404, "YOU'RE NOT VALID USER");
        } else {
            try {

                //WRITE QUERY FOR INSERTING THE RESULT INTO DBMS
                $query = $this->conn->prepare('UPDATE post_cars SET  vehicle_model=?, vehicle_number=?, seating_capacity=?,filename=?,rent_per_day=?, image_destination=?, token=? WHERE vehicle_id=? AND username=?');
                $query->bind_param("sssssssss", $this->vehicle_model, $this->vehicle_number, $this->seating_capacity, $this->filename, $this->rent_per_day, $this->image_destination, $this->token,$this->vehicle_id,$this->username);
                if ($query->execute()) {
                    $return_data = $this->msg(1, 200, "YOUR POST SUCCESSFULLY SAVED!");
                } else {
                    $return_data = $this->msg(0, 404, "DUPLICATE VEHICLE NUMBER!");
                }
            } catch (Exception $e) {
                $return_data = $this->msg(0, 404, $e);
            }
        }
        return $return_data;
    }

}

$receive_data = json_decode(file_get_contents("php://input"));
$api = new update_api($receive_data->username, $receive_data->vehicle_id, $receive_data->vehicle_model, $receive_data->vehicle_number, $receive_data->old_vehicle_number, $receive_data->seating_capacity, $receive_data->rent_per_day, $receive_data->image_destination, $receive_data->filename, $receive_data->token);
echo json_encode($api->put_data());
//echo json_encode($receive_data);