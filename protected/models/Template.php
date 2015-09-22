<?php

/**
 * This is the model class for table "template".
 *
 * The followings are the available columns in table 'template':
 * @property integer $id
 * @property string $temp_name
 * @property string $temp_img
 * @property string $temp_description
 * @property string $temp_url
 * @property string $rec_status
 * @property integer $type
 * @property integer $order
 * @property string $order_type
 * @property string $default_down
 */
class Template extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('temp_name, temp_img, temp_url, type', 'required'),
			array('type, order', 'numerical', 'integerOnly'=>true),
			array('temp_name', 'length', 'max'=>200),
			array('temp_img, temp_url', 'length', 'max'=>255),
			array('rec_status, order_type, default_down', 'length', 'max'=>1),
			array('temp_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, temp_name, temp_img, temp_description, temp_url, rec_status, type, order, order_type', 'safe', 'on'=>'search'),
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
            'typeName'=>array(self::BELONGS_TO,'TemplateType','type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'temp_name' => 'Temp Name',
			'temp_img' => 'Temp Img',
			'temp_description' => 'Temp Description',
			'temp_url' => 'Temp Url',
			'rec_status' => '状态',
			'type' => 'Type',
			'order' => '排序',
			'order_type' => 'H N',
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
		$criteria->compare('temp_name',$this->temp_name,true);
		$criteria->compare('temp_img',$this->temp_img,true);
		$criteria->compare('temp_description',$this->temp_description,true);
		$criteria->compare('temp_url',$this->temp_url,true);
		$criteria->compare('rec_status',$this->rec_status,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('order',$this->order);
		$criteria->compare('order_type',$this->order_type,true);
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
	 * @return Template the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
