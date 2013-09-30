<div class="box">

      <div class="mallnavuprightdown">
      <form method="GET" class="sort" name="listform">
        <label style="float:left; margin-left:14px; display:inline;">积分从&nbsp;
            <input type="text" value="12" id="lowPoint" name="lowPoint" class="malltext">
        </label>
        <label style="float:left; margin-left:14px; display:inline;">
           到&nbsp; &nbsp;<input type="text" value="" id="hiPoint" name="hiPoint" class="malltext">&nbsp;&nbsp;&nbsp;
        </label>
       <label style="float:left; display:inline;">
           <input type="button" name="imageField" src="themes/365chi/images/bnt_go.gif" alt="go" class="mallbtn"/>
       </label>
         &nbsp;&nbsp; 排序:
        <select name="sort" style="border:1px solid #ccc;">
        <?php echo $this->html_options(array('options'=>$this->_var['lang']['exchange_sort'],'selected'=>$this->_var['pager']['sort'])); ?>
        </select>
        <select name="order" style="border:1px solid #ccc;">
        <?php echo $this->html_options(array('options'=>$this->_var['lang']['order'],'selected'=>$this->_var['pager']['order'])); ?>
        </select>

        <input type="hidden" name="category" value="<?php echo $this->_var['category']; ?>" />
        <input type="hidden" name="display" value="<?php echo $this->_var['pager']['display']; ?>" id="display" />
        <input type="hidden" name="integral_min" value="<?php echo $this->_var['integral_min']; ?>" />
        <input type="hidden" name="integral_max" value="<?php echo $this->_var['integral_max']; ?>" />
        <input type="hidden" name="page" value="<?php echo $this->_var['pager']['page']; ?>" />
      </form>
    </div>

    <div name="compareForm" >
    <?php if (0 && $this->_var['pager']['display'] == 'list'): ?>
      <div class="goodsList">
      <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods_list']['iteration']++;
?>
        <ul class="clearfix bgcolor"<?php if (($this->_foreach['goods_list']['iteration'] - 1) % 2 == 0): ?>id=""<?php else: ?>id="bgcolor"<?php endif; ?>>
          <li class="thumb"><a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['thumb_img']; ?>" alt="<?php echo $this->_var['goods']['title']; ?>" /></a></li>
          <li class="goodsName">
            <a href="<?php echo $this->_var['goods']['url']; ?>" class="f6">
            <?php if ($this->_var['goods']['goods_style_name']): ?>
              <?php echo $this->_var['goods']['goods_style_name']; ?><br />
            <?php else: ?>
              <?php echo $this->_var['goods']['title']; ?><br />
            <?php endif; ?>
            </a>
            <?php if ($this->_var['goods']['goods_brief']): ?>
              <?php echo $this->_var['lang']['goods_brief']; ?><?php echo $this->_var['goods']['goods_brief']; ?><br />
            <?php endif; ?>
          </li>
          <li>
            <?php echo $this->_var['lang']['exchange_integral']; ?><font class="shop_s"><?php echo $this->_var['goods']['exchange_integral']; ?></font>
          </li>
        </ul>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </div>

    <?php elseif (1 || $this->_var['pager']['display'] == 'grid'): ?>
      <div class="centerPadd">
        <div class="clearfix goodsBox" style="border:none;">
        <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
          <?php if ($this->_var['goods']['id']): ?>
            <div class="goodsItem">
              <a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['thumb_img']; ?>" alt="<?php echo $this->_var['goods']['title']; ?>" class="goodsimg" /></a><br />
              <p><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['title']; ?></a></p>
              <div  class="exchange_fcolor_red"> <?php echo $this->_var['lang']['exchange_integral']; ?><font class="shop_s"><?php echo $this->_var['goods']['exchange_integral']; ?></font><br /></div>
              <p><a title="兑换" onclick="do_exchange(<?php echo $this->_var['goods']['id']; ?>,'<?php echo $this->_var['goods']['title']; ?>' , <?php echo $this->_var['goods']['exchange_integral']; ?>)" href="javascript:void(0);"><img src="themes/365chi/images/integral_btn02.gif"></a></p>
            </div>
          <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
      </div>

    <?php elseif ($this->_var['pager']['display'] == 'text'): ?>
      <div class="goodsList">
      <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
        <ul class="clearfix bgcolor" <?php if (($this->_foreach['goods_list']['iteration'] - 1) % 2 == 0): ?>id=""<?php else: ?>id="bgcolor"<?php endif; ?>>
          <li class="goodsName">
            <a href="<?php echo $this->_var['goods']['url']; ?>" class="f6 f5">
            <?php if ($this->_var['goods']['goods_style_name']): ?>
              <?php echo $this->_var['goods']['goods_style_name']; ?><br />
            <?php else: ?>
              <?php echo $this->_var['goods']['title']; ?><br />
            <?php endif; ?>
            </a>
            <?php if ($this->_var['goods']['goods_brief']): ?>
              <?php echo $this->_var['lang']['goods_brief']; ?><?php echo $this->_var['goods']['goods_brief']; ?><br />
            <?php endif; ?>
          </li>
          <li>
            <?php echo $this->_var['lang']['exchange_integral']; ?><font class="shop_s"><?php echo $this->_var['goods']['exchange_integral']; ?></font>
          </li>
        </ul>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </div>
    <?php endif; ?>
    </div>

</div>
<div class="blank5"></div>
<script type="text/javascript">
    
    function isUnsignedNumeric(strNumber){
        if(isNaN(strNumber)){
            alert('必须是数字！');
            return false; 
        }else if(strNumber<0){
            alert('数字必须大于0！');
            return false; 
        }else{
            return true;
        }
    }
    $(function()
    {
            fixpng();
            //绑定查询按钮事件
            $('.mallnavuprightdown .mallbtn').click(function(){
               var begin = $('#lowPoint').val();
               var end = $('#hiPoint').val();
               
               if( (begin =="" ) && (end =="") )
                {
                    alert('请输入查询积分');
                }
                if(isUnsignedNumeric(begin)&&isUnsignedNumeric(end)){
                    if(parseInt(begin)>parseInt(end)){
                        alert("结束数字必须大于开始数字！");
                        return false;
                    }
                    $("input[name='integral_min']").val(begin);
                    $("input[name='integral_max']").val(end);

                    $("form.sort").submit();
                }
                
            });
            
            $('select[name=sort]').change(function(){
                $("form.sort").submit();
                
            });
            $('select[name=order]').change(function(){
                
                $("form.sort").submit();
            });




    });
    

</script>