<?php

/**
 * This is the model class for table "green_user_bonus".
 *
 * The followings are the available columns in table 'green_user_bonus':
 * @property integer $bonus_id
 * @property integer $bonus_type_id
 * @property string $bonus_sn
 * @property integer $user_id
 * @property string $used_time
 * @property integer $order_id
 * @property integer $emailed
 */
class UserBonus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserBonus the static model class
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
		return 'green_user_bonus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bonus_type_id, user_id, order_id, emailed', 'numerical', 'integerOnly'=>true),
			array('bonus_sn', 'length', 'max'=>20),
			array('used_time', 'length', 'max'=>10),
                        array('emailed','default','value' => 1),
                        array('bonus_sn,used_time,order_id','default','value' => 0),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bonus_id, bonus_type_id, bonus_sn, user_id, used_time, order_id, emailed', 'safe', 'on'=>'search'),
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
			'bonus_id' => 'Bonus',
			'bonus_type_id' => 'Bonus Type',
			'bonus_sn' => 'Bonus Sn',
			'user_id' => 'User',
			'used_time' => 'Used Time',
			'order_id' => 'Order',
			'emailed' => 'Emailed',
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

		$criteria->compare('bonus_id',$this->bonus_id);
		$criteria->compare('bonus_type_id',$this->bonus_type_id);
		$criteria->compare('bonus_sn',$this->bonus_sn,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('used_time',$this->used_time,true);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('emailed',$this->emailed);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}