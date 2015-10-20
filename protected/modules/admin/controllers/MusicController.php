<?php

class MusicController extends AdminController
{
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
		$model=new Music;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Music']))
		{
			$model->attributes=$_POST['Music'];
			$model->music_name = $this->getName($model->music_url);

			//计算hash值
			$source = ROOT_PATH.strstr($model->music_url,'/uploads');
			$model->hash_code = hash_file('md5', $source);
			if($model->save()){
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Music']))
		{
			$model->attributes=$_POST['Music'];
			$model->music_name = $this->getName($model->music_url);
			//计算hash值
			$source = ROOT_PATH.strstr($model->music_url,'/uploads');
			$model->hash_code = hash_file('md5', $source);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
	private function getName($music_url){
		return substr(strrchr($music_url, '/'), 1, -4);
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
			//删除资源包
			$file = ROOT_PATH.strstr($model->music_url,'/uploads');
			if(file_exists($file) && !unlink($file)){
				Yii::log('删除音乐文件失败:'.$file, CLogger::LEVEL_ERROR);
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
		$dataProvider=new CActiveDataProvider('Music');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Music('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Music']))
			$model->attributes=$_GET['Music'];

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
		$sql = "UPDATE `music` SET rec_status = '$state' WHERE id in ($ids) ";
		$command = $connection->createcommand($sql)->query();
		if($state == 'A'){
			$size = sizeof($_GET['checkedValue']);
			$sql = "SELECT t.`music_name`,tt.`name` FROM `music` t, `music_type` tt WHERE t.type=tt.id AND t.id in ($ids)";
			$names = $connection->createcommand($sql)->queryAll();
			//归类
			$data = array();
			foreach ($names as $n){
				$type = $n['name'];
				$temp_name = $n['music_name'];
				if(isset($data[$type])){
					$data[$type] .= $this->new_line.$temp_name;
				}else{
					$data[$type] = $temp_name;
				}
			}
			//拼装
			$str = '';
			while ($var = current($data)) {
				$str .= key($data).'分类：'.$this->new_line.$var.$this->new_line;
				next($data);
			}
			//推送消息
			$message=new SendMessage;
			$message->title = $size.' new background musics are available for you';
			$message->user_message = 'Set your story background with new music:'.$this->new_line.$str;
			if($message->save()){
				$this->sendMessage($message);
			}
		}
		echo 1;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Music the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Music::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Music $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='music-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
