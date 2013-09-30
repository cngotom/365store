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
.listform{
    display: block;
 
}
.exchange_fcolor_red{
    color: #CC3300;
    margin-top:20px;
    margin-bottom: 10px;
    text-align: center;
    font-weight: bolder;
}
 </style>
 <link href="js/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="js/style/validator.css" rel="stylesheet" type="text/css" />

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
    
    
    
    
  </div>
  

  
  <div class="AreaR">
    
    <?php echo $this->fetch('library/exchange_list.lbi'); ?>
    <?php echo $this->fetch('library/pages.lbi'); ?>
    
  </div>
  
</div>

<div class="blank5"></div>

<div class="foot">
     <?php echo $this->fetch('library/help.lbi'); ?>      
     <div  class="clear"></div>
     <?php echo $this->fetch('library/page_footer.lbi'); ?>
</div>

</body>
</html>
