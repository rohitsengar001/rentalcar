<?php
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
    CURLOPT_POSTFIELDS => "{\n\t\"email\":\"test@gmail.com\",\n\t\"password\":\"Test@321\",\n\t\"user_type\":\"agency\"\n}",
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
    $data=json_decode($response,true);
    echo $data['success'];
}