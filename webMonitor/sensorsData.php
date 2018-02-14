<?php

	$temp = round(randomFloat(16,20),1);
	$humi = round(randomFloat(35,40),1);
    $light = round(randomFloat(50,60),1);
    $voice = round(randomFloat(55,65),1);
    $airquality = round(randomFloat(20,30),1);
    $distance = round(randomFloat(20,30),1);
    $b = array(
    		'temp'=>$temp, 
    		'humi'=>$humi,
            'light'=>$light, 
            'voice'=>$voice,
            'airquality'=>$airquality, 
            'distance'=>$distance
    );
    $data = json_encode($b);
    echo($data);

    function randomFloat($min = 0, $max = 1) {
    return $min + mt_rand() / mt_getrandmax() * ($max - $min);
}
?>