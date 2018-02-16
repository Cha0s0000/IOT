<?php
    include_once("conn.php"); 
    $sql = "SELECT * from device where ID = '$ID' ";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $data_airQuality = $row['data_airQuality'];
    $data_distance = $row['data_distance'];
    $data_voice = $row['data_voice'];
    $data_light = $row['data_light'];
    $data_humi = $row['data_humi'];
    $data_temp = $row['data_temp'];
	// $temp = round(randomFloat(16,20),1);
	// $humi = round(randomFloat(35,40),1);
 //    $light = round(randomFloat(50,60),1);
 //    $voice = round(randomFloat(55,65),1);
 //    $airquality = round(randomFloat(20,30),1);
 //    $distance = round(randomFloat(20,30),1);
    $b = array(
    		'temp'=>$data_temp, 
    		'humi'=>$data_humi,
            'light'=>$data_light, 
            'voice'=>$data_voice,
            'airquality'=>$data_airQuality, 
            'distance'=>$data_distance
    );
    $data = json_encode($b);
    echo($data);

    function randomFloat($min = 0, $max = 1) {
    return $min + mt_rand() / mt_getrandmax() * ($max - $min);
}
?>