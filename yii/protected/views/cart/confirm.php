<form action="<?php echo $this->createUrl('cart/doneOrder');?>" method="post">
    <div class="paycenter_list">
        <ul>
            <li><b>确认收货地址</b><br>
                <em>收货人：</em>asdasd&nbsp;&nbsp;&nbsp;<em>手机号：</em><?php echo $address->mobile;?><br>
                <em>地区：</em><?php echo $address->getProvinceName();?>省&nbsp;<?php echo $address->getCityName();?>市&nbsp;<?php echo $address->getDistrictName();?><br>
                <em>地址：</em><?php echo $address->address;?><br>
                <em>邮编：</em><?php echo $address->zipcode;?><br>
                <a href="<?php echo $this->createUrl('cart/consigneList');?>" class="underline" style="color: red;">修改...</a><br>
            </li>

            <li><b><a href="javascript:void(0)" id="orderlist" onclick="javascript:var a=$('#cartitems').attr('style');if(a.indexOf('none')&gt;-1){$('#cartitems').show();$('#orderlist').html('查看订单商品明细▲');}else{$('#cartitems').hide();$('#orderlist').html('查看订单商品明细▼');}">查看订单商品明细▼</a></b><br>
                <div id="cartitems" style="display: none;" class="order_pinfo">
                      <?php foreach($cart_list as $cart):?>
                        <table>
                            <tbody><tr>
                                <td width="85" valign="top">
                                    <img width="80" style="display:block;" src="<?php echo NGINX_IMG_HOST.$cart->goods->goods_thumb?>" alt="">
                                </td>
                                <td>
                                    <a href="<?php echo $this->createUrl('category/goods',array('id'=>$cart->goods_id));?>"><?php echo $cart->goods_name?></a><br>
                                    <em>数量：</em><?php echo $cart->goods_number?><br>
                                    <em>小计：</em><span class="red"><?php echo $cart->goods_number*$cart->goods_price?></span><br>
                                </td>
                            </tr>
                        </tbody></table> 
                      <?php endforeach;?>
                </div>
            </li>
            <li><b>确认订单金额</b><br>
                <em>商品总重量：<?php echo $total['total_weight']?>kg</em><br>
                <em>配送费：¥<?php echo $shipping['fee']?></em><br>
                <em>商品总金额：¥<?php echo $total['total_price']?></em><br>

                <em>实际应付金额：</em><span class="red">¥<?php echo $total['fee']?></span><br>
                <em>账户余额：¥<?php echo $user->user_money?></em><br>
            </li>
        </ul>
        
        <?php if( $user->user_money < $total['fee'] ):?>
            <div class="use_another_card">  余额不足，请您 <a 
                href="<?php echo $this->createUrl('userMenu/combineCard');?>"><!--<font class="red">满180元免运费</font>-->&nbsp;&nbsp;&nbsp;充值其他卡</a></div>
        <?php endif?>
        
        <div id="cards_area"> </div>
        <div id="card_error"> </div>
        
         <div class="use_another_card"style="display: none;">
            <a class="coupons_sq" id="CouponsBox_bt1" status="+" ovalue="使用其他卡" nvalue="使用其他卡"
                href="javascript:CouponsBox(1);"><!--<font class="red">满180元免运费</font>-->&nbsp;&nbsp;&nbsp;使用其他卡</a><br />
            <div id="divCouponsBox1" class="use_coupons_box" style="display: none;">
                
                <p class="tit">
                    输入卡号和密码：</p>
                <p>
                    <span style="height:28px;padding:2px;">  卡号 ：<input name="card_no" maxlength="16" type="text" style="width: 120px; height: 24px"
                            id="card_no" /> </span>
                    <span style="height:28px;padding:2px;">  密码 ：<input name="card_pwd" maxlength="16" type="text" style="width: 120px; height: 24px"
                            id="card_pwd" /></span> 
                    <span style="height:28px;float:right;padding-right: 30px;" >    <img onclick="addCard()" name="激活" src="http://shopping.moonbasa.com/images/yhm_yz_bt.jpg" /></span>
                </p>
            </div>
        </div>
        
    </div> 
    <div class="button">
        <input type="submit" value="提交订单" class="buy-btn">
    </div> 
</form>



<script type="text/javascript">
function CouponsBox(id) {
        var status = $('#CouponsBox_bt' + id).attr("status");
        if (status == "+") {
            $('#CouponsBox_bt' + id).attr("status", "-");
            $('#CouponsBox_bt' + id).val($('#CouponsBox_bt' + id).attr("nvalue"));
            $('#divCouponsBox' + id).show();
            $('#CouponsBox_bt' + id).attr("class", "coupons_sq coupons_zk");
        } else {
            $('#CouponsBox_bt' + id).attr("status", "+")
            $('#CouponsBox_bt' + id).val($('#CouponsBox_bt' + id).attr("ovalue"));
            $('#divCouponsBox' + id).hide();
            $('#CouponsBox_bt' + id).attr("class", "coupons_sq");
        }
}
function addCard()
{   
        $('#card_error').html('');
        $.ajax({  
            type: 'get',  
            url: '<?php echo $this->createUrl('validCard');?>',  
            data: {'name':$('#card_no').val(),'password':$('#card_pwd').val()},  
            dataType: 'json',
            success: function(msg){
                if(!msg.code)
                {
                    $('#cards_area').append(
                      " <span>卡号" + $('#card_no').val()+'余额:' +   msg.refund  + " </span></br>" 
                    );
                    //余额
                }
                else{
                    $('#card_error').html(msg.error);
                }
            }
        }); 
    
}
</script>