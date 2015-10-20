<?php

class TemplateController extends AdminController
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
        $model=new Template;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Template']))
        {
            $model->attributes=$_POST['Template'];
            //计算hash值
			$source = ROOT_PATH.strstr($model->temp_url,'/uploads');
            $model->hash_code = hash_file('md5', $source);
            if($model->save()){
                /*//解压并删除zip
                $dir_str = strstr($model->temp_url,'/uploads');
                $zip_name = explode('/',$dir_str);
                $zip_name = $zip_name[sizeof($zip_name) - 1];
                $dir_str = ROOT_PATH.$dir_str;
                if(is_file($dir_str)){
                    $zip = Yii::app()->zip;
                    if($zip->extractZip($dir_str,substr($dir_str,0,-4) )){
                        //替换文本
                        $zip_dir = dirname($dir_str);
                        $html_path = substr($dir_str,0,-4).'/stage.html';
                        $str = file_get_contents($html_path);
                        $str =  str_replace("jpg","jpg?type=stage&id=$model->id",$str);
                        $str =  str_replace("png","png?type=stage&id=$model->id",$str);
                        $str =  str_replace("gif","gif?type=stage&id=$model->id",$str);
                        $str =  str_replace("jpeg","jpeg?type=stage&id=$model->id",$str);
                        $fp=fopen($html_path,"w");
                        fwrite($fp,$str);
                        fclose($fp);
                        //压缩文本
                        if(!unlink($dir_str)){
                        	echo 'del zip error';exit;
                        }
                        $source = substr($dir_str,0,-4);
                        $rd = uniqid();
                        if($zip->makeZip($source.'/',$zip_dir.'/'.$zip_name)){
//                            $model->temp_url = SITE_URL.'uploads/'.date('YmdH').'/'.$rd;
                            $this->redirect(array('view','id'=>$model->id));
                        }else{
                            echo 'make zip erorr';exit;
                        }
                    }else{
                        echo 'extract error';exit;
                    }
                }*/
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

        if(isset($_POST['Template']))
        {
            $model->attributes=$_POST['Template'];
            //计算hash值
			$source = ROOT_PATH.strstr($model->temp_url,'/uploads');
            $model->hash_code = hash_file('md5', $source);
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
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
			$zip = ROOT_PATH.strstr($model->temp_url,'/uploads');
			if(file_exists($zip) && !unlink($zip)){
				Yii::log('删除模板文件失败:'.$zip, CLogger::LEVEL_ERROR);
			}
			$dir = substr($zip, 0, -4);
			if(file_exists($dir) && !$this->deldir($dir)){
				Yii::log('删除模板文件失败:'.$dir, CLogger::LEVEL_ERROR);
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
        $dataProvider=new CActiveDataProvider('Template');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Template('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Template']))
            $model->attributes=$_GET['Template'];

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
    	$sql = "UPDATE `template` SET rec_status = '$state' WHERE id in ($ids) ";
    	$command = $connection->createcommand($sql)->query();
    	if($state == 'A'){
    		$size = sizeof($_GET['checkedValue']);
    		$sql = "SELECT t.`temp_name`,tt.`name` FROM `template` t, `template_type` tt WHERE t.type=tt.id AND t.id in ($ids)";
    		$names = $connection->createcommand($sql)->queryAll();
			//归类
    		$data = array();
    		foreach ($names as $n){
    			$type = $n['name'];
    			$temp_name = $n['temp_name'];
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
    		$message->title = $size.' new Templates are available for you';
    		$message->user_message = 'Create your story with new Template:'.$this->new_line.$str;
            if($message->save()){
    			$this->sendMessage($message);
    		}
    	}
    	//发送同步列表的通知
    	include_once ROOT_PATH.'/protected/extensions/Parse/ParseApi.php';
    	$data = array (
    			'type' => SYNC_TEMP_MESSAGE,
    			'message_title' => 'need synchronize template list.'
    	);
    	ParseApi::sendSync($data);
    	
    	echo 1;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Template the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Template::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Template $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='template-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
