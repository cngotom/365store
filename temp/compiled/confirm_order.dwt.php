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

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,transport.js,shopping_flow.js,region.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>

<div class="block box">
 <div id="ur_here">
  <?php echo $this->fetch('library/ur_here.lbi'); ?>
 </div>
</div>


<div class="flow_check_out">
    <h2><strong>填写核对订单信息</strong></h2>
    <div class="flow_check_table">
  <?php if ($this->_var['step'] == "checkout"): ?>
      <div class="flowBox" id="part_consignee">
          <?php if ($this->_var['need_add_consginee']): ?>
          <script type="text/javascript"> isConsigneeOpen = true; </script>
          <?php echo $this->fetch('library/consignee.lbi'); ?>
          <?php else: ?>
          <?php echo $this->fetch('library/flow/consignee_info.lbi'); ?>
          <?php endif; ?>
      </div>
     <div class="blank"></div>
    <div class="flowBox" id="part_payTypeAndShipType">
        <?php if ($this->_var['need_add_payship']): ?>
        <script type="text/javascript"> isPayTypeAndShipTypeOpen = true; </script>
        <?php echo $this->fetch('library/flow/pay_ship.lbi'); ?>
        <?php else: ?>
        <?php echo $this->fetch('library/flow/pay_ship_info.lbi'); ?>
        <?php endif; ?>
    </div>
 
     <div class="flowBox" style="display:none;" >  
         <h6><span><?php echo $this->_var['lang']['fapiao_methods']; ?></span>&nbsp;<a href="flow.php?step=consignee" class="f6">[<?php echo $this->_var['lang']['modify']; ?>]</a></h6>
         <div class="middle">
            <table style="width:100%;display:none">
                <tbody><tr>
                    <td style="text-align:left;padding-left:22px">开取类型：&nbsp;默认开取</td>
                </tr>
            </tbody></table>
            <table style="width:100%;display:">
                <tbody><tr>
                    <td style="text-align:right;width:82px;">发票类型：</td>
                    <td>普通发票</td>
                </tr>
                <tr>
                    <td style="text-align:right;">发票抬头：</td>
                    <td>个人 </td>
                </tr>
                


                 <tr>
                   <td style="text-align:right;">发票内容：</td>
                   <td>
                        <div><span style="display:none">非图书商品：</span><span style="display:;">明细</span></div>
                        <div><span style="display:none">图书商品：</span><span style="display:none;">不开发票</span></div>
                   </td>
                </tr>
            </tbody></table>
             <table style="width:100%;display:none">
                <tbody><tr>
                    <td style="text-align:left;padding-left:22px">不开发票</td>
                </tr>
            </tbody></table>
       </div>

         
     </div>
         
     
     
     
         <div class="flowBox">
        <h6><span style="margin-right:700px;"><?php echo $this->_var['lang']['goods_list']; ?></span>&nbsp;<?php if ($this->_var['allow_edit_cart']): ?><a href="flow2.php" class="f6">[<?php echo $this->_var['lang']['modifycart']; ?>]</a><?php endif; ?></h6>
        <table width="99%" align="center" border="0" cellpadding="0" class="Table"  >
            <tr class="align_Center Thead">
              <th align="left"><?php echo $this->_var['lang']['goods_sn']; ?></th>
              <th ><?php echo $this->_var['lang']['goods_name']; ?></th>
              <th> 总重量　</th>
              <th ><?php if ($this->_var['gb_deposit']): ?><?php echo $this->_var['lang']['deposit']; ?><?php else: ?><?php echo $this->_var['lang']['shop_prices']; ?><?php endif; ?></th>
              <th ><?php echo $this->_var['lang']['number']; ?></th>
              <th ><?php echo $this->_var['lang']['subtotal']; ?></th>
            </tr>
            
            
            <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
            <tr>
                <td style="padding:2px 0 2px 8px;">
                    <?php echo $this->_var['goods']['goods_sn']; ?>
                </td>
              <td  >
                <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>
                    <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6"><?php echo $this->_var['goods']['goods_name']; ?><span style="color:#FF0000;">（<?php echo $this->_var['lang']['remark_package']; ?>）</span></a>
                    <div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" style="display:none">
                        <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?>
                        <a href="goods.php?id=<?php echo $this->_var['package_goods_list']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['package_goods_list']['goods_name']; ?></a><br />
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </div>
                    <?php else: ?>
                    <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['goods']['goods_name']; ?></a>
                            <?php if ($this->_var['goods']['parent_id'] > 0): ?>
                            <span style="color:#FF0000">（<?php echo $this->_var['lang']['accessories']; ?>）</span>
                            <?php elseif ($this->_var['goods']['is_gift']): ?>
                            <span style="color:#FF0000">（<?php echo $this->_var['lang']['largess']; ?>）</span>
                            <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($this->_var['goods']['is_shipping']): ?>(<span style="color:#FF0000"><?php echo $this->_var['lang']['free_goods']; ?></span>)<?php endif; ?>
              </td>
              <td  align="left"><?php echo $this->_var['goods']['subweight']; ?> kg</td>
              <td  align="left"><?php echo $this->_var['goods']['formated_goods_price']; ?></td>
              <td  align="left"><?php echo $this->_var['goods']['goods_number']; ?></td>
              <td  align="left"><?php echo $this->_var['goods']['formated_subtotal']; ?></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            
            <?php $_from = $this->_var['exchange_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
            <tr>
                <td style="padding:2px 0 2px 8px;">
                    <?php echo $this->_var['goods']['goods_sn']; ?>
                </td>
              <td >
                    <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['goods']['goods_name']; ?></a>
              </td>
              <td  align="left"><?php echo $this->_var['goods']['goods_weight']; ?> kg</td>
              <td  align="left"><?php echo $this->_var['goods']['goods_price']; ?></td>
              <td  align="left"><?php echo $this->_var['goods']['goods_number']; ?></td>
              <td  align="left"><?php echo $this->_var['goods']['subtotal']; ?></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            
            
            
            <?php if (! $this->_var['gb_deposit']): ?>
            <tr>
                
            </tr>
            <?php endif; ?>
            <tr>
                
            </tr>
            <tr>
                <td  colspan="6" align="right" >
                    总共<font color="#C68600" style="font-weight: bold;font-size: 14px;"> <?php echo $this->_var['cart_num']; ?> </font>件商品,总重<font color="#C68600" style="font-weight: bold;font-size: 14px;"> <?php echo $this->_var['cart_weight']; ?> </font> kg &nbsp;&nbsp;
                </td>
                
            </tr>
                
          </table>
      </div>
      <div class="blank"></div>
          
      
      
      
      <div class="flowBox" id="part_checkinfo">  
         <div id="ware_info">
           <div id="part_payDetail">
           <?php echo $this->fetch('library/flow/check_info.lbi'); ?>
           </div>
              <div class="pay_money clearfix">

                    <?php if ($this->_var['allow_use_surplus']): ?>
                  <div class="f_l">
                      <a  class="f_l" onclick="showPanel('surplus');this.blur();" href="javascript:void(0);">(<span id="couponStateShow_gift">+</span>)使用账户余额</a> <br>
                        <div class="clearfix"></div>
                        <div style="display: none;" id="invoice_panl_surplus" class="get_invoice_body">
                         
                           <table>
                            <tr>
                            <td bgcolor="#ffffff"><strong><?php echo $this->_var['lang']['use_surplus']; ?>:</strong></td>
                            <td bgcolor="#ffffff">
                                <?php echo $this->_var['lang']['use_surplus']; ?>
                             <input name="surplus" type="text" class="inputBg" id="ECS_SURPLUS" size="10" value="<?php echo empty($this->_var['order']['surplus']) ? '0' : $this->_var['order']['surplus']; ?>" onblur="changeSurplus(this.value)" <?php if ($this->_var['disable_surplus']): ?>disabled="disabled"<?php endif; ?> />
                                   <?php echo $this->_var['lang']['your_surplus']; ?><?php echo empty($this->_var['your_surplus']) ? '0' : $this->_var['your_surplus']; ?> <span id="ECS_SURPLUS_NOTICE" class="notice"></span>

                           </td>
                            </tr>
                           </table>
                        </div>
               <?php endif; ?>
             
                      
                      
                      
                      
                      
                        <a  class="f_l" onclick="showPanel('gift');this.blur();" href="javascript:void(0);">(<span id="couponStateShow_gift">+</span>)使用优惠券抵消部分总额</a> <br>
                        <div class="clearfix"></div>
                        <div style="display: none;" id="invoice_panl_gift" class="get_invoice_body">
                           <?php if ($this->_var['allow_use_bonus']): ?>
                           <table>
                            <tr>
                            <td bgcolor="#ffffff"><strong><?php echo $this->_var['lang']['use_bonus']; ?>:</strong></td>
                            <td bgcolor="#ffffff">
                                <?php echo $this->_var['lang']['select_bonus']; ?>
                                <select name="bonus" onchange="changeBonus(this.value)" id="ECS_BONUS" style="border:1px solid #ccc;">
                                <option value="0" <?php if ($this->_var['order']['bonus_id'] == 0): ?>selected<?php endif; ?>><?php echo $this->_var['lang']['please_select']; ?></option>
                                <?php $_from = $this->_var['bonus_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'bonus');if (count($_from)):
    foreach ($_from AS $this->_var['bonus']):
?>
                                <option value="<?php echo $this->_var['bonus']['bonus_id']; ?>" <?php if ($this->_var['order']['bonus_id'] == $this->_var['bonus']['bonus_id']): ?>selected<?php endif; ?>><?php echo $this->_var['bonus']['type_name']; ?>[<?php echo $this->_var['bonus']['bonus_money_formated']; ?>]</option>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </select>

                                <?php echo $this->_var['lang']['input_bonus_no']; ?>
                                <input name="valid_bonus_sn"  id ="valid_bonus_sn" type="text" class="inputBg" size="15" value="<?php echo $this->_var['order']['bonus_sn']; ?>" />
                                <input name="validate_bonus" type="button" class="bnt_blue_1" value="<?php echo $this->_var['lang']['validate_bonus']; ?>" onclick="validateBonus()" style="vertical-align:middle;" />
                            </td>
                            </tr>
                           </table>
                            <?php endif; ?>
                        </div>
                        
                        
                        <a  class="f_l" onclick="showPanel('ticket');this.blur();" href="javascript:void(0);">(<span id="couponStateShow_ticket">+</span>)发票信息</a></br> 
                        <div class="clearfix"></div>
                         <div style="display: none;" id="invoice_panl_ticket" class="checkout_sub_body">
                                <ul>
                                        <li>发票类型：
                                            <?php $_from = $this->_var['inv_type_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'v');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['k'] => $this->_var['v']):
        $this->_foreach['foo']['iteration']++;
?>
                                            <label for="invoice_category_<?php echo ($this->_foreach['foo']['iteration'] - 1); ?>">&emsp;<input type="radio" rel="机构" id="invoice_category_<?php echo ($this->_foreach['foo']['iteration'] - 1); ?>"  onclick="javascript:invoice_type = this.value   ;"  value="<?php echo $this->_var['k']; ?>" name="invoice_category_radio">&ensp;<?php echo $this->_var['k']; ?></label>&emsp;
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </li>
                                        <li>发票内容：
                                            <?php $_from = $this->_var['inv_content_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'v');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['v']):
        $this->_foreach['foo']['iteration']++;
?>
                                            <label for="invoice_content_<?php echo ($this->_foreach['foo']['iteration'] - 1); ?>">&emsp;<input type="radio" rel="机构" id="invoice_content_<?php echo ($this->_foreach['foo']['iteration'] - 1); ?>"  onclick="javascript:invoice_content = this.value   ;"  value="<?php echo $this->_var['v']; ?>" name="invoice_content_radio">&ensp;<?php echo $this->_var['v']; ?></label>&emsp;
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </li>
                                        <li> 发票抬头：<input type="text" maxlength="50" size="60" rel="请填写个人姓名或单位名称(必填)" id="input_invoice_title" value="" class="focusInput focusTxt" name="invoice_title"></li>
                                     
                                        <!-- <li>购货方识别号：<input type="text" name="invoice_identifier" id="invoice_identifier" rel="请填写企业税号或组织机构代码号或个人身份证号(选填)" class="focusInput" size="60"/></li> -->
                                        <li><span class="red">备注说明：</span></li>
                                        <li style="height: 20px;"><span class="gray">1、发票内容统一为“食品”，发票金额以实际支付金额为准；</span></li>
                                        <li><span class="gray">2、若您的订单不是从嘉兴发货，您的发票将单独用平信寄出，请确认您的收货地址和邮编正确无误，避免发票遗失。</span></li>
                                </ul>
                        </div>
                          
     
                  </div>
                        
                  <div  style="margin-right: 50px;font-size: 14px;font-weight: 700;text-align: right;">
                      <?php echo $this->_var['lang']['total_fee']; ?>: &nbsp;<font color="red" id="total_fee">￥<?php echo $this->_var['total']['amount_formated']; ?></font>&nbsp;元        
                  </div>
              </div>
          </div>
            <div id="part_remark" style="padding-left:10px;margin-top: 10px;">
                <span >
                    <input type="checkbox" onclick="showForm_remark(this)"><font id="showForm_remark">订单备注
                    </font>
                </span>
                <span  ><input type="text" id="order_extra_info" style="display: none;"  >
                </span>
                <div id="order_extra_info_tips" style="margin-left:30px;font-size:10px;display: none;" > <span class="red" >*提示</span >：请勿填写有关支付、收货、发票方面的信息。 </div>
            </div>
      </div>
        
      
    <div id="submit_error"></div> 
    
    <div class="flowBox">
        <div align="right" style="margin:8px auto;">
            <input type="image" onclick="submit_order()" src="http://www.360buy.com/purchase/skin/images/submit.jpg" />
            </div>
    </div>
      
      
    <?php endif; ?>
    <?php if (0): ?>
    
    <?php if ($this->_var['total']['real_goods_count'] != 0): ?>
    <div class="flowBox">
    <h6><span><?php echo $this->_var['lang']['shipping_method']; ?></span></h6>
    <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" id="shippingTable">
            <tr>
              <th  width="5%">&nbsp;</th>
              <th  width="25%"><?php echo $this->_var['lang']['name']; ?></th>
              <th ><?php echo $this->_var['lang']['describe']; ?></th>
              <th  width="15%"><?php echo $this->_var['lang']['fee']; ?></th>
              <th  width="15%"><?php echo $this->_var['lang']['free_money']; ?></th>
              <th  width="15%"><?php echo $this->_var['lang']['insure_fee']; ?></th>
            </tr>
            <?php $_from = $this->_var['shipping_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shipping');if (count($_from)):
    foreach ($_from AS $this->_var['shipping']):
?>
            <tr>
              <td  valign="top"><input name="shipping" type="radio" value="<?php echo $this->_var['shipping']['shipping_id']; ?>" <?php if ($this->_var['order']['shipping_id'] == $this->_var['shipping']['shipping_id']): ?>checked="true"<?php endif; ?> supportCod="<?php echo $this->_var['shipping']['support_cod']; ?>" insure="<?php echo $this->_var['shipping']['insure']; ?>" onclick="selectShipping(this)" />
              </td>
              <td  valign="top"><strong><?php echo $this->_var['shipping']['shipping_name']; ?></strong></td>
              <td  valign="top"><?php echo $this->_var['shipping']['shipping_desc']; ?></td>
              <td  align="right" valign="top"><?php echo $this->_var['shipping']['format_shipping_fee']; ?></td>
              <td  align="right" valign="top"><?php echo $this->_var['shipping']['free_money']; ?></td>
              <td  align="right" valign="top"><?php if ($this->_var['shipping']['insure'] != 0): ?><?php echo $this->_var['shipping']['insure_formated']; ?><?php else: ?><?php echo $this->_var['lang']['not_support_insure']; ?><?php endif; ?></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <tr>
              <td colspan="6"  align="right"><label for="ECS_NEEDINSURE">
                <input name="need_insure" id="ECS_NEEDINSURE" type="checkbox"  onclick="selectInsure(this.checked)" value="1" <?php if ($this->_var['order']['need_insure']): ?>checked="true"<?php endif; ?> <?php if ($this->_var['insure_disabled']): ?>disabled="true"<?php endif; ?>  />
                <?php echo $this->_var['lang']['need_insure']; ?> </label></td>
            </tr>
          </table>
    </div>
    <div class="blank"></div>
        <?php else: ?>
        <input name = "shipping" type="radio" value = "-1" checked="checked"  style="display:none"/>
        <?php endif; ?>
    <?php if ($this->_var['is_exchange_goods'] != 1 || $this->_var['total']['real_goods_count'] != 0): ?>
    <div class="flowBox">
    <h6><span><?php echo $this->_var['lang']['payment_method']; ?></span></h6>
    <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" id="paymentTable">
            <tr>
              <th width="5%" >&nbsp;</th>
              <th width="20%" ><?php echo $this->_var['lang']['name']; ?></th>
              <th ><?php echo $this->_var['lang']['describe']; ?></th>
              <th  width="15%"><?php echo $this->_var['lang']['pay_fee']; ?></th>
            </tr>
            <?php $_from = $this->_var['payment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'payment');if (count($_from)):
    foreach ($_from AS $this->_var['payment']):
?>
            
            <tr>
              <td valign="top" ><input type="radio" name="payment" value="<?php echo $this->_var['payment']['pay_id']; ?>" <?php if ($this->_var['order']['pay_id'] == $this->_var['payment']['pay_id']): ?>checked<?php endif; ?> isCod="<?php echo $this->_var['payment']['is_cod']; ?>" onclick="selectPayment(this)" <?php if ($this->_var['cod_disabled'] && $this->_var['payment']['is_cod'] == "1"): ?>disabled="true"<?php endif; ?>/></td>
              <td valign="top" ><strong><?php echo $this->_var['payment']['pay_name']; ?></strong></td>
              <td valign="top" ><?php echo $this->_var['payment']['pay_desc']; ?></td>
              <td align="right"  valign="top"><?php echo $this->_var['payment']['format_pay_fee']; ?></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          </table>
    </div>
    <?php else: ?>
        <input name = "payment" type="radio" value = "-1" checked="checked"  style="display:none"/>
    <?php endif; ?>
    
    
    <div class="blank"></div>
          <?php if ($this->_var['pack_list']): ?>
          <div class="flowBox">
          <h6><span><?php echo $this->_var['lang']['goods_package']; ?></span></h6>
          <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" id="packTable">
            <tr>
              <th width="5%" scope="col" >&nbsp;</th>
              <th width="35%" scope="col" ><?php echo $this->_var['lang']['name']; ?></th>
              <th width="22%" scope="col" ><?php echo $this->_var['lang']['price']; ?></th>
              <th width="22%" scope="col" ><?php echo $this->_var['lang']['free_money']; ?></th>
              <th scope="col" ><?php echo $this->_var['lang']['img']; ?></th>
            </tr>
            <tr>
              <td valign="top" ><input type="radio" name="pack" value="0" <?php if ($this->_var['order']['pack_id'] == 0): ?>checked="true"<?php endif; ?> onclick="selectPack(this)" /></td>
              <td valign="top" ><strong><?php echo $this->_var['lang']['no_pack']; ?></strong></td>
              <td valign="top" >&nbsp;</td>
              <td valign="top" >&nbsp;</td>
              <td valign="top" >&nbsp;</td>
            </tr>
            <?php $_from = $this->_var['pack_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pack');if (count($_from)):
    foreach ($_from AS $this->_var['pack']):
?>
            <tr>
              <td valign="top" ><input type="radio" name="pack" value="<?php echo $this->_var['pack']['pack_id']; ?>" <?php if ($this->_var['order']['pack_id'] == $this->_var['pack']['pack_id']): ?>checked="true"<?php endif; ?> onclick="selectPack(this)" />
              </td>
              <td valign="top" ><strong><?php echo $this->_var['pack']['pack_name']; ?></strong></td>
              <td valign="top"  align="right"><?php echo $this->_var['pack']['format_pack_fee']; ?></td>
              <td valign="top"  align="right"><?php echo $this->_var['pack']['format_free_money']; ?></td>
              <td valign="top"  align="center">
                  <?php if ($this->_var['pack']['pack_img']): ?>
                  <a href="data/packimg/<?php echo $this->_var['pack']['pack_img']; ?>" target="_blank" class="f6"><?php echo $this->_var['lang']['view']; ?></a>
                  <?php else: ?>
                  <?php echo $this->_var['lang']['no']; ?>
                  <?php endif; ?>
               </td>
            </tr>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          </table>
       </div>
             <div class="blank"></div>
          <?php endif; ?>

          <?php if ($this->_var['card_list']): ?>
          <div class="flowBox">
          <h6><span><?php echo $this->_var['lang']['goods_card']; ?></span></h6>
          <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" id="cardTable">
            <tr>
              <th  width="5%" scope="col">&nbsp;</th>
              <th  width="35%" scope="col"><?php echo $this->_var['lang']['name']; ?></th>
              <th  width="22%" scope="col"><?php echo $this->_var['lang']['price']; ?></th>
              <th  width="22%" scope="col"><?php echo $this->_var['lang']['free_money']; ?></th>
              <th  scope="col"><?php echo $this->_var['lang']['img']; ?></th>
            </tr>
            <tr>
              <td  valign="top"><input type="radio" name="card" value="0" <?php if ($this->_var['order']['card_id'] == 0): ?>checked="true"<?php endif; ?> onclick="selectCard(this)" /></td>
              <td  valign="top"><strong><?php echo $this->_var['lang']['no_card']; ?></strong></td>
              <td  valign="top">&nbsp;</td>
              <td  valign="top">&nbsp;</td>
              <td  valign="top">&nbsp;</td>
            </tr>
            <?php $_from = $this->_var['card_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'card');if (count($_from)):
    foreach ($_from AS $this->_var['card']):
?>
            <tr>
              <td valign="top" ><input type="radio" name="card" value="<?php echo $this->_var['card']['card_id']; ?>" <?php if ($this->_var['order']['card_id'] == $this->_var['card']['card_id']): ?>checked="true"<?php endif; ?> onclick="selectCard(this)"  />
              </td>
              <td valign="top" ><strong><?php echo $this->_var['card']['card_name']; ?></strong></td>
              <td valign="top" align="right" ><?php echo $this->_var['card']['format_card_fee']; ?></td>
              <td valign="top" align="right" ><?php echo $this->_var['card']['format_free_money']; ?></td>
              <td valign="top" align="center" >
                  <?php if ($this->_var['card']['card_img']): ?>
                  <a href="data/cardimg/<?php echo $this->_var['card']['card_img']; ?>" target="_blank" class="f6"><?php echo $this->_var['lang']['view']; ?></a>
                  <?php else: ?>
                  <?php echo $this->_var['lang']['no']; ?>
                  <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <tr>
              <td ></td>
              <td  valign="top"><strong><?php echo $this->_var['lang']['bless_note']; ?>:</strong></td>
              <td  colspan="3"><textarea name="card_message" cols="60" rows="3" style="width:auto; border:1px solid #ccc;"><?php echo htmlspecialchars($this->_var['order']['card_message']); ?></textarea></td>
            </tr>
          </table>
        </div>
                <div class="blank"></div>
        <?php endif; ?>

      <div class="flowBox">
    <h6><span><?php echo $this->_var['lang']['other_info']; ?></span></h6>
      <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
            <?php if ($this->_var['allow_use_surplus']): ?>
            <tr>
              <td width="20%" ><strong><?php echo $this->_var['lang']['use_surplus']; ?>: </strong></td>
              <td ><input name="surplus" type="text" class="inputBg" id="ECS_SURPLUS" size="10" value="<?php echo empty($this->_var['order']['surplus']) ? '0' : $this->_var['order']['surplus']; ?>" onblur="changeSurplus(this.value)" <?php if ($this->_var['disable_surplus']): ?>disabled="disabled"<?php endif; ?> />
              <?php echo $this->_var['lang']['your_surplus']; ?><?php echo empty($this->_var['your_surplus']) ? '0' : $this->_var['your_surplus']; ?> <span id="ECS_SURPLUS_NOTICE" class="notice"></span></td>
            </tr>
            <?php endif; ?>
            <?php if ($this->_var['allow_use_integral']): ?>
            <tr>
              <td ><strong><?php echo $this->_var['lang']['use_integral']; ?></strong></td>
              <td ><input name="integral" type="text" class="input" id="ECS_INTEGRAL" onblur="changeIntegral(this.value)" value="<?php echo empty($this->_var['order']['integral']) ? '0' : $this->_var['order']['integral']; ?>" size="10" />
              <?php echo $this->_var['lang']['can_use_integral']; ?>:<?php echo empty($this->_var['your_integral']) ? '0' : $this->_var['your_integral']; ?> <?php echo $this->_var['points_name']; ?>，<?php echo $this->_var['lang']['noworder_can_integral']; ?><?php echo $this->_var['order_max_integral']; ?>  <?php echo $this->_var['points_name']; ?>. <span id="ECS_INTEGRAL_NOTICE" class="notice"></span></td>
            </tr>
            <?php endif; ?>
            <?php if ($this->_var['allow_use_bonus']): ?>
            <tr>
              <td ><strong><?php echo $this->_var['lang']['use_bonus']; ?>:</strong></td>
              <td >
                <?php echo $this->_var['lang']['select_bonus']; ?>
                <select name="bonus" onchange="changeBonus(this.value)" id="ECS_BONUS" style="border:1px solid #ccc;">
                  <option value="0" <?php if ($this->_var['order']['bonus_id'] == 0): ?>selected<?php endif; ?>><?php echo $this->_var['lang']['please_select']; ?></option>
                  <?php $_from = $this->_var['bonus_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'bonus');if (count($_from)):
    foreach ($_from AS $this->_var['bonus']):
?>
                  <option value="<?php echo $this->_var['bonus']['bonus_id']; ?>" <?php if ($this->_var['order']['bonus_id'] == $this->_var['bonus']['bonus_id']): ?>selected<?php endif; ?>><?php echo $this->_var['bonus']['type_name']; ?>[<?php echo $this->_var['bonus']['bonus_money_formated']; ?>]</option>
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </select>

                <?php echo $this->_var['lang']['input_bonus_no']; ?>
                <input name="bonus_sn" type="text" class="inputBg" size="15" value="<?php echo $this->_var['order']['bonus_sn']; ?>" />
                <input name="validate_bonus" type="button" class="bnt_blue_1" value="<?php echo $this->_var['lang']['validate_bonus']; ?>" onclick="validateBonus(document.forms['theForm'].elements['bonus_sn'].value)" style="vertical-align:middle;" />
              </td>
            </tr>
            <?php endif; ?>
            <?php if ($this->_var['inv_content_list']): ?>
            <tr>
              <td ><strong><?php echo $this->_var['lang']['invoice']; ?>:</strong>
                <input name="need_inv" type="checkbox"  class="input" id="ECS_NEEDINV" onclick="changeNeedInv()" value="1" <?php if ($this->_var['order']['need_inv']): ?>checked="true"<?php endif; ?> />
              </td>
              <td >
                <?php if ($this->_var['inv_type_list']): ?>
                <?php echo $this->_var['lang']['invoice_type']; ?>
                <select name="inv_type" id="ECS_INVTYPE" <?php if ($this->_var['order']['need_inv'] != 1): ?>disabled="true"<?php endif; ?> onchange="changeNeedInv()" style="border:1px solid #ccc;">
                <?php echo $this->html_options(array('options'=>$this->_var['inv_type_list'],'selected'=>$this->_var['order']['inv_type'])); ?></select>
                <?php endif; ?>
                <?php echo $this->_var['lang']['invoice_title']; ?>
                <input name="inv_payee" type="text"  class="input" id="ECS_INVPAYEE" size="20" <?php if (! $this->_var['order']['need_inv']): ?>disabled="true"<?php endif; ?> value="<?php echo $this->_var['order']['inv_payee']; ?>" onblur="changeNeedInv()" />
                <?php echo $this->_var['lang']['invoice_content']; ?>
              <select name="inv_content" id="ECS_INVCONTENT" <?php if ($this->_var['order']['need_inv'] != 1): ?>disabled="true"<?php endif; ?>  onchange="changeNeedInv()" style="border:1px solid #ccc;">

                <?php echo $this->html_options(array('values'=>$this->_var['inv_content_list'],'output'=>$this->_var['inv_content_list'],'selected'=>$this->_var['order']['inv_content'])); ?>

                </select></td>
            </tr>
            <?php endif; ?>
            <tr>
              <td valign="top" ><strong><?php echo $this->_var['lang']['order_postscript']; ?>:</strong></td>
              <td ><textarea name="postscript" cols="80" rows="3" id="postscript" style="border:1px solid #ccc;"><?php echo htmlspecialchars($this->_var['order']['postscript']); ?></textarea></td>
            </tr>
            <?php if ($this->_var['how_oos_list']): ?>
            <tr>
              <td ><strong><?php echo $this->_var['lang']['booking_process']; ?>:</strong></td>
              <td ><?php $_from = $this->_var['how_oos_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('how_oos_id', 'how_oos_name');if (count($_from)):
    foreach ($_from AS $this->_var['how_oos_id'] => $this->_var['how_oos_name']):
?>
                <label>
                <input name="how_oos" type="radio" value="<?php echo $this->_var['how_oos_id']; ?>" <?php if ($this->_var['order']['how_oos'] == $this->_var['how_oos_id']): ?>checked<?php endif; ?> onclick="changeOOS(this)" />
                <?php echo $this->_var['how_oos_name']; ?></label>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </td>
            </tr>
            <?php endif; ?>
          </table>
    </div>
    <div class="blank"></div>

  
        <?php endif; ?>
    </div>
    <div class="round"><div class="lround"></div><div class="rround"></div></div>

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