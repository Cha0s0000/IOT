<?php
	include_once("conn.php"); 
	
	session_start();
	
	if(isset($_SESSION['username']))
	{	
		$username = $_SESSION['username'];
		$old_pass = $_GET['old_pass'];
		$new_pass = $_GET['new_pass'];

		$check_user = "SELECT * from user where username = '$username' and password = '$old_pass' ";
		$check_result = mysql_query($check_user);
		$check_exist = mysql_num_rows($check_result);

		if(!$check_exist)
		{
			echo "0";
		}
		else
		{
			$sql = "UPDATE user set password='$new_pass' where username = '$username'";
       		$result_sql = mysql_query($sql);
			if($result_sql)
				echo "1";
			else
				echo "3";	
		}
	}


?>