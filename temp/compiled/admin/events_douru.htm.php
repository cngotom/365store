<!-- $Id: exchange_goods_list.htm 15544 2009-01-09 01:54:28Z zblikai $ -->
<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<!-- start cat list -->
<div class="list-div" id="listDiv">
<?php endif; ?>

<table cellspacing='1' cellpadding='3' id='list-table'>
  <tr>
      <th> 用户ID </th>
      <th> 用户名称 </th>
      <th> 用户邮箱 </th>
      <th> IP地址 </th>
      <th> 时间  </th>
      <th> 是否支付 </th>
  </tr>
  <?php $_from = $this->_var['events']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'event');if (count($_from)):
    foreach ($_from AS $this->_var['event']):
?>
  <tr>
    <td class="first-cell"><span><?php echo $this->_var['event']['user_id']; ?></span></td>
    <td align="center"><span><?php echo $this->_var['event']['user_name']; ?></span></td>
    <td align="center"><span><?php echo $this->_var['event']['email']; ?></span></td>
    <td align="center"><span><?php echo $this->_var['event']['ip']; ?></span></td>
    <td align="center"><span><?php echo $this->_var['event']['time']; ?></span></td>
    <td align="center"><span><?php echo $this->_var['event']['status']; ?></span></td>

   </tr>
   <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
