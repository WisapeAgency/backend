<?php

class FontsController extends AdminController
{
	
	private $font_css = <<<EOF
@font-face {
	font-family: 'FONT_NAME';
	src: url('FONT_NAME/FONT_NAME.eot');
	src: url('FONT_NAME/FONT_NAME.eot?#iefix') format('embedded-opentype'),
	url('FONT_NAME/FONT_NAME.woff') format('woff'),
	url('FONT_NAME/FONT_NAME.ttf') format('truetype'),
	url('FONT_NAME/FONT_NAME.svg') format('svg');
	font-weight: normal;
	font-style: normal;
}

EOF;
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'status'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Fonts;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Fonts']))
		{
			$model->attributes=$_POST['Fonts'];
			$model->name = $this->getName($model->zip_url);
			//解压
			$zip = Yii::app()->zip;
			$source = ROOT_PATH.strstr($model->zip_url,'/uploads');
			$desc = ROOT_PATH.'/uploads/fonts/';
			if(!$zip->extractZip($source, $desc)){
				Yii::log('解压字体包失败:'.$source, CLogger::LEVEL_ERROR);
				echo '解压字体包失败';exit;
			}
			//计算hash值
			$model->hash_code = hash_file('md5', $source);
			if($model->save()){
                //添加css模块
                $this->addCss($model->name);

				//跳转
                $this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$old_name = $model->name;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Fonts']))
		{
			$model->attributes=$_POST['Fonts'];
			$model->name = $this->getName($model->zip_url);
			//解压
			$zip = Yii::app()->zip;
			$source = ROOT_PATH.strstr($model->zip_url,'/uploads');
			$desc = ROOT_PATH.'/uploads/fonts/';
			if(!$zip->extractZip($source, $desc)){
				Yii::log('解压字体包失败:'.$source, CLogger::LEVEL_ERROR);
				echo '解压字体包失败';exit;
			}
			//计算hash值
			$model->hash_code = hash_file('md5', $source);
			if($model->save()){		
				//
				if($old_name != $model->name){
					$this->delCss($old_name);
					$this->addCss($model->name);
				}
				//跳转
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	/**
	 * 根据文件路径截取文件名
	 * @param unknown $zip_url
	 * @return string
	 */
	private function getName($zip_url){
		return substr(strrchr($zip_url, '/'), 1, -4);
	}
	
	/**
	 * 添加css到公共文件
	 * @param unknown $name
	 */
	private function addCss($name){
		
		$path = ROOT_PATH.'/uploads/fonts/fonts.css';
		$font_content = str_replace('FONT_NAME', $name, $this->font_css);
		$content = file_get_contents($path);
		$content .= $font_content;
		$fp = fopen ( $path, "w" );
		fwrite ( $fp, $content );
		fclose ( $fp );
	}
	
	/**
	 * 从公共文件删除css模块
	 * @param unknown $name
	 */
	private function delCss($name){
		
		$path = ROOT_PATH.'/uploads/fonts/fonts.css';
		$font_content = str_replace('FONT_NAME', $name, $this->font_css);
		$content = file_get_contents($path);
		$content = str_replace($font_content,'',$content);
		$fp = fopen ( $path, "w" );
		fwrite ( $fp, $content );
		fclose ( $fp );
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		if($model->delete()){
			//删除css
			$this->delCss($model->name);
			//删除资源包
			$zip = ROOT_PATH.strstr($model->zip_url,'/uploads');
			if(file_exists($zip) && !unlink($zip)){
				Yii::log('删除字体文件失败:'.$zip, CLogger::LEVEL_ERROR);
			}
			$dir = substr($zip, 0, -4);
			if(file_exists($dir) && !$this->deldir($dir)){
				Yii::log('删除字体文件失败:'.$dir, CLogger::LEVEL_ERROR);
			}
		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Fonts');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model=new Fonts('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Fonts']))
			$model->attributes=$_GET['Fonts'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * 复选框：批量修改状态
	 */
	public function actionStatus(){
		$connection = Yii::app()->db;
		$state = $_GET['state'];
		$ids = implode(',', $_GET['checkedValue']);
		$sql = "UPDATE fonts SET rec_status = '$state' WHERE id in ($ids) ";
		$command = $connection->createcommand($sql)->query();
		if($state == 'A'){
			$size = sizeof($_GET['checkedValue']);
			$sql = "SELECT `name` FROM `fonts` WHERE id in ($ids)";
			$names = $connection->createcommand($sql)->queryAll();
			$namestr = '';
			foreach ($names as $n){
				$namestr .= $n['name'].$this->new_line;
			}
			//推送消息
			$message=new SendMessage;
			$message->title = $size.' new fonts are available for you';
			$message->user_message = 'Create your story with new font:'.$this->new_line.$namestr;
			$this->sendMessage($message);
		}
		//发送同步列表的通知
		include_once ROOT_PATH.'/protected/extensions/Parse/ParseApi.php';
		$data = array (
				'type' => SYNC_FONT_MESSAGE,
				'message_title' => 'need synchronize font list.'
		);
		ParseApi::sendSync($data);
		
		echo 1;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Fonts the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Fonts::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Fonts $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='fonts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
