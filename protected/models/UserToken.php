<?php

/**
 * This is the model class for table "user_token".
 *
 * The followings are the available columns in table 'user_token':
 * @property integer $user_token_id
 * @property integer $user_id
 * @property string $user_token
 * @property integer $token_start
 * @property integer $token_end
 *
 * The followings are the available model relations:
 * @property User[] $users
 */
class UserToken extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_token';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('user_id, user_token', 'required'),
//			array('user_id, token_start, token_end', 'numerical', 'integerOnly'=>true),
			array('user_token', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_token_id, user_id, user_token, token_start, token_end', 'safe', 'on'=>'search'),
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
			'users' => array(self::HAS_MANY, 'User', 'user_token_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_token_id' => 'User Token',
			'user_id' => 'User',
			'user_token' => 'User Token',
			'token_start' => 'Token Start',
			'token_end' => 'Token End',
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

		$criteria->compare('user_token_id',$this->user_token_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_token',$this->user_token,true);
		$criteria->compare('token_start',$this->token_start);
		$criteria->compare('token_end',$this->token_end);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserToken the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
