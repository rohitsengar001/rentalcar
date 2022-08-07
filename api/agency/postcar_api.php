<?php

namespace rentalcar\api\agency;
include '../common/DbConnection.php';

use Exception;
use mysqli_sql_exception;
use rentalcar\api\common\DbConnection;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Method,Access-Control-Allow-Origin');
session_start();

class postcar_api
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
    private $conn;

    /**
     * @param $username
     * @param $vehicle_model
     * @param $vehicle_number
     * @param $seating_capacity
     * @param $rent_per_day
     * @param $temp_file_name
     * @param $image_destination
     * @param $filename
     * @param $token
     */
    public function __construct($username, $vehicle_model, $vehicle_number, $seating_capacity, $rent_per_day, $temp_file_name, $image_destination, $filename, $token)
    {
        $this->username = $username;
        $this->vehicle_model = $vehicle_model;
        $this->vehicle_number = $vehicle_number;
        $this->seating_capacity = $seating_capacity;
        $this->rent_per_day = $rent_per_day;
        $this->temp_file_name = $temp_file_name;
        $this->image_destination = $image_destination;
        $this->filename = $filename;
        $this->token = $token;
        $this->conn = DbConnection::connect();
    }


    /**
     * @return array
     */
    function post_data(): array
    {
        $return_data = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $return_data = $this->msg(0, 404, 'PAGE NOT FOUND!');
        } elseif (!isset($this->vehicle_model)
            || (!isset($this->vehicle_number))
            || (!isset($this->seating_capacity))
            || (!isset($this->rent_per_day))
            || (!isset($this->temp_file_name))
            || (!isset($this->image_destination))
            || (empty(trim($this->vehicle_model)))
            || (empty(trim($this->vehicle_number)))
            || (empty(trim($this->rent_per_day)))
            || (empty(trim($this->seating_capacity)))
            || (empty(trim($this->temp_file_name)))
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
            $query = $this->conn->prepare('INSERT INTO post_cars(username, vehicle_model, vehicle_number, seating_capacity,filename, image_destination, token) VALUE(?,?,?,?,?,?,?)');
            $query->bind_param("sssssss", $this->username, $this->vehicle_model, $this->vehicle_number, $this->seating_capacity,$this->filename, $this->image_destination, $this->token);
                if ($query->execute()) {
                    $return_data = $this->msg(1, 200, "YOUR POST SUCCESSFULLY SAVED!");
                }else{
                    $return_data =$this->msg(0,404,"DUPLICATE VEHICLE NUMBER!");
                }
            }catch (Exception $e){
                $return_data = $this->msg(0,404,$e);
            }
        }
        return $return_data;
    }

    /**
     * @param $success
     * @param $status
     * @param $message
     * @param array $extra
     * @return array
     */
    public function msg($success, $status, $message, array $extra = []): array
    {
        return array_merge(["success" => $success, "status" => $status, "message" => $message], $extra);
    }

    /**
     * @param $file_name
     * @return bool
     */
    private function filter_file($file_name): bool
    {
        $file_stored = ['jpg', 'png', 'jpeg'];
        $split_file = explode('.', $file_name);
        $check_extension = strtolower(end($split_file));
        if (in_array($check_extension, $file_stored))
            return true;
        return false;
    }

    /**
     * @param $token
     * @return bool
     */
    private function filter_token($token): bool
    {
        return $token = 'valid-user';
    }
}

// receive data from the user
$receive_data = json_decode(file_get_contents("php://input"));

//instantiate to the object
$postcar_api = new postcar_api($receive_data->username, $receive_data->vehicle_model, $receive_data->vehicle_number,
    $receive_data->seating_capacity, $receive_data->rent_per_day, $receive_data->temp_file_name, $receive_data->image_destination, $receive_data->file_name, $receive_data->token);

echo json_encode($postcar_api->post_data());
//echo json_encode($receive_data);