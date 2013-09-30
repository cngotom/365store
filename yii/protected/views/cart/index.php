
    <!--商品信息-->
    <form id="cartCheckPost" method="post" action="<?php echo $this->createUrl('confirmOrder');?>">
    <div class="cart_form">
        <?php foreach($cart_list as $cart):?>
            <div class="cart">
                <table>
                    <tr>
                        <td rowspan="4" valign="top" width="85">
                            <img alt="" src="<?php echo NGINX_IMG_HOST.$cart->goods->goods_thumb?>" width="80px" height="108px" />
                        </td>
                        <td>
                            <a href="<?php echo $this->createUrl('category/goods',array('id'=>$cart->goods_id));?>"><?php echo $cart->goods_name?></a>
                        </td>
                     </tr>
                    <tr>
                        <td>
                            <em>数量：</em><a href="javascript:less('<?php echo $cart->goods_id?>');" class="bt">-</a>
                            <input type="text" maxlength="2" value="<?php echo $cart->goods_number?>" id="num_<?php echo $cart->goods_id?>" name="num_<?php echo $cart->goods_id?>" onblur="changenum('<?php echo $cart->goods_id?>')" size="2"  class="cartqty" style="width:30px;"  />
                            <a class="bt" href="javascript:add('<?php echo $cart->goods_id?>');">+</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <em>单价：</em><span class="price">&#165;<?php echo $cart->goods_price?></span>
                        </td>
                    </tr>
                </table>
                <a href="<?php echo $this->createUrl('dropGoods',array('goods_id'=>$cart->goods_id));?>" title="删除" class="delete_p">
                    x</a>
            </div>
        <?php endforeach;?>
   
        
        <div class="cart" style="text-align: right;">
            商品总金额：<span class="red">&#165;<?php echo $total['total_price']?></span> </div>
    </div>
        <div class="use_coupons" style="display:none">
            <a class="coupons_sq" id="CouponsBox_bt1" status="+" ovalue="使用优惠代码" nvalue="使用优惠代码"
                href="javascript:CouponsBox(1);"><!--<font class="red">满180元免运费</font>-->&nbsp;&nbsp;&nbsp;使用优惠代码</a><br />
            <div id="divCouponsBox1" class="use_coupons_box" style="display: none;">
                
                <p class="tit">
                    输入优惠券：</p>
                <p>
                    <span>
                        <input name="Active_Code" maxlength="16" type="text" style="width: 160px; height: 24px"
                            id="Active_Code" /></span> <span>
                                <input onclick="return BtnActive()" name="激活" type="image" src="http://shopping.moonbasa.com/images/yhm_yz_bt.jpg" /></span>
                </p>
            </div>
        </div>
        <div class="cart-btbox">
            <span class="fl"><a href="<?php echo $this->createUrl('site/index');?>" class="favorites">继续选购</a></span>
            <span class="fr">
                <input type="submit" value="去结算" class="buy_now" /></span>
        </div>
    </form>

<script type="text/javascript">
    function pf() {
        $("#cartCheckPost").attr("action", "<?php echo $this->createUrl('checkGoods');?>");
        $("#cartCheckPost").submit();
    }

    function add(i) {
        var sumCount = $("#cartNums").html();
        var sl = $('#num_' + i).val();
        var c = 0;
        if (parseInt(sl) < 1) {
            sl = 1;
            c = 1;
        }
        else if (parseInt(sl) >= 20) {
            sl = 20;
        }
        else {
            sl = parseInt(sl) + 1;
            c = 1;
        }
        $('#num_' + i).val(sl);
        sumCount = parseInt(sumCount) + c;
        $("#cartNums").html(sumCount);
        if (sumCount > 0) {
            $("#cartNums").show();
        }
        pf();
    }
    function less(i) {
        var sl = $('#num_' + i).val();
        var c = 0;
        if (parseInt(sl) <= 1) {
            sl = 1;
        }
        else if (parseInt(sl) > 20) {
            sl = 20;
        }
        else {
            sl = parseInt(sl) - 1;
            c = 1;
        }
        $('#num_' + i).val(sl);
        var sumCount = $("#cartNums").html();
        sumCount = parseInt(sumCount) - c;
        $("#cartNums").html(sumCount);
        if (sumCount <= 0) {
            $("#cartNums").hide();
        }
        pf();
    }
    function changenum(i) {
        var sl = $('#num_' + i).val();
        if (!/^[1-9]\d*$/.test(sl)) {
            sl = 1;
        }
        else if (parseInt(sl) < 1) {
            sl = 1;
        }
        else if (parseInt(sl) > 20) {
            sl = 20;
        }
        $('#num_' + i).val(sl);
        var inputNum = $(".cartqty");
        var c = 0;
        for (var k = 0; k < inputNum.length; k++) {
            c = c + parseInt(inputNum[k].value)
        }
        $("#cartNums").html(c);
        if (c <= 0) {
            $("#cartNums").hide();
        }
        else {
            $("#cartNums").show();
        }
    }
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
    function BtnActive() {
        var active_Code = $('#Active_Code').val();
        if (active_Code.length < 3) {
            alert("请正确输入优惠代码！");
            return false;
        }
        
        window.location.href = '<?php echo $this->createUrl('validBounus',array('bouns_id'=>active_Code))?>';
        return false;
    }
    function InputDisCode(id) {
        $('#Active_Code').val($('#rdGcPwd' + id).val());
    }
</script>
  
</div>

