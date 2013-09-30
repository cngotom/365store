<div id="showways" class="rankOp .mt10">
<style>

    .producteg img,producteg a img{    
			border:0;    
			margin:0;    
			padding:0;    
			max-width:184px;    
			width:expression(this.width>184?"184px":this.width);    
			max-height:248px;    
			height:expression(this.height>248?"248px":this.height);    
	}
     .table {
                    height: 248px;/*高度值不能少*/
                    width: 184px;/*宽度值不能少*/
                    display: table;
                    position: relative;
                    float:left;
        }		

        .tableCell {
                    display: table-cell;
                    vertical-align: middle;
                    text-align: center;			
                    *position: absolute;
                    *top: 50%;
                    *left: 50%;
        }
        .content {
                    *position:relative;
                    *top: -50%;
                    *left: -50%;
        }    
        .content .imgwrap{
           *height:248px;
        }
</style>		
 <?php if ($this->_var['script_name'] == category): ?>
            <ul class="rank">
              
                <li class="<?php if ($this->_var['pager']['sort'] == 'last_update'): ?>normal<?php else: ?>default<?php endif; ?>">
                    <a href="<?php echo $this->_var['script_name']; ?>.php?category=<?php echo $this->_var['category']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=last_update&order=<?php if ($this->_var['pager']['sort'] == 'last_update' && $this->_var['pager']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>">默认排序</a>	</li>
                <li class="<?php if ($this->_var['pager']['sort'] == 'salesnum'): ?><?php echo $this->_var['pager']['order']; ?><?php else: ?>default<?php endif; ?>">
                    <a href="<?php echo $this->_var['script_name']; ?>.php?category=<?php echo $this->_var['category']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=salesnum&order=<?php if ($this->_var['pager']['sort'] == 'salesnum' && $this->_var['pager']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>"><span>销量</span></a></li>	                        	 
                <li class="<?php if ($this->_var['pager']['sort'] == 'shop_price'): ?><?php echo $this->_var['pager']['order']; ?><?php else: ?>default<?php endif; ?>">
                    <a  href="<?php echo $this->_var['script_name']; ?>.php?category=<?php echo $this->_var['category']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=shop_price&order=<?php if ($this->_var['pager']['sort'] == 'shop_price' && $this->_var['pager']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>"> <span>价格</span></a></li>
                <li class="<?php if ($this->_var['pager']['sort'] == 'comment_rank'): ?><?php echo $this->_var['pager']['order']; ?><?php else: ?>default<?php endif; ?>">
                    <a  href="<?php echo $this->_var['script_name']; ?>.php?category=<?php echo $this->_var['category']; ?>&display=<?php echo $this->_var['pager']['displpriceay']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=comment_rank&order=<?php if ($this->_var['pager']['sort'] == 'comment_rank' && $this->_var['pager']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>"><span>评价</span></a></li>	                        	 
                <li class="<?php if ($this->_var['pager']['sort'] == 'goods_id'): ?><?php echo $this->_var['pager']['order']; ?><?php else: ?>default<?php endif; ?>">
                    <a  href="<?php echo $this->_var['script_name']; ?>.php?category=<?php echo $this->_var['category']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=goods_id&order=<?php if ($this->_var['pager']['sort'] == 'goods_id' && $this->_var['pager']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>"><span>上架时间</span></a>
                </li>	                        	 
             </ul>             
    
  <?php else: ?>
    
           <ul class="rank">
              
                <li class="<?php if ($this->_var['pager']['search']['sort'] == 'last_update'): ?>normal<?php else: ?>default<?php endif; ?>">
                    <a href="<?php echo $this->_var['script_name']; ?>.php?keywords=<?php echo $this->_var['keywords']; ?>&display=<?php echo $this->_var['pager']['search']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['search']['page']; ?>&sort=last_update&order=<?php if ($this->_var['pager']['search']['sort'] == 'last_update' && $this->_var['pager']['search']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>">默认排序</a>	</li>
                <li class="<?php if ($this->_var['pager']['search']['sort'] == 'salesnum'): ?><?php echo $this->_var['pager']['search']['order']; ?><?php else: ?>default<?php endif; ?>">
                    <a href="<?php echo $this->_var['script_name']; ?>.php?keywords=<?php echo $this->_var['keywords']; ?>&display=<?php echo $this->_var['pager']['search']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['search']['page']; ?>&sort=salesnum&order=<?php if ($this->_var['pager']['search']['sort'] == 'salesnum' && $this->_var['pager']['search']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>"><span>销量</span></a></li>	                        	 
                <li class="<?php if ($this->_var['pager']['search']['sort'] == 'shop_price'): ?><?php echo $this->_var['pager']['search']['order']; ?><?php else: ?>default<?php endif; ?>">
                    <a  href="<?php echo $this->_var['script_name']; ?>.php?keywords=<?php echo $this->_var['keywords']; ?>&display=<?php echo $this->_var['pager']['search']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['search']['page']; ?>&sort=shop_price&order=<?php if ($this->_var['pager']['search']['sort'] == 'shop_price' && $this->_var['pager']['search']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>"> <span>价格</span></a></li>
                <li class="<?php if ($this->_var['pager']['search']['sort'] == 'comment_rank'): ?><?php echo $this->_var['pager']['search']['order']; ?><?php else: ?>default<?php endif; ?>">
                    <a  href="<?php echo $this->_var['script_name']; ?>.php?keywords=<?php echo $this->_var['keywords']; ?>&display=<?php echo $this->_var['pager']['search']['displpriceay']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['search']['page']; ?>&sort=comment_rank&order=<?php if ($this->_var['pager']['search']['sort'] == 'comment_rank' && $this->_var['pager']['search']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>"><span>评价</span></a></li>	                        	 
                <li class="<?php if ($this->_var['pager']['search']['sort'] == 'goods_id'): ?><?php echo $this->_var['pager']['search']['order']; ?><?php else: ?>default<?php endif; ?>">
                    <a  href="<?php echo $this->_var['script_name']; ?>.php?keywords=<?php echo $this->_var['keywords']; ?>&display=<?php echo $this->_var['pager']['search']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['search']['page']; ?>&sort=goods_id&order=<?php if ($this->_var['pager']['search']['sort'] == 'goods_id' && $this->_var['pager']['search']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>"><span>上架时间</span></a>
                </li>	                        	 
             </ul>        
    
   <?php endif; ?>
    <!--
             <ul class="select">
                <li>筛 选：</li>
                <li>
                    <input type="checkbox" name="filter" value="1" onclick="clickFilterBox();">
                    <label>促销</label>
                </li>
                <li>
                    <input type="checkbox" name="filter" value="2" onclick="clickFilterBox();">
                    <label>推荐</label>
                </li>
                <li>
                    <input type="checkbox" name="filter" value="3" onclick="clickFilterBox();">
                    <label>新品</label>
                </li>
             </ul>
    
    -->
</div>
<div class="itemSearchResult">
          <ul>

    <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods_list']['iteration']++;
?>
               <li class="producteg" id="producteg_1531478">
                   <div style="width:184px;height:248px;margin:0 auto; display: block">
                    <div class="table">
                                    <div class="tableCell">
                                        <div class="content"><a  href="<?php echo $this->_var['goods']['url']; ?>" target="_blank"  style="display:block;width:184px;" class="imgwrap">
                                    <img id="goodsimg_<?php echo $this->_var['goods']['goods_id']; ?>" onmouseover="showLayer(<?php echo $this->_var['goods']['goods_id']; ?>)"  onmouseout="notShow()"  src="<?php echo $this->_var['goods']['goods_thumb']; ?>" title="<?php echo $this->_var['goods']['goods_name']; ?>" class="ajax-modify-pic" style="display:block; margin:0 auto;text-align:center;margin-top:expression((250 - this.height )/2);"></a></div>
                                    </div>
                        </div>
                   </div>
                   

                    <a class="title" href="#" target="_blank" title="<?php echo $this->_var['goods']['goods_name']; ?>" onclick="addTrackPositionToCookie('1','pro_0');">
                                 <?php if ($this->_var['goods']['goods_style_name']): ?>
        <?php echo $this->_var['goods']['goods_style_name']; ?><br />
        <?php else: ?>
        <?php echo $this->_var['goods']['goods_name']; ?><br />
        <?php endif; ?> </a>
                    <p class="price clearfix">
                        <span>  <strong>    <?php if ($this->_var['goods']['promote_price'] != ""): ?>
           <?php echo $this->_var['goods']['promote_price']; ?>
            <?php else: ?>
           ￥<?php echo $this->_var['goods']['price']; ?>
            <?php endif; ?></strong>
                            
                        </span>
                        
                        <span style="float:right;margin-right: 15px;" >     
                            <img src="themes/365chi/images/stars<?php echo $this->_var['goods']['comment_rank']; ?>.gif" alt="comment rank <?php echo $this->_var['goods']['comment_rank']; ?>" />
                        </span>                        
                    </p>                             
                    <p>
                        <button class="buy" id="buyButton_1531478" specialtype="0" onclick="simpleAddToCart(<?php echo $this->_var['goods']['goods_id']; ?>,'show_success_tips_<?php echo $this->_var['goods']['goods_id']; ?>');">加入购物车</button>
                        <button class="fav" id="favorButton_1531478" onclick="collect(<?php echo $this->_var['goods']['goods_id']; ?>);">收藏</button>
                    </p>
                    <div style="display: none;background-color: green;position: absolute;bottom: 10px;left: 10px;z-index: 1000;color: white;" id="show_success_tips_<?php echo $this->_var['goods']['goods_id']; ?>"  ><span>该商品已经被添加到购物车里面</span></div>
              </li>
               <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
   
          </ul>
</div>



















<div class="blank5"></div>
<script type="Text/Javascript" language="JavaScript">
<!--

function selectPage(sel)
{
  sel.form.submit();
}

//-->
</script>
