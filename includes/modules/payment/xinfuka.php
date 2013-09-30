<?php

/**
 * ECSHOP 支付宝插件
 * ============================================================================
 * 版权所有 2005-2011 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: xinfuka.php 17217 2011-01-19 06:29:08Z liubo $
 */
define('IN_ECS', true);

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

$payment_lang = ROOT_PATH . 'languages/' .$GLOBALS['_CFG']['lang']. '/payment/xinfuka.php';

if (file_exists($payment_lang))
{
    global $_LANG;

    include_once($payment_lang);
}

/* 模块的基本信息 */
if (isset($set_modules) && $set_modules == TRUE)
{
    $i = isset($modules) ? count($modules) : 0;

    /* 代码 */
    $modules[$i]['code']    = basename(__FILE__, '.php');

    /* 描述对应的语言项 */
    $modules[$i]['desc']    = 'xinfuka_desc';

    /* 是否支持货到付款 */
    $modules[$i]['is_cod']  = '0';

    /* 是否支持在线支付 */
    $modules[$i]['is_online']  = '1';

    /* 作者 */
    $modules[$i]['author']  = '365';

    /* 网址 */
    $modules[$i]['website'] = 'http://www.xinfuka.com';

    /* 版本号 */
    $modules[$i]['version'] = '1.0.0';

    /* 配置信息 */
    $modules[$i]['config']  = array(
        array('name' => 'xinfuka_account',           'type' => 'text',   'value' => ''),
        array('name' => 'xinfuka_key',               'type' => 'text',   'value' => ''),
        array('name' => 'xinfuka_partner',           'type' => 'text',   'value' => ''),
//        array('name' => 'xinfuka_real_method',       'type' => 'select', 'value' => '0'),
//        array('name' => 'xinfuka_virtual_method',    'type' => 'select', 'value' => '0'),
//        array('name' => 'is_instant',               'type' => 'select', 'value' => '0')
        array('name' => 'xinfuka_pay_method',        'type' => 'select', 'value' => '')
    );

    return;
}
define(CAPAIGN_PRFIX,'10365');
/**
 * 类
 */
class xinfuka
{

    /**
     * 构造函数
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function xinfuka()
    {
    }

    function __construct()
    {
        $this->xinfuka();
    }

    /**
     * 生成支付代码
     * @param   array   $order      订单信息
     * @param   array   $payment    支付方式信息
     */
    function get_code($order, $payment,$is_button=false)
    {
        if (!defined('EC_CHARSET'))
        {
            $charset = 'utf-8';
        }
        else
        {
            $charset = EC_CHARSET;
        }
//        if (empty($payment['is_instant']))
//        {
//            /* 未开通即时到帐 */
//            $service = 'trade_create_by_buyer';
//        }
//        else
//        {
//            if (!empty($order['order_id']))
//            {
//                /* 检查订单是否全部为虚拟商品 */
//                $sql = "SELECT COUNT(*) FROM " .$GLOBALS['ecs']->table('order_goods').
//                        " WHERE is_real=1 AND order_id='$order[order_id]'";
//
//                if ($GLOBALS['db']->getOne($sql) > 0)
//                {
//                    /* 订单中存在实体商品 */
//                    $service =  (!empty($payment['xinfuka_real_method']) && $payment['xinfuka_real_method'] == 1) ?
//                        'create_direct_pay_by_user' : 'trade_create_by_buyer';
//                }
//                else
//                {
//                    /* 订单中全部为虚拟商品 */
//                    $service = (!empty($payment['xinfuka_virtual_method']) && $payment['xinfuka_virtual_method'] == 1) ?
//                        'create_direct_pay_by_user' : 'create_digital_goods_trade_p';
//                }
//            }
//            else
//            {
//                /* 非订单方式，按照虚拟商品处理 */
//                $service = (!empty($payment['xinfuka_virtual_method']) && $payment['xinfuka_virtual_method'] == 1) ?
//                    'create_direct_pay_by_user' : 'create_digital_goods_trade_p';
//            }
//        }

       

        $parameter = array(
            //'partner'           => ALIPAY_ID,
            'url'        => return_url(basename(__FILE__, '.php')),
            /* 业务参数 */
            'merId'             =>'1000000003',
            'orderId'           => $order['order_sn'],
            'amount'             => intval( round($order['order_amount']  * 100)),
        );

        ksort($parameter);
        reset($parameter);

        $param = '';
        $sign  = '';

        foreach ($parameter AS $key => $val)
        {
            $param .= "$key=" .urlencode($val). "&";
            $sign  .= "$key=$val&";
        }

        $param = substr($param, 0, -1);
        $signkey = '808799BFEB4A';
        $sign= $parameter['merId'].$parameter['orderId'].$parameter['amount'].$signkey;
        //$sign  = substr($sign, 0, -1). ALIPAY_AUTH;
        
        
        //记录用户准备支付
        $message =  $order['order_sn'].":  amount:".$parameter['amount']." method : xinfuka";
        GLog::log("payment_topay", $message);
        $code ='https://member.xinfuka.net/payment/MerchantPayment.aspx?'.$param. '&mac='.md5($sign);
//        $button = '<div style="text-align:center"><input type="button" onclick="window.open(\'https://www.xinfuka.com/cooperate/gateway.do?'.$param. '&sign='.md5($sign).'&sign_type=MD5\')" value="' .$GLOBALS['_LANG']['pay_button']. '" /></div>';
        $code = '<script> location.href= "' . $code . '"</script>';
        if($is_button)
        {
            $code = '<div style="text-align:center"><input type="button" onclick="window.open(\'https://member.xinfuka.net/payment/MerchantPayment.aspx?'.$param. '&mac='.md5($sign).'\');" value="'."立即使用薪福卡支付". '" /></div>';
        }
        
        return $code;
    }

    /**
     * 响应操作
     */
    function respond()
    {
        
        $message = print_r($_GET,true);
        GLog::log("payment_callback", $message);
        $signkey = '808799BFEB4A';
        $type = $_GET['type'];
        $merID = $_GET['merId'];
        $orderID = $_GET['orderId'];
        $amount = intval($_GET['amount']);
        $transID = $_GET['tranId'];
        $status = $_GET['trade_status'];
        $mac = $_GET['mac'];
        $payment  = get_payment($_GET['code']);
        
        
        //活动充值
        if(  strpos($orderID,CAPAIGN_PRFIX) !== false )
        {
              $recId = str_replace(CAPAIGN_PRFIX, '', $orderID);
              $order_log_id = get_order_id_by_sn($recId,true);
        }
        else
            $order_log_id = get_order_id_by_sn($orderID);
        
        if(  'true' == $status)
        {
        /* 检查支付的金额是否相符 */

            if (!check_money( intval($order_log_id), $amount / 100.0))
            {
                $message =  "Xinfuka:money in $orderID does not match $amount".print_r($_GET,true);
                GLog::log("payment_callback", $message);
                return false;
            }
  
            $key = md5($merID.$orderID.$amount.$transID.$signkey);
            if($key == $mac)
            {
                $message = "Xinfuka: Pay success orderId:$orderID amount:$amount".print_r($_GET,true);
                GLog::log("payment_callback", $message);
                
                order_paid($order_log_id, 2,$_GET['cardNo']);
                return true;
            }
            else{
                $message = "Xinfuka: Pay failed because key not right".print_r($_GET,true);
                GLog::log("payment_callback", $message);
                return false;
            }

        }
        else
        {
            $message = "Xinfuka: status not ok ".print_r($_GET,true);
          //  echo $message;
            GLog::log("payment_callback", $message);
            return false;
        }

       return false;
    }
}

?>
