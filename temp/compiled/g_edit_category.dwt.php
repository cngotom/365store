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
<?php if ($this->_var['cat_style']): ?>
<link href="<?php echo $this->_var['cat_style']; ?>" rel="stylesheet" type="text/css" />
<?php endif; ?>

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>

<link rel="stylesheet" href="/js/jquery-ui.css" type="text/css" media="all" />
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>

<div class="block box">
 <div id="ur_here">
  <?php echo $this->fetch('library/ur_here.lbi'); ?>
 </div>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'formValidator-4.0.1.min.js,formValidatorRegex.js,validdata.js,transport.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'uploadimage.js')); ?>



<div class="blank"></div>
<div class="wrap clearfix">
  
  <div class="AreaL">
    
<?php echo $this->fetch('library/category_tree.lbi'); ?>
<?php echo $this->fetch('library/history.lbi'); ?>
<?php echo $this->fetch('library/top10.lbi'); ?>



    
  </div>
  
  
  <div class="AreaR">
      
      <?php if ($this->_var['head_ad_id']): ?>
      <div style="margin-bottom:10px;">
          <script type="text/javascript" src="affiche.php?act=js&type=0&ad_id=<?php echo $this->_var['head_ad_id']; ?>"></script>
      </div>
     
      
      <?php endif; ?>
      
	 
	  <?php if ($this->_var['brands']['1'] || $this->_var['price_grade']['1'] || $this->_var['filter_attr_list']): ?>
          <div id="bodyRight" class="searchColMain fr">                                
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
       

   
      	<?php $_from = $this->_var['filter_attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'filter_attr_0_22128100_1354894249');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['filter_attr_0_22128100_1354894249']):
        $this->_foreach['foo']['iteration']++;
?>
                <dl >
                    <dt><?php echo htmlspecialchars($this->_var['filter_attr_0_22128100_1354894249']['filter_attr_name']); ?> :</dt>
                    <dd>       
                        <span class="selection"> 
                           <?php $_from = $this->_var['filter_attr_0_22128100_1354894249']['attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attr');if (count($_from)):
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

<div class="block">
  <div class="box">
   <div class="helpTitBg clearfix">
    <?php echo $this->fetch('library/help.lbi'); ?>
   </div>
  </div>  
</div>
<div class="blank"></div>


<?php if ($this->_var['img_links'] || $this->_var['txt_links']): ?>
<div id="bottomNav" class="box">
 <div class="box_1">
  <div class="links clearfix">
    <?php $_from = $this->_var['img_links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'link');if (count($_from)):
    foreach ($_from AS $this->_var['link']):
?>
    <a href="<?php echo $this->_var['link']['url']; ?>" target="_blank" title="<?php echo $this->_var['link']['name']; ?>"><img src="<?php echo $this->_var['link']['logo']; ?>" alt="<?php echo $this->_var['link']['name']; ?>" border="0" /></a>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php if ($this->_var['txt_links']): ?>
    <?php $_from = $this->_var['txt_links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'link');if (count($_from)):
    foreach ($_from AS $this->_var['link']):
?>
    [<a href="<?php echo $this->_var['link']['url']; ?>" target="_blank" title="<?php echo $this->_var['link']['name']; ?>"><?php echo $this->_var['link']['name']; ?></a>] 
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php endif; ?>
  </div>
 </div>
</div>
<?php endif; ?>

<div class="blank"></div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>

<div id="upload_dialog" title="上传并导出图片" class="upload_dialog"></div>


<script type="Text/Javascript" language="JavaScript">
<!--


 
function replaceURL(url){
	i=10;
	while(i--)
	url = url.replace("/","|");
	return url;
}
function filterID(id)
{
    return id.substr("goodsimg_".length);
}
function filterURL(url)
{
    return url.substr("/images/temp/F_".length);
}
UploadImg.callback_success = function(id,fileName){
	if(confirm("确定要保存修改到服务器么？\n"+id)){
		 $.getJSON("Goods/UpdateImage/"+filterID(id)+"/"+filterURL(fileName)+"/rnd"+Math.random(),function(result){
			    alert(result.msg);
		 });
	}else{		
		$("#"+id)[0].src=UploadImg.oldpic;
	}
}

//-->
</script>




<div id="pic_layer" style="display:none;position: absolute" onmouseout="this.style.display='none';" onmouseover="this.style.display=''">
    <div id="layer_content">
        
    </div>
</div>

</body>
</html>
