<?php

$servername = "localhost"; //mostly localhost or use the host name
$username = "qltre"; //database username
$password = "qltre"; //database password'
$conn = new PDO("mysql:host=$servername;dbname=qltre", $username, $password);

//set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
define('API_ACCESS_KEY', 'AAAA9EUWm88:APA91bH_5giv_qCAfukX0BM5u6mgbnZd4YYCiCO5E1O4VJmkDdibtsaSvvW_rmkZ2-wbYYhOQshSCJxhHOr_hc-esW8v8m5wykYVnKGqGvTCT69xlZBeIeikpAjw4Ht3fw4IJWRtZS0d');
//Here we will send specific user
$sql = "SELECT token FROM `devicesid`";
$title = $_GET["title"];
$body = $_GET["message"];
$resultt = $conn->prepare($sql);
$resultt->execute();
$token = array();
if ($resultt->rowCount() > 0) {
    while ($row = $resultt->fetch()) {
        $token[] = $row["token"];
        //echo $row["token"];
    }
}
$loop = count($token);
$thanhcong = 0;
$total = 0;
for ($x = 0; $x <= $loop - 1; $x++) {
    $lan = $x + 1;
    $data = array("to" => "$token[$x]",
        "notification" => array("title" => "$title", "body" => "$body"));
    $data_string = json_encode($data);
    $headers = array('Authorization: key=' . API_ACCESS_KEY, 'Content-Type: application/json');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    $result = curl_exec($ch);
    curl_close($ch);
    $obj = json_decode($result);
    $suc = $obj->success;

    $total = $total + 1;
    if ($suc == 1) {
        $thanhcong = $thanhcong + 1;
    }
}
$thatbai = $total - $thanhcong;
