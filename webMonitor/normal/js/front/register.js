//检查用户名是否已经被注册
function checkUserName() {
	var xmlHttp;
	var username = escape(document.getElementById("username").value);
	
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlHttp=new XMLHttpRequest();	//创建 XMLHttpRequest对象
	}
	else {
		// code for IE6, IE5
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4) {
			//xmlHttp.readyState == 4	——	finished downloading response
			
			if (xmlHttp.status == 200) {
				//xmlHttp.status == 200		——	服务器反馈正常			
				
				//去除接收到的字符串里的空白字符
				var msg = xmlHttp.responseText.replace(/(^\s*)|(\s*$)/g, "");
				parseUserNameStatus(msg);
				
			}
			else if (xmlHttp.status == 404){
				alert("出错了☹   （错误代码：404 Not Found），请把错误状况告诉我们吧！"); 
				location.href="connectUs.jsp";   
				return;
			}
			else if (xmlHttp.status == 403) {  
				alert("出错了☹   （错误代码：403 Forbidden），请把错误状况告诉我们吧！"); 
				location.href="connectUs.jsp";   
				return;
	        }
			else {
				alert("出错了☹   （错误代码：" + request.status + "），请把错误状况告诉我们吧！"); 
				location.href="connectUs.jsp";  
				return;
			}  
		} 		    						
	}
	
	xmlHttp.open("GET", "CheckRegisterUserNameServlet?username=" + username, true);		//true表示异步处理
	xmlHttp.send(null);
}

//解析服务器返回的关于用户名是否已被注册的信息
function parseUserNameStatus(msg) {
	if (msg == "userNameValid") {
		document.getElementById("userNameCheckResult").innerHTML="";
		$("#btnSubmit").removeClass("disabled");	//禁止点击按钮（视觉上置灰）
		$("#btnSubmit").prop("disabled", false);	//禁止点击按钮（视觉上置灰、该按钮对应功能也禁止实现）
	}
	else if (msg == "userNameInvalid") {
		document.getElementById("userNameCheckResult").innerHTML="<font color='red'><small>该用户名已经被使用了 ●︿●，请换一个吧！</small></font>";
		$("#btnSubmit").addClass("disabled");
		$("#btnSubmit").prop("disabled", true);
	}
	else if (msg == null || msg == "") {
		//什么都不做
	}
	else {
		alert("出错了☹ （错误原因：用户名可用性信息解析错误），请把错误状况告诉我们吧！"); 
		location.href="connectUs.jsp";  
		return;
	}
} 

//检查验证码是否输入正确
function checkVerifyCode() {
	var xmlHttp;
	var verifyCode = escape(document.getElementById("verifyCodeInput").value);
	
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlHttp=new XMLHttpRequest();	//创建 XMLHttpRequest对象
	}
	else {
		// code for IE6, IE5
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}	
	
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4) {
			//xmlHttp.readyState == 4	——	finished downloading response
			
			if (xmlHttp.status == 200) {
				//xmlHttp.status == 200		——	服务器反馈正常			
				
				//去除接收到的字符串里的空白字符
				var msg = xmlHttp.responseText.replace(/(^\s*)|(\s*$)/g, "");
				parseVerifyCodeStatus(msg);
				
			}
			else if (xmlHttp.status == 404){
				alert("出错了☹   （错误代码：404 Not Found），请把错误状况告诉我们吧！"); 
				location.href="connectUs.jsp";   
				return;
			}
			else if (xmlHttp.status == 403) {  
				alert("出错了☹   （错误代码：403 Forbidden），请把错误状况告诉我们吧！"); 
				location.href="connectUs.jsp";   
				return;
	        }
			else {
				alert("出错了☹   （错误代码：" + request.status + "），请把错误状况告诉我们吧！"); 
				location.href="connectUs.jsp";  
				return;
			}  
		} 		    				
	}
	
	xmlHttp.open("GET", "CheckVerifyCodeServlet?verifyCode=" + verifyCode, true);		//true表示异步处理
	xmlHttp.send(null);

}

//解析服务器返回的验证码是否输入正确的信息
function parseVerifyCodeStatus(msg) {
	if (msg == "verifyCodeValid") {
		document.getElementById("verifyCodeCheckResult").innerHTML="";
		$("#btnSubmit").removeClass("disabled");	//禁止点击按钮（视觉上置灰）
		$("#btnSubmit").prop("disabled", false);	//禁止点击按钮（视觉上置灰、该按钮对应功能也禁止实现）
	}
	else if (msg == "verifyCodeInvalid") {
		document.getElementById("verifyCodeCheckResult").innerHTML="<font color='red'><small>验证码输入错误，请重新输入！</small></font>";
		$("#btnSubmit").addClass("disabled");
		$("#btnSubmit").prop("disabled", true);
	}
	else if (msg == null || msg == "") {
		//什么都不做
	}
	else {
		alert("出错了☹ （错误原因：验证码正确性信息解析错误），请把错误状况告诉我们吧！"); 
		location.href="connectUs.jsp";  
		return;
	}
} 

//点击更换验证码图片
function refresh(obj){
    obj.src = "VerifyCodeServlet?" + Math.random();
}  

function mouseover(obj){
   obj.style.cursor = "pointer";
}

$(document).ready(function() {
	
    $('#defaultForm').bootstrapValidator({
//        live: 'disabled',		//输入不合法时禁止点击提交按钮
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        //检查各组件输入是否合法
        
 			//检查用户名
            username: {
                message: '用户名不合法',
                validators: {
                    notEmpty: {
                        message: '用户名不能为空，请重新输入！'
                    },
                    stringLength: {
                        min: 5,
                        max: 16,
                        message: '用户名长度不符合要求，请重新输入！<br>用户名应由5~16个合法字符组成。'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: '用户名不合法，请重新输入！<br>用户名只能包含字母（半角）、数字（半角）、下划线（英文/半角）。'
                    },
                    different: {
                        field: 'password',
                        message: '用户名跟密码不能相同，请重新输入！'
                    }
                }
            },  
            
            //检查密码
            password: {
                validators: {
                    notEmpty: {
                        message: '密码不能为空，请重新输入！'
                    },
                    stringLength: {
                        min: 6,
                        max: 16,
                        message: '密码长度不符合要求，请重新输入！<br>（密码为6~16位任意字符组成。）'
                    },
                    identical: {
                        field: 'confirmPassword',
                        message: '两次输入的密码不一致，请重新输入！'
                    },
                    different: {
                        field: 'username',
                        message: '密码跟用户名不能相同，请重新输入！'
                    } 
                }
            }, 
            
           	//检查确认密码
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: '确认密码不能为空，请重新输入！'
                    },
                    identical: {
                        field: 'password',
                        message: '两次输入的密码不一致，请重新输入！'
                    },
                    different: {
                        field: 'username',
                        message: '密码跟用户名不能相同，请重新输入！'
                    }
                }
            }, 		            
            
            //检查email
            email: {
                validators: {
                	notEmpty: {
	                    message: '邮箱地址不能为空，请重新输入！'
	                },
                    emailAddress: {
                        message: '请输入正确的邮箱地址！'
                    }
                }
            },

            //检查用户协议
            agreement: {
                validators: {
                    notEmpty: {
                        message: '请认真阅读并同意用户协议！'
                    }
                }
            },
 			
            //检查验证码是否输入
	            verifyCodeInput: {
                validators: {
                    notEmpty: {
                        message: '请输入验证码！'
                    }
                }
            } 

        }
    }); 			    
});