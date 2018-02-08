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

	if($type == '1')
	{
		$get_all_user_sql = "SELECT * from user"; 
		$get_all_user_result = mysql_query($get_all_user_sql);
		$user_num = mysql_num_rows($get_all_user_result);

		$get_all_device_sql = "SELECT * from device order by online_or_not desc "; 
		$get_all_device_result = mysql_query($get_all_device_sql);
		$device_num = mysql_num_rows($get_all_device_result);

		$get_all_device_on_sql = "SELECT * from device where online_or_not = '1'"; 
		$get_all_device_on_result = mysql_query($get_all_device_on_sql);
		$device_on_num = mysql_num_rows($get_all_device_on_result);

	}
	else if ($type =='0')
	{

		$get_all_device_sql = "SELECT * from device where user = '$username' order by online_or_not desc "; 
		$get_all_device_result = mysql_query($get_all_device_sql);
		$device_num = mysql_num_rows($get_all_device_result);
		// $row_device = mysql_fetch_array($get_all_device_result);

		$get_all_device_on_sql = "SELECT * from device where online_or_not = '1' and user ='$username' "; 
		$get_all_device_on_result = mysql_query($get_all_device_on_sql);
		$device_on_num = mysql_num_rows($get_all_device_on_result);
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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
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
	     <div class="widget_head">设备列表</div>
		   
		   <div class="widget_4">
		   	 <div class="col-md-4 widget_1_box1">
		   	 	 <div class="follow">

                    <div class="col-xs-4 two" align="center">
                        <p>设备数量</p>
                        <span><?php echo $device_num;?></span>
                    </div>
                    <div class="col-xs-4 two" align="center">
                        <p>在线数量</p>
                        <span><?php echo $device_on_num;?></span>
                    </div>
                    <div class="clearfix"> </div>
                 </div>
                               
		       </div>
		   	 </div>
		   	 <div class="col-md-4 stats-info3"> 
		   	 	<div class="online">
		   	 		
		   	 		<?php 
		   	 			
		   	 			while($row_device = mysql_fetch_array($get_all_device_result))
		   	 			{
		   	 				
		   	 				echo "<a href='device_info.php?ID={$row_device['ID']}'><div class='online-top'>
								<div class='top-at'>
									<img class='img-responsive' src='images/device.png' alt=''>
								</div>
								<div class='top-on'>
									<div class='top-on1'>
										<p>{$row_device['name']}       <span>ID: {$row_device['ID']}</span></p>
										<span>PM2.5: {$row_device['data_pm']}  &nbsp &nbsp</span><span>CO2: {$row_device['data_co']} </span></br><span>PWM: {$row_device['data_pwm']}  &nbsp &nbsp</span><span>温度: {$row_device['data_temp']}°C</span>
									</div>";
							if($row_device['online_or_not'] == '1')
							{
								echo "<label class='round'> </label>";
							}
							echo "<div class='clearfix'> </div>
								</div>
								<div class='clearfix'> </div>
								</div></a>";
																
		   	 			}

		   	 		?>
		   	 		<?php 
					if($device_num) 
						echo "<span style=\"float:left\"> <button class=\"btn btn-info\" type=\"button\" onclick =\"javascript:location.reload()\">刷新数据</button></span> "
					?>
				</div>
				
		   	 </div>
		   	 
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
