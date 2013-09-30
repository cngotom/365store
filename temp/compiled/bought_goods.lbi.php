<?php if ($this->_var['bought_goods']): ?>
<div class="box">
     <div class="mt"><span><?php echo $this->_var['lang']['shopping_and_other']; ?></span></div>
  <div class="mc clearfix boxCenterList">
  <ul class="clearfix">

       <?php $_from = $this->_var['bought_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_39266100_1358338405');if (count($_from)):
    foreach ($_from AS $this->_var['goods_0_39266100_1358338405']):
?>
       <li style="width:100%">
                <div class="goodsimg">
                        <div style="float:left">
                            <a href="<?php echo $this->_var['goods_0_39266100_1358338405']['url']; ?>"><img src="<?php echo $this->_var['goods_0_39266100_1358338405']['goods_thumb']; ?>" border="1" width="61" height="61"  class="samllimg"  alt="<?php echo htmlspecialchars($this->_var['goods_0_39266100_1358338405']['goods_name']); ?>"/></a>
                        </div>
                         <div style="float:left;margin-left: 5px;">
                                <a href="<?php echo $this->_var['goods_0_39266100_1358338405']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods_0_39266100_1358338405']['name']); ?>"><?php echo htmlspecialchars($this->_var['goods_0_39266100_1358338405']['short_name']); ?></a> <br>
                               <?php if ($this->_var['releated_goods_data']['promote_price'] != 0): ?>
                                <?php echo $this->_var['lang']['promote_price']; ?><font class="f1"><?php echo $this->_var['goods_0_39266100_1358338405']['formated_promote_price']; ?></font>
                                <?php else: ?>
                                <?php echo $this->_var['lang']['shop_price']; ?><font class="f1"><?php echo $this->_var['goods_0_39266100_1358338405']['shop_price']; ?></font>
                                <?php endif; ?>
                         </div>
                    </div>
           
          </li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        
     </ul>
  </div>
 </div>

        
 <?php endif; ?>