<?php

namespace api\common;

use mysqli;

class api_utility
{
    /**
     * @param $success
     * @param $status
     * @param $message
     * @param array $extra
     * @return array
     */
    protected function msg($success, $status, $message, array $extra = []): array
    {
        return array_merge(["success" => $success, "status" => $status, "message" => $message], $extra);
    }

    /**
     * @param $file_name
     * @return bool
     */
    protected function filter_file($file_name): bool
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
    protected function filter_token($token): bool
    {
        return $token = 'valid-user';
    }
    /**
     * ## CHECK THE EMAIL FORMAT
     * @param $email
     * @return bool
     */
    protected function filter_email($email): bool
    {
        return !!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email);
    }


    /**
     * @param $conn mysqli
     * @param $table_name
     * @param $email
     * @return bool
     */
    protected function is_user_exist(mysqli $conn,String $table_name, String $username): bool
    {
        $sql ="SELECT password FROM auth_customer WHERE username=?";
        $query=$conn->prepare($sql);
        $query->bind_param("s",$username);
        $query->execute();
        $res =$query->get_result();
        if ($res->num_rows > 0) {
            return true;
        }
        return false;
    }

    protected function is_agency_user_exist(mysqli $conn, String $username): bool
    {
        $sql ="SELECT password FROM auth_table WHERE username=?";
        $query=$conn->prepare($sql);
        $query->bind_param("s",$username);
        $query->execute();
        $res =$query->get_result();
        if ($res->num_rows > 0) {
            return true;
        }
        return false;
    }

    /**
     * @param mysqli $conn
     * @param String $vehicle_id
     * @return bool
     */
    protected function is_vehicle_exist(mysqli $conn, String $vehicle_id): bool
    {
        $sql ="SELECT vehicle_number FROM post_cars WHERE vehicle_id=?";
        $query=$conn->prepare($sql);
        $query->bind_param("s",$vehicle_id);
        $query->execute();
        $res =$query->get_result();
        if ($res->num_rows > 0) {
            return true;
        }
        return false;
    }

    /**
     * @param $password
     * @return bool
     */
    protected function filter_pass($password): bool
    {
        return !!preg_match_all("$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$", $password);
    }

    public function flatten_array($demo_array): array{
        if (!is_array($demo_array)) {
            // make sure the input is an array
            return array($demo_array);
        }

        $new_array = array();
        foreach ($demo_array as $value) {
            $new_array = array_merge($new_array, $this->flatten_array($value));
        }

        return $new_array;
    }

}