<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property string $nick_name
 * @property string $user_pwd
 * @property string $user_email
 * @property string $user_ext
 * @property string $user_ext_name
 * @property string $user_sex
 * @property string $user_ico_n
 * @property string $user_ico_b
 * @property string $user_ico_s
 * @property integer $user_token_id
 * @property string $access_token
 * @property string $user_back_img
 * @property string $unique_str
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nick_name', 'required'),
			array('user_token_id', 'numerical', 'integerOnly'=>true),
			array('user_pwd, user_ext_name', 'length', 'max'=>50),
			array('user_email', 'length', 'max'=>60),
			array('user_ext, user_sex', 'length', 'max'=>1),
			array('user_ico_n, user_ico_b, user_ico_s, user_back_img, unique_str', 'length', 'max'=>255),
			array('access_token', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, nick_name, user_pwd, user_email, user_ext, user_ext_name, user_sex, user_ico_n, user_ico_b, user_ico_s, user_token_id, access_token, user_back_img, unique_str', 'safe', 'on'=>'search'),
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
			'nick_name' => '用户昵称',
			'user_pwd' => '用户密码',
			'user_email' => '邮箱地址',
			'user_ext' => '1email,2twitter3facebook',
			'user_ext_name' => '第三方帐号用户名',
			'user_sex' => 'F/M/S保密',
			'user_ico_n' => '头像普通',
			'user_ico_b' => '头像大图',
			'user_ico_s' => '头像小图',
			'user_token_id' => 'token_id',
			'access_token' => 'Access Token',
			'user_back_img' => '用户资料背景图',
			'unique_str' => '第三方平台唯一标识',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('nick_name',$this->nick_name,true);
		$criteria->compare('user_pwd',$this->user_pwd,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_ext',$this->user_ext,true);
		$criteria->compare('user_ext_name',$this->user_ext_name,true);
		$criteria->compare('user_sex',$this->user_sex,true);
		$criteria->compare('user_ico_n',$this->user_ico_n,true);
		$criteria->compare('user_ico_b',$this->user_ico_b,true);
		$criteria->compare('user_ico_s',$this->user_ico_s,true);
		$criteria->compare('user_token_id',$this->user_token_id);
		$criteria->compare('access_token',$this->access_token,true);
		$criteria->compare('user_back_img',$this->user_back_img,true);
		$criteria->compare('unique_str',$this->unique_str,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
