<?php
  session_unset();
  // session_destroy();
  session_start();
  
  $_SESSION['login'] = 'login_index';
  // echo $_SESSION['login'];

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery.min.js"></script>

<script src="js/bootstrap.min.js"></script>
</head>
<body id="login">
  <div class="login-logo">
    <div class="widget_head"> 空气净化系统 </div>
  </div>
  <h2 class="form-heading">登录</h2>
  <div class="app-cam">
	  <form action = "loginprocess.php" method="post">
		<input type="text" name= "username" class="text" value="" onfocus="this.value = '';" >
		<input type="password" name = "password" value="" onfocus="this.value = '';">
		<div class="submit"><input type="submit" onclick="myFunction()" value="登录"></div>
		
		
	</form>
  </div>
   
</body>
</html>
