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
<link href="themes/365chi/user_center.css" rel="stylesheet" type="text/css" />

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,user.js,jquery-1.7.2.min.js,jquery.uniform.min.js')); ?>
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
    <div class="box">
     <div class="box_1">
      <div class="clearfix" style="_height:1%;">
          
          <div class="item">
        <div class="f_l fore">
            <select id="ordertype" class="sele" name="">
                <option value="0">所有时期</option>
                <option value="1" >近一个月订单</option>
                <option value="2">一个月前订单</option>
              
            </select>
            <select id="orderstateselect" class="sele" name="">
                <option value="0" >全部订单</option>
                <option value="1">待确认订单</option>
                <option value="2">已取消订单</option>
                <option value="3">待评价订单</option>
                 <option value="4">已完成订单</option>
                 <option value="5">待付款订单</option>
            </select>
            <script type="text/javascript" language="javascript">
 
                $("#orderstateselect").val(<?php echo $this->_var['order_status']; ?>);
                $("#ordertype").val(<?php echo $this->_var['time_type']; ?>);
                $("#ordertype").change(function () {
                    var otype = $("#ordertype").val();
                     window.location = '/user.php?act=order_list&time_type=' + otype;     
                });


                $("#orderstateselect").change(function() {
                    var ostype =$("#orderstateselect").val();
                    window.location = '/user.php?act=order_list&order_status=' + ostype;             
                });

                
                
            </script>
        </div>
              <!--
        <div class="f_r">
            <input id="ip_keyword" name="" type="text" class="text" value="商品名称、商品编号、订单编号" onfocus="if (this.value==this.defaultValue)this.value=''" onblur="if (this.value=='') this.value=this.defaultValue">
            <input type="button" value="查 询" class="bti" >
        </div> -->
        <div class="clearfix">
        </div>
    </div>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
           <div class="blank"></div>
       <table width="100%" border="0" cellpadding="5" cellspacing="0" class='order_list_table'>
          <tr align="center">
             <th width="12%">订单编号</th>
              <th width="28%">订单商品</th>
              <th width="10%">收货人</th>
              <th width="12%">订单金额</th>
              <th width="12%">下单时间</th>
              <th width="12%">订单状态</th>
              <th width="14%">操作</th>
          </tr>
          <?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
          <tr>
            <td align="center"><a href="user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>" class="f6"><?php echo $this->_var['item']['order_sn']; ?></a></td>
            <td align="center" ><?php echo $this->_var['item']['goods_info']; ?></td>
            <td align="center" ><?php echo $this->_var['item']['consignee']; ?></td>
            <td align="right" ><?php echo $this->_var['item']['total_fee']; ?></td>
            <td align="center" > <span class="ftx-03"> <?php echo $this->_var['item']['order_time']; ?> </span></td>
            <td align="center" ><span class="ftx-03"><?php echo $this->_var['item']['order_status']; ?> </span></td>
            <td align="center"><font class="ftx-04"><?php echo $this->_var['item']['handler']; ?></font></td>
          </tr>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          <?php if ($this->_var['statics']): ?>
          <tr>
              <td colspan="7" class="td-03" align="right"><div class="ar ftx-03"> <!-- 待付款：<strong id="noPayCount" class="ftx-01"><?php echo $this->_var['statics']['paying']; ?></strong>&nbsp;&nbsp;-->
                  待处理：<strong id="noFinishCount" class="ftx-01"><?php echo $this->_var['statics']['unhandled']; ?></strong>&nbsp;&nbsp;
                  已完成：<strong id="finishedCount" class="ftx-01"><?php echo $this->_var['statics']['completed']; ?></strong>&nbsp;&nbsp;
                  已取消：<strong id="cancelCount" class="ftx-01"><?php echo $this->_var['statics']['canceled']; ?></strong>&nbsp;&nbsp;
                  待确认：<strong id="cancelCount" class="ftx-01"><?php echo $this->_var['statics']['confirming']; ?></strong>&nbsp;&nbsp;
                  待评论：<strong id="cancelCount" class="ftx-01"><?php echo $this->_var['statics']['commenting']; ?></strong>&nbsp;&nbsp;
               <!--   订单总数：<strong id="totalCount" class="ftx-01"><?php echo $this->_var['statics']['total']; ?></strong>&nbsp;&nbsp;  --></div></td>
            </tr>
         <?php endif; ?>
          </table>
       <div class="blank5"></div>
      
      </div>
     </div>
    </div>
        <?php echo $this->fetch('library/pages.lbi'); ?>
  </div>
  
</div>
<div class="blank"></div>

<div class="foot">
     <?php echo $this->fetch('library/help.lbi'); ?>      
     <div  class="clear"></div>
     <?php echo $this->fetch('library/page_footer.lbi'); ?>
</div>

</body>
<script type="text/javascript">
<?php $_from = $this->_var['lang']['clips_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

$(function(){
        $("input, textarea").uniform();
      });

</script>
</html>
          
          