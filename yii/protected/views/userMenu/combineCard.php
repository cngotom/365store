<?php if (!empty($error) ){ ?>
    <div class="error-content"> <?php  echo $error;  ?></div>
<?php }?>
<div class="login">
    <form action="<?php echo $this->createUrl('userMenu/combineCard'); ?>" method="post" name="form">
    <ul>
        <li class="onCorrect" id="card_noTip"></li>
        <li class="onCorrect" id="passwordTip"></li>
        <li class="onCorrect" id="moneyTip"></li>


        <li> 请您输入礼卡卡号，密码，以及充值金额  </li>
        <li>卡号：</li>
        <li>
            <input type="text" maxlength="100" class="text_info" name="card_no" id="card_no"></li>
        
        <li>密码（密码区分大小写）：</li>
        <li>
            <input type="password" maxlength="50" class="text_info" name="password" id="password"></li>
        <li>
         
        <li>金额（元）：</li>
        <li>
            <input type="text" maxlength="50" class="text_info" name="money" id="money"></li>
        <li>    
            
            <div class="button">
                <input type="button" value="充 值" class="buy-btn" onclick="checkForm();">
                <input type="hidden" name="act" value="do_combine">
            </div>
        </li>
        
       
    </ul>
    </form>
</div>
    
     
<script type="text/javascript">

$(function(){
     // $('#card_no,#password,#money').change(checkInput );
     // checkInput();
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
    