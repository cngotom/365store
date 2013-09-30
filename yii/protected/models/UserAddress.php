<?php

/**
 * This is the model class for table "green_user_address".
 *
 * The followings are the available columns in table 'green_user_address':
 * @property integer $address_id
 * @property string $address_name
 * @property integer $user_id
 * @property string $consignee
 * @property string $email
 * @property integer $country
 * @property integer $province
 * @property integer $city
 * @property integer $district
 * @property string $address
 * @property string $zipcode
 * @property string $tel
 * @property string $mobile
 * @property string $sign_building
 * @property string $best_time
 * @property integer $is_default
 */
class UserAddress extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserAddress the static model class
	 */
    
        private $cityName="",$districtName="",$provinceName="";
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'green_user_address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, country, province, city, district, is_default', 'numerical', 'integerOnly'=>true),
			array('address_name', 'length', 'max'=>50),
			array('consignee, email, zipcode, tel, mobile', 'length', 'max'=>60),
			array('address, sign_building, best_time', 'length', 'max'=>120),
                        array('country','default','value' => 1),
                        array('is_default','default','value' => 0),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('address_id, address_name, user_id, consignee, email, country, province, city, district, address, zipcode, tel, mobile, sign_building, best_time, is_default', 'safe', 'on'=>'search'),
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
			'address_id' => 'Address',
			'address_name' => 'Address Name',
			'user_id' => 'User',
			'consignee' => 'Consignee',
			'email' => 'Email',
			'country' => 'Country',
			'province' => 'Province',
			'city' => 'City',
			'district' => 'District',
			'address' => 'Address',
			'zipcode' => 'Zipcode',
			'tel' => 'Tel',
			'mobile' => 'Mobile',
			'sign_building' => 'Sign Building',
			'best_time' => 'Best Time',
			'is_default' => 'Is Default',
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

		$criteria->compare('address_id',$this->address_id);
		$criteria->compare('address_name',$this->address_name,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('consignee',$this->consignee,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('country',$this->country);
		$criteria->compare('province',$this->province);
		$criteria->compare('city',$this->city);
		$criteria->compare('district',$this->district);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('sign_building',$this->sign_building,true);
		$criteria->compare('best_time',$this->best_time,true);
		$criteria->compare('is_default',$this->is_default);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function getProvinceName()
        {
            if(empty($this->$provinceName) )
            {
                if($this->province)
                {
                    
                    $region = Region::model()->findByAttributes(array('region_id' => $this->province));
                    $this->provinceName = $region->region_name;
                }
      
            }
            
            return $this->provinceName;
        }
        
         public function getCityName()
        {
             if(empty($this->$cityName) )
            {
                if($this->city)
                {
                    
                    $region = Region::model()->findByAttributes(array('region_id' => $this->city));
                    $this->cityName = $region->region_name;
                }
      
            }
            
            return $this->cityName;
        }
        
         public function getDistrictName()
        {
             if(empty($this->districtName) )
            {
                if($this->district)
                {
                    
                    $region = Region::model()->findByAttributes(array('region_id' => $this->district));
                    $this->districtName = $region->region_name;
                }
      
            }
            
            return $this->districtName;
        }
}