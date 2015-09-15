<?php

class SiteController extends Controller
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
    			'condition'=>'user_id=:user_id AND email = :email AND token = :token',
    			'params'=>array(':user_id'=>base64_decode($_GET['uid']),':token'=>base64_decode($_GET['key']),':email'=> base64_decode($_GET["email"])),
    			'join'=>''
    				));
    		if(!empty($userModel)&&time() <=$userModel->createtime)
    		{
    			$model = new ResetPWD;
    			$model->user_id = $userModel->user_id;
	    		return $this->renderPartial('resetpassword',array(
	    				'resetPWD'=>$model,
	    		));
    		}
    		return;
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
                Yii::app()->end($model->user_id);
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
        $allowedExtensions = array("jpg",'png','jpeg','mp3','bmp','zip');
        // max file size in bytes (1MB here)
        $sizeLimit = 10 * 1024 * 1024;
        $uploadHandler = new qqFileUploadHandler();
        $uploadHandler->setAllowedExtensions($allowedExtensions);
        $uploadHandler->setSizeLimit($sizeLimit);
        $folder=Yii::app() -> getBasePath() . "/../uploads/";
        //根据业务模块分类
        if(isset($_POST['module']) && !empty($_POST['module'])){
        	$folder = $folder.$_POST['module'].'/';
        	//模板包含缩略图和资源包，需要用文件夹包起来
	        if($_POST['module'] == 'template'){
		        $m = date('YmdH');
		        $folder = $folder.$m.'/';
	        }
        }
        
        if(!is_dir($folder)){
            mkdir($folder,0777,true);
        }
        if(isset($customGetParam) && $customGetParam == true){
            $result = $uploadHandler->handleUpload($folder,false,false,true);
        }else{
            $result = $uploadHandler->handleUpload($folder, false, true);
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


}