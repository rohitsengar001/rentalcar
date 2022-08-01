<?php

namespace rentalcar\api\auth;
//define("BLOCK_DIRECT_ACCESS",false);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Method,Access-Control-Allow-Origin');
include '../../api/common/DbConnection.php';

use Exception;
use mysqli_sql_exception;
use rentalcar\api\common\DbConnection;


interface validate_agency
{
    /**
     * # Return Format
     * 😊😊this method for validating the agency user
     * [
     *'success' => 1,
     *'status' => 200,
     *'message' => 'You have successfully logged in.',
     *'token' => $email
     *]
     *
     *
     * @return  array
     *
     * @var $username
     * @var $password
     */

    public function validate_user(): array;

    /**
     * Bind the message in single array
     * @param $success
     * @param $status
     * @param $message
     * @param array $extra
     * @return array
     */
    public function msg($success, $status, $message, array $extra = []): array;
}

class agency_user implements validate_agency
{
    private $email;
    private $password;
    private $conn;

    function __construct($username, $password)
    {
        $this->email = $username;
        $this->password = $password;
        $this->conn = DbConnection::connect();
    }

    /**
     * @return array
     */
    public function validate_user(): array
    {
        $return_data = [];

        // IF REQUEST METHOD IS NOT EQUAL TO POST
        if ($_SERVER["REQUEST_METHOD"] != "POST")
            $return_data = $this->msg(0, 404, 'Page Not Found!');

        // CHECKING EMPTY FIELDS
        elseif (!isset($this->email)
            || !isset($this->password)
            || empty(trim($this->email))
            || empty(trim($this->password))
        ) {
            $fields = ['fields' => ['email', 'password']];
            $return_data = $this->msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } else {
            //INTRODUCE NEW VARIABLE  `EMAIL` AND `PASSWORD` AFTER TRIM FROM THE STRING
            //SCOPE : LOCAL (CURRENT BLOCK)
            $emailTrim = trim($this->email);
            $passwordTrim = trim($this->password);

            // CHECK EMAIL FORMAT VALID OR NOT
            if (!$this->filter_email($emailTrim))
                $return_data = $this->msg(0, 422, 'Invalid Email Address!');
            elseif (strlen($passwordTrim) < 8)
                $return_data = $this->msg(0, 422, 'Your password must be at least 8 characters long!');

            // THE USER IS ABLE TO PERFORM THE LOGIN ACTION
            // ENSURE THAT IT COULD THROW A EXCEPTION
            // HANDLING THE DATABASE EXCEPTION
            try {
                $backend_data = $this->conn->query("SELECT * FROM auth_table where username= '" . $emailTrim . "'");
                // IF USER FOUNDED BY EMAIL
                if ($backend_data->num_rows > 0) {
                    $row = $backend_data->fetch_assoc();
                    $return_data = $row["password"] == $this->password ? [
                        'success' => 1,
                        'status' => 200,
                        'message' => 'You have successfully logged in.',
                        'token' => $row["username"]
                    ] : [
                        'success' => 0,
                        'status' => 422,
                        'message' => 'Invalid Password.',
                    ];
                }else{
                    $return_data = [
                        'success' => 0,
                        'status' => 422,
                        'message' => 'Invalid Email.',
                    ];
                }
            } catch (Exception $e) {
                $return_data = $this->msg(0, 500, $e->getMessage());
            }
        }
        return $return_data;
    }

    public function msg($success, $status, $message, array $extra = []): array
    {
        return array_merge(["success" => $success, "status" => $status, "message" => $message], $extra);
    }


    /**
     * ## CHECK THE EMAIL FORMAT
     * @param $email
     * @return bool
     */
    private function filter_email($email): bool
    {
        return !!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email);
    }

    /**
     * ## Returns data from database from selected row
     * like : `username` and  `password`
     * @return array
     * @var $return_backend_data `Data Receive from Database`
     */
    private function fetch_backend_data(): array
    {
        $receive_backend_data = $this->conn->query("SELECT * FROM auth_table where username= '" . $_POST[$this->email] . "'");
        return $receive_backend_data->fetch_array();
    }

}

$data = json_decode(file_get_contents("php://input"));
//echo json_encode(["user"=>$data->email,"message"=>"valid user"]);
$agency_user = new agency_user($data->email, $data->password);
echo json_encode($agency_user->validate_user());
//echo json_encode(["status"=>200,"mess"=>"hello"]);