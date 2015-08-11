<?php

/**
 * This is the model class for table "request_person".
 *
 * The followings are the available columns in table 'request_person':
 * @property integer $id
 * @property string $req_type
 * @property string $first_name
 * @property string $last_name
 * @property string $company_name
 * @property string $country
 * @property string $user_email
 * @property string $message
 * @property string $createtime
 */
class RequestPerson extends CActiveRecord
{
    //public $repeat_email;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'request_person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, country, user_email', 'required','message'=>'This field is required'),
			array('req_type', 'length', 'max'=>1),
			array('first_name, last_name, country', 'length', 'max'=>50),
			array('company_name', 'length', 'max'=>255),
			array('user_email', 'length', 'max'=>100),
			array('user_email', 'email','message'=>'It seems to be invalid Email'),
			array('message', 'safe'),
			array('user_email', 'unique','message'=>'The email address has already been registered'),
            //array('repeat_email', 'required'),
            //array('repeat_email', 'compare', 'compareAttribute'=>'user_email','message'=>'Re-Enter Email does not match'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, req_type, first_name, last_name, company_name, country, user_email, message, createtime', 'safe', 'on'=>'search'),
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
			'req_type' => 'Req Type',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'company_name' => 'Company Name',
			'country' => 'Country',
			'user_email' => 'User Email',
			'message' => 'Message',
			'createtime' => 'Createtime',
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
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('req_type',$this->req_type,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('createtime',$this->createtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'id DESC',
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestPerson the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
