<?php

/**
 * This is the model class for table "active".
 *
 * The followings are the available columns in table 'active':
 * @property integer $id
 * @property string $title
 * @property string $bg_img
 * @property string $url
 * @property string $rec_status
 * @property integer $start_time
 * @property integer $end_time
 * @property string $country
 */
class Active extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'active';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('title, bg_img, url, rec_status, start_time, end_time, country', 'required'),
			array('start_time, end_time', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('bg_img, url', 'length', 'max'=>255),
			array('rec_status', 'length', 'max'=>1),
			array('country', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, bg_img, url, rec_status, start_time, end_time, country', 'safe', 'on'=>'search'),
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
			'title' => '标题',
			'bg_img' => '背景图片',
			'url' => '网址',
			'rec_status' => '状态',
			'start_time' => '开始时间',
			'end_time' => '结束时间',
			'country' => '国家代码',
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
		$criteria->compare('bg_img',$this->bg_img,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('rec_status',$this->rec_status,true);
		$criteria->compare('start_time',$this->start_time);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('country',$this->country,true);

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
	 * @return Active the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
