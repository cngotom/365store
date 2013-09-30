//第4种写法  
var LoginValid={   
   "cgi_usernameValid":"user.php?act=is_registered",
   "cgi_emailValid":"user.php?act=check_email",
   "init":function(){
		LoginValid.initLoginForm();
		LoginValid.initRegisterForm();
   },
   "initLoginForm":function(){
	  	$.formValidator.initConfig({formID:"tabs-1",debug:true,submitOnce:true,
			onError:function(msg,obj,errorlist){
				alert(msg);
			},
			submitAfterAjaxPrompt : '有数据正在异步验证，请稍等...'
		}); 	
		<!--登录-->
		$("#loginpassword").formValidator({onShow:"请输入密码",onFocus:"至少1个长度",onCorrect:"密码合法"})
						   .inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"密码两边不能有空符号"},onError:"密码不能为空,请确认"});
	
		$("#loginEmail").formValidator({onShow:"请输入邮箱",onFocus:"邮箱6-100个字符",onCorrect:"格式正确",defaultValue:""})
						.inputValidator({min:6,max:100,onError:"1你输入的邮箱长度非法,请确认"})
						.regexValidator({regExp:"^([\\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$",onError:"你输入的邮箱格式不正确"});
						
		$("#loginbtn").click(function(){
			if($("#tabs-1 .onCorrect").length==2){
				postdata = {
				    'username' : $("#loginEmail").val(), 
					'password' : $("#loginpassword").val(),
					'act' : 'ajax_login'
				}				
				$.post("user.php?rnd=" + Math.random(),postdata,function(data){   
						var data = $.parseJSON(data);
						if( data.error)
							alert(data.content);
						else{
                                                        if(GUserInfo.runCode)
                                                         {
                                                             eval(GUserInfo.runCode);
                                                             GUserInfo.runCode = null;
                                                         }
                                                         else
                                                            location.reload(true);
						}
				});
				return;
			}
			
			if($("#tabs-1 .onShow").length==2){
				
			}
		});		
   },
   "initRegisterForm":function(){
	  	$.formValidator.initConfig({formID:"tabs-2",debug:true,submitOnce:true,
			onError:function(msg,obj,errorlist){
				alert(msg);
			},
			submitAfterAjaxPrompt : '有数据正在异步验证，请稍等...'
		});
		

		$("#email").formValidator({onShow:"请输入email地址",onFocus:"邮箱6-100个字",onCorrect:"该邮箱可以注册"}).inputValidator({min:5,max:20,onError:"email长度非法"})
			.regexValidator({regExp:"^([\\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$",onError:"email格式不正确"})	
			.ajaxValidator({	
			dataType : "json",	
			async : true,
			url : LoginValid.cgi_emailValid,
			success : function(data){
				if(data.code==0){
					return true;
				}
				return false;
			},
			buttons: $("#button"),
			error: function(jqXHR, textStatus, errorThrown){alert("服务器没有返回数据，可能服务器忙，请重试"+errorThrown);},
			onError : "该email已经被占用",
			onWait : "合法性校验中，请稍候..."
		}).defaultPassed();;
						   	
							
		$("#username").formValidator({onShow:"请输入用户昵称",onFocus:"至少3个以上长度",onCorrect:"昵称合法"})
			.inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"用户名两边不能有空符号"},onError:"用户名不能为空,请确认"})
			.ajaxValidator({	
			dataType : "json",	
			async : true,
			url : LoginValid.cgi_usernameValid,
			success : function(data){
				if(data.code==0){
					return true;
				}
				return false;
			},
			buttons: $("#button"),
			error: function(jqXHR, textStatus, errorThrown){alert("服务器没有返回数据，可能服务器忙，请重试"+errorThrown);},
			onError : "该昵称已经被占用",
			onWait : "合法性校验中，请稍候..."
		}).defaultPassed();;
		
		$("#password1").formValidator({onShow:"请输入密码",onFocus:"至少1个长度",onCorrect:"密码合法"})
					   .inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"密码两边不能有空符号"},onError:"密码不能为空,请确认"});
	
		$("#password2").formValidator({onShow:"输再次输入密码",onFocus:"至少1个长度",onCorrect:"密码一致"})
					   .inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"重复密码两边不能有空符号"},onError:"重复密码不能为空,请确认"})
					   .compareValidator({desID:"password1",operateor:"=",onError:"2次密码不一致,请确认"});			
					   
		$("#regBtn").click(function(){
			//登录成功提交POST数据
			if($("#tabs-2 .onCorrect").length==4 && $("#agreement").attr("checked")=="checked"){				
					postdata = {
					    'username' : $("#username").val(), 
						'email'  : $("#email").val(), 
						'password' : $("#password1").val(),
						'password2' : $("#password2").val(),
						'act' : 'ajax_register'
					}
					
					$.post("user.php?rnd=" + Math.random(),postdata,function(data){    
						var data = $.parseJSON(data);
						if( data.error  )
							alert(data.content);
						else
						{
							    if(GUserInfo.runCode)
                                                         {
                                                             eval(GUserInfo.runCode);
                                                             GUserInfo.runCode = null;
                                                         }
                                                         else
                                                            location.reload(true);
						}
					});					
				return;
			}
		});						   	  
   }
};  
