<?php
	
	define("TOKEN","weixin");
	if(!isset($_GET['echostr']))
	{
		//调用响应消息函数
		responseMsg();
	}
	else
	{
		//实现网址接入，调用验证消息函数	
		valid();
	}

	//验证消息
	function valid(){
		if(checkSignature())
		{
			$echostr = $_GET["echostr"];
             header('content-type:text');
			echo $echostr;
			exit;
		}
		else
		{
			echo "error";
			exit;
		}
	}

	//检查签名
	function checkSignature()
	{
		//获取微信服务器GET请求的4个参数
		$signature = $_GET['signature'];
		$timestamp = $_GET['timestamp'];
		$nonce = $_GET['nonce'];

		//定义一个数组，存储其中3个参数，分别是timestamp，nonce和token
		$tempArr = array($nonce,$timestamp,TOKEN);

		//进行排序
		sort($tempArr,SORT_STRING);

		//将数组转换成字符串

		$tmpStr = implode($tempArr);

		//进行sha1加密算法
		$tmpStr = sha1($tmpStr);

		//判断请求是否来自微信服务器，对比$tmpStr和$signature
		if($tmpStr == $signature)
		{
			return true;
		}
		else
		{
			return false;
		}
	}	

	//响应消息
	function responseMsg(){
		//根据用户传过来的消息类型进行不同的响应
		//1、接收微信	服务器POST过来的数据，XML数据包

		$postData = $GLOBALS[HTTP_RAW_POST_DATA];

		if(!$postData)
		{
			echo  "error";
			exit();
		}

		//2、解析XML数据包

	 	$object = simplexml_load_string($postData,"SimpleXMLElement",LIBXML_NOCDATA);

	 	//获取消息类型
	 	$MsgType = $object->MsgType;
        
        $content =$object->Content;
        
        
	 	switch ($MsgType) {
	 		case 'event':
	 			receiveEvent($object);	
	 			break;	
	 		case 'text':
	 				
	 				 echo receiveText($object);
	 				 
        			
	 			break;
	 		case 'image':
	 		        	//接收图片消息
	 		        	echo receiveImage($object);	
	 			break;
	 		case 'location':
	 		        	//接收地理位置消息
	 		        	echo receiveLocation($object);	
	 			break;	
	 		case 'voice':
	 				//接收语音消息
	 				echo receiveVoice($object);
	 			break; 
	 		case 'video':
	 				//接收视频消息
	 				echo receiveVideo($object);
	 			break;
	 		case  'link':
	 				//接收链接消息
	 				echo receiveLink($object);
	 				break;
	 		default: 
	 			break;
	 	}
       
        
	}

	//接收事件推送
	function receiveEvent($obj){
		switch ($obj->Event) {
			//关注事件
			case 'subscribe':
				//扫描带参数的二维码，用户未关注时，进行关注后的事件
				if(!empty($obj->EventKey)){
					//做相关处理
				}
				//回复欢迎文字消息
            	//$msgType = "text";
              $text = "欢迎使用";
				// echo replyText($obj,"欢迎！");
				echo replyText($obj,$text);

				break;
			//取消关注事件
			case 'unsubscribe':
				break;
			//扫描带参数的二维码，用户已关注时，进行关注后的事件
			case 'SCAN':
				//做相关的处理
				break;
			//自定义菜单事件
			case 'CLICK':
				//
				switch ($obj->EventKey) {
					case 'GN':
						echo replyText($obj,"！");
						break;
					default:
						echo replyText($obj,"！");
						break;
				}
				break;
		}	
	}	
																			
																				
	function receiveText($obj){
        $content = $obj ->Content;
    
        if (strstr($content, "1ON")) {
        $con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS); 
        $dati = date("h:i:sa");
        mysql_select_db("app_steemitcha0s0000", $con);//修改数据库名
 
        $sql ="UPDATE switch SET timestamp='$dati',state = '1'
        WHERE ID = '1'";//修改开关状态值
             if(!mysql_query($sql,$con))
             {
            	die('Error: ' . mysql_error());
       		 }else
             {
                mysql_close($con);
                $reply = "I am going to switch on the LED 1";
             }
        }
        																				
        
        else  if (strstr($content, "1OFF")) {
        $con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS); 
        $dati = date("h:i:sa");
        mysql_select_db("app_steemitcha0s0000", $con);//修改数据库名
 
        $sql ="UPDATE switch SET timestamp='$dati',state = '2'
        WHERE ID = '1'";//修改开关状态值
             if(!mysql_query($sql,$con))
             {
            	die('Error: ' . mysql_error());
       		 }else
             {
                mysql_close($con);
                $reply = "I am going to switch off the LED 1";
             }
        }
        
        else  if (strstr($content, "2ON")) {
        $con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS); 
        $dati = date("h:i:sa");
        mysql_select_db("app_steemitcha0s0000", $con);//修改数据库名
 
        $sql ="UPDATE switch SET timestamp='$dati',state = '3'
        WHERE ID = '1'";//修改开关状态值
             if(!mysql_query($sql,$con))
             {
            	die('Error: ' . mysql_error());
       		 }else
             {
                mysql_close($con);
                $reply = "I am going to switch on the LED 2";
             }
        }
        
        else  if (strstr($content, "2OFF")) {
        $con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS); 
        $dati = date("h:i:sa");
        mysql_select_db("app_steemitcha0s0000", $con);//修改数据库名
 
        $sql ="UPDATE switch SET timestamp='$dati',state = '4'
        WHERE ID = '1'";//修改开关状态值
             if(!mysql_query($sql,$con))
             {
            	die('Error: ' . mysql_error());
       		 }else
             {
                mysql_close($con);
                $reply = "I am going to switch off the LED 2";
             }
        }
     
        else  if (strstr($content, "3ON")) {
        $con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS); 
        $dati = date("h:i:sa");
        mysql_select_db("app_steemitcha0s0000", $con);//修改数据库名
 
        $sql ="UPDATE switch SET timestamp='$dati',state = '5'
        WHERE ID = '1'";//修改开关状态值
             if(!mysql_query($sql,$con))
             {
            	die('Error: ' . mysql_error());
       		 }else
             {
                mysql_close($con);
                $reply = "I am going to switch on the LED 3";
             }
        }
        
        else  if (strstr($content, "3OFF")) {
        $con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS); 
        $dati = date("h:i:sa");
        mysql_select_db("app_steemitcha0s0000", $con);//修改数据库名
 
        $sql ="UPDATE switch SET timestamp='$dati',state = '6'
        WHERE ID = '1'";//修改开关状态值
             if(!mysql_query($sql,$con))
             {
            	die('Error: ' . mysql_error());
       		 }else
             {
                mysql_close($con);
                $reply = "I am going to switch off the LED 3";
             }
        }
        
        else  if (strstr($content, "4ON")) {
        $con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS); 
        $dati = date("h:i:sa");
        mysql_select_db("app_steemitcha0s0000", $con);//修改数据库名
 
        $sql ="UPDATE switch SET timestamp='$dati',state = '7'
        WHERE ID = '1'";//修改开关状态值
             if(!mysql_query($sql,$con))
             {
            	die('Error: ' . mysql_error());
       		 }else
             {
                mysql_close($con);
                $reply = "I am going to switch on the LED 4";
             }
        }
        
        else  if (strstr($content, "4OFF")) {
        $con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS); 
        $dati = date("h:i:sa");
        mysql_select_db("app_steemitcha0s0000", $con);//修改数据库名
 
        $sql ="UPDATE switch SET timestamp='$dati',state = '8'
        WHERE ID = '1'";//修改开关状态值
             if(!mysql_query($sql,$con))
             {
            	die('Error: ' . mysql_error());
       		 }else
             {
                mysql_close($con);
                $reply = "I am going to switch off the LED 4";
             }
        }
        
        
        else
        {
        	$url = "http://www.tuling123.com/openapi/api?key=37d8f412ab74af9add0c5a3ce45715e0&info=".$content;
            $tulingArr = https_request($url);
            $rec = $tulingArr['text'];
            //$check =checkID($obj);
         	//$reply = $rec;
            $reply = "sorry，没有此功能！\n机器人回复:{$rec}";
        }
		
        //获取文本消息的内容
        //$content = $obj->Content;
		//发送文本消息
		return replyText($obj,$reply);   
         
	}

	//接收图片消息
	function receiveImage($obj)
	{
		//获取图片消息的内容
		$imageArr = array(
			"PicUrl"=>$obj->PicUrl,
			"MediaId"=>$obj->MediaId
			);
		//发送图片消息
		return replyImage($obj,$imageArr);
	}

	//接收地理位置消息
	function receiveLocation($obj)
	{
		//获取地理位置消息的内容
		$locationArr = array(
				"Location_X"=>$obj->Location_X,
				"Location_Y"=>"地址位置经度：".$obj->Location_Y,
				"Label"=>$obj->Label
			);
		//回复文本消息
		return replyText($obj,$locationArr['Location_Y']);	
	}

	//接收语言消息
	
	function receiveVoice($obj){
		//获取语言消息内容
		$voiceArr = array(
				"MediaId"=>$obj->MediaId,
				"Format"=>$obj->Format
			);
		//回复语言消息
		return replyVoice($obj,$voiceArr);
	}

	//接收视频消息
	function receiveVideo($obj){
		//获取视频消息的内容
		$videoArr = array(
				"MediaId"=>$obj->MediaId 
			);
		//回复视频消息
		return replyVideo($obj,$videoArr);			
	}

	//接收链接消息
	function receiveLink($obj)
	{
		//接收链接消息的内容
		$linkArr = array(
				"Title"=>$obj->Title,
				"Description"=>$obj->Description,
				"Url"=>$obj->Url
			);
		//回复文本消息
		return replyText($obj,"你发过来的链接地址是{$linkArr['Url']}");
	}

	//发送文本消息
	function replyText($obj,$content){
		$replyXml = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[text]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					</xml>";
	        //返回一个进行xml数据包

		$resultStr = sprintf($replyXml,$obj->FromUserName,$obj->ToUserName,time(),$content);
	        return $resultStr;		
	}

	//发送图片消息
	function replyImage($obj,$imageArr){
		$replyXml = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[image]]></MsgType>
					<Image>
					<MediaId><![CDATA[%s]]></MediaId>
					</Image>
					</xml>";
	        //返回一个进行xml数据包

		$resultStr = sprintf($replyXml,$obj->FromUserName,$obj->ToUserName,time(),$imageArr['MediaId']);
	        return $resultStr;			
	}

	//回复语音消息
	function replyVoice($obj,$voiceArr)
	{
		$replyXml = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[voice]]></MsgType>
					<Voice>
					<MediaId><![CDATA[%s]]></MediaId>
					</Voice>
					</xml>";
	        //返回一个进行xml数据包

		$resultStr = sprintf($replyXml,$obj->FromUserName,$obj->ToUserName,time(),$voiceArr['MediaId']);
	        return $resultStr;		
	}

	//回复视频消息
	function replyVideo($obj,$videoArr){
		$replyXml = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[video]]></MsgType>
					<Video>
					<MediaId><![CDATA[%s]]></MediaId>
					</Video> 
					</xml>";
	        //返回一个进行xml数据包

		$resultStr = sprintf($replyXml,$obj->FromUserName,$obj->ToUserName,time(),$videoArr['MediaId']);
	        return $resultStr;
	}

	//回复音乐消息
	function  replyMusic($obj,$musicArr)
	{
		$replyXml = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[music]]></MsgType>
					<Music>
					<Title><![CDATA[%s]]></Title>
					<Description><![CDATA[%s]]></Description>
					<MusicUrl><![CDATA[%s]]></MusicUrl>
					<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
					<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
					</Music>
					</xml>";
	        //返回一个进行xml数据包

		$resultStr = sprintf($replyXml,$obj->FromUserName,$obj->ToUserName,time(),$musicArr['Title'],$musicArr['Description'],$musicArr['MusicUrl'],$musicArr['HQMusicUrl'],$musicArr['ThumbMediaId']);
	        return $resultStr;		
	}

	//回复图文消息
	function replyNews($obj,$newsArr){
		$itemStr = "";
		if(is_array($newsArr))
		{
			foreach($newsArr as $item)
			{
				$itemXml ="<item>
					<Title><![CDATA[%s]]></Title> 
					<Description><![CDATA[%s]]></Description>
					<PicUrl><![CDATA[%s]]></PicUrl>
					<Url><![CDATA[%s]]></Url>
					</item>";
				$itemStr .= sprintf($itemXml,$item['Title'],$item['Description'],$item['PicUrl'],$item['Url']);
			}

		}

		$replyXml = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>%s</ArticleCount>
					<Articles>
						{$itemStr}
					</Articles>
					</xml> ";
	        //返回一个进行xml数据包

		$resultStr = sprintf($replyXml,$obj->FromUserName,$obj->ToUserName,time(),count($newsArr));
	        return $resultStr;			
	}



   //get和post请求
	function https_request($url,$data = null)
		{
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			if(!empty($data))
			{
				curl_setopt($ch,CURLOPT_POST,1);//模拟POST
				curl_setopt($ch,CURLOPT_POSTFIELDS,$data);//POST内容
			}
			$outopt = curl_exec($ch);
			curl_close($ch);
			$outopt = json_decode($outopt,true);
			return $outopt;
		}																												