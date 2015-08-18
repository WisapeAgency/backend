<?php

/**
 * This is the model class for table "send_message".
 *
 * The followings are the available columns in table 'send_message':
 * @property integer $id
 * @property string $title
 * @property string $user_email
 * @property string $subject
 * @property string $user_message
 * @property string $parsetime
 * @property string $createtime
 */
class SendMessage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'send_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, subject, parsetime', 'required','message'=>'This field is required'),
			array('title', 'length', 'max'=>60),
			array('user_email', 'length', 'max'=>100),
            array('user_email', 'email','message'=>'It seems to be invalid Email'),
			array('subject', 'length', 'max'=>200),
			array('user_message', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, user_email, subject, user_message, parsetime, createtime', 'safe', 'on'=>'search'),
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
			'user_email' => 'User Email',
			'title' => 'Message Title',
			'subject' => 'Message Subject',
			'user_message' => 'Message Content',	
			'parsetime' => 'Push time',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('user_message',$this->user_message,true);
		$criteria->compare('parsetime',$this->parsetime,true);
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
	 * @return SendMessage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
