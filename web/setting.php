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
                            <a href="widgets.php"><i class="fa fa-sitemap fa-fw nav_icon"></i>个人设置</a>
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
            function ChangePass() {  
                var old_pass = document.getElementById("old_pass"); 
                var new_pass = document.getElementById("new_pass"); 
                var new_pass_again = document.getElementById("new_pass_again"); 
                
              
                if (old_pass.value == "") {  
                    alert("请输入旧密码");  
                    old_pass.focus();  
                    return false;  
                }  
                 if (new_pass.value == "") {  
                    alert("请输入新密码");  
                    new_pass.focus();  
                    return false;  
                }  
                if (new_pass_again.value == "") {  
                    alert("请再次输入新密码");  
                    new_pass_again.focus();  
                    return false;  
                }  
                 if (new_pass.value != new_pass_again.value) {  
                    alert("两次密码输入不一样");  
                    new_pass_again.focus();  
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
              
                
                var old_pass = document.getElementById("old_pass"); 
                var new_pass = document.getElementById("new_pass"); 
               
                var url = " do_change_pass.php?old_pass=" + old_pass.value + "&new_pass=" + new_pass.value;  
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
                            
                            alert("修改成功。请重新登录")  ;
                            var url = "clear_session.php";  
                            xmlhttp.open("GET", url, true);  
                            xmlhttp.send(null); 
                            window.location.href="login.php";  
                            
                        }  
                        else if (message =="0") {  
                            alert("原密码不正确")  
                        }  
                        else if(message == '3')
                        {
                            alert("数据库出错")  
                        }
                        
                    }  
              
                }  
            }  
        </script>
        <div id="page-wrapper">
        <div class="graphs">
         <div class="widget_head">密码修改</div>
           
           <div class="widget_4">
             <div class="col-md-4 widget_1_box1">
                <div class="coffee">
                <div class="coffee-top">
                    <a href="#"><img class="img-responsive" src="images/12.png" alt="">
                    <div class="doe">
                        <h6>欢迎使用</h6>
                       <p><?php echo $username;?></p>
                    </div>
                    
                    <i></i>
                    </a>
                </div>
                <div class="follow">
                    
                    <div class="clearfix"> </div>
                </div>
                <div class="follow">
                      <label>输入旧密码 : </label>
                      <input type="password" id= "old_pass" class="form-control1 control3">
                      <label>输入新密码 : </label>
                      <input type="password" id= "new_pass" class="form-control1 control3">
                      <label>再次确认新密码 : </label>
                      <input type="password" id= "new_pass_again" class="form-control1 control3">
                      <span style="float:right"> <button class="btn btn-info" type="button"  onclick="ChangePass()">确认修改</button></span>
                    <!-- </div> -->
                    <div class="clearfix"> </div>
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
