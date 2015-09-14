<?php
class ResetPWD extends CFormModel
{
	public $password;
	public $confirm_password;
	public $user_id;
	
	
	public function rules()
	{
		return array(
				array('password,confirm_password','required','message'=>'This field is required'),
				array('confirm_password','compare','compareAttribute'=>'password','message'=>'Should be the same')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'password' => 'PassWord',
				'confirm_password' => 'Confirm_Password',
				'user_id' =>'User_id'
		);
	}
}