<div class="tuan">
 <?php $_from = $this->_var['group_buy_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['foo']['iteration']++;
?>
      <?php if (($this->_foreach['foo']['iteration'] - 1) <= 0): ?>
            <div class="fl" style="margin-left: 5px; margin-top: 8px;"><img src="themes/365chi/images/green/index/xianshi.gif" /></div>
            <div class="fr"><img src="themes/365chi/images/green/index/9dian.gif"/></div>
            <div style="position: absolute;left: 10px;top: 40px; font-size: 12px; ">
                <span><strong><?php echo $this->_var['goods']['short_nameescape:html']; ?></strong></span>
                <span style="color: gray; "><del> ￥<?php echo $this->_var['goods']['market_price']; ?></del></span>
                <span style="color: #ff6600;">折扣<?php echo $this->_var['goods']['discount']; ?>折</span>
            </div>
            <div style="position: absolute;left:140px;top:45px; ">
                <a><img width="77px" height="108px" src="<?php echo $this->_var['goods']['goods_img']; ?>"/></a>
            </div>
            <div style="position: absolute;left:0px;top:100px; z-index: 10; ">
                <img src="themes/365chi/images/green/index/tuan_b.gif"/>
            </div>
            <div  class="kankan">
                <span style="color: white;">￥</span>
                <span style="color: #ffff00; "><?php echo $this->_var['goods']['shop_price']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <span style="background: url(themes/365chi/images/green/index/yuan.gif)  no-repeat; width: 61px; text-align: center;"><a href="<?php echo $this->_var['goods']['url']; ?>" style="color:#ff6600;">去看看</a></span>
            </div>
            <div style="position: absolute;left: 10px;top: 153px; font-size: 14px;">
                <span style="color:gray;" id="leftTime"><?php echo $this->_var['lang']['please_waiting']; ?></span>
            </div>
    <?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</div>


