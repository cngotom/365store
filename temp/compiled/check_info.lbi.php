    
  <h6><span><?php echo $this->_var['lang']['jiesuan_methods']; ?></span></h6>

              <div id="pay_info">
                    <?php echo $this->_var['lang']['goods_all_price']; ?>: <font class="f4_b"><?php echo $this->_var['total']['goods_price_formated']; ?></font>
                    <?php if ($this->_var['total']['discount'] > 0): ?>
                    - <?php echo $this->_var['lang']['discount']; ?>: <font class="f4_b"><?php echo $this->_var['total']['discount_formated']; ?></font>
                    <?php endif; ?>
                    <?php if ($this->_var['total']['tax'] > 0): ?>
                    + <?php echo $this->_var['lang']['tax']; ?>: <font class="f4_b"><?php echo $this->_var['total']['tax_formated']; ?></font>
                    <?php endif; ?>
                    <?php if ($this->_var['total']['shipping_fee'] > 0): ?>
                    + <?php echo $this->_var['lang']['shipping_fee']; ?>: <font class="f4_b"><?php echo $this->_var['total']['shipping_fee_formated']; ?></font>
                    <?php endif; ?>
                    <?php if ($this->_var['total']['shipping_insure'] > 0): ?>
                    + <?php echo $this->_var['lang']['insure_fee']; ?>: <font class="f4_b"><?php echo $this->_var['total']['shipping_insure_formated']; ?></font>
                    <?php endif; ?>
                    <?php if ($this->_var['total']['pay_fee'] > 0): ?>
                    + <?php echo $this->_var['lang']['pay_fee']; ?>: <font class="f4_b"><?php echo $this->_var['total']['pay_fee_formated']; ?></font>
                    <?php endif; ?>
                    <?php if ($this->_var['total']['pack_fee'] > 0): ?>
                    + <?php echo $this->_var['lang']['pack_fee']; ?>: <font class="f4_b"><?php echo $this->_var['total']['pack_fee_formated']; ?></font>
                    <?php endif; ?>
                    <?php if ($this->_var['total']['card_fee'] > 0): ?>
                    + <?php echo $this->_var['lang']['card_fee']; ?>: <font class="f4_b"><?php echo $this->_var['total']['card_fee_formated']; ?></font>
                    <?php endif; ?>    </td>
                <?php if ($this->_var['total']['surplus'] > 0 || $this->_var['total']['integral'] > 0 || $this->_var['total']['bonus'] > 0): ?>

                    <?php if ($this->_var['total']['surplus'] > 0): ?>
                    - <?php echo $this->_var['lang']['use_surplus']; ?>: <font class="f4_b"><?php echo $this->_var['total']['surplus_formated']; ?></font>
                    <?php endif; ?>
                    <?php if ($this->_var['total']['integral'] > 0): ?>
                    - <?php echo $this->_var['lang']['use_integral']; ?>: <font class="f4_b"><?php echo $this->_var['total']['integral_formated']; ?></font>
                    <?php endif; ?>
                    <?php if ($this->_var['total']['bonus'] > 0): ?>
                    - <?php echo $this->_var['lang']['use_bonus']; ?>: <font class="f4_b"><?php echo $this->_var['total']['bonus_formated']; ?></font>
                    <?php endif; ?>   

                <?php endif; ?>
              </div>
           