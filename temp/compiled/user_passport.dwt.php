<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
<link href="themes/365chi/user_center.css" rel="stylesheet" type="text/css" />

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,user.js,transport.js')); ?>


<link rel="stylesheet" type="text/css" href="/js/jquery-ui.css"/>


<style>
.ui-dialog-titlebar-close{
	background-image:url(lm_window_close.png);
	background-repeat:no-repeat;
	margin-top:10px;
}

.p_item{
	height:35px;
}
.onShow{
	padding-top:1px;
	padding-bottom:1px;
	padding-left:25px;
    background: url("/jsdemo/list/images/onShow.gif") no-repeat scroll 0 -4px transparent;
}
.onError {
	padding-top:1px;
	padding-bottom:1px;	
    background: url("/jsdemo/list/images/onError.gif") no-repeat scroll 0 -4px #FFF2E9;
    font-size: 12px;
    line-height: 22px;
    padding-left: 25px;
    vertical-align: middle;
    color:red;
}
.onFocus {
	padding-top:1px;
	padding-bottom:1px;	
	background: url("/jsdemo/list/images/onFocus.gif") no-repeat scroll 0 -4px #E9F0FF;
	font-size: 12px;
	line-height: 22px;
	padding-left: 25px;
	vertical-align: middle;
}
.onCorrect {
	padding-top:1px;
	padding-bottom:1px;	
	background: url("/jsdemo/list/images/onCorrect.gif") no-repeat scroll 0 -4px #E9F0FF;
	font-size: 12px;
	line-height: 22px;
	padding-left: 25px;
	vertical-align: middle;
}
.w {
    margin: 0 auto;
    padding: 10px 0;
    width: 980px;
}
#entry .mt {
    background: url("/jsdemo/list/tit_regist.jpg") repeat-x scroll 0 -35px #D1D1D1;
    height: 33px;
    margin: 0;
}
.m, .mt, .mc, .mb {
    overflow: hidden;
}
#entry .mt h2 {
    
    float: left;
    height: 33px;
    line-height: 33px;
    padding-left: 15px;
    margin: 0;
    padding: 0;	
}
h2 {
    font-size: 14px;
}
#entry .mt b {
    
    float: right;
    height: 33px;
    width: 10px;
    margin: 0;
    padding: 0;	
}
#entry .mt span {
    float: right;
    height: 33px;
    line-height: 33px;
    text-align: right;
}
#tabs-1{
	border:0;
	border-right:solid 1px #EEE;
    width:500px;
    float:left;
    margin-left:30px;	
}
#guide{
	width:400px;float:right;
}
#guide h5{
	text-align:left;
	color:black;
    background-color: #FFF;
	margin-bottom:20px;
}
a.btn_grey2 {
	/* background: url("themes/365chi/images/bg/btn1.png") repeat-x scroll 0 0 transparent;*/
     background-color: #52c14d;
    color: white;
    display: inline-block;
    font-size: 16px;
    font-weight: bold;
    height: 30px;
    line-height: 30px;
    text-align: center;
    width: 126px;	
	margin-top:45px;
}
#regbtn2{
    background: url("http://img04.taobaocdn.com/tps/i4/T1dDmLXc4bXXXXXXXX-177-151.png") no-repeat scroll 0 0 transparent;
    border: 0 none;
    cursor: pointer;
    margin-right: 13px;
    text-indent: -23556px;	
	height:30px;
}
</style>


<script type="text/javascript">
//第4种写法  
var LoginValid={   
   "init":function(){
		LoginValid.initLoginForm();
		LoginValid.initRegisterForm();
		LoginValid.initGetPasswordForm();
   },
   "initLoginForm":function(){
	  	$.formValidator.initConfig({formID:"tabs-1",debug:true,submitOnce:true,
			onError:function(msg,obj,errorlist){
				alert(msg);
			},
			submitAfterAjaxPrompt : '有数据正在异步验证，请稍等...'
		}); 	
		
		$("#loginpassword").formValidator({onShow:"请输入密码",onFocus:"至少1个长度",onCorrect:" "})
						   .inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"密码两边不能有空符号"},onError:"密码不能为空,请确认"});
	
		$("#loginEmail").formValidator({onShow:"请输入邮箱",onFocus:"邮箱6-100个字符",onCorrect:" ",defaultValue:""})
						.inputValidator({min:6,max:100,onError:"你输入的邮箱长度非法,请确认"})
						.regexValidator({regExp:"^([\\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$",onError:"你输入的邮箱格式不正确"});
						
		$("#loginbtn").click(function(){
			if($("#tabs-1 .onCorrect").length==2){
				postdata = {
				    'username' : $("#loginEmail").val(), 
					'password' : $("#loginpassword").val(),
					'act' : 'ajax_login'
				}				
				$.post("/user.php?rnd=" + Math.random(),postdata,function(data){   
						var data = $.parseJSON(data);
						if( data.error)
							alert(data.content);
						else{
							window.location.href='/';
						}
				});
				return;
			}
		});	
		
		$("#btnRegisterNew").click(function(){
			window.location.href='/user.php?act=register';
		});
   },
   "initRegisterForm":function(){
	  	$.formValidator.initConfig({formID:"tabs-2",debug:true,submitOnce:true,
			onError:function(msg,obj,errorlist){
				alert(msg);
			},
			submitAfterAjaxPrompt : '有数据正在异步验证，请稍等...'
		});
		

		$("#email").formValidator({onShow:"输入有效邮箱地址并成功激活，可用此邮箱做为登录账号及找回密码",onFocus:"邮箱6-100个字",onCorrect:"该邮箱可以注册"}).inputValidator({min:5,max:100,onError:"email长度非法"})
		.regexValidator({regExp:"^([\\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$",onError:"email格式不正确"})	
		.ajaxValidator({	
			dataType : "json",	
			async : true,
			url : "user.php?act=check_email",
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
		});
					   	
						
		$("#username").formValidator({onShow:"4－20位字符，以英文字母开头可包含、数字或\"_\"",onFocus:"至少3个以上长度",onCorrect:"昵称合法"})
			.inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"用户名两边不能有空符号"},onError:"用户名不能为空,请确认"})
			.ajaxValidator({	
			dataType : "json",	
			async : true,
			url : "user.php?act=is_registered",
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
		});
		
		$("#password1").formValidator({onShow:"6－20位字符，可由大小写英文、数字或符号组成",onFocus:"至少1个长度",onCorrect:"密码合法"})
					   .inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"密码两边不能有空符号"},onError:"密码不能为空,请确认"});
	
		$("#password2").formValidator({onShow:"再次输入密码",onFocus:"至少1个长度",onCorrect:"密码一致"})
					   .inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"重复密码两边不能有空符号"},onError:"重复密码不能为空,请确认"})
					   .compareValidator({desID:"password1",operateor:"=",onError:"2次密码不一致,请确认"});					
						   
		$("#regbtn2").click(function(){
                        if($(".form2 .onCorrect").length==4){	
                            $('.form2').submit();
                        }
                        return;
			//登录成功提交POST数据
			if($(".form2 .onCorrect").length==4){				
					postdata = {
					    'username' : $("#username").val(), 
						'email'  : $("#email").val(), 
						'password' : $("#password1").val(),
						'password2' : $("#password2").val(),
						'act' : 'ajax_register'
					}
					
					$.post("/user.php?rnd=" + Math.random(),postdata,function(data){    					
						var data = $.parseJSON(data);
						if( data.error  )
							alert(data.content);
						else
						{
							alert("恭喜您注册成功！");
							window.location.href='/';
						}
					});					
				return;
			}
		});						   	  
   },
   "initGetPasswordForm":function(){
	  	$.formValidator.initConfig({formID:"formFindPassword",debug:true,submitOnce:true,
			onError:function(msg,obj,errorlist){
				alert(msg);
			},
			submitAfterAjaxPrompt : '有数据正在异步验证，请稍等...'
		});
	  	
		$("#email").formValidator({onShow:"输入有效邮箱地址",onFocus:"邮箱6-100个字",onCorrect:" "}).inputValidator({min:5,max:100,onError:"email长度非法"})
		.regexValidator({regExp:"^([\\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$",onError:"email格式不正确"})	
		.ajaxValidator({	
			dataType : "json",	
			async : true,
			url : "user.php?act=check_email",
			success : function(data){
				if(data.code==1){
					return true;
				}
				return false;
			},
			buttons: $("#button"),
			error: function(jqXHR, textStatus, errorThrown){alert("服务器没有返回数据，可能服务器忙，请重试"+errorThrown);},
			onError : "该email地址不存在",
			onWait : "合法性校验中，请稍候..."
		});
					   	
						
		$("#username").formValidator({onShow:"4－20位字符，以英文字母开头可包含、数字或\"_\"",onFocus:"至少3个以上长度",onCorrect:" "})
			.inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"用户名两边不能有空符号"},onError:"用户名不能为空,请确认"})
			.ajaxValidator({	
			dataType : "json",	
			async : true,
			url : "user.php?act=is_registered",
			success : function(data){
				if(data.code==1){
					return true;
				}
				return false;
			},
			buttons: $("#button"),
			error: function(jqXHR, textStatus, errorThrown){alert("服务器没有返回数据，可能服务器忙，请重试"+errorThrown);},
			onError : "该昵称不存在",
			onWait : "合法性校验中，请稍候..."
		});		

   }
};  
</script>

</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'formValidator-4.0.1.min.js,formValidatorRegex.js')); ?>


<div class="block box">
 <div id="ur_here">
  <?php echo $this->fetch('library/ur_here.lbi'); ?>
  </div>
</div>

<div class="blank"></div>

<?php if ($this->_var['action'] == 'login'): ?>
<div id="entry" class="w">
	<div class="mt">
        <h2>用户登录</h2>
    </div>
	<div class="mc" style="padding:20px 0;">
        <div id="tabs-1" style="">              
                <div class="p_item"><label class="itemtitle">Email：</label>
                    <input type="text" autocomplete="off" tabindex="1" name="email" size="22" id="loginEmail" class="txt">
                    <span class="emailTip" id="loginEmailTip"></span></div>           
                
                <div class="p_item" style="margin:7px 0">
                  <label class="itemtitle">密码：</label>
                    <input type="password" tabindex="2" name="loginpassword" id="loginpassword"  size="22" class="txt">                    
                    <span class="pspt_msg" id="loginpasswordTip"></span></div>                
                <div class="p_item p_btn" style="margin:30px 20px 0px 50px">
                    <div id="loginbtn" class="lm_btn1" style="width:98px;float:left;">
                        <div class="btncont">登录</div>
                        <div class="btnright"></div>                              
                    </div>
                    <div  style="padding:10px 120px"><a class="c_g" id="btnGetPassword" target="_blank" href="user.php?act=get_password">忘记密码？</a></div>
                </div>               
                <div>
                    <div style="margin-left:20px;margin-top:43px;color:#999;">推荐您使用下列账号快捷登录：</div>
                    <ul class="lhdl">
                        <li>
                            <a class="dlqq a3" onclick="toQzoneLogin();" href="#">QQ</a>
                        </li>
                        <li>
                            <a onclick="" href="javascript:void(0);" class="dlkx a3">开心</a>
                        </li>
                        <li>
                            <a onclick="" href="javascript:void(0)" class="dlrr a3">人人</a>
                        </li>
                    </ul>                                
                </div>                    
        </div>
        <div id="guide">
            <h5>还不是365商城用户？</h5>

            <div class="content">现在免费注册成为365商城用户，便能立刻享受便宜又放心的购物乐趣。</div>
		<a id="btnRegisterNew" class="btn_grey2" href="javascript:register();">注册新用户</a>               
        </div>
        <!--[if !ie]>guide end<![endif]-->
        <span class="clr"></span>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	LoginValid.initLoginForm();
});
</script>
<?php endif; ?>



    <?php if ($this->_var['action'] == 'register'): ?>
    <?php if ($this->_var['shop_reg_closed'] == 1): ?>
    <div class="usBox">
      <div class="usBox_2 clearfix">
        <div class="f1 f5" align="center"><?php echo $this->_var['lang']['shop_register_closed']; ?></div>
      </div>
    </div>
    <?php else: ?>
<div id="entry" class="w">
            <div class="mt">
                 <h2>用户注册</h2>
            </div>
 	<div class="mc" style="padding:20px 0 30px 150px;">
         <form id="form2" class="form2" style="" method='post' action="user.php?act=simple_register">              
			<p class="p_item" style="padding-left:26px;"><label class="itemtitle">Email：</label>
                 <input type="text" autocomplete="off" tabindex="1" name="email" id="email" class="txt">
                 <span class="pspt_msg" id="emailTip"></span></p>      
                      
             <p class="p_item" style="padding-left:26px;margin:7px 0">
               <label class="itemtitle">昵称：</label>
             	<input type="text" tabindex="2" name="username" id="username" class="txt">
             	<span class="pspt_msg" id="usernameTip"></span></p>                   
             
             <p class="p_item" style="padding-left:26px;margin:7px 0">
               <label class="itemtitle">密码：</label>
             	<input type="password" tabindex="2" name="password1" id="password1" class="txt">
                 <span class="pspt_msg" id="password1Tip"></span></p>    
                 
             <p class="p_item" style="padding-left:26px;margin:7px 0">
               <label class="itemtitle">确认密码：</label>
             	<input type="password" tabindex="2" name="password2" id="password2" class="txt">
                 <span class="pspt_msg" id="password2Tip"></span></p>                                             
                    
			 <div class="p_item p_btn" style="margin:15px 20px 0px 70px">
                     <div id="regbtn2" class="btncont"></div>                    
             </div>             
             <div>
              <div style=";margin:15px 0 0 70px;">
             	 <a href="#" style="color:#00C;">《365会员条款》</a>
              </div>                  
         </div>
     </form>
 </div>    
 <script type="text/javascript">
$(document).ready(function(){
	LoginValid.initRegisterForm();
});
</script>
</div>
	<?php endif; ?>
	<?php endif; ?>	



    <?php if ($this->_var['action'] == 'get_password'): ?>
    <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
    <script type="text/javascript">
    <?php $_from = $this->_var['lang']['password_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
      var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </script>
    
<div id="entry" class="w">
	<div class="mt">
         <h2>找回密码</h2>
     </div>
 	<div class="mc" style="padding:20px 0 30px 150px;">
 		<form action="user.php" method="post" name="getPassword" onsubmit="return submitPwdInfo();">
         <div class="formFindPassword" style="">              
			<p class="p_item" ><label class="itemtitle">Email：</label>
                 <input type="text" autocomplete="off" tabindex="1" name="email" id="email" class="txt">
                 <span class="pspt_msg" id="emailTip"></span></p>  
                 
			<p  class="p_item">
               <label class="itemtitle">昵称：</label>
             	<input type="text" tabindex="2" name="username" id="username" class="txt">
             	<span class="pspt_msg" id="usernameTip"></span></p> 
                    
			 <div class=" p_btn" style="margin:15px 20px 0px 70px">
			 		<input type="hidden" name="act" value="send_pwd_email" />
                     <input type="submit" name="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="bnt_blue" style="border:none;" />
             		 <input name="button" type="button" onclick="history.back()" value="<?php echo $this->_var['lang']['back_page_up']; ?>" style="border:none;" class="bnt_blue_1" />                   
             </div>                           
         </div>
         </form>
     </div>
</div>     
<script type="text/javascript">
$(document).ready(function(){
	LoginValid.initGetPasswordForm();
});
</script>   
<?php endif; ?>


    <?php if ($this->_var['action'] == 'qpassword_name'): ?>
<div class="usBox">
  <div class="usBox_2 clearfix">
    <form action="user.php" method="post">
        <br />
        <table width="70%" border="0" align="center">
          <tr>
            <td colspan="2" align="center"><strong><?php echo $this->_var['lang']['get_question_username']; ?></strong></td>
          </tr>
          <tr>
            <td width="29%" align="right"><?php echo $this->_var['lang']['username']; ?></td>
            <td width="61%"><input name="user_name" type="text" size="30" class="inputBg" /></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="hidden" name="act" value="get_passwd_question" />
              <input type="submit" name="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="bnt_blue" style="border:none;" />
              <input name="button" type="button" onclick="history.back()" value="<?php echo $this->_var['lang']['back_page_up']; ?>" style="border:none;" class="bnt_blue_1" />
	    </td>
          </tr>
        </table>
        <br />
      </form>
  </div>
</div>
<?php endif; ?>


    <?php if ($this->_var['action'] == 'get_passwd_question'): ?>
<div class="usBox">
  <div class="usBox_2 clearfix">
    <form action="user.php" method="post">
        <br />
        <table width="70%" border="0" align="center">
          <tr>
            <td colspan="2" align="center"><strong><?php echo $this->_var['lang']['input_answer']; ?></strong></td>
          </tr>
          <tr>
            <td width="29%" align="right"><?php echo $this->_var['lang']['passwd_question']; ?>：</td>
            <td width="61%"><?php echo $this->_var['passwd_question']; ?></td>
          </tr>
          <tr>
            <td align="right"><?php echo $this->_var['lang']['passwd_answer']; ?>：</td>
            <td><input name="passwd_answer" type="text" size="20" class="inputBg" /></td>
          </tr>
          <?php if ($this->_var['enabled_captcha']): ?>
          <tr>
            <td align="right"><?php echo $this->_var['lang']['comment_captcha']; ?></td>
            <td><input type="text" size="8" name="captcha" class="inputBg" />
            <img src="captcha.php?is_login=1&<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?is_login=1&'+Math.random()" /> </td>
          </tr>
          <?php endif; ?>
          <tr>
            <td></td>
            <td><input type="hidden" name="act" value="check_answer" />
              <input type="submit" name="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="bnt_blue" style="border:none;" />
              <input name="button" type="button" onclick="history.back()" value="<?php echo $this->_var['lang']['back_page_up']; ?>" style="border:none;" class="bnt_blue_1" />
	    </td>
          </tr>
        </table>
        <br />
      </form>
  </div>
</div>
<?php endif; ?>

<?php if ($this->_var['action'] == 'reset_password'): ?>
    <script type="text/javascript">
    <?php $_from = $this->_var['lang']['password_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
      var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </script>
<div class="usBox">
  <div class="usBox_2 clearfix">
    <form action="user.php" method="post" name="getPassword2" onSubmit="return submitPwd()">
      <br />
      <table width="80%" border="0" align="center">
        <tr>
          <td><?php echo $this->_var['lang']['new_password']; ?></td>
          <td><input name="new_password" type="password" size="25" class="inputBg" /></td>
        </tr>
        <tr>
          <td><?php echo $this->_var['lang']['confirm_password']; ?>:</td>
          <td><input name="confirm_password" type="password" size="25"  class="inputBg"/></td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="hidden" name="act" value="act_edit_password" />
            <input type="hidden" name="uid" value="<?php echo $this->_var['uid']; ?>" />
            <input type="hidden" name="code" value="<?php echo $this->_var['code']; ?>" />
            <input type="submit" name="submit" value="<?php echo $this->_var['lang']['confirm_submit']; ?>" />
          </td>
        </tr>
      </table>
      <br />
    </form>
  </div>
</div>
<?php endif; ?>

<div class="blank"></div>

<div class="foot">
     <?php echo $this->fetch('library/help.lbi'); ?>      
     <div  class="clear"></div>
     <?php echo $this->fetch('library/page_footer.lbi'); ?>
</div>

</body>
<script type="text/javascript">
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
<?php $_from = $this->_var['lang']['passport_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var username_exist = "<?php echo $this->_var['lang']['username_exist']; ?>";
</script>
</html>
