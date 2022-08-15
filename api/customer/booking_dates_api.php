<?php

namespace rentalcar\api\customer;
require_once '../common/DbConnection.php';
require_once '../common/api_utility.php';
include_once '../common/headers.php';

use api\common\api_utility;
use rentalcar\api\common\DbConnection;

class booking_dates_api extends api_utility
{
  private $vehicle_id;
  private $conn;

    /**
     * @param $vehicle_id
     */
    public function __construct($vehicle_id)
    {
        $this->vehicle_id = $vehicle_id;
        $this->conn = DbConnection::connect();
    }


    public function get_booked_dates():array{
      $return_data  = [];
      if($_SERVER['REQUEST_METHOD'] != 'POST'){
          $return_data = $this->msg(0,404,"REQUEST METHOD SHOULD BE POST");
      }
      elseif(empty(trim($this->vehicle_id))){
          $return_data = $this->msg(0,404,"VEHICLE ID IS EMPTY!");
      }else{
          $query = $this->conn->prepare("SELECT booking_date FROM booking WHERE vehicle_id=?");
          $query->bind_param("s",$this->vehicle_id);
          if($query->execute()){
              $dates = $query->get_result()->fetch_all();
              $return_data = $this->flatten_array($dates);
//              $return_data=$this->msg(1,200,"SUCCESSFULLY GET",$dates);
          }else{
              $return_data = $this->msg(0,500,"DATABASE INTERNAL ERROR");
          }
      }
      return $return_data;
  }
}

$receive_data = json_decode(file_get_contents("php://input"));
$comp = new booking_dates_api($receive_data->vehicle_id);
echo json_encode($comp->get_booked_dates());