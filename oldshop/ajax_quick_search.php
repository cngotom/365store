<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define('IN_ECS', true);
require(ROOT_PATH . '/includes/init.php');
$q = strtolower($_GET["q"]);

$sql = "select goods_name from ".$ecs->table('quick_query')." where goods_name like '%$q%' or  simple_pinyin like '$q%' or full_pinyin like '$q%'  limit 0,10" ;
$res = array();

$list = $db->getAll($sql);  
foreach($list as $l)
{
   #echo $l['goods_name'];;
    $res[] = $l['goods_name'];
    
    echo $l['goods_name']."\n";
}



#echo json_encode($res);

?>
