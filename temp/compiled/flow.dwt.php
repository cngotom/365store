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
<link href="js/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="js/style/validator.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="js/jquery.jqzoom.css">  

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,shopping_flow.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,transport.js,shopping_flow.js,region.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>

<div class="block box">
 <div id="ur_here">
  <?php echo $this->fetch('library/ur_here.lbi'); ?>
 </div>
</div>

<div class="blank"></div>
<div class="block">
  <?php if ($this->_var['step'] == "cart"): ?>
  
  
 <?php echo $this->smarty_insert_scripts(array('files'=>'showdiv.js，jquery.jqzoom-core-pack.js,formValidator-4.0.1.min.js,formValidatorRegex.js,validdata.js')); ?>
  
  
  <script type="text/javascript">
  <?php $_from = $this->_var['lang']['password_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
    var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </script>
   <div class="cartbox">
        <form id="formCart" name="formCart" method="post" action="flow.php">
           <table width="99%" align="center" border="0" cellpadding="5" cellspacing="0" bgcolor="#ffffff">
            <tr bgcolor="#F6F6F6" class="lm_cart_title">
              <?php if ($this->_var['show_goods_thumb'] == 3): ?>  
                <th width="70px">商品</th>
                <th width="230px">名称</th>
               <?php else: ?>
                <th width="300px"><?php echo $this->_var['lang']['goods_name']; ?></th>
               <?php endif; ?>
      <?php if ($this->_var['show_goods_attribute'] == 1): ?>
              <th width="60px"><?php echo $this->_var['lang']['goods_attr']; ?></th>
              <?php endif; ?>
              <?php if ($this->_var['show_marketprice']): ?>
              <th width="80px"><?php echo $this->_var['lang']['market_prices']; ?></th>
              <?php endif; ?>
              <th width="100px"><?php echo $this->_var['lang']['shop_prices']; ?></th>
              <th width="80px"><?php echo $this->_var['lang']['number']; ?></th>
              <th width="100px"><?php echo $this->_var['lang']['subtotal']; ?></th>
              <th ><?php echo $this->_var['lang']['handle']; ?></th>
            </tr>
            <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
            <tr id="tr_goods_<?php echo $this->_var['goods']['rec_id']; ?>" >
              <td bgcolor="#ffffff" align="center" class="flow_gouwuche_goodimg">
                <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>
                  <?php if ($this->_var['show_goods_thumb'] == 1): ?>
                    <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['goods']['goods_name']; ?></a>
                  <?php elseif ($this->_var['show_goods_thumb'] == 2): ?>
                    <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" border="0" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" /></a>
                  <?php else: ?>
                    <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" border="0" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" /></a><br />
                  </td>
                    <td bgcolor="#ffffff" align="center">
                    <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['goods']['goods_name']; ?></a>
                  <?php endif; ?>
                  <?php if ($this->_var['goods']['parent_id'] > 0): ?>
                  <span style="color:#FF0000">（<?php echo $this->_var['lang']['accessories']; ?>）</span>
                  <?php endif; ?>
                  <?php if ($this->_var['goods']['is_gift'] > 0): ?>
                  <span style="color:#FF0000">（<?php echo $this->_var['lang']['largess']; ?>）</span>
                  <?php endif; ?>
                <?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>
                  <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6"><?php echo $this->_var['goods']['goods_name']; ?><span style="color:#FF0000;">（<?php echo $this->_var['lang']['remark_package']; ?>）</span></a>
                  <div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" style="display:none">
                      <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?>
                        <a href="goods.php?id=<?php echo $this->_var['package_goods_list']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['package_goods_list']['goods_name']; ?></a><br />
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                  </div>
                <?php else: ?>
                  <?php echo $this->_var['goods']['goods_name']; ?>
                <?php endif; ?>
              </td>
              <?php if ($this->_var['show_goods_attribute'] == 1): ?>
              <td  valign="middle" bgcolor="#ffffff"><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
              <?php endif; ?>
              <?php if ($this->_var['show_marketprice']): ?>
              <td  valign="middle" align="center" bgcolor="#ffffff"><?php echo $this->_var['goods']['market_price']; ?></td>
              <?php endif; ?>
              <td valign="middle" align="center" bgcolor="#ffffff"><?php echo $this->_var['goods']['goods_price']; ?></td>
              <td valign="middle" align="center" bgcolor="#ffffff" width="105">
                <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['is_gift'] == 0 && $this->_var['goods']['parent_id'] == 0): ?>
               <a href="javascript:void(0)" onclick="changenum(<?php echo $this->_var['goods']['rec_id']; ?>,-1)"><img src="themes/365chi/images/minus.png" style="vertical-align:middle;margin-bottom: 2px;" /></a>

<input type="text"name="goods_number[<?php echo $this->_var['goods']['rec_id']; ?>]"id="goods_number_<?php echo $this->_var['goods']['rec_id']; ?>"value="<?php echo $this->_var['goods']['goods_number']; ?>" size="4"class="inputBg" style="text-align:center;width:30px; " onchange="change_goods_number(<?php echo $this->_var['goods']['rec_id']; ?>,this.value)"/>

<a href="javascript:void(0)" onclick="changenum(<?php echo $this->_var['goods']['rec_id']; ?>,1)"><img src="themes/365chi/images/plus.png" style="vertical-align:middle;margin-bottom: 2px;"/></a>
                <?php else: ?>
                <?php echo $this->_var['goods']['goods_number']; ?>
                <?php endif; ?>
              </td>
              <td align="center" valign="middle"  bgcolor="#ffffff" id="goods_subtotal_<?php echo $this->_var['goods']['rec_id']; ?>"><?php echo $this->_var['goods']['subtotal']; ?></td>
              <td valign="middle" align="center" bgcolor="#ffffff">
                <a href="javascript:if (confirm('<?php echo $this->_var['lang']['drop_goods_confirm']; ?>')) location.href='flow2.php?step=drop_goods&amp;id=<?php echo $this->_var['goods']['rec_id']; ?>'; " class="f6"><?php echo $this->_var['lang']['drop']; ?></a> </br>
                <?php if ($_SESSION['user_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>
                <a href="javascript:void(0)" onclick="collect(<?php echo $this->_var['goods']['goods_id']; ?>); " class="f6">收藏</a>
                <?php endif; ?>            </td>
            </tr>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          </table>
            
           
           <?php if ($this->_var['exchange_goods']): ?>
           <div class="blank5" ></div>
           <table width="99%" align="center" border="0" cellpadding="5" cellspacing="0" bgcolor="#ffffff">
               <tr class="lm_cart_title" style="display: none">
              <?php if ($this->_var['show_goods_thumb'] == 3): ?>  
                <th width="70px">商品</th>
                <th width="230px">名称</th>
               <?php else: ?>
                <th width="300px"><?php echo $this->_var['lang']['goods_name']; ?></th>
               <?php endif; ?>
             <?php if ($this->_var['show_goods_attribute'] == 1): ?>
                 <th width="60px"><?php echo $this->_var['lang']['goods_attr']; ?></th>
              <?php endif; ?>
              <?php if ($this->_var['show_marketprice']): ?>
              <th width="80px"><?php echo $this->_var['lang']['market_prices']; ?></th>
              <?php endif; ?>
              <th width="100px"><?php echo $this->_var['lang']['shop_prices']; ?></th>
              <th width="80px"><?php echo $this->_var['lang']['number']; ?></th>
              <th width="100px"><?php echo $this->_var['lang']['subtotal']; ?></th>
              <th ><?php echo $this->_var['lang']['handle']; ?></th>
            </tr>
            <?php $_from = $this->_var['exchange_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
            <tr id="tr_goods_<?php echo $this->_var['goods']['rec_id']; ?>" >
              <td  width="70px" bgcolor="#ffffff" align="center" class="flow_gouwuche_goodimg">
                <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>
                  <?php if ($this->_var['show_goods_thumb'] == 1): ?>
                    <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['goods']['goods_name']; ?></a>
                  <?php elseif ($this->_var['show_goods_thumb'] == 2): ?>
                    <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" border="0" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" /></a>
                  <?php else: ?>
                    <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" border="0" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" /></a><br />
                  </td>
                    <td bgcolor="#ffffff" align="center" width="230px">
                    <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['goods']['goods_name']; ?></a>
                  <?php endif; ?>
                  <?php if ($this->_var['goods']['is_gift'] > 0): ?>
                  <span style="color:#FF0000">（<?php echo $this->_var['lang']['largess']; ?>）</span>
                  <?php endif; ?>
                <?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>
                  <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6"><?php echo $this->_var['goods']['goods_name']; ?><span style="color:#FF0000;">（<?php echo $this->_var['lang']['remark_package']; ?>）</span></a>
                  <div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" style="display:none">
                      <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?>
                        <a href="goods.php?id=<?php echo $this->_var['package_goods_list']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['package_goods_list']['goods_name']; ?>（提货券）</a><br />
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                  </div>
                <?php else: ?>
                  <?php echo $this->_var['goods']['goods_name']; ?> 
                <?php endif; ?>
              </td>
              <?php if ($this->_var['show_goods_attribute'] == 1): ?>
              <td  valign="middle" width="60px"  bgcolor="#ffffff"><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
              <?php endif; ?>
              <?php if ($this->_var['show_marketprice']): ?>
              <td  valign="middle" width="80px" align="center" bgcolor="#ffffff"><?php echo $this->_var['goods']['market_price']; ?></td>
              <?php endif; ?>
              <td valign="middle" width="100px" align="center" bgcolor="#ffffff"><?php echo $this->_var['goods']['goods_price']; ?></td>
              <td valign="middle" width="105px" align="center" bgcolor="#ffffff" width="105">
                <?php echo $this->_var['goods']['goods_number']; ?>
              </td>
              <td align="center" width="100px" valign="middle"  bgcolor="#ffffff" id="goods_subtotal_<?php echo $this->_var['goods']['rec_id']; ?>"><?php echo $this->_var['goods']['subtotal']; ?></td>
              <td valign="middle" align="center" bgcolor="#ffffff">
                <a href="javascript:if (confirm('<?php echo $this->_var['lang']['drop_goods_confirm']; ?>')) location.href='flow2.php?step=drop_goods&amp;id=<?php echo $this->_var['goods']['rec_id']; ?>'; " class="f6"><?php echo $this->_var['lang']['drop']; ?></a> </br>
              </td>
            </tr>
            
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <?php endif; ?>
           
            
            
          <table width="99%" align="center" border="0" cellpadding="5" cellspacing="0" bgcolor="#dddddd">
            <tr>
              <td bgcolor="#ffffff" id="total_desc">
        
              </td>
              <td align="right" bgcolor="#ffffff">
                        <div class="lm_cart_hj">
                             <?php if ($this->_var['discount'] > 0): ?>
                                <span class="lm_cart_js font023">折扣：<span class="lm_cart_saving" id="discount">$discount</span></span>
                             <?php endif; ?>
                            <span class="lm_cart_js font023">节省：<span class="lm_cart_saving" id="saving_money"><?php echo $this->_var['saving_money']; ?></span></span>

                            <span style="display:block; margin-top:10px" class="font021"
                                <span class="font043"><span class="lm_cart_zong font043" id="shopping_money"><?php echo $this->_var['shopping_money']; ?></span></span>
                            </span>
                        </div>
              </td>
            </tr>
          </table>
          <input type="hidden" name="step" value="update_cart" />
        </form>
       <script type="text/javascript" charset="utf-8">
           function goto_check()
        {

            if(!GUserInfo.isLogin){
                GUserInfo.runCode =  'location.href = "flow.php?step=checkout"'; 
                show_login_dialog();
            }
            else{
                location.href = 'flow.php?step=checkout';
            }
        }
          function changenum(rec_id, diff)
            {

                var goods_number =Number($$('goods_number_' + rec_id).value) + Number(diff);             
                
                change_goods_number(rec_id,goods_number);

            }

            function change_goods_number(rec_id, goods_number)

            {     
    
               if(goods_number < 1)
                   goods_number = 1;
               Ajax.call('flow.php?step=ajax_update_cart', 'rec_id=' + rec_id +'&goods_number=' + goods_number, change_goods_number_response, 'POST','JSON');                

            }

            function change_goods_number_response(result)

            {               

                if (result.error == 0)

                {

                    var rec_id = result.rec_id;

                    $$('goods_number_' +rec_id).value = result.goods_number;//更新数量

                    $$('goods_subtotal_' +rec_id).innerHTML = result.goods_subtotal;//更新小计

                    if (result.goods_number <= 0)

                    {// 数量为零则隐藏所在行

                        $$('tr_goods_' +rec_id).style.display = 'none';

                        $$('tr_goods_' +rec_id).innerHTML = '';

                    }

                    //$$('total_desc').innerHTML =result.total_desc;//更新合计
                    if($$("discount"))
                        $$('total_desc').innerHTML =result.dicount;//更新折扣
                    $$('saving_money').innerHTML =result.saving_money;//更新节省
                    $$('shopping_money').innerHTML =result.shopping_money;//更新总价格
                    if ($$('ECS_CARTINFO'))

                    {//更新购物车数量

                       $$('ECS_CARTINFO').innerHTML = result.cart_info;

                    }

                }

                else if (result.message != '')

                {

                    alert(result.message);

                }                

            } 
        </script>
       <?php if ($_SESSION['user_id'] > 0): ?>
       <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js')); ?>
       <script type="text/javascript" charset="utf-8">
        function collect_to_flow(goodsId)
        {
          var goods        = new Object();
          var spec_arr     = new Array();
          var fittings_arr = new Array();
          var number       = 1;
          goods.spec     = spec_arr;
          goods.goods_id = goodsId;
          goods.number   = number;
          goods.parent   = 0;
          Ajax.call('flow.php?step=add_to_cart', 'goods=' + $.toJSON(goods), collect_to_flow_response, 'POST', 'JSON');
        }
        function collect_to_flow_response(result)
        {
          if (result.error > 0)
          {
            // 如果需要缺货登记，跳转
            if (result.error == 2)
            {
              if (confirm(result.message))
              {
                location.href = 'user.php?act=add_booking&id=' + result.goods_id;
              }
            }
            else if (result.error == 6)
            {
              openSpeDiv(result.message, result.goods_id);
            }
            else
            {
              alert(result.message);
            }
          }
          else
          {
            location.href = 'flow.php';
          }
        }
      </script>
  </div>
    <div class="blank"></div>
  <?php endif; ?>
<div style="width:300px;float:right;margin:10px 0 10px 0;" class="clearfix">
    <span class="back_shop" style="margin-top: 10px; line-height: 34px; height: 34px; display: block; float: left; font-size: 13px; margin-left: 55px;"><a href="./">&lt;&lt; 继续购物</a></span>
    <div class="lm_btn1 gopay " id="pay1" onclick="javascript:goto_check()">
        <div id="to_checkout_btn" class="btncont">去结算</div> 
        <div class="cartbtnicon"></div>
        <div class="cartbtnright"></div>
    </div>

</div>
  <?php if ($this->_var['collection_goods']): ?>
  <div class="flowBox clearfix">
    <h6><span style="font-size: 16px;"><?php echo $this->_var['lang']['label_collection']; ?></span></h6>
    <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
      <?php $_from = $this->_var['collection_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
          <tr>
            <td bgcolor="#ffffff"><a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" class="f6"><?php echo $this->_var['goods']['goods_name']; ?></a></td>
            <td bgcolor="#ffffff" align="center" width="100"><a href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>);location.reload()" class="f6"><?php echo $this->_var['lang']['collect_to_flow']; ?></a></td>
          </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </table>
      <?php endif; ?>
  </div>
    <div class="blank5"></div>
  <?php endif; ?>

  <?php if ($this->_var['fittings_list']): ?>
  <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js')); ?>
  <script type="text/javascript" charset="utf-8">
  
  function fittings_to_flow(goodsId,parentId)
  {
    var goods        = new Object();
    var spec_arr     = new Array();
    var number       = 1;
    goods.spec     = spec_arr;
    goods.goods_id = goodsId;
    goods.number   = number;
    goods.parent   = parentId;
    Ajax.call('flow.php?step=add_to_cart', 'goods=' + $.toJSON(goods), fittings_to_flow_response, 'POST', 'JSON');
  }
  function fittings_to_flow_response(result)
  {
    if (result.error > 0)
    {
      // 如果需要缺货登记，跳转
      if (result.error == 2)
      {
        if (confirm(result.message))
        {
          location.href = 'user.php?act=add_booking&id=' + result.goods_id;
        }
      }
      else if (result.error == 6)
      {
        openSpeDiv(result.message, result.goods_id, result.parent);
      }
      else
      {
        alert(result.message);
      }
    }
    else
    {
      location.href = 'flow.php';
    }
  }
  </script>
  <div class="block" >
    <div class="flowBox">
    <h6><span><?php echo $this->_var['lang']['goods_fittings']; ?></span></h6>
    <form action="flow.php" method="post">
        <div class="flowGoodsFittings clearfix">
          <?php $_from = $this->_var['fittings_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'fittings');if (count($_from)):
    foreach ($_from AS $this->_var['fittings']):
?>
            <ul class="clearfix">
              <li class="goodsimg">
                <a href="<?php echo $this->_var['fittings']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['fittings']['goods_thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['fittings']['name']); ?>" class="B_blue" /></a>
              </li>
              <li>
                <a href="<?php echo $this->_var['fittings']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['fittings']['goods_name']); ?>" class="f6"><?php echo htmlspecialchars($this->_var['fittings']['short_name']); ?></a><br />
                <?php echo $this->_var['lang']['fittings_price']; ?><font class="f1"><?php echo $this->_var['fittings']['fittings_price']; ?></font><br />
                <?php echo $this->_var['lang']['parent_name']; ?><?php echo $this->_var['fittings']['parent_short_name']; ?><br />
                <a href="javascript:fittings_to_flow(<?php echo $this->_var['fittings']['goods_id']; ?>,<?php echo $this->_var['fittings']['parent_id']; ?>)"><img src="themes/365chi/images/bnt_buy.gif" alt="<?php echo $this->_var['lang']['collect_to_flow']; ?>" /></a>
              </li>
            </ul>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
    </form>
    </div>
  </div>
  <div class="blank5"></div>
  <?php endif; ?>

  <?php if ($this->_var['favourable_list']): ?>
  <div class="block">
    <div class="flowBox">
    <h6><span><?php echo $this->_var['lang']['label_favourable']; ?></span></h6>
        <?php $_from = $this->_var['favourable_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'favourable');if (count($_from)):
    foreach ($_from AS $this->_var['favourable']):
?>
        <form action="flow.php" method="post">
          <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
            <tr>
              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_name']; ?></td>
              <td bgcolor="#ffffff"><strong><?php echo $this->_var['favourable']['act_name']; ?></strong></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_period']; ?></td>
              <td bgcolor="#ffffff"><?php echo $this->_var['favourable']['start_time']; ?> --- <?php echo $this->_var['favourable']['end_time']; ?></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_range']; ?></td>
              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['far_ext'][$this->_var['favourable']['act_range']]; ?><br />
              <?php echo $this->_var['favourable']['act_range_desc']; ?></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_amount']; ?></td>
              <td bgcolor="#ffffff"><?php echo $this->_var['favourable']['formated_min_amount']; ?> --- <?php echo $this->_var['favourable']['formated_max_amount']; ?></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_type']; ?></td>
              <td bgcolor="#ffffff">
                <span class="STYLE1"><?php echo $this->_var['favourable']['act_type_desc']; ?></span>
                <?php if ($this->_var['favourable']['act_type'] == 0): ?>
                <?php $_from = $this->_var['favourable']['gift']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'gift');if (count($_from)):
    foreach ($_from AS $this->_var['gift']):
?><br />
                  <input type="checkbox" value="<?php echo $this->_var['gift']['id']; ?>" name="gift[]" />
                  <a href="goods.php?id=<?php echo $this->_var['gift']['id']; ?>" target="_blank" class="f6"><?php echo $this->_var['gift']['name']; ?></a> [<?php echo $this->_var['gift']['formated_price']; ?>]
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              <?php endif; ?>          </td>
            </tr>
            <?php if ($this->_var['favourable']['available']): ?>
            <tr>
              <td align="right" bgcolor="#ffffff">&nbsp;</td>
              <td align="center" bgcolor="#ffffff"><input type="image" src="themes/365chi/images/bnt_cat.gif" alt="Add to cart"  border="0" /></td>
            </tr>
            <?php endif; ?>
          </table>
          <input type="hidden" name="act_id" value="<?php echo $this->_var['favourable']['act_id']; ?>" />
          <input type="hidden" name="step" value="add_favourable" />
        </form>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </div>
  </div>
  <?php endif; ?>


     

<?php if ($this->_var['step'] == "done"): ?>
    
    <div class="flowBox" style="margin:30px auto 70px auto;">
    <h2 style="text-align:center; height:30px; line-height:30px;"><?php echo $this->_var['lang']['remember_order_number']; ?>: <font style="color:red"><?php echo $this->_var['order']['order_sn']; ?></font></h2>
    <table width="99%" align="center" border="0" cellpadding="15" cellspacing="0" bgcolor="#fff" style="border:1px solid #ddd; margin:20px auto;" >
    <tr>
        <td align="center" bgcolor="#FFFFFF">
        <?php if ($this->_var['order']['shipping_name']): ?><?php echo $this->_var['lang']['select_shipping']; ?>: <strong><?php echo $this->_var['order']['shipping_name']; ?></strong>，<?php endif; ?><?php echo $this->_var['lang']['select_payment']; ?>: <strong><?php echo $this->_var['order']['pay_name']; ?></strong>。<?php echo $this->_var['lang']['order_amount']; ?>: <strong><?php echo $this->_var['total']['amount_formated']; ?></strong>
        </td>
    </tr>
    <tr>
        <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['order']['pay_desc']; ?></td>
    </tr>
    <?php if ($this->_var['pay_online']): ?>
    
    <tr>
        <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['pay_online']; ?></td>
    </tr>
    <?php endif; ?>
    </table>
    <?php if ($this->_var['virtual_card']): ?>
    <div style="text-align:center;overflow:hidden;border:1px solid #E2C822;background:#FFF9D7;margin:10px;padding:10px 50px 30px;">
    <?php $_from = $this->_var['virtual_card']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vgoods');if (count($_from)):
    foreach ($_from AS $this->_var['vgoods']):
?>
    <h3 style="color:#2359B1; font-size:12px;"><?php echo $this->_var['vgoods']['goods_name']; ?></h3>
    <?php $_from = $this->_var['vgoods']['info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'card');if (count($_from)):
    foreach ($_from AS $this->_var['card']):
?>
        <ul style="list-style:none;padding:0;margin:0;clear:both">
        <?php if ($this->_var['card']['card_sn']): ?>
        <li style="margin-right:50px;float:left;">
        <strong><?php echo $this->_var['lang']['card_sn']; ?>:</strong><span style="color:red;"><?php echo $this->_var['card']['card_sn']; ?></span>
        </li><?php endif; ?>
        <?php if ($this->_var['card']['card_password']): ?>
        <li style="margin-right:50px;float:left;">
        <strong><?php echo $this->_var['lang']['card_password']; ?>:</strong><span style="color:red;"><?php echo $this->_var['card']['card_password']; ?></span>
        </li><?php endif; ?>
        <?php if ($this->_var['card']['end_date']): ?>
        <li style="float:left;">
        <strong><?php echo $this->_var['lang']['end_date']; ?>:</strong><?php echo $this->_var['card']['end_date']; ?>
        </li><?php endif; ?>
        </ul>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </div>
    <?php endif; ?>
    <p style="text-align:center; margin-bottom:20px;"><?php echo $this->_var['order_submit_back']; ?></p>
    </div>
<?php endif; ?>





</div>
<div class="blank5"></div>


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
var compare_no_goods = "<?php echo $this->_var['lang']['compare_no_goods']; ?>";
var btn_buy = "<?php echo $this->_var['lang']['btn_buy']; ?>";
var is_cancel = "<?php echo $this->_var['lang']['is_cancel']; ?>";
var select_spe = "<?php echo $this->_var['lang']['select_spe']; ?>";
</script>
</html>
