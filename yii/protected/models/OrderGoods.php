<?php

/**
 * This is the model class for table "green_order_goods".
 *
 * The followings are the available columns in table 'green_order_goods':
 * @property integer $rec_id
 * @property integer $order_id
 * @property integer $goods_id
 * @property string $goods_name
 * @property string $goods_sn
 * @property integer $product_id
 * @property integer $goods_number
 * @property string $market_price
 * @property string $goods_price
 * @property string $goods_attr
 * @property integer $send_number
 * @property integer $is_real
 * @property string $extension_code
 * @property integer $parent_id
 * @property integer $is_gift
 * @property string $goods_attr_id
 */
class OrderGoods extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderGoods the static model class
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
		return 'green_order_goods';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, goods_id, product_id, goods_number, send_number, is_real, parent_id, is_gift', 'numerical', 'integerOnly'=>true),
			array('goods_name', 'length', 'max'=>120),
			array('goods_sn', 'length', 'max'=>60),
			array('market_price, goods_price', 'length', 'max'=>10),
			array('extension_code', 'length', 'max'=>30),
			array('goods_attr_id', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rec_id, order_id, goods_id, goods_name, goods_sn, product_id, goods_number, market_price, goods_price, goods_attr, send_number, is_real, extension_code, parent_id, is_gift, goods_attr_id', 'safe', 'on'=>'search'),
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
                    'goods'=>array(self::BELONGS_TO, 'Goods', 'goods_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rec_id' => 'Rec',
			'order_id' => 'Order',
			'goods_id' => 'Goods',
			'goods_name' => 'Goods Name',
			'goods_sn' => 'Goods Sn',
			'product_id' => 'Product',
			'goods_number' => 'Goods Number',
			'market_price' => 'Market Price',
			'goods_price' => 'Goods Price',
			'goods_attr' => 'Goods Attr',
			'send_number' => 'Send Number',
			'is_real' => 'Is Real',
			'extension_code' => 'Extension Code',
			'parent_id' => 'Parent',
			'is_gift' => 'Is Gift',
			'goods_attr_id' => 'Goods Attr',
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
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('goods_name',$this->goods_name,true);
		$criteria->compare('goods_sn',$this->goods_sn,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('goods_number',$this->goods_number);
		$criteria->compare('market_price',$this->market_price,true);
		$criteria->compare('goods_price',$this->goods_price,true);
		$criteria->compare('goods_attr',$this->goods_attr,true);
		$criteria->compare('send_number',$this->send_number);
		$criteria->compare('is_real',$this->is_real);
		$criteria->compare('extension_code',$this->extension_code,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('is_gift',$this->is_gift);
		$criteria->compare('goods_attr_id',$this->goods_attr_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}