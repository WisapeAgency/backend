<?php

/**
 * This is the model class for table "payment_record".
 *
 * The followings are the available columns in table 'payment_record':
 * @property integer $id
 * @property string $order_id
 * @property string $item
 * @property string $email
 * @property string $date
 * @property double $order_total
 * @property string $name
 * @property string $company
 * @property string $addr1
 * @property string $addr2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $country
 * @property string $phone
 * @property string $product_name
 * @property double $product_price
 * @property string $currency_id
 * @property double $currency_total
 * @property integer $affiliate_id
 */
class PaymentRecord extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment_record';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('affiliate_id', 'numerical', 'integerOnly'=>true),
			array('order_total, product_price, currency_total', 'numerical'),
			array('order_id, email, name, city, state', 'length', 'max'=>100),
			array('item, date, phone', 'length', 'max'=>50),
			array('company, product_name', 'length', 'max'=>200),
			array('addr1, addr2', 'length', 'max'=>500),
			array('zip, country, currency_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, item, email, date, order_total, name, company, addr1, addr2, city, state, zip, country, phone, product_name, product_price, currency_id, currency_total, affiliate_id', 'safe', 'on'=>'search'),
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
			'id' => 'Id',
			'order_id' => 'Order',
			'item' => 'Item',
			'email' => 'Email',
			'date' => 'Date',
			'order_total' => 'Order Total',
			'name' => 'Name',
			'company' => 'Company',
			'addr1' => 'Addr1',
			'addr2' => 'Addr2',
			'city' => 'City',
			'state' => 'State',
			'zip' => 'Zip',
			'country' => 'Country',
			'phone' => 'Phone',
			'product_name' => 'Product Name',
			'product_price' => 'Product Price',
			'currency_id' => 'Currency',
			'currency_total' => 'Currency Total',
			'affiliate_id' => 'Affiliate',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('order_id',$this->order_id,true);

		$criteria->compare('item',$this->item,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('date',$this->date,true);

		$criteria->compare('order_total',$this->order_total);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('company',$this->company,true);

		$criteria->compare('addr1',$this->addr1,true);

		$criteria->compare('addr2',$this->addr2,true);

		$criteria->compare('city',$this->city,true);

		$criteria->compare('state',$this->state,true);

		$criteria->compare('zip',$this->zip,true);

		$criteria->compare('country',$this->country,true);

		$criteria->compare('phone',$this->phone,true);

		$criteria->compare('product_name',$this->product_name,true);

		$criteria->compare('product_price',$this->product_price);

		$criteria->compare('currency_id',$this->currency_id,true);

		$criteria->compare('currency_total',$this->currency_total);

		$criteria->compare('affiliate_id',$this->affiliate_id);

		return new CActiveDataProvider('payment_record', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return payment_record the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}