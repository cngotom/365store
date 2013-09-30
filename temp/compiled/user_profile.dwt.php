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
<link href="themes/365chi/bootstrap.css" rel="stylesheet" type="text/css" />


<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,user.js')); ?>
<style type="text/css">
ul{
    margin: 0;
    padding: 0;
}
.detail tr{
    line-height: 32px;
    height:32px;
}
.time select{
    width:120px
}
</style>
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
    
      <div class="m" id="tabs">
            <ul style="display:none">
                <li class="mt"><a href="#tabs-1"> 个人信息修改</a></li>
                <li class="mt"><a href="#tabs-2">密码修改</a></li>
            </ul>
          <div id="tabs-1" class="mc">
                 <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
        <script type="text/javascript">
          <?php $_from = $this->_var['lang']['profile_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
            var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </script>
      <div class="blank"></div>
     <form name="formEdit" action="user.php" method="post" onSubmit="return userEdit()">
            <h4 style="text-align: center;">感谢您成为365会员，请完善您的个人信息，也许会有意外惊喜！ </h4>
            <table class="detail" width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#dddddd">
                        <tr>
                        <td width="28%" align="right" bgcolor="#FFFFFF"> 邮箱 ： </td>
                        <td width="72%" align="left" bgcolor="#FFFFFF">  <?php echo $this->_var['profile']['email']; ?></td>
                        </tr>
                        <tr>
                        <td width="28%" align="right" bgcolor="#FFFFFF">  用户级别 ： </td>
                        <td width="72%" align="left" bgcolor="#FFFFFF">  <?php echo $this->_var['profile']['rank_name']; ?></td>
                        </tr>
                        <tr>
                        <td width="28%" align="right" bgcolor="#FFFFFF">  用户昵称 ： </td>
                        <td width="72%" align="left" bgcolor="#FFFFFF">  <?php echo $this->_var['profile']['user_name']; ?></td>
                        </tr>
                        <tr>
                        <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['birthday']; ?>： </td>
                        <td width="72%" align="left" bgcolor="#FFFFFF" class="time"> <?php echo $this->html_select_date(array('style'=>'small','field_order'=>'YMD','prefix'=>'birthday','start_year'=>'-60','end_year'=>'+1','display_days'=>'true','month_format'=>'%m','day_value_format'=>'%02d','time'=>$this->_var['profile']['birthday'])); ?> </td>
                        </tr>
                        <tr>
                        <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['sex']; ?>： </td>
                        <td width="72%" align="left" bgcolor="#FFFFFF">
                            <label class="radio inline">
                                <input type="radio" name="sex" value="0"<?php if ($this->_var['profile']['sex'] == 0): ?>checked="checked"<?php endif; ?>>
                                <?php echo $this->_var['lang']['secrecy']; ?>&nbsp;&nbsp;
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="sex" value="1"<?php if ($this->_var['profile']['sex'] == 1): ?>checked="checked"<?php endif; ?>>
                                <?php echo $this->_var['lang']['male']; ?>&nbsp;&nbsp;
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="sex" value="2"<?php if ($this->_var['profile']['sex'] == 2): ?>checked="checked"<?php endif; ?>>
                                <?php echo $this->_var['lang']['female']; ?>&nbsp;&nbsp;
                            </label>
                        </td>
                        </tr>
                        <?php $_from = $this->_var['extend_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'field');if (count($_from)):
    foreach ($_from AS $this->_var['field']):
?>
                        <?php if ($this->_var['field']['id'] == 6): ?>
                        <tr>
                            <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['passwd_question']; ?>：</td>
                            <td width="72%" align="left" bgcolor="#FFFFFF">
                            <select  name='sel_question'>
                            <option value='0'><?php echo $this->_var['lang']['sel_question']; ?></option>
                            <?php echo $this->html_options(array('options'=>$this->_var['passwd_questions'],'selected'=>$this->_var['profile']['passwd_question'])); ?>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="28%" align="right" bgcolor="#FFFFFF" <?php if ($this->_var['field']['is_need']): ?>id="passwd_quesetion"<?php endif; ?>><?php echo $this->_var['lang']['passwd_answer']; ?>：</td>
                            <td width="72%" align="left" bgcolor="#FFFFFF">
                            <input name="passwd_answer" type="text" size="25" class="inputBg" maxlengt='20' value="<?php echo $this->_var['profile']['passwd_answer']; ?>"/><?php if ($this->_var['field']['is_need']): ?><span style="color:#FF0000"> *</span><?php endif; ?>
                            </td>
                        </tr>
                        <?php else: ?>
                        <tr>
                                <td width="28%" align="right" bgcolor="#FFFFFF" <?php if ($this->_var['field']['is_need']): ?>id="extend_field<?php echo $this->_var['field']['id']; ?>i"<?php endif; ?>><?php echo $this->_var['field']['reg_field_name']; ?>：</td>
                                <td width="72%" align="left" bgcolor="#FFFFFF">
                                <input name="extend_field<?php echo $this->_var['field']['id']; ?>" type="text" class="inputBg" value="<?php echo $this->_var['field']['content']; ?>"/><?php if ($this->_var['field']['is_need']): ?><span style="color:#FF0000"> *</span><?php endif; ?>
                                </td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        <tr>
                        <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="act" type="hidden" value="act_edit_profile" />
                            <input name="submit" type="submit" value="<?php echo $this->_var['lang']['confirm_edit']; ?>" class=" btn btn-primary" style="border:none;" />
                        </td>
                        </tr>
            </table>
            </form>

 
          </div>
          <div id="tabs-2" class="mc">
            <form name="formPassword" action="user.php" method="post" onSubmit="return editPassword()" >
                    <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#dddddd">
                        <tr>
                        <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['old_password']; ?>：</td>
                        <td width="76%" align="left" bgcolor="#FFFFFF"><input name="old_password" type="password" size="25"  class="inputBg" /></td>
                        </tr>
                        <tr>
                        <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['new_password']; ?>：</td>
                        <td align="left" bgcolor="#FFFFFF"><input name="new_password" type="password" size="25"  class="inputBg" /></td>
                        </tr>
                        <tr>
                        <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['confirm_password']; ?>：</td>
                        <td align="left" bgcolor="#FFFFFF"><input name="comfirm_password" type="password" size="25"  class="inputBg" /></td>
                        </tr>
                        <tr>
                        <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="act" type="hidden" value="act_edit_password" />
                            <input name="submit" type="submit" class="bnt_blue_1" style="border:none;" value="<?php echo $this->_var['lang']['confirm_edit']; ?>" />
                        </td>
                        </tr>
                    </table>
            </form>
          </div>
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

$(function() {
    $( "#tabs" ).tabs();
    $('#tabs ul').show();
});

</script>
</body>

</html>
