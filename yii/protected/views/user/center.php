<div class="order-intro">
    <ul>
        <li><em>用户名：</em><span><?php echo $user->user_name; ?></span> </li>
        <li><em>会员级别：</em><span>普通客户</span> </li>
        <li><em>余额：</em><span class="red">￥<?php echo $user->user_money; ?></span> </li>

    </ul>
</div>

<div class="menu-botton">
    <ul>
        <a href="<?php echo $this->createUrl('userMenu/orderList'); ?>">
            <li>
                <img src="/Themes/moonbasa/images/button_8.png" alt="">我的订单<span class="menu-botton-arrow"></span></li>
        </a>
        <!--
        <a href="/Member/NoArrivalOrderList/?guid=e7da913f6d0d49f79d42436b351ed0a7&amp;pageindex=1">
            <li>
                <img src="/Themes/moonbasa/images/button_12.png" alt="">物流查询<span class="menu-botton-arrow"></span></li>
        </a>


                <a href="/Member/MyDiscount/?guid=e7da913f6d0d49f79d42436b351ed0a7">
                    <li>
                        <img src="/Themes/moonbasa/images/lpk.png" alt="">礼券余额<span class="menu-botton-arrow"></span></li></a>
        <a href="/Member/MyFavorite/?guid=e7da913f6d0d49f79d42436b351ed0a7">
            <li>
                <img src="/Themes/moonbasa/images/button_9.png" alt="">我的收藏<span class="menu-botton-arrow"></span></li></a>
        -->
        <a href="<?php echo $this->createUrl('userMenu/addressList'); ?>">
            <li>
                <img src="/Themes/moonbasa/images/button_10.png" alt="">地址管理<span class="menu-botton-arrow"></span></li></a>

        <a href="<?php echo $this->createUrl('userMenu/combineCard'); ?>">
            <li>
                <img src="/Themes/moonbasa/images/icon_msg.png" alt="">礼卡充值<span class="menu-botton-arrow"></span></li></a>
        <!--endhide-->
    </ul>
</div>