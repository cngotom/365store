<?php

/**
 * 处理邮件和短信订阅的信息
 */

define('IN_ECS', true);

require(ROOT_PATH . '/includes/init.php');



//添加提醒
if ($_REQUEST['act'] == 'add_reminder')
{
    include_once('includes/cls_json.php');
    $json = new JSON;
    $result = array('code' => '', 'content' => '');
    
    $reminder_data = array(
        'event_id' => intval(  $_REQUEST['event_id'] ) , 
        'type' => 1, //reminder  0 for subscribe
        'no_type' =>intval(  $_REQUEST['no_type']) , //0 for mobile  ,1 for email
        'no' =>addslashes(  $_REQUEST['no']) , //0 for mobile  ,1 for email
        'event_time' => strtotime( addslashes ( $_REQUEST['event_time']))
    );
    
  
    
    $db->autoExecute($ecs->table('subscribe_info'), $reminder_data, 'INSERT');
    die($json->encode($result));
    
}
else if($_REQUEST['act'] == 'add_subscribe')
{
      include_once('includes/cls_json.php');
    $json = new JSON;
    $result = array('code' => '', 'content' => '');
    
    $subscribe_data = array(    
        'type' => 0, //1 for reminder  0 for subscribe
        'no_type' =>intval(  $_REQUEST['no_type']) , //0 for mobile  ,1 for email
        'no' =>addslashes(  $_REQUEST['no']) , //0 for mobile  ,1 for email
    );
    

    $db->autoExecute($ecs->table('subscribe_info'), $subscribe_data, 'INSERT');
    
    die($json->encode($result));
    
}
                                

/*------------------------------------------------------ */
//-- INPUT
/*------------------------------------------------------ */

if (!isset($_REQUEST['step']))
{
    $_REQUEST['step'] = "cart";
}

/*------------------------------------------------------ */
//-- PROCESSOR
/*------------------------------------------------------ */

assign_template();
assign_dynamic('flow');
$position = assign_ur_here(0, $_LANG['shopping_flow']);
$smarty->assign('page_title',       $position['title']);    // 页面标�?
$smarty->assign('ur_here',          $position['ur_here']);  // 当前位置

$smarty->assign('categories',       get_categories_tree()); // 分类�
$smarty->assign('helps',            get_shop_help());       // 网店�?��
$smarty->assign('lang',             $_LANG);
$smarty->assign('show_marketprice', $_CFG['show_marketprice']);
$smarty->assign('data_dir',    DATA_DIR);       // 数据�?��

/*------------------------------------------------------ */
//-- 添加商品到购物车
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'showForm_consignee')
{
    include_once('includes/cls_json.php');
    $json = new JSON;
    $result = array('code' => '', 'content' => '');

    include_once('includes/lib_transaction.php');

    $consignee = get_consignee(GLogin::id());
     /* 取得国�?列表、商店所在国家、商店所在国家的省列� */
    $smarty->assign('province_list', get_regions(1, $consignee['country']));
    $smarty->assign('city_list',    get_regions(2, $consignee['province']));
    $smarty->assign('district_list', get_regions(3, $consignee['city']));
    
    $short_consignee_list = get_short_consignee_list(GLogin::id());
    $smarty->assign('consignee', $consignee);
    $smarty->assign('consignee_list', $short_consignee_list);
    $result['content']     = $smarty->fetch('library/consignee.lbi');
    die($json->encode($result));

}
else if($_REQUEST['act'] == 'changeConsignee')
{
    $address_id = isset($_REQUEST['address_id'])? $_REQUEST['address_id'] : -1 ;
    include_once('includes/cls_json.php');
    $json = new JSON;
    $result = array('code' => '', 'content' => '');
    include_once('includes/lib_transaction.php');

    $_SESSION['flow_consignee'] = get_consignee_by_id(GLogin::id(),$address_id);
    $consignee = get_consignee(GLogin::id());
    /* 取得国�?列表、商店所在国家、商店所在国家的省列� */
    $smarty->assign('province_list', get_regions(1, $consignee['country']));
    $smarty->assign('city_list',    get_regions(2, $consignee['province']));
    $smarty->assign('district_list', get_regions(3, $consignee['city']));
    
    $smarty->assign('consignee', $consignee);
    $result['content']     = $smarty->fetch('library/flow/consignee_addr.lbi');
    die($json->encode($result));
    
} 
else if($_REQUEST['act'] == 'addNewAddress')
{
     include_once('includes/cls_json.php');
    $json = new JSON;
    $result = array('code' => '', 'content' => '');

    include_once('includes/lib_transaction.php');
    $xml = simplexml_load_string($_POST["data"]); 

     $consignee = array(
            'consignee'     => empty($xml->consignee)  ? '' : trim($xml->consignee),
            'country'       => empty($xml->country)    ? '' : 1,
            'province'      => empty($xml->province)   ? '' : $xml->province,
            'city'          => empty($xml->city)       ? '' : $xml->city,
            'district'      => empty($xml->district)   ? '' : $xml->district,
            'email'         => empty($xml->email)      ? '' : $xml->email,
            'address'       => empty($xml->address)    ? '' : $xml->address,
            'zipcode'       => empty($xml->zipcode)    ? '' : make_semiangle(trim($xml->zipcode)),
            'tel'           => empty($xml->tel)        ? '' : make_semiangle(trim($xml->tel)),
            'mobile'        => empty($xml->mobile)     ? '' : make_semiangle(trim($xml->mobile)),
            'sign_building' => empty($xml->sign_building) ? '' : $xml->sign_building,
            'best_time'     => empty($xml->best_time)  ? '' : $xml->best_time,
            'address_name'     => empty($xml->addressAll)  ? '' : $xml->addressAll
        );
        if (GLogin::id() > 0)
        {
            include_once(ROOT_PATH . 'includes/lib_transaction.php');

            /* 如果用户已经登录，则保存收货人信� */
            $consignee['user_id'] = GLogin::id();

            save_consignee($consignee, true);
        }

   
    $consignee = get_consignee(GLogin::id());
     /* 取得国�?列表、商店所在国家、商店所在国家的省列� */

    
    $short_consignee_list = get_short_consignee_list(GLogin::id());
    $smarty->assign('consignee', $consignee);
    $smarty->assign('consignee_list', $short_consignee_list);
    $result['content']     = $smarty->fetch('library/flow/addressListPanel.lbi');
    $result['code'] = 0 ;
    die($json->encode($result));
  
}
else if ($_REQUEST['act'] =='getConsigneeInfo')
{
    include_once('includes/cls_json.php');
    $json = new JSON;
    $result = array('code' => '', 'content' => '');
    $consignee = get_consignee(GLogin::id());
    $smarty->assign('consignee', $consignee);
    $result['content']     = $smarty->fetch('library/flow/consignee_info.lbi');
    $result['code'] = 0 ;
    die($json->encode($result));
    
}
else if($_REQUEST['act'] == 'savePart')
{
     include_once('includes/cls_json.php');
    $json = new JSON;
    $result = array('code' => '', 'content' => '');

    include_once('includes/lib_transaction.php');
    $xml = simplexml_load_string($_POST["data"]); 

     $consignee = array(
            'consignee'     => empty($xml->consignee)  ? '' : trim((string)$xml->consignee),
            'country'       => empty($xml->country)    ? '' : 1,
            'province'      => empty($xml->province)   ? '' : (string)$xml->province,
            'city'          => empty($xml->city)       ? '' : (string)$xml->city,
            'district'      => empty($xml->district)   ? '' : (string)$xml->district,
            'email'         => empty($xml->email)      ? '' : (string)$xml->email,
            'address'       => empty($xml->address)    ? '' : (string)$xml->address,
            'zipcode'       => empty($xml->zipcode)    ? '' : make_semiangle(trim((string)$xml->zipcode)),
            'tel'           => empty($xml->tel)        ? '' : make_semiangle(trim((string)$xml->tel)),
            'mobile'        => empty($xml->mobile)     ? '' : make_semiangle(trim((string)$xml->mobile)),
            'sign_building' => empty($xml->sign_building) ? '' : (string)$xml->sign_building,
            'best_time'     => empty($xml->best_time)  ? '' : (string)$xml->best_time,
            'address_name'     => empty($xml->addressAll)  ? '' : (string)$xml->addressAll
        );


   
    $_SESSION['flow_consignee'] = $consignee ;
    $smarty->assign('consignee', $consignee);
    
    $result['content']     = $smarty->fetch('library/flow/consignee_info.lbi');
    $result['code'] = 0 ;
    die($json->encode($result));
  
}
else if($_REQUEST['act'] == 'DelAddress')
{
    $address_id = isset($_REQUEST['address_id'])? $_REQUEST['address_id'] : -1 ;
    include_once('includes/cls_json.php');
    $json = new JSON;
    $result = array('code' => '', 'content' => '');
    include_once('includes/lib_transaction.php');
    if( drop_consignee($address_id) )
    {
        $result['code'] = 0 ;
        $consignee = get_consignee(GLogin::id());
        /* 取得国�?列表、商店所在国家、商店所在国家的省列� */
        $smarty->assign('province_list', get_regions(1, $consignee['country']));
        $smarty->assign('city_list',    get_regions(2, $consignee['province']));
        $smarty->assign('district_list', get_regions(3, $consignee['city']));

        $short_consignee_list = get_short_consignee_list(GLogin::id());
        $smarty->assign('consignee', $consignee);
        $smarty->assign('consignee_list', $short_consignee_list);
        $result['content']     = $smarty->fetch('library/consignee.lbi');
    
    }
    else
    {
        $result['code'] = 1;
        $result['content'] = '删除失败';
    }
    die($json->encode($result));
}
else  if($_REQUEST['act'] =='ShowForm_payTypeAndShip')
{
    

    include_once('includes/cls_json.php');
    $json = new JSON;
    $result = array('code' => '', 'content' => '');
    
     $payment_list = available_payment_list(1, 0);
     $smarty->assign('payment_list', $payment_list);
     
  
    $consignee = get_consignee(GLogin::id());
    $region            = array($consignee['country'], $consignee['province'], $consignee['city'], $consignee['district']);
    
    
    $shipping_list     = available_shipping_list($region);

    $cart_weight_price = cart_weight_price();
    $insure_disabled   = true;
    $cod_disabled      = true;

    // 查看�?��车中�?��全为免运费商品，若是则把运费赋为�
    $sql = 'SELECT count(*) FROM ' . $ecs->table('cart') . " WHERE `session_id` = '" . SESS_ID. "' AND `extension_code` != 'package_buy' AND `is_shipping` = 0";
    $shipping_count = $db->getOne($sql);

    foreach ($shipping_list AS $key => $val)
    {
        $shipping_cfg = unserialize_config($val['configure']);
        $shipping_fee = ($shipping_count == 0 AND $cart_weight_price['free_shipping'] == 1) ? 0 : shipping_fee($val['shipping_code'], unserialize($val['configure']),
        $cart_weight_price['weight'], $cart_weight_price['amount'], $cart_weight_price['number']);

        $shipping_list[$key]['format_shipping_fee'] = price_format($shipping_fee, false);
        $shipping_list[$key]['shipping_fee']        = $shipping_fee;
        $shipping_list[$key]['free_money']          = price_format($shipping_cfg['free_money'], false);
        $shipping_list[$key]['insure_formated']     = strpos($val['insure'], '%') === false ? price_format($val['insure'], false) : $val['insure'];
        $shipping_list[$key]['real_fee'] = calculate_shiping_pay($val['shipping_id'],$region);
    }
    $order = isset($_SESSION['flow_order']) ?$_SESSION['flow_order']:flow_order_info();
    $smarty->assign('order',   $order);
    $smarty->assign('shipping_list',   $shipping_list);
    $result['content']     = $smarty->fetch('library/flow/pay_ship.lbi');
    die($json->encode($result));
    
}
else if ($_REQUEST['act'] =='get_payTypeAndShipInfo')
{
    include_once('includes/cls_json.php');
    $json = new JSON;
    $result = array('code' => '0', 'content' => '');
    $order = isset($_SESSION['flow_order']) ?$_SESSION['flow_order']:flow_order_info();
    
    
    $paymentName = get_payment_name( $order['pay_id']);
    $shippingName = get_shipping_name($order['shipping_id']);
    
    $shipping_info = shipping_area_info($order['shipping_id'],$region);
    if(!empty($shipping_info))
    {
        $shippingFee = calculate_shiping_pay($order['shipping_id'],$region);
        $smarty->assign('paymentName',   $paymentName);
        $smarty->assign('shippingName',   $shippingName);
        $smarty->assign('shippingFee',   $shippingFee);
        $result['content']     = $smarty->fetch('library/flow/pay_ship_info.lbi');
    }
    else
    {
        $result['code'] = 1;
        $result['content'] = "请选择配送方式";
    }
    die($json->encode($result));
}
else if($_REQUEST['act'] =='savePayAndShipping')
{
    include_once('includes/cls_json.php');
    $json = new JSON;
    $result = array('code' => '0', 'content' => '');
    $xml = simplexml_load_string($_POST["data"]); 
    $shipmentID =   (string)$xml->IdShipmentType;
    $paymentID = (string)$xml->IdPaymentType;
    $order = isset($_SESSION['flow_order']) ?$_SESSION['flow_order']:flow_order_info();

    /* 保存订单信息 */
    $order['shipping_id'] = intval($shipmentID);
    $order['pay_id'] = intval($paymentID);
    $_SESSION['flow_order'] = $order;
    
   // $_SESSION['shipping'] = $order['shipping_id'];
    $_SESSION['payment'] = $order['pay_id'];
    $consignee = get_consignee(GLogin::id());
    $region            = array($consignee['country'], $consignee['province'], $consignee['city'], $consignee['district']);
    
    $paymentName = get_payment_name( $order['pay_id']);
    $shippingName = get_shipping_name($order['shipping_id']);
     
    $shipping_info = shipping_area_info($order['shipping_id'],$region);
    if(!empty($shipping_info))
    {
        $shippingFee = calculate_shiping_pay($order['shipping_id'],$region);
        $smarty->assign('paymentName',   $paymentName);
        $smarty->assign('shippingName',   $shippingName);
        $smarty->assign('shippingFee',   $shippingFee);
        $result['content']     = $smarty->fetch('library/flow/pay_ship_info.lbi');
    }
    else
    {
        $result['code'] = 1;
        $result['error'] = "请选择配送方式";
    }
    die($json->encode($result));
}
else if($_REQUEST['act'] =='updateTotalFee')
{
    include_once('includes/cls_json.php');
    $json = new JSON;
    $result = array('code' => '0', 'content' => '');
    
    $order = isset($_SESSION['flow_order']) ?$_SESSION['flow_order']:flow_order_info();
    $consignee = get_consignee(GLogin::id());
    $cart_goods = cart_goods($flow_type); // 取得商品列表，�?算合�
    $total = order_fee($order, $cart_goods, $consignee);

    $smarty->assign('total', $total);
    
    
    
    $result['content']     = $smarty->fetch('library/flow/check_info.lbi');
    $result['totalfee']     = $total['amount_formated'];
    die($json->encode($result));
}
elseif ($_REQUEST['act'] == 'change_surplus')
{

       /*------------------------------------------------------ */
    //-- 改变余�?
    /*------------------------------------------------------ */
    include_once('includes/cls_json.php');
    $surplus   = floatval($_GET['surplus']);
    $user_info = user_info(GLogin::id());

    $result['notice']  = "";
    if ($user_info['user_money'] + $user_info['credit_line'] < $surplus)
    {
        $result['error'] = $_LANG['surplus_not_enough'];
    }
    else
    {
        /* 取得�?��类型 */
        $flow_type = isset($_SESSION['flow_type']) ? intval($_SESSION['flow_type']) : CART_GENERAL_GOODS;

        /* 取得�?��流程设置 */
        $smarty->assign('config', $_CFG);

        /* 获得收货人信� */
        $consignee = get_consignee(GLogin::id());

        /* 对商品信�?��� */
        $cart_goods = cart_goods($flow_type); // 取得商品列表，�?算合�
        

        if (empty($cart_goods) || !check_consignee_info($consignee, $flow_type))
        {
            $result['error'] = "请您先完善收货地址信息";
        }
        else
        {
            /* 取得订单信息 */
            $order = flow_order_info();
            
            $order['surplus'] = 0;
            $oldTotal =  order_fee($order, $cart_goods, $consignee);
            $order['surplus'] = $surplus;
            
            if( $order['surplus'] > $oldTotal['amount'])
            {
                  $result['notice'] = "您本次购物最多可以使用 <font color='red'>".$oldTotal['amount']."</font> 的余额";
                  $order['surplus']  = $oldTotal['amount'];
            }
           /* 计算订单的费� */
            
            $total = order_fee($order, $cart_goods, $consignee);
            $smarty->assign('total', $total);
            
            /* 团购标志 */
            if ($flow_type == CART_GROUP_BUY_GOODS)
            {
                $smarty->assign('is_group_buy', 1);
            }

            $result['content'] = $smarty->fetch('library/check_info.lbi');
            $result['surplus'] = $order['surplus'] ;
            
            //储存
            $_SESSION['surplus'] = $result['surplus'] ;
        }
    }

    $json = new JSON();
    die($json->encode($result));
}
elseif ($_REQUEST['act'] == 'changeBonus')
{
    /*------------------------------------------------------ */
    //-- 改变红包
    /*------------------------------------------------------ */
    include_once('includes/cls_json.php');
    $result = array('code' => '0', 'content' => '');

    /* 取得�?��类型 */
    $flow_type = isset($_SESSION['flow_type']) ? intval($_SESSION['flow_type']) : CART_GENERAL_GOODS;

    /* 获得收货人信� */
    $consignee = get_consignee(GLogin::id());

    /* 对商品信�?��� */
    $cart_goods = cart_goods($flow_type); // 取得商品列表，�?算合�

    if (empty($cart_goods) || !check_consignee_info($consignee, $flow_type))
    {
        $result['error'] = $_LANG['no_goods_in_cart'];
    }
    else
    {
        /* 取得�?��流程设置 */
        $smarty->assign('config', $_CFG);

        /* 取得订单信息 */
        $order = flow_order_info();

        $bonus = bonus_info(intval($_GET['bonus']));

        if ((!empty($bonus) && $bonus['user_id'] == GLogin::id()) || $_GET['bonus'] == 0)
        {
            $order['bonus_id'] = intval($_GET['bonus']);
        }
        else
        {
            $order['bonus_id'] = 0;
            $result['error'] = $_LANG['invalid_bonus'];
        }

        /* 计算订单的费� */
        $total = order_fee($order, $cart_goods, $consignee);
        $smarty->assign('total', $total);
        $result['totalfee'] = $total['amount_formated'];
        /* 团购标志 */
        if ($flow_type == CART_GROUP_BUY_GOODS)
        {
            $smarty->assign('is_group_buy', 1);
        }

        $result['content'] = $smarty->fetch('library/flow/check_info.lbi');
    }

    $json = new JSON();
    die($json->encode($result));
}
/* 验证红包序列� */
elseif ($_REQUEST['act'] == 'validateBonus')
{
    $bonus_sn = trim($_REQUEST['bonus_sn']);
    if (is_numeric($bonus_sn))
    {
        $bonus = bonus_info(0, $bonus_sn);
    }
    else
    {
        $bonus = array();
    }
   $bonus_kill = price_format($bonus['type_money'], false);

    include_once('includes/cls_json.php');
    $result = array('code' => '', 'content' => '');

    /* 取得�?��类型 */
    $flow_type = isset($_SESSION['flow_type']) ? intval($_SESSION['flow_type']) : CART_GENERAL_GOODS;

    /* 获得收货人信� */
    $consignee = get_consignee(GLogin::id());

    /* 对商品信�?��� */
    $cart_goods = cart_goods($flow_type); // 取得商品列表，�?算合�

    if (empty($cart_goods) || !check_consignee_info($consignee, $flow_type))
    {
        $result['code'] = $_LANG['no_goods_in_cart'];
    }
    else
    {
        /* 取得�?��流程设置 */
        $smarty->assign('config', $_CFG);

        /* 取得订单信息 */
        $order = flow_order_info();


        if (((!empty($bonus) && $bonus['user_id'] == GLogin::id()) || ($bonus['type_money'] > 0 && empty($bonus['user_id']))) && $bonus['order_id'] <= 0)
        {
            //$order['bonus_kill'] = $bonus['type_money'];
            $now = gmtime();
            if ($now > $bonus['use_end_date'])
            {
                $order['bonus_id'] = '';
                $result['code'] = 1;
                $result['error']=$_LANG['bonus_use_expire'];
            }
            else
            {
                $order['bonus_id'] = $bonus['bonus_id'];
                $order['bonus_sn'] = $bonus_sn;
            }
        }
        else
        {
            //$order['bonus_kill'] = 0;
            $order['bonus_id'] = '';
            $result['error'] = $_LANG['invalid_bonus'];
             $result['code'] = 1;
        }

        /* 计算订单的费� */
        $total = order_fee($order, $cart_goods, $consignee);

        if($total['goods_price']<$bonus['min_goods_amount'])
        {
         $order['bonus_id'] = '';
         /* 重新计算订单 */
         $total = order_fee($order, $cart_goods, $consignee);
         $result['error'] = sprintf($_LANG['bonus_min_amount_error'], price_format($bonus['min_goods_amount'], false));
        }

        $smarty->assign('total', $total);

        $result['totalfee'] = $total['amount_formated'];
        /* 团购标志 */
        if ($flow_type == CART_GROUP_BUY_GOODS)
        {
            $smarty->assign('is_group_buy', 1);
        }

        $result['content'] = $smarty->fetch('library/flow/check_info.lbi');
    }
    $json = new JSON();
    die($json->encode($result));
}
/*------------------------------------------------------ */
//-- 获得购物车商品
/*------------------------------------------------------ */
/*------------------------------------------------------*/
elseif ($_REQUEST['act']== 'get_cart_info')
{
    require_once(ROOT_PATH .'includes/cls_json.php');
    $json = new JSON();
    $result = array('num' => 0, 'content'=> ''); 
    $_SESSION['flow_type'] = CART_GENERAL_GOOgDS;
    /* 如果是一步购物，跳到结算中心 */
 
    /* 取得商品列表，计算合计 */
    $cart_goods = get_cart_goods();
    $smarty->assign('goods_list', $cart_goods['goods_list']);
    $smarty->assign('total', $cart_goods['total']);
    $result['content'] = $smarty->fetch('library/cart_info.lbi');
    $result['num'] = $cart_goods['total']['goods_num'];
    die($json->encode($result));
}
/*------------------------------------------------------ */
//-- 获得购物车商品
/*------------------------------------------------------ */
/*------------------------------------------------------*/
elseif ($_REQUEST['act']== 'drop_goods')
{
      $rec_id = intval($_GET['id']);
      flow_drop_cart_goods($rec_id);
      die('0');
}

/* 储存发票以及备注信息*/

elseif ($_REQUEST['act'] == 'saveInvoiceExtra')
{
    include_once('includes/cls_json.php');
    $result = array('code'=>0,'content'=>'');
    $json = new JSON;
    $invoiceExtra = $json->decode($_POST['invoiceExtra']);
    
    $_SESSION['inv_type'] =  $invoiceExtra->invoice_type;
    $_SESSION['inv_payee'] = $invoiceExtra->invocie_title;
    $_SESSION['inv_content'] = $invoiceExtra->invoice_content;
    $_SESSION['postscript'] = $invoiceExtra->extra;
    $_SESSION['need_inv'] = 1;
    
   // print_r($_SESSION);
    die($json->encode($result));
    
}


/*------------------------------------------------------ */
//-- 更新购物车
/*------------------------------------------------------ */
/*------------------------------------------------------*/

//-- Ajax更新购物车add 20120118

/*------------------------------------------------------*/



elseif ($_REQUEST['step']== 'ajax_update_cart')

{

    require_once(ROOT_PATH .'includes/cls_json.php');

    $json = new JSON();

    $result = array('error' => 0, 'message'=> '');

 

    if (isset($_POST['rec_id']) &&isset($_POST['goods_number']))

    {

        $key = $_POST['rec_id'];

        $val = $_POST['goods_number'];

        $val = intval(make_semiangle($val));

        if ($val <= 0 &&!is_numeric($key))

        {

            $result['error'] = 99;

            $result['message'] = '';            

            die($json->encode($result));

        }

 

        //查询：

        $sql = "SELECT `goods_id`, `goods_attr_id`,`product_id`, `extension_code` FROM" .$GLOBALS['ecs']->table('cart').

               " WHERE rec_id='$key' AND session_id ='" . SESS_ID . "'";

        $goods =$GLOBALS['db']->getRow($sql);

 

        $sql = "SELECT g.goods_name,g.goods_number ".

                "FROM ".$GLOBALS['ecs']->table('goods'). " AS g, ".

                   $GLOBALS['ecs']->table('cart'). " AS c ".

                "WHERE g.goods_id =c.goods_id AND c.rec_id = '$key'";

        $row = $GLOBALS['db']->getRow($sql);

 

        //查询：系统启用了库存，检查输入的商品数量是否有效

        if(intval($GLOBALS['_CFG']['use_storage']) > 0 &&$goods['extension_code'] != 'package_buy')

        {

            if ($row['goods_number'] < $val)

            {

                $result['error'] = 1;

                $result['message'] =sprintf($GLOBALS['_LANG']['stock_insufficiency'], $row['goods_name'],$row['goods_number'], $row['goods_number']);

                die($json->encode($result));

            }

            /* 是货品*/

            $goods['product_id'] = trim($goods['product_id']);

            if (!empty($goods['product_id']))

            {

                $sql = "SELECT product_number FROM " .$GLOBALS['ecs']->table('products'). " WHERE goods_id = '" . $goods['goods_id'] . "' AND product_id = '" .$goods['product_id'] . "'";

 

                $product_number =$GLOBALS['db']->getOne($sql);

                if ($product_number < $val)

                {

                    $result['error'] = 2;

                    $result['message'] =sprintf($GLOBALS['_LANG']['stock_insufficiency'], $row['goods_name'],

                   $product_number['product_number'], $product_number['product_number']);

                   die($json->encode($result));

                }

            }

        }

        elseif (intval($GLOBALS['_CFG']['use_storage'])> 0 && $goods['extension_code'] == 'package_buy')

        {

            if(judge_package_stock($goods['goods_id'], $val))

            {

                $result['error'] = 3;

                $result['message'] =$GLOBALS['_LANG']['package_stock_insufficiency'];

                die($json->encode($result));

            }

        }

 

        /* 查询：检查该项是否为基本件 以及是否存在配件*/

        /* 此处配件是指添加商品时附加的并且是设置了优惠价格的配件 此类配件都有parent_idgoods_number为1 */

        $sql = "SELECT b.goods_number,b.rec_id

                FROM ".$GLOBALS['ecs']->table('cart') . " a, ".$GLOBALS['ecs']->table('cart') . " b

                WHERE a.rec_id = '$key'

                AND a.session_id = '" .SESS_ID . "'

                AND a.extension_code <>'package_buy'

                AND b.parent_id = a.goods_id

                AND b.session_id = '" .SESS_ID . "'";

 

        $offers_accessories_res =$GLOBALS['db']->query($sql);

 

        //订货数量大于0

        if ($val > 0)

        {

            /* 判断是否为超出数量的优惠价格的配件 删除*/

            $row_num = 1;

            while ($offers_accessories_row =$GLOBALS['db']->fetchRow($offers_accessories_res))

            {

                if ($row_num > $val)

                {

                    $sql = "DELETE FROM" . $GLOBALS['ecs']->table('cart') .

                            " WHERE session_id = '" . SESS_ID . "' " .

                            "AND rec_id ='" . $offers_accessories_row['rec_id'] ."' LIMIT 1";

                   $GLOBALS['db']->query($sql);

                }

 

                $row_num ++;

            }

 

            /* 处理超值礼包*/

            if ($goods['extension_code'] =='package_buy')

            {

                //更新购物车中的商品数量

                $sql = "UPDATE ".$GLOBALS['ecs']->table('cart').

                        " SET goods_number= '$val' WHERE rec_id='$key' AND session_id='" . SESS_ID . "'";

            }

            /* 处理普通商品或非优惠的配件*/

            else

            {

                $attr_id    = empty($goods['goods_attr_id']) ? array(): explode(',', $goods['goods_attr_id']);

                $goods_price =get_final_price($goods['goods_id'], $val, true, $attr_id);

 

                //更新购物车中的商品数量

                $sql = "UPDATE ".$GLOBALS['ecs']->table('cart').

                        " SET goods_number= '$val', goods_price = '$goods_price' WHERE rec_id='$key' AND session_id='" . SESS_ID . "'";

            }

        }

        //订货数量等于0

        else

        {

            /* 如果是基本件并且有优惠价格的配件则删除优惠价格的配件*/

            while ($offers_accessories_row =$GLOBALS['db']->fetchRow($offers_accessories_res))

            {

                $sql = "DELETE FROM ". $GLOBALS['ecs']->table('cart') .

                        " WHERE session_id= '" . SESS_ID . "' " .

                        "AND rec_id ='" . $offers_accessories_row['rec_id'] ."' LIMIT 1";

                $GLOBALS['db']->query($sql);

            }

 

            $sql = "DELETE FROM ".$GLOBALS['ecs']->table('cart').

                " WHERE rec_id='$key' AND session_id='" .SESS_ID. "'";

        }

 

        $GLOBALS['db']->query($sql);

 

        /* 删除所有赠品*/

        $sql = "DELETE FROM " .$GLOBALS['ecs']->table('cart') . " WHERE session_id = '" .SESS_ID."' AND is_gift <> 0";

        $GLOBALS['db']->query($sql);

        

        $result['rec_id'] = $key;

        $result['goods_number'] = $val;        

        $result['goods_subtotal'] = '';

        $result['total_desc'] = '';     

        $result['cart_info'] =insert_cart_info();  

        /* 计算合计*/

        $cart_goods = get_cart_goods();

        foreach ($cart_goods['goods_list'] as$goods )

        {

            if ($goods['rec_id'] == $key)

            {

                $result['goods_subtotal'] =$goods['subtotal'];

                break;

            }

        }

        $shopping_money =$cart_goods['total']['goods_price'];

     #   $market_price_desc = sprintf($_LANG['than_market_price'],$cart_goods['total']['market_price'],$cart_goods['total']['saving'], $cart_goods['total']['save_rate']);

        $saving_money = $cart_goods['total']['saving'];

        /* 计算折扣*/

        $discount = compute_discount();

        $favour_name = empty($discount['name'])? '' : join(',', $discount['name']);

       # $your_discount =sprintf($_LANG['your_discount'], $favour_name,price_format($discount['discount']));

        

        if ($discount['discount'] > 0)

        {

            $result['discount'] = $discount['discount'];

        }

        $result['shopping_money'] = $shopping_money;

        if ($_CFG['show_marketprice'])

        {

            $result['saving_money'] = $saving_money;

        }

        die($json->encode($result));          

    }

    else

    {

        $result['error'] = 100;

        $result['message'] = '';

        die($json->encode($result));

    }                 
}
elseif ($_REQUEST['step'] == 'cart')
{
    /* 标记购物流程为普通商品 */
    $_SESSION['flow_type'] = CART_GENERAL_GOODS;

    /* 如果是一步购物，跳到结算中心 */
    if ($_CFG['one_step_buy'] == '1')
    {
        ecs_header("Location: flow.php?step=checkout\n");
        exit;
    }

    /* 取得商品列表，计算合计 */
    $cart_goods = get_cart_goods();
    $smarty->assign('goods_list', $cart_goods['goods_list']);
    $smarty->assign('total', $cart_goods['total']);

    //购物车的描述的格式化
   # $smarty->assign('shopping_money',         sprintf($_LANG['shopping_money'], $cart_goods['total']['goods_price']));
  #  $smarty->assign('market_price_desc',      sprintf($_LANG['than_market_price'],
  #  $cart_goods['total']['market_price'], $cart_goods['total']['saving'], $cart_goods['total']['save_rate']));
    
     $smarty->assign('shopping_money',         $cart_goods['total']['goods_price']);
     $smarty->assign('saving_money',    $cart_goods['total']['saving']);
    // 显示收藏夹内的商品
    if (GLogin::id() > 0)
    {
        require_once(ROOT_PATH . 'includes/lib_clips.php');
        $collection_goods = get_collection_goods(GLogin::id());
        $smarty->assign('collection_goods', $collection_goods);
    }

    /* 取得优惠活动 */
    $favourable_list = favourable_list(GLogin::rank());
    usort($favourable_list, 'cmp_favourable');

    $smarty->assign('favourable_list', $favourable_list);

    /* 计算折扣 */
    $discount = compute_discount();
    $smarty->assign('discount', $discount['discount']);
    $favour_name = empty($discount['name']) ? '' : join(',', $discount['name']);
    $smarty->assign('your_discount', sprintf($_LANG['your_discount'], $favour_name, price_format($discount['discount'])));

    /* 增加是否在购物车里显示商品图 */
    $smarty->assign('show_goods_thumb', $GLOBALS['_CFG']['show_goods_in_cart']);

    /* 增加是否在购物车里显示商品属性 */
    $smarty->assign('show_goods_attribute', $GLOBALS['_CFG']['show_attr_in_cart']);

    /* 购物车中商品配件列表 */
    //取得购物车中基本件ID
    $sql = "SELECT goods_id " .
            "FROM " . $GLOBALS['ecs']->table('cart') .
            " WHERE session_id = '" . SESS_ID . "' " .
            "AND rec_type = '" . CART_GENERAL_GOODS . "' " .
            "AND is_gift = 0 " .
            "AND extension_code <> 'package_buy' " .
            "AND parent_id = 0 ";
    $parent_list = $GLOBALS['db']->getCol($sql);

    $fittings_list = get_goods_fittings($parent_list);

    $smarty->assign('fittings_list', $fittings_list);
    
    $smarty->assign('currency_format', $_CFG['currency_format']);
    $smarty->assign('integral_scale',  $_CFG['integral_scale']);
    $smarty->assign('step',            $_REQUEST['step']);
    assign_dynamic('shopping_flow');

    $smarty->display('flow.dwt');
    
    
}



elseif ($_REQUEST['step'] == 'checkout')
{
    /*------------------------------------------------------ */
    //-- 订单�??
    /*------------------------------------------------------ */
    //清楚session储存的余额
    unset($_SESSION['surplus']);  

    /* 取得�?��类型 */
    $flow_type = isset($_SESSION['flow_type']) ? intval($_SESSION['flow_type']) : CART_GENERAL_GOODS;

    /* 团购标志 */
    if ($flow_type == CART_GROUP_BUY_GOODS)
    {
        $smarty->assign('is_group_buy', 1);
    }
    /* �?��兑换商品 */
    elseif ($flow_type == CART_EXCHANGE_GOODS)
    {
        $smarty->assign('is_exchange_goods', 1);
    }
    else
    {
        //正常�?��流程  清空其他�?��流程情况
      //  $_SESSION['flow_order']['extension_code'] = '';
    }

    /* 检查购物车�?��否有商品 */
    $sql = "SELECT COUNT(*) FROM " . $ecs->table('cart') .
        " WHERE session_id = '" . SESS_ID . "' " .
        "AND parent_id = 0 AND is_gift = 0 AND rec_type = '$flow_type'";

    if ($db->getOne($sql) == 0)
    {
        //没有商品跳转到主页
          header("Location: index.php\n");
      //  show_message($_LANG['no_goods_in_cart'], '', '', 'warning');
    }

    /*
     * 检查用户是否已经登�
     * 如果用户已经登录了则检查是否有默�?的收货地址
     * 如果没有登录则跳�?��登录和注册页�
     */
    if (empty($_SESSION['direct_shopping']) && GLogin::id() == 0)
    {
        /* 用户没有登录且没有选定匿名�?��，转向到登录页面 */
        ecs_header("Location: flow.php?step=login\n");
        exit;
    }

   // unset($_SESSION['flow_consignee']);
    $consignee = get_consignee(GLogin::id());
//print_r($consignee);
    
    /* 检查收货人信息�?��完整 */
    if (!check_consignee_info($consignee, $flow_type))
    {
        /* 如果不完整则�?��到收货人信息�?��界面 */
         $smarty->assign('need_add_consginee', true);
         $smarty->assign('country_list',       get_regions());
         $consignee['province'] =  $_CFG['shop_province'];
         $consignee['city'] =  $_CFG['shop_city'];
         $smarty->assign('province_list', get_regions(1, $_CFG['shop_country']));
         $smarty->assign('city_list', get_regions(2, $_CFG['shop_province']));
         $smarty->assign('district_list', get_regions(3, $_CFG['shop_city']));
    }

    $smarty->assign('consignee', $consignee);
    include_once('includes/lib_transaction.php');
    $short_consignee_list = get_short_consignee_list(GLogin::id());
    $smarty->assign('consignee_list', $short_consignee_list);

    /* 对商品信�?��� */
    $cart_goods = cart_goods($flow_type); // 取得商品列表，�?算合�
    
    $smarty->assign('goods_list', $cart_goods);
    $smarty->assign('cart_num',cart_num());
    $smarty->assign('cart_weight',cart_weight());
    /* 对是否允许修改购物车赋� */
    if ($flow_type != CART_GENERAL_GOODS || $_CFG['one_step_buy'] == '1')
    {
        $smarty->assign('allow_edit_cart', 0);
    }
    else
    {
        $smarty->assign('allow_edit_cart', 1);
    }

    /*
     * 取得�?��流程设置
     */
    $smarty->assign('config', $_CFG);
    /*
     * 取得订单信息
     */

    $order = isset($_SESSION['flow_order']) ?$_SESSION['flow_order']:flow_order_info();
  //  print_r($order);
    $region            = array($consignee['country'], $consignee['province'], $consignee['city'], $consignee['district']);
    if($order['pay_id'] == 0 || $order['shipping_id'] == 0 )
    {
        $smarty->assign('need_add_payship', true);    
        $order['pay_id'] = 1;
        $order['shipping_id'] = 5;
        
    }
    else
    {
           $paymentName = get_payment_name( $order['pay_id']);
            $shippingName = get_shipping_name($order['shipping_id']);
            $shippingFee = calculate_shiping_pay($order['shipping_id'],$region);

            $smarty->assign('paymentName',   $paymentName);
            $smarty->assign('shippingName',   $shippingName);
            $smarty->assign('shippingFee',   $shippingFee);
    }
    
    $smarty->assign('order', $order);

    /* 计算折扣 */
    if ($flow_type != CART_EXCHANGE_GOODS && $flow_type != CART_GROUP_BUY_GOODS)
    {
        $discount = compute_discount();
        $smarty->assign('discount', $discount['discount']);
        $favour_name = empty($discount['name']) ? '' : join(',', $discount['name']);
        $smarty->assign('your_discount', sprintf($_LANG['your_discount'], $favour_name, price_format($discount['discount'])));
    }

    /*
     * 计算订单的费�
     */
    $total = order_fee($order, $cart_goods, $consignee);

    $smarty->assign('total', $total);
    $smarty->assign('shopping_money', sprintf($_LANG['shopping_money'], $total['formated_goods_price']));
    $smarty->assign('market_price_desc', sprintf($_LANG['than_market_price'], $total['formated_market_price'], $total['formated_saving'], $total['save_rate']));

    /* 取得配送列� */
    $shipping_list     = available_shipping_list($region);
    $cart_weight_price = cart_weight_price($flow_type);
    $insure_disabled   = true;
    $cod_disabled      = true;

  
    
    
    // 查看�?��车中�?��全为免运费商品，若是则把运费赋为�
    $sql = 'SELECT count(*) FROM ' . $ecs->table('cart') . " WHERE `session_id` = '" . SESS_ID. "' AND `extension_code` != 'package_buy' AND `is_shipping` = 0";
    $shipping_count = $db->getOne($sql);

    foreach ($shipping_list AS $key => $val)
    {
        $shipping_cfg = unserialize_config($val['configure']);
        $shipping_fee = ($shipping_count == 0 AND $cart_weight_price['free_shipping'] == 1) ? 0 : shipping_fee($val['shipping_code'], unserialize($val['configure']),
        $cart_weight_price['weight'], $cart_weight_price['amount'], $cart_weight_price['number']);

        $shipping_list[$key]['format_shipping_fee'] = price_format($shipping_fee, false);
        $shipping_list[$key]['shipping_fee']        = $shipping_fee;
        $shipping_list[$key]['free_money']          = price_format($shipping_cfg['free_money'], false);
        $shipping_list[$key]['insure_formated']     = strpos($val['insure'], '%') === false ?
            price_format($val['insure'], false) : $val['insure'];

        /* 当前的配送方式是否支持保� */
        if ($val['shipping_id'] == $order['shipping_id'])
        {
            $insure_disabled = ($val['insure'] == 0);
            $cod_disabled    = ($val['support_cod'] == 0);
        }
    }

    $smarty->assign('shipping_list',   $shipping_list);
    $smarty->assign('insure_disabled', $insure_disabled);
    $smarty->assign('cod_disabled',    $cod_disabled);

    /* 取得�?��列表 */
    if ($order['shipping_id'] == 0)
    {
        $cod        = true;
        $cod_fee    = 0;
    }
    else
    {
        $shipping = shipping_info($order['shipping_id']);
        $cod = $shipping['support_cod'];

        if ($cod)
        {
            /* 如果�?���?��且保证金大于0，不能使用货到付� */
            if ($flow_type == CART_GROUP_BUY_GOODS)
            {
                $group_buy_id = $_SESSION['extension_id'];
                if ($group_buy_id <= 0)
                {
                    show_message('error group_buy_id');
                }
                $group_buy = group_buy_info($group_buy_id);
                if (empty($group_buy))
                {
                    show_message('group buy not exists: ' . $group_buy_id);
                }

                if ($group_buy['deposit'] > 0)
                {
                    $cod = false;
                    $cod_fee = 0;

                    /* 赋值保证金 */
                    $smarty->assign('gb_deposit', $group_buy['deposit']);
                }
            }

            if ($cod)
            {
                $shipping_area_info = shipping_area_info($order['shipping_id'], $region);
                $cod_fee            = $shipping_area_info['pay_fee'];
            }
        }
        else
        {
            $cod_fee = 0;
        }
    }

    // 给货到付款的手续费加<span id>，以便改变配送的时候动态显�
    $payment_list = available_payment_list(1, $cod_fee);
    if(isset($payment_list))
    {
        foreach ($payment_list as $key => $payment)
        {
            if ($payment['is_cod'] == '1')
            {
                $payment_list[$key]['format_pay_fee'] = '<span id="ECS_CODFEE">' . $payment['format_pay_fee'] . '</span>';
            }
            /* 如果有易宝�?州�?�?�� 如果订单金�?大于300 则不显示 */
            if ($payment['pay_code'] == 'yeepayszx' && $total['amount'] > 300)
            {
                unset($payment_list[$key]);
            }
            /* 如果有余额支� */
            if ($payment['pay_code'] == 'balance')
            {
                /* 如果�?��录，不显� */
                if (GLogin::id() == 0)
                {
                    unset($payment_list[$key]);
                }
                else
                {
                    if ($_SESSION['flow_order']['pay_id'] == $payment['pay_id'])
                    {
                        $smarty->assign('disable_surplus', 1);
                    }
                }
            }
        }
    }
    $smarty->assign('payment_list', $payment_list);

    /* 取得包�?与贺� */
    if ($total['real_goods_count'] > 0)
    {
        /* �?��有实体商�?才�?判断包�?和贺� */
        if (!isset($_CFG['use_package']) || $_CFG['use_package'] == '1')
        {
            /* 如果使用包�?，取得包装列表及用户选择的包� */
            $smarty->assign('pack_list', pack_list());
        }

        /* 如果使用贺卡，取得贺卡列表及用户选择的贺� */
        if (!isset($_CFG['use_card']) || $_CFG['use_card'] == '1')
        {
            $smarty->assign('card_list', card_list());
        }
    }

    $user_info = user_info(GLogin::id());

    /* 如果使用余�?，取得用户余� */
    if ((!isset($_CFG['use_surplus']) || $_CFG['use_surplus'] == '1')
        && GLogin::id() > 0
        && $user_info['user_money'] > 0)
    {
        // 能使用余�
        $smarty->assign('allow_use_surplus', 1);
        $smarty->assign('your_surplus', $user_info['user_money']);
    }

    /* 如果使用�?��，取得用户可用积分及�??单最多可以使用的�?�� */
    if ((!isset($_CFG['use_integral']) || $_CFG['use_integral'] == '1')
        && GLogin::id() > 0
        && $user_info['pay_points'] > 0
        && ($flow_type != CART_GROUP_BUY_GOODS && $flow_type != CART_EXCHANGE_GOODS))
    {
        // 能使用积�
        $smarty->assign('allow_use_integral', 1);
        $smarty->assign('order_max_integral', flow_available_points());  // �?���?��
        $smarty->assign('your_integral',      $user_info['pay_points']); // 用户�?��
    }

    /* 如果使用红包，取得用户可以使用的红包及用户选择的红� */
    if ((!isset($_CFG['use_bonus']) || $_CFG['use_bonus'] == '1')
        && ($flow_type != CART_GROUP_BUY_GOODS && $flow_type != CART_EXCHANGE_GOODS))
    {
        // 取得用户�?��红包
        $user_bonus = user_bonus(GLogin::id(), $total['goods_price']);
        if (!empty($user_bonus))
        {
            foreach ($user_bonus AS $key => $val)
            {
                $user_bonus[$key]['bonus_money_formated'] = price_format($val['type_money'], false);
            }
            $smarty->assign('bonus_list', $user_bonus);
        }

        // 能使用红�
        $smarty->assign('allow_use_bonus', 1);
    }

    /* 如果使用缺货处理，取得缺货�?理列� */
    if (!isset($_CFG['use_how_oos']) || $_CFG['use_how_oos'] == '1')
    {
        if (is_array($GLOBALS['_LANG']['oos']) && !empty($GLOBALS['_LANG']['oos']))
        {
            $smarty->assign('how_oos_list', $GLOBALS['_LANG']['oos']);
        }
    }

    /* 如果能开发票，取得发票内容列� */
    if ((!isset($_CFG['can_invoice']) || $_CFG['can_invoice'] == '1')
        && isset($_CFG['invoice_content'])
        && trim($_CFG['invoice_content']) != '' && $flow_type != CART_EXCHANGE_GOODS)
    {
        $inv_content_list = explode("\n", str_replace("\r", '', $_CFG['invoice_content']));
        $smarty->assign('inv_content_list', $inv_content_list);

        $inv_type_list = array();
        foreach ($_CFG['invoice_type']['type'] as $key => $type)
        {
            if (!empty($type))
            {
                $inv_type_list[$type] = $type . ' [' . floatval($_CFG['invoice_type']['rate'][$key]) . '%]';
            }
        }
        $smarty->assign('inv_type_list', $inv_type_list);
    }

    /* 保存 session */
    $_SESSION['flow_order'] = $order;
    
    
    $smarty->assign('currency_format', $_CFG['currency_format']);
    $smarty->assign('integral_scale',  $_CFG['integral_scale']);
    $smarty->assign('step',            $_REQUEST['step']);
    assign_dynamic('shopping_flow');

    
    header("Cache-Control:no-cache");  
    $smarty->display('confirm_order.dwt');
    exit();
    
}
/*------------------------------------------------------ */
//-- 完成所有�?单操作，提交到数�?��
/*------------------------------------------------------ */
elseif ($_REQUEST['step'] == 'done')
{
    include_once('includes/lib_clips.php');
    include_once('includes/lib_payment.php');

    /* 取得�?��类型 */
    $flow_type = isset($_SESSION['flow_type']) ? intval($_SESSION['flow_type']) : CART_GENERAL_GOODS;

    /* 检查购物车�?��否有商品 */
    $sql = "SELECT COUNT(*) FROM " . $ecs->table('cart') .
        " WHERE session_id = '" . SESS_ID . "' " .
        "AND parent_id = 0 AND is_gift = 0 AND rec_type = '$flow_type'";
    if ($db->getOne($sql) == 0)
    {
        show_message($_LANG['no_goods_in_cart'], '', '', 'warning');
    }

    /* 检查商品库� */
    /* 如果使用库存，且下�?单时减库存，则减少库� */
    if ($_CFG['use_storage'] == '1' && $_CFG['stock_dec_time'] == SDT_PLACE)
    {
        $cart_goods_stock = get_cart_goods();
        $_cart_goods_stock = array();
        foreach ($cart_goods_stock['goods_list'] as $value)
        {
            $_cart_goods_stock[$value['rec_id']] = $value['goods_number'];
        }
        flow_cart_stock($_cart_goods_stock);
        unset($cart_goods_stock, $_cart_goods_stock);
    }

    /*
     * 检查用户是否已经登�
     * 如果用户已经登录了则检查是否有默�?的收货地址
     * 如果没有登录则跳�?��登录和注册页�
     */
    if (empty($_SESSION['direct_shopping']) && GLogin::id() == 0)
    {
        /* 用户没有登录且没有选定匿名�?��，转向到登录页面 */
        ecs_header("Location: flow.php?step=login\n");
        exit;
    }

    $consignee = get_consignee(GLogin::id());

    /* 检查收货人信息�?��完整 */
    if (!check_consignee_info($consignee, $flow_type))
    {
        /* 如果不完整则�?��到收货人信息�?��界面 */
        ecs_header("Location: flow.php?step=checkout");
        exit;
    }
    
    include_once('includes/lib_transaction.php');
    //将最新consinee添加到address中，并设为默认
    $consignee['user_id'] = GLogin::id();
    touch_consignee($consignee);

    $_SESSION['how_oos'] = isset($_SESSION['how_oos']) ? intval($_SESSION['how_oos']) : 0;
    $_SESSION['card_message'] = isset($_SESSION['card_message']) ? htmlspecialchars($_SESSION['card_message']) : '';
    $_SESSION['inv_type'] = !empty($_SESSION['inv_type']) ? htmlspecialchars($_SESSION['inv_type']) : '';
    $_SESSION['inv_payee'] = isset($_SESSION['inv_payee']) ? htmlspecialchars($_SESSION['inv_payee']) : '';
    $_SESSION['inv_content'] = isset($_SESSION['inv_content']) ? htmlspecialchars($_SESSION['inv_content']) : '';
    $_SESSION['postscript'] = isset($_SESSION['postscript']) ? htmlspecialchars($_SESSION['postscript']) : '';
    $_SESSION['surplus'] = isset($_SESSION['surplus']) ? htmlspecialchars($_SESSION['surplus']) : '';
    

    
    $preorder = isset($_SESSION['flow_order']) ?$_SESSION['flow_order']:flow_order_info();
    $order = array(
        'shipping_id'     => $preorder['shipping_id'],
        'pay_id'          => $preorder['pay_id'],
        'pack_id'         => isset($_SESSION['pack']) ? intval($_SESSION['pack']) : 0,
        'card_id'         => isset($_SESSION['card']) ? intval($_SESSION['card']) : 0,
        'card_message'    => trim($_SESSION['card_message']),
        'surplus'         => isset($_SESSION['surplus']) ? floatval($_SESSION['surplus']) : 0.00,
        'integral'        => isset($_SESSION['integral']) ? intval($_SESSION['integral']) : 0,
        'bonus_id'        => isset($preorder['bonus_id']) ? intval($preorder['bonus_id']) : 0,
        'need_inv'        => empty($_SESSION['need_inv']) ? 0 : 1,
        'inv_type'        => $_SESSION['inv_type'],
        'inv_payee'       => trim($_SESSION['inv_payee']),
        'inv_content'     => $_SESSION['inv_content'],
        'postscript'      => trim($_SESSION['postscript']),
        'how_oos'         => isset($_LANG['oos'][$_SESSION['how_oos']]) ? addslashes($_LANG['oos'][$_SESSION['how_oos']]) : '',
        'need_insure'     => isset($_SESSION['need_insure']) ? intval($_SESSION['need_insure']) : 0,
        'user_id'         => GLogin::id(),
        'add_time'        => gmtime(),
        'order_status'    => OS_UNCONFIRMED,
        'shipping_status' => SS_UNSHIPPED,
        'pay_status'      => PS_UNPAYED,
        'agency_id'       => get_agency_by_regions(array($consignee['country'], $consignee['province'], $consignee['city'], $consignee['district']))
        );
    
//   print_r($order);exit();
//    var_dump($order);exit();
    /* 扩展信息 */
    if (isset($_SESSION['flow_type']) && intval($_SESSION['flow_type']) != CART_GENERAL_GOODS)
    {
        $order['extension_code'] = $_SESSION['extension_code'];
        $order['extension_id'] = $_SESSION['extension_id'];
    }
    else
    {
        $order['extension_code'] = '';
        $order['extension_id'] = 0;
    }

    /* 检查积分余额是否合� */
    $user_id = GLogin::id();
    if ($user_id > 0)
    {
        $user_info = user_info($user_id);

        $order['surplus'] = min($order['surplus'], $user_info['user_money'] + $user_info['credit_line']);
        if ($order['surplus'] < 0)
        {
            $order['surplus'] = 0;
        }

        // 查�?用户有�?少积�
        $flow_points = flow_available_points();  // 该�?单允许使用的�?��
        $user_points = $user_info['pay_points']; // 用户的积分总数

        $order['integral'] = min($order['integral'], $user_points, $flow_points);
        if ($order['integral'] < 0)
        {
            $order['integral'] = 0;
        }
    }
    else
    {
        $order['surplus']  = 0;
        $order['integral'] = 0;
    }

    /* 检查红包是否存� */
    if ($order['bonus_id'] > 0)
    {
        $bonus = bonus_info($order['bonus_id']);

        if (empty($bonus) || $bonus['user_id'] != $user_id || $bonus['order_id'] > 0 || $bonus['min_goods_amount'] > cart_amount(true, $flow_type))
        {
            $order['bonus_id'] = 0;
        }
    }
    elseif (isset($_POST['bonus_sn']))
    {
        $bonus_sn = trim($_POST['bonus_sn']);
        $bonus = bonus_info(0, $bonus_sn);
        $now = gmtime();
        if (empty($bonus) || $bonus['user_id'] > 0 || $bonus['order_id'] > 0 || $bonus['min_goods_amount'] > cart_amount(true, $flow_type) || $now > $bonus['use_end_date'])
        {
        }
        else
        {
            if ($user_id > 0)
            {
                $sql = "UPDATE " . $ecs->table('user_bonus') . " SET user_id = '$user_id' WHERE bonus_id = '$bonus[bonus_id]' LIMIT 1";
                $db->query($sql);
            }
            $order['bonus_id'] = $bonus['bonus_id'];
            $order['bonus_sn'] = $bonus_sn;
        }
    }

    /* 订单�?��商品 */
    $cart_goods = cart_goods($flow_type);

    if (empty($cart_goods))
    {
        show_message($_LANG['no_goods_in_cart'], $_LANG['back_home'], './', 'warning');
    }

    /* 检查商品总�?�?��达到最低限�?��� */
    if ($flow_type == CART_GENERAL_GOODS && cart_amount(true, CART_GENERAL_GOODS) < $_CFG['min_goods_amount'])
    {
        show_message(sprintf($_LANG['goods_amount_not_enough'], price_format($_CFG['min_goods_amount'], false)));
    }

    /* 收货人信� */
    foreach ($consignee as $key => $value)
    {
        $order[$key] = addslashes($value);
    }

   /* 判断�?���?��体商� */
    foreach ($cart_goods AS $val)
    {
        /* 统�?实体商品的个� */
        if ($val['is_real'])
        {
            $is_real_good=1;
        }
    }
    if(isset($is_real_good))
    {
        $sql="SELECT shipping_id FROM " . $ecs->table('shipping') . " WHERE shipping_id=".$order['shipping_id'] ." AND enabled =1"; 
        if(!$db->getOne($sql))
        {
            
           show_message($_LANG['flow_no_shipping']);
        }
    }
    /* 订单�?��总�? */
    $total = order_fee($order, $cart_goods, $consignee);
    $order['bonus']        = $total['bonus'];
    $order['goods_amount'] = $total['goods_price'];
    $order['discount']     = $total['discount'];
    $order['surplus']      = $total['surplus'];
    $order['tax']          = $total['tax'];

    // �?��车中的商品能�?��红包�?��的总�?
    $discount_amout = compute_discount_amount();
    // 红包和积分最多能�?��的金额为商品总�?
    $temp_amout = $order['goods_amount'] - $discount_amout;
    if ($temp_amout <= 0)
    {
        $order['bonus_id'] = 0;
    }

    /* 配送方� */
    if ($order['shipping_id'] > 0)
    {
        $shipping = shipping_info($order['shipping_id']);
        $order['shipping_name'] = addslashes($shipping['shipping_name']);
        
        
       // print_r($total['shipping_fee']);
        
        if(  "error"  === $total['shipping_fee'] ) //检测不到运费信息 ，出错
        {
            var_dump($total['shipping_fee']);exit();
            $message  = print_r($total,true);
            $message .= print_r($consignee,true);
            $message .= print_r($order,true);
            $message .= print_r($cart_goods,true);
            GLog::log('shipping',$message);
            show_message( "很抱歉，运费选择出错，请联系客服，给您带来的不便尽请谅解" );
        }
        
    }
    $order['shipping_fee'] = $total['shipping_fee'];
    $order['insure_fee']   = $total['shipping_insure'];

    /* �?��方式 */
    if ($order['pay_id'] > 0)
    {
        $payment = payment_info($order['pay_id']);
        $order['pay_name'] = addslashes($payment['pay_name']);
    }
    $order['pay_fee'] = $total['pay_fee'];
    $order['cod_fee'] = $total['cod_fee'];

    /* 商品包�? */
    if ($order['pack_id'] > 0)
    {
        $pack               = pack_info($order['pack_id']);
        $order['pack_name'] = addslashes($pack['pack_name']);
    }
    $order['pack_fee'] = $total['pack_fee'];

    /* 祝�?贺卡 */
    if ($order['card_id'] > 0)
    {
        $card               = card_info($order['card_id']);
        $order['card_name'] = addslashes($card['card_name']);
    }
    $order['card_fee']      = $total['card_fee'];

    $order['order_amount']  = number_format($total['amount'], 2, '.', '');

    /* 如果全部使用余�?�?��，�?查余额是否足� */
    if ($payment['pay_code'] == 'balance' && $order['order_amount'] > 0)
    {
        if($order['surplus'] >0) //余�?�?��里�?果输入了一�?���
        {
            $order['order_amount'] = $order['order_amount'] + $order['surplus'];
            $order['surplus'] = 0;
        }
        if ($order['order_amount'] > ($user_info['user_money'] + $user_info['credit_line']))
        {
            show_message($_LANG['balance_not_enough']);
        }
        else
        {
            $order['surplus'] = $order['order_amount'];
            $order['order_amount'] = 0;
        }
    }

    /* 如果订单金�?�?（使用余额或�?��或红包支付），修改�?单状态为已确认、已付�? */
    if ($order['order_amount'] <= 0)
    {
        $order['order_status'] = OS_CONFIRMED;
        $order['confirm_time'] = gmtime();
        $order['pay_status']   = PS_PAYED;
        $order['pay_time']     = gmtime();
        $order['order_amount'] = 0;
    }

    $order['integral_money']   = $total['integral_money'];
    $order['integral']         = $total['integral'];

    if ($order['extension_code'] == 'exchange_goods')
    {
        $order['integral_money']   = 0;
        $order['integral']         = $total['exchange_integral'];
    }

    $order['from_ad']          = !empty($_SESSION['from_ad']) ? $_SESSION['from_ad'] : '0';
    $order['referer']          = !empty($_SESSION['referer']) ? addslashes($_SESSION['referer']) : '';

    /* 记录扩展信息 */
    if ($flow_type != CART_GENERAL_GOODS)
    {
        $order['extension_code'] = $_SESSION['extension_code'];
        $order['extension_id'] = $_SESSION['extension_id'];
    }

    $affiliate = unserialize($_CFG['affiliate']);
    if(isset($affiliate['on']) && $affiliate['on'] == 1 && $affiliate['config']['separate_by'] == 1)
    {
        //推荐订单分成
        $parent_id = get_affiliate();
        if($user_id == $parent_id)
        {
            $parent_id = 0;
        }
    }
    elseif(isset($affiliate['on']) && $affiliate['on'] == 1 && $affiliate['config']['separate_by'] == 0)
    {
        //推荐注册分成
        $parent_id = 0;
    }
    else
    {
        //分成功能关闭
        $parent_id = 0;
    }
    $order['parent_id'] = $parent_id;

    /* 插入订单� */
    $error_no = 0;
    do
    {
        $order['order_sn'] = get_order_sn(); //获取新�?单号
        $GLOBALS['db']->autoExecute($GLOBALS['ecs']->table('order_info'), $order, 'INSERT');

        $error_no = $GLOBALS['db']->errno();

        if ($error_no > 0 && $error_no != 1062)
        {
            die($GLOBALS['db']->errorMsg());
        }
    }
    while ($error_no == 1062); //如果�??单号重�?则重新提交数�

    $new_order_id = $db->insert_id();
    $order['order_id'] = $new_order_id;

    /* 插入订单商品 */
    $sql = "INSERT INTO " . $ecs->table('order_goods') . "( " .
                "order_id, goods_id, goods_name, goods_sn, product_id, goods_number, market_price, ".
                "goods_price, goods_attr, is_real, extension_code, parent_id, is_gift, goods_attr_id) ".
            " SELECT '$new_order_id', goods_id, goods_name, goods_sn, product_id, goods_number, market_price, ".
                "goods_price, goods_attr, is_real, extension_code, parent_id, is_gift, goods_attr_id".
            " FROM " .$ecs->table('cart') .
            " WHERE session_id = '".SESS_ID."' AND rec_type = '$flow_type'";
    $db->query($sql);
    /* �?��拍卖活动状� */
    if ($order['extension_code']=='auction')
    {
        $sql = "UPDATE ". $ecs->table('goods_activity') ." SET is_finished='2' WHERE act_id=".$order['extension_id'];
        $db->query($sql);
    }

    /* 处理余�?、积分、红� */
    if ($order['user_id'] > 0 && $order['surplus'] > 0)
    {
        log_account_change($order['user_id'], $order['surplus'] * (-1), 0, 0, 0, sprintf($_LANG['pay_order'], $order['order_sn']));
    }
    if ($order['user_id'] > 0 && $order['integral'] > 0)
    {
        log_account_change($order['user_id'], 0, 0, 0, $order['integral'] * (-1), sprintf($_LANG['pay_order'], $order['order_sn']));
    }


    if ($order['bonus_id'] > 0 && $temp_amout > 0)
    {
        use_bonus($order['bonus_id'], $new_order_id);
    }

    /* 如果使用库存，且下�?单时减库存，则减少库� */
    if ($_CFG['use_storage'] == '1' && $_CFG['stock_dec_time'] == SDT_PLACE)
    {
        change_order_goods_storage($order['order_id'], true, SDT_PLACE);
    }

    /* 给商家发�?�� */
    /* 增加�?��给�?服发送邮件选项 */
    if ($_CFG['send_service_email'] && $_CFG['service_email'] != '')
    {
        $tpl = get_mail_template('remind_of_new_order');
        $smarty->assign('order', $order);
        $smarty->assign('goods_list', $cart_goods);
        $smarty->assign('shop_name', $_CFG['shop_name']);
        $smarty->assign('send_date', date($_CFG['time_format']));
        $content = $smarty->fetch('str:' . $tpl['template_content']);
        send_mail($_CFG['shop_name'], $_CFG['service_email'], $tpl['template_subject'], $content, $tpl['is_html']);
    }

    /* 如果需要，发短� */
    if ($_CFG['sms_order_placed'] == '1' && $_CFG['sms_shop_mobile'] != '')
    {
        include_once('includes/cls_sms.php');
        $sms = new sms();
        $msg = $order['pay_status'] == PS_UNPAYED ?
            $_LANG['order_placed_sms'] : $_LANG['order_placed_sms'] . '[' . $_LANG['sms_paid'] . ']';
        $sms->send($_CFG['sms_shop_mobile'], sprintf($msg, $order['consignee'], $order['tel']),'', 13,1);
    }

    /* 如果订单金�?�? 处理虚拟� */
    if ($order['order_amount'] <= 0)
    {
        $sql = "SELECT goods_id, goods_name, goods_number AS num FROM ".
               $GLOBALS['ecs']->table('cart') .
                " WHERE is_real = 0 AND extension_code = 'virtual_card'".
                " AND session_id = '".SESS_ID."' AND rec_type = '$flow_type'";

        $res = $GLOBALS['db']->getAll($sql);

        $virtual_goods = array();
        foreach ($res AS $row)
        {
            $virtual_goods['virtual_card'][] = array('goods_id' => $row['goods_id'], 'goods_name' => $row['goods_name'], 'num' => $row['num']);
        }

        if ($virtual_goods AND $flow_type != CART_GROUP_BUY_GOODS)
        {
            /* 虚拟卡发� */
            if (virtual_goods_ship($virtual_goods,$msg, $order['order_sn'], true))
            {
                /* 如果没有实体商品，修改发货状态，送积分和红包 */
                $sql = "SELECT COUNT(*)" .
                        " FROM " . $ecs->table('order_goods') .
                        " WHERE order_id = '$order[order_id]' " .
                        " AND is_real = 1";
                if ($db->getOne($sql) <= 0)
                {
                    /* �?��订单状� */
                    update_order($order['order_id'], array('shipping_status' => SS_SHIPPED, 'shipping_time' => gmtime()));

                    /* 如果订单用户不为空，计算�?��，并发给用户；发红包 */
                    if ($order['user_id'] > 0)
                    {
                        /* 取得用户信息 */
                        $user = user_info($order['user_id']);

                        /* 计算并发放积� */
                        $integral = integral_to_give($order);
                        log_account_change($order['user_id'], 0, 0, intval($integral['rank_points']), intval($integral['custom_points']), sprintf($_LANG['order_gift_integral'], $order['order_sn']));

                        /* 发放红包 */
                        send_order_bonus($order['order_id']);
                    }
                }
            }
        }

    }

    /* 清空�?��� */
    clear_cart($flow_type);
    /* 清除缓存，否则买了商品，但是前台页面读取缓存，商品数量不减少 */
    clear_all_files();

    /* 插入�?��日志 */
    $order['log_id'] = insert_pay_log($new_order_id, $order['order_amount'], PAY_ORDER);

    /* 取得�?��信息，生成支付代� */
    if ($order['order_amount'] > 0)
    {
        $payment = payment_info($order['pay_id']);

        include_once('includes/modules/payment/' . $payment['pay_code'] . '.php');

        $pay_obj    = new $payment['pay_code'];

        $pay_online = $pay_obj->get_code($order, unserialize_config($payment['pay_config']));
        
   //     header("Location:$pay_online");

        $order['pay_desc'] = $payment['pay_desc'];

        $smarty->assign('pay_online', $pay_online);
    }
    if(!empty($order['shipping_name']))
    {
        $order['shipping_name']=trim(stripcslashes($order['shipping_name']));
    }

    /* 订单信息 */
    $smarty->assign('order',      $order);
    $smarty->assign('total',      $total);
    $smarty->assign('goods_list', $cart_goods);
    $smarty->assign('order_submit_back', sprintf($_LANG['order_submit_back'], $_LANG['back_home'], $_LANG['goto_user_center'])); // 返回提示

    user_uc_call('add_feed', array($order['order_id'], BUY_GOODS)); //推送feed到uc
    unset($_SESSION['flow_consignee']); // 清除session�?��存的收货人信�
    unset($_SESSION['flow_order']);
    unset($_SESSION['direct_shopping']);

    $smarty->assign('currency_format', $_CFG['currency_format']);
    $smarty->assign('integral_scale',  $_CFG['integral_scale']);
    $smarty->assign('step',            $_REQUEST['step']);
    assign_dynamic('shopping_flow');

    $smarty->display('flow.dwt');
    
    
}




/*获取payment name*/
function get_payment_name($id)
{
      $sql = 'SELECT pay_name' .
            ' FROM ' . $GLOBALS['ecs']->table('payment') .
            ' WHERE enabled = 1 and pay_id='.$id;
     $name = $GLOBALS['db']->getOne($sql);
     return $name;
}
/*获取shipment name*/
function get_shipping_name($id)
{
      $sql = 'SELECT shipping_name' .
            ' FROM ' . $GLOBALS['ecs']->table('shipping') .
            ' WHERE shipping_id='.$id;
     $name = $GLOBALS['db']->getOne($sql);
     return $name;
}

/*查询运费*/

function calculate_shiping_pay($shipid,$region)
{
    $shipping_info = shipping_area_info($shipid, $region);
    $order = flow_order_info();
    if (!empty($shipping_info))
    {
        if ($order['extension_code'] == 'group_buy')
        {
            $weight_price = cart_weight_price(CART_GROUP_BUY_GOODS);
        }
        else
        {
            $weight_price = cart_weight_price();
        }

        // 查看购物车中是否全为免运费商品，若是则把运费赋为零
        $sql = 'SELECT count(*) FROM ' . $GLOBALS['ecs']->table('cart') . " WHERE  `session_id` = '" . SESS_ID. "' AND `extension_code` != 'package_buy' AND `is_shipping` = 0";
        $shipping_count = $GLOBALS['db']->getOne($sql);

       $real_fee = ($shipping_count == 0 AND $weight_price['free_shipping'] == 1) ?0 :  shipping_fee($shipping_info['shipping_code'],$shipping_info['configure'], $weight_price['weight'], $weight_price['amount'], $weight_price['number']);
       return $real_fee;
    }
    else{
        return 0;
      //  var_dump($shipid);
      //  var_dump($region);
      //  var_dump($order);
      //  die("function:calculate_shiping_pay error");
    }
}
/*------------------------------------------------------ */
//-- PRIVATE FUNCTION
/*------------------------------------------------------ */

/**
 * 获得用户的可用积�
 *
 * @access  private
 * @return  integral
 */
function flow_available_points()
{
    $sql = "SELECT SUM(g.integral * c.goods_number) ".
            "FROM " . $GLOBALS['ecs']->table('cart') . " AS c, " . $GLOBALS['ecs']->table('goods') . " AS g " .
            "WHERE c.session_id = '" . SESS_ID . "' AND c.goods_id = g.goods_id AND c.is_gift = 0 AND g.integral > 0 " .
            "AND c.rec_type = '" . CART_GENERAL_GOODS . "'";

    $val = intval($GLOBALS['db']->getOne($sql));

    return integral_of_value($val);
}

/**
 * 更新�?��车中的商品数�
 *
 * @access  public
 * @param   array   $arr
 * @return  void
 */
function flow_update_cart($arr)
{
    /* 处理 */
    foreach ($arr AS $key => $val)
    {
        $val = intval(make_semiangle($val));
        if ($val <= 0 && !is_numeric($key))
        {
            continue;
        }

        //查�?�
        $sql = "SELECT `goods_id`, `goods_attr_id`, `product_id`, `extension_code` FROM" .$GLOBALS['ecs']->table('cart').
               " WHERE rec_id='$key' AND session_id='" . SESS_ID . "'";
        $goods = $GLOBALS['db']->getRow($sql);

        $sql = "SELECT g.goods_name, g.goods_number ".
                "FROM " .$GLOBALS['ecs']->table('goods'). " AS g, ".
                    $GLOBALS['ecs']->table('cart'). " AS c ".
                "WHERE g.goods_id = c.goods_id AND c.rec_id = '$key'";
        $row = $GLOBALS['db']->getRow($sql);

        //查�?：系统启用了库存，�?查输入的商品数量�?��有效
        if (intval($GLOBALS['_CFG']['use_storage']) > 0 && $goods['extension_code'] != 'package_buy')
        {
            if ($row['goods_number'] < $val)
            {
                show_message(sprintf($GLOBALS['_LANG']['stock_insufficiency'], $row['goods_name'],
                $row['goods_number'], $row['goods_number']));
                exit;
            }
            /* �?��� */
            $goods['product_id'] = trim($goods['product_id']);
            if (!empty($goods['product_id']))
            {
                $sql = "SELECT product_number FROM " .$GLOBALS['ecs']->table('products'). " WHERE goods_id = '" . $goods['goods_id'] . "' AND product_id = '" . $goods['product_id'] . "'";

                $product_number = $GLOBALS['db']->getOne($sql);
                if ($product_number < $val)
                {
                    show_message(sprintf($GLOBALS['_LANG']['stock_insufficiency'], $row['goods_name'],
                    $product_number['product_number'], $product_number['product_number']));
                    exit;
                }
            }
        }
        elseif (intval($GLOBALS['_CFG']['use_storage']) > 0 && $goods['extension_code'] == 'package_buy')
        {
            if (judge_package_stock($goods['goods_id'], $val))
            {
                show_message($GLOBALS['_LANG']['package_stock_insufficiency']);
                exit;
            }
        }

        /* 查�?：�?查�?项是否为基本� 以及�?��存在配件 */
        /* 此�?配件�?��添加商品时附加的并且�??�?��优惠价格的配� 此类配件都有parent_id goods_number�? */
        $sql = "SELECT b.goods_number, b.rec_id
                FROM " .$GLOBALS['ecs']->table('cart') . " a, " .$GLOBALS['ecs']->table('cart') . " b
                WHERE a.rec_id = '$key'
                AND a.session_id = '" . SESS_ID . "'
                AND a.extension_code <> 'package_buy'
                AND b.parent_id = a.goods_id
                AND b.session_id = '" . SESS_ID . "'";

        $offers_accessories_res = $GLOBALS['db']->query($sql);

        //订货数量大于0
        if ($val > 0)
        {
            /* 判断�?��为超出数量的优惠价格的配� 删除*/
            $row_num = 1;
            while ($offers_accessories_row = $GLOBALS['db']->fetchRow($offers_accessories_res))
            {
                if ($row_num > $val)
                {
                    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('cart') .
                            " WHERE session_id = '" . SESS_ID . "' " .
                            "AND rec_id = '" . $offers_accessories_row['rec_id'] ."' LIMIT 1";
                    $GLOBALS['db']->query($sql);
                }

                $row_num ++;
            }

            /* 处理超值礼� */
            if ($goods['extension_code'] == 'package_buy')
            {
                //更新�?��车中的商品数�
                $sql = "UPDATE " .$GLOBALS['ecs']->table('cart').
                        " SET goods_number = '$val' WHERE rec_id='$key' AND session_id='" . SESS_ID . "'";
            }
            /* 处理�?��商品或非优惠的配件 */
            else
            {
                $attr_id    = empty($goods['goods_attr_id']) ? array() : explode(',', $goods['goods_attr_id']);
                $goods_price = get_final_price($goods['goods_id'], $val, true, $attr_id);

                //更新�?��车中的商品数�
                $sql = "UPDATE " .$GLOBALS['ecs']->table('cart').
                        " SET goods_number = '$val', goods_price = '$goods_price' WHERE rec_id='$key' AND session_id='" . SESS_ID . "'";
            }
        }
        //订货数量等于0
        else
        {
            /* 如果�?���?��并且有优惠价格的配件则删除优惠价格的配件 */
            while ($offers_accessories_row = $GLOBALS['db']->fetchRow($offers_accessories_res))
            {
                $sql = "DELETE FROM " . $GLOBALS['ecs']->table('cart') .
                        " WHERE session_id = '" . SESS_ID . "' " .
                        "AND rec_id = '" . $offers_accessories_row['rec_id'] ."' LIMIT 1";
                $GLOBALS['db']->query($sql);
            }

            $sql = "DELETE FROM " .$GLOBALS['ecs']->table('cart').
                " WHERE rec_id='$key' AND session_id='" .SESS_ID. "'";
        }

        $GLOBALS['db']->query($sql);
    }

    /* 删除所有赠� */
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('cart') . " WHERE session_id = '" .SESS_ID. "' AND is_gift <> 0";
    $GLOBALS['db']->query($sql);
}

/**
 * 检查�?单中商品库存
 *
 * @access  public
 * @param   array   $arr
 *
 * @return  void
 */
function flow_cart_stock($arr)
{
    foreach ($arr AS $key => $val)
    {
        $val = intval(make_semiangle($val));
        if ($val <= 0)
        {
            continue;
        }

        $sql = "SELECT `goods_id`, `goods_attr_id`, `extension_code` FROM" .$GLOBALS['ecs']->table('cart').
               " WHERE rec_id='$key' AND session_id='" . SESS_ID . "'";
        $goods = $GLOBALS['db']->getRow($sql);

        $sql = "SELECT g.goods_name, g.goods_number, c.product_id ".
                "FROM " .$GLOBALS['ecs']->table('goods'). " AS g, ".
                    $GLOBALS['ecs']->table('cart'). " AS c ".
                "WHERE g.goods_id = c.goods_id AND c.rec_id = '$key'";
        $row = $GLOBALS['db']->getRow($sql);

        //系统�?��了库存，检查输入的商品数量�?��有效
        if (intval($GLOBALS['_CFG']['use_storage']) > 0 && $goods['extension_code'] != 'package_buy')
        {
            if ($row['goods_number'] < $val)
            {
                show_message(sprintf($GLOBALS['_LANG']['stock_insufficiency'], $row['goods_name'],
                $row['goods_number'], $row['goods_number']));
                exit;
            }

            /* �?��� */
            $row['product_id'] = trim($row['product_id']);
            if (!empty($row['product_id']))
            {
                $sql = "SELECT product_number FROM " .$GLOBALS['ecs']->table('products'). " WHERE goods_id = '" . $goods['goods_id'] . "' AND product_id = '" . $row['product_id'] . "'";
                $product_number = $GLOBALS['db']->getOne($sql);
                if ($product_number < $val)
                {
                    show_message(sprintf($GLOBALS['_LANG']['stock_insufficiency'], $row['goods_name'],
                    $row['goods_number'], $row['goods_number']));
                    exit;
                }
            }
        }
        elseif (intval($GLOBALS['_CFG']['use_storage']) > 0 && $goods['extension_code'] == 'package_buy')
        {
            if (judge_package_stock($goods['goods_id'], $val))
            {
                show_message($GLOBALS['_LANG']['package_stock_insufficiency']);
                exit;
            }
        }
    }

}

/**
 * 删除�?��车中的商�
 *
 * @access  public
 * @param   integer $id
 * @return  void
 */
function flow_drop_cart_goods($id)
{
    /* 取得商品id */
    $sql = "SELECT * FROM " .$GLOBALS['ecs']->table('cart'). " WHERE rec_id = '$id'";
    $row = $GLOBALS['db']->getRow($sql);
    if ($row)
    {
        //如果�?��值礼�
        if ($row['extension_code'] == 'package_buy')
        {
            $sql = "DELETE FROM " . $GLOBALS['ecs']->table('cart') .
                    " WHERE session_id = '" . SESS_ID . "' " .
                    "AND rec_id = '$id' LIMIT 1";
        }

        //如果�?��通商品，同时删除所有赠品及其配�
        elseif ($row['parent_id'] == 0 && $row['is_gift'] == 0)
        {
            /* 检查购物车�??�?��商品的不可单独销�?��配件并删� */
            $sql = "SELECT c.rec_id
                    FROM " . $GLOBALS['ecs']->table('cart') . " AS c, " . $GLOBALS['ecs']->table('group_goods') . " AS gg, " . $GLOBALS['ecs']->table('goods'). " AS g
                    WHERE gg.parent_id = '" . $row['goods_id'] . "'
                    AND c.goods_id = gg.goods_id
                    AND c.parent_id = '" . $row['goods_id'] . "'
                    AND c.extension_code <> 'package_buy'
                    AND gg.goods_id = g.goods_id
                    AND g.is_alone_sale = 0";
            $res = $GLOBALS['db']->query($sql);
            $_del_str = $id . ',';
            while ($id_alone_sale_goods = $GLOBALS['db']->fetchRow($res))
            {
                $_del_str .= $id_alone_sale_goods['rec_id'] . ',';
            }
            $_del_str = trim($_del_str, ',');

            $sql = "DELETE FROM " . $GLOBALS['ecs']->table('cart') .
                    " WHERE session_id = '" . SESS_ID . "' " .
                    "AND (rec_id IN ($_del_str) OR parent_id = '$row[goods_id]' OR is_gift <> 0)";
        }

        //如果不是�?��商品，�?��除�?商品即可
        else
        {
            $sql = "DELETE FROM " . $GLOBALS['ecs']->table('cart') .
                    " WHERE session_id = '" . SESS_ID . "' " .
                    "AND rec_id = '$id' LIMIT 1";
        }

        $GLOBALS['db']->query($sql);
    }

    flow_clear_cart_alone();
}

/**
 * 删除�?��车中不能单独销�?��商品
 *
 * @access  public
 * @return  void
 */
function flow_clear_cart_alone()
{
    /* 查�?：购物车�?��有不�?��单独销�?��配件 */
    $sql = "SELECT c.rec_id, gg.parent_id
            FROM " . $GLOBALS['ecs']->table('cart') . " AS c
                LEFT JOIN " . $GLOBALS['ecs']->table('group_goods') . " AS gg ON c.goods_id = gg.goods_id
                LEFT JOIN" . $GLOBALS['ecs']->table('goods') . " AS g ON c.goods_id = g.goods_id
            WHERE c.session_id = '" . SESS_ID . "'
            AND c.extension_code <> 'package_buy'
            AND gg.parent_id > 0
            AND g.is_alone_sale = 0";
    $res = $GLOBALS['db']->query($sql);
    $rec_id = array();
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $rec_id[$row['rec_id']][] = $row['parent_id'];
    }

    if (empty($rec_id))
    {
        return;
    }

    /* 查�?：购物车�?��有商� */
    $sql = "SELECT DISTINCT goods_id
            FROM " . $GLOBALS['ecs']->table('cart') . "
            WHERE session_id = '" . SESS_ID . "'
            AND extension_code <> 'package_buy'";
    $res = $GLOBALS['db']->query($sql);
    $cart_good = array();
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $cart_good[] = $row['goods_id'];
    }

    if (empty($cart_good))
    {
        return;
    }

    /* 如果�?��车中不可以单�?���?��件的基本件不存在则删除�?配件 */
    $del_rec_id = '';
    foreach ($rec_id as $key => $value)
    {
        foreach ($value as $v)
        {
            if (in_array($v, $cart_good))
            {
                continue 2;
            }
        }

        $del_rec_id = $key . ',';
    }
    $del_rec_id = trim($del_rec_id, ',');

    if ($del_rec_id == '')
    {
        return;
    }

    /* 删除 */
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('cart') ."
            WHERE session_id = '" . SESS_ID . "'
            AND rec_id IN ($del_rec_id)";
    $GLOBALS['db']->query($sql);
}

/**
 * 比较优惠活动的函数，用于排序（把�?��的排在前�?��
 * @param   array   $a      优惠活动a
 * @param   array   $b      优惠活动b
 * @return  int     相等返回0，小于返�?1，大于返�?
 */
function cmp_favourable($a, $b)
{
    if ($a['available'] == $b['available'])
    {
        if ($a['sort_order'] == $b['sort_order'])
        {
            return 0;
        }
        else
        {
            return $a['sort_order'] < $b['sort_order'] ? -1 : 1;
        }
    }
    else
    {
        return $a['available'] ? -1 : 1;
    }
}

/**
 * 取得某用户等级当前时间可以享受的优惠活动
 * @param   int     $user_rank      用户等级id�?表示非会�
 * @return  array
 */
function favourable_list($user_rank)
{
    /* �?��车中已有的优惠活动及数量 */
    $used_list = cart_favourable();

    /* 当前用户�?��受的优惠活动 */
    $favourable_list = array();
    $user_rank = ',' . $user_rank . ',';
    $now = gmtime();
    $sql = "SELECT * " .
            "FROM " . $GLOBALS['ecs']->table('favourable_activity') .
            " WHERE CONCAT(',', user_rank, ',') LIKE '%" . $user_rank . "%'" .
            " AND start_time <= '$now' AND end_time >= '$now'" .
            " AND act_type = '" . FAT_GOODS . "'" .
            " ORDER BY sort_order";
    $res = $GLOBALS['db']->query($sql);
    while ($favourable = $GLOBALS['db']->fetchRow($res))
    {
        $favourable['start_time'] = local_date($GLOBALS['_CFG']['time_format'], $favourable['start_time']);
        $favourable['end_time']   = local_date($GLOBALS['_CFG']['time_format'], $favourable['end_time']);
        $favourable['formated_min_amount'] = price_format($favourable['min_amount'], false);
        $favourable['formated_max_amount'] = price_format($favourable['max_amount'], false);
        $favourable['gift']       = unserialize($favourable['gift']);

        foreach ($favourable['gift'] as $key => $value)
        {
            $favourable['gift'][$key]['formated_price'] = price_format($value['price'], false);
            $sql = "SELECT COUNT(*) FROM " . $GLOBALS['ecs']->table('goods') . " WHERE is_on_sale = 1 AND goods_id = ".$value['id'];
            $is_sale = $GLOBALS['db']->getOne($sql);
            if(!$is_sale)
            {
                unset($favourable['gift'][$key]);
            }
        }

        $favourable['act_range_desc'] = act_range_desc($favourable);
        $favourable['act_type_desc'] = sprintf($GLOBALS['_LANG']['fat_ext'][$favourable['act_type']], $favourable['act_type_ext']);

        /* �?��能享� */
        $favourable['available'] = favourable_available($favourable);
        if ($favourable['available'])
        {
            /* �?��尚未�?�� */
            $favourable['available'] = !favourable_used($favourable, $used_list);
        }

        $favourable_list[] = $favourable;
    }

    return $favourable_list;
}

/**
 * 根据�?��车判�?��否可以享受某优惠活动
 * @param   array   $favourable     优惠活动信息
 * @return  bool
 */
function favourable_available($favourable)
{
    /* 会员等级�?��符合 */
    $user_rank = GLogin::rank();
    if (strpos(',' . $favourable['user_rank'] . ',', ',' . $user_rank . ',') === false)
    {
        return false;
    }

    /* 优惠范围内的商品总�? */
    $amount = cart_favourable_amount($favourable);

    /* 金�?上限�?表示没有上限 */
    return $amount >= $favourable['min_amount'] &&
        ($amount <= $favourable['max_amount'] || $favourable['max_amount'] == 0);
}

/**
 * 取得优惠范围描述
 * @param   array   $favourable     优惠活动
 * @return  string
 */
function act_range_desc($favourable)
{
    if ($favourable['act_range'] == FAR_BRAND)
    {
        $sql = "SELECT brand_name FROM " . $GLOBALS['ecs']->table('brand') .
                " WHERE brand_id " . db_create_in($favourable['act_range_ext']);
        return join(',', $GLOBALS['db']->getCol($sql));
    }
    elseif ($favourable['act_range'] == FAR_CATEGORY)
    {
        $sql = "SELECT cat_name FROM " . $GLOBALS['ecs']->table('category') .
                " WHERE cat_id " . db_create_in($favourable['act_range_ext']);
        return join(',', $GLOBALS['db']->getCol($sql));
    }
    elseif ($favourable['act_range'] == FAR_GOODS)
    {
        $sql = "SELECT goods_name FROM " . $GLOBALS['ecs']->table('goods') .
                " WHERE goods_id " . db_create_in($favourable['act_range_ext']);
        return join(',', $GLOBALS['db']->getCol($sql));
    }
    else
    {
        return '';
    }
}

/**
 * 取得�?��车中已有的优惠活动及数量
 * @return  array
 */
function cart_favourable()
{
    $list = array();
    $sql = "SELECT is_gift, COUNT(*) AS num " .
            "FROM " . $GLOBALS['ecs']->table('cart') .
            " WHERE session_id = '" . SESS_ID . "'" .
            " AND rec_type = '" . CART_GENERAL_GOODS . "'" .
            " AND is_gift > 0" .
            " GROUP BY is_gift";
    $res = $GLOBALS['db']->query($sql);
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $list[$row['is_gift']] = $row['num'];
    }

    return $list;
}

/**
 * �?��车中�?��已经有某优惠
 * @param   array   $favourable     优惠活动
 * @param   array   $cart_favourable�?��车中已有的优惠活动及数量
 */
function favourable_used($favourable, $cart_favourable)
{
    if ($favourable['act_type'] == FAT_GOODS)
    {
        return isset($cart_favourable[$favourable['act_id']]) &&
            $cart_favourable[$favourable['act_id']] >= $favourable['act_type_ext'] &&
            $favourable['act_type_ext'] > 0;
    }
    else
    {
        return isset($cart_favourable[$favourable['act_id']]);
    }
}

/**
 * 添加优惠活动（赠品）到购物车
 * @param   int     $act_id     优惠活动id
 * @param   int     $id         赠品id
 * @param   float   $price      赠品价格
 */
function add_gift_to_cart($act_id, $id, $price)
{
    $sql = "INSERT INTO " . $GLOBALS['ecs']->table('cart') . " (" .
                "user_id, session_id, goods_id, goods_sn, goods_name, market_price, goods_price, ".
                "goods_number, is_real, extension_code, parent_id, is_gift, rec_type ) ".
            "SELECT '".GLogin::id()."', '" . SESS_ID . "', goods_id, goods_sn, goods_name, market_price, ".
                "'$price', 1, is_real, extension_code, 0, '$act_id', '" . CART_GENERAL_GOODS . "' " .
            "FROM " . $GLOBALS['ecs']->table('goods') .
            " WHERE goods_id = '$id'";
    $GLOBALS['db']->query($sql);
}

/**
 * 添加优惠活动（非赠品）到�?���
 * @param   int     $act_id     优惠活动id
 * @param   string  $act_name   优惠活动name
 * @param   float   $amount     优惠金�?
 */
function add_favourable_to_cart($act_id, $act_name, $amount)
{
    $sql = "INSERT INTO " . $GLOBALS['ecs']->table('cart') . "(" .
                "user_id, session_id, goods_id, goods_sn, goods_name, market_price, goods_price, ".
                "goods_number, is_real, extension_code, parent_id, is_gift, rec_type ) ".
            "VALUES('".GLogin::id()."', '" . SESS_ID . "', 0, '', '$act_name', 0, ".
                "'" . (-1) * $amount . "', 1, 0, '', 0, '$act_id', '" . CART_GENERAL_GOODS . "')";
    $GLOBALS['db']->query($sql);
}

/**
 * 取得�?��车中某优惠活动范围内的总金�
 * @param   array   $favourable     优惠活动
 * @return  float
 */
function cart_favourable_amount($favourable)
{
    /* 查�?优惠范围内商品总�?的sql */
    $sql = "SELECT SUM(c.goods_price * c.goods_number) " .
            "FROM " . $GLOBALS['ecs']->table('cart') . " AS c, " . $GLOBALS['ecs']->table('goods') . " AS g " .
            "WHERE c.goods_id = g.goods_id " .
            "AND c.session_id = '" . SESS_ID . "' " .
            "AND c.rec_type = '" . CART_GENERAL_GOODS . "' " .
            "AND c.is_gift = 0 " .
            "AND c.goods_id > 0 ";

    /* 根据优惠范围�??sql */
    if ($favourable['act_range'] == FAR_ALL)
    {
        // sql do not change
    }
    elseif ($favourable['act_range'] == FAR_CATEGORY)
    {
        /* 取得优惠范围分类的所有下级分� */
        $id_list = array();
        $cat_list = explode(',', $favourable['act_range_ext']);
        foreach ($cat_list as $id)
        {
            $id_list = array_merge($id_list, array_keys(cat_list(intval($id), 0, false)));
        }

        $sql .= "AND g.cat_id " . db_create_in($id_list);
    }
    elseif ($favourable['act_range'] == FAR_BRAND)
    {
        $id_list = explode(',', $favourable['act_range_ext']);

        $sql .= "AND g.brand_id " . db_create_in($id_list);
    }
    else
    {
        $id_list = explode(',', $favourable['act_range_ext']);

        $sql .= "AND g.goods_id " . db_create_in($id_list);
    }

    /* 优惠范围内的商品总�? */
    return $GLOBALS['db']->getOne($sql);
}
?>

