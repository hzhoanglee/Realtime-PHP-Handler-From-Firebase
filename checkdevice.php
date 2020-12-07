<?php
//Get config
include ('../config.php');
$url = $config['firebase_url'] . "/DeviceState/.json";
echo "Program started: " . $url . "\n";
//Get Limit and time left
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
$obj = json_decode($output);
curl_close($ch);
$limit = $obj -> TVTimeleft;
echo ('Thoi gian con lai: '. gmdate('H:i:s', $limit) . "\n");
//Loop the code
while(1 == 1) {
    $t=0;
    while($t<$limit){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        //echo $output;
        $info = curl_getinfo($ch);
        curl_close($ch);
        $obj = json_decode($output);
        $tvstate = $obj -> TV;
        $tvlight = $obj -> TVLight;
        $sleep = ($info['total_time'])*1000000;
    if($tvstate==0 or $tvlight==0){
        echo ('TV dang tat');
        sleep(1);
    } else {
            $t = $t+10;
            $left = $limit - $t;
        usleep(10000000 - $sleep);
            echo ('Thoi gian con lai: '. gmdate('H:i:s', $left));
            $command = "python3 update.py DeviceState TVTimeleft $left > /dev/null 2>&1 &" ;
            system($command);
            if ($left == 0){
                $command = 'python3 update.py DeviceState TV 0';
                system($command);
            }
        }
        echo "\n";
    }
}
