<div class="order-intro">
        <ul>
            <?php  foreach ($orderList as $order) {  ?>

            <a href="<?php echo $this->createUrl('userMenu/orderview',array('order_id'=>$order->order_id)); ?>">
                <li class="orderlist"><font class="gray">订单编号：</font><font class="blue">  <?php   echo $order->order_sn ;   ?> </font><br>
                    <font class="gray">下单时间：</font><font class="black"> <?php   echo $order->getAddTime() ;   ?></font><br>
                    <font class="gray">订单总价：</font><font class="red">¥ <?php   echo $order->goods_amount + $order->shipping_fee;   ?></font><br>
                    <font class="gray">订单状态：</font><font class="red"> <?php   echo $order->getStatus() ;   ?></font> </li>
            </a>
            <?php } ?>
        </ul>
    </div>

<div class="common-page">
    <span class="paginationSimplifyInfo"> 
        <?php $this->widget('CLinkPager',array('pages'=>$pages,'maxButtonCount'=>4 ,'pageSize'=>5,'header'=>'','footer'=>'','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页','lastPageLabel'=>'末页')) ?>
    </span>
</div>