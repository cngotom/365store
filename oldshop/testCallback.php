<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testCallback
 *
 * @author Administrator
 */

define('IN_ECS', true);
require (ROOT_PATH."includes/init.php");

$message = print_r($_GET,true);
GLog::log("payment_callback", $message);

$signkey = '808799BFEB4A';

$type = $_GET['type'];
$merID = $_GET['merId'];
$orderID = $_GET['orderId'];
$amount = $_GET['amount'];
$transID = $_GET['tranId'];
$status = $_GET['trade_status'];
$mac = $_GET['mac'];

if(  'true' == $status)
{
    $key = md5($merID.$orderID.$amount.$transID.$signkey);
    if($key == $mac)
    {
        $message = "Pay success orderId:$orderID amount:$amount";
        echo $message;
        GLog::log("payment_callback", $message);
    }
    else{
        $message = "Pay failed ";
         echo $message;
        GLog::log("payment_callback", $message);
    }
    
}
else
{
    $message = "status not ok ";
    echo $message;
    GLog::log("payment_callback", $message);
}

?>
