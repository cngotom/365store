<?php
error_reporting(E_ALL^E_NOTICE);
$time = $_SERVER['REQUEST_TIME'];
$ip = $_SERVER['REMOTE_ADDR'];
$query = $_SERVER['QUERY_STRING'];
$agent = $_SERVER['HTTP_USER_AGENT'];
$refer = $_SERVER['HTTP_REFERER'];

$message = "$time\t$query\t$refer\t$agent";

GLog::log('juhuasuan',$message);
Header('Location:http://ju.taobao.com/tg/life_home.htm?spm=608.1000525.11000.2.38a389&item_id=20364632223');
?>
