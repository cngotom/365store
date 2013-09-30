<?php

/**
 * This is the model class for table "green_goods".
 *
 * The followings are the available columns in table 'green_goods':
 * @property integer $goods_id
 * @property integer $cat_id
 * @property string $goods_sn
 * @property string $goods_name
 * @property string $goods_name_style
 * @property string $click_count
 * @property integer $brand_id
 * @property string $provider_name
 * @property integer $goods_number
 * @property string $goods_weight
 * @property string $market_price
 * @property string $shop_price
 * @property string $promote_price
 * @property string $promote_start_date
 * @property string $promote_end_date
 * @property integer $warn_number
 * @property string $keywords
 * @property string $goods_brief
 * @property string $goods_desc
 * @property string $goods_thumb
 * @property string $goods_img
 * @property string $original_img
 * @property integer $is_real
 * @property string $extension_code
 * @property integer $is_on_sale
 * @property integer $is_alone_sale
 * @property integer $is_shipping
 * @property string $integral
 * @property string $add_time
 * @property integer $sort_order
 * @property integer $is_delete
 * @property integer $is_best
 * @property integer $is_new
 * @property integer $is_hot
 * @property integer $is_promote
 * @property integer $bonus_type_id
 * @property string $last_update
 * @property integer $goods_type
 * @property string $seller_note
 * @property integer $give_integral
 * @property integer $rank_integral
 * @property integer $suppliers_id
 * @property integer $is_check
 * @property string $goods_advice
 */
class Goods extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Goods the static model class
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
		return 'green_goods';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('goods_desc', 'required'),
			array('cat_id, brand_id, goods_number, warn_number, is_real, is_on_sale, is_alone_sale, is_shipping, sort_order, is_delete, is_best, is_new, is_hot, is_promote, bonus_type_id, goods_type, give_integral, rank_integral, suppliers_id, is_check', 'numerical', 'integerOnly'=>true),
			array('goods_sn, goods_name_style', 'length', 'max'=>60),
			array('goods_name', 'length', 'max'=>120),
			array('click_count, goods_weight, market_price, shop_price, promote_price, integral, add_time, last_update', 'length', 'max'=>10),
			array('provider_name', 'length', 'max'=>100),
			array('promote_start_date, promote_end_date', 'length', 'max'=>11),
			array('keywords, goods_brief, goods_thumb, goods_img, original_img, seller_note', 'length', 'max'=>255),
			array('extension_code', 'length', 'max'=>30),
			array('goods_advice', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('goods_id, cat_id, goods_sn, goods_name, goods_name_style, click_count, brand_id, provider_name, goods_number, goods_weight, market_price, shop_price, promote_price, promote_start_date, promote_end_date, warn_number, keywords, goods_brief, goods_desc, goods_thumb, goods_img, original_img, is_real, extension_code, is_on_sale, is_alone_sale, is_shipping, integral, add_time, sort_order, is_delete, is_best, is_new, is_hot, is_promote, bonus_type_id, last_update, goods_type, seller_note, give_integral, rank_integral, suppliers_id, is_check, goods_advice', 'safe', 'on'=>'search'),
		);
	}

	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'goods_id' => 'Goods',
			'cat_id' => 'Cat',
			'goods_sn' => 'Goods Sn',
			'goods_name' => 'Goods Name',
			'goods_name_style' => 'Goods Name Style',
			'click_count' => 'Click Count',
			'brand_id' => 'Brand',
			'provider_name' => 'Provider Name',
			'goods_number' => 'Goods Number',
			'goods_weight' => 'Goods Weight',
			'market_price' => 'Market Price',
			'shop_price' => 'Shop Price',
			'promote_price' => 'Promote Price',
			'promote_start_date' => 'Promote Start Date',
			'promote_end_date' => 'Promote End Date',
			'warn_number' => 'Warn Number',
			'keywords' => 'Keywords',
			'goods_brief' => 'Goods Brief',
			'goods_desc' => 'Goods Desc',
			'goods_thumb' => 'Goods Thumb',
			'goods_img' => 'Goods Img',
			'original_img' => 'Original Img',
			'is_real' => 'Is Real',
			'extension_code' => 'Extension Code',
			'is_on_sale' => 'Is On Sale',
			'is_alone_sale' => 'Is Alone Sale',
			'is_shipping' => 'Is Shipping',
			'integral' => 'Integral',
			'add_time' => 'Add Time',
			'sort_order' => 'Sort Order',
			'is_delete' => 'Is Delete',
			'is_best' => 'Is Best',
			'is_new' => 'Is New',
			'is_hot' => 'Is Hot',
			'is_promote' => 'Is Promote',
			'bonus_type_id' => 'Bonus Type',
			'last_update' => 'Last Update',
			'goods_type' => 'Goods Type',
			'seller_note' => 'Seller Note',
			'give_integral' => 'Give Integral',
			'rank_integral' => 'Rank Integral',
			'suppliers_id' => 'Suppliers',
			'is_check' => 'Is Check',
			'goods_advice' => 'Goods Advice',
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

		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('goods_sn',$this->goods_sn,true);
		$criteria->compare('goods_name',$this->goods_name,true);
		$criteria->compare('goods_name_style',$this->goods_name_style,true);
		$criteria->compare('click_count',$this->click_count,true);
		$criteria->compare('brand_id',$this->brand_id);
		$criteria->compare('provider_name',$this->provider_name,true);
		$criteria->compare('goods_number',$this->goods_number);
		$criteria->compare('goods_weight',$this->goods_weight,true);
		$criteria->compare('market_price',$this->market_price,true);
		$criteria->compare('shop_price',$this->shop_price,true);
		$criteria->compare('promote_price',$this->promote_price,true);
		$criteria->compare('promote_start_date',$this->promote_start_date,true);
		$criteria->compare('promote_end_date',$this->promote_end_date,true);
		$criteria->compare('warn_number',$this->warn_number);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('goods_brief',$this->goods_brief,true);
		$criteria->compare('goods_desc',$this->goods_desc,true);
		$criteria->compare('goods_thumb',$this->goods_thumb,true);
		$criteria->compare('goods_img',$this->goods_img,true);
		$criteria->compare('original_img',$this->original_img,true);
		$criteria->compare('is_real',$this->is_real);
		$criteria->compare('extension_code',$this->extension_code,true);
		$criteria->compare('is_on_sale',$this->is_on_sale);
		$criteria->compare('is_alone_sale',$this->is_alone_sale);
		$criteria->compare('is_shipping',$this->is_shipping);
		$criteria->compare('integral',$this->integral,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('is_delete',$this->is_delete);
		$criteria->compare('is_best',$this->is_best);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('is_promote',$this->is_promote);
		$criteria->compare('bonus_type_id',$this->bonus_type_id);
		$criteria->compare('last_update',$this->last_update,true);
		$criteria->compare('goods_type',$this->goods_type);
		$criteria->compare('seller_note',$this->seller_note,true);
		$criteria->compare('give_integral',$this->give_integral);
		$criteria->compare('rank_integral',$this->rank_integral);
		$criteria->compare('suppliers_id',$this->suppliers_id);
		$criteria->compare('is_check',$this->is_check);
		$criteria->compare('goods_advice',$this->goods_advice,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        /**
	 * @return array relational rules.
	 */

         public function relations()
        {
            return array(
                'gallery'=>array(self::HAS_MANY, 'GoodsGallery', 'goods_id'),
                'comment' =>array(self::HAS_MANY, 'Comment', 'goods_id'),
            );
        }
           public function scopes() { 
            return array( 
                'on_sale'=> array(
                    'condition'=>'is_on_sale = 1 and is_delete = 0 ',
                ),
                //'recently' => array( 'order'=>'create_time DESC', 'limit'=>5, ), 
             ); 
            
        }
}