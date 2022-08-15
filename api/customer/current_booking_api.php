<?php

namespace rentalcar\api\customer;
include_once '../common/api_utility.php';
require_once '../common/DbConnection.php';
use api\common\api_utility;
use rentalcar\api\common\DbConnection;

// SET OF HEADERS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Method,Access-Control-Allow-Origin');

class _current_bookingApi extends api_utility
{
    private $last_books_nums;
    private $conn;

    /**
     * @param $last_books_nums
     */
    public function __construct($last_books_nums)
    {
        $this->last_books_nums = $last_books_nums;
        $this->conn = DbConnection::connect();
    }

    public function get_booking(): array
    {
        $return_data = [];

        if($_SERVER['REQUEST_METHOD']!=='POST'){
            $return_data = $this->msg(0,404,"REQUEST TYPE SHOULD BE POST");
        }
        elseif (!isset($this->last_books_nums)
            || empty(trim($this->last_books_nums))
        ) {
            $extra = ["last_books_nums"=>"PROVIDE HERE NUMBER OF BOOKING"];
            return $return_data =$this->msg(0,404,"LAST BOOKING NUMBER IS NOT AVAILABLE!",$extra);
        }else{
            $query = $this->conn->prepare("SELECT * FROM post_cars p INNER JOIN booking b on p.vehicle_id=b.vehicle_id ORDER BY b.booking_id desc LIMIT ?");
            $query->bind_param("s",$this->last_books_nums);

            //IF QUERY IS EXECUTE OTHERWISE RETURN INTERNAL ERROR
            if($query->execute()){
                $res=$query->get_result();
                //IF ANY RECORD RETURN THEN
                if($res->num_rows > 0){
                    $return_data = $res->fetch_all();
                }else{
                    $return_data = $this->msg(0,200,"DATA NOT FOUND!");
                }
            }else{
                $return_data = $this->msg(0,500,"DATABASE INTERNAL ERROR");
                
            }
        }
        return $return_data;
    }

}
$receive_data = json_decode(file_get_contents("php://input"));
$comp = new _current_bookingApi($receive_data->last_books_nums);
echo json_encode($comp->get_booking());