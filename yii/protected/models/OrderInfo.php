<?php

/**
 * This is the model class for table "green_order_info".
 *
 * The followings are the available columns in table 'green_order_info':
 * @property integer $order_id
 * @property string $order_sn
 * @property integer $user_id
 * @property integer $order_status
 * @property integer $shipping_status
 * @property integer $pay_status
 * @property string $consignee
 * @property integer $country
 * @property integer $province
 * @property integer $city
 * @property integer $district
 * @property string $address
 * @property string $zipcode
 * @property string $tel
 * @property string $mobile
 * @property string $email
 * @property string $best_time
 * @property string $sign_building
 * @property string $postscript
 * @property integer $shipping_id
 * @property string $shipping_name
 * @property integer $pay_id
 * @property string $pay_name
 * @property string $how_oos
 * @property string $how_surplus
 * @property string $pack_name
 * @property string $card_name
 * @property string $card_message
 * @property string $inv_payee
 * @property string $inv_content
 * @property string $goods_amount
 * @property string $shipping_fee
 * @property string $insure_fee
 * @property string $pay_fee
 * @property string $pack_fee
 * @property string $card_fee
 * @property string $money_paid
 * @property string $surplus
 * @property string $integral
 * @property string $integral_money
 * @property string $bonus
 * @property string $order_amount
 * @property integer $from_ad
 * @property string $referer
 * @property string $add_time
 * @property string $confirm_time
 * @property string $pay_time
 * @property string $shipping_time
 * @property integer $pack_id
 * @property integer $card_id
 * @property integer $bonus_id
 * @property string $invoice_no
 * @property string $extension_code
 * @property integer $extension_id
 * @property string $to_buyer
 * @property string $pay_note
 * @property integer $agency_id
 * @property string $inv_type
 * @property string $tax
 * @property integer $is_separate
 * @property integer $parent_id
 * @property string $discount
 */
class OrderInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'green_order_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('agency_id, inv_type, tax, discount', 'required'),
			array('user_id, order_status, shipping_status, pay_status, country, province, city, district, shipping_id, pay_id, from_ad, pack_id, card_id, bonus_id, extension_id, agency_id, is_separate, parent_id', 'numerical', 'integerOnly'=>true),
			array('order_sn', 'length', 'max'=>20),
			array('consignee, zipcode, tel, mobile, email, inv_type', 'length', 'max'=>60),
			array('address, postscript, card_message, referer, invoice_no, to_buyer, pay_note', 'length', 'max'=>255),
			array('best_time, sign_building, shipping_name, pay_name, how_oos, how_surplus, pack_name, card_name, inv_payee, inv_content', 'length', 'max'=>120),
			array('goods_amount, shipping_fee, insure_fee, pay_fee, pack_fee, card_fee, money_paid, surplus, integral, integral_money, bonus, order_amount, add_time, confirm_time, pay_time, shipping_time, tax, discount', 'length', 'max'=>10),
			array('extension_code', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('order_id, order_sn, user_id, order_status, shipping_status, pay_status, consignee, country, province, city, district, address, zipcode, tel, mobile, email, best_time, sign_building, postscript, shipping_id, shipping_name, pay_id, pay_name, how_oos, how_surplus, pack_name, card_name, card_message, inv_payee, inv_content, goods_amount, shipping_fee, insure_fee, pay_fee, pack_fee, card_fee, money_paid, surplus, integral, integral_money, bonus, order_amount, from_ad, referer, add_time, confirm_time, pay_time, shipping_time, pack_id, card_id, bonus_id, invoice_no, extension_code, extension_id, to_buyer, pay_note, agency_id, inv_type, tax, is_separate, parent_id, discount', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'order_id' => 'Order',
			'order_sn' => 'Order Sn',
			'user_id' => 'User',
			'order_status' => 'Order Status',
			'shipping_status' => 'Shipping Status',
			'pay_status' => 'Pay Status',
			'consignee' => 'Consignee',
			'country' => 'Country',
			'province' => 'Province',
			'city' => 'City',
			'district' => 'District',
			'address' => 'Address',
			'zipcode' => 'Zipcode',
			'tel' => 'Tel',
			'mobile' => 'Mobile',
			'email' => 'Email',
			'best_time' => 'Best Time',
			'sign_building' => 'Sign Building',
			'postscript' => 'Postscript',
			'shipping_id' => 'Shipping',
			'shipping_name' => 'Shipping Name',
			'pay_id' => 'Pay',
			'pay_name' => 'Pay Name',
			'how_oos' => 'How Oos',
			'how_surplus' => 'How Surplus',
			'pack_name' => 'Pack Name',
			'card_name' => 'Card Name',
			'card_message' => 'Card Message',
			'inv_payee' => 'Inv Payee',
			'inv_content' => 'Inv Content',
			'goods_amount' => 'Goods Amount',
			'shipping_fee' => 'Shipping Fee',
			'insure_fee' => 'Insure Fee',
			'pay_fee' => 'Pay Fee',
			'pack_fee' => 'Pack Fee',
			'card_fee' => 'Card Fee',
			'money_paid' => 'Money Paid',
			'surplus' => 'Surplus',
			'integral' => 'Integral',
			'integral_money' => 'Integral Money',
			'bonus' => 'Bonus',
			'order_amount' => 'Order Amount',
			'from_ad' => 'From Ad',
			'referer' => 'Referer',
			'add_time' => 'Add Time',
			'confirm_time' => 'Confirm Time',
			'pay_time' => 'Pay Time',
			'shipping_time' => 'Shipping Time',
			'pack_id' => 'Pack',
			'card_id' => 'Card',
			'bonus_id' => 'Bonus',
			'invoice_no' => 'Invoice No',
			'extension_code' => 'Extension Code',
			'extension_id' => 'Extension',
			'to_buyer' => 'To Buyer',
			'pay_note' => 'Pay Note',
			'agency_id' => 'Agency',
			'inv_type' => 'Inv Type',
			'tax' => 'Tax',
			'is_separate' => 'Is Separate',
			'parent_id' => 'Parent',
			'discount' => 'Discount',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('order_sn',$this->order_sn,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('order_status',$this->order_status);
		$criteria->compare('shipping_status',$this->shipping_status);
		$criteria->compare('pay_status',$this->pay_status);
		$criteria->compare('consignee',$this->consignee,true);
		$criteria->compare('country',$this->country);
		$criteria->compare('province',$this->province);
		$criteria->compare('city',$this->city);
		$criteria->compare('district',$this->district);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('best_time',$this->best_time,true);
		$criteria->compare('sign_building',$this->sign_building,true);
		$criteria->compare('postscript',$this->postscript,true);
		$criteria->compare('shipping_id',$this->shipping_id);
		$criteria->compare('shipping_name',$this->shipping_name,true);
		$criteria->compare('pay_id',$this->pay_id);
		$criteria->compare('pay_name',$this->pay_name,true);
		$criteria->compare('how_oos',$this->how_oos,true);
		$criteria->compare('how_surplus',$this->how_surplus,true);
		$criteria->compare('pack_name',$this->pack_name,true);
		$criteria->compare('card_name',$this->card_name,true);
		$criteria->compare('card_message',$this->card_message,true);
		$criteria->compare('inv_payee',$this->inv_payee,true);
		$criteria->compare('inv_content',$this->inv_content,true);
		$criteria->compare('goods_amount',$this->goods_amount,true);
		$criteria->compare('shipping_fee',$this->shipping_fee,true);
		$criteria->compare('insure_fee',$this->insure_fee,true);
		$criteria->compare('pay_fee',$this->pay_fee,true);
		$criteria->compare('pack_fee',$this->pack_fee,true);
		$criteria->compare('card_fee',$this->card_fee,true);
		$criteria->compare('money_paid',$this->money_paid,true);
		$criteria->compare('surplus',$this->surplus,true);
		$criteria->compare('integral',$this->integral,true);
		$criteria->compare('integral_money',$this->integral_money,true);
		$criteria->compare('bonus',$this->bonus,true);
		$criteria->compare('order_amount',$this->order_amount,true);
		$criteria->compare('from_ad',$this->from_ad);
		$criteria->compare('referer',$this->referer,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('confirm_time',$this->confirm_time,true);
		$criteria->compare('pay_time',$this->pay_time,true);
		$criteria->compare('shipping_time',$this->shipping_time,true);
		$criteria->compare('pack_id',$this->pack_id);
		$criteria->compare('card_id',$this->card_id);
		$criteria->compare('bonus_id',$this->bonus_id);
		$criteria->compare('invoice_no',$this->invoice_no,true);
		$criteria->compare('extension_code',$this->extension_code,true);
		$criteria->compare('extension_id',$this->extension_id);
		$criteria->compare('to_buyer',$this->to_buyer,true);
		$criteria->compare('pay_note',$this->pay_note,true);
		$criteria->compare('agency_id',$this->agency_id);
		$criteria->compare('inv_type',$this->inv_type,true);
		$criteria->compare('tax',$this->tax,true);
		$criteria->compare('is_separate',$this->is_separate);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('discount',$this->discount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getAddTime()
        {
               return   date("Y-m-d H:i:s", $this->add_time);  

        }
        public function getStatus()
        {
            $status = "";
  
            switch ( $this->order_status)
            {
                case 2:
                    $status = "已取消";
                    break;
                case 3:
                    $status = "无效订单";
                    break;
                case 5:
                    if($this->shipping_status == 5)
                        $status = "已发货";
                    else if($this->shipping_status == 1)
                        $status = "已确认收货";
                    else
                        $status = "正在备货";
                    break;
                case 7:
                    $status = "申请退款中";
                    break;
                case 8:
                    $status = "已退款";
                    break;
                default:
                    $status = "订单未确认";
            }
            return   $status;

        }
}