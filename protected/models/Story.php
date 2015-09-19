<?php

/**
 * This is the model class for table "story".
 *
 * The followings are the available columns in table 'story':
 * @property integer $id
 * @property integer $uid
 * @property string $story_name
 * @property string $story_url
 * @property string $description
 * @property string $bg_music
 * @property string $small_img
 * @property string $rec_status
 * @property integer $share_num
 * @property integer $like_num
 * @property integer $view_num
 * @property integer $createtime
 */
class Story extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'story';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, share_num, like_num, view_num, createtime', 'numerical', 'integerOnly'=>true),
			array('story_name, story_url', 'length', 'max'=>200),
			array('small_img', 'length', 'max'=>255),
			array('rec_status', 'length', 'max'=>1),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, story_name, story_url, description, bg_music, small_img, rec_status, share_num, like_num, view_num, createtime', 'safe', 'on'=>'search'),
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
			'uid' => 'Uid',
			'story_name' => 'Story Name',
			'story_url' => 'Story Url',
			'description' => 'Description',
			'small_img' => 'Small Img',
			'rec_status' => 'A D T',
			'share_num' => 'Share Num',
			'like_num' => 'Like Num',
			'view_num' => 'View Num',
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
		$criteria->compare('uid',$this->uid);
		$criteria->compare('story_name',$this->story_name,true);
		$criteria->compare('story_url',$this->story_url,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('small_img',$this->small_img,true);
		$criteria->compare('rec_status',$this->rec_status,true);
		$criteria->compare('share_num',$this->share_num);
		$criteria->compare('like_num',$this->like_num);
		$criteria->compare('view_num',$this->view_num);
		$criteria->compare('createtime',$this->createtime);

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
	 * @return Story the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
