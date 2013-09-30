<meta http-equiv="Content-Type" conetent="text/html; charset=utf-8">
<?php if ($this->_var['promotion_goods']): ?>
<div class="box">
     <div class="mt"><span>促销产品</span></div>
  <div class="mc clearfix boxCenterList">
  <ul class="clearfix">
             <?php $_from = $this->_var['promotion_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_00882900_1354809047');$this->_foreach['promotion_foreach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['promotion_foreach']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_00882900_1354809047']):
        $this->_foreach['promotion_foreach']['iteration']++;
?>
             <li style="width:100%">
                    <?php if (($this->_foreach['promotion_foreach']['iteration'] - 1) <= 20): ?>
                    <div class="goodsimg">
                        <div style="float:left">
                            <a href="<?php echo $this->_var['goods_0_00882900_1354809047']['url']; ?>"><img src="<?php echo $this->_var['goods_0_00882900_1354809047']['thumb']; ?>" border="1" width="61" height="61"  class="samllimg"  alt="<?php echo htmlspecialchars($this->_var['goods_0_00882900_1354809047']['name']); ?>"/></a>
                        </div>
                         <div style="float:left;margin-left: 5px;">
                                <a href="<?php echo $this->_var['goods_0_00882900_1354809047']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods_0_00882900_1354809047']['name']); ?>"><?php echo htmlspecialchars($this->_var['goods_0_00882900_1354809047']['short_name']); ?></a> <br>
                                 <?php echo $this->_var['lang']['promote_price']; ?><font class="f1"><?php echo $this->_var['goods_0_00882900_1354809047']['promote_price']; ?></font>

                         </div>
                    </div>
                    <?php endif; ?>
             </li>
         <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
  </div>
 </div>

 
<?php endif; ?>
