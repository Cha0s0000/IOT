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
	$check_user = "SELECT * from user where username = '$username' and password = '$password'";
	$check_result = mysql_query($check_user);
	$row = mysql_fetch_array($check_result);
	// $sign = $row['sign'];
	$type =$row['type'];

	if(isset($_GET['ID']))
		
	{
		$ID = $_GET['ID'];

		$sql = "SELECT * FROM device where ID = '$ID' ";
	    $result = mysql_query($sql);
	    $row = mysql_fetch_array($result);


		$data_pm = $row['data_pm'];
		$data_co = $row['data_co'];
		$data_pwm = $row['data_pwm'];
		$data_temp = $row['data_temp'];
		$data_switch_one = $row['data_switch_one'];
		$data_switch_two = $row['data_switch_two'];
		$data_switch_three = $row['data_switch_three'];
		$data_switch_four = $row['data_switch_four'];
		$data_switch_mode = $row['data_switch_mode'];
		$data_timestamp = $row['timestamp'];
		$data_name  = $row['name'];
	}
	else
		{echo "<script>alert('非法访问,已记录你的IP！')</script>";
        
        echo '<script language=javascript>window.location.href="login.php"</script>';}



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
<link href="css/bootstrap-switch.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-switch.js"></script>
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
	     <div class="widget_head">设备详情</div>
		   
		   <div class="widget_4">
		   	 
		   	 <!-- </div> -->
		   	 <div class="col-md-4 stats-info stats-info1">
                 <div class="panel-heading">
                 	<form action = "change_name.php" method="post">
                    <span style="float:left;" class="panel-title"><?php echo $data_name ;?> &nbsp</span>
                    	<input style="float:right;" type="submit"  value="修改">
						<input style="float:right;width:80px;"  type="text" name= "device_name" class="text" value="" onfocus="this.value = '';" >
						<input type="hidden" name="a" value="<?php echo $ID;?>" />
						
					</form>
					<br>
					<br>
					<h4 style="float:left;" class="panel-title">ID:<?php echo $ID ;?></h4>
					<span style="float:right"> <button class="btn btn-info" type="button" onclick ="javascript:location.reload()">刷新数据</button></span>
					<br>
					<br>
                </div>
                <div class="panel-body panel-body2">
                    <ul class="list-unstyled">
                        <li>PM2.5值<div class="text-success pull-right"><?php echo $data_pm;?></div></li>
                        <li>CO2值<div class="text-success pull-right"><?php echo $data_co;?></div></li>
                        <li>PWM值<div class="text-success pull-right"><?php echo $data_pwm;?></div></li>
                        <li>温度值<div class="text-danger pull-right"><?php echo $data_temp;?></div></li>
                        <li>继电器1开关状态<div class="text-danger pull-right"><?php echo $data_switch_one?'开':'关';?></div></li>
                        <li>继电器2开关状态<div class="text-danger pull-right"><?php echo $data_switch_two?'开':'关';?></div></li>
                        <li>继电器3开关状态<div class="text-danger pull-right"><?php echo $data_switch_three?'开':'关';?></div></li>
                        <li>继电器4开关状态<div class="text-danger pull-right"><?php echo $data_switch_four?'开':'关';?></div></li>
                        <li>继电器模式<div class="text-danger pull-right"><?php echo $data_switch_mode?'手动':'自动';?></div></li>
                        <li class="last">更新时间<div class="text-success pull-right"><?php echo $data_timestamp;?></div></li> 
                    </ul>
                </div>
            </div>
		   	 <div class="clearfix"> </div>
		   </div>
		   <!-- ?ID='+<?php echo $ID;?>+'&data_id='+sign -->
		   <script type="text/javascript">
		   	    function onClick(e){
	                 var sign=e.getAttribute("data_id");
	               	 var xht = new XMLHttpRequest();
					 xht.open('GET','control.php?ID='+<?php echo $ID;?>+'&data_id='+sign,true);
			 		 xht.send();
			 		 xht.onreadystatechange = function () {
			        if(xht.status == 200 && xht.readyState ==4){
			            var str = xht.responseText;
			            alert("马上为您操作");
				       }
				    };
	                
	             }
		   </script>
		   <div class="widget_5">
		   	 <div class="col-md-6 widget_1_box2">
		   	 <h3 >远程控制</h3> 
		   	 	<div class="alert alert-info">
		   	 		<div>继电器1：
		   	 			<button data_id="one_on" onclick="onClick(this)" class="btn btn_5 btn-lg btn-success warning_1" type="button" style="width:100px;" >开</button>	
		   	 			<button data_id="one_off" onclick="onClick(this)" class="btn btn_5 btn-lg btn-default" type="button"  style="width:100px;">关</button>
		   	 		</div>
		   	 		<br>
		   	 		<div>继电器2：
		   	 			<button data_id="two_on" onclick="onClick(this)" class="btn btn_5 btn-lg btn-success warning_1" type="button" style="width:100px;" >开</button>	
		   	 			<button data_id="two_off" onclick="onClick(this)" class="btn btn_5 btn-lg btn-default" type="button"  style="width:100px;">关</button>
		   	 		</div>
		   	 		<br>
		   	 		<div>继电器3：
		   	 			<button data_id="three_on" onclick="onClick(this)" class="btn btn_5 btn-lg btn-success warning_1" type="button" style="width:100px;" >开</button>	
		   	 			<button data_id="three_off" onclick="onClick(this)" class="btn btn_5 btn-lg btn-default" type="button"  style="width:100px;">关</button>
		   	 		</div>
		   	 		<br>
		   	 		<div>继电器4：
		   	 			<button data_id="four_on" onclick="onClick(this)" class="btn btn_5 btn-lg btn-success warning_1" type="button" style="width:100px;" >开</button>	
		   	 			<button data_id="four_off" onclick="onClick(this)" class="btn btn_5 btn-lg btn-default" type="button"  style="width:100px;">关</button>
		   	 		</div>
		   	 		<br>
		   	 		<div>继电器模式：
		   	 			<button data_id="mode_hand" onclick="onClick(this)" class="btn btn_5 btn-lg btn-success warning_1" type="button" style="width:100px;" >手动</button>	
		   	 			<button data_id="mode_auto" onclick="onClick(this)" class="btn btn_5 btn-lg btn-default" type="button"  style="width:100px;">自动</button>
		   	 		</div>
		   	 		<br>
		   	 		<div>PWM值：
		   	 			<button data_id="pwm_0" onclick="onClick(this)" class="btn btn-xs btn-danger" type="button" style="width:50px;height:40px;" >0</button>	
		   	 			<button data_id="pwm_20" onclick="onClick(this)" class="btn btn-xs btn-danger" type="button" style="width:50px;height:40px;" >20</button>	
		   	 			<button data_id="pwm_40" onclick="onClick(this)" class="btn btn-xs btn-danger" type="button" style="width:50px;height:40px;" >40</button>	
		   	 			<button data_id="pwm_60" onclick="onClick(this)" class="btn btn-xs btn-danger" type="button" style="width:50px;height:40px;" >60</button>	
		   	 			<button data_id="pwm_80" onclick="onClick(this)" class="btn btn-xs btn-danger" type="button" style="width:50px;height:40px;" >80</button>	
		   	 			<button data_id="pwm_100" onclick="onClick(this)" class="btn btn-xs btn-danger" type="button" style="width:50px;height:40px;" >100</button>	
		   	 		</div>
		   	 		
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
