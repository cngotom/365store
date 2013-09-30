<?php

/**
 * This is the model class for table "green_cart".
 *
 * The followings are the available columns in table 'green_cart':
 * @property integer $rec_id
 * @property integer $user_id
 * @property string $session_id
 * @property integer $goods_id
 * @property string $goods_sn
 * @property integer $product_id
 * @property string $goods_name
 * @property string $market_price
 * @property string $goods_price
 * @property integer $goods_number
 * @property string $goods_attr
 * @property integer $is_real
 * @property string $extension_code
 * @property integer $parent_id
 * @property integer $rec_type
 * @property integer $is_gift
 * @property integer $is_shipping
 * @property integer $can_handsel
 * @property string $goods_attr_id
 * @property string $goods_weight
 */
class Cart extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cart the static model class
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
		return 'green_cart';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('goods_weight', 'required'),
			array('user_id, goods_id, product_id, goods_number, is_real, parent_id, rec_type, is_gift, is_shipping, can_handsel', 'numerical', 'integerOnly'=>true),
			array('session_id', 'length', 'max'=>32),
			array('goods_sn', 'length', 'max'=>60),
			array('goods_name', 'length', 'max'=>120),
			array('market_price, goods_price, goods_weight', 'length', 'max'=>10),
			array('extension_code', 'length', 'max'=>30),
			array('goods_attr_id', 'length', 'max'=>255),
                       // array('is_real','default','value'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rec_id, user_id, session_id, goods_id, goods_sn, product_id, goods_name, market_price, goods_price, goods_number, goods_attr, is_real, extension_code, parent_id, rec_type, is_gift, is_shipping, can_handsel, goods_attr_id, goods_weight', 'safe', 'on'=>'search'),
		);
	}
        
        function beforeSave()  
        {  
            $this->is_real = 1;  
            return true;  
        }  

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rec_id' => 'Rec',
			'user_id' => 'User',
			'session_id' => 'Session',
			'goods_id' => 'Goods',
			'goods_sn' => 'Goods Sn',
			'product_id' => 'Product',
			'goods_name' => 'Goods Name',
			'market_price' => 'Market Price',
			'goods_price' => 'Goods Price',
			'goods_number' => 'Goods Number',
			'goods_attr' => 'Goods Attr',
			'is_real' => 'Is Real',
			'extension_code' => 'Extension Code',
			'parent_id' => 'Parent',
			'rec_type' => 'Rec Type',
			'is_gift' => 'Is Gift',
			'is_shipping' => 'Is Shipping',
			'can_handsel' => 'Can Handsel',
			'goods_attr_id' => 'Goods Attr',
			'goods_weight' => 'Goods Weight',
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

		$criteria->compare('rec_id',$this->rec_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('session_id',$this->session_id,true);
		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('goods_sn',$this->goods_sn,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('goods_name',$this->goods_name,true);
		$criteria->compare('market_price',$this->market_price,true);
		$criteria->compare('goods_price',$this->goods_price,true);
		$criteria->compare('goods_number',$this->goods_number);
		$criteria->compare('goods_attr',$this->goods_attr,true);
		$criteria->compare('is_real',$this->is_real);
		$criteria->compare('extension_code',$this->extension_code,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('rec_type',$this->rec_type);
		$criteria->compare('is_gift',$this->is_gift);
		$criteria->compare('is_shipping',$this->is_shipping);
		$criteria->compare('can_handsel',$this->can_handsel);
		$criteria->compare('goods_attr_id',$this->goods_attr_id,true);
		$criteria->compare('goods_weight',$this->goods_weight,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
         public function relations()
        {
            return array(
                'goods'=>array(self::BELONGS_TO, 'Goods', 'goods_id'),
            );
        }
        
            /*
         * 获取购物车数量
         */
        
        public static function getCartGoodsNum()
        {
            $cart_num = Cart::model()->count(
                         array( 
                             'condition'=> 't.session_id=:session_id',   
                             'params'=>array(
                                  ":session_id"=> Yii::app()->session->sessionID,
                              ) ,
                        )
              );
            return $cart_num;
        }
}