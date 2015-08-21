<?php
require 'autoload.php';

use Parse\ParseClient;
use Parse\ParsePush;
use Parse\ParseObject;


class ParseApi{
	
	
	private static function init(){
		ParseClient::initialize(
			'L3WrrhBJmbPhRoJ4GYIUDMIErlR8IlvkJuQQJ0Px',
			'dujfaR7DuXDtZ7n3Y70V96jdvcJLEEbsHwh1IYj3',
			'bAurJfR7c5l3vKZdhozbQCVO08hAi4ySnU6MpSAw'
		);
	}
	
	static function send($obj, $user=false){
		if(!is_array($obj)){
			return false;
		}
		self::init();
		//app端接收消息的action
		$obj['action'] = 'com.wisape.android.content.MessageCenterReceiver';
		//设置推送对象
		if(isset($user) && !empty($user)){
			$channel = [$user];
		}else{
			$channel = ['abcde'];
		}
		
		$data = array(
				'channels' => $channel,
				'data' => $obj
		);
		ParsePush::send($data);
		
// 		$testObject = ParseObject::create("TestObject");
// 		$testObject->set("foo", "bar");
// 		$testObject->save();
	}
	
	
}