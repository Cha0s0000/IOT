	$(document).ready(function(){ 
	    
	 	/* 输入检查 */
		$('#recordSearchForm').bootstrapValidator({
	//      live: 'disabled',		//输入不合法时禁止点击提交按钮
			message: 'This value is not valid',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
	      	//检查各组件输入是否合法
	      	
	      		//检查台站选择
				stations: {
					validators: {
						notEmpty: {
	                        message: '请至少选择一个台站！'
	                  }
	              }
	          },
	           
	          	//检查气象要素选择
	           	elements: {
					validators: {
						notEmpty: {
	                        message: '请至少选择一个气象要素！'
	                  }
	              }
	          },
	      
				//检查日期输入
				startTime: {
					validators: { 
						regexp: {
							/* YYYY-MM-DD HH:MM:SS （0[1-9]表示匹配数字01～09；以此类推） */
							regexp: /^(\d{4})-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3[0-1]) (0[0-9]|1[0-9]|2[0-4]):([0-5][0-9]):([0-5][0-9])$/,
							message: '请输入正确的日期格式！'
	 					}, 
	              }
	          },
	          
				endTime: {
					validators: { 
						regexp: {
							/* YYYY-MM-DD HH:MM:SS （0[1-9]表示匹配数字01～09；以此类推） */
							regexp: /^(\d{4})-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3[0-1]) (0[0-9]|1[0-9]|2[0-4]):([0-5][0-9]):([0-5][0-9])$/,
							message: '请输入正确的日期格式！'
	 					}, 
	              }
	          },
			}
		}); 
	     
	});