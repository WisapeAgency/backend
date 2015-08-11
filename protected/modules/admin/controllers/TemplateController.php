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
                'actions'=>array('create','update'),
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
            if($model->save()){
                //解压并删除zip
                $dir_str = strstr($model->temp_url,'/uploads');
                $new_zip = explode('/',$dir_str);
                $new_zip = $new_zip[3];
                $dir_str = SITE_DIR.$dir_str;
                if(is_file($dir_str)){
                    $zip = Yii::app()->zip;
                    if($zip->extractZip($dir_str,substr($dir_str,0,-4) )){
                        //替换文本
                        $zip_dir = dirname($dir_str);
                        $html_path = substr($dir_str,0,-4).'/stage.html';
                        $str = file_get_contents(str_replace(SITE_DIR,'http://www.wisape.com',$html_path));
                        $str .=  str_replace("jpg","jpg?type=stage&id=$model->id",$str);
                        $str .=  str_replace("png","png?type=stage&id=$model->id",$str);
                        $str .=  str_replace("gif","gif?type=stage&id=$model->id",$str);
                        $str .=  str_replace("jpeg","jpeg?type=stage&id=$model->id",$str);
                        $fp=fopen($html_path,"w");
                        fwrite($fp,$str);
                        fclose($fp);
                        //压缩文本
                        if(!unlink($dir_str)) $this->sendErrorResponse(500,'del zip error');
                        $source = substr($dir_str,0,-4);
                        $rd = uniqid();
                        if($zip->makeZip($source.'/',$new_zip)){
//                            $model->temp_url = SITE_URL.'uploads/'.date('YmdH').'/'.$rd;
                            $this->redirect(array('view','id'=>$model->id));
                        }else{
                            echo 'dddddddd';exit;
                        }
                    }else{
                        echo 'error';exit;
                    }
                }
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
        $this->loadModel($id)->delete();

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
