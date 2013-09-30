<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define('IN_ECS', true);

require(ROOT_PATH . '/includes/init.php');
require_once(ROOT_PATH . 'languages/' .$_CFG['lang']. '/user.php');
include_once(ROOT_PATH . 'includes/lib_clips.php');
include_once(ROOT_PATH . 'includes/lib_order.php');

define(XINFUKA_PAY_ID,5);
define(CAPAIGN_PRFIX,'10365');

//支付1元
$amount = 1;

$user_id = GLogin::id();
if(!$user_id)
{
     show_message('请您先登录');   
}

/* 变量初始化 */
$surplus = array(
        'user_id'      => $user_id,
        'rec_id'       => 0,
        'process_type' => 0, //储存
        'payment_id'   => XINFUKA_PAY_ID,
        'user_note'    => '芳临豆乳秒杀活动',
        'amount'       => $amount
);


/* 如果是会员预付款，跳转到下一步，进行线上支付的操作 */

include_once(ROOT_PATH .'includes/lib_payment.php');

//获取支付方式名称
$payment_info = array();
$payment_info = payment_info($surplus['payment_id']);

$surplus['payment'] = $payment_info['pay_name'];
//插入会员账目明细
$surplus['rec_id'] = insert_user_account($surplus, $amount);

//取得支付信息，生成支付代码
$payment = unserialize_config($payment_info['pay_config']);

//生成伪订单号, 不足的时候补0
$order = array();
$order['order_sn']       = $surplus['rec_id'];
$order['user_name']      = GLogin::name();
$order['surplus_amount'] = $amount;

//计算支付手续费用
$payment_info['pay_fee'] = pay_fee($surplus['payment_id'], $order['surplus_amount'], 0);

//计算此次预付款需要支付的总金额
$order['order_amount']   = $amount ; // + $payment_info['pay_fee'];

//记录支付log
$order['log_id'] = insert_pay_log($surplus['rec_id'], $order['order_amount'], $type=PAY_SURPLUS, 0);


//记录活动情况
$temp_douru  = array(
    'user_id' =>Glogin::id(),
    'log_id' =>$order['log_id'] ,
    'ip'=> $_SERVER["REMOTE_ADDR"],
    'time'=> time()
);
$db->autoExecute($ecs->table('temp_douru'),$temp_douru);




/* 调用相应的支付方式文件 */
include_once(ROOT_PATH . 'includes/modules/payment/' . $payment_info['pay_code'] . '.php');

/* 取得在线支付方式的支付按钮 */
$pay_obj = new $payment_info['pay_code'];

$order['order_sn'] =   intval( CAPAIGN_PRFIX.$surplus['rec_id']);

$payment_info = $pay_obj->get_code($order, $payment);
$order['pay_desc']  = '您正在参加芳临豆乳1元秒杀活动，正在跳转支付界面，请稍后';

/* 模板赋值 */
 $smarty->assign('helps',      get_shop_help());        // 网店帮助
$smarty->assign('payment', $payment_info);
$smarty->assign('order',   $order);
$smarty->display('campaign_pay.dwt');


?>
