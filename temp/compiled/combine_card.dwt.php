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
<link rel="stylesheet" type="text/css" href="js/uniform.default.css" />  
<link href="js/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="themes/365chi/user_center.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    
label.itemtitle{
width:60px;
display:inline-block;
}
.p_item input{
    width:120px;
}
.onCorrect {
    padding-top: 1px;
    padding-bottom: 1px;
    background: url("/jsdemo/list/images/onCorrect.gif") no-repeat scroll 0 -4px #E9F0FF;
    font-size: 12px;
    line-height: 22px;
    padding-left: 25px;
    vertical-align: middle;
    width:100px;
    color: red;
}</style>

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,user.js')); ?>

</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>

<div class="wrap box">
 <div id="ur_here">
  <?php echo $this->fetch('library/ur_here.lbi'); ?>
 </div>
</div>

<div class="blank"></div>
<div class="wrap clearfix">
  
  <div class="AreaL">
    <div class="box">
     <div class="box_1">
      <div class="userCenterBox">
        <?php echo $this->fetch('library/user_menu.lbi'); ?>
      </div>
     </div>
    </div>
  </div>
  
  
  <div class="AreaR">
      <div style="margin-top:40px;margin-left: 200px;">
          <form action="user.php?act=check_combine" method="post" name="form" >

            <div class="p_item" style="margin-bottom: 10px;">请您输入要充值至该账户礼卡卡号，密码，以及充值金额          </div>
            
            <div class="p_item"><label class="itemtitle">卡号：</label>
                            <input type="text" autocomplete="off" tabindex="1" name="card_no" id="card_no" class="txt">
                            <span class="onCorrect" id="card_noTip"></span>
            </div>           

            <div class="p_item" style="margin:7px 0">
                <label class="itemtitle">密码：</label>
                <input type="password" tabindex="2" name="password" id="password" class="txt">                    
                <span class="onCorrect" id="passwordTip"></span>
            </div>                

            
            <div class="p_item"><label class="itemtitle">充值金额（整数）：</label>
                            <input type="text" autocomplete="off" tabindex="1" name="money" id="money" class="txt"> 元
                            <span class="onCorrect" id="moneyTip"></span>
            </div>    

       
            

            <div class="p_item p_btn" style="margin:30px 0px 0px 0px">
                <div id="loginbtn" class="lm_btn1" style="width:98px;"  onclick="checkForm();">
                    <div class="btncont">确认</div>
                    <div class="btnright" ></div>                              
                </div>
            </div>               

        </form>
      </div>
      
  </div>
  
</div>
<div class="blank"></div>

<div class="foot">
     <?php echo $this->fetch('library/help.lbi'); ?>      
     <div  class="clear"></div>
     <?php echo $this->fetch('library/page_footer.lbi'); ?>
</div>



<script type="text/javascript">

$(function(){
      $('#card_no,#password,#money').change(checkInput );
      checkInput();
});
function isInteger( str ){
    var regu = /^[-]{0,1}[0-9]{1,}$/;
    return regu.test(str);
}
function checkInput()
{
     var res = true;
       $('#card_noTip,#passwordTip,#moneyTip').html('');
       
       if($('#card_no').val() == "")
        {
            $('#card_noTip').html('卡号不能为空');
           res  =  false;

        }
          if($('#password').val() == "")
        {
            $('#passwordTip').html('密码不能为空');
           res  =  false;

        }
          if($('#money').val() == "")
        {
           $('#moneyTip').html('金额不能为空');
           res  =  false;

        }
        
        
        
       if( !isInteger( $('#card_no').val()) )
       {
           $('#card_noTip').html('卡号格式不正确');
           res  =  false;
       }
       
        if( !isInteger( $('#money').val()) || parseInt($('#money').val()) <=0  )
       {
           $('#moneyTip').html('金额格式不正确');
            res  =  false;
       }
       return res;
    
}
function checkForm()
    {
      
       
       if(checkInput())
            form.submit();
    }
</script>
</body>

</html>
