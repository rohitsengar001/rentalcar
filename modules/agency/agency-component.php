<?php

namespace rental\modules\agency;
session_start();
define("BLOCK_DIRECT_ACCESS", true);

class agency_component
{
    function __construct()
    {
        if (isset($_SESSION['username'])) {
//            echo "session:".$_SESSION['username'];
            include './agency-view.php';
        } else {

            echo "you're not valid user";
            header("Refresh: 5;url= http://localhost/rentalcar/modules/auth/login-component");
        }
    }

    /**
     * ## SUPPORT EXTENSION: ['jpg', 'png', 'jpeg']
     * @param $file_name
     * @return bool
     */
    public function filter_file($file_name): bool
    {
        $file_stored = ['jpg', 'png', 'jpeg'];
        $split_file = explode('.', $file_name);
        $check_extension = strtolower(end($split_file));
        if (in_array($check_extension, $file_stored))
            return true;
        return false;
    }


    /**
     * @param $data
     * @return void
     */
    public function post_data_api($data)
    {

        $curl = curl_init();
        $post_data = json_encode($data);
        curl_setopt_array($curl, array(
            CURLOPT_PORT => "80",
            CURLOPT_URL => "http://localhost:80/rentalcar/api/agency/postcar_api.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 316128d9-4dea-4235-2daa-d8639a550644"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //JSON TO PHP OBJECT
            $res = json_decode($response);
            echo "<script>console.log('.$res->message.')</script>";
            echo "<script>console.log('post-btn clicked')</script>";
            $this->alert_message($res);
        }
    }

    public function alert_message($data)
    {
        if (!$data->success) {
            echo '
        <script>
            let alertDiv = document.getElementById("alert-div");
            let child_alert_div=`<strong>"' . $data->message . '"</strong> You should check in on some of those fields below.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeAlertDiv()">
                                        <span aria-hidden="true">&times;</span>
                                         </button>`;
                    alertDiv.innerHTML=child_alert_div;
                    alertDiv.style.display = "block";
           
        </script>
        ';

        }
        echo "<script>
            setTimeout(()=>{
                window.location = 'http://localhost/rentalcar/modules/agency/agency-component.php';
             },1000)
            </script>";
    }

    public function msg_console($msg)
    {
        echo "<script>console.log('.$msg.')</script>";
    }
}

//INSTANTIATING THE OBJECT
$agency_component = new agency_component();

//GET PARAMETERS FROM THE VIEW
//WHILE USER CLICK ON SUBMIT BUTTON
if (isset($_POST['post-btn'])) {
    if (!empty($_POST['vehicle-modal']) && !empty($_POST['vehicle-number']) && !empty($_POST['seating-capacity'])
        && !empty($_POST['rent-per-day']) && !empty($_FILES['car-image'])
    ) {
        // GET VALUE OF FORMS FIELDS
        $vehicle_model = $_POST['vehicle-modal'];
        $vehicle_number = $_POST['vehicle-number'];
        $seating_capacity = $_POST['seating-capacity'];
        $rent_per_day = $_POST['rent-per-day'];
        $file = $_FILES['car-image'];
        $file_name = $file['name'];
        $temp_file_name = $file['tmp_name'];
        $file_error = $file['error'];
        $username = $_SESSION['username'];
        $token = "valid-user";
        $image_destination = 'C:/xampp/htdocs/rentalcar/upload/' . $file_name;

        //SET PAYLOAD FOR CALL POST API
        $payload = array(
            "username" => $username,
            "vehicle_model" => $vehicle_model,
            "vehicle_number" => $vehicle_number,
            "seating_capacity" => $seating_capacity,
            "rent_per_day" => $rent_per_day,
            "file_name" => $file_name,
            "temp_file_name" => $temp_file_name,
            "image_destination" => $image_destination,
            "token" => $token
        );
//        print_r($payload);
        //VALIDATE FILE EXTENSION
        if ($agency_component->filter_file($file_name)) {
            move_uploaded_file($temp_file_name, $image_destination);
//            echo "move_upload_file : success";
            $agency_component->post_data_api($payload);
        }
    } else {
        echo "Request Failed";
    }
}




