<?php
    include_once("conn.php"); 
    $ID = $_GET['ID'];
    $sql = "SELECT * FROM device where ID = '$ID' ";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    $b = array(
    		'data_pm'=>$row['data_pm'], 
    		'data_co'=>$row['data_co'],
    		'data_pwm'=>$row['data_pwm'],
    		'data_temp'=>$row['data_temp'],
    		'data_switch_one'=>$row['data_switch_one'],
    		'data_switch_two'=>$row['data_switch_two'],
    		'data_switch_three'=>$row['data_switch_three'],
    		'data_switch_four'=>$row['data_switch_four'],
    		'data_switch_mode'=>$row['data_switch_mode'],
    		'data_timestamp'=>$row['timestamp'],
    		'data_name'=>$row['name']

    );
    $data = json_encode($b);
    echo($data);


?>