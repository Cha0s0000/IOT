<?php
	header("Content-type: text/html; charset=utf-8"); 
	include_once("conn.php"); 
	session_start();

	if(!isset($_SESSION['username']))
	{
		echo "<script>alert('尚未登录')</script>";
		echo '<script language=javascript>window.location.href="login.php"</script>'; 
		exit();
	}

	$username = $_SESSION['username'] ;
	$password = $_SESSION['password'] ;
	// $type = $_SESSION['type'];

	$check_user = "SELECT * from user where username = '$username' and password = '$password'";
	$check_result = mysql_query($check_user);
	$row = mysql_fetch_array($check_result);
	// $sign = $row['sign'];
	$type =$row['type'];

	if($type != '1')
	{
		echo "<script>alert('非法访问,已记录你的IP！')</script>";
        
        echo '<script language=javascript>window.location.href="login.php"</script>';
		exit();

	}
	else 
	{

		$get_all_user_sql = "SELECT * from user where type=0"; 
		$get_all_user_result = mysql_query($get_all_user_sql);
		$user_num = mysql_num_rows($get_all_user_result);

	}

?>



<!DOCTYPE HTML>
<html>
<head>
<title>Widgets</title>
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
<body>
<div id="wrapper">
     <!-- Navigation -->
        <nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
               <a class="navbar-brand" href="widgets.php">K-CS100空气净化系统</a>
            </div>
            <!-- /.navbar-header -->
             <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="widgets.php"><i class="fa fa-dashboard fa-fw nav_icon"></i>系统首页</a>
                        </li>
                        <?php 
                        	if($type==1)
                        		echo "<li>
		                             <a href=\"userlist.php\"><i class=\"fa fa-indent nav_icon\"></i>用户列表</a>
		                             </li>";
		                 ?>
                        <li>
                            <a href="device.php"><i class="fa fa-laptop nav_icon"></i>设备列表</a>
                        </li>
                        <li>
                            <a href="setting.php"><i class="fa fa-sitemap fa-fw nav_icon"></i>个人设置</a>
                        </li>
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        
        <div id="page-wrapper">
        <div class="graphs">
	     <div class="widget_head">用户列表<span> <button class="btn btn-info" type="button" onclick ="javascript:window.location.href='add_user.php' ">添加用户>></button></span></div>
		   
		   <div class="widget_4">
			 <div class='col-md-4 stats-info stats-info1'>
                <div class='panel-heading'>
                    <h4 class='panel-title'>用户数量：<?php echo $user_num ?></h4>
                </div>
                <div class='panel-body panel-body2'>
                    <ul class='list-unstyled'>
	                   		
                <?php 
                    
	   	 			while($row_user = mysql_fetch_array($get_all_user_result))
	   	 			{

	   	 				echo "<a href='check_user.php?check_user={$row_user['username']}'><div class='online-top'><li>{$row_user['username']}<div class='text-success pull-right'></div></div></li>";
	   	 			}
	   	 			echo "</ul></div></div>";
	                
		   	  ?>
                   
		   	 <div class="clearfix"> </div>
		   </div>
		   
		   <div class="copy_layout">
             <p>K-CS100空气净化系统微信控制端</p>
           </div>
	  </div>
      </div>
      <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->
<!-- Nav CSS -->
<link href="css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
