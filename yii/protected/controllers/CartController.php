<?php

class CartController extends Controller
{
        public $layout ='sub';
        public $title = '购物车';
        
        
        public function filters()
        {
            return array(
             //  'ajaxOnly + addToCart,dropGoods'

            );
            
        }
                
        public function getSessionID()
        {
            return Yii::app()->session->sessionID;
        }
        
        
        
        /*
         * 计算总运费
         */
        
        public static function calcShippingFee($region_list,$goods_price,$goods_weight,$goods_num)
        {
            Yii::import('application.extensions.*');
            require 'common.php';
            define('TABLE_PREFIX',"green_");
            //取得可用的配送方式列表  
            $sql = 'SELECT s.shipping_id, s.shipping_code, s.shipping_name, ' .
                        's.shipping_desc, s.insure, s.support_cod, a.configure ' .
                    'FROM ' . TABLE_PREFIX.'shipping' . ' AS s, ' .
                        TABLE_PREFIX.'shipping_area' . ' AS a, ' .
                        TABLE_PREFIX.'area_region' . ' AS r ' .
                    'WHERE r.region_id ' . db_create_in($region_list) .
                    ' AND r.shipping_area_id = a.shipping_area_id AND a.shipping_id = s.shipping_id AND s.enabled = 1 ORDER BY s.shipping_order';
            $command =  Yii::app()->db->createCommand($sql);
            $aval_list  = $command->queryAll();
            $min_index = "";
            foreach($aval_list as $key => &$val)
            {
                $conf = unserialize($val['configure']);
                $configure = array();
                foreach ($conf AS $c_key=>$c_val)
                {
                    $configure[$c_val['name']] = $c_val['value'];
                }
                 //计算总价
                //如果超过免运费金额 则运费为0
                if( !empty($configure['free_money'] ) &&    $goods_price >$configure['free_money'] )
                {
                    $fee = 0;
                }
                else {
                    if($goods_weight <=1)
                    {
                        $fee = $configure['base_fee'];
                    }
                    else
                    {
                        
                        $fee = $configure['base_fee'] + $configure['step_fee'] * ceil( $goods_weight -1 );
                    }
                }
                $val['fee']=  $fee;
                //记录最便宜的配送方式
                if(empty($min_index))
                {
                    $min_index = $key;
                }
                else if( $aval_list[$min_index]['fee'] > $fee)
                {
                    $min_index = $key;
                }
            }

            return $aval_list[$min_index];
        }
        
        /* 
         *  计算购物车总价
         */
        public static  function calcCartTotal($cart_list)
        {
            //计算商品总价
            $goods_total = self::calcGoodsTotal($cart_list);
            //计算配送费用
            //获取客户的配送地址
            $address =    Yii::app()->session['address'];
            $region_list = array($address->country,$address->province, $address->city, $address->district);
            //获取配送信息
            $shipping = self::calcShippingFee($region_list,$goods_total['total_price'],$goods_total['total_weight'],$goods_total['total_num']);
            $goods_total['fee'] = $goods_total['total_price'] + $shipping['fee'];
            
            
            $total = array(
                'goods' => $goods_total,
                'shipping' => $shipping,
                'address'=> $address,
            );
            
            return $total;
        }
        
           /* 
         *  计算购物车商品总价 总重量
         */
        public static  function calcGoodsTotal($cart_list)
        {
            $total = array('total_price'=>0,'total_weight'=>0,'total_num' =>0);
            foreach($cart_list as $cart)
            {
                $total['total_price'] +=  $cart->goods_price * $cart->goods_number;
                $total['total_weight'] += $cart->goods_weight * $cart->goods_number;
                $total['total_num'] += $cart->goods_number;
            }
            return $total;
        }


        /*
         * 
         * Clear Cart 清空购物车
         * 
         */
        public function actionClearCart()
        {
             if( Cart::model()->deleteAllByAttributes(array('session_id'=>$this->getSessionID())) )
             {
                $this->redirect('index'); 
             }
            
        }
        
        /*
         * 
         * 检查购物车
         */
        public function actionCheckGoods()
        {
            $goods_list = array();
            //获取商品id 和数量
            foreach($_POST as $key=>$val)
            {
                if(stripos("num_", $key) == 0)
                {
                    $goods_id =  intval(substr($key,4)); //delete num_
                    $val = intval($val);
                    //数量最小为0
                    if($val <0 )
                        $val = 0;
                    $goods_list[$goods_id] = $val;
                }
            }
            //更新购物车
            foreach($goods_list as $key => $val)
            {
                Cart::model()->updateAll(array('goods_number'=>$val ),'session_id=:session_id and goods_id=:goods_id',array(':session_id'=>$this->getSessionID() ,':goods_id' => $key)); 

            }
            $this->redirect(array('cart/index')); 
        }
        
        
        /*
         * 验证红包
         */
        function actionValidBounus($bonus_id)
        {
            
            $this->redirect(array('cart/index')); 
        }
        
         /*
         * 验证卡
         */
        function actionValidCard($name,$password)
        {
            $msg = array('code'=>0,'refund'=>0,'error'=>"");
            
            $record = User::model()->findByAttributes(array('user_name'=>$name,'password' => md5($password))); 
            if($record)
            {
                $msg['refund'] = $record->user_money;
            }
            else
            {
                $msg['code'] = 1;
                $msg['error'] = "卡号密码不正确";
            }
 
            
            echo CJSON::encode($msg);
        }
        
        /*
         * 确认收货地址
         * 
         *、
         */
        function actionConfirmAddress($address_id)
        {
          
              $address =  UserAddress::model()->findByAttributes(array('user_id'=>  Yii::app()->user->user_id,'address_id' =>  intval($address_id)));
              if(!$address)
              {
                  $this->redirect(array('cart/consigneList'));
              }
              else{
                  Yii::app()->session['address'] = $address;
                  
                  $this->redirect(array('cart/confirmOrder'));
              }
            
        }
        
        
        /*
         * 检查订单
         */
        function actionConfirmOrder()
        {
            //判断是否登录
            if(Yii::app()->user->isGuest)
                $this->redirect(array('//user'));
            //首先选择默认地址
            //如果没有默认地址 则转到地址选择页面
           $address =  Yii::app()->session['address'] ;
            if(!$address)
            {
                $address =  UserAddress::model()->findByAttributes(array('user_id'=>  Yii::app()->user->user_id,'is_default' =>1));
                if($address)
                {
                    Yii::app()->session['address'] = $address;
                }
                else{
                    $this->redirect(array('cart/consigneList'));
                }
            }
            $cart_list = Cart::model()->with( array('goods'=>array('select'=>'goods_thumb')))->findAll(
                         array( 
                             'condition'=> 't.session_id=:session_id',   
                             'params'=>array(
                                  ":session_id"=>  $this->getSessionID(),
                              ) ,
                             'select' => 't.*',   
                        )
              );
            if(count($cart_list) == 0) //购物车没有东西
            {
                 $this->redirect(array('site/index'));
            }
            
            $total  = self::calcCartTotal($cart_list); //($region_list,$goods_price,$goods_num,$goods_weight)

            $user = User::model()->find(
                array( 
                    'condition'=> 'user_id=:user_id',   
                'params'=>array(
                    ":user_id"=>   Yii::app()->user->user_id,
                ) ,
                'select' => 'user_money',
                )
           );
            
            $this->render('confirm',array('user'=>$user,'address'=>$address, 'cart_list' => $cart_list,'total' => $total['goods'],'shipping'=>$total['shipping']));

        }
        /*
         * 确认订单
         */
         function actionDoneOrder()
        {
             $message = "";
             //检查地址是否为空
            $address =    Yii::app()->session['address'];
            if(empty($address))
                $this->redirect('cart/actionConsigneList');
            
            
             //检查购物车是否为空
             $cart_list = Cart::model()->with( array('goods'=>array('select'=>'goods_thumb')))->findAll(
                         array( 
                             'condition'=> 't.session_id=:session_id',   
                             'params'=>array(
                                  ":session_id"=>  $this->getSessionID(),
                              ) ,
                             'select' => 't.*',   
                        )
              );
            $total  = self::calcCartTotal($cart_list); //($region_list,$goods_price,$goods_num,$goods_weight) 
            if($total['goods']['total_num']  <0 )
            {
                 $this->redirect(array('site/index'));
            }
             //检查余额是否够支付 
            $user = User::model()->findByPk(  Yii::app()->user->user_id );
           if($user->user_money < $total['goods']['fee'])
           {
               $message = "您的余额不足,请您充值后再支付";
               $this->redirect(array('cart/showMsg','message' => $message));  
           }

           //记录订单信息
           $order_info  = new OrderInfo;
           define('OS_CONFIRMED',              1); // 已确认
           define('SS_UNSHIPPED',              0); // 未发货
           define('PS_PAYED',                  2); // 已付款
           $order_info->order_sn = get_order_sn();
           $order_info->user_id = Yii::app()->user->user_id;//Yii::app()->user->user_id;
           $order_info->order_status = OS_CONFIRMED;
           $order_info->shipping_status = SS_UNSHIPPED;
           $order_info->pay_status = PS_PAYED;
           $order_info->consignee = $total['address']->consignee;
           $order_info->country = $total['address']->country;  
           $order_info->province = $total['address']->province;
           $order_info->city = $total['address']->city;
           $order_info->district = $total['address']->district;
           $order_info->address = $total['address']->address;
           $order_info->mobile = $total['address']->mobile;
           $order_info->shipping_id = $total['shipping']['shipping_id'];
           $order_info->shipping_name = $total['shipping']['shipping_name'];
           $order_info->pay_name = '支付宝';
           $order_info->pay_id = 1;       
           $order_info->how_oos = '等待所有商品备齐后再发';
           $order_info->goods_amount =  $total['goods']['total_price'];
           $order_info->shipping_fee =  $total['shipping']['fee'];
           $order_info->money_paid = 0;//全部使用余额支付
           $order_info->surplus =  $total['goods']['fee'];
           $order_info->order_amount = $total['goods']['fee'];
           $order_info->referer = '手机';
           $order_info->add_time = time();
           $order_info->confirm_time = time();
           $order_info->pay_time = time();
           $order_info->agency_id =0;
           $order_info->inv_type = 0;
           $order_info->tax = 0;
           $order_info->discount = 0;

        //插入数据库 

           $transaction = Yii::app()->db->beginTransaction();
           try{
               if(!$order_info->save())
                    throw new Exception( print_r( $order_info->errors,true));

               $order_id =  Yii::app()->db->getLastInsertID();
               //改变余额
               $user->user_money -=  $order_info['surplus'];
               $user->update();
               //插入pay log
                $accountlog = new AccountLog();
                $accountlog->user_id =  Yii::app()->user->user_id;;
                $accountlog->pay_points = 0;
                $accountlog->change_desc = '支付订单' .$order_id ." 扣除 ".$order_info['surplus']."元";;
                $accountlog->change_type = 99;
                $accountlog->change_time = time();
                $accountlog->user_money = -$order_info['surplus'];
                $accountlog->frozen_money = 0;
                $accountlog->rank_points = 0;
                if(!$accountlog->save())
                    throw new Exception( print_r( $accountlog->errors,true));
               //插入OrderGoods
               foreach($cart_list as $cart)
               {
                   $orderGoods = new OrderGoods;
                   $orderGoods->order_id = $order_id; 
                   $orderGoods->goods_name = $cart->goods_name;

                   $orderGoods->goods_id = $cart->goods_id;
                   $orderGoods->goods_sn = $cart->goods_sn;
                   $orderGoods->goods_number = $cart->goods_number;
                   $orderGoods->send_number = 0;
                   $orderGoods->market_price = $cart->market_price;
                   $orderGoods->goods_price = $cart->goods_price;
                   $orderGoods->is_real = 1;
                   $orderGoods->parent_id = 0;
                   $orderGoods->is_gift = 0;
                   $orderGoods->product_id = 0;
                   $orderGoods->goods_attr = ' ';
                   if(!$orderGoods->save())
                        throw new Exception( print_r( $orderGoods->errors,true));
                   
               }
               $transaction->commit(); 
           } catch (Exception $e) {   
                 $transaction->rollback(); //如果操作失败, 数据回滚 
                 $message = "对不起，支付出错，请联系客服";
                 $this->redirect(array('cart/showMsg','message' => $message));    
           }
           //清空
           Cart::model()->deleteAllByAttributes(array('session_id'=>$this->getSessionID()));
           $message = "恭喜您，您的订单已经支付成功";
           $this->redirect(array('cart/showMsg','message' => $message));
        }
        /*
         * 
         * Drop Goods 从购物车中删除茶品
         * $good_id 商品id
         * 
         */
        public function actionDropGoods($goods_id)
        {
             Cart::model()->deleteAllByAttributes(array('session_id'=>$this->getSessionID() ,'goods_id' => $goods_id)) ;
             $this->redirect(array('cart/index')); 
            
        }
        
        
        private function _addToCart($goods_id,$goods_num)
        {
             $res = array('code'=>0,'msg'=>'');
            //修正参数
            $goods_id = intval($goods_id);
            $goods_num = intval($goods_num);
            //获取goods信息
            $goods =  Goods::model()->findByPk($goods_id);
            if(!$goods)
            {
                $res['code'] = 1;
                $res['msg'] = '找不到商品信息';
                echo CJSON::encode( $res );  
                return;
            }
              
            //是否已经添加过改产品 如果添加 修改数量 如果未添加 插入
            if( $cart = Cart::model()->findByAttributes(array('session_id'=>$this->getSessionID() ,'goods_id' => $goods_id)) )
            {
                //添加数量
                $cart->goods_number += $goods_num;
                
            }
            else {
                $cart = new Cart;
                $cart->session_id = $this->getSessionID();
                $cart->goods_id = $goods_id;
                $cart->goods_number = $goods_num;
                $cart->goods_sn = $goods->goods_sn;
                $cart->goods_name = $goods->goods_name;
                $cart->market_price = $goods->market_price;
                $cart->goods_price = $goods->shop_price;
                $cart->goods_weight = $goods->goods_weight;
                if( !Yii::app()->user->isGuest)
                    $cart->user_id = Yii::app()->user->user_id;
            }
            //储存 save
            if($cart->save())
                 $res['msg'] = '更新购物车成功';
            else{
                $res['code'] = 2;
                $res['msg'] = '更新失败，原因'. print_r($cart->getErrors(),true);
            }
            return $res;
        }
        public function actionAddToCart($goods_id,$goods_num)
        {
           
            $res = $this->_addToCart($goods_id, $goods_num);
            echo CJSON::encode( $res );
           // echo $this->sessionID;
        }
        
        /*
         * 显示提示信息
         */
        public function  actionShowMsg($message)
        {   
            $this->render('showmsg',array('message' =>$message));
        }
        public function actionIndex()
	{   
            $cart_list = Cart::model()->with( array('goods'=>array('select'=>'goods_thumb')))->findAll(
                         array( 
                             'condition'=> 't.session_id=:session_id',   
                             'params'=>array(
                                  ":session_id"=>  $this->getSessionID(),
                              ) ,
                             'select' => 't.*',   
                        )
              );
             if(count($cart_list) == 0)
                 $this->redirect(array('site/index'));
                    
            $total  = self::calcGoodsTotal($cart_list);
            $this->render('index',array('cart_list' => $cart_list,'total' => $total));
	}
        
        /*
         * 重新购买
         */
        public function actionBuyAgain($order_id)
        {
            $order_id = intval($order_id);
            //检查该订单是否属于用户
        
            $order= OrderInfo::model()->findByAttributes(array('user_id' => Yii::app()->user->user_id,'order_id'=>$order_id));
            if($order)
            {
                $goodsList = OrderGoods::model()->findAllByAttributes(array('order_id'=>$order_id  )); 
                
                foreach($goodsList as $goods)
                {
                    $this->_addToCart($goods->goods_id,$goods->goods_number);
                }

                $this->redirect(array('cart/index')); 
            }
            else{
                 $this->redirect(array('user/center')); 
            }
            
        }
        
        
        public function actionCheckout()
	{
		$this->render('checkout');
	}

        
   
        
        
           public function actionConsigneList()
	{
           $msg = $_GET['msg'];    
           $addressList = UserAddress::model()->findAll(array(  'condition'=> 'user_id=:user_id','params'=>array(":user_id"=>Yii::app()->user->user_id),"order"=>"address_id DESC"/*,'select'=>'user_id','limit'=>2 */) ); 
	   $this->render('consigne_list',array('addressList'=>$addressList,"msg"=>$msg));
	}
        
        
    
      
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}