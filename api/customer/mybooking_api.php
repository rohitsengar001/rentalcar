<?php

namespace rentalcar\api\customer;
require_once '../common/api_utility.php';
require_once '../common/DbConnection.php';
include_once '../common/headers.php';
use api\common\api_utility;
use rentalcar\api\common\DbConnection;

class mybooking_api extends api_utility
{
    private $customer_id;
    private $conn;

    /**
     * @param $customer_name
     */
    public function __construct($customer_name)
    {
        $this->customer_id = $customer_name;
        $this->conn = DbConnection::connect();
    }

    public function mybooking():array{
        $return_data=[];
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            $return_data = $this->msg(0,404,'REQUEST TYPE SHOULD BE POST TYPE!');
        }elseif(!isset($this->customer_id )|| empty(trim($this->customer_id))){
            $return_data = $this->msg(0,404,'KINDLY PROVIDE THE CUSTOMER ID!');
        }elseif(!$this->is_user_exist($this->conn,'auth_customer',$this->customer_id)){
            $return_data = $this->msg(0,404,'INVALID CUSTOMER!');
        }else{
            $query = $this->conn->prepare("SELECT * FROM post_cars p INNER JOIN booking b on p.vehicle_id = b.vehicle_id where customer_id=? ");
            $query->bind_param('s',$this->customer_id);
            if($query->execute()){
                $return_data = $query->get_result()->fetch_all(MYSQLI_ASSOC);
            }else{
                $return_data = $this->msg(0,500,'DATABASE INTERNAL ERROR!');
            }
        }
        return $return_data;
    }
}
$receive_data = json_decode(file_get_contents('php://input'));
$comp = new mybooking_api($receive_data->customer_id);
echo json_encode($comp->mybooking());