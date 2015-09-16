<?php

/**
 * This is the model class for table "fonts".
 *
 * The followings are the available columns in table 'fonts':
 * @property integer $id
 * @property string $name
 * @property string $preview_img
 * @property string $zip_url
 * @property string $rec_status
 * @property string $default_down
 */
class Fonts extends CActiveRecord
{

    public $dir_url;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fonts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('name, preview_img, zip_url', 'required'),
			array('name', 'length', 'max'=>50),
			array('zip_url', 'length', 'max'=>200),
			array('default_down', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, preview_img, zip_url,dir_url,default_down,rec_status', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'preview_img' => 'Preview Image',
			'zip_url' => 'Zip Url',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('zip_url',$this->zip_url,true);
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
	 * @return Fonts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
