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
    
      <div class="m" id="tabs">
            <ul>
                <li class="mt"><a href="#tabs-1"> 商品评论</a></li>
                <li class="mt"><a href="#tabs-2">满意度评价</a></li>
            </ul>
          <div id="tabs-1" class="mc">
                    <?php $_from = $this->_var['comment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'comment');if (count($_from)):
    foreach ($_from AS $this->_var['comment']):
?>
                <div class="f_l">
                <b><?php if ($this->_var['comment']['comment_type'] == '0'): ?><?php echo $this->_var['lang']['goods_comment']; ?><?php else: ?><?php echo $this->_var['lang']['article_comment']; ?><?php endif; ?>: </b><font class="f4"><?php echo $this->_var['comment']['cmt_name']; ?></font>&nbsp;&nbsp;(<?php echo $this->_var['comment']['formated_add_time']; ?>)
                </div>
                <div class="f_r">
                <a href="user.php?act=del_cmt&amp;id=<?php echo $this->_var['comment']['comment_id']; ?>" title="<?php echo $this->_var['lang']['drop']; ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_remove_msg']; ?>')) return false;" class="f6"><?php echo $this->_var['lang']['drop']; ?></a>
                </div>
                <div class="msgBottomBorder">
                <?php echo htmlspecialchars($this->_var['comment']['content']); ?><br />
                <?php if ($this->_var['comment']['reply_content']): ?>
                <b><?php echo $this->_var['lang']['reply_comment']; ?>：</b><br />
                <?php echo $this->_var['comment']['reply_content']; ?>
                <?php endif; ?>
                </div>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                <?php if ($this->_var['comment_list']): ?>
                <?php echo $this->fetch('library/pages.lbi'); ?>
                <?php else: ?>
                <?php echo $this->_var['lang']['no_comments']; ?>
                <?php endif; ?>
           
          </div>
          <div id="tabs-2" class="mc">
              <table width="100%" cellspacing="0" cellpadding="0" border="0" class="order_list_table">
                <tbody><tr>
                        <th width="100">订单编号</th>
                        <th width="200">评价时间</th>
                        <th>评价内容</th>
                        <!-- <th width="100">奖励积分</th> -->
                </tr>
              <?php $_from = $this->_var['order_comment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'comment');if (count($_from)):
    foreach ($_from AS $this->_var['comment']):
?>
              <tr>
                  <td>  <a href="<?php echo $this->_var['comment']['order_url']; ?>" > <?php echo $this->_var['comment']['order_sn']; ?>  </a></td>
                  <td>  <?php echo $this->_var['comment']['date']; ?>  </td>
                  <td>  <?php echo $this->_var['comment']['comment_text']; ?>  </td>
                  
              </tr>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>                 		
										  					</tbody>
                  </tbody>  </table>
           
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
});

</script>
</body>

</html>
