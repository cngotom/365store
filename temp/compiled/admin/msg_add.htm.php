<!-- $Id: msg_add.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<div class="main-div">
<div>
<?php $_from = $this->_var['msg_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'msg');if (count($_from)):
    foreach ($_from AS $this->_var['msg']):
?>
<div style="margin-bottom:10px;border:1px solid #ccc;background:white;">
<div style="border-bottom: 1px solid #eee;position:relative;"><strong><?php echo htmlspecialchars($this->_var['msg']['msg_title']); ?></strong><a href="user_msg.php?act=remove_msg&order_id=<?php echo $this->_var['order_id']; ?>&user_id=<?php echo $this->_var['user_id']; ?>&msg_id=<?php echo $this->_var['msg']['msg_id']; ?>" style="position:absolute ;right:5px" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_delete']; ?>')) return false;"><img src="images/icon_drop.gif"  border="0" /></a></div>
<div><?php echo nl2br(htmlspecialchars($this->_var['msg']['msg_content'])); ?></div>
<?php if ($this->_var['msg']['message_img']): ?>
<div align="right">
  <a href="../data/feedbackimg/<?php echo $this->_var['msg']['message_img']; ?>" target="_bank" width="300" height="400"><?php echo $this->_var['lang']['view_upload_file']; ?></a>
  <a href="user_msg.php?act=drop_file&id=<?php echo $this->_var['msg']['msg_id']; ?>&file=<?php echo $this->_var['msg']['message_img']; ?>"><?php echo $this->_var['lang']['drop']; ?></a>
</div>
<?php endif; ?>
<div align="right"  nowrap="nowrap"><a href="mailto:<?php echo $this->_var['msg']['user_email']; ?>"><?php echo $this->_var['msg']['user_name']; ?></a> @ <?php echo $this->_var['msg']['msg_time']; ?></div>
</div>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</div>
<form method="post" action="user_msg.php?act=insert" name="theForm"  onsubmit="return validate()">
  <table border="0" width="100%">
    <tr>
      <td><?php echo $this->_var['lang']['msg_title']; ?>:</td>
      <td><input name="msg_title" id="msg_title"  type="text" value="<?php echo $this->_var['msg']['reply_email']; ?>" /></td>
    </tr>
    <tr>
      <td><?php echo $this->_var['lang']['msg_content']; ?>:</td>
      <td><textarea name="msg_content" cols="50" rows="4" wrap="VIRTUAL" id="msg_content"><?php echo $this->_var['msg']['reply_content']; ?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
          <input type="hidden" name="order_id" value="<?php echo $this->_var['order_id']; ?>" />
          <input type="hidden" name="user_id" value="<?php echo $this->_var['user_id']; ?>" />
          <input name="Submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" type="submit" class="button" />
      </td>
    </tr>
  </table>
</form>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>
<script language="JavaScript">
<!--

document.forms['theForm'].elements['msg_content'].focus();

/**
 * 检查表单输入的数据
 */
function validate()
{
  var validator = new Validator("theForm");
  validator.required("msg_title",  no_title);
  validator.required("msg_content",  no_content);
  return validator.passed();
}

onload = function()
{
  // 开始检查订单
  startCheckOrder();
}
//-->

</script>
<?php echo $this->fetch('pagefooter.htm'); ?>