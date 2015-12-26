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
    	$host = $_SERVER['HTTP_HOST'];
    	if($host == 'v.wisape.com'){
    		$uri = $_SERVER['REQUEST_URI'];
    		if(!empty($uri)){
    			$code = substr($uri, 1);
	    		header('Location: '.'http://v.wisape.com/site/story/'.$code);
    		}
    		exit;
    	}
    	
    	//进入首页
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
//     	if(!isset($_REQUEST['id'])){
//     		echo 'Invalid URL';exit;	
//     	}
//     	$sid = $_REQUEST['id'];
    	$uri = $_SERVER['REQUEST_URI'];
    	$sid = substr(strrchr($uri,'/'),1);
    	$model = Story::model()->findByPk(base64_decode($sid), "rec_status='A'");
    	if(!$model){
    		echo 'Story not found';exit;
    	}
    	//story创作人基本信息
    	$user = User::model()->findByPk($model->uid);
    	if(!$user){
    		echo 'Invalid story';exit;
    	}
    	//对外URL
    	$URL = 'http://v.wisape.com/?'.$sid;
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
		    	QRcode::png($URL,$fileName,'L',3,2);
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
    			'qr_url'=>$qr_url,
    			'story_url'=>$URL
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
    		$pd = PartnerDownload::model()->find("partner_id='".$pid."' and ip_address='".$ip."'");
    		if($pd){
    			$pd->last_time =time();
    			$pd->dl_count = $pd->dl_count + 1;
    		}else{
    			$pd = new PartnerDownload();
    			$pd->ip_address = $ip;
    			$pd->partner_id = $pid;
    			$pd->dl_count = 1;
	    		$increament = true;
    		}
    		if($pd->save()){
				if($increament){
					$partner = RequestPerson::model()->findByPk($pid);
					$partner->download_count = $partner->download_count + 1;
					if(!$partner->update()){
						Yii::log('累计分销次数失败，partner：'.$pid, CLogger::LEVEL_ERROR);
					}
				}
    		}else{
    			Yii::log('记录 下载数据失败，partner：'.$pid, CLogger::LEVEL_ERROR);
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
    
    public function actionRemedyMail(){
    	if(!isset($_REQUEST['user_email'])){
    		$this->sendErrorResponse(400, 'Missing parameter:user_email');
    	}
    	$email = $_REQUEST['user_email'];
    	$parnter = RequestPerson::model()->find("user_email='".$email."'");
    	if(!$parnter){
    		$this->sendErrorResponse(400, 'parnter does not exis.');
    	}
    	if($this->sendPartnerMail($email, $parnter->id)){
    		echo 'send successful.';
    	}
    	echo 'send failed.';
    }
    
    /**
     * 申请成为partner系统自动回复邮件
     * @param unknown $email
     * @param unknown $partner_id
     */
    private function sendPartnerMail($email, $partner_id){
    	if(empty($email)){
    		return false;
    	}
    	$title = 'Welcome to join Wisape Global Partner Plan';
    	$site_url = SITE_URL;
    	//     	$site_url = 'http://106.75.196.252/';
    	$url = $site_url.'index.php/site/downloadApk/code/'.base64_encode($partner_id);
    	
    	$html = <<<EOF
<div style="margin: 0;padding: 0;text-align: center; background: #f5f5f5; font-family: Arial;">
    <div class="mail-box" style="margin: 50px auto 0; padding: 50px 80px; width: 480px; background: #fff; color: #2d3437; border-radius: 5px; border: solid 1px #eaeaeb;">
        <p style="padding: 0; margin: 0;"><img src="{$site_url}/custom/mail-icon/partner_logo.png" width="164" height="45" alt="border:none"></p>
        <p style="padding: 0; margin: 0; padding-top: 25px; line-height: 28px; font-size: 20px;text-transform: uppercase">Welcome to join Wisape <br>Global Partner</p>
        <p style="padding: 0; margin: 0; font-size: 14px; padding-top: 40px; font-weight: bold;text-transform: uppercase">
            The last step to win <em style="color: #d73d32; font-style: normal;">100% commission</em>
        </p>
        <p style="padding: 0; margin: 0; font-size: 14px; padding-top: 20px; line-height: 22px;">
            Invite over 100 users to join Wisape Beta FREE version,<br>
            your exclusive download link:<br>
            <a href="{$url}" style="text-decoration: underline; color: #2962ff">{$url}</a>
        </p>
        <p style="padding: 0; margin: 0; font-size: 14px; padding-top: 40px;text-transform: uppercase">How to invite</p>
        <p style="padding: 0; margin: 0; font-size: 14px; padding-top: 20px; line-height: 22px;">
            ust invite others to click your link to download and install the Wisape Beta<br>
            FREE APP (Android) - without extra work for you.<br>
            Wisape will record every effective download and install from your link,when<br>
            the number to 100, Wisape will automatically send you email, to congratu-<br>
            late you to become one of Wisape VIP partners.
        </p>
        <table cellpadding="0" cellspacing="0" width="100%" style="padding-top: 45px; font-size: 14px; text-align: center;">
            <tr>
                <td width="35%">
                    <p style="padding: 0; margin: 0; height: 10px; margin-top: 10px; border-top: solid 1px #ddd;"></p>
                </td>
                <td width="30%" style="height: 21px; line-height: 21px; margin: 0 10px;">Get social with us</td>
                <td width="35%">
                    <p style="padding: 0; margin: 0; height: 10px; margin-top: 10px; border-top: solid 1px #ddd;"></p>
                </td>
            </tr>
        </table>
        <p style="padding: 0; margin: 0; padding-top: 20px;">
            <a href="https://www.facebook.com/Wisape-Story-Builder-968758586520540/" style="display: inline-block; margin-right: 5px;"><img src="{$site_url}/custom/mail-icon/icon1.png" width="30" height="30" alt="border:none;"></a>
            <a href="https://twitter.com/WisapeAgency" style="display: inline-block; margin-right: 5px;"><img src="{$site_url}/custom/mail-icon/icon2.png" width="30" height="30" alt="border:none;"></a>
            <a href="https://plus.google.com/+AgencyWisape" style="display: inline-block"><img src="{$site_url}/custom/mail-icon/icon3.png" width="30" height="30" alt="border:none;"></a>
        </p>
    </div>
    <div class="mail-foot" style="margin: 20px auto 50px; font-size: 14px; padding: 0; color: #a5a7a7;">2015 Wisape, All rights reserved</div>
</div>
EOF;
    	if(!$this->sendemail($email, $title, $html, true)){
    		//TODO 记录日志
    		$msg = 'send partner email failed. user_email:'.$email;
    		Yii::log($msg, CLogger::LEVEL_ERROR);
    		return false;
    	}
    	return true;
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