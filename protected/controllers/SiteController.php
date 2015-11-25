<?php

class SiteController extends ApiController
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }


    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
    	$this->redirect(SITE_URL.'home');exit;
    	
        $request_model_b = new Request();
        $request_model_c = new RequestPerson();
        $model=new Subscribe;
        $model2=new Subscribe2;
        $model3=new Subscribe3;
        $model4=new Subscribe4;
        $this->render('index',array(
            'request_model_b'=>$request_model_b,
            'model_p'=>$request_model_c,
            'model'=>$model,
            'model2'=>$model2,
            'model3'=>$model3,
            'model4'=>$model4,
        ));
    }
    
    public function actionForget(){
    	//TODO  校验key
    	if(isset($_GET['uid'])&&isset($_GET['key'])&&isset($_GET['email']))
    	{
    		$userModel = UserForget::model()->find(array(
    			'select'=>'*',
    			'condition'=>'user_id=:user_id AND email = :email AND token = :token AND rec_status =:rec_status',
    			'params'=>array(':user_id'=>base64_decode($_GET['uid']),':token'=>base64_decode($_GET['key']),':email'=> base64_decode($_GET["email"]),':rec_status'=>'A'),
    			'join'=>''
    				));
    		if(!empty($userModel)&&time() <=$userModel->createtime)
    		{
    			$model = new ResetPWD;
    			$model->user_id = $userModel->user_id;
	    		return $this->renderPartial('resetpassword',array(
	    				'resetPWD'=>$model,
	    		));
    		}else{
    			echo 'This URL has expired.';
    		}
    		return;
    	}else{
    		echo 'This URL is invalid.';
    	}
    }
    
    /**
     * 播放story
     * @return Ambigous <string, mixed>
     */
    public function actionStory()
    {
    	if(!isset($_REQUEST['id'])){
    		echo 'Invalid URL';exit;	
    	}
    	$sid = $_REQUEST['id'];
    	$model = Story::model()->findByPk($sid, "rec_status='A'");
    	if(!$model){
    		echo 'Story not found';exit;
    	}
    	//story创作人基本信息
    	$user = User::model()->findByPk($model->uid);
    	if(!$user){
    		echo 'Invalid story';exit;
    	}
    	//内容
    	$path = $model->story_path;
    	$content = file_get_contents($path);
    	
    	$isMobile = $this->isMobile();
    	//二维码
    	$offset = -strlen('story.html');
    	$base_url = substr(SITE_URL.substr($path, strrpos($path, 'html/')), 0, $offset);
    	$qr_url = $base_url.'qr.png';
    	if(!$isMobile){
	    	$fileName = dirname($path).'/qr.png';
	    	//二维码文件不存在的时候才创建
	    	if(!file_exists($fileName)){
		    	require_once('phpqrcode.php');
		    	$data = SITE_URL.'index.php/site/story/id/'.$sid;
		    	QRcode::png($data,$fileName,'L',3,2);
	    	}
    	}
    	
    	//分发
    	$view = 'story_pc';
    	if($isMobile){
    		$view = 'story_app';
    	}
    	return $this->renderPartial($view, array(
    			'story'=>$model,
    			'user'=>$user,
    			'content'=>$content,
    			'qr_url'=>$qr_url
    	));
    }
    
	/**
	* 检查是否是以手机浏览器进入(IN_MOBILE)
	*/
	private function isMobile() {
	    $mobile = array();
	    static $mobilebrowser_list ='Mobile|iPhone|Android|WAP|NetFront|JAVA|OperasMini|UCWEB|WindowssCE|Symbian|Series|webOS|SonyEricsson|Sony|BlackBerry|Cellphone|dopod|Nokia|samsung|PalmSource|Xphone|Xda|Smartphone|PIEPlus|MEIZU|MIDP|CLDC';
	    //note 获取手机浏览器
	    if(preg_match("/$mobilebrowser_list/i", $_SERVER['HTTP_USER_AGENT'], $mobile)) {
	        return true;
	    }else{
	        if(preg_match('/(mozilla|chrome|safari|opera|m3gate|winwap|openwave)/i', $_SERVER['HTTP_USER_AGENT'])) {
	            return false;
	        }else{
	            if($_GET['mobile'] === 'yes') {
	                return true;
	            }else{
	                return false;
	            }
	        }
	    }
	}
    
    public function actionUpdatePwd(){
    	$model=new ResetPWD();
    	$this->performAjaxValidationRequest_c($model);
    	if(isset($_POST['ResetPWD']))
    	{
    		$model->attributes = $_POST['ResetPWD'];
    		$model->user_id = $_POST['ResetPWD']['user_id'];
    		$user_model = User::model()->findByPk($model->user_id);
    		$user_model ->user_pwd = md5($model->password);
    		if($user_model->save())
    		{
				$model = UserForget::model()->findAll(array(
						'select' => '*',
						'condition' => 'user_id = :user_id AND rec_status =:rec_status',
						'params' => array(':user_id' =>$model->user_id,':rec_status'=>'A'),
						'join' =>''
						));
				foreach ($model as $it)
				{
					$it->rec_status = 'D';
					$it->save();
				}
                Yii::app()->end(count($model));
    		}
    	}
    }
    
    public function actionUpdateSucess(){
    	$this->renderPartial('resetpwd_sucess');
    }

    public function actionSubscribe(){
        $model=new Subscribe;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $this->performAjaxValidationSub($model);
        if(isset($_POST['Subscribe']))
        {
            $model->attributes=$_POST['Subscribe'];
            $model->createtime = date('Y-m-d H:i:s');
            if($model->save())
                Yii::app()->end($model->id);
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }


    public function actionCreateb()
    {
        $model=new Request;
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidationRequest_b($model);
        if(isset($_POST['Request']))
        {
            $model->attributes=$_POST['Request'];
            $model->createtime = date('Y-m-d H:i:s');
            $model->req_type = 1;//公司
            if($model->save()){
                Yii::app()->end($model->id);
            }
        }
    }

    public function actionCreatec()
    {
        $model=new RequestPerson();
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidationRequest_c($model);
        if(isset($_POST['RequestPerson']))
        {
            $model->attributes=$_POST['RequestPerson'];
            $model->req_type = 2;//个体
            $model->createtime = date('Y-m-d H:i:s');
            if($model->save()){
                Yii::app()->end($model->id);
                //$this->redirect(array('view','id'=>$model->id));
            }
        }
    }
    
    public function actionDownloadApk(){
    	if(isset($_REQUEST['code'])){
    		$code = $_REQUEST['code'];
    		$pid = base64_decode($code);
    		$increament = false;
    		$ip=$_SERVER["REMOTE_ADDR"];
    		$pd = PartnerDownload::model()->find("ip_address='".$ip."'");
    		if($pd){
    			$pd->last_time =time();
    			$pd->dl_count = $pd->dl_count + 1;
    			$pd->update();
    		}else{
    			$pd = new PartnerDownload();
    			$pd->last_time =time();
    			$pd->ip_address = $ip;
    			$pd->dl_count = 1;
    			if($pd->save()){
	    			$increament = true;
    			}else{
    				Yii::log('记录 下载数据失败，partner：'.$pid, CLogger::LEVEL_ERROR);
    			}
    		}
			if($increament){
				$partner = RequestPerson::model()->findByPk($pid);
				$partner->download_count = $partner->download_count + 1;
				if(!$partner->update()){
					Yii::log('累计分销次数失败，partner：'.$pid, CLogger::LEVEL_ERROR);
				}
			}
    	}
    	$file_path = ROOT_PATH.'/uploads/app/wisape.apk';
    		
    	header("Pragma: public"); // required 指明响应可被任何缓存保存
    	header("Expires: 0");
    	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    	header("Cache-Control: private",false); // required for certain browsers
    	header("Content-Type: application/apk");
    	header('Content-Disposition: attachment; filename=wisape.apk');
    	header("Content-Transfer-Encoding: binary");
    	header('Content-Length: '.filesize($file_path));
    	ob_clean(); //Clean (erase) the output buffer
    	flush();
    	readfile( $file_path ); //读入一个文件并写入到输出缓冲。
    	Yii::app()->end();
    }
    
    /**
     * 创建parnter信息
     */
    public function actionCreatePartner()
    {
    	if(!isset($_REQUEST['user_email'])){
    		$this->sendErrorResponse(400, 'Missing parameter:user_email');
    	}
    	$email = trim($_REQUEST['user_email']);
    	$parnter = RequestPerson::model()->find("user_email='".$email."'");
    	if($parnter){
    		$this->sendErrorResponse(400, 'parnter already exist:'.$email);
    	}
    	
    	$model=new RequestPerson();
    	$model->user_email = $email;
    	$model->first_name = isset($_REQUEST['first_name'])?$_REQUEST['first_name']:'';
    	$model->last_name = isset($_REQUEST['last_name'])?$_REQUEST['last_name']:'';
    	$model->company_name = isset($_REQUEST['company_name'])?$_REQUEST['company_name']:'';
    	$model->country = isset($_REQUEST['country'])?$_REQUEST['country']:'';
    	$model->message = isset($_REQUEST['message'])?$_REQUEST['message']:'';
    	$model->createtime = date('Y-m-d H:i:s');
    	try {
			if ($model->save ()) {
				// 发送邮件
				$this->sendPartnerMail ( $model->user_email, $model->id );
				$this->sendSuccessResponse();
			} else {
				Yii::log ( '保存partner数据失败', CLogger::LEVEL_ERROR );
				$this->sendErrorResponse(500, '保存partner数据失败');
			}
		} catch ( Exception $e ) {
			Yii::log ( $e->getMessage (), CLogger::LEVEL_ERROR );
			$this->sendErrorResponse(500, $e->getMessage ());
		}
    }
    
    public function actionMailtest(){
    	$this->sendPartnerMail('sir.zhang@foxmail.com', 11);
    }
    
    /**
     * 申请成为partner系统自动回复邮件
     * @param unknown $email
     * @param unknown $partner_id
     */
    private function sendPartnerMail($email, $partner_id){
    	if(empty($email)){
    		return;
    	}
    	$title = 'Welcome to join Wisape Global Partner Plan';
    	$site_url = SITE_URL;
    	//     	$site_url = 'http://106.75.196.252/';
    	$url = $site_url.'index.php/site/downloadApk/code/'.base64_encode($partner_id);
    	
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
    	if(!$this->sendemail($email, $title, $html, true)){
    		//TODO 记录日志
    		$msg = 'send partner email failed. user_email:'.$email;
    		Yii::log($msg, CLogger::LEVEL_ERROR);
    	}
    }

    /**
     * Performs the AJAX validation.
     * @param Request $model the model to be validated
     */
    protected function performAjaxValidationRequest_b($model)
    {
        if(Yii::app()->getRequest()->getIsAjaxRequest()) {
            $errors =  CActiveForm::validate($model);
            if ($errors !== '[]') {
                Yii::app()->end($errors);
            }
        }
    }
    /**
     * Performs the AJAX validation.
     * @param Request $model the model to be validated
     */
    protected function performAjaxValidationRequest_c($model)
    {
        if(Yii::app()->getRequest()->getIsAjaxRequest()) {
            $errors =  CActiveForm::validate($model);
            if ($errors !== '[]') {
                Yii::app()->end($errors);
            }
        }
    }
    protected function performAjaxValidationSub($model)
    {
        if(Yii::app()->getRequest()->getIsAjaxRequest()) {
            $errors =  CActiveForm::validate($model,'user_email_one');
            if ($errors !== '[]') {
                Yii::app()->end($errors);
            }
        }
    }

    public function actionSupport(){
        $model=new SendMessage;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidationRequest_message($model);

        if(isset($_POST['SendMessage']))
        {
            $model->attributes=$_POST['SendMessage'];
            $model->createtime = date('Y-m-d H:i:s');
            if($model->save()){
                Yii::app()->end($model->id);
            }

        }

        $this->render('support',array(
            'model'=>$model,
        ));
    }



    protected function performAjaxValidationRequest_message($model)
    {
        if(Yii::app()->getRequest()->getIsAjaxRequest()) {
            $errors =  CActiveForm::validate($model);
            if ($errors !== '[]') {
                Yii::app()->end($errors);
            }
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                $headers="From: $name <{$model->email}>\r\n".
                    "Reply-To: {$model->email}\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(SITE_URL.'index.php/admin/default/login');
//         $this->redirect(Yii::app()->homeUrl);
    }


    /**
     * @param $customGetParam
     */
    public function actionAjaxUpload($customGetParam=false)
    {
        Yii::import("ext.EAjaxUpload.qqFileUploadHandler");
        // list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $allowedExtensions = null;
        if(isset($_POST['file_type']) && $_POST['file_type']){
        	$allowedExtensions = explode(',', $_POST['file_type']);
        }else{
        	$allowedExtensions = array('jpg','png','jpeg','bmp','mp3','zip','apk');
        }
        // max file size in bytes (20MB here)
        $sizeLimit = 20 * 1024 * 1024;
        $uploadHandler = new qqFileUploadHandler();
        $uploadHandler->setAllowedExtensions($allowedExtensions);
        $uploadHandler->setSizeLimit($sizeLimit);
        $folder=Yii::app() -> getBasePath() . "/../uploads/";
        //根据业务模块分类
        $uniqName = isset($_POST['uniqName']) ? $_POST['uniqName'] : true;
        if(isset($_POST['module']) && !empty($_POST['module'])){
        	$folder = $folder.$_POST['module'].'/';
        	//模板包含缩略图和资源包，需要用文件夹包起来
	        if($_POST['module'] == 'template'){
		        $m = date('Ymd');
		        $folder = $folder.$m.'/';
	        }
        }
        
        if(!is_dir($folder)){
            mkdir($folder,0777,true);
        }
        if(isset($customGetParam) && $customGetParam == true){
            $result = $uploadHandler->handleUpload($folder,$uniqName,false,true);
        }else{
            $result = $uploadHandler->handleUpload($folder, $uniqName, true);
        }
        // to pass data through iframe you will need to encode all html tags
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }


    public function actionParse()
    {
    	//推送消息
    	include ROOT_PATH.'/protected/extensions/Parse/ParseApi.php';
    	$data = array("message_title"=>"new story","message_subject"=>"story:abc","type"=>1,'id'=>1);
    	ParseApi::send($data);echo 'ok';exit;
    }


    public function actionQr(){
    	include ROOT_PATH.'/protected/components/phpqrcode.php';
    	QRcode::png('http://www.wisape.com', false, 'L', 3, 2);
    }

}