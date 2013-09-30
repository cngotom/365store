<div class="p-tab">
    <ul>
        <li name="title1"><a href="<?php echo $this->createUrl('goods',array("id"=>$id))?>">
            简介</a></li>

        <li name="title3"><a href="<?php echo $this->createUrl('review',array("id"=>$id));?>">
            评论<span style="font-size: 10px; line-height: 1em;">(<?php echo $count?>)</span></a></li>
        <li name="title4" class="current">详情</li>
    </ul>
</div>


<!--商品详情 BEGIN -->
<div class="goods-comment" style="overflow:hidden;">

    <?php echo $content ?>
</div> 
<script>
    //修正图片
    $(function(){
        $('.goods-comment img').hide();
        $('.goods-comment img').each(function(index,ele){
            if($(ele).width() > 310 )
            {
                var radio = $(ele).width() / 310 ;
                $(ele).height(      $(ele).height() / radio    );
                 $(ele).width(      310   );
            }
            $(ele).show();
        
        });
    });
    
    
    
    
</script>
  
