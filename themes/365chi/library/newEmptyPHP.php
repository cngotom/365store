
{foreach from=$index_loop_cat item=loop_cat name=foo}
<div>
<div id="index_cat_head" class="clearfix">
	<div id="index_cat_head_bg" class="index_cat_bg_c{$smarty.foreach.foo.index}"> </div>
	<div id="index_cat_head_text"> <div style="margin-left:12px;" >{$loop_cat.name} <font class="index_cat_c{$smarty.foreach.foo.index}">Product </font>List </div></div>
	<div id="index_cat_head_r">  
             {foreach from=$loop_cat.child_cates item=cate}
                <a href="{$cate.url}"> {$cate.name} </a> |&nbsp;
             {/foreach}
             <a href="{$loop_cat.url}">更多</a>
        </div>
</div>
<div id="index_cat_center" class="clearfix" >
    <div id="index_cat_products"  >
        
          {foreach from=$loop_cat.cate_goods item=goods}
                <div id="index_cat_item"> 
                    <div id="index_cat_item_image">
                        <a href="{$goods.url}"><img width="120" height="120" src="{$goods.goods_img}" alt="{$goods.name}" id="goodsimg_{$goods.id}" class="ajax-modify-pic"></a>
                    </div>
                    <div id="index_cat_item_text">
                        <div class="re-text">{$goods.short_name}</div>
                        <div class="re-price">￥<strong>{$goods.price}</strong></div>
                    </div>
                </div>
          {/foreach}  

    </div> 
    <div class="index_cat_r_content" >
        <div class="slide-controls">
            <span class="curr">1</span>            
            <span class="">2</span>
            <span class="">3</span>
        </div>
        {foreach from=$loop_cat.best item=goods name=foo2}
         {if $smarty.foreach.foo2.index <= 2}
            <div class="m-slide-content {if $smarty.foreach.foo2.index == 0}m-slide-show{/if}"  >
                <div id="index_cat_r_contet_text" class="index_cat_c{$smarty.foreach.foo.index}" style="font-size:16px;font-weight:bold;line-height: 20px;">
                        {$goods.short_name} <br>
                    <!-- {if $goods.promote_price neq ""} -->
                        {$goods.promote_price}
                        <!-- {else}-->
                        {$goods.shop_price}
                        <!--{/if}-->
                </div>
                <div id="index_cat_r_contet_image_l">
                        <div id="index_cat_r_contet_image_l_bg"></div>
                </div>
                <div id="index_cat_r_contet_image_r"> 
                    <a href="{$goods.url}"><img src="{$goods.thumb}" alt="{$goods.goods_name|escape:html}" class="goodsimg" width="150px" height="150px"/></a>
                </div>
            </div>
         {/if}
         {/foreach}  
    </div>
</div>



</div>
<div class="blank"></div>
{/foreach}

<script> 
$(function() {
    
   $('.index_cat_r_content').each(function(a){
        var parent = this;
        $(parent).find('.slide-controls').find('span').each(function(a){
            $(this).mouseenter(function(){    
                choose_index = parseInt($(this).html());
                $(parent).find('.slide-controls').find('span').each(function(index){
                    $(this).removeClass('curr');
                });
                $(this).addClass('curr');
                $(parent).find('.m-slide-content').each(function(m_index){
                        if(choose_index ==  m_index+1)
                        {
                            $(this).addClass('m-slide-show');
                        }
                        else
                        {
                           $(this).removeClass('m-slide-show');     
                        }
                    
                });
        });
   
   });
       
       
       
       
       
       
       
       
       
       
   });
       
      
   

});
    
</script>