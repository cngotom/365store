<?php

/**
 * This is the model class for table "green_users".
 *
 * The followings are the available columns in table 'green_users':
 * @property integer $user_id
 * @property string $email
 * @property string $user_name
 * @property string $password
 * @property string $question
 * @property string $answer
 * @property integer $sex
 * @property string $birthday
 * @property string $user_money
 * @property string $frozen_money
 * @property string $pay_points
 * @property string $rank_points
 * @property integer $address_id
 * @property string $reg_time
 * @property string $last_login
 * @property string $last_time
 * @property string $last_ip
 * @property integer $visit_count
 * @property integer $user_rank
 * @property integer $is_special
 * @property string $ec_salt
 * @property string $salt
 * @property integer $parent_id
 * @property integer $flag
 * @property string $alias
 * @property string $msn
 * @property string $qq
 * @property string $office_phone
 * @property string $home_phone
 * @property string $mobile_phone
 * @property integer $is_validated
 * @property string $credit_line
 * @property string $passwd_question
 * @property string $passwd_answer
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'green_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('alias, msn, qq, office_phone, home_phone, mobile_phone, credit_line', 'required'),
			array('sex, address_id, visit_count, user_rank, is_special, parent_id, flag, is_validated', 'numerical', 'integerOnly'=>true),
			array('email, user_name, alias, msn', 'length', 'max'=>60),
			array('password', 'length', 'max'=>32),
			array('question, answer, passwd_answer', 'length', 'max'=>255),
			array('user_money, frozen_money, pay_points, rank_points, reg_time, ec_salt, salt, credit_line', 'length', 'max'=>10),
			array('last_login', 'length', 'max'=>11),
			array('last_ip', 'length', 'max'=>15),
			array('qq, office_phone, home_phone, mobile_phone', 'length', 'max'=>20),
			array('passwd_question', 'length', 'max'=>50),
			array('birthday, last_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, email, user_name, password, question, answer, sex, birthday, user_money, frozen_money, pay_points, rank_points, address_id, reg_time, last_login, last_time, last_ip, visit_count, user_rank, is_special, ec_salt, salt, parent_id, flag, alias, msn, qq, office_phone, home_phone, mobile_phone, is_validated, credit_line, passwd_question, passwd_answer', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'email' => 'Email',
			'user_name' => 'User Name',
			'password' => 'Password',
			'question' => 'Question',
			'answer' => 'Answer',
			'sex' => 'Sex',
			'birthday' => 'Birthday',
			'user_money' => 'User Money',
			'frozen_money' => 'Frozen Money',
			'pay_points' => 'Pay Points',
			'rank_points' => 'Rank Points',
			'address_id' => 'Address',
			'reg_time' => 'Reg Time',
			'last_login' => 'Last Login',
			'last_time' => 'Last Time',
			'last_ip' => 'Last Ip',
			'visit_count' => 'Visit Count',
			'user_rank' => 'User Rank',
			'is_special' => 'Is Special',
			'ec_salt' => 'Ec Salt',
			'salt' => 'Salt',
			'parent_id' => 'Parent',
			'flag' => 'Flag',
			'alias' => 'Alias',
			'msn' => 'Msn',
			'qq' => 'Qq',
			'office_phone' => 'Office Phone',
			'home_phone' => 'Home Phone',
			'mobile_phone' => 'Mobile Phone',
			'is_validated' => 'Is Validated',
			'credit_line' => 'Credit Line',
			'passwd_question' => 'Passwd Question',
			'passwd_answer' => 'Passwd Answer',
		);
	}
        public function primaryKey()
        {
            return 'user_id';
            // return array('pk1', 'pk2');
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('user_money',$this->user_money,true);
		$criteria->compare('frozen_money',$this->frozen_money,true);
		$criteria->compare('pay_points',$this->pay_points,true);
		$criteria->compare('rank_points',$this->rank_points,true);
		$criteria->compare('address_id',$this->address_id);
		$criteria->compare('reg_time',$this->reg_time,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('last_time',$this->last_time,true);
		$criteria->compare('last_ip',$this->last_ip,true);
		$criteria->compare('visit_count',$this->visit_count);
		$criteria->compare('user_rank',$this->user_rank);
		$criteria->compare('is_special',$this->is_special);
		$criteria->compare('ec_salt',$this->ec_salt,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('flag',$this->flag);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('msn',$this->msn,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('office_phone',$this->office_phone,true);
		$criteria->compare('home_phone',$this->home_phone,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('is_validated',$this->is_validated);
		$criteria->compare('credit_line',$this->credit_line,true);
		$criteria->compare('passwd_question',$this->passwd_question,true);
		$criteria->compare('passwd_answer',$this->passwd_answer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}