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

	// admin查看其他用户的设备情况
	if($type == '1')
	{
		$check_user = $_GET['check_user'];
		$get_all_device_sql = "SELECT * from device where user = '$check_user'  order by online_or_not desc"; 
		$get_all_device_result = mysql_query($get_all_device_sql);
		$device_num = mysql_num_rows($get_all_device_result);
		// $row_device = mysql_fetch_array($get_all_device_result);

		$get_all_device_on_sql = "SELECT * from device where online_or_not = '1' and user ='$check_user' "; 
		$get_all_device_on_result = mysql_query($get_all_device_on_sql);
		$device_on_num = mysql_num_rows($get_all_device_on_result);

	}
	else 
	{	echo "<script>alert('非法访问,已记录你的IP！')</script>";
        
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
         <script type="text/javascript">
            var xmlhttp;//创建异步连接对象  
      
            //这个方法用来验证登录前的准备  
            function AddDevice() {  
                var add_device = document.getElementById("add_device"); 
                
              
                if (add_device.value == "") {  
                    alert("请输入设备ID");  
                    add_device.focus();  
                    return false;  
                }  

                //创建xmlhttprequest对象  
                CreateXMLHttpRequest();  
           
                TrueInfo();  
            }  
              
              
            //创建异步连接对象实例  
            function CreateXMLHttpRequest() {  
                if (window.ActiveXObject) {  
                    //用于IE浏览器  
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");  
                }  
                else if (window.XMLHttpRequest) {  
                    //用于其余浏览器  
                    xmlhttp = new XMLHttpRequest();  
                }  
            }  
              
            function TrueInfo() {  
                //注册回调函数  
                xmlhttp.onreadystatechange = CallBack;  
              
                
                var add_device = document.getElementById("add_device"); 
                var add_user = "<?php echo $check_user; ?>";
               
                var url = " do_add_device.php?add_device=" + add_device.value + "&add_user=" + add_user;  
                xmlhttp.open("GET", url, true);  
                xmlhttp.send(null);  
              
            }  
              
            //创建回调函数  
            function CallBack() {  
                //判断和服务器的交互是否完成  
                if (xmlhttp.readyState === 4) {  
                    //服务器数据接受状态  
                    if (xmlhttp.status === 200) {  
                        var message = xmlhttp.responseText;  
                        if (message == "1") {  
                            document.getElementById("add_device").value  = "";
                           
                            alert("设备添加成功")  ;
                            location.reload();
                            
                        }  
                        else if (message =="0") {  
                            alert("设备ID不存在，请确认设备是否通电和验证输入ID的正确性")  
                        }  
                        else if(message == '3')
                        {
                            alert("该设备已绑定其他用户")  
                        }
                        
                    }  
              
                }  
            }  
        </script>
        <div id="page-wrapper">
        <div class="graphs">
	     <div class="widget_head">查看用户设备</div>
		   
		   <div class="widget_4">
		   	 <div class="col-md-4 widget_1_box1">
		   	 	<div class="coffee">
				<div class="coffee-top">
					<a href="#"><img class="img-responsive" src="images/12.png" alt="">
					<div class="doe">
						<h6>正在查看该用户设备</h6>
					    <p>用户：<?php echo $check_user;?></p>
					</div>
					
					<i></i>
                    </a>
				</div>
				<div class="follow">
					
					<div class="clearfix"> </div>
				</div>
                <div class="follow">
                   
                    <div class="col-xs-4 two" align="center">
                        <p>设备数量</p>
                        <span><?php echo $device_num;?></span>
                    </div>
                    <div class="col-xs-4 two" align="center">
                        <p>在线数量</p>
                        <span><?php echo $device_on_num;?></span>
                    </div>
                    <div class="col-xs-4 two" align="center">
                     	<input type="text" id= "add_device" class="form-control1 control3">
                        <span style="float:right"> <button class="btn btn-info" type="button"  onclick="AddDevice()">添加设备</button></span>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                
		       </div>
		   	 </div>
		   	

                 <!-- </br> -->
		   	 <div class="col-md-4 stats-info3"> 
		   	 <div class="panel-heading">
                    <a class="panel-title"><?php if($device_num) echo "设备列表 "?></a>
                    <h4 class="panel-title"  style="float:right"><?php if($device_num) echo "在线情况 "?></h4>
                    
                </div>
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
			 </br>
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
