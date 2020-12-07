<?php
$value = $_GET['value'];

if ($value == "on"){
    $FIREBASE = "https://project-d478b.firebaseio.com/DeviceState/";
    $NODE_PATCH = ".json";
    $data = 32;
    $data = array(
        "TV" => 1
    );
    $json = json_encode($data);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $FIREBASE . $NODE_PATCH);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    echo $response . "\n";
}
if ($value == "off"){
    $FIREBASE = "https://project-d478b.firebaseio.com/DeviceState/";
    $NODE_PATCH = ".json";
    $data = 32;
    $data = array(
        "TV" => 0
    );
    $json = json_encode($data);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $FIREBASE . $NODE_PATCH);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    echo $response . "\n";
}