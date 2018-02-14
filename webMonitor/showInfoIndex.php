<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="zh-CN">
	<head>
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">   
		<meta name="iot" content="width=device-width, initial-scale=1">   
		<meta name="chans" content="Dreamer-1.">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/myStyle.css">	
		<link rel="stylesheet" href="css/front/showInfoIndex.css">
		<link rel="stylesheet" href="css/font-awesome.css">	
		
		<!--[if gte IE 8]>
		<script src="js/IESupport/respond.min.js"></script>
		<script src="js/IESupport/html5shiv.min.js"></script>
		<![endif]-->
		
		<script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/echarts.min.js"></script>
		<script type="text/javascript" src="js/highcharts.js"></script>
		<!-- // jQuery，注意 Highcharts 4.2 开始不再依赖 jQuery -->
		<!-- <script src="https://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js"></script> -->
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=047xRylayWDTDt0ZiACu37oV"></script>
	
	<title>- IOT system -</title>
	</head>

	<body>
	
		<div class="wrapper">
			<nav class="navbar navbar-inverse navbar-fixed-top">
			        <div class="collapse navbar-collapse" id="navigation">
			            <ul class="nav navbar-nav">
			                <li>
								<a href = https://steemit.com/@cha0s0000>Do by cha0s0000 .View for more projects</a>
							</li>					
			            </ul>
		        	</div>
		    </nav>
    
			<header class="header">
				<div class="container">
				<div class="row">
            		<div class="col-md-4 col-md-offset-1">
	                	<div class="content">
	                  	<div class="pull-middle">
	                  	
	                    	<h1 class="page-header">&middot;&nbsp;IOT system&nbsp;&middot;</h1>
	                    	
	                    	<p class="lead">
	                    		Steemit - 
	                    		<a href = https://steemit.com/@cha0s0000>cha0s0000</a>
	                    		<br>
	                    		Github  - 
	                    		<a href = https://github.com/Cha0s0000>cha0s</a>
	                    		<br>
	                    		<br>
	                    		IOT system introduction:
	                    		<br>
	                    		<br>
	                    		Let you control and monitor your smart devices and home applicance through Web UI and Wechat Application
	                    		<br>	                    			                    	
	                    	</p>                                                    		
	                       
	                        <a class="btn btn-success btn-circle" > V 1.0 </a>                                                 
	                    </div>
	                  	</div>              
                	</div>
           
           			
            		<div class="col-md-6 col-md-offset-1 text-center mt-100 mb-100">
                
						<div class="counter col_third">
							<p class="count-unit"> ℃ </p>
					      	<h2 class="timer count-title" id="count-number_temp" data-to="NaN" data-speed="1500" data-decimals="1"></h2>
					       	<p class="count-text"> Temperature </font></p>
						</div>
						
						<div class="counter col_third">
					      	<p class="count-unit"> % </p>
					      	<h2 class="timer count-title" id="count-number_humi" data-to="NaN"  data-speed="1500"></h2>
					     	<p class="count-text"> Humidity </p>
					    </div>
					
					    <div class="counter col_third">
					      	<p class="count-unit"> Cd </p>
					      	<h2 class="timer count-title" id="count-number_light" data-to="NaN"  data-speed="1500" data-decimals="1"></h2>
					      	<p class="count-text "> Light </p>
					    </div>
					    
					    <div class="counter col_third">
					      	<p class="count-unit"> Db </p>
					      	<h2 class="timer count-title" id="count-number_voice" data-to="NaN"  data-speed="1500" data-decimals="1"></h2>
					     	<p class="count-text "> Voice </p>
					    </div>
					
					    <div class="counter col_third">
					      	<p class="count-unit"> μg/m3 </p>
					      	<h2 class="timer count-title" id="count-number_airQuality" data-to="NaN"  data-speed="1500" data-decimals="1"></h2>
					      	<p class="count-text "> Air quality </p>
					    </div>

					    <div class="counter col_third end">
					      	<p class="count-unit"> cm </p>
					      	<h2 class="timer count-title" id="count-number_distance" data-to="NaN"  data-speed="1500"></h2>
					      	<p class="count-text "> Distance </p>
					    </div>					    					  
               
 					</div>
          		</div>
        		</div>
			</header>
  			<section class="section mt-100 mb-100">
        		<div class="container">
        			<div class="row" style="text-align:center;">
	        			<!-- 显示Echarts图表highchart -->
						<div style="height:410px;min-height:100px;margin:0 auto;" id="sensor1"></div>						
            		</div>
            		
            		<hr class="colorgraph mt-100 mb-100">

            		<div class="row" style="text-align:center;">
	        			<!-- 显示Echarts图表highchart -->
						<div style="height:410px;min-height:100px;margin:0 auto;" id="sensor2"></div>						
            		</div>

            		<hr class="colorgraph mt-100 mb-100">

            		<div class="row" style="text-align:center;">
	        			<!-- 显示Echarts图表highchart -->
						<div style="height:410px;min-height:100px;margin:0 auto;" id="sensor3"></div>						
            		</div>
            		            		
            		
        		</div>
    		</section>   	
  
    		<footer class="footer text-center">
        		<div class="container">
            		<small>Follow me ,upvote me and resteem it. <br>
            			<a href = https://steemit.com/@cha0s0000>I am cha0s0000 on Steemit</a>
        			</small>
        		</div>
    		</footer>
		</div>
		

		<script src="js/front/dynamicNumber.js"></script>
		
		<script type="text/javascript">

		var temp = document.getElementById('count-number_temp');
		var humi = document.getElementById('count-number_humi');
		var light = document.getElementById('count-number_light');
		var voice = document.getElementById('count-number_voice');
		var airquality = document.getElementById('count-number_airQuality');
		var distance = document.getElementById('count-number_distance');
		var json_temp = 0;
		var json_humi = 0;
		var json_light = 0;
		var json_voice = 0;
		var json_airquality = 0;
		var json_distance = 0;
		setInterval(update,1000);   //每隔10s
		function update(){
		    var xht = new XMLHttpRequest();
		    xht.open('GET','sensorsData.php',true);
		    xht.onreadystatechange = function () {
		        if(xht.status == 200 && xht.readyState ==4){
		            var str = xht.responseText;
		            var json1 = JSON.parse(str);
		            // alert(json_temp);
		            json_temp = json1['temp'];
		            json_humi = json1['humi'];
	             	json_light = json1['light'];
		            json_voice = json1['voice'];
	             	json_airquality = json1['airquality'];
		            json_distance = json1['distance'];
		            temp.innerHTML = json_temp;
		            humi.innerHTML = json_humi;
		            light.innerHTML = json_light;
		            voice.innerHTML = json_voice;
		            airquality.innerHTML = json_airquality;
		            distance.innerHTML = json_distance;
		       }
		    };
		    xht.send();
		}
		Highcharts.setOptions({
		    global: {
		        useUTC: false
		    }
		});
		function activeLastPointToolip(chart) {
		    var points = chart.series[0].points;
		    chart.tooltip.refresh(points[points.length -1]);
		}
		// alert(json_temp);
		$('#sensor1').highcharts({
		    chart: {
		        type: 'spline',
		        animation: Highcharts.svg, // don't animate in old IE
		        marginRight: 10,
		        events: {
		            load: function () {

		                // set up the updating of the chart each second
		                var series_temp = this.series[0],
		               		series_humi = this.series[1],
		                    chart = this;
		                setInterval(function () {
		                    var x = (new Date()).getTime(), // current time
		                        y_temp = json_temp,
		                        y_humi = json_humi;
		                    // alert(y_temp);
		                    series_temp.addPoint([x, y_temp], true, true);
		                    series_humi.addPoint([x, y_humi], true, true);
		                    activeLastPointToolip(chart);
		                    // update();
		                }, 1000);
		            }
		        }
		    },
		    title: {
		        text: 'Temperature and humidity data graph chart'
		    },
		    credits: { 
				enabled: false //不显示LOGO 
			},
		    xAxis: {
		        type: 'datetime',
		        tickPixelInterval: 150
		    },
		    yAxis: {
		        title: {
		            text: 'value'
		        },
		        plotLines: [{
		            value: 0,
		            width: 1,
		            color: '#808080'
		        }]
		    },
		    tooltip: {
		        formatter: function () {
		            return '<b>' + this.series.name + '</b><br/>' +
		                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
		                Highcharts.numberFormat(this.y, 2);
		        }
		    },
		    legend: {
		        enabled: false
		    },
		    exporting: {
		        enabled: false
		    },
		    series: [
		    {
		        name: 'Temperature',
		        data: (function () {
		            // generate an array of random data
		            var data = [],
		                time = (new Date()).getTime(),
		                i;
		            for (i = -19; i <= 0; i += 1) {
		                data.push({
		                    x: time + i * 1000,
		                    y: Math.random()
		                });
		            }
		            return data;
		        }()),
	        	color:'#ff0100'
		    },
		     {
		        name: 'Humidity',
		        data: (function () {
		            // generate an array of random data
		            var data = [],
		                time = (new Date()).getTime(),
		                i;
		            for (i = -19; i <= 0; i += 1) {
		                data.push({
		                    x: time + i * 1000,
		                    y: Math.random()
		                });
		            }
		            return data;
		        }())
		    }]
		}, function(c) {
		    activeLastPointToolip(c)
		});

		$('#sensor2').highcharts({
		    chart: {
		        type: 'spline',
		        animation: Highcharts.svg, // don't animate in old IE
		        marginRight: 10,
		        events: {
		            load: function () {

		                // set up the updating of the chart each second
		                var series_temp = this.series[0],
		               		series_humi = this.series[1],
		                    chart = this;
		                setInterval(function () {
		                    var x = (new Date()).getTime(), // current time
		                        y_temp = json_light,
		                        y_humi = json_voice;
		                    // alert(y_temp);
		                    series_temp.addPoint([x, y_temp], true, true);
		                    series_humi.addPoint([x, y_humi], true, true);
		                    activeLastPointToolip(chart);
		                    // update();
		                }, 1000);
		            }
		        }
		    },
		    title: {
		        text: 'Light and voice data graph chart'
		    },
		    credits: { 
				enabled: false //不显示LOGO 
			},
		    xAxis: {
		        type: 'datetime',
		        tickPixelInterval: 150
		    },
		    yAxis: {
		        title: {
		            text: 'value'
		        },
		        plotLines: [{
		            value: 0,
		            width: 1,
		            color: '#808080'
		        }]
		    },
		    tooltip: {
		        formatter: function () {
		            return '<b>' + this.series.name + '</b><br/>' +
		                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
		                Highcharts.numberFormat(this.y, 2);
		        }
		    },
		    legend: {
		        enabled: false
		    },
		    exporting: {
		        enabled: false
		    },
		    series: [
		    {
		        name: 'Light',
		        data: (function () {
		            // generate an array of random data
		            var data = [],
		                time = (new Date()).getTime(),
		                i;
		            for (i = -19; i <= 0; i += 1) {
		                data.push({
		                    x: time + i * 1000,
		                    y: Math.random()
		                });
		            }
		            return data;
		        }()),
	        	color:'#006400'
		    },
		     {
		        name: 'Voice',
		        data: (function () {
		            // generate an array of random data
		            var data = [],
		                time = (new Date()).getTime(),
		                i;
		            for (i = -19; i <= 0; i += 1) {
		                data.push({
		                    x: time + i * 1000,
		                    y: Math.random()
		                });
		            }
		            return data;
		        }()),
	        	color:'#FF00FF'
		    },
		    ]
		}, function(c) {
		    activeLastPointToolip(c)
		});

		$('#sensor3').highcharts({
		    chart: {
		        type: 'spline',
		        animation: Highcharts.svg, // don't animate in old IE
		        marginRight: 10,
		        events: {
		            load: function () {

		                // set up the updating of the chart each second
		                var series_temp = this.series[0],
		               		series_humi = this.series[1],
		                    chart = this;
		                setInterval(function () {
		                    var x = (new Date()).getTime(), // current time
		                        y_temp = json_airquality,
		                        y_humi = json_distance;
		                    // alert(y_temp);
		                    series_temp.addPoint([x, y_temp], true, true);
		                    series_humi.addPoint([x, y_humi], true, true);
		                    activeLastPointToolip(chart);
		                    // update();
		                }, 1000);
		            }
		        }
		    },
		    title: {
		        text: 'Airquality and distance data graph chart'
		    },
		    credits: { 
				enabled: false //不显示LOGO 
			},
		    xAxis: {
		        type: 'datetime',
		        tickPixelInterval: 150
		    },
		    yAxis: {
		        title: {
		            text: 'value'
		        },
		        plotLines: [{
		            value: 0,
		            width: 1,
		            color: '#808080'
		        }]
		    },
		    tooltip: {
		        formatter: function () {
		            return '<b>' + this.series.name + '</b><br/>' +
		                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
		                Highcharts.numberFormat(this.y, 2);
		        }
		    },
		    legend: {
		        enabled: false
		    },
		    exporting: {
		        enabled: false
		    },
		    series: [
		    {
		        name: 'Airquality',
		        data: (function () {
		            // generate an array of random data
		            var data = [],
		                time = (new Date()).getTime(),
		                i;
		            for (i = -19; i <= 0; i += 1) {
		                data.push({
		                    x: time + i * 1000,
		                    y: Math.random()
		                });
		            }
		            return data;
		        }())
		    },
		     {
		        name: 'Distance',
		        data: (function () {
		            // generate an array of random data
		            var data = [],
		                time = (new Date()).getTime(),
		                i;
		            for (i = -19; i <= 0; i += 1) {
		                data.push({
		                    x: time + i * 1000,
		                    y: Math.random()
		                });
		            }
		            return data;
		        }())
		    },
		    ]
		}, function(c) {
		    activeLastPointToolip(c)
		});
		
    </script>
		
	</body>
</html>