<span class="join">最近加入的商品：</span>
<ul class="shoplist">
<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
        <li>
            <a class="pic" target="_blank" href="<?php echo $this->_var['goods']['url']; ?>"><img width="36" height="36" alt="<?php echo $this->_var['goods']['goods_name']; ?>" src="<?php echo $this->_var['goods']['goods_thumb']; ?>"></a>
            <div class="info"><a target="_blank" href="<?php echo $this->_var['goods']['url']; ?>"><?php echo $this->_var['goods']['goods_name']; ?></a></div><div class="Pinfo"><span class="price"><?php echo $this->_var['goods']['goods_price']; ?> * <?php echo $this->_var['goods']['goods_number']; ?></span><a class="del" onclick="deleteCart(<?php echo $this->_var['goods']['rec_id']; ?>)" style="cursor:pointer">删除</a></div>
        </li>
     
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
   <div class="full">
        <span class="null">购物车中共有 <i><?php echo $this->_var['total']['real_goods_count']; ?></i> 种商品</span><a class="gocart" target="_blank" href="flow2.php?step=cart"><img src="http://img.kttps.com/Mall3/topbg12.gif"></a>
    </div>
</ul>