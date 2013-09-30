<?php

/**
 * This is the model class for table "green_goods_gallery".
 *
 * The followings are the available columns in table 'green_goods_gallery':
 * @property integer $img_id
 * @property integer $goods_id
 * @property string $img_url
 * @property string $img_desc
 * @property string $thumb_url
 * @property string $img_original
 */
class GoodsGallery extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GoodsGallery the static model class
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
		return 'green_goods_gallery';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('goods_id', 'numerical', 'integerOnly'=>true),
			array('img_url, img_desc, thumb_url, img_original', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('img_id, goods_id, img_url, img_desc, thumb_url, img_original', 'safe', 'on'=>'search'),
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
			'img_id' => 'Img',
			'goods_id' => 'Goods',
			'img_url' => 'Img Url',
			'img_desc' => 'Img Desc',
			'thumb_url' => 'Thumb Url',
			'img_original' => 'Img Original',
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

		$criteria->compare('img_id',$this->img_id);
		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('img_url',$this->img_url,true);
		$criteria->compare('img_desc',$this->img_desc,true);
		$criteria->compare('thumb_url',$this->thumb_url,true);
		$criteria->compare('img_original',$this->img_original,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}