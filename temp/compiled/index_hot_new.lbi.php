<div class="tuijian fr">
    
    <div class="tuijian_m">

        <ul>
            <li >
            <a href="#" class="cur" index="0"><span>特价产品</span></a>
            </li>
            <li>
            <a href="#" index="1"><span>促销产品</span></a>
            </li>
            <li>
            <a href="#" index="2"><span>最新产品</span></a>
            </li>
            <li>
            <a href="#" index="3"><span>热卖产品</span></a>
            </li>

        </ul> 
        
        <div style="clear: left;height:3px; line-height:2px; width:770px;  background-color: #eead2c;  "> &nbsp;</div>

    </div>
        
        
   <div class="tuijian_sales cur">     
        <?php $_from = $this->_var['best_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_91844600_1358262035');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_91844600_1358262035']):
        $this->_foreach['foo']['iteration']++;
?>
          <?php if (($this->_foreach['foo']['iteration'] - 1) <= 2): ?>
            <div class="tuijian_c fl"><a href="<?php echo $this->_var['goods_0_91844600_1358262035']['url']; ?>"><img src="<?php echo $this->_var['goods_0_91844600_1358262035']['goods_img']; ?>" width="173" height="173"/></a>
                    <div class="clear"></div>
                 
                <div class="tuijian_p tuijian_p<?php echo ($this->_foreach['foo']['iteration'] - 1); ?> ">
                    <a href="<?php echo $this->_var['goods_0_91844600_1358262035']['url']; ?>"><span class='g_name'><?php echo $this->_var['goods_0_91844600_1358262035']['name']; ?></span>
                    <span style="font-size: 25px; float:left;"> <?php if ($this->_var['goods_0_91844600_1358262035']['promote_price'] != ""): ?>
                    <?php echo $this->_var['goods_0_91844600_1358262035']['promote_price']; ?>
                    <?php else: ?>
                    <?php echo $this->_var['goods_0_91844600_1358262035']['shop_price']; ?>
                    <?php endif; ?></span></a>
                </div>
            </div>
          <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </div>
    
    
    <div class="tuijian_sales">
          <?php $_from = $this->_var['promotion_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_94438400_1358262035');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_94438400_1358262035']):
        $this->_foreach['foo']['iteration']++;
?>
           <?php if (($this->_foreach['foo']['iteration'] - 1) <= 2): ?>
            <div class="tuijian_c fl"><a href="<?php echo $this->_var['goods_0_94438400_1358262035']['url']; ?>"><img src="<?php echo $this->_var['goods_0_94438400_1358262035']['goods_img']; ?>" width="173" height="255"/></a>
                    <div class="clear"></div>
                 
                <div class="tuijian_p tuijian_p<?php echo ($this->_foreach['foo']['iteration'] - 1); ?> ">
                    <a href="<?php echo $this->_var['goods_0_94438400_1358262035']['url']; ?>"><span class='g_name'><?php echo $this->_var['goods_0_94438400_1358262035']['name']; ?></span>
                    <span style="font-size: 25px; float:left;"> <?php if ($this->_var['goods_0_94438400_1358262035']['promote_price'] != ""): ?>
                    <?php echo $this->_var['goods_0_94438400_1358262035']['promote_price']; ?>
                    <?php else: ?>
                    <?php echo $this->_var['goods_0_94438400_1358262035']['shop_price']; ?>
                    <?php endif; ?></span></a>
                </div>
            </div>
          <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </div>
    
    
    <div class="tuijian_sales">
          <?php $_from = $this->_var['new_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_96212800_1358262035');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_96212800_1358262035']):
        $this->_foreach['foo']['iteration']++;
?>
           <?php if (($this->_foreach['foo']['iteration'] - 1) <= 2): ?>
            <div class="tuijian_c fl"><a href="<?php echo $this->_var['goods_0_96212800_1358262035']['url']; ?>"><img src="<?php echo $this->_var['goods_0_96212800_1358262035']['goods_img']; ?>" width="173" height="255"/></a>
                    <div class="clear"></div>
                 
                <div class="tuijian_p tuijian_p<?php echo ($this->_foreach['foo']['iteration'] - 1); ?> ">
                    <a href="<?php echo $this->_var['goods_0_96212800_1358262035']['url']; ?>"><span class='g_name'><?php echo $this->_var['goods_0_96212800_1358262035']['name']; ?></span>
                    <span style="font-size: 25px; float:left;"> <?php if ($this->_var['goods_0_96212800_1358262035']['promote_price'] != ""): ?>
                    <?php echo $this->_var['goods_0_96212800_1358262035']['promote_price']; ?>
                    <?php else: ?>
                    <?php echo $this->_var['goods_0_96212800_1358262035']['shop_price']; ?>
                    <?php endif; ?></span></a>
                </div>
            </div>
          <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </div>
    
    
    <div class="tuijian_sales">
          <?php $_from = $this->_var['hot_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_97143800_1358262035');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_97143800_1358262035']):
        $this->_foreach['foo']['iteration']++;
?>
           <?php if (($this->_foreach['foo']['iteration'] - 1) <= 2): ?>
            <div class="tuijian_c fl"><a href="<?php echo $this->_var['goods_0_97143800_1358262035']['url']; ?>"><img src="<?php echo $this->_var['goods_0_97143800_1358262035']['goods_img']; ?>" width="173" height="255"/></a>
                    <div class="clear"></div>
                 
                <div class="tuijian_p tuijian_p<?php echo ($this->_foreach['foo']['iteration'] - 1); ?> ">
                    <a href="<?php echo $this->_var['goods_0_97143800_1358262035']['url']; ?>"><span class='g_name'><?php echo $this->_var['goods_0_97143800_1358262035']['name']; ?></span>
                    <span style="font-size: 25px; float:left;"> <?php if ($this->_var['goods_0_97143800_1358262035']['promote_price'] != ""): ?>
                    <?php echo $this->_var['goods_0_97143800_1358262035']['promote_price']; ?>
                    <?php else: ?>
                    <?php echo $this->_var['goods_0_97143800_1358262035']['shop_price']; ?>
                    <?php endif; ?></span></a>
                </div>
            </div>
          <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </div>
    
    
    <div class="tuijian_list fr">
        <ul style="fr">
            <li class="normal"><a href="goods.php?id=1521">龙王女人豆浆粉<span>￥18.0</span></a></li>
            <li class="cu" style="display: block;"><img src="themes/365chi/images/green/index/tj4.gif" /></li>
            <li class="normal"><a  href="goods.php?id=56225">北大荒有机小米<span>￥7.5</span></a></li>
            <li class="cu"><img src="themes/365chi/images/green/index/tj3.gif" /></li>
            <li class="normal"><a  href="goods.php?id=1600">北大荒九三豆油<span>￥70.0</span></a></li>
            <li class="cu"><img src="themes/365chi/images/green/index/tj2.gif" /></li>
            <li class="normal"> <a  href="goods.php?id=56197">北大荒稻花香米<span>￥68.0</span></a></li>
            <li class="cu"><img src="themes/365chi/images/green/index/tj1.gif" /></li>
        </ul>
    </div>
</div>
<script type="text/javascript">

$(function() {
    $('.tuijian_m a').hover(function(){
        var index = $(this).attr('index');
        //remover cur
        $('.tuijian_m .cur').removeClass('cur');
        $('.tuijian_sales.cur').removeClass('cur');
        //Add cur
        $(this).addClass('cur');        
        $('.tuijian_sales:eq('+index+')').addClass('cur');
    });
    
    $('.tuijian_list a').each(function(index,ele){
        $(this).hover( function(){
            $('.tuijian_list .cu').hide();
            $('.tuijian_list .cu:eq('+index+')').show();
        });
    });

});


</script>
