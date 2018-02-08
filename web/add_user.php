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

  if(!$type == '1')
  {
      echo "<script>alert('非法访问,已记录你的IP！')</script>";
      echo '<script language=javascript>window.location.href="login.php"</script>';
  }

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Compose</title>
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
            function CheckLogin() {  
                var add_username_id = document.getElementById("add_username"); 
                var add_password_id = document.getElementById("add_password");
                var add_password_again_id = document.getElementById("add_password_again");  
              
                if (add_username_id.value == "") {  
                    alert("请输入用户名");  
                    add_username.focus();  
                    return false;  
                }  
              
                if (add_password_id.value == "") {  
                    alert("请输入密码");  
                    add_password.focus();  
                    return false;  
                } 

                if (add_password_again_id.value == "") {  
                    alert("请再次输入密码");  
                    add_password_again.focus();  
                    return false;  
                }  

                if (add_password_again_id.value != add_password_id.value) {  
                    alert("两次密码输入不相同");  
                    add_password_again.focus();  
                    return false;  
                }   

                //创建xmlhttprequest对象  
                CreateXMLHttpRequest();  
                //登录验证  
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
              
                
                var add_username = document.getElementById("add_username"); 
                var add_password = document.getElementById("add_password");
                var user_info = document.getElementById("user_info");
               
                var url = " do_add_user.php?add_username=" + add_username.value + "&add_password=" + add_password.value + "&user_info=" + user_info.value ;  
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
                            document.getElementById("add_username").value  = "";
                            document.getElementById("add_password").value  = "";
                            document.getElementById("add_password_again").value  = "";
                            document.getElementById("user_info").value  = "";
                            alert("添加成功")  ;
                            
                        }  
                        else if (message =="0") {  
                            alert("数据库连接出错")  
                        }  
                        else if(message == '3')
                        {
                            alert("账号已存在")  
                        }
                        
                    }  
              
                }  
            }  
        </script>
        <div id="page-wrapper">
        <div class="graphs">
	     <div class="xs">
  	    <div class="col-md-8 inbox_right">
          <h3>添加新用户</h3>
        	<div class="Compose-Message">               
                <div class="panel panel-default">
                    <div class="panel-heading">
                        请填写用户信息 
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-info">
                            填写后请认真核对
                        </div>
                          <hr>
                          <label>账 号 : </label>
                          <input type="text" id= "add_username" class="form-control1 control3">
                          <label>密 码 :  </label>
                          <input type="password" id= "add_password" class="form-control1 control3">
                          <label>确 认 密 码 : </label>
                          <input type="password" id= "add_password_again" class="form-control1 control3">
                          <label>账 户 信 息 : </label>
                          <textarea rows="6" class="form-control1 control2" id= "user_info"></textarea>
                          <hr>
                         <div class="submit"><input type="submit"  onclick="CheckLogin()" value="提交"></div>
                    </div>
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
