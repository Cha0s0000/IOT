$(document).ready(function() {
	
	$('a[title]').tooltip();
	
	/* 限制描述段落的字数不超过500字 */
    $('#characterLeft').text('500字以内');
    $('#suggestion').keydown(function () {
        var max = 500;
        var len = $(this).val().length;
        if (len >= max) {
            $('#characterLeft').text('最多只能输入500字');	//输入字数超过500时，显示警告信息
            $('#characterLeft').addClass('red');		//将警告信息置为红色
            $('#btnSubmit').addClass('disabled');       //字数超过限制时不允许提交     
        } 
        else {
            var ch = max - len;
            $('#characterLeft').text(ch + ' 字剩余');
            $('#btnSubmit').removeClass('disabled');
            $('#characterLeft').removeClass('red');            
        }
    });
	
	//表单检测
    $('#defaultForm').bootstrapValidator({
//        live: 'disabled',		//输入不合法时禁止点击提交按钮
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        //检查组件输入是否合法
		suggestion: {
			message: '输入不能为空~',
			validators: { 
				regexp: {
					regexp: /^[^\s].*/,	/* 必须以非空白符号开头 */
					message: '输入不合法呢，再检查一下吧~'
				},
				
				stringLength: {
					min: 0,
					max: 500,
					message: '请修改后重新提交！'
					}
          }
      },	 			
  
        }
    }); 
});