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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
    <div class="widget_head"> IOT system </div>
  </div>
  <h2 class="form-heading">Login</h2>
  <div class="app-cam">
	  <form action = "loginprocess.php" method="post">
		<input type="text" name= "username" class="text" value="" onfocus="this.value = '';" >
		<input type="password" name = "password" value="" onfocus="this.value = '';">
		<div class="submit"><input type="submit" onclick="myFunction()" value="Login"></div>
		
		
	</form>
  </div>
   
</body>
</html>
