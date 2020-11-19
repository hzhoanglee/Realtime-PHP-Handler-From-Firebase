<?php
$url = "https://project-d478b.firebaseio.com/.json";
$break = 10;
$breaktime = $break;
while(1 == 1){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
//echo $output;
curl_close($ch);
$obj = json_decode($output);
$temperature = $obj->Temperature;
$humidity = $obj->Humidity;
switch (TRUE) {
case $temperature == 'nan':
    echo ("Cam bien loi\n");
        sleep(1);
        break;
case $temperature >= 34:
    echo 'Nhiet do cao! ';
    if ($break == $breaktime){
        $hightemp = curl_init();
        curl_setopt($hightemp, CURLOPT_URL, 'http://localhost/backend/send.php?title=C%E1%BA%A3nh%20b%C3%A1o!&message=Nhi%E1%BB%87t%20%C4%91%E1%BB%99%20trong%20ph%C3%B2ng%20qu%C3%A1%20cao!%20H%C3%A3y%20%C4%91%E1%BA%BFn%20%C4%91i%E1%BB%81u%20ch%E1%BB%89nh%20nhi%E1%BB%87t%20%C4%91%E1%BB%99%20ph%C3%B2ng.');
        curl_exec($hightemp);
        curl_close($hightemp);
    }
    $break = $break - 1;
    if ($break == 0){
        $break = $breaktime;
    }
    echo ('Canh bao sau: '.$break);
    break;

case $temperature <= 18:
    echo 'Nhiet do thap! ';
    if ($break == $breaktime){
        $hightemp = curl_init();
        curl_setopt($hightemp, CURLOPT_URL, 'http://localhost/backend/send.php?title=C%E1%BA%A3nh%20b%C3%A1o!&message=Nhi%E1%BB%87t%20%C4%91%E1%BB%99%20trong%20ph%C3%B2ng%20qu%C3%A1%20thấp!%20H%C3%A3y%20%C4%91%E1%BA%BFn%20%C4%91i%E1%BB%81u%20ch%E1%BB%89nh%20nhi%E1%BB%87t%20%C4%91%E1%BB%99%20ph%C3%B2ng.');
        curl_exec($hightemp);
        curl_close($hightemp);
    }
    $break = $break - 1;
    if ($break == 0){
        $break = $breaktime;
    }
    echo ('Canh bao sau: '.$break);
    break;
default:
    echo 'Nhiet do on dinh! ';
    break;
}
    sleep(1);
    echo "\n";
}