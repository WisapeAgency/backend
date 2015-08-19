<?php

/**
 * This is the model class for table "StoryOfficial".
 *
 * The followings are the available columns in table 'StoryOfficial':
 * @property integer $id
 * @property string $name
 * @property string $zip_url
 * @property string $rec_status
 * @property string $createtime
 */
class StoryOfficial extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Story_Official';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, zip_url', 'required'),
			array('name', 'length', 'max'=>50),
			array('zip_url', 'length', 'max'=>500),
			array('rec_status', 'length', 'max'=>1),
			array('createtime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, zip_url, rec_status, createtime', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'zip_url' => 'Zip Url',
			'rec_status' => 'Rec Status',
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
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('zip_url',$this->zip_url,true);

		$criteria->compare('rec_status',$this->rec_status,true);

		$criteria->compare('createtime',$this->createtime,true);

		return new CActiveDataProvider('StoryOfficial', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return StoryOfficial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}