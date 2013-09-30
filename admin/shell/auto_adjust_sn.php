<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

die("No rights");

define('IN_ECS', true);
require('../includes/init.php');
include_once(ROOT_PATH . 'admin/includes/lib_goods.php');


$_REQUEST['page_size'] = 500;
$goods_list = goods_list(false);
foreach($goods_list['goods'] as $goods)
{
    $goods_id =  $goods['goods_id'] ;
    $goods_sn = $GLOBALS['_CFG']['sn_prefix'] . str_repeat('0', 6 - strlen($goods_id)) . $goods_id;
    update_goods($goods_id,'goods_sn',$goods_sn);
  //  echo $goods_id." ,$goods_sn\n";
}





exit();
//update_goods


?>
