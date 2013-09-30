<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define('IN_ECS', true);
require(ROOT_PATH . '/includes/init.php');
include_once('includes/cls_json.php');
  
define(SECONDS_PER_DAY,24*60*60);


$result = array('code' => 0, 'message' => '');
$json  = new JSON;


$act = strtolower($_GET["action"]);
$lottery_table = $GLOBALS['ecs']->table('temp_lottery');
$user_table  = $GLOBALS['ecs']->table('users');

//查看最新中奖人员
if($act == 'view')
{
    $limit = 10;
    $sql = "select user_name,type_name from $lottery_table l  left join  $user_table u on l.user_id = u.user_id order by id desc limit 0,$limit";
    $res = $GLOBALS['db']->getAll($sql);
    $content = "";
    
    foreach($res as $row)
    {
        $content .= '<div class="marquee_c">恭喜<span>'. $row['user_name'] . '</span>获得<span>' .$row['type_name'] . '</span></div>';
    }
    
    $result['content'] = $content;
}
//抽奖
else if($act == 'do')
{
    //检查是否登录
    if(!GLogin::id())
    {
        $result['code'] = 1;
        $result['content'] = "请您先登录";
        die($json->encode($result));    
    }
    //检查同一天是否已经抽过奖
    //当天的timestamp
    $user_id = GLogin::id();
    $today = strtotime( date('Y-m-d',time()) );
    $do_times = $GLOBALS['db']->getOne("select count(*) from $lottery_table  where user_id = $user_id  and time >  $today ");
    if($do_times > 0)
    {
        $result['code'] = 1;
        $result['content'] = "您今天已经抽过奖了,请您明天再来";
        die($json->encode($result));    
    }
    //检查 禁止使用代理登陆
    if(is_proxy())
    {
        $result['code'] = 1;
        $result['content'] = "请勿使用代理访问";
        die($json->encode($result));  
    }
    //检查同一ip 一天最多不能超过5次
    $ip = $_SERVER['REMOTE_ADDR'];
    isset($ip) || $ip = "";
    $ip_times = $GLOBALS['db']->getOne("select count(*) from $lottery_table  where ip = '$ip'  and time >  $today ");
    if($ip_times > 5)
    {
        $result['code'] = 1;
        $result['content'] = "该ip的用户已经超过限制，请您明天再试";
        die($json->encode($result));    
    }

    //开始抽奖
    //生成随机数 
    $gifts = array(
         10 => '365好朋友卷',//0~20 10
         2=> '9.5折卷',// 2
         1=> '50元优惠卷',//20~30 1
         6 => '5元优惠卷',//30~50 6
         8 => '10元优惠卷',//50~70 8
         0 => '365飞吻一枚',//70~80 0
         4 => '365爱的抱抱',//80~90 4
         5 => '北大荒芳临豆乳',//91 5
         11 =>'长白山笨炒松子',//91~93 11
         3 =>'益者有机金丝枣',//93~94 3 
         7 => '北大荒有机玉米糁',//94~99 7
         9 =>'五星胡蜂蜜'//100 9
    );
    $rand = rand(0,99);
    //发送奖品
    if($rand <20)
        $gift = 10;
    else if($rand <30)
    {
        send_bonus(7);
        $gift = 1;
    }
    else if($rand <50)
    {
        send_bonus(6);
        $gift = 6;
    }
    else if($rand <70)
    {
        send_bonus(5);
        $gift = 8;
    }
    else if($rand <80)
        $gift = 0;
    else if($rand <90)
        $gift = 4;
    else if($rand <91)
    {
        send_volums(56036);
        $gift = 5;
    }
    else if($rand <93)
    {
        send_volums(1576);
        $gift = 11;
    }
    else if($rand <94)
    {
        send_volums(56068);
        $gift = 3;
    }
    else if($rand <99)
    {
        send_volums(56218);
        $gift = 7;
    }
    else if($rand <100)
    {
        send_volums(1589);
        $gift = 9;
    }
    
    $deg = 10800  + $gift * 30 + rand(2,28);
    $result['deg'] = $deg;
    $result['gift'] = $gift;
    //发送奖品 
    
    
    
    //记录奖品
    $lottery_data = array(
      'user_id' =>$user_id,
      'type_id' => $gift,
      'ip' => $ip,
      'time' => time(),
      'type_name' =>  $gifts[$gift],
    );
    $db->autoExecute($lottery_table,$lottery_data);
    
    
}
die($json->encode($result));



function  is_proxy()
{
    $proxy = 0;
    if($_SERVER['HTTP_VIA'] != "")
    { $proxy = 1; }
    if($_SERVER['HTTP_X_FORWARDED_FOR'] != "")
    { $proxy = 1; }
    if($_SERVER['VIA'] != "")
    { $proxy = 1; }
    if($_SERVER['HTTP_FORWARDED'] != "")
    { $proxy = 1; }
    if($_SERVER['FORWARDED'] != "")
    { $proxy = 1; }
    if($_SERVER['HTTP_X_BLUECOAT_VIA'] != "")
    { $proxy = 1; }
    if($_SERVER['HTTP_PROXY____'] != "")
    { $proxy = 1; }
    if($_SERVER['HTTP_PROXY___________'] != "")
    { $proxy = 1; }
    if($_SERVER['HTTP_PROXY_CONNECTION'] != "")
    { $proxy = 1; }
    if($_SERVER['HTTP_X_HOST'] != "")
    { $proxy = 1; }
    if($_SERVER['HTTP_X_REFERER'] != "")
    { $proxy = 1; }
    if($_SERVER['HTTP_X_SERVER_HOSTNAME'] != "")
    { $proxy = 1; }
    if($_SERVER['PROXY_HOST'] != "")
    { $proxy = 1; }
    if($_SERVER['PROXY_PORT'] != "")
    { $proxy = 1; }
    if($_SERVER['PROXY_REQUEST'] != "")
    { $proxy = 1; }
    if($_SERVER['HTTP_CLIENT_IP'] != "")
    { $proxy = 1; }
    if($_SERVER['HTTP_PRAGMA'] != "")
    { $proxy = 1; }
    return $proxy;
    
}

function send_bonus($bonus_id)
{
    $userBonus = new UserBonus();
    //添加优惠劵
    $userBonus->user_id =   GLogin::id();
    $userBonus->bonus_type_id = $bonus_id ;
    $userBonus->save();
         
}

function send_volums($goods_id,$is_shipping_free = false)
{
      //添加提货券
        $volumes_type_id = $goods_id;
        //添加优惠劵
        $deliveryVolumes = new DeliveryVolumes();
        $deliveryVolumes->user_id =   GLogin::id();
        $deliveryVolumes->goods_id =   $volumes_type_id;
        $deliveryVolumes->create_time = time();
        $deliveryVolumes->expire_time = time() + 30*24*60*60;//默认为一个月
        $deliveryVolumes->is_shipping_free = $is_shipping_free;
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
}

?>
