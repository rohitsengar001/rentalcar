<?php

namespace rentalcar\api\customer;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Method,Access-Control-Allow-Origin');
require_once '../common/DbConnection.php';
require '../common/api_utility.php';

use api\common\api_utility;
use rentalcar\api\common\DbConnection;

class customer_registration_api extends api_utility
{
    private $username;
    private $password;
    private $user_type;
    private $conn;
    private $token;

    /**
     * @param $username
     * @param $password
     * @param $user_type
     */
    public function __construct($username, $password, $user_type)
    {
        $this->username = $username;
        $this->password = $password;
        $this->user_type = $user_type;
        $this->token = "valid-user";
        $this->conn = DbConnection::connect();
    }

    //TO VALIDATE THE CUSTOMER USER
    public function validate_user(): array
    {
        $return_data = [];
        if (!isset($this->username)
            || !isset($this->password)
            || !isset($this->user_type)
            || empty(trim($this->username))
            || empty(trim($this->password))
            || empty(trim($this->user_type))
        ) {
            $fields = ["username", "password", "user_type"];
            $return_data = $this->msg(0, 404, "PLEASE FILL THE ALL MANDATORY FILLED!", $fields);
        } elseif (!$this->filter_email($this->username)) {
            //CHECK EMAIL ID'S FORMAT
            $return_data = $this->msg(0, 404, "USERNAME FORMAT IS NOT CORRECT!");
        } elseif (!$this->filter_pass($this->password)) {
            $return_data = $this->msg(0, 404, "PASSWORD FORMAT IS NOT CORRECT!");
        } else {
            //VALIDATE USER THAT USERNAME ALREADY EXIST OR NOT
            if ($this->is_user_exist($this->conn, "auth_customer", $this->username)) {
                $return_data = $this->msg(0, 200, "USERNAME ALREADY EXIST!");
            } else {
                //USERNAME NOT EXIST THEN REGISTER CURRENT USER
                $query = $this->conn->prepare("INSERT INTO auth_customer(username, password, user_type, token) VALUES(?,?,?,?)");
                $query->bind_param("ssss", $this->username, $this->password, $this->user_type, $this->token);

                //QUERY EXECUTED SUCCESSFULLY
                if ($query->execute()) {
                    $return_data = $this->msg(1, 200, "SUCCESSFULLY REGISTERED!");
                } else {
                    $return_data = $this->msg(0, 500, "Some Error Occurs In Query");
                }
            }
        }
        return $return_data;
    }

}

$receive_data = json_decode(file_get_contents("php://input"));
$api = new customer_registration_api($receive_data->username, $receive_data->password, $receive_data->user_type);
echo json_encode($api->validate_user());
