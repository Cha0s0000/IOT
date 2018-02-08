<?php
    include_once("conn.php"); 
    $username = $_GET['username'];
    $sql = "SELECT * FROM   ";

    $b = array(
    		'temp'=>$temp, 
    		'humi'=>$humi
    );
    $data = json_encode($b);
    echo($data);


?>