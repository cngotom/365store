<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>365绿色商城触屏版</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/header.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/header_s.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tbmtouch.js"></script>
</head>
<body>
<div class="fullscreen">
    <!--header begin -->
    <div class="header" >
        <div class="logo"><a href="/?f=t&guid=e7da913f6d0d49f79d42436b351ed0a7"><img src="images/logo.gif" width="110" height="39" style="display:block;" alt=""/></a></div>
        <div class="common-tab">
            <ul>
                <li><a href="<?php echo $this->createUrl('category/allList'); ?>">分类</a></li>
                <li><a href="<?php echo $this->createUrl('cart/index'); ?>">购物车(<span class="red"><?php echo Cart::getCartGoodsNum();?></span>)</a></li>
                <li><a href="<?php echo $this->createUrl('user/center'); ?>">我的365</a></li>
            </ul>
        </div>
    </div>
     <!--header end -->
      <div class="clear"></div>
     
	<?php echo $content; ?>
     
     
    <div class="clear"></div>
    
    <div class="footer">
        <?php if( Yii::app()->user->isGuest ) {?>
            <div style="background:#f5f5f5;"><a href="<?php echo $this->createUrl('user/index'); ?>" rel="nofollow">登录</a> | <a href="<?php echo $this->createUrl('user/register'); ?>" rel="nofollow">注册</a></div>
       <?php } else{ ?>
            <div style="background:#f5f5f5;"> <a href="<?php echo $this->createUrl('user/center'); ?>" > <?php echo Yii::app()->user->user_name;?> </a> &nbsp; <a href="<?php echo $this->createUrl('user/logout'); ?>" rel="nofollow">退出</a></div>

       <?php }?>

        <div class="gray"><a href="http://www.365store.cn/?a=force">普通版</a> | <a href="http://www.365store.cn/help.php">使用帮助</a> | <a href="http://www.365store.cn/help.php">使用反馈</a><br> 京ICP备12016225(1/3)号</div>
    </div>


    
</div>    



</body>

</html>