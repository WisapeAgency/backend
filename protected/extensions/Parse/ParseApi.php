<?php
require 'autoload.php';

use Parse\ParseClient;
use Parse\ParsePush;
use Parse\ParseInstallation;


class ParseApi{
	
	private static function init(){
		ParseClient::initialize(
			'L3WrrhBJmbPhRoJ4GYIUDMIErlR8IlvkJuQQJ0Px',
			'dujfaR7DuXDtZ7n3Y70V96jdvcJLEEbsHwh1IYj3',
			'bAurJfR7c5l3vKZdhozbQCVO08hAi4ySnU6MpSAw'
		);
	}
	
	private static function convert($time){
		$time = date('Y-m-d H:i:s', strtotime($time) - 8 * 3600);
		return new DateTime($time);
	}
	
	static function send($content, $param=array()){
		self::init();
		//app端接收消息的action
		$content['action'] = 'com.wisape.android.content.MessageCenterReceiver';
		
		$query = ParseInstallation::query();
		//设置推送对象
		if(isset($param) && !empty($param['user'])){
			$query->equalTo('channels', $param['user']);
		}else{
			$query->equalTo('channels', 'abcde');
		}
		
		$data = array(
				'where' => $query,
				'data' => $content
		);
		//设置推送时间
		if(isset($param) && !empty($param['push_time'])){
			//转换为UTC时间
			$data['push_time'] = self::convert($param['push_time']);
		}
		//设置过期时间
		if(isset($param) && !empty($param['expiration_time'])){
			//转换为UTC时间
			$data['expiration_time'] = self::convert($param['expiration_time']);
		}
		
		ParsePush::send($data);
	}
	
	
}