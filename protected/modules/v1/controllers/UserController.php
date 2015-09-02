<?php
class UserController extends ApiController
{
    public $layout='//layouts/column2';
    /**
     * @return array action filters
     */
//    public function filters()
//    {
//        return array(
//            'postOnly + create',
//            'putOnly + update',
//            'deleteOnly + delete'
//        );
//    }


    public function actionLogin()
    {
        //创建类型必须给出
	    if(isset($_REQUEST['type'])){
            $type=$_REQUEST['type'];
        }else{
            $this->sendErrorResponse(403, '缺少登录类型');
        }
        //本地注册处理
        if($type == WIS_USER){
            if(isset($_REQUEST['user_email']) && isset($_REQUEST['user_pwd'])){
            	$email = trim($_REQUEST['user_email']);
            	$pwd = trim($_REQUEST['user_pwd']);
            	if(!empty($email) && !empty($pwd)){
	                //邮箱是否已存在
	                $rs = Yii::app()->db->createCommand()
	                    ->select('user_id')
	                    ->from('user')
	                    ->where('user_email=:email',array(':email'=>strtolower($email)))
	                    ->queryScalar();
	           		if($rs){
	                	$user = User::model()->findByPk($rs)->getAttributes();
	                	if(md5($pwd) == $user['user_pwd']){
	                		$this->check_change_device($user);//是否更换终端登录
	                		$this->sendDataResponse($user);
	                	}else{
	                		$this->sendErrorResponse(403,'密码错误');
	                	}
	                }
	                try{
	                    $model=new User;
	                    $model->attributes=$_REQUEST;
	                    $model->user_email = strtolower($model->user_email);
	                    $model->user_pwd = md5($pwd);
	                    //生成用户昵称
	                    $nick_name = explode('@',$email);
	                    $model->nick_name = $nick_name[0];
	//                    $model->nick_name = Yii::app()->badWords->replacement($model->nick_name);
	                    $model->nick_name = $model->nick_name;
	                    $model->user_ext = $type;
	                    $model->access_token = $this->getAccessToken();
	                    $model->install_id = $_REQUEST['install_id'];
	                    $model->save();
	                    $this->sendDataResponse($model->getAttributes());
	                }catch (Exception $e){
	                    //本地用户创建失败!
	                    $this->sendErrorResponse(500,$e->getMessage());
	                }
            	}
            }
            $this->sendErrorResponse(403,'用户输入信息不全');
        }

        //第三方登陆是否已注册
        if($type<>WIS_USER && isset($_REQUEST['unique_str']) && isset($_REQUEST['user_ico']) && isset($_REQUEST['nick_name'])  ){
            if($type == FACE_BOOK_USER){
                $user_ext_name = 'face_book';
            }elseif($type == TWITTER_USER){
                $user_ext_name = 'twitter';
            }
            //用户是否已存在
            $rs = Yii::app()->db->createCommand()
                ->select('user_id')
                ->from('user')
                ->where('user_ext=:user_ext',array(':user_ext'=>$_REQUEST['type']))
                ->andWhere('unique_str=:unique_str',array(':unique_str'=>$_REQUEST['unique_str']))
                ->queryScalar();
            if($rs){
                //用户已存在，无须创建!直接返回数据
                $user = User::model()->findByPk($rs)->getAttributes();
                $this->check_change_device($user);//是否更换终端登录
                $this->sendDataResponse($user);
            }else{
                //如果系统不存在，则创建用户
                try{
                    $model=new User;
                    $model->attributes=$_REQUEST;
                    //第三方拿到的信息有 id,名称，头象
                    $model->nick_name = $_REQUEST['nick_name'];
//                    $model->nick_name = Yii::app()->badWords->replacement($model->nick_name);
                    $model->nick_name = $model->nick_name;
                    $model->user_ext = $_REQUEST['type'];
                    $model->user_ext_name = $user_ext_name;
                    $model->user_ico_n = $_REQUEST['user_ico'];
                    $model->unique_str = $_REQUEST['unique_str'];
                    $model->access_token = $this->getAccessToken();
                    $model->install_id = $_REQUEST['install_id'];
                    $model->save();
                }catch (Exception $e){
                    //第三方注册失败
                    $this->sendErrorResponse(500,$e->getMessage());
                }
                $this->sendDataResponse($model->getAttributes());
            }
        }else{
            $this->sendErrorResponse(403,'第三方登陆参数传递错误!');
        }
    }

    /**
     * 检查是否更换终端登录
     * @param unknown $user
     */
    private function check_change_device($user){
    	//是否更换设备
    	if($_REQUEST['install_id'] != $user['install_id']){
    		//推送消息
    		include ROOT_PATH.'/protected/extensions/Parse/ParseApi.php';
    		$data = array (
    				'type' => LOGIN_MESSAGE,
    				'message_title' => 'Your account has been logged in at another device.'
    		);
    		$param = array (
    				'user' => $user['user_email']
    		);
    		ParseApi::send($data, $param);
    		//更新id
    		User::model()->update(array('install_id' => $_REQUEST['install_id']));
    	}
    }

    /**
     * 忘记密码处理
     * 用户填写email后，发送邮件到目标email后，用户点击链接后修改
     */
    public function actionForget(){
        if(isset($_REQUEST['user_email'])){
            $email = strtolower(trim($_REQUEST['user_email']));
            $userModel = User::model()->find('user_email=:user_email',array(':user_email'=>$email));
            if($userModel){
                //生成密钥
                $key = sha1(uniqid(rand()));
                $url = SITE_URL.'user/forget/uid/'.base64_encode($userModel->user_id).'/key/'.base64_encode($key).'/email/'.base64_encode($email);
                $html = <<<EOF
<table bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" style="border-spacing: 0px; text-align:center; font-family:'微软雅黑'; font-size:15px; line-height:32px;" width="100%">
	<tbody>
		<tr>
			<td style="height:30px; ">&nbsp;</td>
		</tr>
		<tr>
			<td align="center" bgcolor="#fff" style=" width: 620px;" valign="top">
			<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="color:#666;width: 620px;border-collapse: collapse; border:1px solid #d6d6d6;  padding:0 10px;text-align:left;font-size:14px; ">
				<tbody>
					<tr style="background: url(http://www.duorey.com/imges/bg_head.jpg) no-repeat; height:180px">
						<td style="text-align:left;border-collapse: collapse; padding:0 20px;">
						<h1 style="padding:15px 0;"><img src="http://www.duorey.com/imges/elogo.png" style="vertical-align: middle" /><br />
						<br />
						<span style="color:#333; font-weight:normal; font-size:22px;">Thank you for your support Duorey! </span></h1>
						</td>
					</tr>
					<tr>
						<td style=" border-collapse: collapse;padding:0 20px;">
						<p>Dear Customer,</p>

						<p>You requested to reset the password for your Duorey account. Please click this link to reset your password (valid for 10 minutes).</p>

						<div style="text-align:center;"><a href="{$url}" style=" font-size:20px; background:#4dcd70; border-radius:10px; width:200px;height:50px;color:#fff;line-height:50px; text-decoration:none; display:inline-block; text-align:center; border:none;">Reset passsword</a></div>
						</td>
					</tr>
            <tr >
                <td style=" border-collapse: collapse;padding:15px 20px;">
                        <p>
                         Please ignore this email in case you did not have password recovery request. If you still have other problems, please contact us: <a href="mailto:support@duorey.com">support@duorey.com</a><br /></p>
                     <p>Best Regards,<br/>Duorey Team</p>
                </td>
            </tr>
            <tr style="border-bottom:1px solid #d6d6d6; display:none; ">
                <td style=" border-collapse: collapse;padding:15px 20px;">
                       <p>
                <a href="#" target="_blank" style="color:#333; text-decoration:none;"><img src="http://www.duorey.com/imges/lock.png" style="vertical-align:text-bottom; margin-right:5px;" />Visist our website</a>
                <a href="#" target="_blank" style="padding:0 20px; color:#333; text-decoration:none;"><img src="http://www.duorey.com/imges/apple.png" style="vertical-align:text-bottom; margin-right:5px;"/>Download iOS app</a>
                <a href="#" target="_blank" style="color:#333; text-decoration:none;"><img src="http://www.duorey.com/imges/android.png" style="vertical-align:text-bottom; margin-right:5px;" />Download Android app</a>
                </p>
                </td>
            </tr>
            <tr  style="border-top:1px solid #d6d6d6; ">
                <td style="text-align:center; padding-top:10px;">
                <p>
                <a href="https://www.facebook.com/pages/Duorey/993002840725693" target="_blank" style="padding:0 20px;"><img src="http://www.duorey.com/imges/facebook.jpg" /></a>
                <a href="https://twitter.com/DuoRey"  target="_blank"><img src="http://www.duorey.com/imges/twitter.jpg" /></a>
                </p>
                    <p >This email was sent to {$email}.<br />
Don't want to receive this type of email? Unsubscribe.<br />
     Copyright © 2014. YiLe All rights reserved</p>
                </td>
            </tr>
				</tbody>
			</table>
			</td>
		</tr>
		<tr valign="bottom">
			<td style="border-collapse:collapse; height:10px;">&nbsp;</td>
		</tr>
	</tbody>
</table>
EOF;
                //发送邮件
                if($this->sendemail($email,$html)){
                    //将密钥存入数据库并设置过期时间
                    $model = new UserForget();
                    $model->email = $email;
                    //二十分钟之内有效
                    $model->createtime = time()+60*60*10;
                    $model->user_id = $userModel->user_id;
                    $model->token = $key;
                    $model->rec_status = 'A';
                    if($model->save()){
                        $this->sendSuccessResponse();
                    }else{
                        $this->sendErrorResponse(500, '邮件发送完成，数据库未记录');
                    }
                }else{
                    //邮件发送失败，报告错误
                    $this->sendErrorResponse(500, '邮件发送失败');
                }
            }else{
                $this->sendErrorResponse(401, '用户不存在');
            }
        }
    }

    /**
     * 查看自已的资料
     * @uid
     * @token
     * 返回用户信息
     * 最近w一周播放
     */
    public function actionMyProfile(){
        if(isset($_POST['access_token'])){
            $model = $this->getUserModelByToken($_POST['access_token']);
            $this->sendDataResponse($model->getAttributes());
        }
    }

    /**
     * 用户修改个人资料
     * @uid
     * @token
     * @user_ico
     * @user_back_img
     * @user_sig
     */
    public function actionEditProfile(){
        if(isset($_REQUEST['access_token'])){
            $userModel = $this->getUserModelByToken($_REQUEST['access_token']);
            if($userModel){
	            if(isset($_REQUEST['nick_name']) && !empty($_REQUEST['nick_name'])){
	                $userModel->nick_name = $_REQUEST['nick_name'];
	            }
	            $im1 = false;
	            if(isset($_REQUEST['user_ico']) && !empty($_REQUEST['user_ico'])){
	                $img1 = $userModel->user_ico_b;
	                $im1 = $userModel->user_ico_b = $this->saveStrToImg(trim($_REQUEST['user_ico']));
	                $userModel->user_ico_n = $im1;
	            }
	            if(isset($_REQUEST['user_email']) && !empty($_REQUEST['user_email'])){
	            	//邮箱是否已存在
	                $rs = Yii::app()->db->createCommand()
	                    ->select('user_id')
	                    ->from('user')
	                    ->where('user_email=:email',array(':email'=>strtolower($_REQUEST['user_email'])))
	                    ->queryScalar();
	           		if($rs){
	           			$this->sendErrorResponse(403, '邮箱已经存在');
	           		}
	                $userModel->user_email = $_REQUEST['user_email'];
	            }
	            try{
	                if($userModel->save()){
	                    if($im1) $this->delFileFromServer($img1);
	                }
	            }catch (Exception $e){
	                $this->sendErrorResponse(500,$e->getMessage());
	            }
	            $this->sendDataResponse($userModel->getAttributes());
            }
        }
        $this->sendErrorResponse(403, '无效的token');
    }




    /**
     * 根据country 代码返回
     */
    public function actionActive(){
    	if(isset($_REQUEST['now'])){
	        $now = $_REQUEST['now'];
            $where = ' AND country is null';
	        if(isset($_REQUEST['country_code'])){
	            $country_code = $_REQUEST['country_code'];
	            $where = " AND country='$country_code' or country is null";
	        }
	        $sql = "select * from active where start_time<=$now AND end_time>=$now AND rec_status='A' $where";
	        $models = Yii::app()->db->createCommand($sql)->queryAll();
        	$this->sendDataResponse($models);
    	}else{
    		$this->sendErrorResponse(400, '参数不正确');
    	}
    }


    /**
     * 启动页图片
     */
    public function actionStartpage(){
        $model = StartPage::model()->findByAttributes(array(
            'rec_status'=>'A',
        ));
        if(!$model){
            $this->sendDataResponse(array());
        }
        $this->sendDataResponse($model->getAttributes());
    }


}
