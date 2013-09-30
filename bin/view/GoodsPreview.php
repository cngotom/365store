<div id="layer_content" class="list_shadow_ie6 list_op_shadow" >

    <div class="list_op_clo"><img alt="" src="http://static.womai.com/zhongliang/templets/NewIndex/Default/images/list_op_clo.gif" style="cursor:pointer;" onclick="notShow();"></div>
    <div class="list_opimg">
    <div>
    <a href="<?php echo $goods_url;?>" target="_top">
    <img border="0" alt="<?php echo $goods_title;?>"  width="270" height="270" src="<?php echo $goods_img?>">
    </a>
    </div>
    </div>
    <div class="list_opinfo">   <?php echo $goods_info?>  </div>
    <div class="list_opbtn">
   
        
        <div class="list2_r2btn1_2">
                            <a onclick="<?php echo "simpleAddToCart('$goods_id','show_success_tips_$goods_id');";?>"  href="javascript:void(0)"></a>
        </div>

            <a target="_blank" class="list_oplink3_1" href="<?php echo $goods_url;?>">&gt;&gt;详情</a>

        <a class="list_oplink2_1" onclick="collect(<?php echo $goods_id;?>)" name="favorite" href="javascript:;"></a>
    </div>
    <div style="width:150px; text-align:center; margin-top:20px; _margin-top:0px; margin-left:22px;" id="showlabel505201"><input type="hidden" id="showlabletag" value="true"></div>
    	
</div>
  <div class="list_bottom_ie6 list_op_bottom"></div>
