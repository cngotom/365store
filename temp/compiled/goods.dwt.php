<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="themes/365chi/common.css" rel="stylesheet" type="text/css" />
<link href="js/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="js/style/validator.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="js/jquery.jqzoom.css">  
<link href="themes/365chi/goods.css" rel="stylesheet" type="text/css" />


<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>

<script type="text/javascript">


$(function() {
   //  $( "#sameclass" ).tabs();
   //  $( "#detailarea" ).tabs();
     
     doTabs('#sameclass');
     doTabs('#detailarea');
     
     function doTabs(id)
     {
         //default
         $(id+'>div').hide();
         $(id+'>div:first').show();
         $(id+'>ul>li:first').addClass('ui-state-active');
         
         
         //onclick
         $(id+'>ul a').each(function(index,ele){
             $(ele).click(function(){
                 
                    $(id+'>ul>li').removeClass('ui-state-active');
                    $(id+'>div').hide();

                    $(ele).parent().addClass('ui-state-active');
                    var divid = $(ele).attr('alink');
                    $(divid).show();
 
             })
            
             
         });
         
     }
});

</script>

<div class="wrap box">
 <div id="ur_here">
  <?php echo $this->fetch('library/ur_here.lbi'); ?>
 </div>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.jqzoom-core-pack.js,formValidator-4.0.1.min.js,formValidatorRegex.js,validdata.js')); ?>



<div class="blank"></div>

  <div class="detail clearfix"> 
       
       <div class="detail_l fl">
           <div class="detail_bg">欢迎光临365商城</div>
           <div class="service">
                <a class="s1 fl"  href="">满百包邮</a>
                <a class="s2 fl"  href="">正品保障</a>
                <a class="s3 fl"  href="">售后无忧</a>
           </div>
           <div class="sameclass" id="sameclass">
               <ul class="sameclass_np" >
                   <li class="fl"><a  alink="#sameclass-tabs-1" class="sameclass_n" href="javascript:void(0)" >同价格</a></li>
                   <li class="fl"><a  alink="#sameclass-tabs-2" class="sameclass_n"  href="javascript:void(0)" >同产地</a></li>
               </ul>
               
 
               
               <div class="sameclass_c" id="sameclass-tabs-1">
                   <ul>
                    <?php $_from = $this->_var['same_price']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'linked_goods_data');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['linked_goods_data']):
        $this->_foreach['foo']['iteration']++;
?>
                    <?php if (($this->_foreach['foo']['iteration'] - 1) <= 4): ?>            
                    <li class="s<?php echo $this->_foreach['foo']['iteration']; ?>">
                        <div  class="fl"><a href="<?php echo $this->_var['linked_goods_data']['url']; ?>"><img width="36" height="48" src="<?php echo $this->_var['linked_goods_data']['goods_thumb']; ?>" /></a></div>
                        <div style="width: 100px; float: right;">
                            <a href="<?php echo $this->_var['linked_goods_data']['url']; ?>"><?php echo htmlspecialchars($this->_var['linked_goods_data']['short_name']); ?><br><span style="color: red;"><?php echo $this->_var['linked_goods_data']['shop_price']; ?>&nbsp;&nbsp;</span><del><?php echo $this->_var['linked_goods_data']['market_price']; ?></del></a>

                        </div>
                    </li>  
                    <?php endif; ?>    
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>      
                   </ul>
               </div>
               
               
               
                
               <div class="sameclass_c" id="sameclass-tabs-2">
                   <ul>
                       <?php $_from = $this->_var['same_area']['goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'linked_goods_data');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['linked_goods_data']):
        $this->_foreach['foo']['iteration']++;
?>
                      <?php if (($this->_foreach['foo']['iteration'] - 1) <= 4): ?>            
                       <li class="s<?php echo $this->_foreach['foo']['iteration']; ?>">
                           <div  class="fl"><a href="<?php echo $this->_var['linked_goods_data']['url']; ?>"><img width="36" height="48" src="<?php echo $this->_var['linked_goods_data']['goods_thumb']; ?>" /></a></div>
                           <div style="width: 100px; float: right;">
                               <a href="<?php echo $this->_var['linked_goods_data']['url']; ?>"><?php echo htmlspecialchars($this->_var['linked_goods_data']['short_name']); ?><br><span style="color: red;"><?php echo $this->_var['linked_goods_data']['shop_price']; ?>&nbsp;&nbsp;</span><del><?php echo $this->_var['linked_goods_data']['market_price']; ?></del></a>
                                    
                           </div>
                       </li> 
                       <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                  
                   </ul>
               </div>
               
               
           </div>
           <div class="relate">
               
               <div class="relate_b">相关分类</div>
               <?php $_from = $this->_var['cat_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['foo']['iteration']++;
?>
                <?php if (($this->_foreach['foo']['iteration'] - 1) % 2 == 0): ?>  
                <div> 
                     
                <?php endif; ?>    
                    <span><a href="<?php echo $this->_var['cat']['url']; ?>"><?php echo $this->_var['cat']['name']; ?></a></span>
                <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total']) && ($this->_foreach['foo']['iteration'] - 1) % 2 == 0): ?>    
                 </div>
                <?php endif; ?>
                
                        
               <?php if (($this->_foreach['foo']['iteration'] - 1) % 2 != 0): ?>       
                </div> 
               <?php endif; ?>
               <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>      
              
               
               
           </div>
           
           <div class="relate">
               <div class="relate_b">浏览历史</div>
               <?php echo $this->fetch('library/history.lbi'); ?>
           </div>
           <!--
           <div class="relate2">
               <div class="relate_b">推荐产品</div>
               <div style=" height: 60px;margin-left: 10px;margin-top: 10px; margin-bottom: 10px;">
                   <div  class="fl"  style="width: 50px;border: 1px solid #c7c7c7;padding: 5px; text-align: center;"><a href="#"><img height="48" src="themes/365chi/images/goods/4.gif" /></a></div>
                    <div style="width: 100px; float: right; margin-top: 10px;">
                        <span><a>北大荒麦香拉面</a><br></span>
                        <span style="color: red;">￥4.0&nbsp;&nbsp;</span><span><del>￥4.8</del></span>
                    </div> 
               </div>
               
           </div>
           <div class="detail_ad">
               <img src="themes/365chi/images/lunbo_b22.jpg"></img>
           </div>
           <div class="detail_ad">
               <img src="themes/365chi/images/lunbo_b23.jpg"></img>
           </div>
           <div class="detail_ad">
               <img src="themes/365chi/images/lunbo_b24.jpg"></img>
           </div>
           -->
       </div>
   
      
       <div class="detail_r fr ">
           <div class="d_s_n"><?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?></div>
           <div  class="d_s_p fl">
               
               <div class="d_s_pb">
                    <a id="idgoodsimgsrc" class="jqzoom"  rel='gal1' href="<?php echo $this->_var['first_original']; ?>" onclick="window.open('gallery.php?id=<?php echo $this->_var['goods']['goods_id']; ?>'); return false;"> 
                        <?php if ($this->_var['pictures']): ?>
                              <img  id="idgoodsimg" width="320px" height="320px" src="<?php echo $this->_var['first_goodsimg']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" />
                        <?php else: ?>
                              <img src="<?php echo $this->_var['first_goodsimg']; ?>"  width="320px" height="320px" alt="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>"/>
                        <?php endif; ?>
                    </a>
               </div>
             <div class="blank5"></div>  
             
                <?php echo $this->fetch('library/goods_gallery.lbi'); ?>
            
           </div>
          <form action="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >

           <div class="d_s_info fr">
               <table>
                   <tr>
                       <td>本店价格：</td><td width="135" style="color: red; font-size: 24px;" ><?php echo $this->_var['goods']['shop_price_formated']; ?></td>
                   </tr>
                     <?php if ($this->_var['goods']['is_promote'] && $this->_var['goods']['gmt_end_time']): ?>
                    <?php echo $this->smarty_insert_scripts(array('files'=>'lefttime.js')); ?>
                     <tr>
                       <td><?php echo $this->_var['lang']['promote_price']; ?>：</td><td width="135" style="color: red; font-size: 24px;" ><?php echo $this->_var['goods']['promote_price']; ?></td>
                    </tr>
                     <tr>
                       <td><?php echo $this->_var['lang']['residual_time']; ?>：</td><td width="135" style="color: red; font-size: 24px;" ><font class="shop" id="leftTime"><?php echo $this->_var['lang']['please_waiting']; ?></font></td>
                    </tr>
                    <?php endif; ?>
                   <tr>
                       <td>市场价格：</td><td><?php echo $this->_var['goods']['market_price']; ?></td>
                       <td>  保质期：</td><td> <?php if ($this->_var['pro_baozhi']): ?><?php echo $this->_var['pro_baozhi']; ?> <?php endif; ?> </td>
                   </tr>
                   <tr>
                       <td>品&nbsp;&nbsp;&nbsp;&nbsp;牌：</td><td><?php echo $this->_var['goods']['goods_brand']; ?></td>
                       <td>库存状况：</td><td>现货</td>
                   </tr>
                   <tr> 
                       <td>规&nbsp;&nbsp;&nbsp;&nbsp;格：</td> <td>  <?php if ($this->_var['pro_guige']): ?> <?php echo $this->_var['pro_guige']; ?>   <?php endif; ?></td>
                       <td>支付方式：</td><td>网上支付、银行付款</td> 
                   </tr>
                   <tr>
                       <td>产&nbsp;&nbsp;&nbsp;&nbsp;地：</td><td> <?php if ($this->_var['pro_baozhi']): ?><?php echo $this->_var['pro_chandi']; ?> <?php endif; ?></td>
                       <td>商品货号：</td><td><?php echo $this->_var['goods']['goods_sn']; ?>  </td>
                   </tr>
           
               </table>   
               
               <table class="share">
                   <tr class="bg">
                       <td>分享到：</td>
                       <td>
                          <a href="javascript:void(0);" onclick="UI.Share.qqT();" class="s1 fl">
                </a><a href="javascript:void(0);" onclick="UI.Share.renren();" class="s2 fl"></a>
                <a href="javascript:void(0);" onclick="UI.Share.sinaT();" class="s3 fl"></a><a href="javascript:void(0);" onclick="UI.Share.kaixin();" class="s4 fl"></a>
                <a href="javascript:void(0);" onclick="UI.Share.qqZone();" class="s5 fl"></a><a href="javascript:void(0);" onclick="UI.Share.sohuT();" class="s6 fl"></a>
                       </td>
                   </tr>
                   <tr class="bg" ><td>
                        <?php echo $this->_var['lang']['amount']; ?>：</td><td><font id="ECS_GOODS_AMOUNT" class="shop"> <?php echo $this->_var['goods']['shop_price_formated']; ?></font><td>
                   </tr>
               </table>
               <div class="jiesuan">
                   <div class="jiesuan_row1">
                       <span>购买数量：</span> <span class="jia" id="jian">-</span> <input name="number" type="text" id="number" value="1" size="2" onblur="changePrice()" style="border:1px solid #ccc; "/>
<span class="jia" id="jia">+</span>
                     <?php if ($this->_var['goods']['give_integral'] > 0): ?>  <span class="bg"><a class="s7"></a></span> <span>购买此商品 赠送<?php echo $this->_var['goods']['give_integral']; ?> <?php echo $this->_var['points_name']; ?></span><?php endif; ?>
                   </div>
                   <div class="jiesuan_row2" id="gwc">
                       <span class="bg"><a class="s8" href="javascript:buyGoods(<?php echo $this->_var['goods']['goods_id']; ?>)"></a></span>
                       <span class="bg"><a class="s9" href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)"></a></span>
                       <span class="bg"><a class="s10" onclick="javascript:collect(<?php echo $this->_var['goods']['goods_id']; ?>);" ></a></span>
                       <span>(人气<?php echo $this->_var['goods']['click_count']; ?>)<br></span>
                     
                   </div>
               </div>
               
               
           </div>
          </form>
           <div class="clear"></div>
           <?php if ($this->_var['bought_goods']): ?>
           <div class="others_like">
               <div class="bg_grey">购买本商品的用户还买过</div>
               <ul>
                     <?php $_from = $this->_var['bought_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_21190900_1366123702');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_21190900_1366123702']):
        $this->_foreach['foo']['iteration']++;
?>
                       <?php if (($this->_foreach['foo']['iteration'] - 1) <= 4): ?>
                            <li>
                                <div class="sales_list">
                                    <div><a href="<?php echo $this->_var['goods_0_21190900_1366123702']['url']; ?>"><img src="<?php echo $this->_var['goods_0_21190900_1366123702']['goods_thumb']; ?>" height="100px"  alt="<?php echo htmlspecialchars($this->_var['goods_0_21190900_1366123702']['goods_name']); ?>"/></a></div>
                                        <div class="sales_info1">
                                            <span><a href="<?php echo $this->_var['goods_0_21190900_1366123702']['url']; ?>"><?php echo htmlspecialchars($this->_var['goods_0_21190900_1366123702']['short_name']); ?> </a></span>
                                        </div>
                                        <div class="sales_info2">
                                            <span style="color: red;font-size: 20px;"><?php echo $this->_var['goods_0_21190900_1366123702']['shop_price']; ?></span>
                                        </div>
                                        <div class="sales_info1">
                                            <span class="bg"><a  onclick="javascript:addToCart(<?php echo $this->_var['goods_0_21190900_1366123702']['goods_id']; ?>)" class="s11"></a></span>
                                        </div>
                                    </div>    
                            </li>
                       <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
               </ul>
               
           </div>
           <?php endif; ?>
           <div class="detailtext" id="detailarea"> 
               <ul class="clearfix">
                   <li class="bg_detail fl"><a class="ss1"  href="javascript:void(0)"   alink="#area-goods-desc">商品介绍</a></li>
                   <li class="bg_detail fl"><a class="ss2"  href="javascript:void(0)"  alink="#area-goods-comments">商品评价(<?php echo $this->_var['comment_count']; ?>)</a></li>
                   <li class="bg_detail fl"><a class="ss1"  href="javascript:void(0)"  alink="#area-how-buy">如何购买</a></li>
               </ul> 
              
               
               
               <div class="describe_text" id="area-goods-desc">
                  <?php echo $this->_var['goods']['goods_desc']; ?>
               </div>
               <div class="describe_text" id="area-goods-comments" >
                   <?php echo $this->fetch('library/comments.lbi'); ?>
               </div>
                   
                <div class="pj_content describe_text" id="area-how-buy">
                        </p> <img src="themes/365chi/images/green/howtopay.jpg" /></p>
                        <p>  <img src="themes/365chi/images/green/howtobuy.jpg" /></p>

                </div>

                   
               </div>
           </div>
           
           
       </div>   
      
   
      
   </div>
   
   






<div class="blank5"></div>

<div class="foot">
     <?php echo $this->fetch('library/help.lbi'); ?>      
     <div  class="clear"></div>
     <?php echo $this->fetch('library/page_footer.lbi'); ?>
</div>


</body>
<script type="text/javascript">
var goods_id = <?php echo $this->_var['goods_id']; ?>;
var goodsattr_style = <?php echo empty($this->_var['cfg']['goodsattr_style']) ? '1' : $this->_var['cfg']['goodsattr_style']; ?>;
var gmt_end_time = <?php echo empty($this->_var['promote_end_time']) ? '0' : $this->_var['promote_end_time']; ?>;
<?php $_from = $this->_var['lang']['goods_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var goodsId = <?php echo $this->_var['goods_id']; ?>;
var now_time = <?php echo $this->_var['now_time']; ?>;


$(function(){
      $(".jqzoom").jqzoom({
            zoomWidth: 320,
            zoomHeight: 320,
            preloadText: '图片加载中...',
            title:false,
            alwaysOn:false,  
            preloadImages: false,  
            showEffect:'fadein',
            fadeinSpeed:'fast' 
        });
        $('#jia').click(function(){
             var number = parseInt( $('#number').val() );
             number += 1;      
             $('#number').val(number);
             changePrice();  
        });
        
        $('#jian').click(function(){
             var number = parseInt( $('#number').val() );
             number -= 1;
             if(number <= 0 )
                 number = 1;
             $('#number').val(number);
             changePrice();  
        });
     
});


/**
 * 点选可选属性或改变数量时修改商品价格的函数
 */
function changePrice()
{
  //属性暂时不可用
  var attr = 0;
  var qty =  parseInt( $('#number').val() );

  $.get('goods.php','act=price&id=' + goodsId + '&attr=' + attr + '&number=' + qty, changePriceResponse, 'JSON');

}

/**
 * 接收返回的信息
 */
function changePriceResponse(res)
{
  if (res.err_msg.length > 0)
  {
    alert(res.err_msg);
  }
  else
  {
      $('#ECS_GOODS_AMOUNT').html( res.result );
  }
}


</script>
</html>
