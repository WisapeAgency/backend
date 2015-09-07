<?php

/**
 * This is the model class for table "Payment_Record".
 *
 * The followings are the available columns in table 'Payment_Record':
 * @property integer $id
 * @property string $order_id
 * @property string $email
 * @property string $date
 * @property string $order_total
 * @property string $name
 * @property string $company
 * @property string $phone
 * @property string $product_shipping
 * @property integer $affiliate_id
 * @property string $ship_state
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
			array('id, affiliate_id', 'numerical', 'integerOnly'=>true),
			array('order_id, email, name', 'length', 'max'=>100),
			array('date, order_total, phone, product_shipping', 'length', 'max'=>50),
			array('company', 'length', 'max'=>200),
			array('ship_state', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, email, date, order_total, name, company, phone, product_shipping, affiliate_id, ship_state', 'safe', 'on'=>'search'),
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
			'email' => 'Email',
			'date' => 'Date',
			'order_total' => 'Order Total',
			'name' => 'Name',
			'company' => 'Company',
			'phone' => 'Phone',
			'product_shipping' => 'Product Shipping',
			'affiliate_id' => 'Affiliate',
			'ship_state' => 'Ship State',
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

		$criteria->compare('email',$this->email,true);

		$criteria->compare('date',$this->date,true);

		$criteria->compare('order_total',$this->order_total,true);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('company',$this->company,true);

		$criteria->compare('phone',$this->phone,true);

		$criteria->compare('product_shipping',$this->product_shipping,true);

		$criteria->compare('affiliate_id',$this->affiliate_id);

		$criteria->compare('ship_state',$this->ship_state,true);

		return new CActiveDataProvider('Payment_Record', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return Payment_Record the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}