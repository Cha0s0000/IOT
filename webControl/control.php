<?php

	$ID = $_GET['ID'];
	$data_id = $_GET['data_id'];
	if(!empty($data_id))
	{
		$sql = "SELECT * from device where ID = '$ID' ";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$client_id = $row['client_id'];
		$port = 8282;
		$ip = "127.0.0.1";
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		$result = socket_connect($socket, $ip, $port);
		$cmd = "ZZ{$client_id}ACTION{$data_id}YY";
		socket_write($socket, $cmd, strlen($cmd));
		echo $cmd;
	}
	else
	{
		echo"error";
	}



?>