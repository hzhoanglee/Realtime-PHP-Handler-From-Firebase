<?php
include ('../config.php');
$url = $config['firebase_url'] . "/Danger/.json";
echo "Program started: " . $url . "\n";
$count = 0;
$break = 5;
$open = 0;
$through = 0;
$breaktime = $break;
while(1 == 1){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    $obj = json_decode($output);
    $door = $obj->DoorOpen;
    $pass = $obj->DoorPassed;
    $count = $count + 1;
    echo '[' . $count . '] ';

    if($door == 0){
        echo ("Cua dang dong");
        sleep(1);
        $open = 0;
        break;
    }
    if($door == 1){
        echo ("Cua dang mo");
        if ($open==0){
            $open = 1;
            if ($open == 1){
                $send = curl_init();
                curl_setopt($send, CURLOPT_URL, 'http://localhost/backend/send.php?title=C%E1%BA%A3nh%20b%C3%A1o!&message=C%E1%BB%ADa%20%C4%91%C6%B0%E1%BB%A3c%20m%E1%BB%9F%20ra');
                curl_exec($send);
                curl_close($send);
            }
        }
        elseif ($open == 1) {
            echo ' - Da thong bao truoc do. Khong thong bao lai' . "\n";
        }
    }
    if($pass == 0){
        echo ("Khong ai qua cua");
        sleep(1);
        $through = 0;
        break;
    }
    if($pass == 1){
        echo ("Co nguoi qua cua");
        if ($through==0){
            $through = 1;
            if ($through == 1){
                $send = curl_init();
                curl_setopt($send, CURLOPT_URL, 'http://localhost/backend/send.php?title=C%E1%BA%A3nh%20b%C3%A1o!&message=C%C3%B3%20ng%C6%B0%E1%BB%9Di%20b%C6%B0%E1%BB%9Bc%20qua%20c%E1%BB%ADa');
                curl_exec($send);
                curl_close($send);
            }
        }
        elseif ($through == 1) {
            echo ' - Da thong bao truoc do. Khong thong bao lai';
        }
    }
    sleep(1);
    echo "\n";
}