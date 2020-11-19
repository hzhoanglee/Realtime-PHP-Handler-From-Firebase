<?php
$url = "https://project-d478b.firebaseio.com/DeviceState.json";
$limit = 5;
while(1 == 1) {
    $t=0;
    while($t<$limit){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        //echo $output;
        curl_close($ch);
        $obj = json_decode($output);
        $tvstate = $obj->TV;
        $comstate = $obj->Computer;
    if($tvstate==0){
        echo ('TV dang tat');
        sleep(1);
    } else {
            $t = $t+1;
            $left = $limit - $t;
            sleep(1);
            echo ('Thoi gian con lai: '. gmdate('H:i:s', $left));
            if ($left == 0){
                $command = 'python3 update.py TV 0';
                system($command);
            }
        }
        echo "\n";
    }

}
