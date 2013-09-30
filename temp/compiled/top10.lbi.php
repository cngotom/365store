<?php if ($this->_var['is_index']): ?>
<div class="chart fl">
    <div class="chart_b">本月销售排行</div>
    <div class="chart_c">
        <ul>
              <?php $_from = $this->_var['top_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_79845800_1358262035');$this->_foreach['top_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['top_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_79845800_1358262035']):
        $this->_foreach['top_goods']['iteration']++;
?>
                <?php if (($this->_foreach['top_goods']['iteration'] - 1) < 5): ?>
             <li>
                <div class="fl"> <img src="themes/365chi/images/green/index/<?php echo $this->_foreach['top_goods']['iteration']; ?>.gif" />&nbsp;<a href="<?php echo $this->_var['goods_0_79845800_1358262035']['url']; ?>"><img  width="30px" height="40px" src="<?php echo $this->_var['goods_0_79845800_1358262035']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods_0_79845800_1358262035']['name']); ?>" /></a></div> <div  class="chart_w fl" ><a href="<?php echo $this->_var['goods_0_79845800_1358262035']['url']; ?>"><?php echo htmlspecialchars($this->_var['goods_0_79845800_1358262035']['short_name']); ?><br><?php echo $this->_var['goods_0_79845800_1358262035']['price']; ?></a></div> 
            </li>
                <?php endif; ?>
           <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>

    </div>

</div>
<div class="chart fl">
    <div class="chart_b">本周销售排行</div>
    <div class="chart_c" >
        <ul>
            <?php $_from = $this->_var['top_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_86740400_1358262035');$this->_foreach['top_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['top_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_86740400_1358262035']):
        $this->_foreach['top_goods']['iteration']++;
?>
             <?php if (($this->_foreach['top_goods']['iteration'] - 1) < 5): ?>
             <li>
                <div class="fl"> <img src="themes/365chi/images/green/index/<?php echo $this->_foreach['top_goods']['iteration']; ?>.gif" />&nbsp;<a href="<?php echo $this->_var['goods_0_86740400_1358262035']['url']; ?>"><img  width="30px" height="40px" src="<?php echo $this->_var['goods_0_86740400_1358262035']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods_0_86740400_1358262035']['name']); ?>" /></a></div> <div  class="chart_w fl" ><a href="<?php echo $this->_var['goods_0_86740400_1358262035']['url']; ?>"><?php echo htmlspecialchars($this->_var['goods_0_86740400_1358262035']['short_name']); ?><br><?php echo $this->_var['goods_0_86740400_1358262035']['price']; ?></a></div> 
            </li>
            <?php endif; ?>
           <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

        </ul>

    </div>
</div>
<?php else: ?>
<div class="box">
     <div class="mt"><span>销售排行</span></div>
  <div class="mc clearfix boxCenterList ">
  <?php $_from = $this->_var['top_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_87621300_1358262035');$this->_foreach['top_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['top_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_87621300_1358262035']):
        $this->_foreach['top_goods']['iteration']++;
?>
  <ul class="clearfix">
      <?php if ($this->_foreach['top_goods']['iteration'] < 6): ?>
	<?php if ($this->_foreach['top_goods']['iteration'] < 6): ?>
      <li class="goodsimg">
      <a href="<?php echo $this->_var['goods_0_87621300_1358262035']['url']; ?>"><img src="<?php echo $this->_var['goods_0_87621300_1358262035']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods_0_87621300_1358262035']['name']); ?>" class="samllimg" /></a>
      </li>
	<?php endif; ?>		
      <li <?php if ($this->_foreach['top_goods']['iteration'] < 6): ?>class="iteration1"<?php endif; ?>>
      <a href="<?php echo $this->_var['goods_0_87621300_1358262035']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods_0_87621300_1358262035']['name']); ?>"><?php echo $this->_var['goods_0_87621300_1358262035']['short_name']; ?></a><br />
      <?php echo $this->_var['lang']['shop_price']; ?><font class="f1"><?php echo $this->_var['goods_0_87621300_1358262035']['price']; ?></font><br />
      </li>
      <?php endif; ?>	
    </ul>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </div>
 </div>
<div class="blank5"></div>



<?php endif; ?>