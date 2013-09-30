
<?php $_from = $this->_var['index_loop_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'loop_cat');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['loop_cat']):
        $this->_foreach['foo']['iteration']++;
?>
 <?php if (($this->_foreach['foo']['iteration'] - 1) < 2): ?>
<div class="mmly one_column">
        <div  class="classname"><?php echo $this->_var['loop_cat']['name']; ?></div>
        
        <div class="fl">
            
            <div>
                <div style="clear: left;height:8px; line-height:8px; width:879px;  background-color:#67AB27;  "> &nbsp;</div>
            </div>
            <div class="class_menu">
                <ul>
                    <?php $_from = $this->_var['loop_cat']['child_cates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate');$this->_foreach['boo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['boo']['total'] > 0):
    foreach ($_from AS $this->_var['cate']):
        $this->_foreach['boo']['iteration']++;
?>
                       <li><a href="<?php echo $this->_var['cate']['url']; ?>" cat_id="<?php echo $this->_var['cate']['id']; ?>" index="<?php echo ($this->_foreach['boo']['iteration'] - 1); ?>">&nbsp;<?php echo $this->_var['cate']['name']; ?> &nbsp;</a></li>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>
            </div>
        </div>
        
        <div class="clear"></div>
        
        <div class="sales cur">
           <?php $_from = $this->_var['loop_cat']['cate_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_04649600_1358262036');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_04649600_1358262036']):
        $this->_foreach['child']['iteration']++;
?>
           <?php if (($this->_foreach['child']['iteration'] - 1) < 4): ?>
             <div class="sales_h"    <?php if (($this->_foreach['child']['iteration'] <= 1)): ?>   style="border-left:1px solid #d7d7d7;" <?php endif; ?>>
                 <a  href="<?php echo $this->_var['goods_0_04649600_1358262036']['url']; ?>"><img width="135" height="135" src="<?php echo $this->_var['goods_0_04649600_1358262036']['goods_img']; ?>" alt="<?php echo $this->_var['goods_0_04649600_1358262036']['name']; ?>" id="goodsimg_<?php echo $this->_var['goods_0_04649600_1358262036']['id']; ?>" class="ajax-modify-pic" /></a>
                 <span><a  href="<?php echo $this->_var['goods_0_04649600_1358262036']['url']; ?>"><?php echo $this->_var['goods_0_04649600_1358262036']['short_name']; ?></a></span>
                  <span style="color:#cf2424; "><h1>￥<?php echo $this->_var['goods_0_04649600_1358262036']['price']; ?></h1></span>
             </div>
           <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>   
        </div>
        
         <?php $_from = $this->_var['loop_cat']['child_cat_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child_goods');if (count($_from)):
    foreach ($_from AS $this->_var['child_goods']):
?>
        <div class="sales">
           <?php $_from = $this->_var['child_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_06598300_1358262036');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_06598300_1358262036']):
        $this->_foreach['child']['iteration']++;
?>
           <?php if (($this->_foreach['child']['iteration'] - 1) < 4): ?>
             <div class="sales_h"    <?php if (($this->_foreach['child']['iteration'] <= 1)): ?>   style="border-left:1px solid #d7d7d7;" <?php endif; ?>>
                 <a  href="<?php echo $this->_var['goods_0_06598300_1358262036']['url']; ?>"><img width="135" height="135" src="<?php echo $this->_var['goods_0_06598300_1358262036']['goods_img']; ?>" alt="<?php echo $this->_var['goods_0_06598300_1358262036']['name']; ?>" id="goodsimg_<?php echo $this->_var['goods_0_06598300_1358262036']['id']; ?>" class="ajax-modify-pic" /></a>
                 <span><a  href="<?php echo $this->_var['goods_0_06598300_1358262036']['url']; ?>"><?php echo $this->_var['goods_0_06598300_1358262036']['short_name']; ?></a></span>
                  <span style="color:#cf2424; "><h1>￥<?php echo $this->_var['goods_0_06598300_1358262036']['price']; ?></h1></span>
             </div>
           <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>   
        </div>
         <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>  

        
        <div class="cooperate">
            <?php if ($this->_var['loop_cat']['brands']): ?>
                <?php $_from = $this->_var['loop_cat']['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand_0_07787900_1358262036');$this->_foreach['brand_child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['brand_child']['total'] > 0):
    foreach ($_from AS $this->_var['brand_0_07787900_1358262036']):
        $this->_foreach['brand_child']['iteration']++;
?>
                <div class="pinpai">
                    <a href="brand.php?id=<?php echo $this->_var['brand_0_07787900_1358262036']['brand_id']; ?>"><img title='<?php echo $this->_var['brand_0_07787900_1358262036']['brand_name']; ?>' src="data/brandlogo/<?php echo $this->_var['brand_0_07787900_1358262036']['brand_logo']; ?>" /></a>
                </div>

                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
            <?php endif; ?>
            <?php if ($this->_var['loop_cat']['ad_id']): ?>     
            <div class="xuan">
                <script type="text/javascript" src="affiche.php?act=js&type=0&ad_id=<?php echo $this->_var['loop_cat']['ad_id']; ?>"></script>
            </div>
            <?php endif; ?>
        </div>
       
    </div>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>







  
        <?php $_from = $this->_var['index_loop_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'loop_cat');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['loop_cat']):
        $this->_foreach['foo']['iteration']++;
?>
         <?php if (($this->_foreach['foo']['iteration'] - 1) >= 2): ?>
        
          <?php if (($this->_foreach['foo']['iteration'] - 1) % 2 == 0): ?>
                 <div class="mmly" style="height: 270px;" > 
         <?php endif; ?>
              
              
            <div  class="jksp fl">
            <div  class="classname"><?php echo $this->_var['loop_cat']['name']; ?></div>
                <div class="fl">
                
                    <div>
                        <div style="clear: left;height:8px; line-height:8px; width:378px;  background-color:#67AB27;  "> &nbsp;</div>
                    </div>
                    <div class="class_menu">
                        <ul>
                            <?php $_from = $this->_var['loop_cat']['child_cates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate');$this->_foreach['boo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['boo']['total'] > 0):
    foreach ($_from AS $this->_var['cate']):
        $this->_foreach['boo']['iteration']++;
?>
                                <?php if (($this->_foreach['boo']['iteration'] - 1) < 6): ?>
                                    <li><a href="<?php echo $this->_var['cate']['url']; ?>" index="<?php echo ($this->_foreach['boo']['iteration'] - 1); ?>">&nbsp;<?php echo $this->_var['cate']['name']; ?> &nbsp;</a></li>
                                <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </ul>
                    </div>

            </div>
            <div class="clear"></div>
            <div class="jksp_view cur">
                    <?php $_from = $this->_var['loop_cat']['cate_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_24669100_1358262036');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_24669100_1358262036']):
        $this->_foreach['child']['iteration']++;
?>
                    <?php if (($this->_foreach['child']['iteration'] - 1) < 3): ?>
                    
                            <?php if (($this->_foreach['child']['iteration'] <= 1)): ?> 
                            <div class="jksp_s"   >
                                <a  href="<?php echo $this->_var['goods_0_24669100_1358262036']['url']; ?>"><img  src="<?php echo $this->_var['goods_0_24669100_1358262036']['goods_img']; ?>" alt="<?php echo $this->_var['goods_0_24669100_1358262036']['name']; ?>" id="goodsimg_<?php echo $this->_var['goods_0_24669100_1358262036']['id']; ?>" class="ajax-modify-pic" /></a>
                                <div class="jksp_s_np">
                                    <span><a href="<?php echo $this->_var['goods_0_24669100_1358262036']['url']; ?>"><?php echo $this->_var['goods_0_24669100_1358262036']['name']; ?></a></span> <span style="text-align: right;color: #ffff00;font-size: 16px; font-weight: bolder;">￥<?php echo $this->_var['goods_0_24669100_1358262036']['price']; ?></span>
                                </div>
                            </div>
                            <?php else: ?>
                                <div class="jksp_s2">
                                    <div><a  href="<?php echo $this->_var['goods_0_24669100_1358262036']['url']; ?>"><img  src="<?php echo $this->_var['goods_0_24669100_1358262036']['goods_img']; ?>" alt="<?php echo $this->_var['goods_0_24669100_1358262036']['name']; ?>" id="goodsimg_<?php echo $this->_var['goods_0_24669100_1358262036']['id']; ?>" class="ajax-modify-pic" /></a></div>
                                    <div class="jksp_name"><a href="<?php echo $this->_var['goods_0_24669100_1358262036']['url']; ?>"><?php echo $this->_var['goods_0_24669100_1358262036']['short_name']; ?></a></div>
                                    <div class="jksp_price"><span style="font-size: 16px;">￥</span><span style="font-size: 25px; font-weight: bolder;"><?php echo $this->_var['goods_0_24669100_1358262036']['price']; ?></span></div>
                                </div>
                            <?php endif; ?>
                         
                    <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>   
            </div>
            
                
            <?php $_from = $this->_var['loop_cat']['child_cat_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child_goods');if (count($_from)):
    foreach ($_from AS $this->_var['child_goods']):
?>
            <div class="jksp_view">
                    <?php $_from = $this->_var['child_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_26123200_1358262036');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_26123200_1358262036']):
        $this->_foreach['child']['iteration']++;
?>
                    <?php if (($this->_foreach['child']['iteration'] - 1) < 3): ?>
                    
                            <?php if (($this->_foreach['child']['iteration'] <= 1)): ?> 
                            <div class="jksp_s"   >
                                <a  href="<?php echo $this->_var['goods_0_26123200_1358262036']['url']; ?>"><img  src="<?php echo $this->_var['goods_0_26123200_1358262036']['goods_img']; ?>" alt="<?php echo $this->_var['goods_0_26123200_1358262036']['name']; ?>" id="goodsimg_<?php echo $this->_var['goods_0_26123200_1358262036']['id']; ?>" class="ajax-modify-pic" /></a>
                                <div class="jksp_s_np">
                                    <span><a href="<?php echo $this->_var['goods_0_26123200_1358262036']['url']; ?>"><?php echo $this->_var['goods_0_26123200_1358262036']['name']; ?></a></span> <span style="text-align: right;color: #ffff00;font-size: 16px; font-weight: bolder;">￥<?php echo $this->_var['goods_0_26123200_1358262036']['price']; ?></span>
                                </div>
                            </div>
                            <?php else: ?>
                                <div class="jksp_s2">
                                    <div><a  href="<?php echo $this->_var['goods_0_26123200_1358262036']['url']; ?>"><img  src="<?php echo $this->_var['goods_0_26123200_1358262036']['goods_img']; ?>" alt="<?php echo $this->_var['goods_0_26123200_1358262036']['name']; ?>" id="goodsimg_<?php echo $this->_var['goods_0_26123200_1358262036']['id']; ?>" class="ajax-modify-pic" /></a></div>
                                    <div class="jksp_name"><a href="<?php echo $this->_var['goods_0_26123200_1358262036']['url']; ?>"><?php echo $this->_var['goods_0_26123200_1358262036']['short_name']; ?></a></div>
                                    <div class="jksp_price"><span style="font-size: 16px;">￥</span><span style="font-size: 25px; font-weight: bolder;"><?php echo $this->_var['goods_0_26123200_1358262036']['price']; ?></span></div>
                                </div>
                            <?php endif; ?>
                         
                    <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>   
            </div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
            
            
            
            
            
        
        </div>
        <?php if (($this->_foreach['foo']['iteration'] - 1) % 2 == 1): ?>
                </div>  
        <?php endif; ?>
        
        <?php endif; ?>
     <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
   
    

<script type="text/javascript">

$(function() {
;
    $('.mmly.one_column').each(function(index,ele){
         $(ele).find('.class_menu a').hover( function(){
             $(ele).find('.class_menu a.cur').removeClass('cur');
             $(this).addClass('cur');        
             var i =  parseInt( $(this).attr('index') );        
            
            
             $(ele).find('.sales.cur').removeClass('cur');
             $(ele).find('.sales:eq(' + (i+1) +')').addClass('cur');
            
        });
        $(ele).find('.classname').hover(function(){
             $(ele).find('.class_menu a.cur').removeClass('cur');   
             $(ele).find('.sales.cur').removeClass('cur');
             $(ele).find('.sales:first').addClass('cur');

        });
        
       
    });
    
     $('.jksp').each(function(index,ele){
          $(ele).find('.class_menu a').hover( function(){
             $(ele).find('.class_menu a.cur').removeClass('cur');
             $(this).addClass('cur');        
             var i =  parseInt( $(this).attr('index') );        
            
            
             $(ele).find('.jksp_view.cur').removeClass('cur');
             $(ele).find('.jksp_view:eq(' + (i+1) +')').addClass('cur');
            
        });
        $(ele).find('.classname').hover(function(){
             $(ele).find('.class_menu a.cur').removeClass('cur');   
             $(ele).find('.jksp_view.cur').removeClass('cur');
             $(ele).find('.jksp_view:first').addClass('cur');

        });
    });
 
   

});


</script>
