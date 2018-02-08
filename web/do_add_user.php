<?php
	include_once("conn.php"); 
	
	session_start();
	
	if(isset($_SESSION['login']))
	{	
		$add_username = $_GET['add_username'];
		$add_password = $_GET['add_password'];
		$user_info = $_GET['user_info'];
		$check_user = "SELECT * from user where username = '$add_username'";
		$check_result = mysql_query($check_user);
		$check_exist = mysql_num_rows($check_result);

		if($check_exist)
		{
			echo "3";
		}
		else
		{
			$sql = "INSERT INTO user (username,password,sign) values ('$add_username','$add_password','$user_info') ";
			$result = mysql_query($sql);
			if($result)
				echo "1";
			else
				echo "0";	
		}
	}


?>