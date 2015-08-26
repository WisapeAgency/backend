<?php

/**
 * This is the model class for table "music".
 *
 * The followings are the available columns in table 'music':
 * @property integer $id
 * @property string $music_name
 * @property string $music_url
 * @property integer $type
 * @property string $rec_status
 * @property string $default_down
 */
class Music extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'music';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('music_name, music_url', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('music_name', 'length', 'max'=>100),
			array('music_url', 'length', 'max'=>255),
			array('rec_status, default_down', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, music_name, music_url, type, rec_status,default_down', 'safe', 'on'=>'search'),
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
            'typeName'=>array(self::BELONGS_TO,'MusicType','type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'music_name' => 'Music Name',
			'music_url' => 'Music Url',
			'type' => 'Type',
			'rec_status' => '状态',
			'default_down' => '静默下载',
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
		$criteria->compare('music_name',$this->music_name,true);
		$criteria->compare('music_url',$this->music_url,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('rec_status',$this->rec_status,true);
		$criteria->compare('default_down',$this->default_down,true);

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
	 * @return Music the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
