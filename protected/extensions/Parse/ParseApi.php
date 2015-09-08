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
		if(empty($content['action'])){
			$content['action'] = 'com.wisape.android.content.MessageCenterReceiver';
		}
		
		$query = ParseInstallation::query();
		//设置推送对象
		if(isset($param) && !empty($param['user'])){
			$installId = self::getUserInstallId($param['user']);
			if(!$installId){
				//TODO 记录日志：没有找到推送对象
				return;
			}
			$query->equalTo('installationId', $installId);
		}else{
			$query->equalTo('channels', 'abcde');
		}
		//设置推送地区
		if(isset($param) && !empty($param['locale'])){
// 			$userQuery = ParseUser::query();
// 			$userQuery->withinMiles("location", $param['locale'], 1.0);
// 			$query->matchesQuery('user', $userQuery);
			$query->equalTo('localeIdentifier', $param['locale']);
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
	
	/**
	 * 发送活动消息
	 * @param unknown $content
	 * @param unknown $param
	 */
	static function sendActive($content, $param=array()) {
		$content['action'] = 'com.wisape.android.content.ActiveBroadcastReciver';
		self::send($content, $param=array());
	}
	
	private static function getUserInstallId($email){		
		$rs = Yii::app ()->db->createCommand ()->select ( 'install_id' )->from ( 'user' )->where ( 'user_email=:email', array (
				':email' => strtolower ( $email ) 
		) )->queryScalar ();
		return $rs;
	}
	
	
}