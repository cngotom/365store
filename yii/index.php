<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yiiframework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

defined('NGINX_IMG_HOST') or define('NGINX_IMG_HOST','http://img.365chi.net:8080/');

defined('ROOT_PATH') or define('ROOT_PATH', str_replace('/yii', '',  str_replace('\\', '/', dirname(__FILE__))));




require_once($yii);
Yii::createWebApplication($config)->run();
