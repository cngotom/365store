<?php

define('ROOT_PATH', str_replace('\\', '/', dirname ( __FILE__ )."/"));
define('BIN_PATH', ROOT_PATH.'bin/');
define('GLIB_PATH', ROOT_PATH.'bin/GComLib/');
define('VIEW_PATH', ROOT_PATH.'bin/view/');

require(ROOT_PATH.'/yii.php');
date_default_timezone_set('PRC');

//是否动静分离
//和图片路径相关的地方
// lib_common get_image_path 影响列表页 首页 详情页 商品图
// index.dwt 影响首页广告图
// catagory.dwt 影响一级分类也广告图
define("IS_IMAGE_ALONE",true);
if(IS_IMAGE_ALONE)
{
    //ngnix 服务器地址
    define("NGINX_IMG_HOST","http://img.365chi.net:8080/");
    
}
else
{
    define("NGINX_IMG_HOST","");
}
//设置顶异常记录
function gException($exception)
{
  GLog::log("global_exception", $exception->getMessage());
  Header("Location:/");
}
set_exception_handler('gException');


function auto_load($classname)
{
    $config = array(  
    	"GLog"  =>   GLIB_PATH . "/GLog.class.php" ,
    	"GLogin" => GLIB_PATH . "/GLogin.class.php");    
    if(isset($config[$classname]))
         require ( $config[$classname]);
    
}
include GLIB_PATH . "core/GApplication.class.php";


$g_includePage = "";
GRouter::beginRequest ();
if(GRouter::route () != GRouter::URLMODE_REWRITE)
{
     $g_includePage  = GRouter::route();
     if($g_includePage !== 1 && file_exists($g_includePage))
     {
        define('G_PHP_SELF', $g_includePage);
        
    
	include $g_includePage;
        

     }
     else{
        throw new Exception($g_includePage. " nont exists");
     }
}


GRouter::endRequest ();

//读取配置： GApp::C("Debug");



