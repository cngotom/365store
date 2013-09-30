
<?php if (! $this->_var['is_index']): ?>
<div id="list_menu">
    <ul>
            <?php $_from = $this->_var['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>
                    <?php if ($this->_var['cat']['id'] == $this->_var['parent_id'] || $this->_var['cat']['id'] == $this->_var['category']): ?>
                    <li class="selected"><a class="main_cate" href="<?php echo $this->_var['cat']['url']; ?>"><?php echo htmlspecialchars($this->_var['cat']['name']); ?></a>
                        <div style="display:display;" id="cate_list"  >
                                <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');if (count($_from)):
    foreach ($_from AS $this->_var['child']):
?>
                                                <span  <?php if ($this->_var['child']['id'] == $this->_var['category']): ?> class='on'<?php endif; ?> ><a  href="<?php echo $this->_var['child']['url']; ?>"><?php echo htmlspecialchars($this->_var['child']['name']); ?></a></span>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </div>
                    </li>
                    <?php else: ?>
                       <li class="selectedno"><a class="main_cate" href="<?php echo $this->_var['cat']['url']; ?>"><?php echo htmlspecialchars($this->_var['cat']['name']); ?></a>
                        <div style="display:none;" id="cate_list">
                                <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');if (count($_from)):
    foreach ($_from AS $this->_var['child']):
?>
                                                <span class=""><a href="<?php echo $this->_var['child']['url']; ?>"><?php echo htmlspecialchars($this->_var['child']['name']); ?></a></span>
                                 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </div>
                    </li>
                    <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
    </ul>
</div>


<?php else: ?>
<div class="menu fl">
        <ul style="margin-top:15px; " id="menu_ulist">
                <?php $_from = $this->_var['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['foo']['iteration']++;
?>
                <li class="s<?php echo $this->_foreach['foo']['iteration']; ?>">
                   <a href="<?php echo $this->_var['cat']['url']; ?>"  index="<?php echo ($this->_foreach['foo']['iteration'] - 1); ?>"><?php echo htmlspecialchars($this->_var['cat']['name']); ?></a>
                </li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 

        </ul>
            
         
         <?php $_from = $this->_var['category_brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand_cats');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['brand_cats']):
        $this->_foreach['foo']['iteration']++;
?>
         <div  class="sale_class" >
                
                <?php $_from = $this->_var['brand_cats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand_cat');if (count($_from)):
    foreach ($_from AS $this->_var['brand_cat']):
?>
                      <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a href="<?php echo $this->_var['brand_cat']['cat']['url']; ?>"><?php echo $this->_var['brand_cat']['cat']['name']; ?>:</a></span>
                          <span  class="sale_fenlei_2">
                            <?php $_from = $this->_var['brand_cat']['brand']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['brand']):
        $this->_foreach['child']['iteration']++;
?>
                            <?php if (($this->_foreach['child']['iteration'] - 1) < 3): ?>
                                 <a href="<?php echo $this->_var['brand']['url']; ?>"><?php echo $this->_var['brand']['brand_name']; ?></a>
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>   
                        </span>
                   </div>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>  
         </div>
         <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
         
         
         
         
         <div  class="sale_class" >
                      <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>大米:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">稻花香</a><a>私享食光</a><a>火山石板</a>
                          </span>
                      </div>
                     <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>面粉:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">北大荒富强</a><a>有机饺子粉</a>
                          </span>
                      </div>
                      <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>杂粮:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">玉米糁</a><a>杂粮礼盒</a>
                          </span>
                      </div>
                      <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>食用油:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">橄榄油</a><a>欧伯特</a>
                          </span>
                      </div>            
         </div>
          
         <div  class="sale_class" >
                      <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>有机茶:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">铁观音</a><a>QT-680</a><a>QT-1680</a>
                          </span>
                          
                      </div>
                     <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>豆奶豆乳:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">北大荒芳临</a><a>黑豆味</a><a>原味</a><a>无糖</a>
                          </span>
                      </div>
                      <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>蜂蜜:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">百合康</a><a>五星湖</a><a href="#">汉珍蜜坊</a><a>东北黑蜂</a>
                          </span>
                      </div>
                      <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>果蔬籽粉:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">黄瓜籽粉</a><a>葡萄籽粉</a><a>苦瓜籽粉</a>
                          </span>
                      </div>       
                     <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>茶叶:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">普洱</a><a>龙井</a><a>铁观音</a><a>中茶</a>
                          </span>
                      </div> 
         </div>
          
         <div  class="sale_class" >
                      <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>进口果汁:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">西瑞斯</a><a>苹果味</a><a>芒果味</a><a>宝石红柚</a>
                          </span>
                      </div>
                     <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>进口牛奶:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">Conaprole卡贝乐</a>
                          </span>
                      </div>
                      <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>台湾食品:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">食尚森活</a><a>腰果核桃粉</a><a>养生黑五宝</a>
                          </span>
                      </div>
                    
                     <div class="sale_fenlei">
                         <span class="sale_fenlei_1"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">黑木耳粉</a><a>日月潭龙眼蜜</a><a>养生杏仁</a>
                          </span>
                      </div>
                    
         </div>
           
         <div  class="sale_class">
                      <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>金枪鱼:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">凯基</a><a>野生大目</a><a>野生蓝鳍</a>
                          </span>
                      </div>
                     <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>鲜肉禽蛋:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">添康生态</a><a>有机五花肉</a><a>有机瘦肉馅</a>
                          </span>
                      </div>
                      
                      <div class="sale_fenlei">
                         <span class="sale_fenlei_1"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">有机小里脊</a><a href="#">有机肉丁</a>
                          </span>
                      </div>
                      <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>蔬菜水果:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">猕猴桃</a><a>红心木瓜</a><a>墨西哥牛油果</a>
                          </span>
                      </div>              
         </div>
            
         <div  class="sale_class">
                      <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>干果坚果:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">金疆玉枣</a><a>莓干</a><a>益者有机枣</a>
                          </span>
                      </div>
                      
                       <div class="sale_fenlei">
                         <span class="sale_fenlei_1"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">金纱核桃</a><a href="#">金硕杏仁</a><a href="#">金响开心果</a>
                          </span>
                      </div>
                     <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>山珍山货:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">宝泉岭</a><a>秋木耳</a><a href="#">香菇</a><a>野生松茸</a>
                          </span>
                      </div>
                      
                       <div class="sale_fenlei">
                         <span class="sale_fenlei_1"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">中粮</a><a href="#">黑木耳</a><a href="#">山萃原木香菇</a>
                          </span>
                      </div>
         </div>
             
         <div  class="sale_class">
                      <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>一卡换多卡:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">北京金钱豹</a><a>味多美</a><a>面包新语</a>
                          </span>
                      </div>
                      
                       <div class="sale_fenlei">
                         <span class="sale_fenlei_1"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">金凤呈祥</a>
                          </span>
                      </div>
                      <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>365卡:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">牛奶预售</a><a>松子提货</a><a>金枪鱼提货</a>
                          </span>
                      </div>
                      
                       <div class="sale_fenlei">
                         <span class="sale_fenlei_1"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">芳临豆乳</a><a>杂粮礼盒</a><a>有机茶提货卡</a>
                          </span>
                      </div>
                      
                     <div class="sale_fenlei">
                          <span class="sale_fenlei_1"><a>礼卡充值:</a></span>
                          <span  class="sale_fenlei_2">
                              <a href="#">北大荒</a><a>饺子粉</a>
                          </span>
                      </div> 
         </div>
             
        </div>





<?php endif; ?>
<div class="blank5"></div>
<div class="blank"></div>
<script type="text/javascript">

$(function() {
    var timeout;
    //显示二级分类
    $('#menu_ulist a').mouseenter(function(){
        var index = $(this).attr('index');
        $( '.sale_class:eq(' + index + ')' ).show();  
        $(this).addClass('cur');
    });
    $('#menu_ulist a').mouseleave(function(){
        var ele = this;
        var index = $(this).attr('index');
        timeout = setTimeout( function(){ 
            $('.sale_class:eq(' + index + ')' ).hide(); 
            $(ele).removeClass('cur');
        },1 );
    });
    $('.sale_class').mouseenter(function(){
        clearTimeout(timeout);
        var ele = this;
        var index = 0;
        $('.sale_class').each(function(i,e){
            if(e === ele)
                index = i;
        });
        $(ele).show();  
        $('#menu_ulist a:eq(' + index + ')' ).addClass('cur');
    });
    $('.sale_class').mouseleave(function(){
        var ele = this;
        $(ele).hide();
        $('#menu_ulist a').removeClass('cur');
    });
});


</script>