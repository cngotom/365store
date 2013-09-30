<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define('IN_ECS', true);
require('../includes/init_1.php');
include_once('../includes/lib_goods.php');
$sql = "select goods_id,seller_note from ".$ecs->table('goods');
$goods_list = $db->getAll($sql);
foreach($goods_list as $goods)
{
    
    $arr = array();
    $goods_id = $goods['goods_id'];
    if($goods['seller_note'])
    {
        $a = explode(';',$goods['seller_note']);
        $url = $a[0];
        $beg = strpos($url,"_");
        $cate =  intval(   substr($url, $beg + 1) );
        if($cate != 2)
        {
            $arr['is_on_sale'] = 0;
            $db->autoExecute($ecs->table('goods'), $arr, 'update',"goods_id = $goods_id");
        }
   
    }
}
?>
