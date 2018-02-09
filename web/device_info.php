<?php
	header("Content-type: text/html; charset=utf-8"); 
	$ID = $_GET['ID'];

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
                <a class="navbar-brand" href="widgets.php">Remote control system</a>
            </div>
           
        </nav>
        
        <div id="page-wrapper">
        <div class="graphs">
	     <div class="widget_head">Control interface</div>
		   
		  
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
			            // alert("OK");
				       }
				    };
	                
	             }
		   </script>
		   <div class="widget_5">
		   	 <div class="col-md-6 widget_1_box2">
		   	 <h3 >Remote control</h3> 
		   	 	<div class="alert alert-info">
		   	 		<div>LED1：
		   	 			<button data_id="one_on" onclick="onClick(this)" class="btn btn_5 btn-lg btn-success warning_1" type="button" style="width:100px;" >ON</button>	
		   	 			<button data_id="one_off" onclick="onClick(this)" class="btn btn_5 btn-lg btn-default" type="button"  style="width:100px;">OFF</button>
		   	 		</div>
		   	 		<br>
		   	 		<div>LED2：
		   	 			<button data_id="two_on" onclick="onClick(this)" class="btn btn_5 btn-lg btn-success warning_1" type="button" style="width:100px;" >ON</button>	
		   	 			<button data_id="two_off" onclick="onClick(this)" class="btn btn_5 btn-lg btn-default" type="button"  style="width:100px;">OFF</button>
		   	 		</div>
		   	 		<br>
		   	 		<div>LED3：
		   	 			<button data_id="three_on" onclick="onClick(this)" class="btn btn_5 btn-lg btn-success warning_1" type="button" style="width:100px;" >ON</button>	
		   	 			<button data_id="three_off" onclick="onClick(this)" class="btn btn_5 btn-lg btn-default" type="button"  style="width:100px;">OFF</button>
		   	 		</div>
		   	 		<br>
		   	 		<div>LED4：
		   	 			<button data_id="four_on" onclick="onClick(this)" class="btn btn_5 btn-lg btn-success warning_1" type="button" style="width:100px;" >ON</button>	
		   	 			<button data_id="four_off" onclick="onClick(this)" class="btn btn_5 btn-lg btn-default" type="button"  style="width:100px;">OFF</button>
		   	 		</div>
		   	 	
		   	 	</div>
		   	 	
             </div>
            
		   	 	
		     <div class="clearfix"> </div>
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
