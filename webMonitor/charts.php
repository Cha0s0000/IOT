<?php
    $b = array(
    		'temp'=>rand(10,20), 
    		'humi'=>rand(30,40)
    );
    $data = json_encode($b);
    echo($data);
?>