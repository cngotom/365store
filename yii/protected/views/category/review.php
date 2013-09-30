
<div class="p-tab">
    <ul>
        <li name="title1"><a href="<?php echo $this->createUrl('goods',array("id"=>$id));?>">
            简介</a></li>

        <li name="title3" class="current">评论<span style="font-size: 10px; line-height: 1em;">(<?php echo $count?>)</span></li>
        <li name="title4"><a href="<?php echo $this->createUrl('detail',array("id"=>$id));?>">
            详情</a></li>
    </ul>
</div>
    <div class="goods-comment">
        <ul>
                  <?php   foreach($comment_list as $comment):  ?>
                     <li><?php echo $comment->content?><br /><em>来自 <?php echo $comment->vagueEmail?>&nbsp;&nbsp;<?php echo $comment->time?></em></li>                     
                  <?php endforeach ?>
        </ul>
    </div>

</div>
