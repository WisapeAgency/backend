<?php

class DefaultController extends AdminController
{
	public function actionIndex()
	{
		$this->render('index');
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
            if($model->validate() && $model->login()){
                $this->redirect(SITE_URL.'index.php/admin/default');
//                 $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }
    
    public function actionUpload(){
    	$model=new Fonts();
    	$this->render('upload',array('model'=>$model));
    }
}