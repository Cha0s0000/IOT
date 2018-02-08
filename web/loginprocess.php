<?php
	header("Content-type: text/html; charset=utf-8"); 
	include_once("conn.php"); 
	
	session_start();
	

	if(isset($_SESSION['login']))
	{	
		$username = $_POST['username'];
		$password = $_POST['password'];

		$_SESSION['username'] = $username ;
		$_SESSION['password'] = $password ;
		// echo "<a>..'$username'..</a>";
		$check_user = "SELECT * from user where username = '$username' and password = '$password'";
		$check_result = mysql_query($check_user);
		$check_exist = mysql_num_rows($check_result);
		// echo $check_result;
		if($check_exist)
		{
			$row = mysql_fetch_array($check_result);
			if($row['type'] == 1)
			{
				// $_SESSION['type'] = $row['type'] ;
				echo "<script>alert('登录成功')</script>";
				echo '<script language=javascript>window.location.href="widgets.php"</script>'; 
			}
			else
			{
				echo "<script>alert('登录成功')</script>";
				echo '<script language=javascript>window.location.href="widgets.php"</script>'; 
			}
			

 			// exit();
		}
		else
		{
			// echo "<a>....1</a>";
			echo "<script>alert('登录出错，请重新登录')</script>";
			echo '<script language=javascript>window.location.href="login.php"</script>'; 

	 		// exit();
		}
		
	}
	else
	{
		echo "<script>alert('请先登录')</script>";
		echo '<script language=javascript>window.location.href="login.php"</script>'; 


	}


?>