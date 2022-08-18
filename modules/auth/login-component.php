<?php
namespace rentalcar\modules\auth;
session_start();
define("BLOCK_DIRECT_ACCESS", true);

class login_component
{
    function __construct()
    {
        if (isset($_SESSION['username'])) {
            header("Location: ../../modules/agency/agency-component",true,301);
            exit();
        }
        include __DIR__ . "./login-view.php";
    }

    public function sign_api($email, $password, $agency_type)
    {
        $data_array = [
            "username" => $email,
            "password" => $password
        ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "80",
            CURLOPT_URL => "http://localhost:80/rentalcar/api/auth/agency_user.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"email\":\"$email\",\n\t\"password\":\"$password\",\n\t\"user_type\":\"$agency_type\"\n}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 1f25b0e9-33b5-5caf-9d50-d0019741c3f5"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            echo "<script>console.log('" . $data['success'] . "')</script>";
            echo "<script>console.log('" . $data['message'] . "')</script>";
            //FOR VALID USER
            if ($data["success"]) {
                $_SESSION['username'] = $data['token'];
//                header("refresh:1");
//                header("Location: ../../modules/agency/agency-component");
//                exit();
                echo "<script>location.href='../../modules/agency/agency-component.php'</script>";
            } else {
                echo '<script>
  let child_alert_div=`<strong>"' . $data['message'] . '"</strong> You should check in on some of those fields below.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeAlertDiv()">
                <span aria-hidden="true">&times;</span>
            </button>`;
  let alertDiv = document.getElementById("alert-div");
    alertDiv.innerHTML=child_alert_div;
    alertDiv.style.display = "block";
    setTimeout(()=>{
        alertDiv.style.display="none";
    },2000);
</script>';
            }
        }
    }
}

$comp = new login_component();
if (isset($_POST['signin'])) {
    if (isset($_REQUEST['email']) && isset($_REQUEST['password']) && isset($_REQUEST['user_type']))
        $comp->sign_api($_REQUEST['email'], $_REQUEST['password'], $_REQUEST['user_type']);
}