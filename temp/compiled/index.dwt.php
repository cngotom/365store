<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<link href="js/jquery-ui.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="themes/365chi/index.css" rel="stylesheet" type="text/css" />
<link rel="alternate" type="application/rss+xml" title="RSS|<?php echo $this->_var['page_title']; ?>" href="<?php echo $this->_var['feed_url']; ?>" />
<?php if ($this->_var['is_index']): ?>
    <link href="themes/365chi/index_ad.css" rel="stylesheet" type="text/css" />
<?php endif; ?>

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,index.js,lefttime.js')); ?>

</head>
<body>
    


<!--
<div class="topad j-change" style="background-color:#">
    <div class="js-slideS" style="display: block;"><a href="topic.php?topic_id=4" target="_blank"><img width="967" height="52" alt="topad" src="themes/365chi/images/green/index/small_index.jpg"></a></div>
    <div style="display: none;" class="js-slideB"><a href="topic.php?topic_id=4" target="_blank"><img width="960" height="402" alt="topad" src="themes/365chi/images/green/index/big_index.jpg"></a></div>
</div>
-->
<!-- 春节礼品
<div class="topad j-change" style="background-color:#">
   <div class="js-slideS" style="display: block;"><a href="topic.php?topic_id=7" target="_blank"><img width="967" height="52" alt="topad" src="themes/365chi/images/green/index/small_index_7.gif"></a></div>
</div>
-->
<?php echo $this->fetch('library/page_header.lbi'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery-ui-1.8.18.custom.min.js')); ?>


<div class="main">
    <?php echo $this->fetch('library/category_tree.lbi'); ?>
    <?php echo $this->fetch('library/index_ad.lbi'); ?>
    <div class="kuai_tuan fr">
        <?php echo $this->fetch('library/new_articles.lbi'); ?>
        <?php echo $this->fetch('library/index_tuan.lbi'); ?>
    </div>
 
</div>

<div class="hotsale"> 
         <?php echo $this->fetch('library/top10.lbi'); ?>
       
         <?php echo $this->fetch('library/index_hot_new.lbi'); ?> 
    
    </div>




  <?php echo $this->fetch('library/index_loop_cat.lbi'); ?>











<div class="foot">
     <?php echo $this->fetch('library/help.lbi'); ?>      
     <div  class="clear"></div>
     <?php echo $this->fetch('library/page_footer.lbi'); ?>
</div>

</body>

 
    
    
    

<script type="text/javascript">
var gmt_end_time = "<?php echo empty($this->_var['end_time']) ? '0' : $this->_var['end_time']; ?>";
var now_time = <?php echo $this->_var['now_time']; ?>;


onload = function()
{
  try
  {
    onload_leftTime();
  }
  catch (e)
  {}
}

   // alert("365商城�测试9月1日正式上线，在此之前的所有下单均无效,敬请用户不要支付，否则，由此产生的问题365商城将不承担任何责任");

      $(function() {
          
       
            //广告切换
            function imgad(f, b, a, e, c, d) {
                    var f = $(f);
                    var b = $(b);
                    f.hide();
                    b.hide();
                    b.slideDown(a);
                    setTimeout(function() {
                        b.slideUp(e, function() {
                            f.slideDown(c)
                        })
                    }, d)
            }
           // imgad('.js-slideS','.js-slideB', 1000, 1000, 1000, 5000);
           
           
          $("#slogans dl").each(function(){ 
                $(this).mouseover(function(){       
  
                    $(this).addClass("hover");
                });
                $(this).mouseout(function(){       
                  //  $("#CartDiv").hide();

                    $(this).removeClass("hover");
                });
         });
         
         
    });

</script>
   <script type="text/javascript">
    
            $(function(){
                    $('#slides').slides({
                            preload: true,
                            generatePagination: true,
                            preloadImage: 'themes/365chi/images/green/slide/img/loading.gif',
                            play: 5000,
                            pause: 2500,
                            hoverPause: true				
                    });
            });
            $(".pic-grid-item").mouseover(function(){
                    var nodes = $(this.parentElement).find('.pic-grid-item');
                    len = nodes.length;
                    for(i=0;i<len;i++){
                            node = nodes[i];
                            if(node.id != this.id){
                                    //$(node).find(".maskLayer")[0].style.display = '';
                                    $(node).find(".maskLayer").show();
                            }else{
                                    //$(node).find(".maskLayer")[0].style.display = 'none';
                                    $(node).find(".maskLayer").hide();
                            } 
                    }


            });
            $(".slides_container").mouseout(function(){			
                    $(".pic-grid-item .maskLayer").hide();
            });
            var pic_idcounter = 0;
            $(".pic-grid-item .maskLayer").hide();
            $(".pic-grid-item").each(function(){
                this.id = 'pic_' + pic_idcounter++;
            });
    
</script>
    
</html>
