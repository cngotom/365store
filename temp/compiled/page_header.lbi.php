<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,jquery-1.8.3.min.js,jquery.json-1.3.js,jquery-ui.min.js,helper.js,common.js,jquery.autocomplete.js')); ?> 
<div class="top">
        <div class="top_content">
            <div class="tit">
                <ul> 
                   <?php 
$k = array (
  'name' => 'member_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?> 
                    <li style="margin-top: 4px;" class=" fr">&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.weibo.com/u/2995776311"><img width="66" height="22" src="themes/365chi/images/green/index/wb.jpg"></a></li>
                    <li class="fr_g fr green_font">&nbsp;&nbsp;|&nbsp;&nbsp;<a href="">活动订阅</a></li>
                    <li  class="fr_y fr">&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="javascript:addBookmark('365绿色商城，绿色生活新主张','http://www.365store.cn/');return false;" href="javascript:void(0);">收藏本站</a></li> 
                    <li class="fr_y fr"><a href="help.php">帮助中心</a></li>
                </ul>
                <div style=" clear: both;"></div>

            </div>
            <div class="tib">
                <div class="logo fl">
                    <a href="/"><img src="themes/365chi/images/green/index/logo.gif" /></a>
                </div>
                <div class="search fl">
                    <div class="search_l fl"></div>
                    <div class="search_m fl" >
                        <input type="text"  value="请输入搜索关键字" id="key" class="search_key grey_font"   onblur="if(value=='请输入搜索关键字'){value='请输入搜索关键字'}" onfocus="if(value=='请输入搜索关键字'){value=''}" value="请输入搜索关键字">
                    </div>
                    <div class="search_r fl">
                        <input type="button"  class="search_btn" id="btn_search" >
                    </div>
                    <div class="hot_key" >
                        <span> 热门搜索：&nbsp;<a target="_blank" href="search.php?keywords=北大荒">北大荒</a>&nbsp;<a target="_blank" href="search.php?keywords=女人豆浆">女人豆浆</a>&nbsp;<a target="_blank" href="search.php?keywords=自然">自然</a>&nbsp;<a target="_blank" href="search.php?keywords=有机">有机</a>&nbsp;<a target="_blank" href="search.php?keywords=绿野">绿野</a>&nbsp;</span>
                    </div>
                </div>
                <div class="logo fr">
                    <div class="tel fl"> </div>
                    <div class="tel_c fr">
                        <div style="width: 115px; height: 15px;background:url(themes/365chi/images/green/index/tel_bg.gif) no-repeat; color: white; font-size: 14px; text-align: center; ">24小时免费热线</div>
                        <div style="width: 160px;color:  slategray;font:bold 24px arial; margin-top: 5px;" >400-8986-365</div>
                        <div style="width: 160px;color:  slategray;font-size: 12px; margin-top: 5px;"">(周一至周五9:00-18:00)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ban">
        <div class="banner">
            
            <div class="all_goods">
                <img src="themes/365chi/images/green/index/all_goods.gif" />
            </div>
            
            <div class="Cart" id="Cart">
                <a><span style="margin-left: 40px;">购物车</span><span style="color: white;" id="ltlNum"><?php 
$k = array (
  'name' => 'cart_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>件</span></a>&nbsp;&nbsp;<span><a href="flow2.php?step=cart">去结算>></a></span>
                <div id="CartDiv" style="display: none;" class="sitenav_menu_bg"><span class="join">最近加入的商品：</span>
                        <ul class="shoplist">

                        </ul>
                </div>
            </div>
         
            
            <div class="banner_w fl">
                <ul>
                    <?php $_from = $this->_var['navigator_list']['middle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');$this->_foreach['nav_middle_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_middle_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav']):
        $this->_foreach['nav_middle_list']['iteration']++;
?>
                    
                    <?php if (($this->_foreach['nav_middle_list']['iteration'] <= 1)): ?> 
                          <li <?php if ($this->_var['nav']['active'] == 1): ?> class="hover"<?php endif; ?>  style="display: block; float: left; height: 36px; line-height: 36px; width: 50px;">                 
                          <a href="<?php echo $this->_var['nav']['url']; ?>" <?php if ($this->_var['nav']['opennew'] == 1): ?> target="_blank" <?php endif; ?>><?php echo $this->_var['nav']['name']; ?></a></li>
                    <?php else: ?>
                        <li <?php if ($this->_var['nav']['active'] == 1): ?> class="hover"<?php endif; ?>>
                        <a href="<?php echo $this->_var['nav']['url']; ?>" <?php if ($this->_var['nav']['opennew'] == 1): ?> target="_blank" <?php endif; ?>><?php echo $this->_var['nav']['name']; ?></a></li>
                        
                    <?php endif; ?>    
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>
                
            </div>
            
        </div>
    </div>

<script type="text/javascript">

$(function() {
    var enterCart = false;
    $("#Cart").mouseenter(function(){       

            $("#CartDiv").addClass("hover");
            $("#CartDiv").show();
            updateCart();
            enterCart = true;    
    });
    $("#CartLi").mouseenter(function() {
            enterCart = true;
    });
    $("#Cart").mouseleave(function(){       
        enterCart = false;
        setTimeout(function(){
            if(!enterCart)
            {
                $("#CartDiv").removeClass("hover");
                $("#CartDiv").hide();
            }
        },100);

    });
    
    
    $("#btn_search").click(function() {
        SearchProduct();
    }); 


    //自动完成功能
    var data = "Core Selectors Attributes Traversing Manipulation CSS Events Effects Ajax Utilities".split(" "); 

    $('#key').autocomplete('ajax_quick_search.php').result(function(event, data, formatted) { 
           $('#key').val(data);
           SearchProduct();
        }); 
    });


</script>
