<?php

/**
 * ECSHOP 支付接口函数库
 * ============================================================================
 * 版权所有 2005-2010 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: yehuaixiao $
 * $Id: lib_payment.php 17218 2011-01-24 04:10:41Z yehuaixiao $
 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

/**
 * 取得返回信息地址
 * @param   string  $code   支付方式代码
 */
function return_url($code)
{
    return $GLOBALS['ecs']->url() . 'respond.php?code=' . $code;
}

/**
 *  取得某支付方式信息
 *  @param  string  $code   支付方式代码
 */
function get_payment($code)
{
    $sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('payment').
           " WHERE pay_code = '$code' AND enabled = '1'";
    $payment = $GLOBALS['db']->getRow($sql);

    if ($payment)
    {
        $config_list = unserialize($payment['pay_config']);

        foreach ($config_list AS $config)
        {
            $payment[$config['name']] = $config['value'];
        }
    }

    return $payment;
}

/**
 *  通过订单sn取得订单ID
 *  @param  string  $order_sn   订单sn
 *  @param  blob    $voucher    是否为会员充值
 */
function get_order_id_by_sn($order_sn, $voucher = 'false')
{
    if ($voucher == 'true')
    {
        if(is_numeric($order_sn))
        {
              return $GLOBALS['db']->getOne("SELECT log_id FROM " . $GLOBALS['ecs']->table('pay_log') . " WHERE order_id=" . $order_sn . ' AND order_type=1');
        }
        else
        {
            return "";
        }
    }
    else
    {
        if(is_numeric($order_sn))
        {
            $sql = 'SELECT order_id FROM ' . $GLOBALS['ecs']->table('order_info'). " WHERE order_sn = '$order_sn'";
            $order_id = $GLOBALS['db']->getOne($sql);
        }
        if (!empty($order_id))
        {
            $pay_log_id = $GLOBALS['db']->getOne("SELECT log_id FROM " . $GLOBALS['ecs']->table('pay_log') . " WHERE order_id='" . $order_id . "'");
            return $pay_log_id;
        }
        else
        {
            return "";
        }
    }
}

/**
 *  通过订单ID取得订单商品名称
 *  @param  string  $order_id   订单ID
 */
function get_goods_name_by_id($order_id)
{
    $sql = 'SELECT goods_name FROM ' . $GLOBALS['ecs']->table('order_goods'). " WHERE order_id = '$order_id'";
    $goods_name = $GLOBALS['db']->getCol($sql);
    return implode(',', $goods_name);
}

/**
 * 检查支付的金额是否与订单相符
 *
 * @access  public
 * @param   string   $log_id      支付编号
 * @param   float    $money       支付接口返回的金额
 * @return  true
 */
function check_money($log_id, $money)
{
    $sql = 'SELECT order_amount FROM ' . $GLOBALS['ecs']->table('pay_log') .
              " WHERE log_id = '$log_id'";
    $amount = $GLOBALS['db']->getOne($sql);

    if ($money == $amount)
    {
        return true;
    }
    else
    {
        return false;
    }
}

/**
 * 修改订单的支付状态
 *
 * @access  public
 * @param   string  $log_id     支付编号
 * @param   integer $pay_status 状态
 * @param   string  $note       备注
 * @return  void
 */
function order_paid($log_id, $pay_status = PS_PAYED, $note = '')
{
    
    /* 取得支付编号 */
    $log_id = intval($log_id);
    if ($log_id > 0)
    {
        /* 取得要修改的支付记录信息 */
        $sql = "SELECT * FROM " . $GLOBALS['ecs']->table('pay_log') .
                " WHERE log_id = '$log_id'";
        $pay_log = $GLOBALS['db']->getRow($sql);
        if ($pay_log && $pay_log['is_paid'] == 0)
        {
            /* 修改此次支付操作的状态为已付款 */
            $sql = 'UPDATE ' . $GLOBALS['ecs']->table('pay_log') .
                    " SET is_paid = '1' WHERE log_id = '$log_id'";
            $GLOBALS['db']->query($sql);

            /* 根据记录类型做相应处理 */
            if ($pay_log['order_type'] == PAY_ORDER)
            {
                /* 取得订单信息 */
                $sql = 'SELECT order_id, user_id, order_sn, consignee, address, tel, shipping_id, extension_code, extension_id, goods_amount ' .
                        'FROM ' . $GLOBALS['ecs']->table('order_info') .
                       " WHERE order_id = '$pay_log[order_id]'";
                $order    = $GLOBALS['db']->getRow($sql);
                $order_id = $order['order_id'];
                $order_sn = $order['order_sn'];

                /* 修改订单状态为已付款 */
                $sql = 'UPDATE ' . $GLOBALS['ecs']->table('order_info') .
                            " SET order_status = '" . OS_CONFIRMED . "', " .
                                " confirm_time = '" . gmtime() . "', " .
                                " pay_status = '$pay_status', " .
                                " pay_time = '".gmtime()."', " .
                                " money_paid = order_amount," .
                                " order_amount = 0 ".
                       "WHERE order_id = '$order_id'";
                $GLOBALS['db']->query($sql);

                /* 记录订单操作记录 */
                order_action($order_sn, OS_CONFIRMED, SS_UNSHIPPED, $pay_status, $note, $GLOBALS['_LANG']['buyer']);

                /* 如果需要，发短信 */
                if ($GLOBALS['_CFG']['sms_order_payed'] == '1' && $GLOBALS['_CFG']['sms_shop_mobile'] != '')
                {
                    include_once(ROOT_PATH.'includes/cls_sms.php');
                    $sms = new sms();
                    $sms->send($GLOBALS['_CFG']['sms_shop_mobile'],
                        sprintf($GLOBALS['_LANG']['order_payed_sms'], $order_sn, $order['consignee'], $order['tel']),'', 13,1);
                }

                /* 对虚拟商品的支持 */
                $virtual_goods = get_virtual_goods($order_id);
                if (!empty($virtual_goods))
                {
                    $msg = '';
                    if (!virtual_goods_ship($virtual_goods, $msg, $order_sn, true))
                    {
                        $GLOBALS['_LANG']['pay_success'] .= '<div style="color:red;">'.$msg.'</div>'.$GLOBALS['_LANG']['virtual_goods_ship_fail'];
                    }

                    /* 如果订单没有配送方式，自动完成发货操作 */
                    if ($order['shipping_id'] == -1)
                    {
                        /* 将订单标识为已发货状态，并记录发货记录 */
                        $sql = 'UPDATE ' . $GLOBALS['ecs']->table('order_info') .
                               " SET shipping_status = '" . SS_SHIPPED . "', shipping_time = '" . gmtime() . "'" .
                               " WHERE order_id = '$order_id'";
                        $GLOBALS['db']->query($sql);

                         /* 记录订单操作记录 */
                        order_action($order_sn, OS_CONFIRMED, SS_SHIPPED, $pay_status, $note, $GLOBALS['_LANG']['buyer']);
                        $integral = integral_to_give($order);
                        log_account_change($order['user_id'], 0, 0, intval($integral['rank_points']), intval($integral['custom_points']), sprintf($GLOBALS['_LANG']['order_gift_integral'], $order['order_sn']));
                    }
                }

            }
            elseif ($pay_log['order_type'] == PAY_SURPLUS)
            {
                $campaigns_table = $GLOBALS['ecs']->table('campaigns');
                $error = "";
                
                //判断卡号是否为空
                if(empty($note))
                {
                      $error = "对不起，得不到卡号信息！";
                }
                else{
                    
                    //判断是否超过当天领取的最大值
                    $sql = "select count(*) from $campaigns_table where  datediff(now(), `create_time`) = 3";
                    $count = $GLOBALS['db']->getOne($sql);

                    if($count >= 20)
                    {
                        $error = "对不起，当天的20个名额已经送完，您所充值的1元自动存储到您的账户余额中，请您明天再来吧！";

                    }
                    else{
                        
                        $sql = "select count(*) from $campaigns_table where card_sn = '$note'";
                        $count = $GLOBALS['db']->getOne($sql);
                        if($count > 0)
                        {
                            $error = "对不起，卡号为 $note 的新福卡已经使用过了，您所充值的1元自动存储到您的账户余额中，请您换张卡充值吧！";

                        }
                        
                    }
                
                }
                
                //无论是否具有资格 都将1元充入账户余额中
                //如果不具有秒杀资格，则充值账户金额到
                /* 更新会员预付款的到款状态 */
                $sql = 'UPDATE ' . $GLOBALS['ecs']->table('user_account') .
                    " SET paid_time = '" .gmtime(). "', is_paid = 1" .
                    " WHERE id = '$pay_log[order_id]' LIMIT 1";
                $GLOBALS['db']->query($sql);

                /* 取得添加预付款的用户以及金额 */
                $sql = "SELECT user_id, amount FROM " . $GLOBALS['ecs']->table('user_account') .
                        " WHERE id = '$pay_log[order_id]'";
                $arr = $GLOBALS['db']->getRow($sql);

                /* 修改会员帐户金额 */
                $_LANG = array();
                include_once(ROOT_PATH . 'languages/' . $GLOBALS['_CFG']['lang'] . '/user.php');
                log_account_change($arr['user_id'], $arr['amount'], 0, 0, 0, $_LANG['surplus_type_0'], ACT_SAVING);
                
                if(!empty($error))
                {
                   show_message($error);
                    
                }
                //如果具有秒杀资格
                else
                {

                    //添加提货券
                    $volumes_type_id = 56036;
                    //添加优惠劵
                    $deliveryVolumes = new DeliveryVolumes();
                    $deliveryVolumes->user_id =   GLogin::id();
                    $deliveryVolumes->goods_id =   $volumes_type_id;
                    $deliveryVolumes->create_time = time();
                    $deliveryVolumes->expire_time = time() + 30*24*60*60;//默认为一个月
                    $deliveryVolumes->is_shipping_free = true;
                    $res = $deliveryVolumes->save() ;
                    $goods_id =  $deliveryVolumes->goods_id ;
                    $is_shipping_free =   $deliveryVolumes->is_shipping_free;
                    $goods = $GLOBALS['db']->getRow('select goods_sn,goods_weight,goods_id,goods_name,market_price,is_real,extension_code from '.$GLOBALS['ecs']->table('goods')." where goods_id =".$goods_id);
                    //提货
                     $cart = array(
                        'user_id'        => GLogin::id(),
                        'session_id'     => SESS_ID,
                        'goods_id'       => $goods['goods_id'],
                        'goods_sn'       => addslashes($goods['goods_sn']),
                        'goods_name'     => addslashes($goods['goods_name']).'<font color=red>(提货券商品)</font>',
                        'market_price'   => $goods['market_price'],
                        'goods_price'    => 0,//$goods['exchange_integral']
                        'goods_number'   => 1,
                        'is_real'        => $goods['is_real'],
                        'goods_weight'   =>  $is_shipping_free?0:$goods['goods_weight'],
                        'extension_code' => addslashes($goods['extension_code']),
                        'parent_id'      => $deliveryVolumes->volumes_id,
                        'rec_type'       => CART_EXCHANGE_GOODS,
                        'is_gift'        => 0
                    );
                    $GLOBALS['db']->autoExecute($GLOBALS['ecs']->table('cart'), $cart, 'INSERT');
                    //添加到活动记录中
             
                    $sql = "insert into $campaigns_table (card_sn,create_time,user_id) values ('$note',now(),". GLogin::id().")";
                    $GLOBALS['db']->query($sql);
                        
                    //show_message('商品已经添加到购物车中，您可以去直接结算，也欢迎您购买其他产品');
                    //修改策略 直接跳至物流页面
                    header('Location:flow.php?step=checkout');
                    
                    
                }
        
            }
        }
        else
        {
            /* 取得已发货的虚拟商品信息 */
            $post_virtual_goods = get_virtual_goods($pay_log['order_id'], true);

            /* 有已发货的虚拟商品 */
            if (!empty($post_virtual_goods))
            {
                $msg = '';
                /* 检查两次刷新时间有无超过12小时 */
                $sql = 'SELECT pay_time, order_sn FROM ' . $GLOBALS['ecs']->table('order_info') . " WHERE order_id = '$pay_log[order_id]'";
                $row = $GLOBALS['db']->getRow($sql);
                $intval_time = gmtime() - $row['pay_time'];
                if ($intval_time >= 0 && $intval_time < 3600 * 12)
                {
                    $virtual_card = array();
                    foreach ($post_virtual_goods as $code => $goods_list)
                    {
                        /* 只处理虚拟卡 */
                        if ($code == 'virtual_card')
                        {
                            foreach ($goods_list as $goods)
                            {
                                if ($info = virtual_card_result($row['order_sn'], $goods))
                                {
                                    $virtual_card[] = array('goods_id'=>$goods['goods_id'], 'goods_name'=>$goods['goods_name'], 'info'=>$info);
                                }
                            }

                            $GLOBALS['smarty']->assign('virtual_card',      $virtual_card);
                        }
                    }
                }
                else
                {
                    $msg = '<div>' .  $GLOBALS['_LANG']['please_view_order_detail'] . '</div>';
                }

                $GLOBALS['_LANG']['pay_success'] .= $msg;
            }

           /* 取得未发货虚拟商品 */
           $virtual_goods = get_virtual_goods($pay_log['order_id'], false);
           if (!empty($virtual_goods))
           {
               $GLOBALS['_LANG']['pay_success'] .= '<br />' . $GLOBALS['_LANG']['virtual_goods_ship_fail'];
           }
        }
    }
}

?>