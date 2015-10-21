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
            $this->sendErrorResponse(403, 'Missing necessary parameters.');
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
	                		$this->sendErrorResponse(403,'Incorrect username or password.');
	                	}
	                }
	                try{
	                    $model=new User;
// 	                    $model->attributes=$_REQUEST;
	                    $model->user_email = strtolower($_REQUEST['user_email']);
	                    $model->user_pwd = md5($pwd);
	                    //生成用户昵称
	                    $nick_name = explode('@',$email);
	                    $model->nick_name = $nick_name[0];
// 	                    $model->nick_name = Yii::app()->badWords->replacement($model->nick_name);
	                    $model->user_ext = $type;
	                    $model->access_token = $this->getAccessToken();
	                    $model->install_id = isset($_REQUEST['install_id']) ? $_REQUEST['install_id'] : '';
	                    if($model->save()){
	                    	//添加默认story
	                    	$this->add_default_story($model->user_id);
		                    try{
			                    //发送欢迎邮件
			                    $this->sendWelcomeMail($model->user_email);
		                    }catch (Exception $e1){
		                    	Yii::log($e1->getMessage(), CLogger::LEVEL_ERROR);
		                    }
	                    	$this->sendDataResponse($model->getAttributes());
	                    }else{
	                    	$this->sendErrorResponse(500, 'Save register information failed.');
	                    }
	                }catch (Exception $e){
	                    //本地用户创建失败!
	                	Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
	                    $this->sendErrorResponse(500, 'Server error.');
	                }
            	}
            }
            $this->sendErrorResponse(403,'Missing necessary parameters.');
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
//                     $model->attributes=$_REQUEST;
                    //第三方拿到的信息有 id,名称，头象
                    $model->nick_name = $_REQUEST['nick_name'];
//                     $model->nick_name = Yii::app()->badWords->replacement($model->nick_name);
                    $model->user_ext = $_REQUEST['type'];
                    $model->user_ext_name = $user_ext_name;
                    $model->user_ico_n = $_REQUEST['user_ico'];
                    $model->unique_str = $_REQUEST['unique_str'];
                    $model->access_token = $this->getAccessToken();
                    $model->install_id = isset($_REQUEST['install_id']) ? $_REQUEST['install_id'] : '';
                    if($model->save()){
                    	//添加默认story
                    	$this->add_default_story($model->user_id);
                    	
                    	$this->sendDataResponse($model->getAttributes());
                    }else{
	                    $this->sendErrorResponse(500, 'Save register data failed.');
                    }
                }catch (Exception $e){
                    //第三方注册失败
                	Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
                    $this->sendErrorResponse(500, 'Server error.');
                }
            }
        }else{
            $this->sendErrorResponse(403,'Missing necessary parameters.');
        }
    }
    
    /**
     * 添加默认story数据
     */
    private function add_default_story($user_id){
    	$story = new Story;
    	$story->uid = $user_id;
    	$story->story_name = 'My story';
    	$story->description = 'Something wonderful is coming';
    	$story->rec_status = 'B';
    	if(!$story->save()){
    		Yii::log('添加默认story数据失败，uid:'.$user_id, CLogger::LEVEL_ERROR);
    	}
    }

    /**
     * 检查是否更换终端登录
     * @param unknown $user
     */
    private function check_change_device($user){
    	//是否更换设备
    	if(isset($_REQUEST['install_id']) && $_REQUEST['install_id'] != $user['install_id']){
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
    		//更新install_id
    		$model = User::model()->updateByPk($user['user_id'], array('install_id' => $_REQUEST['install_id']));
    	}
    }
    
    /**
     * 发送欢迎邮件
     * @param unknown $email
     */
    private function sendWelcomeMail($email){
    	if(!$email){
    		return;
    	}
    	$site_url = SITE_URL;
//     	$site_url = 'http://106.75.196.252/';
    	$html = <<<EOF
<div style="width:100%; height:100%; background-color:#f5f5f5; color:#b9bbbc;text-align:center;line-height: 35px;font-size:14px;">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title></title>
	<style type="text/css">
		body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,p,blockquote,th,td{margin:0;padding:0;}
		fieldset,img{border:0;}
		table{border:1px solid #eceae9; border-radius:5px; background-color:#FFFFFF;}
		h3{color:#1e1e1e;text-align:center;}
		.content{line-height:20px;font-size:14px;font-family:微软雅黑;text-align:center;position:relative;}
		td p{line-height:25px;padding:7px 0;;font-family:微软雅黑;color:#000000;}
	</style>
	<table width="616" align="center" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td align="center" valign="top">
					<p><img src="{$site_url}/custom/mail-icon/logo.png"></p>
				</td>
			</tr>
			<tr>
				<td class="content" valign="top" style="padding:0 100px;">
					<h3>WELCOME TO WISAPE</h3>
					<p>We're happy you're here.We created Wisape lets you create a stunning story with no technical skills needed ,and promote it to your Facebook,Twitter,LINE,etc</p>
					<img src="{$site_url}/custom/mail-icon/Welcome-to-register.png" width="347" height="182">
					<br/><br/>
					<hr>
					<span style="position:absolute; padding:0 10px;top:309px;left:237px;background-color:#fff;color:#000000;">Get social with us</span>
					<p>
						<img src="{$site_url}/custom/mail-icon/Welcome-to-register1.png" width="32" height="32"style="margin:0 5px;">
						<img src="{$site_url}/custom/mail-icon/Welcome-to-register2.png" width="32" height="32"style="margin:0 5px;">
						<img src="{$site_url}/custom/mail-icon/Welcome-to-register3.png" width="32" height="32"style="margin:0 5px;">
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	2015 Wisape,All rights reserved
</div>
EOF;
			if(!$this->sendemail($email ,'Welcome to Wisape' ,$html)){
				//TODO 记录日志
				$msg = 'send welcome mail failed. user_email:'.$email;
				Yii::log($msg, CLogger::LEVEL_ERROR);
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
            	$site_url = SITE_URL;
//     	$site_url = 'http://106.75.196.252/';
                //生成密钥
                $key = sha1(uniqid(rand()));
                $url = SITE_URL.'index.php/site/forget/uid/'.base64_encode($userModel->user_id).'/key/'.base64_encode($key).'/email/'.base64_encode($email);
                $html = <<<EOF
<div style="width:100%; height:100%; background-color:#f5f5f5; color:#b9bbbc;text-align:center;line-height: 35px;font-size:14px;"> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title></title>
	<style type="text/css">
		body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,p,blockquote,th,td{margin:0;padding:0;}
		fieldset,img{border:0;}
		table{border:1px solid #eceae9; border-radius:5px; background-color:#FFFFFF;}
		.content1{line-height:20px;font-size:14px;font-family:微软雅黑;text-align:center;position:relative;}
		.content1 p{line-height:25px;padding:7px 0;font-family:微软雅黑; color:#000000;}
		.content_a{line-height: 40px;display: block;height: 40px;width: 221px;color: #FFFFFF;text-decoration: none;background-color: #43a047; border-radius:5px;margin: 0 auto;font-size:15px;}
		.content_a1{ color:#ff8800;}
		.content_a2{color:#ff8800;text-decoration: none;}
	</style>
	<table width="616" align="center" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td align="center" valign="top">
					<p><img src="{$site_url}/custom/mail-icon/logo.png"></p>
				</td>
			</tr>
			<tr>
				<td class="content1" valign="top" style="padding:0 50px;">
					<p>You has requested a link to change your password.To continue,please click on the link below.</p>
					<p><a href="{$url}" class="content_a" style="text-decoration: none;">Change My Password</a></p>
					<p>Or copy and paste this URL into you browser:</p>
					<p><a href="{$url}" class="content_a1" style="width: 514px; display: block; word-wrap:break-word;">{$url}</a></p>
					<br/>
					<p>Your password won't be changed until you access the link above and create a new one.</p>
					<p>If you didn't request this,please send us a message at <a class="content_a2">support@wisape.com</a></p>
					<br/>
					<br/>
				</td>
			</tr>
		</tbody>
	</table>
	This message is sent by Wisape
</div>
EOF;
//                 $this->sendWelcomeMail($email);        
                //发送邮件
                if($this->sendemail($email, 'Wisape Account password help', $html)){
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
                        $this->sendErrorResponse(500, 'Save record failed.');
                    }
                }else{
                    //邮件发送失败，报告错误
                    $this->sendErrorResponse(500, 'Send email failed.');
                }
            }else{
                $this->sendErrorResponse(401, 'User is not found.');
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
	                $im1 = $userModel->user_ico_b = $this->saveAvatar(trim($_REQUEST['user_ico']));
	                $userModel->user_ico_n = $im1;
	            }
	            if(isset($_REQUEST['user_email']) && !empty($_REQUEST['user_email'])){
	            	$email = strtolower($_REQUEST['user_email']);
	            	//邮箱是否已存在
	                $rs = Yii::app()->db->createCommand()
	                    ->select('user_id')
	                    ->from('user')
	                    ->where('user_id <> '.$userModel['user_id'].' and user_email=:email',array(':email'=>$email))
	                    ->queryScalar();
	           		if($rs){
	           			$this->sendErrorResponse(403, 'Email already exists.');
	           		}
	                $userModel->user_email = $email;
	            }
	            try{
	                if($userModel->save()){
	                    if($im1) $this->delFileFromServer($img1);
	                }
	            }catch (Exception $e){
	            	Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
	                $this->sendErrorResponse(500, 'Server error.');
	            }
	            $this->sendDataResponse($userModel->getAttributes());
            }
        }
        $this->sendErrorResponse(403, 'Invalid access token.');
    }




    /**
     * 根据country 代码返回
     */
    public function actionActive(){
	        $now = time();
            $where = ' AND country is null';
	        if(isset($_REQUEST['country_code'])){
	            $country_code = $_REQUEST['country_code'];
	            $where = " AND country='$country_code' or country is null";
	        }
	        $sql = "select * from active where unix_timestamp(start_time)<=$now AND unix_timestamp(end_time)>=$now AND rec_status='A' $where";
	        $models = Yii::app()->db->createCommand($sql)->queryAll();
        	$this->sendDataResponse($models);
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
