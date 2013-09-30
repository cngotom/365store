<?php
//测试环境http://172.168.1.14:8088/payment/MerchantPayment.aspx?
//正式环境https://member.xinfuka.net/payment/MerchantPayment.aspx?


$parameter = array(
    //'partner'           => ALIPAY_ID,
    'url'        => "http://221.217.178.200/testCallback.php",
    /* 业务参数 */
    'merId'             =>'1000000003',
    'orderId'           => "201204200101351343",
    'amount'             => intval(50),
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
//$sign  = substr($sign, 0, -1). ALIPAY_AUTH;
$signkey = '808799BFEB4A';
$sign= $parameter['merId'].$parameter['orderId'].$parameter['amount'].$signkey;
//echo $sign."<br>";
//echo md5($sign)."<br>";;
$code ='https://member.xinfuka.net/payment/MerchantPayment.aspx?'.$param. '&mac='.md5($sign);

//        $button = '<div style="text-align:center"><input type="button" onclick="window.open(\'https://www.xinfuka.com/cooperate/gateway.do?'.$param. '&sign='.md5($sign).'&sign_type=MD5\')" value="' .$GLOBALS['_LANG']['pay_button']. '" /></div>';
$code = '<script> location.href= "' . $code . '"</script>';
echo $code;
?>
