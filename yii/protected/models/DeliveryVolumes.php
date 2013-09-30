<?php

/**
 * This is the model class for table "green_delivery_volumes".
 *
 * The followings are the available columns in table 'green_delivery_volumes':
 * @property integer $volumes_id
 * @property integer $goods_id
 * @property string $volumes_sn
 * @property integer $user_id
 * @property string $create_time
 * @property string $expire_time
 * @property string $used_time
 * @property integer $order_id
 * @property integer $is_used
 */
class DeliveryVolumes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeliveryVolumes the static model class
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
		return 'green_delivery_volumes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('goods_id', 'required'),
			array('volumes_id, goods_id, user_id, order_id, is_used', 'numerical', 'integerOnly'=>true),
			array('volumes_sn', 'length', 'max'=>30),
			array('create_time, expire_time, used_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('volumes_id, goods_id, volumes_sn, user_id, create_time, expire_time, used_time, order_id, is_used', 'safe', 'on'=>'search'),
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
                    'Goods' =>array( self::BELONGS_TO ,'Goods','goods_id','select'=>'goods_name')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'volumes_id' => 'Volumes',
			'goods_id' => 'Goods',
			'volumes_sn' => 'Volumes Sn',
			'user_id' => 'User',
			'create_time' => 'Create Time',
			'expire_time' => 'Expire Time',
			'used_time' => 'Used Time',
			'order_id' => 'Order',
			'is_used' => 'Is Used',
                        'is_shipping_free' => 'Is Shipping Free',
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

		$criteria->compare('volumes_id',$this->volumes_id);
		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('volumes_sn',$this->volumes_sn,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('expire_time',$this->expire_time,true);
		$criteria->compare('used_time',$this->used_time,true);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('is_used',$this->is_used);
                $criteria->compare('is_shipping_free',$this->is_shipping_free);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        

        public function getCreateTime()
        {
               return   date("Y-m-d H:i:s", $this->create_time);  

        }
        public function getExpireTime()
        {
                return   date("Y-m-d H:i:s", $this->expire_time);

        }

             
}