<?php

/**
 * This is the model class for table "green_account_log".
 *
 * The followings are the available columns in table 'green_account_log':
 * @property integer $log_id
 * @property integer $user_id
 * @property string $user_money
 * @property string $frozen_money
 * @property integer $rank_points
 * @property integer $pay_points
 * @property string $change_time
 * @property string $change_desc
 * @property integer $change_type
 */
class AccountLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AccountLog the static model class
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
		return 'green_account_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, rank_points, pay_points, change_type', 'numerical', 'integerOnly'=>true),
			array('user_money, frozen_money, change_time', 'length', 'max'=>10),
			array('change_desc', 'length', 'max'=>255),
                        array('user_money,frozen_money,rank_points,pay_points','default','value' => 0),
                        array('change_type','default','value' =>2),
                    	array('user_id, user_money, frozen_money, rank_points, pay_points, change_time, change_desc, change_type', 'required'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('log_id, user_id, user_money, frozen_money, rank_points, pay_points, change_time, change_desc, change_type', 'safe', 'on'=>'search'),
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
			'log_id' => 'Log',
			'user_id' => 'User',
			'user_money' => 'User Money',
			'frozen_money' => 'Frozen Money',
			'rank_points' => 'Rank Points',
			'pay_points' => 'Pay Points',
			'change_time' => 'Change Time',
			'change_desc' => 'Change Desc',
			'change_type' => 'Change Type',
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

		$criteria->compare('log_id',$this->log_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_money',$this->user_money,true);
		$criteria->compare('frozen_money',$this->frozen_money,true);
		$criteria->compare('rank_points',$this->rank_points);
		$criteria->compare('pay_points',$this->pay_points);
		$criteria->compare('change_time',$this->change_time,true);
		$criteria->compare('change_desc',$this->change_desc,true);
		$criteria->compare('change_type',$this->change_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
     
}