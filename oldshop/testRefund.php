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

//201204200021478522 201204190121394223 36520120419143188 36520120419143189
//测试环境 http://172.168.1.14:8088/payment/PaymentService.asmx?wsdl'
//正式环境 http://member.xinfuka.net/payment/PaymentService.asmx?wsdl

//CreateRefundTransaction(string merchantId, string cardSn, decimal amount, string refundSn, string orderSn, string tranId, string comments)


$client = new SoapClient ('http://member.xinfuka.net/payment/PaymentService.asmx?wsdl',array('soap_version'   => SOAP_1_2));
$order = array('2012101106783');#2012042818530 2012043031839
$merId = '1000000003';
$key = '808799BFEB4A';

$orderstr = implode(",",$order);
$orderstr = substr($orderstr,0);

$signstr = $orderstr.$merId.$key;
$mac = md5($signstr);

$param = array('merchantId' => $merId, 'cardSn'=>'JT201229004',  'amount' =>24940,  'refundSn'=>'20121011062354',
      'orderSn' => '2012100636127',  'tranId' => 'c51efca1-3da2-40c6-8196-7da0c93f2d6b',  'comments' => 'no');
#$param = array('allOrderId'=>$order,'merId'=>$merId,'mac' =>$mac);
//调用必须用__soapCall
$res = $client->__Call('CreateRefundTransaction',array('parameters' => $param));
var_dump($res->CreateRefundTransactionResult);  //这里先输出一下变量$p，看看是什么类型。


//$res = $client->CheckOrderPaymentResult( $order,$merId,$mac);
//var_dump($res);
//echo $res[0]->OrderId." ".$res[0]->PaymentResult;


?>
