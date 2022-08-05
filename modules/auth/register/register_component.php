<?php
//REGISTER-COMPONENT
namespace rentalcar\modules\auth\register;
define("BLOCK_DIRECT_ACCESS", true);

class register_component
{
    function __construct()
    {
        include './register_view.php';
    }

    public function postData($email, $password, $phone, $address1, $address2, $city, $state, $country, $zipcode)
    {


        $curl = curl_init();


        curl_setopt_array($curl, array(
            CURLOPT_PORT => "80",
            CURLOPT_URL => "http://localhost:80/rentalcar/api/agency/agency_registration.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"username\":\"$email\",\n\t\"password\":\"$password\",\n\t\"mobile_number\":\"$phone\",\n\t\"address1\":\"$address1\",\n\t\"address2\":\"$address2\",\n\t\"city\":\"$city\",\n\t\"state\":\"$state\",\n\t\"zipcode\":\"$zipcode\",\n\t\"country\":\"$country\"\n}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: b253abaa-d85b-cc23-ad40-781ffdb83c12"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $res = json_decode($response, true);
            echo "<script>console.log('" . $res['success'] . "')</script>";
            //VALID USERNAME
            if ($res["success"]) {
                echo '<script>
                    let child_alert_div=`<strong>Register</strong> You should check in on some of those fields below.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeAlertDiv()">
                                        <span aria-hidden="true">&times;</span>
                                         </button>`;
                    alertDiv.innerHTML=child_alert_div;
                    alertDiv.style.display = "block";
                </script>';
            } else {
                echo '<script>
                    let child_alert_div=`<strong>"' . $res["message"] . '"</strong> You should check in on some of those fields below.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeAlertDiv()">
                                        <span aria-hidden="true">&times;</span>
                                         </button>`;
                    alertDiv.innerHTML=child_alert_div;
                    alertDiv.style.display = "block";
                    setTimeout(()=>{
                    alertDiv.style.display = "none";
                        
                    },5000)
                </script>';
            }
        }
    }
}

$comp = new register_component();
if (isset($_POST['register-btn'])) {
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['phone']) && !empty($_POST['address1'])) {
        $comp->postData($_POST['email'], $_POST['password'], $_POST['phone'], $_POST['address1'], $_POST['address2'], $_POST['city'], $_POST['state'], $_POST['country'], $_POST['zipcode']);
    } else {
        echo "Request Failed";
    }
}