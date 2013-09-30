    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/index.css" rel="stylesheet" type="text/css" />
    <!--Search begin -->
    <div class="search">
        <div id="searchbox">
            <form id="search_form" accept-charset="UTF-8" method="get" action="<?php echo $this->createUrl('category/search');?>">
                            <input type="hidden"  value="category/search" name="r" />
            <input type="text" autocomplete="off" maxlength="38" value="" id="search_input" class="inputsearh"
                name="keyWord" />
            <input type="submit" value="搜索" class="aclose" />
            </form>
        </div>
	</div>
    <!--Search end -->
    
    <!--Notice begin -->

    <!--Notice end -->
    
    
    <!--Notice begin -->
    <div id="Hot_IndexSlider" style="display: none">
        <div class="z-slide">
            <div class="list" style="left: 0px;">
                <ul class="wrap" style="width: 930px; left: -620px;">
                        <li class=" " style="left: 0px;"><a href="http://t.moonbasa.com//Home/free/?guid=e7da913f6d0d49f79d42436b351ed0a7">
                            <img width="310" height="155" alt="" src="http://i2.mbscss.com/img/moonbasa/2012/appbig/121127x/i4/topic/121127_topic_zhongj.jpg"></a></li>
                        <li class=" "><a href="/zt/topic/444?cn=17252&amp;type=1&amp;adsiteid=10000032&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">
                            <img width="310" height="155" alt="" src="http://i2.mbscss.com/img/moonbasa/2012/appbig/121126x/i4/topic/121126_topic_dayi.jpg"></a></li>
                        <li class="  cur"><a href="/home/miaoshaOnlyMobile/?only=0&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">
                            <img width="310" height="155" alt="" src="http://i2.mbscss.com/img/moonbasa/2012/appbig/121120_miao/i4/121120_miao.jpg"></a></li>
                </ul>
            </div>
            <div class="trigs">
                <ul><li>1</li><li>2</li><li class="cur">3</li></ul>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $('#Hot_IndexSlider').slideLayer({ wrapEl: '.z-slide .list', slideEl: '.z-slide .list .wrap', childEl: '.z-slide .list li', counter: '.z-slide .trigs' });
</script>
    <!--Notice end -->
    
    <!--
    <div class="in-entry-cont" >
    <a href="/Member/NoArrivalOrderList/?guid=e7da913f6d0d49f79d42436b351ed0a7"><img width="70" height="70" src="http://i2.mbscss.com/img/moonbasa/2012/appbig/ico_wlcx2.png"><span>物流查询</span></a>
    <a href="/Home/SignIn/?guid=e7da913f6d0d49f79d42436b351ed0a7"><img width="70" height="70" src="http://i2.mbscss.com/img/moonbasa/2012/appbig/ico_qd2.png"><span>签到有礼</span></a>
    <a href="/Member/MyFavorite/?guid=e7da913f6d0d49f79d42436b351ed0a7"><img width="70" height="70" src="http://i2.mbscss.com/img/moonbasa/2012/appbig/ico_sc2.png"><span>我的收藏</span></a>
    <a href="/home/miaoshaOnlyMobile/?only=0&amp;guid=e7da913f6d0d49f79d42436b351ed0a7"><img width="70" height="70" src="http://i2.mbscss.com/img/moonbasa/2012/appbig/ico_ms2.png"><span>限时团购</span></a>
    </div>
    
    
    
    <div style="margin-top:5px;" class="p-tj">
        <div class="list_tag">
            <a class="hot" href="/Home/MiaoShaOnlyMobile/?only=1&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">秋季新品</a>
            <a href="/Search/ProductSearch/?supercategory=003&amp;keyword=毛衫&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">毛衫</a>
            <a href="/Search/ProductSearch/?supercategory=003&amp;keyword=外套&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">外套</a>
            <a href="/Search/ProductSearch/?keyword=打底衫&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">打底衣</a>
            <a href="/Search/ProductSearch/?supercategory=003&amp;keyword=西装&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">小西装</a>
        </div>
    </div>
    
       
    <div class="clear"></div>    -->

    <!-- first category begin -->
    
    <div class="p-tj">
    <div class="htit">
        <a href="<?php echo $this->createUrl('category/',array("id"=>$first_cat_id));?>">米面杂粮 <span>健康生活必备</span></a></div>
    <div class="htit_zt">
        <a href="<?php echo $this->createUrl('category/',array("id"=>$first_cat_id));?>">
            <img width="200" height="100" src="http://i2.mbscss.com/img/moonbasa/2012/appbig/121127x/i4/topic/121127_topic_yurong.jpg" alt=""></a></div>
    <div class="list_tag-b">
          <?php foreach($first_children_cat as $cat):?>
                   <a href="<?php echo $this->createUrl('category/',array("id"=>$cat->cat_id));?>"><?php echo $cat->cat_name ?></a>
           <?php endforeach?>
        </div>
        <!--
<div class="list_tag">
            <a class="hot" href="/Search/ProductSearch/?supercategory=003&amp;keyword=开衫&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">开衫</a>
            <a href="/Search/ProductSearch/?supercategory=003&amp;keyword=衬衫&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">衬衫</a>
            <a class="hot" href="/Search/ProductSearch/?supercategory=003&amp;keyword=西装&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">小西装</a>
            <a href="/Search/ProductSearch/?supercategory=003&amp;keyword=外套&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">外套</a>
            <a href="/Search/ProductSearch/?supercategory=003&amp;keyword=毛衣&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">毛衣</a>
            <a href="/Search/ProductSearch/?supercategory=003&amp;keyword=吊带&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">吊带</a>
            <a href="/Search/ProductSearch/?supercategory=003&amp;keyword=哈伦裤&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">哈伦裤</a>
            <a href="/Search/ProductSearch/?supercategory=003&amp;keyword=牛仔裤&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">牛仔裤</a>
            <a class="hot" href="/Search/ProductSearch/?supercategory=003&amp;keyword=连衣裙&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">连衣裙</a>
            <a href="/Search/ProductSearch/?supercategory=003&amp;keyword=半裙&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">半裙</a>
            <a href="/Search/ProductSearch/?supercategory=003&amp;keyword=长裙&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">长裙</a>
        </div>
</div>
    <!-- first category end -->
    
    
 
  
    
    
    <!--third category end -->    
        <div class="clear"></div>
    
    
    
    <!--categories begin -->
    
    <div class="p-tj">

        <?php 
            $top_categories_color = array(
            '#b0968b','#beae91','#7bb1b1','#9f88ad','#757580','#cccccc'
             );
            $index = 1 ;
            foreach( $top_categories as $cat):
        ?>
             
            <div style="background:  <?php echo $top_categories_color[$index-1] ?>;  <?php if ($index % 3 == 2) echo "width:95px; margin: 0 1px 2px 0;";else echo "width:90px;margin: 0 1px 2px 0;" ?>  " class="htit">
                <a href="<?php echo $this->createUrl('category/',array("id"=>$cat->cat_id));?>"> <?php echo $cat->cat_name ?></a></div>
        <?php 
            $index += 1;     
            endforeach
        ?>
        

    <div style="background: #cccccc; width: 90px; margin: 0 0 2px 0; font-size: 20px;
        color: #333" class="htit">
        <a href="<?php echo $this->createUrl('category/allList');?>">分类<span>全部商品分类</span></a></div>
</div>
    
    <!--categories end -->
    
    
    
    
    
    <!--
    <div class="app_list">
        <a href="http://itunes.apple.com/cn/app/moonbasa/id515799978?mt=8&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">iPhone客户端</a>
        <a href="http://static.moonbasa.com/m/moonbasa_wap.apk?guid=e7da913f6d0d49f79d42436b351ed0a7">Android客户端</a>
    </div>
    -->