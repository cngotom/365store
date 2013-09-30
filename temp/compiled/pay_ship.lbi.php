<div class="o_write">
<h6><span><?php echo $this->_var['lang']['shippay_methods']; ?></span>&nbsp;<a href="javascript:close_payTypeAndShip(this)" class="f6">[关闭]</a></h6>
<div class="middle">
        <ul  id="paymentTable" class="payandshiptable">
            <li>
                <span  style="width:240px;text-align: left;padding-left:24px;"> <strong><?php echo $this->_var['lang']['payment_method']; ?></strong></span>
                <span ><strong><?php echo $this->_var['lang']['describe']; ?></strong></span>
            </li>
            <?php $_from = $this->_var['payment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'payment');if (count($_from)):
    foreach ($_from AS $this->_var['payment']):
?>
            
            <li>
              <span  style="width:240px;text-align: left;padding-left:24px;"><input id="IdPaymentType<?php echo $this->_var['payment']['pay_id']; ?>" type="radio" name="payment" value="<?php echo $this->_var['payment']['pay_id']; ?>" <?php if ($this->_var['order']['pay_id'] == $this->_var['payment']['pay_id']): ?>checked<?php endif; ?> isCod="<?php echo $this->_var['payment']['is_cod']; ?>" onclick="selectPayment(this,'pay_show_'+<?php echo $this->_var['payment']['pay_id']; ?>); " <?php if ($this->_var['cod_disabled'] && $this->_var['payment']['is_cod'] == "1"): ?>disabled="true"<?php endif; ?>/><label for="IdPaymentType<?php echo $this->_var['payment']['pay_id']; ?>"  style="margin-left:2px;"><?php echo $this->_var['payment']['pay_name']; ?></label></span>
              <span class="gray" ><?php echo $this->_var['payment']['pay_desc']; ?></span>
            </li>
            <?php if (payment.pay_show): ?>
            <li id="pay_show_<?php echo $this->_var['payment']['pay_id']; ?>" style="display: none;padding-left:20px;" class="clearfix"> 
              <?php echo $this->_var['payment']['pay_show']; ?>
            </li>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          </ul>
             <h6><span><?php echo $this->_var['lang']['shipping_method']; ?></span></h6>
          <ul  id="shippingTable" class="payandshiptable">
            <li>

              <span  style="width:240px;text-align: left;padding-left:24px;"><?php echo $this->_var['lang']['name']; ?></span>
              <span  style="width:200px;text-align: left;"><?php echo $this->_var['lang']['fee']; ?></span>
              <span><?php echo $this->_var['lang']['describe']; ?></span>
            </li>
            <?php $_from = $this->_var['shipping_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shipping');if (count($_from)):
    foreach ($_from AS $this->_var['shipping']):
?>
            <li>
              <span  style="width:240px;text-align: left;padding-left:24px;"><input name="shipping" type="radio" value="<?php echo $this->_var['shipping']['shipping_id']; ?>" <?php if ($this->_var['order']['shipping_id'] == $this->_var['shipping']['shipping_id']): ?>checked="true"<?php endif; ?> supportCod="<?php echo $this->_var['shipping']['support_cod']; ?>" insure="<?php echo $this->_var['shipping']['insure']; ?>" onclick="selectShipping(this)" />
             
              <?php echo $this->_var['shipping']['shipping_name']; ?></span>
              <span    style="width:200px;text-align: left;" ><?php echo $this->_var['shipping']['real_fee']; ?>&nbsp;元</span>
              <span class="gray"><?php echo $this->_var['shipping']['shipping_desc']; ?></span>
            
            </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

          </ul>
          <div class="footer">
            <input type="button" onclick="savePart_payAndShipping(this)" value="保存支付方式和配送方式"  class="btn">
         </div>    
    </div>
    
    <div style="display: none">
        <input id="payType_IdPaymentType" type="text" value="<?php echo $this->_var['order']['pay_id']; ?>">
        <input id="payType_IdShipmentType"  type="text" value="<?php echo $this->_var['order']['shipping_id']; ?>">
    </div>
</div>
