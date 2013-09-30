<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define('IN_ECS', true);
require(ROOT_PATH . '/includes/init.php');
include_once('includes/cls_json.php');
  
$order_sn = strtolower($_GET["order_sn"]);
$sql = "select shipping_id,invoice_no from ".$ecs->table('order_info')." where order_sn = '".$order_sn."'";
$res = $db->getRow($sql);
$result = array('code' => 0, 'message' => '');
$json  = new JSON;

if($res)
{
    
    $shipping_code = $GLOBALS['db']->GetOne("SELECT shipping_code FROM ".$GLOBALS['ecs']->table('shipping') ." WHERE shipping_id = '$res[shipping_id]'");
    $plugin = ROOT_PATH.'includes/modules/shipping/'. $shipping_code. '.php';
     if (file_exists($plugin))
    {
            include_once($plugin);
            $shipping = new $shipping_code;
            $result['message'] = $shipping->query($res['invoice_no']);
    }
    else{
        $result['code'] = 2;
        $result['message'] = "找不到配送信息";
    }
     
}
else{
    $result['code'] = 1;
    $result['message'] = "找不到该订单号";
    
 
}

die($json->encode($result));
#echo json_encode($res);

?>
