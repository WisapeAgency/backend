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
	
	static function send($obj, $useMasterKey = false){
		if(is_array($obj)){
			$obj['action'] = 'com.wisape.android.content.MessageCenterReceiver';
		}
		self::init();
		$data = array(
				'channels' => ['abcde'],
				'data' => $obj
		);
		ParsePush::send($data, $useMasterKey);
		
// 		$testObject = ParseObject::create("TestObject");
// 		$testObject->set("foo", "bar");
// 		$testObject->save();
	}
	
	
}