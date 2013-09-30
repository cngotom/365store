
    
<?php if(!empty($tips)):?> <div class="error-content"><?php echo $tips?></div>    <?php endif?>

<div class="login">
    <form action="<?php echo $this->createUrl('index'); ?>" method="post" id="loginform">
    <ul>
        <li>卡号：</li>
        <li>
            <input type="text" maxlength="100" class="text_info" name="cardno" id="cardno"></li>
        <li>密码（密码区分大小写）：</li>
        <li>
            <input type="password" maxlength="50" class="text_info" name="password" id="password"></li>
        <li>
            <div class="button">
                <input type="submit" value="登  录" class="buy-btn">
                <input type="hidden" name="act" value="do_login">
            </div>
        </li>
        
        <li class="register"><a href="<?php echo $this->createUrl('register'); ?>">免费注册</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <!--    <a href="/Home/FindPwd/?guid=e7da913f6d0d49f79d42436b351ed0a7&amp;ReturnUrl="> 手机帐号取回密码</a></li> -->
    </ul>
    </form>
</div>