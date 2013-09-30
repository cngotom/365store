




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['topic']['title']; ?>_<?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="/themes/365chi/index.css" rel="stylesheet" type="text/css" />
<link href="js/jquery-ui.css" rel="stylesheet" type="text/css" />
<?php if ($this->_var['topic']['css'] != ''): ?>
<style type="text/css">
  <?php echo $this->_var['topic']['css']; ?>
</style>
<?php endif; ?>
<style type="text/css">
img{border:none;}
.sl_common{
    width:1000px;
	margin:0 auto;
}

</style>


<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'formValidator-4.0.1.min.js,formValidatorRegex.js,validdata.js,transport.js,helper.js')); ?>
<div class="blank"></div>




<div class="sl_common">
    <img src="themes/365chi/topic/images/newyear/sl_1.gif"  />
    
</div>
<div class="sl_common">
    <img src="themes/365chi/topic/images/newyear/sl_2.gif" usemap="#sl2" />
    <map name="sl2" id="sl2">
       <area shape="rect" coords="25,223,254,481" href ="http://www.365store.cn/goods.php?id=56250" target='_blank' alt="天福号年夜饭" />
       <area shape="rect" coords="266,223,495,481" href ="http://www.365store.cn/goods.php?id=56249" target='_blank' alt="天福号老北京过年" />
       <area shape="rect" coords="506,223,735,481" href ="http://www.365store.cn/goods.php?id=56247" target='_blank' alt="天福号新春福礼" />
       <area shape="rect" coords="743,223,972,481" href ="http://www.365store.cn/goods.php?id=56248" target='_blank' alt="天福号天官赐福" />
    </map>
    
</div>
<div class="sl_common">
    <img src="themes/365chi/topic/images/newyear/sl_3.gif" usemap="#sl3" />
     <map name="sl3" id="sl3">
       <area shape="rect" coords="264,223,495,482" href ="http://www.365store.cn/goods.php?id=56038" target='_blank' alt="北大荒芳临豆乳无糖" />
       <area shape="rect" coords="504,223,735,482" href ="http://www.365store.cn/goods.php?id=1549" target='_blank' alt="北大荒芹菜籽粉" />
       <area shape="rect" coords="741,223,972,482" href ="http://www.365store.cn/goods.php?id=1520" target='_blank' alt="龙王无糖豆浆粉" />
       
    </map>
</div>
<div class="sl_common">
    <img src="themes/365chi/topic/images/newyear/sl_4.gif" usemap="#sl4" />
    <map name="sl4" id="sl4">
       <area shape="rect" coords="110,250,340,500" href ="http://www.365store.cn/goods.php?id=1578" target='_blank' alt="北大荒颐寿春礼盒" />
       <area shape="rect" coords="440,250,660,500" href ="http://www.365store.cn/goods.php?id=1081" target='_blank' alt="北大荒稻花香大米" />
       <area shape="rect" coords="741,250,972,500" href ="http://www.365store.cn/goods.php?id=56067" target='_blank' alt="益者有机金丝小枣" />
       
    </map>
</div>
<div class="sl_common">
    <img src="themes/365chi/topic/images/newyear/sl_5.jpg" usemap="#sl5"  />
    <map name="sl5" id="sl5">
       <area shape="rect" coords="264,255,495,512" href ="http://www.365store.cn/goods.php?id=56256" target='_blank' alt="天锦有机山珍大礼包" />
       <area shape="rect" coords="504,255,735,512" href ="http://www.365store.cn/goods.php?id=56255" target='_blank' alt="天锦有机吉祥四宝" />
       <area shape="rect" coords="741,255,972,512" href ="http://www.365store.cn/goods.php?id=56257" target='_blank' alt="天锦1号有机山珍礼盒" />
       
    </map>
</div>











<div class="foot">
     <?php echo $this->fetch('library/help.lbi'); ?>      
     <div  class="clear"></div>
     <?php echo $this->fetch('library/page_footer.lbi'); ?>
</div>

</body>

</html>
