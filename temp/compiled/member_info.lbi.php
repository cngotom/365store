<div id="append_parent"></div>
<?php if ($this->_var['user_info']): ?>
<script language="javascript">
    init_userinfo("<?php echo $this->_var['user_info']['username']; ?>");      
</script>
<li class="my365">
<?php echo $this->_var['lang']['hello']; ?>，<font class="f4_b"><?php echo $this->_var['user_info']['username']; ?></font>, <?php echo $this->_var['lang']['welcome_return']; ?>！
 &nbsp;&nbsp;<a href="user.php">我的365绿色商城<img src="themes/365chi/images/green/index/my365.gif" style="width: 11px;height:28xp;vertical-align: middle;" /></a> &nbsp;&nbsp;<a href="user.php?act=logout"><?php echo $this->_var['lang']['user_logout']; ?></a></li>

<?php else: ?>
<li class="hello fl"> <?php echo $this->_var['lang']['welcome']; ?> &nbsp;&nbsp;<a href="user.php">登陆</a>&nbsp;<a href="user.php?act=register">注册</a> &nbsp;<a href="user.php?type=card">卡用户登陆</a></li>
<?php endif; ?>