<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
<link href="js/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="js/style/validator.css" rel="stylesheet" type="text/css" />
 
 <style>
 .AreaR {
    width: 786px;}
 .AreaL {
    width: 206px;}
 #list_menu {
    width: 206px;}
 #list_menu ul li {
    float: left;
    width: 206px;}
 #list_menu .main_cate {
      background-position:180px;
    width:190px;}
 #cate_list span {
         width:71px;}
 .itemSearchResult ul li, .itemSearchResultT ul li {
    width: 186px; padding-left:4px;padding-right:4px;}
 
 #list_menu .selected .main_cate {
    background-position:180px;}
 .itemSearchResult{
     margin-top: 5px;
 }
 .itemSearchResult ul li a.title, .itemSearchResultT ul li a.title {
    line-height: 35px;
}

 </style>
<?php if ($this->_var['cat_style']): ?>
<link href="<?php echo $this->_var['cat_style']; ?>" rel="stylesheet" type="text/css" />
<?php endif; ?>

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>


</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>

<div class="block box">
 <div id="ur_here">
  <?php echo $this->fetch('library/ur_here.lbi'); ?>
 </div>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'formValidator-4.0.1.min.js,formValidatorRegex.js,validdata.js,transport.js')); ?>



<div class="blank"></div>
<div class="wrap clearfix">
  
  <div class="AreaL">
    
<?php echo $this->fetch('library/category_tree.lbi'); ?>
<?php echo $this->fetch('library/history.lbi'); ?>
<?php echo $this->fetch('library/top10.lbi'); ?>



    
  </div>
  
  
  <div class="AreaR">
      
      <?php if ($this->_var['head_ad_id']): ?>
                <?php if ($this->_var['head_ad_id'] < 9): ?>
      <div style="margin-bottom:10px;width:760px;height:2">
          <IMG src="<?php echo NGINX_IMG_HOST; ?>themes/365chi/images/green/top_<?php echo $this->_var['head_ad_id']; ?>.jpg" />
          <!--   <script type="text/javascript" src="affiche.php?act=js&type=0&ad_id={head_ad_id}"></script> -->
      </div>
               <?php endif; ?>

      
      <?php endif; ?>
      
	 
	  <?php if ($this->_var['brands']['1'] || $this->_var['price_grade']['1'] || $this->_var['filter_attr_list']): ?>
          <div id="bodyRight" class="searchColMain">                                
            <div class="searchColMainItem searchResultOp">
                <?php if ($this->_var['brands']['1']): ?>
                <dl>
                    <dt><?php echo $this->_var['lang']['brand']; ?>：</dt>
                    <dd> 
                        <span class="selection" id="FacetBrands"> 
                            <?php $_from = $this->_var['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?>
					<?php if ($this->_var['brand']['selected']): ?>
					<a class="cur"><?php echo $this->_var['brand']['brand_name']; ?></a>
					<?php else: ?>
					<a href="<?php echo $this->_var['brand']['url']; ?>"><?php echo $this->_var['brand']['brand_name']; ?></a>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </span>
                    </dd>
                </dl>
                <?php endif; ?>
                <?php if ($this->_var['price_grade']['1']): ?>        
                <dl>
                    <dt><?php echo $this->_var['lang']['price']; ?>：</dt>
                    <dd>       
                        <span class="selection"> 
                            	<?php $_from = $this->_var['price_grade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'grade');if (count($_from)):
    foreach ($_from AS $this->_var['grade']):
?>
				<?php if ($this->_var['grade']['selected']): ?>
				<a class="cur"><?php echo $this->_var['grade']['price_range']; ?></a>
				<?php else: ?>
				<a href="<?php echo $this->_var['grade']['url']; ?>"><?php echo $this->_var['grade']['price_range']; ?>&nbsp;</a>
				<?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>           
                        </span> 
                        <!--
                        <span class="enterPrice" >
                            <input type="text" id="searchPriceRangeMin" value="" maxlength="8">-<input type="text" id="searchPriceRangeMax" value="" maxlength="8"><a href="javascript:void(0);">确定</a>
                        </span>
                        -->
                    </dd>
                </dl>       
                <?php endif; ?>    
       

   
      	<?php $_from = $this->_var['filter_attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'filter_attr_0_32937700_1373467657');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['filter_attr_0_32937700_1373467657']):
        $this->_foreach['foo']['iteration']++;
?>
                <dl >
                    <dt><?php echo htmlspecialchars($this->_var['filter_attr_0_32937700_1373467657']['filter_attr_name']); ?> :</dt>
                    <dd>       
                        <span class="selection"> 
                           <?php $_from = $this->_var['filter_attr_0_32937700_1373467657']['attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attr');if (count($_from)):
    foreach ($_from AS $this->_var['attr']):
?>
				<?php if ($this->_var['attr']['selected']): ?>
				<a class="cur"><?php echo $this->_var['attr']['attr_value']; ?></a>
				<?php else: ?>
				<a href="<?php echo $this->_var['attr']['url']; ?>"><?php echo $this->_var['attr']['attr_value']; ?></a>&nbsp;
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
                        </span> 
                    </dd>
                </dl>       
           <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

            </div>
        </div>
          

		<div class="blank5"></div>
	  <?php endif; ?>
	 
   
<?php echo $this->fetch('library/goods_list.lbi'); ?>
<?php echo $this->fetch('library/pages.lbi'); ?>



  </div>  
  
</div>
<div class="blank5"></div>


<div class="foot">
     <?php echo $this->fetch('library/help.lbi'); ?>      
     <div  class="clear"></div>
     <?php echo $this->fetch('library/page_footer.lbi'); ?>
</div>




<div id="pic_layer" style="display:none;position: absolute" onmouseout="this.style.display='none';" onmouseover="this.style.display=''">
    <div id="layer_content">
        
    </div>
</div>
</body>
</html>
