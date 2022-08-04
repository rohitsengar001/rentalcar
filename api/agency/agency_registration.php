<?php

namespace rentalcar\api\agency;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Method,Access-Control-Allow-Origin');
include '../common/DbConnection.php';

use rentalcar\api\common\DbConnection;

class agency_registration
{
    private $username;
    private $password;
    private $user_type;
    private $mobile_number;
    private $conn;
    private $address1;
    private $address2;
    private $city;
    private $country;
    private $zipcode;

    function __construct($username, $password, $mobile_number, $address1, $address2, $city, $country, $zipcode)
    {
        $this->username = $username;
        $this->password = $password;
        $this->user_type = 'agency';
        $this->mobile_number = $mobile_number;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->city = $city;
        $this->country = $country;
        $this->zipcode = $zipcode;
        $this->conn = DbConnection::connect();

    }


    public function postdata(): array
    {
        $return_data = [];
        // IF REQUEST METHOD IS NOT EQUAL TO POST
        if ($_SERVER["REQUEST_METHOD"] != "POST")
            $return_data = $this->msg(0, 404, 'Page Not Found!');

        //CHECK EMPTY FIELDS
        elseif (!isset($this->username)
            || !isset($this->password)
            || !isset($this->mobile_number)
            || !isset($this->address1)
            || empty(trim($this->username))
            || empty(trim($this->password))
            || empty(trim($this->mobile_number))
            || empty(trim($this->address1))
        ) {
            $fields = ['fields' => ['email', 'password','address1','phone']];
            $return_data = $this->msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } //CHECK VALID FORMAT FOR EMAIL
        elseif (!$this->filter_email(trim($this->username))) {
            $return_data = $this->msg(0, 422, 'Invalid Email Address!');
        } //CHECK VALID FORMAT FOR PASSWORD
        elseif (!$this->filter_pass(trim($this->password))) {
            $return_data = $this->msg(0, 422, 'Invalid Password!');
        } //VALIDATE MOBILE NUMBER
        elseif (!$this->filter_mobile(trim($this->mobile_number))) {
            $return_data = $this->msg(0, 422, 'Invalid Mobile Number!');
        } //EMAIL ALREADY EXIST IN DATABASE
        elseif ($this->is_email_exist()) {
            $return_data = $this->msg(0, 422, 'Email Address Already Registered!');
        } else {
            $query = $this->conn->prepare("INSERT INTO auth_table(username, password, user_type) VALUE(?,?,?)");
            $query->bind_param("sss", $this->username, $this->password, $this->user_type);
            if ($query->execute()) {
                $return_data = $this->msg(1, 200, "successfully Registered");
            } else {
                $return_data = $this->msg(0, 500, "Some Error Occurs");
            }
        }

        return $return_data;
    }

    public function msg($success, $status, $message, array $extra = []): array
    {
        return array_merge(["success" => $success, "status" => $status, "message" => $message], $extra);
    }

    private function filter_email($email): bool
    {
        return !!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email);
    }

    private function filter_pass($password): bool
    {
        return !!preg_match_all("$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$", $password);
    }

    private function filter_mobile($phone)
    {
        return !!preg_match('/^[0-9]{10}+$/', $phone);
    }

    private function is_email_exist(): bool
    {
        $email = $this->username;
        $sql = "SELECT username From auth_table where username='{$email}'";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            return true;
        }
        return false;
    }
}

$data_receive = json_decode(file_get_contents("php://input"));
$agency_registration = new agency_registration($data_receive->username, $data_receive->password,
    $data_receive->mobile_number, $data_receive->address1, $data_receive->address2,
    $data_receive->city, $data_receive->country, $data_receive->zipcode,);

echo json_encode($agency_registration->postdata());


