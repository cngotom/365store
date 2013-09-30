<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testCheck
 *
 * @author Administrator
 */


$client = new SoapClient ('http://member.xinfuka.net/payment/PaymentService.asmx?wsdl');

$orderSn = '36520120419143188';
$refundSn = 'b36520120419143156';
$tranId = '2012041900302829';
$merchantId = '1000000003';
$amount = 10;
$cardSn = '2336010590001141708';
$comments = 'not like';
$key = '808799BFEB4A';

$param = array();
$param_str = array( merchantId,cardSn,amount,refundSn,orderSn,tranId,comments);
    foreach($param_str as $a)
        $param[$a] = $$a;



//调用必须用__soapCall
$res = $client->__Call('CreateRefundTransaction',array('parameters' => $param));
print_r($res);  //这里先输出一下变量$p，看看是什么类型。

$res = $client->CreateRefundTransaction($merId,$cardSn,$amount,$refundSn,$order,$tranId,$comments);
//$res = $client->HelloWorld();
//echo $res->HelloWorldResult;
var_dump($res);
//echo $res[0]->OrderId." ".$res[0]->PaymentResult;

function make_pair($arr)
{
   
}
?>
