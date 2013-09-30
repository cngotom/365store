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
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
<link href="js/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="js/style/validator.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="js/jquery.jqzoom.css">  


<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>
<script type="text/javascript">
function $id(element) {
  return document.getElementById(element);
}
//切屏--是按钮，_v是内容平台，_h是内容库
function reg(str){
  var bt=$id(str+"_b").getElementsByTagName("h2");
  for(var i=0;i<bt.length;i++){
    bt[i].subj=str;
    bt[i].pai=i;
    bt[i].style.cursor="pointer";
    bt[i].onclick=function(){
      $id(this.subj+"_v").innerHTML=$id(this.subj+"_h").getElementsByTagName("blockquote")[this.pai].innerHTML;
      for(var j=0;j<$id(this.subj+"_b").getElementsByTagName("h2").length;j++){
        var _bt=$id(this.subj+"_b").getElementsByTagName("h2")[j];
        var ison=j==this.pai;
        _bt.className=(ison?"":"h2bg");
      }
    }
  }
  $id(str+"_h").className="none";
  $id(str+"_v").innerHTML=$id(str+"_h").getElementsByTagName("blockquote")[0].innerHTML;
}

</script>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>

<div class="wrap box">
 <div id="ur_here">
  <?php echo $this->fetch('library/ur_here.lbi'); ?>
 </div>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.jqzoom-core-pack.js,formValidator-4.0.1.min.js,formValidatorRegex.js,validdata.js,transport.js')); ?>
<script src="/editor/kindeditor.js" type="text/javascript"></script>
<script src="/editor/lang/zh_CN.js" type="text/javascript"></script>

<div class="blank"></div>



<div class="wrap clearfix">
     
     <div class="product f_l">
        <div class="imgInfo">
        <?php if ($this->_var['pictures']): ?>
        <div class="goodThumb">
            <a id="idgoodsimgsrc" class="jqzoom"  rel='gal1' href="<?php echo $this->_var['first_original']; ?>" onclick="window.open('gallery.php?id=<?php echo $this->_var['goods']['goods_id']; ?>'); return false;">
            <img id="idgoodsimg" src="<?php echo $this->_var['first_goodsimg']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>"/>
            </a>
        </div>     
        <?php else: ?>
                <img src="<?php echo $this->_var['first_goodsimg']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>"/>
              
        <?php endif; ?>
      
        <div class="blank5"></div>
        
        <?php echo $this->fetch('library/goods_gallery.lbi'); ?>
        
            <div class="blank5"></div>
            

        </div>
     </div>
     
<form action="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >
     <div class="f_r product_info">   
     <div class="textInfo">
     <div class="clearfix">
       <div class="pro_title"> <h1> <?php echo $this->_var['goods']['goods_style_name']; ?></h1></div>
       
       
       <div class="pro_spec" >
        <li class="clearfix">

            <div class="shop_price"> <strong><?php echo $this->_var['lang']['shop_price']; ?></strong><font class="shop" id="ECS_SHOPPRICE"><?php echo $this->_var['goods']['shop_price_formated']; ?></font></div>
             <div class="market_price"> <strong><?php echo $this->_var['lang']['market_price']; ?></strong><font class="market"><?php echo $this->_var['goods']['market_price']; ?></font></div>

        </li>
           <table cellspacing="0" cellpadding="0" >
                    <tbody>
                        
                        <tr><td align="left" width="100" valign="top"> <strong><?php echo $this->_var['lang']['goods_rank']; ?></strong> </td>   <td align="left" width="421" valign="top"><img src="themes/365chi/images/stars<?php echo $this->_var['goods']['comment_rank']; ?>.gif" alt="comment rank <?php echo $this->_var['goods']['comment_rank']; ?>" /></a>     </td> </tr>
     
                        <?php if ($this->_var['goods']['goods_brand'] != "" && $this->_var['cfg']['show_brand']): ?>
                              <tr><td align="left" width="100" valign="top"> <strong><?php echo $this->_var['lang']['goods_brand']; ?></strong> </td>   <td align="left" width="421" valign="top"><a href="<?php echo $this->_var['goods']['goods_brand_url']; ?>" ><?php echo $this->_var['goods']['goods_brand']; ?></a>     </td> </tr>
                        <?php endif; ?>

                        <?php if ($this->_var['cfg']['show_goodssn']): ?>
                                                     <tr>   <td align="left" width="100" valign="top"> <strong><?php echo $this->_var['lang']['goods_sn']; ?></strong> </td>   <td align="left" width="421" valign="top"><?php echo $this->_var['goods']['goods_sn']; ?>     </td> </tr>
                               
                        <?php endif; ?>
                        <?php if ($this->_var['cfg']['show_goodsweight']): ?>
                                                     <tr>   <td align="left" width="100" valign="top"> <strong><?php echo $this->_var['lang']['goods_weight']; ?></strong> </td>   <td align="left" width="421" valign="top"><?php echo $this->_var['goods']['goods_weight']; ?>    </td> </tr>
                        
                        <?php endif; ?>
                           <?php if ($this->_var['cfg']['show_addtime']): ?>
                           <tr>   <td align="left" width="100" valign="top"> <strong><?php echo $this->_var['lang']['add_time']; ?></strong> </td>   <td align="left" width="421" valign="top"><?php echo $this->_var['goods']['add_time']; ?>    </td> </tr>
                   
                        <?php endif; ?>
                               <?php if ($this->_var['goods']['goods_number'] != "" && $this->_var['cfg']['show_goodsnumber']): ?>
                            <?php if ($this->_var['goods']['goods_number'] == 0): ?>
                             <tr>   <td align="left" width="100" valign="top"> <strong><?php echo $this->_var['lang']['goods_number']; ?></strong> </td>   <td align="left" width="421" valign="top"><?php echo $this->_var['goods']['stock_up']; ?> </td> </tr>
                            <?php else: ?>
                              <tr>   <td align="left" width="100" valign="top"> <strong><?php echo $this->_var['lang']['goods_number']; ?></strong> </td>   <td align="left" width="421" valign="top"><?php echo $this->_var['goods']['goods_number']; ?> <?php echo $this->_var['goods']['measure_unit']; ?>   </td> </tr>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        
                          <tr>   <td align="left" width="100" valign="top"> <strong><?php echo $this->_var['lang']['goods_click_count']; ?></strong> </td>   <td align="left" width="421" valign="top"><?php echo $this->_var['goods']['click_count']; ?>    </td> </tr>
                
                               
                        
                        <?php $_from = $this->_var['properties']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'property_group');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['property_group']):
?>
                            <tr>
                                <td ><strong><?php echo htmlspecialchars($this->_var['key']); ?></strong></td>
                            <td>
                            <?php $_from = $this->_var['property_group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'property');if (count($_from)):
    foreach ($_from AS $this->_var['property']):
?>
  
                                <?php echo $this->_var['property']; ?>&nbsp;&nbsp;
                           
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </td>
                             </tr>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

                         

                          
                          
                </tbody></table>
       </div>
                  

      </div>
      <ul>
       <?php if ($this->_var['promotion']): ?>
      <li class="padd">
      <?php $_from = $this->_var['promotion']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
      <?php echo $this->_var['lang']['activity']; ?>
      <?php if ($this->_var['item']['type'] == "snatch"): ?>
      <a href="snatch.php" title="<?php echo $this->_var['lang']['snatch']; ?>" style="font-weight:100; color:#006bcd; text-decoration:none;">[<?php echo $this->_var['lang']['snatch']; ?>]</a>
      <?php elseif ($this->_var['item']['type'] == "group_buy"): ?>
      <a href="group_buy.php" title="<?php echo $this->_var['lang']['group_buy']; ?>" style="font-weight:100; color:#006bcd; text-decoration:none;">[<?php echo $this->_var['lang']['group_buy']; ?>]</a>
      <?php elseif ($this->_var['item']['type'] == "auction"): ?>
      <a href="auction.php" title="<?php echo $this->_var['lang']['auction']; ?>" style="font-weight:100; color:#006bcd; text-decoration:none;">[<?php echo $this->_var['lang']['auction']; ?>]</a>
      <?php elseif ($this->_var['item']['type'] == "favourable"): ?>
      <a href="activity.php" title="<?php echo $this->_var['lang']['favourable']; ?>" style="font-weight:100; color:#006bcd; text-decoration:none;">[<?php echo $this->_var['lang']['favourable']; ?>]</a>
      <?php endif; ?>
      <a href="<?php echo $this->_var['item']['url']; ?>" title="<?php echo $this->_var['lang'][$this->_var['item']['type']]; ?> <?php echo $this->_var['item']['act_name']; ?><?php echo $this->_var['item']['time']; ?>" style="font-weight:100; color:#006bcd;"><?php echo $this->_var['item']['act_name']; ?></a><br />
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </li>
      <?php endif; ?>
     

      <?php if ($this->_var['volume_price_list']): ?>
      <li class="padd">
       <font class="f1"><?php echo $this->_var['lang']['volume_price']; ?>：</font><br />
       <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#aad6ff">
        <tr>
          <td align="center" bgcolor="#FFFFFF"><strong><?php echo $this->_var['lang']['number_to']; ?></strong></td>
          <td align="center" bgcolor="#FFFFFF"><strong><?php echo $this->_var['lang']['preferences_price']; ?></strong></td>
        </tr>
        <?php $_from = $this->_var['volume_price_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('price_key', 'price_list');if (count($_from)):
    foreach ($_from AS $this->_var['price_key'] => $this->_var['price_list']):
?>
        <tr>
        <td align="center" bgcolor="#FFFFFF" class="shop"><?php echo $this->_var['price_list']['number']; ?></td>
        <td align="center" bgcolor="#FFFFFF" class="shop"><?php echo $this->_var['price_list']['format_price']; ?></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
       </table>
      </li>
      <?php endif; ?>

      <?php if ($this->_var['goods']['is_promote'] && $this->_var['goods']['gmt_end_time']): ?>
      <?php echo $this->smarty_insert_scripts(array('files'=>'lefttime.js')); ?>
      <li class="padd loop" style="margin-bottom:5px; border-bottom:1px dashed #ccc;">
      <strong><?php echo $this->_var['lang']['promote_price']; ?></strong><font class="shop"><?php echo $this->_var['goods']['promote_price']; ?></font><br />
      <strong><?php echo $this->_var['lang']['residual_time']; ?></strong>
      <font class="f4" id="leftTime"><?php echo $this->_var['lang']['please_waiting']; ?></font><br />
      </li>
      <?php endif; ?>
      <li class="clearfix">
       <dd>
         <?php echo $this->_var['lang']['amount']; ?>：<font id="ECS_GOODS_AMOUNT" class="shop"></font>
       </dd>
       <dd class="ddR">
       <?php if ($this->_var['goods']['give_integral'] > 0): ?>
        <strong><?php echo $this->_var['lang']['goods_give_integral']; ?></strong><font class="f4"><?php echo $this->_var['goods']['give_integral']; ?> <?php echo $this->_var['points_name']; ?></font>
        <?php endif; ?>
       </dd>
      </li>
      <?php if ($this->_var['goods']['bonus_money']): ?>
      <li class="padd loop" style="margin-bottom:5px; border-bottom:1px dashed #ccc;">
      <strong><?php echo $this->_var['lang']['goods_bonus']; ?></strong><font class="shop"><?php echo $this->_var['goods']['bonus_money']; ?></font><br />
      </li>
      <?php endif; ?>
      <li class="clearfix">
       <dd>
       <?php echo $this->_var['lang']['number']; ?>：
        <input name="number" type="text" id="number" value="1" size="4" onchange="changePrice()" style="border:1px solid #ccc; "/>
       </dd>
       <dd class="ddR">
       <?php if (0 && $this->_var['cfg']['use_integral']): ?>
       <strong><?php echo $this->_var['lang']['goods_integral']; ?></strong><font class="f4"><?php echo $this->_var['goods']['integral']; ?> <?php echo $this->_var['points_name']; ?></font>
       <?php endif; ?>
       </dd>
      </li>
      <?php if ($this->_var['goods']['is_shipping']): ?>
      <li style="height:30px;padding-top:4px;">
      <?php echo $this->_var['lang']['goods_free_shipping']; ?><br />
      </li>
      <?php endif; ?>

      
      <?php $_from = $this->_var['specification']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('spec_key', 'spec');if (count($_from)):
    foreach ($_from AS $this->_var['spec_key'] => $this->_var['spec']):
?>
      <li class="padd loop">
      <strong><?php echo $this->_var['spec']['name']; ?>:</strong><br />
        
                    <?php if ($this->_var['spec']['attr_type'] == 1): ?>
                      <?php if ($this->_var['cfg']['goodsattr_style'] == 1): ?>
                        <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
                        <label for="spec_value_<?php echo $this->_var['value']['id']; ?>">
                        <input type="radio" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" id="spec_value_<?php echo $this->_var['value']['id']; ?>" <?php if ($this->_var['key'] == 0): ?>checked<?php endif; ?> onclick="changePrice()" />
                        <?php echo $this->_var['value']['label']; ?> [<?php if ($this->_var['value']['price'] > 0): ?><?php echo $this->_var['lang']['plus']; ?><?php elseif ($this->_var['value']['price'] < 0): ?><?php echo $this->_var['lang']['minus']; ?><?php endif; ?> <?php echo $this->_var['value']['format_price']; ?>] </label><br />
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        <input type="hidden" name="spec_list" value="<?php echo $this->_var['key']; ?>" />
                        <?php else: ?>
                        <select name="spec_<?php echo $this->_var['spec_key']; ?>" onchange="changePrice()">
                          <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
                          <option label="<?php echo $this->_var['value']['label']; ?>" value="<?php echo $this->_var['value']['id']; ?>"><?php echo $this->_var['value']['label']; ?> <?php if ($this->_var['value']['price'] > 0): ?><?php echo $this->_var['lang']['plus']; ?><?php elseif ($this->_var['value']['price'] < 0): ?><?php echo $this->_var['lang']['minus']; ?><?php endif; ?><?php if ($this->_var['value']['price'] != 0): ?><?php echo $this->_var['value']['format_price']; ?><?php endif; ?></option>
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </select>
                        <input type="hidden" name="spec_list" value="<?php echo $this->_var['key']; ?>" />
                      <?php endif; ?>
                    <?php else: ?>
                      <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
                      <label for="spec_value_<?php echo $this->_var['value']['id']; ?>">
                      <input type="checkbox" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" id="spec_value_<?php echo $this->_var['value']['id']; ?>" onclick="changePrice()" />
                      <?php echo $this->_var['value']['label']; ?> [<?php if ($this->_var['value']['price'] > 0): ?><?php echo $this->_var['lang']['plus']; ?><?php elseif ($this->_var['value']['price'] < 0): ?><?php echo $this->_var['lang']['minus']; ?><?php endif; ?> <?php echo $this->_var['value']['format_price']; ?>] </label><br />
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                      <input type="hidden" name="spec_list" value="<?php echo $this->_var['key']; ?>" />
                    <?php endif; ?>
      </li>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      
      <li class="padd mt10 clearfix" id="gwc">
          <a href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" class="act_add" ></a>
          <a href="javascript:buyGoods(<?php echo $this->_var['goods']['goods_id']; ?>)" class="act_buy"></a>
      <?php if ($this->_var['affiliate']['on']): ?>
      <a href="user.php?act=affiliate&goodsid=<?php echo $this->_var['goods']['goods_id']; ?>"></a>
      <?php endif; ?>
      </li>
      
      <li class="goods_share clearfix">
                <b>分享到：</b> <a href="javascript:void(0);" onclick="UI.Share.qqT();" class="s1">
                </a><a href="javascript:void(0);" onclick="UI.Share.renren();" class="s2"></a>
                <a href="javascript:void(0);" onclick="UI.Share.sinaT();" class="s3"></a><a href="javascript:void(0);" onclick="UI.Share.kaixin();" class="s4"></a>
                <a href="javascript:void(0);" onclick="UI.Share.qqZone();" class="s5"></a><a href="javascript:void(0);" onclick="UI.Share.sohuT();" class="s6"></a>
              
                <a href="javascript:void(0);" onclick="collect(<?php echo $this->_var['goods']['goods_id']; ?>);"  class="isave">收藏该商品</a>  
      </li>
      </ul>
      </form>
     </div>
</div>
</div>
   <div class="blank"></div>



<div class="wrap clearfix">
  
  <div class="AreaL">
    
<?php echo $this->fetch('library/history.lbi'); ?>
<?php echo $this->fetch('library/goods_attrlinked.lbi'); ?>
<?php echo $this->fetch('library/bought_goods.lbi'); ?>



    
  </div>
  
  
  <div class="AreaR">
      <form method="post" action="goods_edit.php" name="form1" > 
    <h3 >
        <div id="com_b" class="goodsTab clearfix">
        <h2><?php echo $this->_var['lang']['goods_brief']; ?></h2>
        <h2 class="h2bg"><?php echo $this->_var['lang']['goods_tab_advice']; ?></h2>
        <h2 class="h2bg"><?php echo $this->_var['lang']['goods_tab_knowledge']; ?></h2>
        <h2 class="h2bg"><?php echo $this->_var['lang']['goods_tab_comment']; ?></h2>
        <h2 class="h2bg"><?php echo $this->_var['lang']['goods_tab_buy']; ?></h2>

        <?php if ($this->_var['package_goods_list']): ?>
        <h2 class="h2bg" style="color:red;"><?php echo $this->_var['lang']['remark_package']; ?></h2>
        <?php endif; ?>
        </div>
    </h3>
   
     <div class="box">
     <div class="box_goods_desc">

      <div id="com_v" ></div>
      <div id="com_h">
           
           <div class="goodsDetailArea" id="descContent">
                     <?php echo $this->_var['goods']['goods_desc']; ?>
           </div>
          <div id="descFCKeditor">
            <textarea id="editor_id" name="content" style="width:700px;height:300px;">
                    <?php echo $this->_var['goods']['goods_desc']; ?>
            </textarea>
          </div>


      </div>
        <input type="hidden" name="goods_id" >
        <input type="submit" value="保存" id="save_goods_desc"  style="display: none;">
        
</form>
     </div>
    </div>

    <script type="text/javascript">
//    reg("com");
    </script>
  <div class="blank"></div>
  
  


  </div>
  
</div>
<div class="blank5"></div>

<div class="wrap">
  <div class="box">
   <div class="helpTitBg clearfix">
    <?php echo $this->fetch('library/help.lbi'); ?>
   </div>
  </div>
</div>
<div class="blank"></div>


<?php if ($this->_var['img_links'] || $this->_var['txt_links']): ?>
<div id="bottomNav" class="box">
 <div class="box_1">
  <div class="links clearfix">
    <?php $_from = $this->_var['img_links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'link');if (count($_from)):
    foreach ($_from AS $this->_var['link']):
?>
    <a href="<?php echo $this->_var['link']['url']; ?>" target="_blank" title="<?php echo $this->_var['link']['name']; ?>"><img src="<?php echo $this->_var['link']['logo']; ?>" alt="<?php echo $this->_var['link']['name']; ?>" border="0" /></a>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php if ($this->_var['txt_links']): ?>
    <?php $_from = $this->_var['txt_links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'link');if (count($_from)):
    foreach ($_from AS $this->_var['link']):
?>
    [<a href="<?php echo $this->_var['link']['url']; ?>" target="_blank" title="<?php echo $this->_var['link']['name']; ?>"><?php echo $this->_var['link']['name']; ?></a>]
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php endif; ?>
  </div>
 </div> 
</div>
<?php endif; ?>

<div class="blank"></div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
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
var enterArea = false;
var lastContent = null;
var editor = null;
$(function(){
    KindEditor.ready(function(K) {
            editor = K.create('#editor_id',{
                	fileManagerJson : '/editor/php/file_manager_json.php',
                        width:758,
                        height:800 //$('#descContent').height()
            });
    });
     $(".AreaR").mouseenter(function(){
         enterArea = true;
     });
     $(".AreaR").mouseleave(function(){
         enterArea = false;
     });

     toggleUp();
    //空白处点击鼠标预览并保存
    $(document).click(preview);
    //区域内点击鼠标出现编辑框    
    $('#descContent').click(function() {
            toggleDown();
    });

    
    $('#save_goods_desc').click(function(){
        save_goods_desc();
    });
    
    
});


/*收起*/
function toggleUp()
{
   $('#descContent').show();$('#descFCKeditor').hide();  
   //$('#save_goods_desc').hide();
}
/*展开*/
function toggleDown()
{
   $('#descContent').hide(); $('#descFCKeditor').show(); 
  // $('#save_goods_desc').show();
}

function save_goods_desc()
{
    var thisContent = editor.html();
    if( thisContent != lastContent && thisContent != "" ) {
         lastContent = thisContent; 
        $.post("g_edit_goods.php?act=save_desc&id="+goods_id,{data : thisContent} ,function(result){
            if(result)
                alert("保存失败，请备份后再退出");
        });
    }
 
}
function preview(e){
    if(enterArea )
    {
        return;
     }
     else{
        $('#descContent').html(editor.html());
        toggleUp();
        save_goods_desc();
     }

}     


onload = function(){
    changePrice();
 // fixpng();
    $(".jqzoom").jqzoom({
            zoomWidth: 300,
            zoomHeight: 300,
            preloadText: '图片加载中...',
            title:false,
            alwaysOn:false,  
            preloadImages: false,  
            showEffect:'fadein',
            fadeinSpeed:'fast', 
            fadeoutSpeed:'fast',
            zoomType:'reverse'
        });
  
}

/**
 * 点选可选属性或改变数量时修改商品价格的函数
 */
function changePrice()
{
  var attr = getSelectedAttributes(document.forms['ECS_FORMBUY']);
  var qty = document.forms['ECS_FORMBUY'].elements['number'].value;

  Ajax.call('goods.php', 'act=price&id=' + goodsId + '&attr=' + attr + '&number=' + qty, changePriceResponse, 'GET', 'JSON');
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
    document.forms['ECS_FORMBUY'].elements['number'].value = res.qty;

    if (document.getElementById('ECS_GOODS_AMOUNT'))
      document.getElementById('ECS_GOODS_AMOUNT').innerHTML = res.result;
  }
}

</script>
</html>
