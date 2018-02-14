<?php

	$temp = round(randomFloat(16,20),1);
	$humi = round(randomFloat(35,40),1);
    $b = array(
    		'temp'=>$temp, 
    		'humi'=>$humi
    );
    $data = json_encode($b);
    echo($data);

    function randomFloat($min = 0, $max = 1) {
    return $min + mt_rand() / mt_getrandmax() * ($max - $min);
}
?>