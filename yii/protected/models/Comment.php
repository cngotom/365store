<?php

/**
 * This is the model class for table "green_comment".
 *
 * The followings are the available columns in table 'green_comment':
 * @property string $comment_id
 * @property integer $comment_type
 * @property integer $id_value
 * @property string $email
 * @property string $user_name
 * @property string $content
 * @property integer $comment_rank
 * @property string $add_time
 * @property string $ip_address
 * @property integer $status
 * @property string $parent_id
 * @property string $user_id
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return 'green_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content', 'required'),
			array('comment_type, id_value, comment_rank, status', 'numerical', 'integerOnly'=>true),
			array('email, user_name', 'length', 'max'=>60),
			array('add_time, parent_id, user_id', 'length', 'max'=>10),
			array('ip_address', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('comment_id, comment_type, id_value, email, user_name, content, comment_rank, add_time, ip_address, status, parent_id, user_id', 'safe', 'on'=>'search'),
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
			'comment_id' => 'Comment',
			'comment_type' => 'Comment Type',
			'id_value' => 'Id Value',
			'email' => 'Email',
			'user_name' => 'User Name',
			'content' => 'Content',
			'comment_rank' => 'Comment Rank',
			'add_time' => 'Add Time',
			'ip_address' => 'Ip Address',
			'status' => 'Status',
			'parent_id' => 'Parent',
			'user_id' => 'User',
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

		$criteria->compare('comment_id',$this->comment_id,true);
		$criteria->compare('comment_type',$this->comment_type);
		$criteria->compare('id_value',$this->id_value);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('comment_rank',$this->comment_rank);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('user_id',$this->user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getTime()  
        {
            return date("y/m H:i", $this->add_time);
        }

                
                
        public function getVagueEmail()
        {
           
            return  preg_replace('/(\w{3})[^@]*@/', "$1****@", $this->email);
        }
}