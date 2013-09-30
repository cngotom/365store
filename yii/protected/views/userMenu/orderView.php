

<div class="common-menu">
    订单收货信息</div>
<div class="order-intro">
    <ul>
        <li><em>订单号：</em><span> <?php echo $order->order_sn;?></span> </li>
        <li><em>收货人：</em><span><?php echo $order->consignee;?></span></li>
        <li><em>联系电话：</em><span><?php echo $order->mobile;?></span></li>
        <li><em>收货地址：</em><span><?php echo $order->address;?></span>
        </li>
        <?php if( $order->zipcode):?>
        <li><em>邮编：</em><span><?php echo $order->zipcode;?></span> </li>
        <?php endif?>
        <li><em>快递：</em><span><?php echo $order->shipping_name;?></span> </li>
        <?php if( $order->invoice_no):?>
            <li><em>订单编号：</em><span><?php echo $order->invoice_no;?></span> </li>
        <?php endif?>
        <li class="logistic">
                <span style="width: 23%;">取消订单</span>
            <span style="width: 23%;"><a href="<?php echo $this->createUrl('shippingstatus',array('order_id'=>$order->order_id));?>">
               <b>查看物流</b></a></span>
                <span style="width: 23%;">发表评论</span>
           
        </li>
    </ul>
</div>
<div class="common-menu">
    订单详情</div>
<div class="order-intro">
    <ul>
        <li><em>支付方式：</em><span>            <?php echo $order->pay_name;?>
        </span></li>
        <li><em>下单时间：</em><span><?php echo $order->getAddTime();?></span> </li>
        
        <li><em>订单状态：</em><span class="red"><?php echo $order->getStatus();?></span> </li>
    </ul>
</div>
<div class="common-menu">
    商品清单&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->createUrl('cart/buyAgain',array('order_id'=>$order->order_id));?>" class="tuan_bt">添加到购物车再次购买</a>
</div>
    

<?php foreach ($goodsList as $goods) :?>
    <div class="order-intro nopd">
        <ul>

                <li>
                    <table>
                        <tbody><tr>
                            <td valign="top">
                                <a href="<?php echo $this->createUrl('category/goods',array('id'=>$goods->goods_id));?>">
                                    <img alt="" src="<?php echo NGINX_IMG_HOST.$goods->goods->goods_thumb;?>" width="80px" height="108px" style="display:block;"></a>
                            </td>
                            <td style="width: auto;">
                                <a href="<?php echo $this->createUrl('category/goods',array('id'=>$goods->goods_id));?>"><?php echo $goods->goods_name;?></a><br>
                                <em>数量：</em><?php echo $goods->goods_number;?>&nbsp;&nbsp;&nbsp;<em>小计：</em><font class="red">¥<?php echo $goods->goods_number* $goods->goods_price;?></font><br>
                            </td>
                        </tr>
                    </tbody></table>
                </li>  
        </ul>
    </div>      


<?php endforeach?>


<div class="common-menu">
    订单金额</div>
<div class="order-intro">
    <p>
        <em>商品总金额：</em><span>¥<?php echo $order->goods_amount;?></span><br>
        <em>优惠金额：</em><span>-¥0.00</span><br>
        <em>运费金额：</em><span>¥<?php echo $order->shipping_fee;?></span><br>
        <em>应付款金额：</em><span class="red">¥<?php echo $order->goods_amount + $order->shipping_fee;?></span><br>
    </p>
</div>
  
