<?php
	include_once("conn.php"); 
	
	session_start();
	
	if(isset($_GET['add_device']))
	{	
		$add_device = $_GET['add_device'];
		$add_user  = $_GET['add_user'];
		$device_check_sql = "SELECT * from device where ID = '$add_device'";
		$check_result = mysql_query($device_check_sql);
		$check_exist = mysql_num_rows($check_result);


		if($check_exist)
		{
			$check_bind = mysql_fetch_array($check_result);
			if(empty($check_bind['user']))
			{
				$add_sql = "UPDATE device SET user = '$add_user'  WHERE ID = $add_device ";
	     	    $result_add = mysql_query($add_sql);    
	     	    echo "1";
			}
			else
			{
				echo "3";
			}
		}
		else
		{
			echo "0";	
		}
	}


?>