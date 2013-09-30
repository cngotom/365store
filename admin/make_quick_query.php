<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
mb_internal_encoding("UTF-8");
define('IN_ECS', true);
require('includes/init_1.php');
require('../includes/lib_pinyin.php');

$is_insert = false;
$ext_where = '';

//插入模式
if($is_insert)
{
    $sql = "select max(goods_id) from ".$ecs->table('quick_query');
    $max_id = $db->getOne($sql);
   
    $ext_where = ' and goods_id > '.$max_id;
    
}
#读出所有上线产品的 id 和名称
$sql = "select goods_id,goods_name from ".$ecs->table('goods') ." where is_on_sale =1 ".$ext_where;
    
$goods_list = $db->getAll($sql);

$results = array();
$index = 0;
foreach($goods_list as $row)
{
    $goods = array();
    $goods['goods_id'] = $row['goods_id'];
    $goods['goods_name']  = addslashes($row['goods_name']);
  
    $simple_pinyin = "";
    for($i=0; $i<  mb_strlen($goods['goods_name']); $i++) {
        $tcChar = mb_substr($goods['goods_name'], $i, 1);
        $simple_pinyin  .= substr(Pinyin($tcChar,'UTF8'),0,1);
    }
    $simple_pinyin = preg_replace("/[^a-z0-9A-Z]*/", '', $simple_pinyin);
    $goods['simple_pinyin'] = $simple_pinyin;
    
    
    $goods['full_pinyin'] = Pinyin($goods['goods_name'],'UTF8');
    
    
    $db->autoExecute($ecs->table('quick_query'), $goods, 'INSERT');
   # echo $goods['goods_name'];
    $index += 1;
     if($index % 100 == 0)
     {
        echo $index."\n";
        flush();
     }
}



?>
