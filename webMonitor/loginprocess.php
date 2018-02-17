<?php
	header("Content-type: text/html; charset=utf-8"); 
	include_once("conn.php"); 
	
	session_start();
	

	if(isset($_SESSION['login']))
	{	
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(empty($username) || empty($password))
		{
			echo "<script>alert('please input username and password')</script>";
			echo '<script language=javascript>window.location.href="login.php"</script>'; 
		}


		$password = md5($password);

		$_SESSION['username'] = $username ;
		// $_SESSION['password'] = $password ;
		// echo "<a>..'$username'..</a>";
		$check_user = "SELECT * from user where username = '$username' and password = '$password'";
		$check_result = mysql_query($check_user);
		$check_exist = mysql_num_rows($check_result);
		// echo $check_result;
		if($check_exist)
		{
			
			echo "<script>alert('login succeed')</script>";
			echo '<script language=javascript>window.location.href="showInfoIndex.php"</script>'; 
			
 			// exit();
		}
		else
		{
			// echo "<a>....1</a>";
			echo "<script>alert('username or password error')</script>";
			echo '<script language=javascript>window.location.href="login.php"</script>'; 

	 		// exit();
		}
		
	}
	else
	{
		echo "<script>alert('error')</script>";
		echo '<script language=javascript>window.location.href="login.php"</script>'; 


	}


?>