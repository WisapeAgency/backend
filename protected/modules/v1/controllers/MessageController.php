<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 15-7-19
 * Time: 下午2:12
 */
class MessageController extends ApiController
{

	/**
	 * 用户消息中心
	 * 用户id
	 */
	public function actionList(){
		if(isset($_REQUEST['uid'])){
			$model = User::model()->findByPk($_REQUEST['uid']);
			if($model){
				$user_email = $model->user_email;
				$now = time();
				$add = " AND (unix_timestamp(parsetime) <= $now OR parsetime IS NULL OR parsetime = '')";
				//获得用户没有读过的message
// 				$sql = "select mid from readed_message where uid={$_REQUEST['uid']}";
// 				$str = Yii::app()->db->createCommand($sql)->queryScalar();
// 				if(is_string($str)){
// 					$add = " and id not in($str)";
// 				}
				$sql = "SELECT * FROM send_message WHERE (user_email = '$user_email' OR user_email IS NULL OR user_email ='') $add ORDER BY createtime DESC";
				Yii::log('message_list_sql:'.$sql, CLogger::LEVEL_INFO);
				$data = Yii::app()->db->createCommand($sql)->queryAll();
				$this->sendDataResponse($data);
			}
		}else{
			$this->sendErrorResponse(400, 'Missing necessary parameters.');
		}
	}

	/**
	 * 阅读用户消息
	 * 用户id
	 * mid
	 */
	function actionRead(){
		if(isset($_REQUEST['uid']) && isset($_REQUEST['mid'])){
			$message = SendMessage::model()->findByPk($_REQUEST['mid']);
			if($message){
				//获得当前用户message列表
				$model = ReadedMessage::model()->findByAttributes(array(
						'uid'=>$_REQUEST['uid']
				));
				if(!$model){
					$model = new ReadedMessage();
					$model->mid = $_REQUEST['mid'];
				}else{
					$model->mid .= ','.$_REQUEST['mid'];
				}
				$model->uid = $_REQUEST['uid'];
				if($model->save()){
					$this->sendDataResponse($message->getAttributes());
				}else{
					$this->sendErrorResponse(500, 'Get the message content failed.');
				}
			}else{
				$this->sendErrorResponse(404, 'This message is not found.');
			}
		}
		$this->sendErrorResponse(400, 'Missing necessary parameters.');
	} 
	
}