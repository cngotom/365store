<?php

/**
 * This is the model class for table "green_back_bank".
 *
 * The followings are the available columns in table 'green_back_bank':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $card_no
 * @property integer $bank_no
 * @property string $location
 * @property string $netpot
 * @property string $reason
 * @property string $mobile
 * @property integer $create_time
 * @property double $money
 * @property integer $status
 * @property integer $back_time
 */
class BackBank extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BackBank the static model class
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
		return 'green_back_bank';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, name, card_no, bank_no, mobile, status', 'required'),
			array('user_id, bank_no, create_time, status, back_time', 'numerical', 'integerOnly'=>true),
			array('money', 'numerical'),
			array('name', 'length', 'max'=>30),
			array('card_no, netpot', 'length', 'max'=>40),
			array('location', 'length', 'max'=>80),
			array('reason', 'length', 'max'=>120),
			array('mobile', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, name, card_no, bank_no, location, netpot, reason, mobile, create_time, money, status, back_time', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'user_id' => 'User',
			'name' => 'Name',
			'card_no' => 'Card No',
			'bank_no' => 'Bank No',
			'location' => 'Location',
			'netpot' => 'Netpot',
			'reason' => 'Reason',
			'mobile' => 'Mobile',
			'create_time' => 'Create Time',
			'money' => 'Money',
			'status' => 'Status',
			'back_time' => 'Back Time',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('card_no',$this->card_no,true);
		$criteria->compare('bank_no',$this->bank_no);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('netpot',$this->netpot,true);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('money',$this->money);
		$criteria->compare('status',$this->status);
		$criteria->compare('back_time',$this->back_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}