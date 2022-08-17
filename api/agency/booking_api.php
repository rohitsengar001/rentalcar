<?php

namespace rentalcar\api\agency;
require_once '../common/DbConnection.php';
require_once '../common/api_utility.php';
require_once '../common/headers.php';
use api\common\api_utility;
use rentalcar\api\common\DbConnection;


class booking_api extends api_utility
{
    private $username;
    private $conn;

    /**
     * @param $username
     */
    public function __construct($username)
    {
        $this->username = $username;
        $this->conn = DbConnection::connect();
    }

    public function get_data(): array
    {
        $return_data = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $return_data = $this->msg(0, 404, "REQUEST METHOD SHOULD BE POST TYPE!");
        } elseif (!isset($this->username) || empty(trim($this->username))) {
            $return_data = $this->msg(0, 404, 'USERNAME IS EMPTY!');
        } elseif (!$this->is_user_exist($this->conn, 'post_cars', $this->username)) {
            $return_data = $this->msg(0, 404, 'USER IS NOT EXIST!');
        } else {
            $query = $this->conn->prepare("SELECT * FROM post_cars p INNER JOIN booking b on p.vehicle_id = b.vehicle_id where username=?");
            $query->bind_param("s", $this->username);

            if ($query->execute()) {
                $return_data = $query->get_result()->fetch_all(MYSQLI_ASSOC);
            } else {
                $return_data = $this->msg(0, 500, "DATABASE INTERNAL ERROR!");
            }
        }
        return $return_data;
    }
}
$receive_data = json_decode(file_get_contents('php://input'));
$comp = new booking_api($receive_data->username);
echo json_encode($comp->get_data());

