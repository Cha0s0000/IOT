<?php
	header("Content-type: text/html; charset=utf-8"); 
	include_once("conn.php"); 
	
	session_start();
	

	if(isset($_SESSION['login']))
	{	
		$ID = $_POST['a'];
		$name = $_POST['device_name'];
		if(!empty($name))
		{
			$sql = "UPDATE device set name = '$name' where ID = $ID ";
			$result = mysql_query($sql);
			echo "<script>alert('修改成功')</script>";
			echo '<script language=javascript>window.location.href="device_info.php?ID='. $ID.'"</script>'; 
		}
		else
		{
			echo "<script>alert('请正确填写')</script>";
			echo '<script language=javascript>window.location.href="device_info.php?ID='. $ID.'"</script>'; 
		}
		
	}


?>