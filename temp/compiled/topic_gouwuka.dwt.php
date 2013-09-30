




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['topic']['title']; ?>_<?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
<link href="/themes/365chi/topic/css/gouwuka.css" rel="stylesheet" type="text/css" />
<link href="js/jquery-ui.css" rel="stylesheet" type="text/css" />
<?php if ($this->_var['topic']['css'] != ''): ?>
<style type="text/css">
  <?php echo $this->_var['topic']['css']; ?>
</style>
<?php endif; ?>
<style type="text/css">

</style>

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'formValidator-4.0.1.min.js,formValidatorRegex.js,validdata.js,transport.js,helper.js')); ?>
<div class="blank"></div>



<div id="topic_content">
    <a name="gototop"></a>
    <div class="top">
        <div class="tit"><img src="themes/365chi/topic/images/gouwuka/1.gif" /></div>
        <div class="tit"><img src="themes/365chi/topic/images/gouwuka/2.gif" /></div>
        <div class="tit"><img src="themes/365chi/topic/images/gouwuka/3.gif" /></div>
        <div class="tit"><img src="themes/365chi/topic/images/gouwuka/4.gif" /></div>
        <div class="tit clear"><img src="themes/365chi/topic/images/gouwuka/5.gif" /></div>
        <div class="tit"><img src="themes/365chi/topic/images/gouwuka/6.gif" /></div>
        <div class="tit"><img src="themes/365chi/topic/images/gouwuka/7.gif" /></div>
        <div class="tit"><img src="themes/365chi/topic/images/gouwuka/8.gif" /></div>
    </div>    
    <div class="meishi" >
        <div class="meishi_x"><img src="themes/365chi/topic/images/gouwuka/9.gif" /></div>
        <div class="meishi_x"><img src="themes/365chi/topic/images/gouwuka/10.gif" /></div>
        <div class="meishi_x"><img src="themes/365chi/topic/images/gouwuka/11.gif" /></div>
        <div class="meishi_x"><img src="themes/365chi/topic/images/gouwuka/12.gif" /></div>
        <div class="meishi_x clear"><img src="themes/365chi/topic/images/gouwuka/13.gif" /></div>
        <div class="meishi_x"><img src="themes/365chi/topic/images/gouwuka/14.gif" /></div>
        <div class="meishi_x"><img src="themes/365chi/topic/images/gouwuka/15.gif" /></div>
        <div class="meishi_x"><img src="themes/365chi/topic/images/gouwuka/16.gif" /></div>
        <div style="display:none;position: fixed; top:40%;left:90%;_position:absolute;left:expression(eval(document.documentElement.scrollLeft+1140));top:expression(eval(document.documentElement.scrollTop-400))">
            <div>
               <img src="themes/365chi/topic/images/gouwuka/r1.jpg" />
            </div>
            <div>
                <a href="#meishi"><img src="themes/365chi/topic/images/gouwuka/r2.jpg" /></a>
            </div>
            <div>
                <a href="#ka365"><img src="themes/365chi/topic/images/gouwuka/r3.jpg" /></a>
            </div>
            <div>
                <a href="#shengxian"><img src="themes/365chi/topic/images/gouwuka/r4.jpg" /></a>
            </div>
            <div>
                <a href="#gototop"><img src="themes/365chi/topic/images/gouwuka/r5.jpg" /></a>
            </div>
            
        </div>
        <a name="meishi"></a>
        <div class="ka_area clear">
            <?php $_from = $this->_var['top_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'ids');$this->_foreach['father'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['father']['total'] > 0):
    foreach ($_from AS $this->_var['ids']):
        $this->_foreach['father']['iteration']++;
?> 
                <div class="ka_row clear"       <?php if (! ($this->_foreach['father']['iteration'] <= 1)): ?>  style="margin-top: 12px;"  <?php endif; ?>  >    
                <?php $_from = $this->_var['ids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'top_id');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['top_id']):
        $this->_foreach['child']['iteration']++;
?>
                    <?php if (($this->_foreach['child']['iteration'] <= 1)): ?>
                    <div class="ka_h" style="margin-left:28px; _margin-left:14px;">
                    <?php else: ?>
                    <div class="ka_h" style="margin-left:13px;">
                    <?php endif; ?>
                        <div class="ka_t"></div>
                        <div class="ka_c">
                            <a href="<?php echo $this->_var['top_id']['url']; ?>"><img  src="<?php echo $this->_var['top_id']['goods_thumb']; ?>" /></a>
                        </div>
                        <div class="price">
                            <div class="n_p"> <?php echo $this->_var['top_id']['short_name']; ?></div>
                            <div class="fl">
                                <div style="margin-left: 18px; line-height: 20px;"><span>面值:</span><?php echo $this->_var['top_id']['market_price']; ?>元</div>
                                <div style="margin-left: 18px;"><span style="color: red;">售价:</span><?php echo $this->_var['top_id']['shop_price']; ?></div>
                            </div>

                            <div class="buy">
                                <span > <a  href="javascript:void(0)" onclick="simpleAddToCart(<?php echo $this->_var['top_id']['goods_id']; ?>,'show_success_tips_<?php echo $this->_var['top_id']['goods_id']; ?>')" >立即<br>购买</a> </span>
                            </div>
                            <div style="display: none;background-color: green;position: absolute;bottom: 10px;left: 10px;z-index: 1000;color: white;" id="show_success_tips_<?php echo $this->_var['top_id']['goods_id']; ?>"  ><span>该商品已经被添加到购物车里面</span></div> 
                        </div>
                        <div class="city"></div>
                    </div>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>  
                </div>     
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>       
        </div>     
        <div class="bottom">
            <div  class="more" style="position: absolute; top:-80px;left: 1120px;">
                <a href="category.php?id=371"><br>更<br>多<br>超<br>市</a>
            </div>
        </div>
    </div>
    <div  class="meishi" style=" padding-left: 128px;"><img src="themes/365chi/topic/images/gouwuka/83.gif" /></div>
    <div class="meishi">
        <div class="ka365_x"><img src="themes/365chi/topic/images/gouwuka/17.gif" /></div>
        <div class="ka365_x"><img src="themes/365chi/topic/images/gouwuka/18.gif" /></div>
        <div class="ka365_x"><img src="themes/365chi/topic/images/gouwuka/19.gif" /></div>
        <div class="ka365_x"><img src="themes/365chi/topic/images/gouwuka/20.gif" /></div>
        <a name="ka365"></a>
        <div class="ka_area clear">
        <div class="ka_row clear">
             <?php $_from = $this->_var['center_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'top_id');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['top_id']):
        $this->_foreach['child']['iteration']++;
?>
                    <?php if (($this->_foreach['child']['iteration'] <= 1)): ?>
                    <div class="ka_h" style="margin-left:28px; _margin-left:14px;">
                    <?php else: ?>
                     <div class="ka_h" style="margin-left:13px;">
                    <?php endif; ?>
                            <div class="ka_t"></div>
                        <div class="ka_c2">
                            <a href="<?php echo $this->_var['top_id']['url']; ?>"> <img src="<?php echo $this->_var['top_id']['goods_thumb']; ?>" /></a>
                        </div>
                        <div class="price">
                            <div class="n_p"> <?php echo $this->_var['top_id']['short_name']; ?></div>
                            <div style="margin-left: 18px; margin-top: 8px;"><span>价格： <?php echo $this->_var['top_id']['shop_price']; ?></span></div>

                            <div class="buy">
                                <span > <a  href="javascript:void(0)" onclick="simpleAddToCart(<?php echo $this->_var['top_id']['goods_id']; ?>,'show_success_tips_<?php echo $this->_var['top_id']['goods_id']; ?>')" >立即<br>购买</a> </span>
                            </div>
                              <div style="display: none;background-color: green;position: absolute;bottom: 10px;left: 10px;z-index: 1000;color: white;" id="show_success_tips_<?php echo $this->_var['top_id']['goods_id']; ?>"  ><span>该商品已经被添加到购物车里面</span></div> 
                        </div>
                        <div class="city"></div>
                    
                     </div>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>   
        </div>
         </div>
        <div class="bottom">
           <div  class="more" style="position: absolute; top:-80px;left:1120px;">
                <a href="category.php?id=371"><br>更<br>多<br>卡<br>券</a>
            </div>
        </div>
    </div>

    <div  class="meishi" style=" padding-left: 128px;"><img src="themes/365chi/topic/images/gouwuka/83.gif" /></div>
    <div class="meishi">
        <div class="xian"><img src="themes/365chi/topic/images/gouwuka/21.gif" /></div>
        <div class="xian"><img src="themes/365chi/topic/images/gouwuka/22.gif" /></div>
        <div class="xian"><img src="themes/365chi/topic/images/gouwuka/23.gif" /></div>
        <div class="xian"><img src="themes/365chi/topic/images/gouwuka/24.gif" /></div>
        <a name="shengxian"></a>
        <div class="ka_area clear">
        <div class="ka_row clear">
           <?php $_from = $this->_var['bottom_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'top_id');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['top_id']):
        $this->_foreach['child']['iteration']++;
?>
                    <?php if (($this->_foreach['child']['iteration'] <= 1)): ?>
                    <div class="ka_h" style="margin-left:28px; _margin-left:14px;">
                    <?php else: ?>
                     <div class="ka_h" style="margin-left:13px;">
                    <?php endif; ?>
                            <div class="ka_t"></div>
                        <div class="ka_c2">
                            <a href="<?php echo $this->_var['top_id']['url']; ?>"> <img src="<?php echo $this->_var['top_id']['goods_thumb']; ?>" /></a>
                        </div>
                        <div class="price">
                            <div class="n_p"> <?php echo $this->_var['top_id']['short_name']; ?></div>
                            <div style="margin-left: 18px; margin-top: 8px;"><span>价格： <?php echo $this->_var['top_id']['shop_price']; ?></span></div>

                            <div class="buy">
                                <span > <a href="javascript:void(0)" onclick="simpleAddToCart(<?php echo $this->_var['top_id']['goods_id']; ?>,'show_success_tips_<?php echo $this->_var['top_id']['goods_id']; ?>')" >立即<br>购买</a> </span>
                            </div>
                              <div style="display: none;background-color: green;position: absolute;bottom: 10px;left: 10px;z-index: 1000;color: white;" id="show_success_tips_<?php echo $this->_var['top_id']['goods_id']; ?>"  ><span>该商品已经被添加到购物车里面</span></div> 
                        </div>
                        <div class="city"></div>
                    
                     </div>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
         </div>
        </div>
        <div class="bottom">
             <div  class="more" style="position: absolute; top:-80px;left: 1120px;">
                <a href="category.php?id=292"><br>更<br>多<br>生<br>鲜</a>
            </div>
        </div>
    </div>

</div>














<div class="nwrap">
<div class="color1">
        <b class="b1"></b><b class="b2"></b><b class="b3"></b><b class="b4"></b> 
        <div class="foot_content">  
           <div id="foot_head">
                <?php echo $this->fetch('library/help.lbi'); ?>      	
           </div>
           <div id="foot_tail">
               <?php echo $this->fetch('library/page_footer.lbi'); ?>
           </div>       
        </div>
        <b class="b5"></b><b class="b6"></b><b class="b7"></b><b class="b8"></b>    
    </div>   
</div>
<div class="blank"></div>

</body>
    
<script language="javascript">
    
    var startHour = 10;
    var startMin = 30;
    var timer ;
    function miaosha(){
        
        var today=new Date(); 
        var h=today.getHours(); 
         var m=today.getMinutes(); 
        if( (h < startHour )|| ( h == startHour && m < startMin) )
        {
           alert('活动还未开始');
           return;
        }
        
        if(!GUserInfo.isLogin)
         {
             GUserInfo.runCode = "window.location.href = 'campaign.php'";
             show_login_dialog();
         }
        else{
           window.location.href = 'campaign.php'
        }
    }
    

    $(function(){
        
       timer = setInterval( function(){
            var today=new Date(); 
            var h=today.getHours(); 
            var m=today.getMinutes(); 
            var s=today.getSeconds(); 


             if( (h == startHour -1  )|| ( h == startHour && m < startMin) )
            {
                var leftS = 60 - s;
                var leftM =  (startHour-h)*60 + (startMin-1 -m);


                $('#minute1').html(  leftM.toString().substr(0, 1) );
                $('#minute2').html( leftM.toString().substr(1, 1));
                $('#second1').html(leftS.toString().substr(0, 1));
                $('#second2').html(leftS.toString().substr(1, 1));
            }
            else{
                $('#minute1').html('0');
                $('#minute2').html('0');
                $('#second1').html('0');
                $('#second2').html('0');
                
                clearInterval(timer);

            }
        },1000);
    });

</script>
</html>
