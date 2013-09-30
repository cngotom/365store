<div class="sort-all">
    
    
    <?php if ($id!=0) { ?>
            <span><a href="<?php echo $this->createUrl('index',array("id"=>$id,'order'=>0,'page'=>$pages->currentPage ));?>">默认</a></span>
            <span><a href="<?php echo $this->createUrl('index',array("id"=>$id,'order'=>1,'page'=>$pages->currentPage ));?>">销量↓</a></span>
            <span><a href="<?php echo $this->createUrl('index',array("id"=>$id,'order'=>2,'page'=>$pages->currentPage ));?>">价格↓</a></span>
            
    <?php }//search
           else { ?>
            <span><a href="<?php echo $this->createUrl('search',array("keyWord"=>$keyWord,'order'=>0,'page'=>$pages->currentPage ));?>">默认</a></span>
            <span><a href="<?php echo $this->createUrl('search',array("keyWord"=>$keyWord,'order'=>1,'page'=>$pages->currentPage ));?>">销量↓</a></span>
            <span><a href="<?php echo $this->createUrl('search',array("keyWord"=>$keyWord,'order'=>2,'page'=>$pages->currentPage ));?>">价格↓</a></span>

    <?php } ?>
            
        共找到<?php echo $count;?>件商品
    </div>


<?php    $index = 0;
          foreach($goods_list as $goods):  
?>

<div class="common-goods-list <?php if($index %2 == 1) echo "back-gray";?> ">
        <a href="<?php echo $this->createUrl('goods',array('id'=>$goods->goods_id))?>">
            <div class="pic">
                <img width="80px" height="108px" src="<?php echo NGINX_IMG_HOST.$goods->goods_thumb ?>" alt="<?php echo $goods->goods_name ?>">
                
            </div>
            <div class="goods-list-info">
                <span class="blue">
                     <?php echo $goods->goods_name ?></span><br>
                <span class="price">¥<?php echo $goods->shop_price ?></span><br>
                <span class="gray">参考价：<del>¥<?php echo $goods->market_price ?></del></span><br>
            </div>
        </a>
    </div>



<?php   $index+=1;   
         endforeach;?>



<div class="common-page">
    <span class="paginationSimplifyInfo"> 
        <?php $this->widget('CLinkPager',array('pages'=>$pages,'header'=>'','maxButtonCount'=>4,'footer'=>'','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页','lastPageLabel'=>'末页')) ?>
    </span>
</div>

<script>
    $(function(){
        $('.sort-all span:eq(' + <?php echo $order;?>+')').addClass('on');
    });
    
</script>