<?php
$url = "https://project-d478b.firebaseio.com/Distance.json";
$count = 0;
$break = 3;
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
    $distance = $obj;
    $count = $count + 1;
    echo '[' . $count . '] ';
    switch (TRUE) {
        case $distance == 0:
            echo ("Cam bien loi\n");
            sleep(5);
            break;
        case $distance >= 84.5:
        case $distance <= 79:
            echo 'Phat hien nguoi qua cua! ';
            if ($break == $breaktime){
                $hightemp = curl_init();
                curl_setopt($hightemp, CURLOPT_URL, 'http://localhost/backend/send.php?title=C%E1%BA%A3nh%20b%C3%A1o!&message=C%C3%B3%20ng%C6%B0%E1%BB%9Di%20b%C6%B0%E1%BB%9Bc%20qua%20c%E1%BB%ADa');
                curl_exec($hightemp);
                curl_close($hightemp);
                //$break = $break - 1;
            }
            if ($break == 0){
                $break = $breaktime;
            }
            break;

        default:
            echo 'Khoang cach la: ' . $distance . ' cm';
            break;
    }
    sleep(0.5);
    echo "\n";
}