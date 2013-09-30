<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class UserMenuController extends Controller
{ 
    public $layout ='sub';
    public $title = "用户中心";
    public function actionOrderList()
    {
        $this->title = '订单列表';
        
      

        $criteria=new CDbCriteria();
        $sort = new CSort('OrderInfo');
        $sort->defaultOrder=" add_time desc";
        $sort->applyOrder($criteria);
        $criteria->addCondition('user_id='.Yii::app()->user->user_id);
        $criteria->select = "order_sn,add_time,shipping_status,order_status,order_id,user_id,goods_amount,shipping_fee";
        
        

        $count = OrderInfo::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 5;
        $pages->applyLimit($criteria);
        
        
        
  
        $orderList=OrderInfo::model()->findAll($criteria);
        
        
       // $orderList = OrderInfo::model()->findAllByAttributes(array('user_id' => Yii::app()->user->user_id)); 
        $this->render('orderList',array('orderList'=>$orderList,'pages'=> $pages));
        
    }   
    
    public function actionShippingStatus($order_id)
    {
        $order_info_url = $this->createUrl('userMenu/orderview',array('order_id'=>$order_id));
        $this->title =  "<a href='$order_info_url'>订单信息 </a> &gt;&nbsp;" .  "物流信息" ; 
        $order= OrderInfo::model()->findByAttributes(array('user_id' => Yii::app()->user->user_id,'order_id'=>$order_id));
        if($order)
        {
            $shiiping_type = array(
                "韵达快递" => "yunda",
                "宅急送" => "zjs",
                "EMS 国内邮政特快专递" => "ems",
                "全峰快递" => "quanfeng"
            ); 
            $type = $shiiping_type[$order->shipping_name];
            if( !empty($order->invoice_no) && !empty($type))
            {
                $order_id = $order->invoice_no;
                $query_url = "http://www.aikuaidi.cn/rest/?key=e931e30b9c9948c09b7615ba006cd064&order=$order_id&id=$type&show=html";
                $data = file_get_contents($query_url);
                
                
                $data = iconv("GB2312","UTF-8",$data);
            }
            else{
                $error = "<p>对不起,找不到订单信息,请您联系客服";
            }
             $this->render('shippingStatus',array('data'=>$data,"error" => $error));   
        }
        else{
               $this->redirect(Yii::app()->homeUrl);
        }
    }
    
     public function actionOrderView($order_id)
    {
        $this->title = '订单详情';
        
        //检查该订单是否属于用户
        
        $order= OrderInfo::model()->findByAttributes(array('user_id' => Yii::app()->user->user_id,'order_id'=>$order_id));
        if($order)
        {
            
            $goodsList = OrderGoods::model()->with(array('goods'=>array('select'=>'goods_thumb')))->findAllByAttributes(array('order_id'=>$order_id )); 
            $this->render('orderView',array('order'=>$order,'goodsList' => $goodsList));     
            
        }
        else{
            
             $this->render('//site/index');
        }
        
    }   
    
    public function actionCombineCard()
    {
        $act = $_POST['act'];
        $error = "";
        
        if($act == 'do_combine')
        {                   

                $card = addslashes($_POST['card_no']);
                $password = md5(addslashes($_POST['password']));
                $money  = intval($_POST['money']);
                if($money > 9999) //最大不能超过9999
                    $money = 9999;

                //check session
                if(empty($_SESSION['password_error'] ))
                        $_SESSION['password_error'] = 0;
                if(intval( $_SESSION['password_error'] ) > 20)
                {
                      $this->render('//site/index');
                }

                //检查是否有余额
               // $sql = "SELECT user_id,user_money FROM " . $ecs->table('users') . " WHERE user_name='$card' and password='$password'";
                $another_card = User::model()->findByAttributes(array('user_name'=>$card ,'password' => $password));

                
                if(!$another_card){

                    $_SESSION['password_error'] += 1;
                    $error= '对不起，卡号密码有误 ';
                     $this->render('combineCard',array('error' => $error)); exit();
                }
                
                if(  $another_card->user_id ==   Yii::app()->user->user_id   ){
                      $error= '对不起，您不能使用同一张卡充值';
                      $this->render('combineCard',array('error' => $error)); exit();
                }
                if($money < 0) {
                     $error= '对不起，您输入的金额有误';
                      $this->render('combineCard',array('error' => $error)); exit();
                }
                if($money > $another_card->user_money) {
                  $error = '对不起，您的余额不足';
                   $this->render('combineCard',array('error' => $error)); exit();
                }
                
                //开始充值
                $cur_card = User::model()->findByPk( Yii::app()->user->user_id );
               // $another_card = User::model()->findByPk( $row['user_id'] );
                $another_userid = $another_card->user_id;


                //转账
                $cur_card->user_money  += $money;
                $another_card->user_money  -= $money;

                //记录
                $cur_accountlog = new AccountLog();
                $cur_accountlog->user_id =Yii::app()->user->user_id;
                $cur_accountlog->user_money = $money;
                $cur_accountlog->change_desc = '来自卡:' .$another_card->user_name ."的充值 增加 $money元";
                $cur_accountlog->change_type = 99;
                $cur_accountlog->change_time = time();
                $cur_accountlog->pay_points = 0;
                $cur_accountlog->frozen_money = 0;
                $cur_accountlog->rank_points = 0;





                $another_accountlog = new AccountLog();
                $another_accountlog->user_id = $another_userid;
                $another_accountlog->user_money = -$money;
                $another_accountlog->change_desc = '充值给卡:' .$cur_card->user_name ." 扣除 $money元";
                $another_accountlog->change_type = 99;
                $another_accountlog->change_time = time();
                $another_accountlog->pay_points = 0;
                $another_accountlog->frozen_money = 0;
                $another_accountlog->rank_points = 0;


                $transaction = Yii::app()->db->beginTransaction();
                    try{
                        if(!$cur_card->save())
                        {
                            $message = "转账失败 。".print_r($cur_card,true);
                            GLog::error("user_register", $message);
                        }
                        else{
                            $message = "用户 ". Yii::app()->user->user_id . "转账: $money 成功 。";
                            GLog::log("combine_card", $message);
                        }

                        if(!$another_card->save())
                        {
                            $message = "转账 。".print_r($another_card,true);
                            GLog::error("combine_card", $message);
                        }
                        else{
                            $message = "用户 ".$another_card->user_id . "转账: $money 成功 。";
                            GLog::log("combine_card", $message);
                        }


                        if(!$cur_accountlog->save())
                        {
                            $message = "转账失败 。".print_r($cur_accountlog,true);
                            GLog::error("combine_card", $message);
                        }       
                        else{
                            $message = "用户 ". Yii::app()->user->user_id . "转账: $money 成功 。";
                            GLog::log("combine_card", $message);
                        }




                        if(!$another_accountlog->save())
                        {
                            $message = "转账失败 。".print_r($another_accountlog,true);
                            GLog::error("combine_card", $message);
                        }       
                        else{
                            $message = "用户 ".$another_card->user_id . "转账: $money 成功 。";
                            GLog::log("combine_card", $message);
                        }
                        $transaction->commit(); 
                } catch (Exception $e) {   
                    $transaction->rollback(); //如果操作失败, 数据回滚 
                }     

                $error = '恭喜您，您的转账已成功' ;
            
            
            
            
        } 

       $this->render('combineCard',array('error' => $error));
    }
    
    
      //地址管理
       public function actionAddressList($msg="")
       {

           $addressList = UserAddress::model()->findAll(array(  'condition'=> 'user_id=:user_id','params'=>array(":user_id"=>Yii::app()->user->user_id),"order"=>"address_id DESC"/*,'select'=>'user_id','limit'=>2 */) ); 
           $this->render('addressList',array('addressList'=>$addressList,"msg"=>$msg));
       }       
       
       public function actionDeleteAddress($address_id)
       {
            $msg = "删除失败"  ;
            $from = $_GET['from'];
            $address = UserAddress::model()->find( 
                     array( 'condition'=> 'user_id=:user_id and address_id = :address_id',   
                            'params'=>array(
                                ":user_id"=>Yii::app()->user->user_id,
                                ":address_id"=>$address_id
                            ) 
                     )
             );
            
            if($address) {
                $address->delete();
                $msg = "删除成功";
                
            }
            if($from == 'cart')
             $this->redirect(array("cart/consigneList",'msg'=>$msg ));
            else
             $this->redirect(array("userMenu/addressList",'msg'=>$msg ));
       }   

       public function actionAddAddress()
       {
         
           $act = $_POST["act"];
           $from = $_GET['from'];
           
           $address_id = intval( $_REQUEST["address_id"]);
           if($act == "add" || $act == "edit")
           {
                if($act == "add") //添加
                    $address = new UserAddress;
                else //修改
                {
                    $address = UserAddress::model()->findByAttributes(array('user_id'=>Yii::app()->user->user_id ,'address_id' => $address_id));
                    if(!address)
                    {
                           $this->redirect(array("userMenu/addressList"));
                    }
                }
                
                $address->user_id = Yii::app()->user->user_id;
                $address->consignee = $_POST['AccepterName'];
                $address->mobile = $_POST['Mobile'];

                $address->zipcode = $_POST['zipcode'];
                $address->address = $_POST['Address'];
                $address->address_name = $_POST['AddressName'];
                
                $address->country = 1;
                $address->province = $_POST['provinceList'];
                $address->city = $_POST['cityList'];
                $address->district = $_POST['districtList'];
                
                if($address->save())
                {

                    if($from == 'cart')
                        $this->redirect(array("cart/consigneList"));
                    else
                        $this->redirect(array("userMenu/addressList"));
                }
                else{
                    
                   // print_r($address->errors);exit();
                    $error = $address->errors;
                    if($from == 'cart')
                       $this->redirect(array("userMenu/addAddress",'error'=>$error,'from'=>'cart' ));

                    else
                       $this->redirect(array("userMenu/addAddress",'error'=>$error ));

                    
                }


           }
           else
           {
                //获取省列表
                $criteria=new CDbCriteria();
                $criteria->addCondition('parent_id=1');
                $criteria->select = "region_id,region_name";
                $province_list = Region::model()->findAll($criteria);

                
                
                
                if($address_id == 0)  //添加新地址
                    $this->render('addAddress',array("province_list"=>$province_list,'from'=>$from));
                else { //修改地址
                    $address = UserAddress::model()->findByPK($address_id);

                    $city_list =  Region::model()->findAll(array(  'condition'=> 'parent_id=:parent_id','params'=>array(":parent_id"=>$address->province),'select'=>'region_id,region_name') );
                     
                    $district_list = Region::model()->findAll(array(  'condition'=> 'parent_id=:parent_id','params'=>array(":parent_id"=>$address->city),'select'=>'region_id,region_name') );
                    
                    
                    $this->render('addAddress',array("province_list"=>$province_list,"city_list"=>$city_list,"district_list"=>$district_list,'address'=>$address,'from'=>$from));
                }
           }
        }       

}

?>
