
            <div class="p-tab">
                <ul>
                    <li name="title1" class="current"><a href="javascript:void(0)">简介</a></li>
                    
                    <li name="title3"><a href="<?php echo $this->createUrl('review',array("id"=>$goods->goods_id));?>">
                                        评论<span style="font-size: 10px; line-height: 1em;">(<? echo $comment_count ?>)</span></a></li>
                    <li name="title4"><a href="<?php echo $this->createUrl('detail',array("id"=>$goods->goods_id));?>">
                                        详情</a></li>
                </ul>
            </div>
                    
<div class="goods-title" id="pName">
   <?php echo $goods->goods_name ?>
</div>
<!--商品简介 BEGIN -->
<div class="goods-info" id="ginfo">
        <div class="container" id="idContainer2" style="position: relative; overflow: hidden;">
            <table id="idSlider2" border="0" cellpadding="0" cellspacing="0" border="0" style="position: absolute;">
                <tr>
                    
                 <?php   foreach($goods->gallery as $ga):  ?>
                    
                        <td>
                            <img alt="" src="<?php echo NGINX_IMG_HOST.$ga->img_url ?>"  />
                        </td>
                <?php endforeach ?>
                </tr>
            </table>
        </div>	<div class="goods-operator">
            <div class="operator">
                <a class="prev" href="javascript:void(0)">
                    <img src="../../images/arrow_1.png" id="idPre" /></a>
                <div class="num">
                </div>
                <a class="next" href="javascript:void(0)">
                    <img src="../../images/arrow_2.png" id="idNext" /></a>
            </div>
        </div>
        <div class="spanColor" forsize="k" stylecode="426312228">
        </div>
        <div class="clear">
        </div>
        <div class="spanColorSize">
            <ul>
                <li class="tit">尺码：<font class="red" id="txtSizek"></font></li>
                <li class="size" id="liSizek"></li>
            </ul>
            <span class="red" id="spanCountk"></span>
        </div>
    <div id="pForm">

            <div class="looksize">        
                <a id="asize" href="<?php echo $this->createUrl('detail',array("id"=>$goods->goods_id));?>">
                    查看详情及尺码</a>    
            </div>
    

        <div class="goods-price-size">
            <div>
                商品编号:<font class="black"><?php echo $goods->goods_sn ?></font>
            </div>
            <div id="pPrice">
                  
                售价:<font class="price">&#165;<?php echo $goods->shop_price ?></font> &nbsp; &nbsp;参考价:<del>&#165;<?php echo $goods->market_price ?></del></div>
            <div class="center">
                <!-- <a   onclick="javascript:addtoFav('426312228')"  href="javascript:void(0)" >加入收藏夹</a>&nbsp;&nbsp; -->
                &nbsp; &nbsp;
              
            </div>
                <div class="cart-btbox" style="margin: 0">
                    <span class="fl cart-btbox_2"><a id="addToCart" class="favorites" href="javascript: void(0);">
                        加入购物车</a></span> <span class="fr cart-btbox_2">
                            <input type="submit" id="btnAddToCart" class="buy-btn input-rounded" value="立即购买"></span>
                </div>
        </div>
    </div>
</div>

<div id="ETLViewBuy">
</div>

<script type="text/javascript">
    var piccoun = <?php echo count($goods->gallery)?>;</script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/picMovemoonbasa.js" type="text/javascript"></script>
<script type="text/javascript">
    
    
    $(function(){
        
        $('#btnAddToCart').click(function(){
             $.ajax({  
                type: 'get',  
                url: '<?php echo $this->createUrl('cart/addToCart');?>',  
                data: {'goods_id':<?php echo $goods->goods_id ?>,'goods_num':1},  
                dataType: 'json',
                success: function(msg){
                    if(!msg.code) //成功
                    {
                        
                        location.href='<?php echo $this->createUrl('cart/index');?>'
                        //余额
                    }
                    else{
                        alert(msg.msg);
                    }
                }
            }); 
            
            
        });
       
       
        $('#addToCart').click(function(){
             $.ajax({  
                type: 'get',  
                url: '<?php echo $this->createUrl('cart/addToCart');?>',  
                data: {'goods_id':<?php echo $goods->goods_id ?>,'goods_num':1},  
                dataType: 'json',
                success: function(msg){
                    if(!msg.code) //成功
                    {
                        
                       alert('添加成功');
                       window.location.reload();
                        //余额
                    }
                    else{
                        alert(msg.msg);
                    }
                }
            }); 
            
            
        });
    
        
    })
    
    
    function AddToCart()
    {
        
        
    }
    
    
    
    
    function UpdateToCartPost() {
        var length = $("#liSizek a.select").size();
        if (length == 0) {
            alert("请选择尺码");
            return;
        }
        var spec = $("#liSizek a.select").attr("spec");

        var a1 = spec.split(",");
        var wareCode = a1[0];
        var guid = $("#guid").val();
        var webSiteId = $("#hdWebSiteId").val();
        var href = "../../Cart/Moditemtoshoppingcar?websiteid=" + webSiteId + "&warecode=" + wareCode + "&oldwarecode=&guid=" + guid;
        window.location.href = href;
    }

    function addStylePromote(prmCode) {
        var spec = $("#liSizek a.select").attr("spec");
        if (spec == null) {
            alert("请选择尺码！");
        }
        else {
            var a1 = spec.split(",");
            var wareCode = a1[0];
            window.location.href = "/Cart/AddStylePromote?prmcode=" + prmCode + "&warecode=" + wareCode + "&qty=1&styleCode=426312228&website=19&classcode="; 
        }

    }

    function showSize(sku) {
        var size_sku = document.getElementsByName("size_sku");
        for (i = 0; i < size_sku.length; i++) {
            if (size_sku[i].id == "size_" + sku) {
                size_sku[i].className = "select";
            }
            else {
                size_sku[i].className = "";
            }
        }
        objmoon("clotheCode").value = sku;
    }

    var forEach = function (array, callback, thisObject) {
        if (array.forEach) {
            array.forEach(callback, thisObject);
        } else {
            for (var i = 0, len = array.length; i < len; i++) { callback.call(thisObject, array[i], i, array); }
        }
    }
    var st = new SlideTrans("idContainer2", "idSlider2", piccoun, { Vertical: false }); //图片数量更改后需更改此数值
    var nums = [];
    forEach(nums, function (o, i) {
        o.onmouseover = function () { o.className = "on"; st.Auto = false; st.Run(i); }
        o.onmouseout = function () { o.className = ""; st.Auto = true; st.Run(); }
    })
    //设置按钮样式
    st.onStart = function () {
        forEach(nums, function (o, i) { o.className = st.Index == i ? "on" : ""; })
    }
    $("#idNext").click ( function () { st.Next(); st.Stop(); } );
    $("#idPre").click ( function () { st.Previous(); st.Stop(); } );
    //st.Run();
</script>
  
</div>
